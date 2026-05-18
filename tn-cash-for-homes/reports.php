<?php
/**
 * TCFH Reports — daily/monthly/yearly stats emails.
 *
 * Pulls from GA4 Data API, Google Ads API, and Search Console API; renders an
 * HTML email; logs every send to wp_tcfh_email_log.
 *
 * Credentials are entered on Settings → Daily Reports and stored in wp_options
 * under `tcfh_reports_settings`. wp-config.php constants of the same name (e.g.
 * TCFH_REPORTS_GA4_PROPERTY_ID) win when defined so secrets can live outside DB.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Constants ──────────────────────────────────────────────────────────── */

define( 'TCFH_REPORTS_DB_VERSION',  '1' );
define( 'TCFH_REPORTS_OPTION_KEY',  'tcfh_reports_settings' );
define( 'TCFH_REPORTS_TIMEZONE',    'America/Chicago' );
define( 'TCFH_REPORTS_CACHE_TTL',   6 * HOUR_IN_SECONDS );
define( 'TCFH_REPORTS_HTTP_TIMEOUT', 20 );
define( 'TCFH_REPORTS_DEFAULT_TO', 'karson@tncashforhomes.com' );

/* ── Settings access ────────────────────────────────────────────────────── */

/**
 * Returns the merged settings array. Constants in wp-config.php override DB
 * values for the same key; the option is the editable fallback.
 */
function tcfh_reports_get_settings() {
    $defaults = array(
        'recipient'           => TCFH_REPORTS_DEFAULT_TO,
        'ga4_sa_json'         => '',
        'ga4_property_id'     => '',
        'gsc_site_url'        => '',
        'gsc_sa_json'         => '', // optional; falls back to ga4_sa_json
        'gads_developer_token'=> '',
        'gads_client_id'      => '',
        'gads_client_secret'  => '',
        'gads_refresh_token'  => '',
        'gads_customer_id'    => '',
        'gads_login_customer_id' => '',
    );
    $stored = get_option( TCFH_REPORTS_OPTION_KEY, array() );
    if ( ! is_array( $stored ) ) $stored = array();
    $out = array_merge( $defaults, $stored );

    $const_map = array(
        'recipient'              => 'TCFH_REPORTS_RECIPIENT',
        'ga4_sa_json'            => 'TCFH_REPORTS_GA4_SA_JSON',
        'ga4_property_id'        => 'TCFH_REPORTS_GA4_PROPERTY_ID',
        'gsc_site_url'           => 'TCFH_REPORTS_GSC_SITE_URL',
        'gsc_sa_json'            => 'TCFH_REPORTS_GSC_SA_JSON',
        'gads_developer_token'   => 'TCFH_REPORTS_GADS_DEVELOPER_TOKEN',
        'gads_client_id'         => 'TCFH_REPORTS_GADS_CLIENT_ID',
        'gads_client_secret'     => 'TCFH_REPORTS_GADS_CLIENT_SECRET',
        'gads_refresh_token'     => 'TCFH_REPORTS_GADS_REFRESH_TOKEN',
        'gads_customer_id'       => 'TCFH_REPORTS_GADS_CUSTOMER_ID',
        'gads_login_customer_id' => 'TCFH_REPORTS_GADS_LOGIN_CUSTOMER_ID',
    );
    foreach ( $const_map as $key => $const ) {
        if ( defined( $const ) && constant( $const ) !== '' ) {
            $out[ $key ] = constant( $const );
        }
    }
    return $out;
}

function tcfh_reports_recipient() {
    $s = tcfh_reports_get_settings();
    $email = is_email( $s['recipient'] ) ? $s['recipient'] : TCFH_REPORTS_DEFAULT_TO;
    return apply_filters( 'tcfh_reports_recipient', $email );
}

/* ── DB: email log table ────────────────────────────────────────────────── */

function tcfh_reports_log_table() {
    global $wpdb;
    return $wpdb->prefix . 'tcfh_email_log';
}

function tcfh_reports_install() {
    $installed = get_option( 'tcfh_reports_db_version' );
    if ( $installed === TCFH_REPORTS_DB_VERSION ) return;

    global $wpdb;
    $table   = tcfh_reports_log_table();
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table} (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        sent_at DATETIME NOT NULL,
        report_type VARCHAR(20) NOT NULL DEFAULT 'daily',
        period_start DATE NULL,
        period_end DATE NULL,
        recipient VARCHAR(190) NOT NULL DEFAULT '',
        subject VARCHAR(255) NOT NULL DEFAULT '',
        status VARCHAR(20) NOT NULL DEFAULT 'sent',
        error TEXT NULL,
        payload LONGTEXT NULL,
        PRIMARY KEY  (id),
        KEY report_type (report_type),
        KEY sent_at (sent_at)
    ) {$charset};";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );

    update_option( 'tcfh_reports_db_version', TCFH_REPORTS_DB_VERSION );
}
add_action( 'after_setup_theme', 'tcfh_reports_install' );

function tcfh_reports_log_send( $report_type, $period_start, $period_end, $subject, $status, $error = '', $payload = null ) {
    global $wpdb;
    $wpdb->insert( tcfh_reports_log_table(), array(
        'sent_at'      => current_time( 'mysql' ),
        'report_type'  => $report_type,
        'period_start' => $period_start,
        'period_end'   => $period_end,
        'recipient'    => tcfh_reports_recipient(),
        'subject'      => $subject,
        'status'       => $status,
        'error'        => $error,
        'payload'      => $payload ? wp_json_encode( $payload ) : null,
    ) );
}

/* ── Cron scheduling (self-rescheduling, timezone-correct) ──────────────── */

/**
 * Next 8:00am CT timestamp (UTC), strictly after the given $after_ts. DST-safe
 * because DateTime applies the zone's offset for that wall-clock instant.
 */
function tcfh_reports_next_daily_ts( $after_ts = null ) {
    $after_ts = $after_ts ?: time();
    $tz       = new DateTimeZone( TCFH_REPORTS_TIMEZONE );
    $candidate = new DateTime( 'now', $tz );
    $candidate->setTime( 8, 0, 0 );
    if ( $candidate->getTimestamp() <= $after_ts ) {
        $candidate->modify( '+1 day' );
        $candidate->setTime( 8, 0, 0 );
    }
    return $candidate->getTimestamp();
}

function tcfh_reports_next_monthly_ts( $after_ts = null ) {
    $after_ts = $after_ts ?: time();
    $tz   = new DateTimeZone( TCFH_REPORTS_TIMEZONE );
    $cand = new DateTime( 'first day of next month', $tz );
    $cand->setTime( 8, 0, 0 );
    if ( $cand->getTimestamp() <= $after_ts ) {
        $cand->modify( 'first day of next month' );
        $cand->setTime( 8, 0, 0 );
    }
    return $cand->getTimestamp();
}

function tcfh_reports_next_yearly_ts( $after_ts = null ) {
    $after_ts = $after_ts ?: time();
    $tz   = new DateTimeZone( TCFH_REPORTS_TIMEZONE );
    $year = (int) ( new DateTime( 'now', $tz ) )->format( 'Y' ) + 1;
    $cand = new DateTime( $year . '-01-01 08:00:00', $tz );
    if ( $cand->getTimestamp() <= $after_ts ) {
        $cand->modify( '+1 year' );
    }
    return $cand->getTimestamp();
}

function tcfh_reports_ensure_cron() {
    if ( ! wp_next_scheduled( 'tcfh_report_daily' ) ) {
        wp_schedule_single_event( tcfh_reports_next_daily_ts(),   'tcfh_report_daily' );
    }
    if ( ! wp_next_scheduled( 'tcfh_report_monthly' ) ) {
        wp_schedule_single_event( tcfh_reports_next_monthly_ts(), 'tcfh_report_monthly' );
    }
    if ( ! wp_next_scheduled( 'tcfh_report_yearly' ) ) {
        wp_schedule_single_event( tcfh_reports_next_yearly_ts(),  'tcfh_report_yearly' );
    }
}
add_action( 'init', 'tcfh_reports_ensure_cron' );

