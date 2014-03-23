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
                    <li><a href="<?php echo home_url('/contact-us/');?>">Booking trip</a></li>
                    <li><a href="<?php echo home_url('/payment/');?>">Payment</a></li>
                    <li><a href="<?php echo home_url('/category/blog/');?>">Travel blog</a></li>
                    <li><a href="<?php echo home_url('/category/travel-photos/');?>">Travel photos</a></li>
                    <li><a href="<?php echo home_url('/category/travel-news');?>">Travel news</a></li>
                    <li><a href="<?php echo home_url('/sitemap/');?>">Sitemap</a></li>
                </ul>
            </div>
			<div class="site-info">
                <div style="width: 500px; position: relative; margin: 0 auto;">
                Head office - Hanoi-Vietnam<br />
                No.51 Thinh Hao II lane, Ton Duc Thang street, Dong Da district, Hanoi<br />
                Reservation office.<br />
                A6/4 Company No.12 residence, lane 279, Doi Can street, Ba Dinh, Hanoi<br />
                </div>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->

	<?php wp_footer(); ?>
</body>
</html>
