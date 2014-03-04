<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>

				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
            <div style="max-width: 1024px; margin: 0 auto">
            <div class="widget-area-right">
<aside id="recent-posts-3" class="widget widget_recent_entries">        <h3 class="widget-title">Promotion Tours</h3>     <ul>
                    <li>
                <a href="http://sonnguyen.com/toan0001/mergui-archipelago-adventure-holiday-5-days4-nights/">MERGUI ARCHIPELAGO ADVENTURE HOLIDAY 5 DAYS/4 NIGHTS</a>
                        </li>
                    <li>
                <a href="http://sonnguyen.com/toan0001/myanmar-discovery/">Myanmar Discovery</a>
                        </li>
                    <li>
                <a href="http://sonnguyen.com/toan0001/laos-discovery/">Laos Discovery</a>
                        </li>
                    <li>
                <a href="http://sonnguyen.com/toan0001/cambodia-discovery/">Cambodia Discovery</a>
                        </li>
                    <li>
                <a href="http://sonnguyen.com/toan0001/hello-world/">Hanoi – Halong – Danang – Hoian – Hue – Saigon – Cu Chi Tunnels – 8 Days</a>
                        </li>
                </ul>
        </aside>
            </div>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

            </div>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