/* ── Cron handlers (each handler re-schedules its successor) ────────────── */

function tcfh_report_daily_run() {
    tcfh_reports_dispatch( 'daily' );
    wp_schedule_single_event( tcfh_reports_next_daily_ts( time() + 60 ), 'tcfh_report_daily' );
}
add_action( 'tcfh_report_daily', 'tcfh_report_daily_run' );

function tcfh_report_monthly_run() {
    tcfh_reports_dispatch( 'monthly' );
    wp_schedule_single_event( tcfh_reports_next_monthly_ts( time() + 60 ), 'tcfh_report_monthly' );
}
add_action( 'tcfh_report_monthly', 'tcfh_report_monthly_run' );

function tcfh_report_yearly_run() {
    tcfh_reports_dispatch( 'yearly' );
    wp_schedule_single_event( tcfh_reports_next_yearly_ts( time() + 60 ), 'tcfh_report_yearly' );
}
add_action( 'tcfh_report_yearly', 'tcfh_report_yearly_run' );

/* ── Report dispatcher ──────────────────────────────────────────────────── */

/**
 * Computes the [start, end] date range for a report type, in YYYY-MM-DD.
 * Always in TCFH_REPORTS_TIMEZONE so "yesterday" means yesterday in CT.
 */
function tcfh_reports_period_for( $type ) {
    $tz  = new DateTimeZone( TCFH_REPORTS_TIMEZONE );
    $now = new DateTime( 'now', $tz );
    switch ( $type ) {
        case 'yearly':
            $start = ( clone $now )->modify( 'first day of january last year' )->setTime( 0, 0 );
            $end   = ( clone $now )->modify( 'last day of december last year' )->setTime( 23, 59, 59 );
            break;
        case 'monthly':
            $start = ( clone $now )->modify( 'first day of last month' )->setTime( 0, 0 );
            $end   = ( clone $now )->modify( 'last day of last month' )->setTime( 23, 59, 59 );
            break;
        case 'daily':
        default:
            $start = ( clone $now )->modify( '-1 day' )->setTime( 0, 0 );
            $end   = ( clone $now )->modify( '-1 day' )->setTime( 23, 59, 59 );
            break;
    }
    return array( $start->format( 'Y-m-d' ), $end->format( 'Y-m-d' ) );
}

function tcfh_reports_label_for( $type, $start, $end ) {
    if ( $type === 'daily' )   return date_create( $start )->format( 'l, F j, Y' );
    if ( $type === 'monthly' ) return date_create( $start )->format( 'F Y' );
    if ( $type === 'yearly' )  return date_create( $start )->format( 'Y' );
    return $start . ' → ' . $end;
}

/**
 * Pulls data, renders, sends, logs. Returns array { ok, subject, error }.
 */
function tcfh_reports_dispatch( $type, $force_fresh = false ) {
    list( $start, $end ) = tcfh_reports_period_for( $type );
    $label = tcfh_reports_label_for( $type, $start, $end );

    $data = tcfh_reports_collect( $start, $end, $force_fresh );

    $subject = sprintf(
        '[%s Report] %s — %s visitors, $%s spend',
        ucfirst( $type ),
        $label,
        number_format_i18n( (int) ( $data['ga4']['visitors'] ?? 0 ) ),
        number_format_i18n( (float) ( $data['gads']['cost'] ?? 0 ), 2 )
    );

    $html = tcfh_reports_render_email( $type, $label, $start, $end, $data );

    $to      = tcfh_reports_recipient();
    $headers = array( 'Content-Type: text/html; charset=UTF-8' );
    $ok      = wp_mail( $to, $subject, $html, $headers );

    $error = '';
    if ( ! $ok ) {
        $error = 'wp_mail returned false';
    } elseif ( ! empty( $data['errors'] ) ) {
        $error = 'partial: ' . implode( '; ', $data['errors'] );
    }

    tcfh_reports_log_send(
        $type, $start, $end, $subject,
        $ok ? ( $error ? 'partial' : 'sent' ) : 'failed',
        $error,
        array(
            'visitors' => $data['ga4']['visitors'] ?? null,
            'spend'    => $data['gads']['cost']    ?? null,
            'errors'   => $data['errors']          ?? array(),
        )
    );

    return array( 'ok' => (bool) $ok, 'subject' => $subject, 'error' => $error );
}

/* ── HTTP + caching helpers ─────────────────────────────────────────────── */

function tcfh_reports_cache_get( $key ) {
    return get_transient( 'tcfh_rep_' . md5( $key ) );
}
function tcfh_reports_cache_set( $key, $value ) {
    set_transient( 'tcfh_rep_' . md5( $key ), $value, TCFH_REPORTS_CACHE_TTL );
}

function tcfh_reports_http_json( $method, $url, $headers, $body = null ) {
    $args = array(
        'method'  => $method,
        'headers' => $headers,
        'timeout' => TCFH_REPORTS_HTTP_TIMEOUT,
    );
    if ( $body !== null ) {
        $args['body'] = is_string( $body ) ? $body : wp_json_encode( $body );
    }
    $resp = wp_remote_request( $url, $args );
    if ( is_wp_error( $resp ) ) {
        return new WP_Error( 'http', $resp->get_error_message() );
    }
    $code = (int) wp_remote_retrieve_response_code( $resp );
    $raw  = wp_remote_retrieve_body( $resp );
    $json = json_decode( $raw, true );
    if ( $code < 200 || $code >= 300 ) {
        $msg = is_array( $json ) && isset( $json['error']['message'] )
            ? $json['error']['message']
            : ( 'HTTP ' . $code . ': ' . substr( $raw, 0, 200 ) );
        return new WP_Error( 'http_' . $code, $msg );
    }
    return $json;
}

/* ── Google auth: service account JWT bearer + Ads OAuth refresh ────────── */

/**
 * Exchanges a service-account JSON key for an access token. $scope is a
 * space-separated list of OAuth2 scopes (e.g. "https://.../analytics.readonly").
 */
function tcfh_reports_sa_access_token( $sa_json_raw, $scope ) {
    if ( ! $sa_json_raw ) return new WP_Error( 'no_sa', 'Service account JSON not configured' );
    $sa = is_array( $sa_json_raw ) ? $sa_json_raw : json_decode( $sa_json_raw, true );
    if ( ! is_array( $sa ) || empty( $sa['client_email'] ) || empty( $sa['private_key'] ) ) {
        return new WP_Error( 'bad_sa', 'Service account JSON is invalid' );
    }

    $cache_key = 'sa_tok_' . md5( $sa['client_email'] . '|' . $scope );
    $cached = get_transient( 'tcfh_rep_' . md5( $cache_key ) );
    if ( $cached && ! empty( $cached['expires_at'] ) && $cached['expires_at'] > time() + 60 ) {
        return $cached['token'];
    }

    $b64 = function( $d ) { return rtrim( strtr( base64_encode( $d ), '+/', '-_' ), '=' ); };
    $header = array( 'alg' => 'RS256', 'typ' => 'JWT' );
    $now    = time();
    $claims = array(
        'iss'   => $sa['client_email'],
        'scope' => $scope,
        'aud'   => 'https://oauth2.googleapis.com/token',
        'exp'   => $now + 3600,
        'iat'   => $now,
    );
    $unsigned  = $b64( wp_json_encode( $header ) ) . '.' . $b64( wp_json_encode( $claims ) );
    $signature = '';
    $ok = openssl_sign( $unsigned, $signature, $sa['private_key'], 'sha256' );
    if ( ! $ok ) return new WP_Error( 'sign', 'openssl_sign failed — check private_key format' );
    $jwt = $unsigned . '.' . $b64( $signature );

    $resp = wp_remote_post( 'https://oauth2.googleapis.com/token', array(
        'timeout' => TCFH_REPORTS_HTTP_TIMEOUT,
        'body'    => array(
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ),
    ) );
    if ( is_wp_error( $resp ) ) return $resp;
    $json = json_decode( wp_remote_retrieve_body( $resp ), true );
    if ( empty( $json['access_token'] ) ) {
        $err = isset( $json['error_description'] ) ? $json['error_description'] : ( isset( $json['error'] ) ? $json['error'] : 'no access_token' );
        return new WP_Error( 'token', 'SA token exchange failed: ' . $err );
    }
    $ttl = isset( $json['expires_in'] ) ? (int) $json['expires_in'] : 3500;
    set_transient( 'tcfh_rep_' . md5( $cache_key ), array(
        'token'      => $json['access_token'],
        'expires_at' => time() + $ttl,
    ), $ttl );
    return $json['access_token'];
}

