<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
                <aside class="widget widget_categories"><h3 class="widget-title">Support Online</h3>      
                   <ul>
                   <li><a href="ymsgr:sendim?travelwithme123"><img border="0" src="http://opi.yahoo.com/online?u=travelwithme123&amp;m=g&amp;t=1" alt="Support Online"></a></li>
                   <li><a href="skype:namtalent123?chat" onclick="return skypeCheck();"><img src="http://mystatus.skype.com/smallclassic/namtalent123" style="border: none;" width="114" height="20" alt="My status"></a></li>
                    <li>Call Andy (Mr.)</li>
                    <li style="font-weight: bold; color: white">+84912965545</li>
                    </ul>
                </aside>
                <aside id="recent-posts-3" class="widget widget_recent_entries">        
                <h3 class="widget-title">Promotion Tours</h3>     
                <ul>
                    <?php
                    $args=array(
                        'meta_key'=>'promotion_tours',
                        'meta_value'=> '1',
                        'category_name'=> $parent,
                        'post_type' => 'post',
                        'post_status' => 'publish'
                    );
                    $my_query = null;
                    $my_query = new WP_Query($args);
                    if( $my_query->have_posts() ) {
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <li>
                            <div style="float: left; margin-right: 8px">
                                <?php the_post_thumbnail(array(30,30)); ?>
                            </div>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></li>
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
                        'category_name'=> $parent,
                        'post_type' => 'post',
                        'post_status' => 'publish'
                    );
                    $my_query = null;
                    $my_query = new WP_Query($args);
                    if( $my_query->have_posts() ) {
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <li>
                            <div style="float: left; margin-right: 8px">
                                <?php the_post_thumbnail(array(30,30)); ?>
                            </div>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></li>
                    <?php
                    endwhile;
                    }
                    wp_reset_query();  // Restore global post data stomped by the_post().
                    ?>
                </ul>
                </aside>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>
