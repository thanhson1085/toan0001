<?php
/*
 * Template Name: Home
*/
get_header();
?>
<div class="container">
    <div class="fifteen alpha columns">
    <?php echo do_shortcode('[portfolio_slideshow id=37]');?>
    <?php 
        $category_ids = get_all_category_ids();
        if (($key = array_search('11', $category_ids)) !== false) {
            unset($category_ids[$key]);
        }
    ?>

    <aside id="search-home" class="widget widget_search" style="background: rgba(247, 245, 231, 0.7)">
        <form role="search" method="get" class="search-form" action="<?php echo home_url();?>">
            <label>
                <span class="screen-reader-text">Search for:</span>
                <input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:">
            </label>
            <label><input style="vertical-align: middle;" type="checkbox" class="search-field" placeholder="Search …" value="<?php echo join($category_ids, ',');?>" name="cat">Tour</label>
            <label><input style="vertical-align: middle;" type="checkbox" class="search-field" placeholder="Search …" value="11" name="cat">Hotel</label>
            <input type="submit" value="Search" style="background-color: #101010;">
        </form>
    </aside>
    <div class="four alpha columns">
        <aside class="widget widget_categories">
           <h3 class="widget-title">Recommended Tours</h3>
            <ul>
            <?php
            $args=array(
                'meta_key'=>'recommended_tours',
                'meta_value'=> '1',
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
        <aside class="widget widget_categories">
           <h3 class="widget-title">Promotion News</h3>
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
    </div>
    <div class="seven alpha columns">
        <div class="home-block block-center">
                <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content();?>
                <?php endwhile; ?>
                <div class="snws-link">
                <?php
                $args=array(
                    'post_type' => 'snws_link',
                    'posts_per_page' => 4,
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
                    <img src="<?php echo $img_att[0];?>"></a>
                <?php
                endwhile;
                }
                wp_reset_query();  // Restore global post data stomped by the_post().
                ?>
                </div>
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
                        <li>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></li>
                    <?php
                    endwhile;
                    }
                    wp_reset_query();  // Restore global post data stomped by the_post().
                    ?>
                </ul>
        </div>
    </div>
    <div class="four alpha columns" style="margin-right: 0px;">
        <aside class="widget" style="background-color:#b9132b; cursor: pointer" onclick="javascript:window.location.href='<?php echo home_url('/customize-tour/');?>'">
            <div><a style="color: white; font-weight: bold;" href="<?php echo home_url('/customize-tour/');?>">Customize your trip</a></div>
        </aside>
        <aside class="widget widget_categories">
           <h3 class="widget-title">Support Online</h3>      
           <ul>
           <li><a href="ymsgr:sendim?travelwithme123"><img border="0" src="http://opi.yahoo.com/online?u=travelwithme123&amp;m=g&amp;t=1" alt="Support Online"></a></li>
           <li><a href="skype:namtalent123?chat" onclick="return skypeCheck();"><img src="http://mystatus.skype.com/smallclassic/namtalent123" style="border: none;" width="114" height="20" alt="My status"></a></li>
            <li>Call Andy (Mr.)</li>
            <li style="font-weight: bold">+84912965545</li>
            </ul>
        </aside>
        <aside class="widget widget_categories">
           <h3 class="widget-title">Feature Hotels</h3>
            <ul>
                <?php
                $args=array(
                    'meta_key'=>'feature_hotels',
                    'meta_value'=> '1',
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
    </div>
    <div class="clear"></div>
    </div>
</div>
<?php
get_footer();
?>
