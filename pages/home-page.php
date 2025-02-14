<?php
/*
Template Name: Home
*/
?>
<?php ob_start(); ?>
<?php get_header(); ?>
<?php acf_form_head(); ?>
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
<section class="container hero-section">

    <div class="left-hero">
        <h1><?php echo esc_html(get_field('title_hero'));?></h1>
        <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                the_excerpt();
            endwhile;
            else :
                echo '<p>No content found</p>';
            endif;
         ?>
         <!-- Button -->
        <?php get_template_part('components/button-group-comp'); ?>

    </div>
    <div class="right-hero form-bg">
        <h4>Schedule a Free Consultation</h4>
        <!-- Form -->
        <?php get_template_part('components/acf-form-comp'); ?>
    </div>
</section>

<!-- testing components -->
<!-- <?php //get_template_part('components/slider-comp'); ?> -->

</main>

<?php get_footer(); ?>
<?php ob_end_flush(); ?>