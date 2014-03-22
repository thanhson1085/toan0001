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
			<header class="archive-header" style="padding-left: 15px;">
				<h1 class="archive-title"><?php printf( __( '%s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>

				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
            <div style="max-width: 1024px; margin: 0 auto">
            <div class="widget-area-right">
            <aside id="recent-posts-3" class="widget widget_recent_entries">        
            <h3 class="widget-title">Promotion Tours</h3>     
            <ul>
                <?php
                $args=array(
                    'meta_key'=>'promotion_tours',
                    'meta_value'=> '1',
                    'post_type' => 'post',
                    'post_status' => 'publish'
                );
                $my_query = null;
                $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></li>
                <?php
                endwhile;
                }
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?>
            </ul>
            </aside>
            <aside id="recent-posts-3" class="widget widget_recent_entries">        
            <h3 class="widget-title">Popular Tours</h3>     
            <ul>
                <?php
                $args=array(
                    'meta_key'=>'popular_tours',
                    'meta_value'=> '1',
                    'post_type' => 'post',
                    'post_status' => 'publish'
                );
                $my_query = null;
                $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></li>
                <?php
                endwhile;
                }
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?>
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
