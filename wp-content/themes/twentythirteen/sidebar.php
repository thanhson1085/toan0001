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
                <aside class="widget widget_categories"><h3 class="widget-title">Contacts</h3>      
                   <ul>
                   <li><a href="ymsgr:sendim?thanhson1085"><img border="0" src="http://opi.yahoo.com/online?u=thanhson1085&amp;m=g&amp;t=1" alt="Hỗ trợ trực tuyến"></a></li>
                   <li><a href="skype:thanhson1085?chat" onclick="return skypeCheck();"><img src="http://mystatus.skype.com/smallclassic/thanhson1085" style="border: none;" width="114" height="20" alt="My status"></a></li>
                    <li>Mr Toan Nguyen</li>
                    <li style="font-weight: bold; color: #B40404">+8477373809</li>
                    </ul>
                </aside>
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>
