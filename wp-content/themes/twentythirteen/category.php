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
        <?php
        $cat_tree = get_category_parents($cat, FALSE, ':', TRUE);
        $top_cat = split(':',$cat_tree);
        $parent = $top_cat[0];
        $top_parent_cat = get_category_by_slug($parent);

        ?>
		<?php if ( have_posts() ) : ?>
			<header class="archive-header" style="padding-left: 15px;">
				<h1 class="archive-title"><?php printf( __( '%s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>

				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
            <div class="cat-page-container" style="max-width: 1024px; margin: 0 auto">
            <div class="widget-area-right">
            <aside id="recent-posts-3" class="widget widget_recent_entries">        
            <ul>
                <?php
                $taxonomy_name = 'category';
                $termchildren = get_term_children( $top_parent_cat->term_id, $taxonomy_name );

                foreach ( $termchildren as $child ) {
                    $term = get_term_by( 'id', $child, $taxonomy_name );
                    echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
                }
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