/**
 * Exchanges an installed-app refresh token for an access token (for Google Ads).
 */
function tcfh_reports_oauth_refresh_access_token( $client_id, $client_secret, $refresh_token ) {
    if ( ! $client_id || ! $client_secret || ! $refresh_token ) {
        return new WP_Error( 'no_oauth', 'Google Ads OAuth credentials not configured' );
    }
    $cache_key = 'oauth_tok_' . md5( $client_id . '|' . $refresh_token );
    $cached = get_transient( 'tcfh_rep_' . md5( $cache_key ) );
    if ( $cached && ! empty( $cached['expires_at'] ) && $cached['expires_at'] > time() + 60 ) {
        return $cached['token'];
    }
    $resp = wp_remote_post( 'https://oauth2.googleapis.com/token', array(
        'timeout' => TCFH_REPORTS_HTTP_TIMEOUT,
        'body'    => array(
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refresh_token,
            'grant_type'    => 'refresh_token',
        ),
    ) );
    if ( is_wp_error( $resp ) ) return $resp;
    $json = json_decode( wp_remote_retrieve_body( $resp ), true );
    if ( empty( $json['access_token'] ) ) {
        $err = isset( $json['error_description'] ) ? $json['error_description'] : 'no access_token';
        return new WP_Error( 'token', 'OAuth refresh failed: ' . $err );
    }
    $ttl = isset( $json['expires_in'] ) ? (int) $json['expires_in'] : 3500;
    set_transient( 'tcfh_rep_' . md5( $cache_key ), array(
        'token'      => $json['access_token'],
        'expires_at' => time() + $ttl,
    ), $ttl );
    return $json['access_token'];
}

/* ── GA4 Data API ───────────────────────────────────────────────────────── */

function tcfh_reports_ga4_run( $body, $start, $end, $tag ) {
    $s = tcfh_reports_get_settings();
    if ( empty( $s['ga4_property_id'] ) || empty( $s['ga4_sa_json'] ) ) {
        return new WP_Error( 'unconfigured', 'GA4 not configured' );
    }
    $cache_key = 'ga4|' . $s['ga4_property_id'] . '|' . $tag . '|' . $start . '|' . $end;
    $cached = tcfh_reports_cache_get( $cache_key );
    if ( $cached !== false ) return $cached;

    $token = tcfh_reports_sa_access_token( $s['ga4_sa_json'], 'https://www.googleapis.com/auth/analytics.readonly' );
    if ( is_wp_error( $token ) ) return $token;

    $url = 'https://analyticsdata.googleapis.com/v1beta/properties/' . rawurlencode( $s['ga4_property_id'] ) . ':runReport';
    $body['dateRanges'] = array( array( 'startDate' => $start, 'endDate' => $end ) );

    $json = tcfh_reports_http_json( 'POST', $url, array(
        'Authorization' => 'Bearer ' . $token,
        'Content-Type'  => 'application/json',
    ), $body );
    if ( is_wp_error( $json ) ) return $json;

    tcfh_reports_cache_set( $cache_key, $json );
    return $json;
}

function tcfh_reports_ga4_collect( $start, $end ) {
    $out = array(
        'visitors' => 0,
        'geo'      => array(),
        'pages'    => array(),
        'events'   => array(),
        'errors'   => array(),
    );

    $r = tcfh_reports_ga4_run( array(
        'metrics' => array( array( 'name' => 'activeUsers' ) ),
    ), $start, $end, 'visitors' );
    if ( is_wp_error( $r ) ) {
        $out['errors'][] = 'GA4 visitors: ' . $r->get_error_message();
    } elseif ( ! empty( $r['rows'][0]['metricValues'][0]['value'] ) ) {
        $out['visitors'] = (int) $r['rows'][0]['metricValues'][0]['value'];
    }

    $r = tcfh_reports_ga4_run( array(
        'dimensions' => array( array( 'name' => 'city' ) ),
        'metrics'    => array( array( 'name' => 'activeUsers' ) ),
        'orderBys'   => array( array( 'metric' => array( 'metricName' => 'activeUsers' ), 'desc' => true ) ),
        'limit'      => 10,
    ), $start, $end, 'geo' );
    if ( is_wp_error( $r ) ) {
        $out['errors'][] = 'GA4 geo: ' . $r->get_error_message();
    } else {
        foreach ( ( $r['rows'] ?? array() ) as $row ) {
            $city = $row['dimensionValues'][0]['value'] ?? '';
            if ( $city === '' || $city === '(not set)' ) continue;
            $out['geo'][] = array(
                'city'     => $city,
                'visitors' => (int) ( $row['metricValues'][0]['value'] ?? 0 ),
            );
        }
    }

    $r = tcfh_reports_ga4_run( array(
        'dimensions' => array( array( 'name' => 'pagePath' ), array( 'name' => 'pageTitle' ) ),
        'metrics'    => array( array( 'name' => 'screenPageViews' ) ),
        'orderBys'   => array( array( 'metric' => array( 'metricName' => 'screenPageViews' ), 'desc' => true ) ),
        'limit'      => 10,
    ), $start, $end, 'pages' );
    if ( is_wp_error( $r ) ) {
        $out['errors'][] = 'GA4 pages: ' . $r->get_error_message();
    } else {
        foreach ( ( $r['rows'] ?? array() ) as $row ) {
            $out['pages'][] = array(
                'path'  => $row['dimensionValues'][0]['value'] ?? '',
                'title' => $row['dimensionValues'][1]['value'] ?? '',
                'views' => (int) ( $row['metricValues'][0]['value'] ?? 0 ),
            );
        }
    }

    // GA4 "click" events: any event whose name contains "click" (catches the
    // default `click` event from enhanced measurement and any custom names).
    $r = tcfh_reports_ga4_run( array(
        'dimensions'     => array( array( 'name' => 'eventName' ) ),
        'metrics'        => array( array( 'name' => 'eventCount' ) ),
        'dimensionFilter'=> array( 'filter' => array(
            'fieldName'   => 'eventName',
            'stringFilter'=> array( 'matchType' => 'CONTAINS', 'value' => 'click', 'caseSensitive' => false ),
        ) ),
        'orderBys' => array( array( 'metric' => array( 'metricName' => 'eventCount' ), 'desc' => true ) ),
        'limit'    => 10,
    ), $start, $end, 'events' );
    if ( is_wp_error( $r ) ) {
        $out['errors'][] = 'GA4 events: ' . $r->get_error_message();
    } else {
        foreach ( ( $r['rows'] ?? array() ) as $row ) {
            $out['events'][] = array(
                'name'  => $row['dimensionValues'][0]['value'] ?? '',
                'count' => (int) ( $row['metricValues'][0]['value'] ?? 0 ),
            );
        }
    }

    return $out;
}

/* ── Search Console API ─────────────────────────────────────────────────── */

