<?php
function pro_get_def_settings()
{
	$pro_settings = array('bannerWidth' => '720',
			'bannerHeight' => '460',
			'backgroundColor' => '#ffffff',
			'wmode' => 'transparent',
			'imagewidth' => '516',
			'imageheight' => '397',
			'baseColor' => '92BB38',
			'thumbwidth' => '170',
			'thumbheight' => '115',
			'autoScale' => '1',
			'autoAlign' => '0',
			'showPlay' => '0',
			'autoSlideTimer' => '5',
			'gradientColor1' => 'BFBFBF',
			'gradientColor2' => 'E7E7E7',
			'pictureBoxColor' => '666666',
			'PictureThumbTitleColor' => 'FFFFFF',
			'TextColor' => 'FFFFFF',
			'TitleTextColor' => '00CC33',
			'transitionTime' => '1',
			'TextSize' => '10',
			'ThumbTextSize' => '11',
			'target' => '_self',
			'showimg_title' => 'yes',
			'show_desc' => 'yes'		
			);
	return $pro_settings;
}
function __get_pro_xml_settings()
{
	$ops = get_option('pro_settings', array());
	$xml_settings = '<baseDef showPlay="'.trim($ops['showPlay']).'" autoSlideTimer="'.intval($ops['autoSlideTimer']).'"  autoScale="'.trim($ops['autoScale']).'" autoAlign="'.trim($ops['autoAlign']).'" gradientColor1="0x'.trim($ops['gradientColor1']).'"  gradientColor2="0x'.trim($ops['gradientColor2']).'" pictureBoxColor= "0x'.trim($ops['pictureBoxColor']).'" PictureThumbTitleColor="0x'.trim($ops['PictureThumbTitleColor']).'" TextColor="0x'.trim($ops['TextColor']).'" TitleTextColor="0x'.trim($ops['TitleTextColor']).'" transitionTime="'.trim($ops['transitionTime']).'" TextSize="'.trim($ops['TextSize']).'" ThumbTextSize="'.trim($ops['ThumbTextSize']).'" />
';
	return $xml_settings;
}
function pro_get_album_dir($album_id)
{
	global $gpro;
	$album_dir = PRO_PLUGIN_UPLOADS_DIR . "/{$album_id}_uploadfolder";
	return $album_dir;
}
/**
 * Get album url
 * @param $album_id
 * @return unknown_type
 */
