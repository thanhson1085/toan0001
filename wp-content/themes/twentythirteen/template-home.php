<?php
/*
 * Template Name: Home
*/
get_header();
?>
<div class="container">
    <div class="fifteen alpha columns">
    <?php echo do_shortcode('[portfolio_slideshow id=37]');?>
    <div class="four alpha columns">
        <div class="home-block">
            <h2>Viet Nam Tours</h2>
            <?php 
                $idObj = get_category_by_slug('viet-nam-tours'); 
                $value = get_field('cat_image', 'category_2');
            ?>
            <img src="<?php echo $value['url'];?>">
            <div class="block-intro">
              <?php echo $idObj->description;?>
            </div>
            <ul>
                <?php
                $args=array(
                    'meta_key'=>'vietnam_travel_widget',
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
        </div>
        <div class="home-block">
            <h2 style="background-color: #379e15">Myanmar Tours</h2>
            <?php 
                $idObj = get_category_by_slug('myanmar-tours'); 
                $value = get_field('cat_image', 'category_7');
            ?>
            <img src="<?php echo $value['url'];?>">
            <div class="block-intro">
              <?php echo $idObj->description;?>
            </div>
            <ul>
                <?php
                $args=array(
                    'meta_key'=>'myanmar_travel_widget',
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
        </div>
    </div>
    <div class="seven alpha columns">
        <div class="home-block block-center">
                <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="entry_title" style="margin: 10px 0;"><a>WELLCOME</a></h1>

                <?php the_content();?>
                <?php endwhile; ?>
                <h1 class="entry_title" style="margin: 10px 0;"><a>Promotion</a></h1>
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
                <h1 class="entry_title" style="margin: 10px 0;"><a>Popular tours</a></h1>
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
        </div>
    </div>
    <div class="four alpha columns" style="margin-right: 0px;">
        <div class="home-block">
            <h2 style="background-color: #e66d1c">Laos Tours</h2>
            <?php 
                $idObj = get_category_by_slug('laos-tours'); 
                $value = get_field('cat_image', 'category_3');
            ?>
            <img src="<?php echo $value['url'];?>">
            <div class="block-intro">
              <?php echo $idObj->description;?>
            </div>
            <ul>
                <?php
                $args=array(
                    'meta_key'=>'laos_travel_widget',
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
        </div>
        <div class="home-block">
            <h2>Cambodia Tours</h2>
            <?php
                $idObj = get_category_by_slug('cambodia-tours');
                $value = get_field('cat_image', 'category_4');
            ?>
            <img src="<?php echo $value['url'];?>">
            <div class="block-intro">
              <?php echo $idObj->description;?>
            </div>
            <ul>
                <?php
                $args=array(
                    'meta_key'=>'cambodia_travel_widget',
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
        </div>
    </div>
    <div class="clear"></div>
    </div>
</div>
<?php
get_footer();
?>