function tcfh_reports_gsc_collect( $start, $end ) {
    $s = tcfh_reports_get_settings();
    $out = array( 'keywords' => array(), 'errors' => array() );

    if ( empty( $s['gsc_site_url'] ) ) {
        $out['errors'][] = 'GSC: site URL not configured';
        return $out;
    }
    $sa = $s['gsc_sa_json'] ?: $s['ga4_sa_json'];
    if ( empty( $sa ) ) {
        $out['errors'][] = 'GSC: service account JSON not configured';
        return $out;
    }

    $cache_key = 'gsc|' . $s['gsc_site_url'] . '|' . $start . '|' . $end;
    $cached = tcfh_reports_cache_get( $cache_key );
    if ( $cached === false ) {
        $token = tcfh_reports_sa_access_token( $sa, 'https://www.googleapis.com/auth/webmasters.readonly' );
        if ( is_wp_error( $token ) ) {
            $out['errors'][] = 'GSC auth: ' . $token->get_error_message();
            return $out;
        }
        $url = 'https://www.googleapis.com/webmasters/v3/sites/' . rawurlencode( $s['gsc_site_url'] ) . '/searchAnalytics/query';
        $body = array(
            'startDate'  => $start,
            'endDate'    => $end,
            'dimensions' => array( 'query' ),
            'rowLimit'   => 10,
        );
        $json = tcfh_reports_http_json( 'POST', $url, array(
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ), $body );
        if ( is_wp_error( $json ) ) {
            $out['errors'][] = 'GSC query: ' . $json->get_error_message();
            return $out;
        }
        tcfh_reports_cache_set( $cache_key, $json );
        $cached = $json;
    }

    foreach ( ( $cached['rows'] ?? array() ) as $row ) {
        $out['keywords'][] = array(
            'query'       => $row['keys'][0] ?? '',
            'position'    => round( (float) ( $row['position'] ?? 0 ), 1 ),
            'clicks'      => (int) ( $row['clicks'] ?? 0 ),
            'impressions' => (int) ( $row['impressions'] ?? 0 ),
            'ctr'         => round( ( (float) ( $row['ctr'] ?? 0 ) ) * 100, 1 ),
        );
    }
    return $out;
}

/* ── Google Ads API ─────────────────────────────────────────────────────── */

function tcfh_reports_gads_collect( $start, $end ) {
    $s = tcfh_reports_get_settings();
    $out = array(
        'cost'         => 0.0,
        'impressions'  => 0,
        'clicks'       => 0,
        'avg_cpc'      => 0.0,
        'top_keywords' => array(),
        'errors'       => array(),
    );

    foreach ( array( 'gads_developer_token', 'gads_client_id', 'gads_client_secret', 'gads_refresh_token', 'gads_customer_id' ) as $k ) {
        if ( empty( $s[ $k ] ) ) {
            $out['errors'][] = 'Google Ads: missing ' . $k;
            return $out;
        }
    }
    $customer_id = preg_replace( '/[^0-9]/', '', $s['gads_customer_id'] );

    $cache_key = 'gads|' . $customer_id . '|' . $start . '|' . $end;
    $cached = tcfh_reports_cache_get( $cache_key );
    if ( $cached === false ) {
        $token = tcfh_reports_oauth_refresh_access_token( $s['gads_client_id'], $s['gads_client_secret'], $s['gads_refresh_token'] );
        if ( is_wp_error( $token ) ) {
            $out['errors'][] = 'GAds auth: ' . $token->get_error_message();
            return $out;
        }

        $headers = array(
            'Authorization'   => 'Bearer ' . $token,
            'developer-token' => $s['gads_developer_token'],
            'Content-Type'    => 'application/json',
        );
        if ( ! empty( $s['gads_login_customer_id'] ) ) {
            $headers['login-customer-id'] = preg_replace( '/[^0-9]/', '', $s['gads_login_customer_id'] );
        }

        // Account-level totals.
        $gaql_totals = sprintf(
            "SELECT metrics.cost_micros, metrics.impressions, metrics.clicks, metrics.average_cpc "
            . "FROM customer WHERE segments.date BETWEEN '%s' AND '%s'",
            esc_sql( $start ), esc_sql( $end )
        );
        $url = 'https://googleads.googleapis.com/v17/customers/' . $customer_id . '/googleAds:search';
        $totals = tcfh_reports_http_json( 'POST', $url, $headers, array( 'query' => $gaql_totals ) );
        if ( is_wp_error( $totals ) ) {
            $out['errors'][] = 'GAds totals: ' . $totals->get_error_message();
        }

        // Top keywords by cost (used for the "fix this" suggestion).
        $gaql_kw = sprintf(
            "SELECT ad_group_criterion.keyword.text, metrics.cost_micros, metrics.clicks, metrics.average_cpc "
            . "FROM keyword_view WHERE segments.date BETWEEN '%s' AND '%s' "
            . "ORDER BY metrics.cost_micros DESC LIMIT 10",
            esc_sql( $start ), esc_sql( $end )
        );
        $kws = tcfh_reports_http_json( 'POST', $url, $headers, array( 'query' => $gaql_kw ) );
        if ( is_wp_error( $kws ) ) {
            $out['errors'][] = 'GAds keywords: ' . $kws->get_error_message();
        }

        $cached = array( 'totals' => $totals, 'kws' => $kws );
        tcfh_reports_cache_set( $cache_key, $cached );
    }

    $totals = $cached['totals'] ?? null;
    if ( is_array( $totals ) && ! empty( $totals['results'] ) ) {
        $cost_micros = 0; $impr = 0; $clicks = 0; $cpc_micros_sum = 0; $n = 0;
        foreach ( $totals['results'] as $row ) {
            $m = $row['metrics'] ?? array();
            $cost_micros += (int) ( $m['costMicros'] ?? 0 );
            $impr        += (int) ( $m['impressions'] ?? 0 );
            $clicks      += (int) ( $m['clicks'] ?? 0 );
            if ( isset( $m['averageCpc'] ) ) { $cpc_micros_sum += (int) $m['averageCpc']; $n++; }
        }
        $out['cost']        = $cost_micros / 1e6;
        $out['impressions'] = $impr;
        $out['clicks']      = $clicks;
        $out['avg_cpc']     = $clicks > 0 ? ( $cost_micros / 1e6 ) / $clicks : 0;
    }

    $kws = $cached['kws'] ?? null;
    if ( is_array( $kws ) && ! empty( $kws['results'] ) ) {
        foreach ( $kws['results'] as $row ) {
            $kw = $row['adGroupCriterion']['keyword']['text'] ?? '';
            $m  = $row['metrics'] ?? array();
            $out['top_keywords'][] = array(
                'keyword' => $kw,
                'cost'    => ( (int) ( $m['costMicros'] ?? 0 ) ) / 1e6,
                'clicks'  => (int) ( $m['clicks'] ?? 0 ),
                'cpc'     => ( (int) ( $m['averageCpc'] ?? 0 ) ) / 1e6,
            );
        }
    }

    return $out;
}

/* ── Data assembly + insights ───────────────────────────────────────────── */

function tcfh_reports_collect( $start, $end, $force_fresh = false ) {
    if ( $force_fresh ) {
        global $wpdb;
        // Cheapest invalidation: nuke our prefix.
        $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_tcfh_rep_%' OR option_name LIKE '_transient_timeout_tcfh_rep_%'" );
    }

    $ga4  = tcfh_reports_ga4_collect( $start, $end );
    $gsc  = tcfh_reports_gsc_collect( $start, $end );
    $gads = tcfh_reports_gads_collect( $start, $end );

    $errors = array_merge( $ga4['errors'] ?? array(), $gsc['errors'] ?? array(), $gads['errors'] ?? array() );

    $insights = tcfh_reports_build_insights( $ga4, $gsc, $gads );

    return array(
        'ga4'      => $ga4,
        'gsc'      => $gsc,
        'gads'     => $gads,
        'insights' => $insights,
        'errors'   => $errors,
    );
}