function pro_get_album_url($album_id)
{
	global $gpro;
	$album_url = PRO_PLUGIN_UPLOADS_URL . "/{$album_id}_uploadfolder";
	return $album_url;
}
function pro_get_table_actions(array $tasks)
{
	?>
	<div class="bulk_actions">
		<form action="" method="post" class="bulk_form">Bulk action
			<select name="task">
				<?php foreach($tasks as $t => $label): ?>
				<option value="<?php print $t; ?>"><?php print $label; ?></option>
				<?php endforeach; ?>
			</select>
			<button class="button-secondary do_bulk_actions" type="submit">Do</button>
		</form>
	</div>
	<?php 
}
function shortcode_display_pro_gallery($atts)
{
	$vars = shortcode_atts( array(
									'cats' => '',
									'imgs' => '',
								), 
							$atts );
	//extract( $vars );
	
	$ret = display_pro_gallery($vars);
	return $ret;
}
function display_pro_gallery($vars)
{
	global $wpdb, $gpro;
	$ops = get_option('pro_settings', array());
	//print_r($ops);
	$albums = null;
	$images = null;
	$cids = trim($vars['cats']);
	if (strlen($cids) != strspn($cids, "0123456789,")) {
		$cids = '';
		$vars['cats'] = '';
	}
	$imgs = trim($vars['imgs']);
	if (strlen($imgs) != strspn($imgs, "0123456789,")) {
		$imgs = '';
		$vars['imgs'] = '';
	}
	$categories = '';
	$xml_filename = '';
	if( !empty($cids) && $cids{strlen($cids)-1} == ',')
	{
		$cids = substr($cids, 0, -1);
	}
	if( !empty($imgs) && $imgs{strlen($imgs)-1} == ',')
	{
		$imgs = substr($imgs, 0, -1);
	}
	//check for xml file
	if( !empty($vars['cats']) )
	{
		$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';	
	}
	elseif( !empty($vars['imgs']))
	{
		$xml_filename = "image_".str_replace(',', '', $imgs) . '.xml';
	}
	else
	{
		$xml_filename = "pro_all.xml";
	}
	//die(PRO_PLUGIN_XML_DIR . '/' . $xml_filename);


	
	if( !empty($vars['cats']) )
	{
		$query = "SELECT * FROM {$wpdb->prefix}pro_albums WHERE album_id IN($cids) AND status = 1 ORDER BY `order` ASC";
		//print $query;
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gpro->pro_get_album_images($album['album_id']);
			if ($images && !empty($images) && is_array($images)) {
				$album_dir = pro_get_album_url($album['album_id']);//PRO_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				foreach($images as $key => $img)
				{
					if( $img['status'] == 0 ) continue;
											
					$categories .= '
					<pic url="'.$img['link'].'" target="'.$ops['target'].'" ';
					$categories .= '	thumb="'.str_replace(" ","-",$album_dir)."/thumb/".$img['thumb'].'" ';
					$categories .= 'pic="'.$album_dir."/big/".$img['image'].'">';
					if ($ops['showimg_title'] == 'yes') {
						$categories .= '<Title><![CDATA['.$img['title'].']]></Title>';
					}else{
						$categories .= '<Title><![CDATA[]]></Title>';
					}
					if ($ops['show_desc'] == 'yes') {
						$categories .= ' <desc><![CDATA['.$img['description'].']]></desc>';
					}else{
						$categories .= ' <desc><![CDATA[]]></desc>';
					}
				
					$categories .= '</pic>';			
				}
			}
		}
		//$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';
	}
	elseif( !empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}pro_images WHERE image_id IN($imgs) AND status = 1 ORDER BY `order` ASC";
		$images = $wpdb->get_results($query, ARRAY_A);
		if ($images && !empty($images) && is_array($images)) {
			foreach($images as $key => $img)
			{
				$album = $gpro->pro_get_album($img['category_id']);
				$album_dir = pro_get_album_url($album['album_id']);//PRO_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				if( $img['status'] == 0 ) continue;
				
				$categories .= '
					<pic url="'.$img['link'].'" target="'.$ops['target'].'" ';
					$categories .= '	thumb="'.str_replace(" ","-",$album_dir)."/thumb/".$img['thumb'].'" ';
					$categories .= 'pic="'.$album_dir."/big/".$img['image'].'">';
					if ($ops['showimg_title'] == 'yes') {
						$categories .= '<Title><![CDATA['.$img['title'].']]></Title>';
					}else{
						$categories .= '<Title><![CDATA[]]></Title>';
					}
					if ($ops['show_desc'] == 'yes') {
						$categories .= ' <desc><![CDATA['.$img['description'].']]></desc>';
					}else{
						$categories .= ' <desc><![CDATA[]]></desc>';
					}
				
					$categories .= '</pic>';	
			}
		}
	}
	//no values paremeters setted
	else//( empty($vars['cats']) && empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}pro_albums WHERE status = 1 ORDER BY `order` ASC";
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gpro->pro_get_album_images($album['album_id']);
			$album_dir = pro_get_album_url($album['album_id']);//PRO_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
			if ($images && !empty($images) && is_array($images)) {
				foreach($images as $key => $img)
				{
					if($img['status'] == 0 ) continue;
					
					$categories .= '
					<pic url="'.$img['link'].'" target="'.$ops['target'].'" ';
					$categories .= '	thumb="'.str_replace(" ","-",$album_dir)."/thumb/".$img['thumb'].'" ';
					$categories .= 'pic="'.$album_dir."/big/".$img['image'].'">';
					if ($ops['showimg_title'] == 'yes') {
						$categories .= '<Title><![CDATA['.$img['title'].']]></Title>';
					}else{
						$categories .= '<Title><![CDATA[]]></Title>';
					}
					if ($ops['show_desc'] == 'yes') {
						$categories .= ' <desc><![CDATA['.$img['description'].']]></desc>';
					}else{
						$categories .= ' <desc><![CDATA[]]></desc>';
					}
				
					$categories .= '</pic>';	
				}
			}
		}
		//$xml_filename = "pro_all.xml";
	}
	
	$xml_tpl = __get_pro_xml_template();
	$settings = __get_pro_xml_settings();
	$xml = str_replace(array('{settings}', '{categories}'), 
						array($settings, $categories), $xml_tpl);
	//write new xml file
	$fh = fopen(PRO_PLUGIN_XML_DIR . '/' . $xml_filename, 'w+');
	fwrite($fh, $xml);
	fclose($fh);
	//print "<h3>Generated filename: $xml_filename</h3>";
	//print $xml;
	if( file_exists(PRO_PLUGIN_XML_DIR . '/' . $xml_filename ) )
	{
		$fh = fopen(PRO_PLUGIN_XML_DIR . '/' . $xml_filename, 'r');
		$xml = fread($fh, filesize(PRO_PLUGIN_XML_DIR . '/' . $xml_filename));
		fclose($fh);
		//print "<h3>Getting xml file from cache: $xml_filename</h3>";
		$ret_str = "
		<script language=\"javascript\">AC_FL_RunContent = 0;</script>
<script src=\"".PRO_PLUGIN_URL."/js/AC_RunActiveContent.js\" language=\"javascript\"></script>

		<script language=\"javascript\"> 
	if (AC_FL_RunContent == 0) {
		alert(\"This page requires AC_RunActiveContent.js.\");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '".$ops['bannerWidth']."',
			'height', '".$ops['bannerHeight']."',
			'src', '".PRO_PLUGIN_URL."/js/wp_slideshowpro',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '".$ops['wmode']."',
			'devicefont', 'false',
			'id', 'xmlswf_vmpro',
			'bgcolor', '".$ops['backgroundColor']."',
			'name', 'xmlswf_vmpro',
			'menu', 'true',
			'allowFullScreen', 'true',
			'allowScriptAccess','sameDomain',
			'movie', '".PRO_PLUGIN_URL."/js/wp_slideshowpro',
			'salign', '',
			'flashVars','maxwidth=" . $ops['bannerWidth'] . "&amp;maxheight=".$ops['bannerHeight']."&amp;imagewidth=".$ops['imagewidth']."&amp;imageheight=".$ops['imageheight']."&amp;baseColor=".$ops['baseColor']."&amp;thumbwidth=".$ops['thumbwidth']."&amp;thumbheight=".$ops['thumbheight']."&amp;xmlfileurl=".PRO_PLUGIN_URL."/xml/$xml_filename'
			); //end AC code
	}
</script>
";
//echo PRO_PLUGIN_UPLOADS_URL."<hr>";
//		print $xml;
		return $ret_str;
	}
	return true;
}
function __get_pro_xml_template()
{
	$xml_tpl = '<?xml version="1.0" encoding="iso-8859-1"?>

<slideshow >
	{settings}
	{categories}
</slideshow>';
	return $xml_tpl;
}
?>