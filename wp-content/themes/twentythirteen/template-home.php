<?php
/*
 * Template Name: Home
*/
get_header();
?>
<div class="container">
    <div class="fifteen alpha columns">
    <?php echo do_shortcode('[portfolio_slideshow id=37]');?>
                <?php while ( have_posts() ) : the_post(); ?>

                <?php the_content();?>
                <?php endwhile; ?>
    <div class="five alpha columns">
        <div class="home-block">
            <h2>Viet Nam Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
    </div>
    <div class="five alpha columns">
        <div class="home-block">
            <h2 style="background-color: #81499c">Cambodia Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/2.jpg">
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
    </div>
    <div class="five alpha columns">
        <div class="home-block">
            <h2 style="background-color: #e66d1c">Laos Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/3.jpg">
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
    </div>
    <div class="five alpha columns">
        <div class="home-block">
            <h2 style="background-color: #379e15">Myanmar Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
    </div>
    <div class="five alpha columns">
        <div class="home-block">
            <h2>Promotion Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
            <ul>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
                <li><a href="#">Lorem Ipsum Donor Aset</a></li>
            </ul>
        </div>
    </div>
    <div class="five alpha columns">
        <div class="home-block">
            <h2 style="background-color:#1ba1e2">Popular Tours</h2>
            <img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2014/03/1.jpg">
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
