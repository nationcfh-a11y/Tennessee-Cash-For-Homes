<?php get_header(); ?>

<main style="min-height: 60vh; padding: 60px 0;">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <article>
        <h1 style="margin-bottom: 32px;"><?php the_title(); ?></h1>
        <div class="prose"><?php the_content(); ?></div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php get_footer(); ?>
