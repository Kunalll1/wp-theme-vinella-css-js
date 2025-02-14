<?php if (have_rows('button-home')) : ?>
            <div class="button-wrapper">
                <?php while (have_rows('button-home')) : the_row(); 
                    $button_text = get_sub_field('button_text-hero');
                    $is_primary  = get_sub_field('is_it_primery-check-hero');
                    $button_class = $is_primary ? 'primary-button' : 'sec-button';
                    $button_link = get_sub_field('link-hero');
                ?>
                    <a href="<?php echo esc_url($button_link['url']); ?>" class="<?php echo esc_attr($button_class); ?>">
                        <?php echo esc_html($button_text); ?>
                    </a>
                <?php endwhile; ?>
            </div>
    <?php endif; ?>