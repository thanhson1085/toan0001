<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
	</div><!-- #page -->
	</div><!-- #container -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php //get_sidebar( 'main' ); ?>
            <div id="secondary" class="sidebar-container" role="complementary">
                <ul>
                    <li><a href="<?php echo home_url('/about-us/');?>">About us</a></li>
                    <li><a href="<?php echo home_url('/terms-conditions/');?>">Terms & Conditions</a></li>
                    <li><a href="<?php echo home_url('/booking/');?>">Booking trip</a></li>
                    <li><a href="<?php echo home_url('/payment/');?>">Payment</a></li>
                    <li><a href="<?php echo home_url('/category/blog/');?>">Travel blog</a></li>
                    <li><a href="<?php echo home_url('/country-guides/');?>">Country Guides</a></li>
                    <li><a href="<?php echo home_url('/category/travel-news');?>">Travel news</a></li>
                    <li><a href="<?php echo home_url('/sitemap/');?>">Sitemap</a></li>
                </ul>
            </div>
			<div class="site-info">
                <div class="snws-link">
                <?php
                $args=array(
                    'post_type' => 'snws_footerlink',
                    'post_status' => 'publish'
                );
                $my_query = null;
                $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <a href="<?php echo $post->post_content; ?>">
                    <?php
                        $attch_id = get_post_meta($post->ID, 'link_image', true);
                        $img_att = wp_get_attachment_image_src($attch_id, array(170, 170), true);
                    ?>
                    <?php the_title()?></a>
                <?php
                endwhile;
                }
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?>
                </div>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->

	<?php wp_footer(); ?>
</body>
</html>