/**
 * Computes the "fix this" and "you're doing well" callouts.
 * Fix-this priority: highest-CPC Ads keyword > worst-ranked GSC keyword > lowest-views page.
 * Good-job priority: best-ranked GSC keyword (pos ≤ 10) > top page.
 */
function tcfh_reports_build_insights( $ga4, $gsc, $gads ) {
    $fix = null; $good = null;

    if ( ! empty( $gads['top_keywords'] ) ) {
        $worst = null;
        foreach ( $gads['top_keywords'] as $k ) {
            if ( $k['cpc'] > 0 && ( $worst === null || $k['cpc'] > $worst['cpc'] ) ) $worst = $k;
        }
        if ( $worst ) {
            $fix = sprintf(
                'Highest-CPC Ads keyword: "%s" at $%.2f/click (%d clicks, $%.2f spent). Consider tightening match type or pausing.',
                $worst['keyword'], $worst['cpc'], $worst['clicks'], $worst['cost']
            );
        }
    }
    if ( ! $fix && ! empty( $gsc['keywords'] ) ) {
        $worst = null;
        foreach ( $gsc['keywords'] as $k ) {
            if ( $k['impressions'] >= 10 && ( $worst === null || $k['position'] > $worst['position'] ) ) $worst = $k;
        }
        if ( $worst ) {
            $fix = sprintf(
                'Lowest-ranking keyword with traction: "%s" at avg position %.1f (%d impressions, %d clicks). Worth a content refresh.',
                $worst['query'], $worst['position'], $worst['impressions'], $worst['clicks']
            );
        }
    }
    if ( ! $fix && ! empty( $ga4['pages'] ) ) {
        $least = end( $ga4['pages'] );
        if ( $least && $least['views'] > 0 ) {
            $fix = sprintf( 'Lowest-traffic page in your top 10: %s (%d views). May need internal links or a stronger headline.', $least['path'], $least['views'] );
        }
    }

    if ( ! empty( $gsc['keywords'] ) ) {
        $best = null;
        foreach ( $gsc['keywords'] as $k ) {
            if ( $k['position'] > 0 && $k['position'] <= 10 && ( $best === null || $k['position'] < $best['position'] ) ) $best = $k;
        }
        if ( $best ) {
            $good = sprintf(
                'Ranking strong on "%s" — avg position %.1f, %d clicks. Keep that page fresh.',
                $best['query'], $best['position'], $best['clicks']
            );
        }
    }
    if ( ! $good && ! empty( $ga4['pages'] ) ) {
        $top = $ga4['pages'][0];
        $good = sprintf( 'Top page: %s with %d views. Whatever you did there is working.', $top['path'], $top['views'] );
    }

    if ( ! $fix )  $fix  = 'No clear pain point in this window. Keep an eye on CPC trend.';
    if ( ! $good ) $good = 'Not enough data yet for a callout — check back when traffic builds.';

    return array( 'fix' => $fix, 'good' => $good );
}

/* ── HTML email renderer (inline CSS, Gmail-safe) ───────────────────────── */

