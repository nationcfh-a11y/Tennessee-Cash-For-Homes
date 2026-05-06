<?php get_header(); ?>

<div class="page-default" style="min-height: 60vh; padding: 60px 0;">
  <div class="container">
    <?php if ( is_archive() || is_home() ) : ?>
      <header class="archive-header" style="margin-bottom: 32px;">
        <h1><?php echo esc_html( get_the_archive_title() ); ?></h1>
      </header>
    <?php endif; ?>

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="prose"><?php the_content(); ?></div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p>No content found.</p>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
