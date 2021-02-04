<br style="clear: both;">
<footer>
    <div class="pp-rating">
        <?php
        $plugin_name_markup  = '<strong>' . $context['plugin_name'] . '</strong>';
        $rating_stars_markup = '<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span
                class="dashicons dashicons-star-filled"></span><span
                class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>';
        ?>

        <a
                href="//wordpress.org/support/plugin/<?php echo $context['plugin_slug']; ?>/reviews/#new-post"
                target="_blank"
                rel="noopener noreferrer">
            <?php echo sprintf($context['rating_message'], $plugin_name_markup, $rating_stars_markup); ?>
        </a>
    </div>
    <hr>
    <nav>
        <ul>
            <li>
                <a href="//publishpress.com" target="_blank" rel="noopener noreferrer"
                   title="About <?php echo $context['plugin_name']; ?>"><?php echo __(
                        'About',
                        'publishpress-checklists'
                    ); ?></a>
            </li>
            <li>
                <a href="//publishpress.com/documentation/" target="_blank" rel="noopener noreferrer"
                   title="<?php echo $context['plugin_name']; ?> Documentation"><?php echo __(
                        'Documentation',
                        'publishpress-checklists'
                    ); ?></a>
            </li>
            <li>
                <a href="//publishpress.com/contact" target="_blank" rel="noopener noreferrer"
                   title="Contact the PublishPress team"><?php echo __('Contact', 'publishpress-checklists'); ?></a>
            </li>
            <li>
                <a href="//twitter.com/publishpresscom" target="_blank" rel="noopener noreferrer">
                    <span class="dashicons dashicons-twitter"></span>
                </a>
            </li>
            <li>
                <a href="//facebook.com/publishpress" target="_blank" rel="noopener noreferrer">
                    <span class="dashicons dashicons-facebook"></span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="pp-pressshack-logo">
        <a href="//publishpress.com" target="_blank" rel="noopener noreferrer">
            <img src="<?php echo $context['plugin_url']; ?>modules/checklists/assets/img/publishpress-logo.png">
        </a>
    </div>
</footer>
</div> <?php # .publishpress-checklists-admin.pressshack-admin-wrapper.wrap
