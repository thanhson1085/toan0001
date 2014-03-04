<?php
/*
Plugin Name: Slideshow Pro
Version: 2.4
Plugin URI: http://vm.xmlswf.com/wordpress-plugins/slide-show-pro
Description: A Gallery Management Plugin
Author: XML / SWF
Author URI: http://xmlswf.com
*/
define('PRO_PLUGIN_DIR', dirname(__FILE__));
define('PRO_PLUGIN_URL', WP_PLUGIN_URL . '/' . basename(PRO_PLUGIN_DIR));
define('PRO_PLUGIN_UPLOADS_DIR', WP_CONTENT_DIR . '/uploads/slideshowpro');
define('PRO_PLUGIN_UPLOADS_URL', WP_CONTENT_URL . '/uploads/slideshowpro');
define('PRO_PLUGIN_XML_DIR', PRO_PLUGIN_DIR . '/xml');
define('PRO_PLUGIN_XML_URL', PRO_PLUGIN_URL . '/xml');

require_once PRO_PLUGIN_DIR . '/functions.php';

class SlideshowproWidget extends WP_Widget
{
  function SlideshowproWidget()
  {
    $widget_ops = array('classname' => 'SlideshowproWidget', 'description' => 'Displays Slideshowpro' );
    $this->WP_Widget('SlideshowproWidget', 'Slideshowpro widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Type categories or product id-s, or blank to show all. Example1: cats=2,4,5 Example2: imgs=1,3,19,7 <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	
	$vars = array();
    if (empty($title)) {
		$vars = array('cats' => '','imgs' => '');
	} else {
		$ptr_cats = '#\s*cats\s*=\s*([0123456789, ]+)\s*#';
		if (preg_match($ptr_cats, $title, $result) > 0) {
			$vars['cats'] = $result[1];
		} else {
			$vars['cats'] = '';
			$ptr_imgs = '#\s*imgs\s*=\s*([0123456789, ]+)\s*#';
			if (preg_match($ptr_imgs, $title, $result) > 0) {
				$vars['imgs'] = $result[1];
			} else {
				$vars['imgs'] = '';
			}
		}
	}
	$ret_html = display_pro_gallery($vars);
    echo $ret_html;
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("SlideshowproWidget");') );


class SlideshowPro
{
	private $errors = array(); 
	public $messages = array();
	public $def_settings = null;
	
	public function __construct()
	{
		$this->def_settings = pro_get_def_settings();
		register_activation_hook(__FILE__, array($this, 'activate'));
		register_deactivation_hook(__FILE__, array($this, 'deactivate'));
		$this->add_actions();
		$this->add_filters();
		$this->add_shortcodes();
		$this->add_scripts();
		if( !is_dir(PRO_PLUGIN_UPLOADS_DIR) )
			$this->errors[] = __('Slideshow Pro: The uploads dir does not exists, please create "slideshowpro" directory under "'.WP_CONTENT_DIR.' /uploads/"');
		if( is_dir(PRO_PLUGIN_UPLOADS_DIR) && !is_writable(PRO_PLUGIN_UPLOADS_DIR) )
			$this->errors[] = sprintf(__('Slideshow Pro: The upload dir "%s" is not writable, please set writte permissions'), PRO_PLUGIN_UPLOADS_DIR);
		if( !is_dir(PRO_PLUGIN_XML_DIR) )
			$this->errors[] = __('Slideshow Pro: The folder to store xml files does not exits, please create it and set write permissions');
		if( is_dir(PRO_PLUGIN_XML_DIR) && !is_writable(PRO_PLUGIN_XML_DIR) )
			$this->errors[] = sprintf(__('Slideshow Pro: The folder to store xml files "%s" is not writable, please set writte permissions'), PRO_PLUGIN_XML_DIR);
	}
	public function add_actions()
	{
		if( is_admin() )
		{
			add_action('admin_menu', array($this, 'add_menus'));
			add_action('admin_notices', array($this, 'admin_notices'));
			add_action('init', array($this, 'handle_admin_request'));
			add_action('admin_head', array($this, 'pro_admin_head'));
		}
		else
		{
			
		}
	}
	public function add_filters()
	{
		
	}
	public function add_scripts()
	{
		global $pagenow, $typenow;
		$plugin_page = $_GET['page'];
		if( is_admin() && ($plugin_page == 'slideshowpro_manage')):
			wp_enqueue_style('pro_admin_css', PRO_PLUGIN_URL . '/css/admin.css');
			wp_enqueue_style('pro_default_css', PRO_PLUGIN_URL . '/css/default.css');

			wp_enqueue_style('pro_dd_css', PRO_PLUGIN_URL . '/css/data_tables.css');
			wp_enqueue_script('pro_swfupload', PRO_PLUGIN_URL . '/js/swfupload/js/swfupload.js');

			wp_enqueue_script('pro_swfuploadqueue', PRO_PLUGIN_URL . '/js/swfupload/js/swfupload.queue.js');
			wp_enqueue_script('pro_fileprogress', PRO_PLUGIN_URL . '/js/swfupload/js/fileprogress.js');
			wp_enqueue_script('pro_handlers', PRO_PLUGIN_URL . '/js/swfupload/js/handlers.js');
			wp_enqueue_style( 'farbtastic' );     
			wp_enqueue_script( 'farbtastic' ); 

			//wp_enqueue_script('pro_swfobject', PRO_PLUGIN_URL . '/js/uploadify-2.1.4/swfobject.js');
			//wp_enqueue_script('pro_uploadify', PRO_PLUGIN_URL . '/js/uploadify-2.1.4/jquery.uploadify.v2.1.4.min.js', array('jquery', 'pro_swfobject'));
			wp_enqueue_script('pro_tp_js', PRO_PLUGIN_URL . '/js/paging.js');
			wp_enqueue_script('pro_admin_js', PRO_PLUGIN_URL . '/js/admin.js');
			//wp_enqueue_script('thickbox');//, home_url() . '/wp-includes/js/thickbox/thickbox.js', array('jquery'));
			add_thickbox();
		endif;
		if( is_admin() && ($plugin_page == 'slideshowpro_settings')):
			//wp_enqueue_script( PRO_PLUGIN_URL . '/js/jscolor/jscolor.js' );
		
			wp_enqueue_script('pro_setting_js', PRO_PLUGIN_URL . '/js/jscolor/jscolor.js');
			//wp_enqueue_script('pro_setting_js', PRO_PLUGIN_URL . '/js/setting.js');
		endif;

	}
	public function add_shortcodes()
	{
		add_shortcode('slideshowpro', 'shortcode_display_pro_gallery');
	}
	public function add_menus()
	{
		add_menu_page(__('Slideshow Pro'), __('Slideshow Pro'), 8, 'slideshowpro_menu', create_function('', 'require_once PRO_PLUGIN_DIR . "/html/about.php";'));
		add_submenu_page('slideshowpro_menu', __('Slideshow Pro Setting'), __('About'), 8, 'slideshowpro_menu', 
							create_function('', 'require_once PRO_PLUGIN_DIR . "/html/about.php";'));
		add_submenu_page('slideshowpro_menu', __('Slideshow Pro Setting'), __('Settings'), 8, 'slideshowpro_settings', 
							create_function('', 'require_once PRO_PLUGIN_DIR . "/html/settings.php";'));
		add_submenu_page('slideshowpro_menu', __('Slideshow Pro Management'), __('Category Management'), 8, 'slideshowpro_manage', 
							create_function('', 'require_once PRO_PLUGIN_DIR . "/html/manage.php";'));
		add_submenu_page('slideshowpro_menu', __('Slideshow Pro Cache'), __('Delete Cache'), 8, 'slideshowpro_cache', 
							create_function('', 'require_once PRO_PLUGIN_DIR . "/html/cache.php";'));
	}
	public function pro_admin_head()
	{
		print '<script type="text/javascript">
			var pro_url = "'.PRO_PLUGIN_URL.'";
			</script>';
	}
	public function admin_notices()
	{
		foreach($this->errors as $e)
		{
			print '<div class="error"><p>'.$e.'</p></div>';
		}
	}
	public function handle_admin_request()
	{
		$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : null;
		if($task == null) return false;
		if( method_exists($this, $task) )
			$this->$task();		
	}
	/**
	 * Here start all tasks methods
	 */
	public function pro_add_new_album()
	{
		global $wpdb;
		$album_id = isset($_POST['album_id']) ? (int)$_POST['album_id'] : null;
		$album_name = trim($_POST['album_name']);
		$album_desc = trim($_POST['album_desc']);
		if (!function_exists('get_magic_quotes_gpc') || get_magic_quotes_gpc() != 1) {
			//$album_name = addslashes($album_name);
			//$album_desc = addslashes($album_desc);
		}
		$album = null;
		$album_dir = null;
		//edit album
		if( $album_id != null )
		{
			//get album
			$query = "SELECT album_id, name, description, image, thumb, status, `order`, creation_date
						FROM {$wpdb->prefix}pro_albums
						WHERE album_id = $album_id";
			$album = $wpdb->get_row($query);
			if( empty($album) )
			{
				//album does not exists
				die('album not found'. $query);
				
			}
			$album_dir = pro_get_album_dir($album->album_id);
			//delete album images if new one will be uploaded
			if( isset($_FILES) && isset($_FILES['album_img']) && $_FILES['album_img']['size'] > 0 )
			{
				if( file_exists($album_dir . '/big/' . $album->image) )
					unlink($album_dir . '/big/' . $album->image);
				if( $album_dir . '/thumb/' . $album->thumb )
					unlink($album_dir . '/thumb/' . $album->thumb);
			}
			$album = array('name' => $album_name, 'description' => $album_desc);
		}
		//create a new album
		else
		{
			$album = array('name' => $album_name, 'description' => $album_desc, 'order' => 0, 'image' => '', 'thumb' => '', 'status' => 1);
			$wpdb->insert($wpdb->prefix.'pro_albums', $album);
			//get album id
			$album_id = $wpdb->insert_id;
			$album_dir = pro_get_album_dir($album_id);
			if( !is_dir( $album_dir ) )
				mkdir($album_dir);
			if( !is_dir($album_dir . '/big') )
				mkdir($album_dir . '/big');
			if( !is_dir($album_dir . '/thumb') )
				mkdir($album_dir . '/thumb');	
		}
		//upload images
		if( isset($_FILES) && isset($_FILES['album_img']) && $_FILES['album_img']['size'] > 0 )
		{
			//die(PRO_PLUGIN_UPLOADS_DIR . '/' . $album_dir);
			if( !is_dir( $album_dir ) )
				mkdir($album_dir);
			if( !is_dir($album_dir . '/big') )
				mkdir($album_dir . '/big');
			if( !is_dir($album_dir . '/thumb') )
				mkdir($album_dir . '/thumb');
				
			$unique_name = wp_unique_filename($album_dir . '/big', $_FILES['album_img']['name']);
			//move uploaded file (big file)
			move_uploaded_file($_FILES['album_img']['tmp_name'], $album_dir . '/big/' . $unique_name);
			//set album image
			$album['image'] = $unique_name;
			//resize for thumbnail
			$thumb = image_resize($album_dir . '/big/' .$unique_name, 
										//(int)get_option('large_size_w'), 
										//(int)get_option('large_size_h'),
										80,
										80, 
										0, 'resized');
			copy($thumb, $album_dir . '/thumb/' . basename($thumb));
			//delete temp thumb
			unlink($thumb);
			if( is_wp_error($thumb) )
			{
				print_r($thumb);die('Error');
			}
			$album['thumb'] = basename($thumb);
		}
		$wpdb->update($wpdb->prefix.'pro_albums', $album, array('album_id' => $album_id));
		if( isset($_REQUEST['TB_iframe']))
		{
			$js = '<script type="text/javascript">self.parent.tb_remove();self.parent.pro_refresh_albums_table();</script>';
			die($js);
		}
	}
	/**
	 * Delete album
	 * @param $json
	 * @return unknown_type
	 */
	public function pro_delete_album($json = true)
	{
		global $wpdb;
		
		$key = isset($_REQUEST['album_id']) ? (int)$_REQUEST['album_id'] : null;
		if( $key == null ) return false;
		
		//check if album exists
		if( ($album = $this->pro_get_album($key)) == null )
		{
			//album not found or not exists
			$this->json_response(array('status' => 'error', 'message' => 'The album id does not exists'));
		}
		//check for images
		$query = "SELECT image_id FROM {$wpdb->prefix}pro_images WHERE album_id = $key";
		if( $wpdb->query($query) > 0 )
		{
			//error: the album contains images
			$this->json_response(array('status' => 'error', 'message' => 'The album is not empty, please delete all images first'));
		}
		$album_dir = pro_get_album_dir($key);
		if( file_exists($album_dir .'/big/'.$album['image']) )
			unlink($album_dir .'/big/'.$album['image']);
		if( file_exists($album_dir .'/thumb/'.$album['thumb']) )
			unlink($album_dir .'/thumb/'.$album['thumb']);
		if( is_dir($album_dir.'/thumb') )
			rmdir($album_dir.'/thumb');
		if( is_dir($album_dir.'/big') )
			rmdir($album_dir.'/big');
		@rmdir($album_dir);
		//delete album
		$query = "DELETE FROM {$wpdb->prefix}pro_albums WHERE album_id = $key LIMIT 1";
		$wpdb->query($query);
		if( $json )
			$this->json_response(array('status' => 'ok', 'message' => 'The album has been deleted.'));
	}
	public function reset_albums(){update_option('pro_albums', array());delete_option('pro_albums');}
	/**
	 * Save Slideshow Pro setttings
	 * 
	 * @return unknown_type
	 */
	public function save_pro_settings()
	{
		$ops = array();
		foreach($_POST['settings'] as $key => $value)
		{
			$ops[$key] = trim($value);
		}
		update_option('pro_settings', $ops);
		/*
insert xml code part
		*/

	}
	public function pro_single_image_upload()
	{
		global $wpdb; 
		
		$album_id = isset($_REQUEST['album_id']) ? (int)$_REQUEST['album_id'] : null;
		$title = trim($_REQUEST['image_title']);
		$desc = isset($_REQUEST['image_description']) ? trim($_REQUEST['image_description']) : '';
		$price = isset($_REQUEST['image_price']) ? trim($_REQUEST['image_price']) : 0;
		$price = (is_numeric($price)) ? $price : 0;
		$thumb = isset($_REQUEST['image_thumb']) ? trim($_REQUEST['image_thumb']) : 'generate';
		$link = isset($_REQUEST['image_link']) ? trim($_REQUEST['image_link']) : '';
		//for update
		$image_id = isset($_REQUEST['image_id']) ? (int)$_REQUEST['image_id'] : null;
		//init messages 
		$this->messages['upload'] = array();
		//get albums
		$album = null;
		//die("thumb: $thumb");
		//for update image
		if( $image_id !== null )
		{
			//die('editing image'. $image_id);
			if( !($album = $this->pro_get_album($album_id)) )
			{
				die(__('Incorrect album or does not exists'));
				return false;
			}
			$_image = $this->get_image($image_id);
			//check if new image will be uploaded
			if( isset($_FILES) && $_FILES['image_file']['size'] > 0 )
			{
				//delete images becuase new one will be uploaded
				if( file_exists(pro_get_album_dir($album_id) . '/big/' . $_image->image) )
				{
					unlink(pro_get_album_dir($album_id) . '/big/' . $_image->image);
				}
			}
			if( $thumb == 'upload' && $_FILES['image_file_thumb']['size'] > 0 )
			{
				//delete thumb images
				if( file_exists(pro_get_album_dir($album_id) . '/thumb/' . $_image->thumb) )
				{
					unlink(pro_get_album_dir($album_id) . '/thumb/' . $_image->thumb);
				}
			}
		} 
		//add new image
		else
		{
			if( !($album = $this->pro_get_album($album_id)) )
			{
				$this->messages['upload'][] = __('Incorrect album');
				return false;
			}
			if( empty($title)) 
			{
				$this->messages['upload'][] = __('Please enter a valid title for image');
				return false;
			}
			/*
			if( empty($price)) 
			{
				$this->messages['upload'][] = __('Please enter a price');
				return false;
			}
			*/
			if( !isset($_FILES['image_file']) || $_FILES['image_file']['size'] <= 0 )
			{
				$this->messages['upload'][] = __('Please select an image to upload');
				return false;
			}
			if( $thumb == 'upload' )
			{
				if( !isset($_FILES['image_file_thumb']) || $_FILES['image_file_thumb']['size'] <= 0)
				{
					$this->messages['upload'][] = __('Please select a thumb for the image');
					return false;
				}
			}
		}
		//print_r($_REQUEST);die();
		//get album dir
		$album_dir = pro_get_album_dir($album_id);
		
		$image_file = $thumb_file = null;
		if( isset($_FILES) && $_FILES['image_file']['size'] > 0 )
		{
			//build new image
			$image_file = wp_unique_filename($album_dir . '/big', $_FILES['image_file']['name']);
			//save uploaded image (big image)
			move_uploaded_file($_FILES['image_file']['tmp_name'], $album_dir . '/big/' . $image_file);
			if( $thumb == 'generate' )
			{
				//generate thumb image
				$thumb_file = image_resize($album_dir . '/big/' . $image_file, 80, 80, false, 'resized');	
				copy($thumb_file, $album_dir . '/thumb/' . basename($thumb_file));
				unlink($thumb_file);
			}
			elseif( $thumb == 'upload' )
			{
				$tmp_thumb = wp_unique_filename($album_dir . '/thumb', $thumb_file);
				move_uploaded_file($_FILES['image_file_thumb']['tmp_name'], $album_dir . '/thumb/' . $tmp_thumb);
				$thumb_file = wp_unique_filename($album_dir . '/thumb', $_FILES['image_file_thumb']['name']);
				$thumb_file = image_resize($album_dir . '/thumb/' . $tmp_thumb, 80, 80, false, 'resized');
				unlink($album_dir . '/' . $tmp_thumb);
			}
		}
		//for edit image
		if( $image_id !== null )
		{
			$image = $this->get_image($image_id);
			if( !$image )
			{
				die('Image id does not exists');
			}
			$data = array('title' => $title, 'description' => $desc, 'price' => $price, 
						'image' => ($image_file != null) ? $image_file : $image['image'],
						'thumb' => ($thumb_file != null ) ? basename($thumb_file) : $image['thumb'],
						'link' => $link);
			$wpdb->update($wpdb->prefix.'pro_images', $data, array('image_id' => $image_id));
		}
		//add new image
		else
		{
			$image = array('category_id' => $album_id, 'title' => $title, 'description' => $desc,
							'price' => $price,
							'thumb' => basename($thumb_file),
							'image' => $image_file,
							'status' => 1,  
							'order' => 0, 
							'link' => '');
			if(!$wpdb->insert($wpdb->prefix.'pro_images', $image))
			{
				$this->messages['upload'][] = __('Error ocurred while trying to insert a new image');
			}
		}
		
		if( isset($_REQUEST['TB_iframe']))
		{
			$js = '<script type="text/javascript">self.parent.tb_remove();self.parent.pro_refresh_images_table("'.$album_id.'");</script>';
			die($js);
		}
	}
	/**
	 * 
	 * @return unknown_type
	 */
	public function pro_resize_image_and_add()
	{
		global $wpdb;
		
		$price = trim($_REQUEST['image_price']);
		$price = (is_numeric($price)) ? $price : 0;
		$album_id = isset($_REQUEST['album_id']) ? (int)$_REQUEST['album_id'] : null;
		$full_filename = $_REQUEST['filename'];
		$cpage = $_REQUEST['cpage'];
		$view = $_REQUEST['view'];
		if( !file_exists($full_filename) )
		{
			header('Content-type: application/json');
			$res = json_encode(array('status' => 'error', 'message' => 'Image file does not exists or error moving file'));
			die($res);
		}
		//$title = substr(basename($full_filename), 0, (strrpos(basename($full_filename), '.') - 1));
		$title = substr(basename($full_filename), 0, (strrpos(basename($full_filename), '.')));
		$album_dir = pro_get_album_dir($album_id);
		$image_file = basename($full_filename);
		$album = $this->pro_get_album($album_id);
		if( !$album )
		{
			$this->json_response(array('status' => 'error', 'message' => 'The album image does not exists'));
		}
		$big_image = wp_unique_filename($album_dir . '/big', basename($full_filename));
		copy($full_filename, $album_dir.'/big/'.$big_image);
		//create thumb
		$tmp_thumb = image_resize($full_filename, 80, 80, false, 'resized');
		$thumb = wp_unique_filename($album_dir . '/thumb/', basename($tmp_thumb));
		//copy thumb to folder
		copy($tmp_thumb, $album_dir.'/thumb/'.$thumb);
		//delete big and generated thumb
		unlink($full_filename);
		unlink($tmp_thumb);
		//die(basename($thumb));	
		$image = array('category_id' => $album_id, 'title' => $title, 'thumb' => basename($thumb), 'description' => '', 
						'price' => number_format($price, 2), 'order' => 0, 'image' => $big_image, 'status' => 1);
		$wpdb->insert($wpdb->prefix.'pro_images', $image);
		$image_id = $wpdb->insert_id;
		//generate new row
		$row = '<tr>
					<td><input type="checkbox" name="image_'.$image_id.'" value="'.$image_id.'" /></td>
					<td>'.$image_id.'</td>
					<td>'.$image['title'].'</td>
					<td><img src="'.pro_get_album_url($album_id). '/' . $image['thumb'].'" alt="" /></td>
					<td>'.$image['description'].'</td>
					<td>'.$image['price'].'</td>
					<td>
						<form action="" method="post" class="order_form">
							<input type="hidden" name="task" value="pro_reorder_image" />
							<input type="hidden" name="album_id" value="'.$album['album_id'].'" />
							<input type="hidden" name="image_id" value="'.$image_id.'" />
							<input type="text" name="img_order" value="0" class="image_order" />
						</form>
					</td>
					<td>
						<a href="'.$cpage.'&view='.$view.'&task=pro_disable_image&album_id='.$album_id.'&pro_image_id='.$image_id.'">
							'.__('Disable').'
						</a>&nbsp;
						<a class="thickbox" 
							href="'.PRO_PLUGIN_URL .'/html/edit_image.php?album_id='.$album_id.'&pro_image_id='.$image_id.'&KeepThis=true&TB_iframe=true&height=400&width=600">
							'.__('Edit').'
						</a>
						<a href="'.$cpage.'&view='.$view.'&task=pro_delete_image&album_key='.$album_id.'&pro_image_id='.$image_id.'">
							'.__('Delete').'</a>&nbsp;
					</td>
				</tr>';
		$res = array('status' => 'ok', 'row' => $row);
		$this->json_response($res);
	}
	public function pro_delete_image()
	{
		$album_id = (int)trim($_REQUEST['album_id']);
		$image_id = (int)$_REQUEST['pro_image_id'];
		$album = $this->pro_get_album($album_id);
		if( !$album )
		{
			$this->messages['upload'][] = __('Incorrect album');
			return false;
		}
		$image = $this->get_image($image_id);
		if( !$image )
		{
			$this->messages['upload'][] = __('Image id does not exists');
			return false;
		}
		$this->delete_image($image_id);
		$this->messages['upload'][] = __('Album image deleted');
	}
	public function pro_get_albums_table()
	{
		global $wpdb;
		$query = "SELECT * FROM {$wpdb->prefix}pro_albums ORDER BY `order` ASC";
		$albums = $wpdb->get_results($query, ARRAY_A);
		
		ob_start();
		require_once PRO_PLUGIN_DIR . '/html/albums_rows.php';
		$rows = ob_get_clean();
		$json = json_encode(array('status' => 'ok', 'rows' => $rows));
		header('Content-type: application/json');
		die($json);
	}
	public function pro_get_albums_images_table()
	{
		$album_id = isset($_REQUEST['album_id']) ? (int)$_REQUEST['album_id'] : null;
		
		if( $album_id == null )
		{
			$this->json_response(array('status' => 'error', 'message' => 'Invalid image id'));
		}
		$album = $this->pro_get_album($album_id);
		if( !$album )
		{
			$this->json_response(array('status' => 'error', 'message' => 'The album does not exists'));
		}
		$images = $this->pro_get_album_images($album_id);
		$cpage = 'admin.php?page=slideshowpro_manage';
		$_REQUEST['view'] = 'manage_album';
		ob_start();
		require_once PRO_PLUGIN_DIR . '/html/images_rows.php';
		$rows = ob_get_clean();
		$this->json_response(array('status' => 'ok', 'rows' => $rows));
	}
	public function json_response($res)
	{
		if( is_array($res) || is_object($res) )
			$res = json_encode($res);
		
		header('Content-type: application/json');
		die($res);
	}
	public function activate()
	{
		global $wpdb;
		$query = array();
		$query[] = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}pro_albums(album_id bigint not null auto_increment, 
							name varchar(150), 
							description varchar(500),
							image varchar(500),
							thumb varchar(500),
							status tinyint(1),
							`order` bigint default 0,
							creation_date datetime,
							primary key(album_id)
							)";
		$query[] = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}pro_images(image_id bigint not null auto_increment,
							category_id bigint not null,
							title varchar(150),
							description varchar(500),
							price decimal(10,2),
							thumb varchar(500),
							image varchar(500),
							status tinyint(1),
							`order` bigint default 0,
							link text,
							creation_date datetime,
							primary key(image_id)
							)";
		$query[] = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}pro_misc(id int not null auto_increment, 
							ione int, 
							itwo int,
							ithree int,
							txt text,
							primary key(id)
							)";
		$sec_word = md5('r'.rand().'r2'.rand().'t'.time().'r3'.rand().'r4'.rand());
		$query[] = "INSERT INTO {$wpdb->prefix}pro_misc (id, ione, itwo, ithree, txt) VALUES (1,1,1,1,'".$sec_word."')";
		foreach($query as $q)
		{
			$wpdb->query($q);
		}
		//create folders
		if( !is_dir(WP_CONTENT_DIR.'/uploads') )
		{
			mkdir(WP_CONTENT_DIR.'/uploads');
			chmod(WP_CONTENT_DIR.'/uploads', 0755);					
		}

		if( !is_dir(PRO_PLUGIN_UPLOADS_DIR) )
		{
			mkdir(PRO_PLUGIN_UPLOADS_DIR);
			chmod(PRO_PLUGIN_UPLOADS_DIR, 0777);					
		}
		if( !is_dir(PRO_PLUGIN_XML_DIR) )
		{
			mkdir(PRO_PLUGIN_XML_DIR);
			chmod(PRO_PLUGIN_XML_DIR, 0777);
		} 
		$this->def_settings = pro_get_def_settings();
		//store default settings
		add_option('pro_settings', $this->def_settings);
	}
	public function deactivate()
	{
		global $wpdb;
		//$query = "DROP TABLE {$wpdb->prefix}pro_albums";
		//$wpdb->query($query);
		//$query = "DROP TABLE {$wpdb->prefix}pro_images";
		//$wpdb->query($query);
		$query = "DROP TABLE {$wpdb->prefix}pro_misc";
		$wpdb->query($query);
		delete_option('pro_settings');
	}
	/**
	 * Get album from id
	 * @param $album_id
	 * @return null on album not found or associative array on album found
	 */
	public function pro_get_album($album_id)
	{
		global $wpdb;
		$album_id = (int)$album_id;
		$query = "SELECT album_id, name, description, image, thumb, `order`, status, creation_date
					FROM {$wpdb->prefix}pro_albums
					WHERE album_id = $album_id
					LIMIT 1";
		$album = $wpdb->get_row($query, ARRAY_A);
		if( empty($album) )
			return null;
		return $album;	
	}
	public function pro_get_album_images($album_id)
	{
		global $wpdb;
		$album_id = (int)$album_id;
		$query = "SELECT image_id, category_id, title, description, price, thumb, image, status, `order`, link, creation_date
					FROM {$wpdb->prefix}pro_images
					WHERE category_id = $album_id
					ORDER BY `order` ASC";
		$images  = $wpdb->get_results($query, ARRAY_A);
		if( empty($images) )
			return null;
		return $images;
	}
	public function get_image($image_id)
	{
		global $wpdb;
		$image_id = (int)$image_id;
		$query = "SELECT image_id, category_id, title, description, price, thumb, image, status, `order`, link, creation_date
					FROM {$wpdb->prefix}pro_images
					WHERE image_id = $image_id
					LIMIT 1";
		$image  = $wpdb->get_row($query, ARRAY_A);
		if( empty($image) )
			return null;
		return $image;
	}
	public function pro_delete_cache()
	{
		if( !isset($_REQUEST['delete_cache']) ) return null;
		$dh = opendir(PRO_PLUGIN_XML_DIR);
		while(($file = readdir($dh)) !== false)
		{
			if( $file{0} == '.' ) continue;
			unlink(PRO_PLUGIN_XML_DIR . '/' . $file);
		}
		closedir($dh);
		$this->messages['cache'] = array('The cache has benn deleted!!!');
	}
	public function pro_reorder_image()
	{
		global $wpdb;
		
		$album_id = (int)$_REQUEST['album_id'];
		$image_id = (int)$_REQUEST['image_id'];
		$img_order = (int)$_REQUEST['img_order'];
		$wpdb->update($wpdb->prefix.'pro_images', array('order' => $img_order), array('image_id' => $image_id));
	}
	public function pro_reorder_album()
	{
		global $wpdb;
		$album_id = (int)$_REQUEST['album_id'];
		$album_order = (int)$_REQUEST['album_order'];
		$wpdb->update($wpdb->prefix.'pro_albums', array('order' => $album_order), array('album_id' => $album_id));
	}
	public function pro_bulk_delete_albums()
	{
		global $wpdb;
		
		$ids = json_decode($_REQUEST['ids']);
		if( empty($ids) )
		{
			$this->json_response(array('status' => 'errpr', 'message' => 'No Categories selected'));
		}
		$error = '';
		foreach($ids as $id)
		{
			if( $this->pro_get_album_images($id) != null )
			{
				$error .= 'The category '. $id . ' is not empty, please delete the images first';
				continue;
			}
			$_REQUEST['album_id'] = $id;
			$this->pro_delete_album(false);
		}
		$res = array('status' => 'ok', 'message' => 'Categories deleted');
		if( !empty($error) )
		{
			$res['status'] = 'error';
			$res['message'] = $error;	
		}
		$this->json_response($res); 
	}
	public function pro_bulk_disable_albums()
	{
		$ids = json_decode($_REQUEST['ids']);
		foreach($ids as $id)
		{
			$this->pro_disable_album($id);
		}
		$this->json_response(array('status' => 'ok'));
	}
	public function pro_bulk_enable_albums()
	{
		$ids = json_decode($_REQUEST['ids']);
		foreach($ids as $id)
		{
			$this->pro_enable_album($id);
		}
		$this->json_response(array('status' => 'ok'));
	}
	public function delete_image($image_id)
	{
		global $wpdb;
		$image = $this->get_image($image_id);
		if( !$image ) return null;
		$album_dir = pro_get_album_dir($image['category_id']);
		@unlink($album_dir .'/big/'. $image['image']);
		@unlink($album_dir .'/thumb/'. $image['thumb']);
		$wpdb->query("DELETE FROM {$wpdb->prefix}pro_images WHERE image_id = $image_id LIMIT 1");
		return true;
	}
	public function pro_bulk_delete_images()
	{
		$ids = json_decode($_REQUEST['ids']);
		$msg = '';
		foreach($ids as $id)
		{
			if( !$this->delete_image($id) )
				$msg .= 'Error delete image with id ' . $id. ' ';
		}
		$res = array('status' => 'ok', 'message' => 'Images deleted');
		if( !empty($msg) )
		{
			$res['status'] = 'error';
			$res['message'] = $msg;
		}
		$this->json_response($res);
	}
	public function pro_bulk_disable_images()
	{
		$ids = json_decode($_REQUEST['ids']);
		foreach($ids as $id)
		{
			$this->pro_disable_image($id);
		}
		$this->json_response(array('status' => 'ok'));
	}
	public function pro_bulk_enable_images()
	{
		$ids = json_decode($_REQUEST['ids']);
		foreach($ids as $id)
		{
			$this->pro_enable_image($id);
		}
		$this->json_response(array('status' => 'ok'));
	}
	public function pro_disable_album($album_id = null)
	{
		global $wpdb;
		$album_id = (int)$album_id;
		$album_id = isset($_REQUEST['album_id']) ? (int)$_REQUEST['album_id'] : $album_id;
		if( $album_id )
		{
			$wpdb->update($wpdb->prefix.'pro_albums', array('status' => 0), array('album_id' => $album_id));
		}
	}
	public function pro_enable_album($album_id = null)
	{
		global $wpdb;
		$album_id = (int)$album_id;
		$album_id = isset($_REQUEST['album_id']) ? (int)$_REQUEST['album_id'] : $album_id;
		if( $album_id )
			$wpdb->update($wpdb->prefix.'pro_albums', array('status' => 1), array('album_id' => $album_id));
	}
	public function pro_disable_image($image_id = null)
	{
		global $wpdb;
		$image_id = (int)$image_id;
		$image_id = isset( $_REQUEST['pro_image_id'] ) ? (int)$_REQUEST['pro_image_id'] : $image_id;
		if( $image_id)
			$wpdb->update($wpdb->prefix.'pro_images', array('status' => 0), array('image_id' => $image_id));
	}
	public function pro_enable_image($image_id = null)
	{
		global $wpdb;
		$image_id = (int)$image_id;
		$image_id = isset($_REQUEST['pro_image_id']) ? (int)$_REQUEST['pro_image_id'] : $image_id;
		if( $image_id )
			$wpdb->update($wpdb->prefix.'pro_images', array('status' => 1), array('image_id' => $image_id));
	}
}
$gpro = new SlideshowPro();
?>