function tcfh_reports_render_email( $type, $label, $start, $end, $data ) {
    $ga4  = $data['ga4'];
    $gsc  = $data['gsc'];
    $gads = $data['gads'];
    $ins  = $data['insights'];

    $brand   = '#0f3a5f';
    $accent  = '#c19a37';
    $bg      = '#f5f6f8';
    $card    = '#ffffff';
    $text    = '#222';
    $muted   = '#666';
    $border  = '#e3e6ec';
    $good_bg = '#e7f5ec'; $good_fg = '#1b6b3a';
    $warn_bg = '#fdecec'; $warn_fg = '#9b1c1c';

    $title = ucfirst( $type ) . ' Stats — ' . $label;

    ob_start(); ?>
<!doctype html>
<html><head><meta charset="utf-8"><title><?php echo esc_html( $title ); ?></title></head>
<body style="margin:0;padding:0;background:<?php echo $bg; ?>;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Helvetica,Arial,sans-serif;color:<?php echo $text; ?>;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:<?php echo $bg; ?>;padding:24px 0;">
  <tr><td align="center">
    <table role="presentation" width="640" cellpadding="0" cellspacing="0" style="max-width:640px;background:<?php echo $card; ?>;border:1px solid <?php echo $border; ?>;border-radius:8px;overflow:hidden;">

      <tr><td style="background:<?php echo $brand; ?>;padding:22px 28px;color:#fff;">
        <div style="font-size:13px;letter-spacing:1px;text-transform:uppercase;opacity:.85;"><?php echo esc_html( ucfirst( $type ) ); ?> Report</div>
        <div style="font-size:22px;font-weight:700;margin-top:4px;"><?php echo esc_html( $label ); ?></div>
        <div style="font-size:12px;opacity:.75;margin-top:6px;"><?php echo esc_html( $start . ' → ' . $end ); ?></div>
      </td></tr>

      <?php // ── Headline stat boxes ───────────────────────────────────── ?>
      <tr><td style="padding:24px 28px 8px 28px;">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <?php
            $boxes = array(
                array( 'Visitors',     number_format_i18n( (int) $ga4['visitors'] ),                            $brand ),
                array( 'Ad Spend',     '$' . number_format_i18n( $gads['cost'], 2 ),                            $accent ),
                array( 'Ad Clicks',    number_format_i18n( (int) $gads['clicks'] ),                             '#2d7a4f' ),
                array( 'Avg CPC',      $gads['clicks'] > 0 ? '$' . number_format_i18n( $gads['avg_cpc'], 2 ) : '—', '#7a4a8f' ),
            );
            foreach ( $boxes as $i => $b ) :
                $pad = $i < count( $boxes ) - 1 ? 'padding-right:8px;' : '';
            ?>
            <td width="25%" valign="top" style="<?php echo $pad; ?>">
              <div style="background:#fbfbfd;border:1px solid <?php echo $border; ?>;border-left:4px solid <?php echo $b[2]; ?>;border-radius:6px;padding:14px 12px;">
                <div style="font-size:11px;color:<?php echo $muted; ?>;letter-spacing:.5px;text-transform:uppercase;"><?php echo esc_html( $b[0] ); ?></div>
                <div style="font-size:22px;font-weight:700;margin-top:4px;color:<?php echo $b[2]; ?>;"><?php echo esc_html( $b[1] ); ?></div>
              </div>
            </td>
            <?php endforeach; ?>
          </tr>
        </table>
      </td></tr>

      <?php // ── Insight callouts ──────────────────────────────────────── ?>
      <tr><td style="padding:18px 28px 4px 28px;">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%" valign="top" style="padding-right:8px;">
              <div style="background:<?php echo $good_bg; ?>;color:<?php echo $good_fg; ?>;border-radius:6px;padding:14px 16px;">
                <div style="font-size:12px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">You're doing well</div>
                <div style="font-size:14px;margin-top:6px;line-height:1.45;"><?php echo esc_html( $ins['good'] ); ?></div>
              </div>
            </td>
            <td width="50%" valign="top" style="padding-left:8px;">
              <div style="background:<?php echo $warn_bg; ?>;color:<?php echo $warn_fg; ?>;border-radius:6px;padding:14px 16px;">
                <div style="font-size:12px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Fix this</div>
                <div style="font-size:14px;margin-top:6px;line-height:1.45;"><?php echo esc_html( $ins['fix'] ); ?></div>
              </div>
            </td>
          </tr>
        </table>
      </td></tr>

      <?php
        // Section helper output.
        $h2 = 'font-size:14px;font-weight:700;color:' . $brand . ';letter-spacing:.5px;text-transform:uppercase;margin:0 0 10px 0;';
        $td = 'padding:8px 10px;border-bottom:1px solid ' . $border . ';font-size:13px;color:' . $text . ';';
        $th = 'padding:8px 10px;border-bottom:2px solid ' . $border . ';font-size:11px;color:' . $muted . ';letter-spacing:.5px;text-transform:uppercase;text-align:left;';
      ?>

      <?php // ── Geo ───────────────────────────────────────────────────── ?>
      <tr><td style="padding:20px 28px 0 28px;">
        <h2 style="<?php echo $h2; ?>">Where Visitors Came From</h2>
        <?php if ( empty( $ga4['geo'] ) ) : ?>
          <div style="font-size:13px;color:<?php echo $muted; ?>;">No city data available.</div>
        <?php else : ?>
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tr><th style="<?php echo $th; ?>">City</th><th style="<?php echo $th; ?>text-align:right;">Visitors</th></tr>
            <?php foreach ( $ga4['geo'] as $g ) : ?>
              <tr><td style="<?php echo $td; ?>"><?php echo esc_html( $g['city'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;font-weight:600;"><?php echo number_format_i18n( $g['visitors'] ); ?></td></tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      </td></tr>

      <?php // ── Top pages ─────────────────────────────────────────────── ?>
      <tr><td style="padding:20px 28px 0 28px;">
        <h2 style="<?php echo $h2; ?>">Top Pages (by views)</h2>
        <?php if ( empty( $ga4['pages'] ) ) : ?>
          <div style="font-size:13px;color:<?php echo $muted; ?>;">No page data available.</div>
        <?php else : ?>
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tr><th style="<?php echo $th; ?>">Page</th><th style="<?php echo $th; ?>text-align:right;">Views</th></tr>
            <?php foreach ( $ga4['pages'] as $p ) : ?>
              <tr><td style="<?php echo $td; ?>">
                  <div style="font-weight:600;"><?php echo esc_html( $p['title'] ?: $p['path'] ); ?></div>
                  <?php if ( $p['title'] ) : ?><div style="font-size:11px;color:<?php echo $muted; ?>;"><?php echo esc_html( $p['path'] ); ?></div><?php endif; ?>
                  </td>
                  <td style="<?php echo $td; ?>text-align:right;font-weight:600;"><?php echo number_format_i18n( $p['views'] ); ?></td></tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      </td></tr>

      <?php // ── Click events ──────────────────────────────────────────── ?>
      <tr><td style="padding:20px 28px 0 28px;">
        <h2 style="<?php echo $h2; ?>">Clicks &amp; Events</h2>
        <?php if ( empty( $ga4['events'] ) ) : ?>
          <div style="font-size:13px;color:<?php echo $muted; ?>;">No click events tracked in this window.</div>
        <?php else : ?>
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tr><th style="<?php echo $th; ?>">Event</th><th style="<?php echo $th; ?>text-align:right;">Count</th></tr>
            <?php foreach ( $ga4['events'] as $e ) : ?>
              <tr><td style="<?php echo $td; ?>"><?php echo esc_html( $e['name'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;font-weight:600;"><?php echo number_format_i18n( $e['count'] ); ?></td></tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      </td></tr>

      <?php // ── Google Ads detail ─────────────────────────────────────── ?>
      <tr><td style="padding:20px 28px 0 28px;">
        <h2 style="<?php echo $h2; ?>">Google Ads</h2>
        <div style="font-size:13px;color:<?php echo $text; ?>;margin-bottom:10px;">
          <strong><?php echo number_format_i18n( $gads['impressions'] ); ?></strong> impressions &nbsp;·&nbsp;
          <strong><?php echo number_format_i18n( $gads['clicks'] ); ?></strong> clicks &nbsp;·&nbsp;
          spent <strong>$<?php echo number_format_i18n( $gads['cost'], 2 ); ?></strong>
          <?php if ( $gads['clicks'] > 0 ) : ?> &nbsp;·&nbsp; avg CPC <strong>$<?php echo number_format_i18n( $gads['avg_cpc'], 2 ); ?></strong><?php endif; ?>
        </div>
        <?php if ( ! empty( $gads['top_keywords'] ) ) : ?>
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tr><th style="<?php echo $th; ?>">Keyword</th><th style="<?php echo $th; ?>text-align:right;">Clicks</th><th style="<?php echo $th; ?>text-align:right;">CPC</th><th style="<?php echo $th; ?>text-align:right;">Spend</th></tr>
            <?php foreach ( $gads['top_keywords'] as $k ) : ?>
              <tr><td style="<?php echo $td; ?>"><?php echo esc_html( $k['keyword'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;"><?php echo number_format_i18n( $k['clicks'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;">$<?php echo number_format_i18n( $k['cpc'], 2 ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;font-weight:600;">$<?php echo number_format_i18n( $k['cost'], 2 ); ?></td></tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      </td></tr>

      <?php // ── Search Console ────────────────────────────────────────── ?>
      <tr><td style="padding:20px 28px 0 28px;">
        <h2 style="<?php echo $h2; ?>">Top Ranking Keywords (Search Console)</h2>
        <?php if ( empty( $gsc['keywords'] ) ) : ?>
          <div style="font-size:13px;color:<?php echo $muted; ?>;">No Search Console data available.</div>
        <?php else : ?>
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tr><th style="<?php echo $th; ?>">Query</th><th style="<?php echo $th; ?>text-align:right;">Pos</th><th style="<?php echo $th; ?>text-align:right;">Clicks</th><th style="<?php echo $th; ?>text-align:right;">Impr</th><th style="<?php echo $th; ?>text-align:right;">CTR</th></tr>
            <?php foreach ( $gsc['keywords'] as $k ) : ?>
              <tr><td style="<?php echo $td; ?>"><?php echo esc_html( $k['query'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;font-weight:600;"><?php echo esc_html( $k['position'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;"><?php echo number_format_i18n( $k['clicks'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;"><?php echo number_format_i18n( $k['impressions'] ); ?></td>
                  <td style="<?php echo $td; ?>text-align:right;"><?php echo esc_html( $k['ctr'] ); ?>%</td></tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      </td></tr>

      <?php if ( ! empty( $data['errors'] ) ) : ?>
      <tr><td style="padding:18px 28px 0 28px;">
        <div style="background:#fff8e1;border:1px solid #f0d97a;border-radius:6px;padding:12px 14px;font-size:12px;color:#7a5b00;">
          <strong>Heads up:</strong> some data sources had issues —
          <ul style="margin:6px 0 0 18px;padding:0;">
            <?php foreach ( $data['errors'] as $e ) : ?><li><?php echo esc_html( $e ); ?></li><?php endforeach; ?>
          </ul>
        </div>
      </td></tr>
      <?php endif; ?>

      <tr><td style="padding:24px 28px;color:<?php echo $muted; ?>;font-size:11px;border-top:1px solid <?php echo $border; ?>;margin-top:20px;">
        Sent <?php echo esc_html( wp_date( 'M j, Y g:i a T' ) ); ?> by TCFH Reports.
        Manage at WP Admin → Settings → Daily Reports.
      </td></tr>

    </table>
  </td></tr>
</table>
</body></html>
    <?php
    return ob_get_clean();
}

/* ── Admin: Settings → Daily Reports ────────────────────────────────────── */

function tcfh_reports_admin_menu() {
    add_options_page(
        'Daily Reports',
        'Daily Reports',
        'manage_options',
        'tcfh-reports',
        'tcfh_reports_admin_page'
    );
}
add_action( 'admin_menu', 'tcfh_reports_admin_menu' );

function tcfh_reports_admin_handle_actions() {
    if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'tcfh-reports' ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;

    if ( isset( $_POST['tcfh_reports_action'] ) ) {
        $action = sanitize_text_field( $_POST['tcfh_reports_action'] );

        if ( $action === 'save_settings' ) {
            check_admin_referer( 'tcfh_reports_save' );
            $current = get_option( TCFH_REPORTS_OPTION_KEY, array() );
            if ( ! is_array( $current ) ) $current = array();
            $fields = array(
                'recipient'              => 'sanitize_email',
                'ga4_property_id'        => 'sanitize_text_field',
                'gsc_site_url'           => 'esc_url_raw',
                'gads_developer_token'   => 'sanitize_text_field',
                'gads_client_id'         => 'sanitize_text_field',
                'gads_client_secret'     => 'sanitize_text_field',
                'gads_refresh_token'     => 'sanitize_text_field',
                'gads_customer_id'       => 'sanitize_text_field',
                'gads_login_customer_id' => 'sanitize_text_field',
            );
            foreach ( $fields as $key => $cb ) {
                if ( isset( $_POST[ $key ] ) ) {
                    $current[ $key ] = call_user_func( $cb, wp_unslash( $_POST[ $key ] ) );
                }
            }
            // JSON blobs: keep raw so newlines/quotes survive; validate as JSON.
            foreach ( array( 'ga4_sa_json', 'gsc_sa_json' ) as $jk ) {
                if ( isset( $_POST[ $jk ] ) ) {
                    $raw = trim( wp_unslash( $_POST[ $jk ] ) );
                    if ( $raw !== '' && json_decode( $raw, true ) === null ) {
                        wp_safe_redirect( add_query_arg( array( 'page' => 'tcfh-reports', 'tcfh_msg' => 'bad_json', 'tcfh_field' => $jk ), admin_url( 'options-general.php' ) ) );
                        exit;
                    }
                    $current[ $jk ] = $raw;
                }
            }
            update_option( TCFH_REPORTS_OPTION_KEY, $current, false );
            wp_safe_redirect( add_query_arg( array( 'page' => 'tcfh-reports', 'tcfh_msg' => 'saved' ), admin_url( 'options-general.php' ) ) );
            exit;
        }

        if ( $action === 'test_send' ) {
            check_admin_referer( 'tcfh_reports_test' );
            $type = isset( $_POST['report_type'] ) ? sanitize_text_field( $_POST['report_type'] ) : 'daily';
            if ( ! in_array( $type, array( 'daily', 'monthly', 'yearly' ), true ) ) $type = 'daily';
            $force = ! empty( $_POST['force_fresh'] );
            $r = tcfh_reports_dispatch( $type, $force );
            $msg = $r['ok'] ? ( $r['error'] ? 'test_partial' : 'test_sent' ) : 'test_failed';
            wp_safe_redirect( add_query_arg( array(
                'page'      => 'tcfh-reports',
                'tcfh_msg'  => $msg,
                'tcfh_type' => $type,
                'tcfh_err'  => $r['error'] ? rawurlencode( substr( $r['error'], 0, 200 ) ) : '',
            ), admin_url( 'options-general.php' ) ) );
            exit;
        }
    }
}
add_action( 'admin_init', 'tcfh_reports_admin_handle_actions' );

function tcfh_reports_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $s = tcfh_reports_get_settings();

    // Notices.
    if ( isset( $_GET['tcfh_msg'] ) ) {
        $msg  = sanitize_text_field( $_GET['tcfh_msg'] );
        $type = isset( $_GET['tcfh_type'] ) ? sanitize_text_field( $_GET['tcfh_type'] ) : '';
        $err  = isset( $_GET['tcfh_err'] )  ? sanitize_text_field( wp_unslash( $_GET['tcfh_err'] ) ) : '';
        $notice = '';
        $class  = 'notice-success';
        switch ( $msg ) {
            case 'saved':         $notice = 'Settings saved.'; break;
            case 'bad_json':      $notice = 'Service account JSON failed to parse — paste the full JSON file contents.'; $class = 'notice-error'; break;
            case 'test_sent':     $notice = ucfirst( $type ) . ' test report sent to ' . esc_html( tcfh_reports_recipient() ) . '.'; break;
            case 'test_partial':  $notice = ucfirst( $type ) . ' test sent, but with errors: ' . esc_html( $err ); $class = 'notice-warning'; break;
            case 'test_failed':   $notice = ucfirst( $type ) . ' test failed: ' . esc_html( $err ); $class = 'notice-error'; break;
        }
        if ( $notice ) echo '<div class="notice ' . esc_attr( $class ) . ' is-dismissible"><p>' . $notice . '</p></div>';
    }

    // Which fields are locked by a wp-config.php constant.
    $const_map = array(
        'recipient'              => 'TCFH_REPORTS_RECIPIENT',
        'ga4_sa_json'            => 'TCFH_REPORTS_GA4_SA_JSON',
        'ga4_property_id'        => 'TCFH_REPORTS_GA4_PROPERTY_ID',
        'gsc_site_url'           => 'TCFH_REPORTS_GSC_SITE_URL',
        'gsc_sa_json'            => 'TCFH_REPORTS_GSC_SA_JSON',
        'gads_developer_token'   => 'TCFH_REPORTS_GADS_DEVELOPER_TOKEN',
        'gads_client_id'         => 'TCFH_REPORTS_GADS_CLIENT_ID',
        'gads_client_secret'     => 'TCFH_REPORTS_GADS_CLIENT_SECRET',
        'gads_refresh_token'     => 'TCFH_REPORTS_GADS_REFRESH_TOKEN',
        'gads_customer_id'       => 'TCFH_REPORTS_GADS_CUSTOMER_ID',
        'gads_login_customer_id' => 'TCFH_REPORTS_GADS_LOGIN_CUSTOMER_ID',
    );
    $locked = function( $key ) use ( $const_map ) {
        return defined( $const_map[ $key ] ) ? ' disabled readonly' : '';
    };
    $locked_note = function( $key ) use ( $const_map ) {
        return defined( $const_map[ $key ] ) ? ' <em style="color:#888;">(locked by ' . esc_html( $const_map[ $key ] ) . ')</em>' : '';
    };

    $next_daily   = wp_next_scheduled( 'tcfh_report_daily' );
    $next_monthly = wp_next_scheduled( 'tcfh_report_monthly' );
    $next_yearly  = wp_next_scheduled( 'tcfh_report_yearly' );

    ?>
    <div class="wrap">
      <h1>Daily Reports</h1>
      <p style="max-width:800px;">Pulls GA4, Google Ads, and Search Console data and emails a formatted summary on a schedule.
        Daily reports go out every morning at <strong>8:00 AM <?php echo esc_html( TCFH_REPORTS_TIMEZONE ); ?></strong>;
        monthly on the 1st; yearly on January 1st. Reports go to <strong><?php echo esc_html( tcfh_reports_recipient() ); ?></strong>.</p>

      <h2 class="title">Schedule</h2>
      <table class="widefat striped" style="max-width:800px;">
        <thead><tr><th>Report</th><th>Next run</th></tr></thead>
        <tbody>
          <tr><td>Daily</td>   <td><?php echo $next_daily   ? esc_html( wp_date( 'M j, Y g:i a T', $next_daily ) )   : '<em>not scheduled</em>'; ?></td></tr>
          <tr><td>Monthly</td> <td><?php echo $next_monthly ? esc_html( wp_date( 'M j, Y g:i a T', $next_monthly ) ) : '<em>not scheduled</em>'; ?></td></tr>
          <tr><td>Yearly</td>  <td><?php echo $next_yearly  ? esc_html( wp_date( 'M j, Y g:i a T', $next_yearly ) )  : '<em>not scheduled</em>'; ?></td></tr>
        </tbody>
      </table>

      <h2 class="title" style="margin-top:24px;">Send Test Email</h2>
      <p>Sends a real report for the period that matches each type (daily = yesterday, monthly = last month, yearly = last year). "Force fresh" bypasses the API cache.</p>
      <?php foreach ( array( 'daily', 'monthly', 'yearly' ) as $t ) : ?>
        <form method="post" style="display:inline-block;margin-right:8px;">
          <?php wp_nonce_field( 'tcfh_reports_test' ); ?>
          <input type="hidden" name="tcfh_reports_action" value="test_send">
          <input type="hidden" name="report_type" value="<?php echo esc_attr( $t ); ?>">
          <label style="font-size:12px;margin-right:6px;"><input type="checkbox" name="force_fresh" value="1"> fresh</label>
          <button class="button button-primary">Send <?php echo esc_html( ucfirst( $t ) ); ?> Test</button>
        </form>
      <?php endforeach; ?>

      <h2 class="title" style="margin-top:32px;">API Credentials</h2>
      <form method="post">
        <?php wp_nonce_field( 'tcfh_reports_save' ); ?>
        <input type="hidden" name="tcfh_reports_action" value="save_settings">

        <table class="form-table" role="presentation">
          <tr><th><label for="recipient">Recipient email</label></th>
              <td><input id="recipient" name="recipient" type="email" class="regular-text" value="<?php echo esc_attr( $s['recipient'] ); ?>"<?php echo $locked( 'recipient' ); ?>><?php echo $locked_note( 'recipient' ); ?></td></tr>
        </table>

        <h3>Google Analytics 4</h3>
        <p class="description" style="max-width:800px;">Create a service account in Google Cloud, enable the <em>Google Analytics Data API</em>, download its JSON key, and add the service account email as a viewer in GA4 Admin → Property Access.</p>
        <table class="form-table" role="presentation">
          <tr><th><label for="ga4_property_id">GA4 Property ID</label></th>
              <td><input id="ga4_property_id" name="ga4_property_id" type="text" class="regular-text" value="<?php echo esc_attr( $s['ga4_property_id'] ); ?>" placeholder="e.g. 123456789"<?php echo $locked( 'ga4_property_id' ); ?>><?php echo $locked_note( 'ga4_property_id' ); ?></td></tr>
          <tr><th><label for="ga4_sa_json">Service Account JSON</label></th>
              <td><textarea id="ga4_sa_json" name="ga4_sa_json" rows="6" class="large-text code" placeholder='{"type":"service_account",...}'<?php echo $locked( 'ga4_sa_json' ); ?>><?php echo esc_textarea( $s['ga4_sa_json'] ); ?></textarea><?php echo $locked_note( 'ga4_sa_json' ); ?></td></tr>
        </table>

        <h3>Search Console</h3>
        <p class="description" style="max-width:800px;">Enable the <em>Search Console API</em> on the same GCP project, then add the service account email as a user in Search Console for your property.</p>
        <table class="form-table" role="presentation">
          <tr><th><label for="gsc_site_url">Site URL</label></th>
              <td><input id="gsc_site_url" name="gsc_site_url" type="text" class="regular-text" value="<?php echo esc_attr( $s['gsc_site_url'] ); ?>" placeholder="sc-domain:tncashforhomes.com  or  https://tncashforhomes.com/"<?php echo $locked( 'gsc_site_url' ); ?>><?php echo $locked_note( 'gsc_site_url' ); ?></td></tr>
          <tr><th><label for="gsc_sa_json">Service Account JSON</label></th>
              <td><textarea id="gsc_sa_json" name="gsc_sa_json" rows="6" class="large-text code" placeholder="Leave blank to reuse the GA4 service account"<?php echo $locked( 'gsc_sa_json' ); ?>><?php echo esc_textarea( $s['gsc_sa_json'] ); ?></textarea><?php echo $locked_note( 'gsc_sa_json' ); ?>
              <p class="description">Optional — if blank, falls back to the GA4 service account.</p></td></tr>
        </table>

        <h3>Google Ads</h3>
        <p class="description" style="max-width:800px;">Requires a Google Ads developer token (Tools → API Center) and an OAuth refresh token from an installed-app flow. Easiest way to get a refresh token: run Google's <a href="https://developers.google.com/google-ads/api/docs/oauth/cloud-project" target="_blank" rel="noopener">generate_user_credentials.py</a> sample or use OAuth Playground with the Ads scope.</p>
        <table class="form-table" role="presentation">
          <tr><th><label for="gads_developer_token">Developer Token</label></th>
              <td><input id="gads_developer_token" name="gads_developer_token" type="text" class="regular-text" value="<?php echo esc_attr( $s['gads_developer_token'] ); ?>"<?php echo $locked( 'gads_developer_token' ); ?>><?php echo $locked_note( 'gads_developer_token' ); ?></td></tr>
          <tr><th><label for="gads_client_id">OAuth Client ID</label></th>
              <td><input id="gads_client_id" name="gads_client_id" type="text" class="regular-text" value="<?php echo esc_attr( $s['gads_client_id'] ); ?>"<?php echo $locked( 'gads_client_id' ); ?>><?php echo $locked_note( 'gads_client_id' ); ?></td></tr>
          <tr><th><label for="gads_client_secret">OAuth Client Secret</label></th>
              <td><input id="gads_client_secret" name="gads_client_secret" type="text" class="regular-text" value="<?php echo esc_attr( $s['gads_client_secret'] ); ?>"<?php echo $locked( 'gads_client_secret' ); ?>><?php echo $locked_note( 'gads_client_secret' ); ?></td></tr>
          <tr><th><label for="gads_refresh_token">Refresh Token</label></th>
              <td><input id="gads_refresh_token" name="gads_refresh_token" type="text" class="regular-text" value="<?php echo esc_attr( $s['gads_refresh_token'] ); ?>"<?php echo $locked( 'gads_refresh_token' ); ?>><?php echo $locked_note( 'gads_refresh_token' ); ?></td></tr>
          <tr><th><label for="gads_customer_id">Customer ID</label></th>
              <td><input id="gads_customer_id" name="gads_customer_id" type="text" class="regular-text" value="<?php echo esc_attr( $s['gads_customer_id'] ); ?>" placeholder="1234567890 (no dashes)"<?php echo $locked( 'gads_customer_id' ); ?>><?php echo $locked_note( 'gads_customer_id' ); ?></td></tr>
          <tr><th><label for="gads_login_customer_id">Login Customer ID</label></th>
              <td><input id="gads_login_customer_id" name="gads_login_customer_id" type="text" class="regular-text" value="<?php echo esc_attr( $s['gads_login_customer_id'] ); ?>" placeholder="MCC ID, only if managed through an MCC"<?php echo $locked( 'gads_login_customer_id' ); ?>><?php echo $locked_note( 'gads_login_customer_id' ); ?>
              <p class="description">Optional — only needed if your Ads account sits under an MCC.</p></td></tr>
        </table>

        <p><button class="button button-primary">Save Settings</button></p>
      </form>

      <h2 class="title" style="margin-top:32px;">Send History</h2>
      <?php
      global $wpdb;
      $rows = $wpdb->get_results( 'SELECT * FROM ' . tcfh_reports_log_table() . ' ORDER BY id DESC LIMIT 50', ARRAY_A );
      if ( ! $rows ) {
          echo '<p><em>No reports have been sent yet.</em></p>';
      } else {
          echo '<table class="widefat striped"><thead><tr>'
            . '<th>Sent</th><th>Type</th><th>Period</th><th>Status</th><th>Subject</th><th>Notes</th>'
            . '</tr></thead><tbody>';
          foreach ( $rows as $r ) {
              $color = $r['status'] === 'sent' ? '#1b6b3a' : ( $r['status'] === 'partial' ? '#9b6b00' : '#9b1c1c' );
              echo '<tr>'
                . '<td>' . esc_html( $r['sent_at'] ) . '</td>'
                . '<td>' . esc_html( $r['report_type'] ) . '</td>'
                . '<td>' . esc_html( $r['period_start'] . ' → ' . $r['period_end'] ) . '</td>'
                . '<td><span style="color:' . $color . ';font-weight:600;">' . esc_html( $r['status'] ) . '</span></td>'
                . '<td>' . esc_html( $r['subject'] ) . '</td>'
                . '<td style="font-size:11px;color:#666;">' . esc_html( $r['error'] ) . '</td>'
                . '</tr>';
          }
          echo '</tbody></table>';
      }
      ?>
    </div>
    <?php
}
