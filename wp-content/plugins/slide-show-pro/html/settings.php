<?php
global $wpdb, $gpro;
$ops = get_option('pro_settings', array());
//$ops = array_merge($pro_settings, $ops);
?>
<div class="wrap">
	<h2><?php _e('Create XML File'); ?></h2>
	<form action="" method="post">
		<input type="hidden" name="task" value="save_pro_settings" />
		<table>
				<tr>
			<td title="<?php _e('Width of object.'); ?>"><?php _e('Gallery Width (px)'); ?></td>
			<td><input type="text" name="settings[bannerWidth]"  value="<?php print @$ops['bannerWidth']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Height of object '); ?>"><?php _e('Gallery Height (px)'); ?></td>
			<td><input type="text" name="settings[bannerHeight]"  value="<?php print @$ops['bannerHeight']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Flash object background color. For example: #CCCCCC.'); ?>"><?php _e('Flash object background color'); ?></td>
			<td><input type="text" name="settings[backgroundColor]" class="color {hash:true,caps:false}" value="<?php print @$ops['backgroundColor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Select the wmode of flash'); ?>"><?php _e('wmode'); ?></td>
			<td>
				<select name="settings[wmode]">
					<option value="opaque" <?php print (@$ops['wmode'] == 'opaque') ? 'selected' : ''; ?>><?php _e('opaque'); ?></option>
					<option value="transparent" <?php print (@$ops['wmode'] == 'transparent') ? 'selected' : ''; ?>><?php _e('transparent'); ?></option>
					<option value="window" <?php print (@$ops['wmode'] == 'window') ? 'selected' : ''; ?>><?php _e('window'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Images width'); ?>"><?php _e('Images width'); ?></td>
			<td><input type="text" name="settings[imagewidth]"  value="<?php print @$ops['imagewidth']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Images height'); ?>"><?php _e('Images height'); ?></td>
			<td><input type="text" name="settings[imageheight]"  value="<?php print @$ops['imageheight']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Base color'); ?>"><?php _e('Base color'); ?></td>
			<td><input type="text" name="settings[baseColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['baseColor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbs width'); ?>"><?php _e('Thumbs width'); ?></td>
			<td><input type="text" name="settings[thumbwidth]"  value="<?php print @$ops['thumbwidth']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumbs height'); ?>"><?php _e('Thumbs height'); ?></td>
			<td><input type="text" name="settings[thumbheight]"  value="<?php print @$ops['thumbheight']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Auto scale'); ?>"><?php _e('Auto scale'); ?></td>
			<td>
				<select name="settings[autoScale]">
					<option value="1" <?php print (@$ops['autoScale'] == '1') ? 'selected' : ''; ?>><?php _e('Yes'); ?></option>
					<option value="0" <?php print (@$ops['autoScale'] == '0') ? 'selected' : ''; ?>><?php _e('No'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Auto align'); ?>"><?php _e('Auto align'); ?></td>
			<td>
				<select name="settings[autoAlign]">
					<option value="1" <?php print (@$ops['autoAlign'] == '1') ? 'selected' : ''; ?>><?php _e('Yes'); ?></option>
					<option value="0" <?php print (@$ops['autoAlign'] == '0') ? 'selected' : ''; ?>><?php _e('No'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Show/Hide Play/Pause button'); ?>"><?php _e('Show Play Button'); ?></td>
			<td>
				<select name="settings[showPlay]">
					<option value="0" <?php print (@$ops['showPlay'] == '0') ? 'selected' : ''; ?>><?php _e('No'); ?></option>
					<option value="1" <?php print (@$ops['showPlay'] == '1') ? 'selected' : ''; ?>><?php _e('Yes'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Auto play time in seconds. Set 0(zero) to disable auto play'); ?>"><?php _e('Auto Play time'); ?></td>
			<td><input type="text" name="settings[autoSlideTimer]"  value="<?php print @$ops['autoSlideTimer']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Gradient Color 1'); ?>"><?php _e('Gradient Color 1'); ?></td>
			<td><input type="text" name="settings[gradientColor1]" class="color {hash:false,caps:false}" value="<?php print @$ops['gradientColor1']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Gradient Color 2'); ?>"><?php _e('Gradient Color 2'); ?></td>
			<td><input type="text" name="settings[gradientColor2]" class="color {hash:false,caps:false}" value="<?php print @$ops['gradientColor2']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Picture box color'); ?>"><?php _e('Picture box color'); ?></td>
			<td><input type="text" name="settings[pictureBoxColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['pictureBoxColor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Picture thumb title color'); ?>"><?php _e('Picture thumb title color'); ?></td>
			<td><input type="text" name="settings[PictureThumbTitleColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['PictureThumbTitleColor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Text color'); ?>"><?php _e('Text color'); ?></td>
			<td><input type="text" name="settings[TextColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['TextColor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Title text color'); ?>"><?php _e('Title text color'); ?></td>
			<td><input type="text" name="settings[TitleTextColor]" class="color {hash:false,caps:false}" value="<?php print @$ops['TitleTextColor']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Transition Time'); ?>"><?php _e('Transition Time'); ?></td>
			<td><input type="text" name="settings[transitionTime]"  value="<?php print @$ops['transitionTime']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Text size'); ?>"><?php _e('Text size'); ?></td>
			<td><input type="text" name="settings[TextSize]"  value="<?php print @$ops['TextSize']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Thumb text size'); ?>"><?php _e('Thumb text size'); ?></td>
			<td><input type="text" name="settings[ThumbTextSize]"  value="<?php print @$ops['ThumbTextSize']; ?>" /></td>
		</tr>
		<tr>
			<td title="<?php _e('Where do you load the target url when user clicks on the link'); ?>"><?php _e('Traget Link'); ?></td>
			<td>
				<select name="settings[target]">
					<option value="_blank" <?php print (@$ops['target'] == '_blank') ? 'selected' : ''; ?>><?php _e('_blank'); ?></option>
					<option value="_self" <?php print (@$ops['target'] == '_self') ? 'selected' : ''; ?>><?php _e('_self'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Show/Hide Image Titles On Thumbnails'); ?>"><?php _e('Show Image Titles'); ?></td>
			<td>
				<input type="radio" name="settings[showimg_title]" value="yes" <?php print (@$ops['showimg_title'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[showimg_title]" value="no" <?php print (@$ops['showimg_title'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>
		<tr>
			<td title="<?php _e('Show/Hide Description'); ?>"><?php _e('Show Description'); ?></td>
			<td>
				<input type="radio" name="settings[show_desc]" value="yes" <?php print (@$ops['show_desc'] == 'yes') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[show_desc]" value="no" <?php print (@$ops['show_desc'] == 'no') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>
		</table>
	<p><button type="submit" class="button-primary"><?php _e('Save Config'); ?></button></p>
	</form>
</div>