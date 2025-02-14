<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
<!-- content -->
<?php  $image = get_field('background_image-hero'); ?>
<main class="main-section"
style="
    position: relative;
    width: 100%;
    min-height: 100vh;
    background: linear-gradient(
      122deg,
      rgba(12, 14, 23, 1) 0%,
      rgba(12, 14, 23, 0.12) 100%
    )
    <?php if( !empty( $image ) ): ?>, url('<?php echo esc_url($image['url']); ?>')<?php endif; ?>;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        the_title( '<h2><a href="' . get_permalink() . '">', '</a></h2>' );
        the_excerpt();
    endwhile;
    else :
        echo '<p>No content found</p>';
    endif;
    ?>
<!-- testing components -->
<?php get_template_part('components/slider-comp'); ?>

</main>

<?php get_footer(); ?>