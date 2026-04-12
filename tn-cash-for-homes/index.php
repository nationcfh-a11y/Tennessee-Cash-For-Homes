<?php get_header(); ?>

<div class="page-default" style="min-height: 60vh; padding: 60px 0;">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article>
          <h1><?php the_title(); ?></h1>
          <div class="prose"><?php the_content(); ?></div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p>No content found.</p>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
