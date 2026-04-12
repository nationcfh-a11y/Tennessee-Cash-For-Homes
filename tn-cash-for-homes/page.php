<?php get_header(); ?>

<div class="page-default" style="min-height: 60vh; padding: 60px 0;">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <article>
        <h1 style="margin-bottom: 32px;"><?php the_title(); ?></h1>
        <div class="prose"><?php the_content(); ?></div>
      </article>
    <?php endwhile; ?>
  </div>
</div>

<?php get_footer(); ?>
