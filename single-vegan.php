<?php get_header(); ?>

    <main id="main" class="site-main">
        <div>
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
            ?>
            <!-- title -->
                <h1><?php echo get_the_title(); ?></h1>
            <!-- feature Image -->
                <?php
                    $feature_img = get_field('feature_image_vegan_pt');
                    if ($feature_img): ?>
                        <img src="<?php echo $feature_img['url']; ?>"
                            alt="<?php echo $feature_img['alt']; ?>">
                    <?php endif ?>
                <!-- content -->
                <div class="acf-content">
                    <?php echo the_field('content_vegan_pt'); ?>
                </div>
            <!-- selected post in acf Relation Block-->
            <div class="listings">
                <?php
                // Get selected listings from the ACF relationship field
                $selected_listings = get_field('select_best_vegan_pt');
                // Check if there are any selected listings
                if ( $selected_listings ) :
                    // Loop through each selected listing
                    foreach ( $selected_listings as $post ) :
                        // Set up post data for each listing
                        setup_postdata( $post ); ?>
                        <!-- Container for each listing item -->
                        <div class="listing-item">
                            <!-- Display the title of the listing -->
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <!-- feature image of this post -->
                            <?php
                                $other_post_img = get_field('feature_image_post_pt');
                                if ($other_post_img): ?>
                                    <img src="<?php echo $other_post_img['url']; ?>"
                                        alt="<?php echo $other_post_img['alt']; ?>">
                                <?php endif ?>
                            <!-- Display custom fields from ACF -->
                            <div><?php the_field('content_post_pt'); ?></div>
                            <div><?php the_field('location_post_pt'); ?></div>
                        </div>
                    <?php endforeach;
                    // Reset post data to the original post
                    wp_reset_postdata();
                else :
                    // Display a message if no listings are selected
                    echo '<p>No listings selected</p>';
                endif;
                ?>
        </div>

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

