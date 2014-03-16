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
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
            <div class="block-intro">Throughout Vietnam, you will enjoy stunning landscapes and superb Vietnamese cuisine as you are welcomed by friendly and hospitable local people</div>
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
        <div class="home-block">
            <h2 style="background-color: #379e15">Myanmar Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
            <div class="block-intro">Throughout Vietnam, you will enjoy stunning landscapes and superb Vietnamese cuisine as you are welcomed by friendly and hospitable local people</div>
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
        <div class="home-block">
            <h2 style="background-color:#1ba1e2">Popular Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
            <div class="block-intro">Throughout Vietnam, you will enjoy stunning landscapes and superb Vietnamese cuisine as you are welcomed by friendly and hospitable local people</div>
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
    </div>
    <div class="seven alpha columns">
        <div class="home-block block-center">
                <?php while ( have_posts() ) : the_post(); ?>

                <?php the_content();?>
                <?php endwhile; ?>
        </div>
    </div>
    <div class="four alpha columns" style="margin-right: 0px;">
        <div class="home-block">
            <h2 style="background-color: #e66d1c">Laos Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/3.jpg">
            <div class="block-intro">Throughout Vietnam, you will enjoy stunning landscapes and superb Vietnamese cuisine as you are welcomed by friendly and hospitable local people</div>
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
        <div class="home-block">
            <h2>Promotion Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
            <div class="block-intro">Throughout Vietnam, you will enjoy stunning landscapes and superb Vietnamese cuisine as you are welcomed by friendly and hospitable local people</div>
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
    </div>
</div>
<?php
get_footer();
?>
