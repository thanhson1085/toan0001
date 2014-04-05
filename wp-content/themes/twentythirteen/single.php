<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
                <div style="width: 100%; text-align: center;"><a href="<?php echo get_bloginfo("url");?>/booking"><span style="font-size: 18px; font-weight: bold; padding: 10px 20px; background-color: #B40404; border-radius: 8px; color: white;">Book Now!</span></a></div>
				<?php twentythirteen_post_nav(); ?>
				<?php //comments_template(); ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
