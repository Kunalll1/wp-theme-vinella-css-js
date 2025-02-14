<?php get_header(); ?>

    <main id="main" class="site-main">
        <div>
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
            ?>
                <?php the_content(); ?>
            <?php
                endwhile;
            else :
                echo 'Sorry, no content found.';
            endif;
            ?>
        </div>
        <div>
        <?php
            if ( $wp_query->max_num_pages > 1 ) {
                the_posts_pagination( array(
                    'prev_text'          => __( 'Previous page', 'textdomain' ),
                    'next_text'          => __( 'Next page', 'textdomain' ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'textdomain' ) . ' </span>',
                ) );
            }
            ?>
        </div>
    </main>

<?php get_footer(); ?>

