<?php
/*
Nextend FB Connect Settings Page
*/

$newfb_status = "normal";

if(isset($_POST['newfb_update_options'])) {
	if($_POST['newfb_update_options'] == 'Y') {
    foreach($_POST AS $k => $v){
      $_POST[$k] = stripslashes($v);
    }
		update_option("nextend_fb_connect", maybe_serialize($_POST));
		$newfb_status = 'update_success';
	}
}

if(!class_exists('NextendFBSettings')) {
class NextendFBSettings {
function NextendFB_Options_Page() {
  $domain = get_option('siteurl');
  $domain = str_replace(array('http://', 'https://'), array('',''), $domain);
  $domain = str_replace('www.', '', $domain);
  $a = explode("/",$domain);
  $domain = $a[0]; 
	?>

	<div class="wrap">
	<div id="newfb-options">
	<div id="newfb-title"><h2>Nextend Facebook Connect Settings</h2></div>
	<?php
	global $newfb_status;
	if($newfb_status == 'update_success')
		$message =__('Configuration updated', 'nextend-facebook-connect') . "<br />";
	else if($newfb_status == 'update_failed')
		$message =__('Error while saving options', 'nextend-facebook-connect') . "<br />";
	else
		$message = '';

	if($message != "") {
	?>
		<div class="updated"><strong><p><?php
		echo $message;
		?></p></strong></div><?php
	} ?>
  
  <?php
  if (!function_exists('curl_init')) {
  ?>
    <div class="error"><strong><p>Facebook needs the CURL PHP extension. Contact your server adminsitrator!</p></strong></div>
  <?php
  }else{
    $version = curl_version();
    $ssl_supported= ($version['features'] & CURL_VERSION_SSL);
    if(!$ssl_supported){
    ?>
      <div class="error"><strong><p>Protocol https not supported or disabled in libcurl. Contact your server adminsitrator!</p></strong></div>
    <?php
    }
  }
  if (!function_exists('json_decode')) {
    ?>
      <div class="error"><strong><p>Facebook needs the JSON PHP extension. Contact your server adminsitrator!</p></strong></div>
    <?php
  }
  ?>
  
	<div id="newfb-desc">
	<p><?php _e('This plugins helps you create Facebook login and register buttons. The login and register process only takes one click and you can fully customize the buttons with images and other assets.', 'nextend-facebook-connect'); ?></p>
	<h3><?php _e('Setup', 'nextend-facebook-connect'); ?></h3>
  <p>
  <?php _e('<ol><li><a href="https://developers.facebook.com/apps/?action=create" target="_blank">Create a facebook app!</a></li>', 'nextend-facebook-connect'); ?>
  <?php _e('<li>Choose an App Name, it can be anything you like</li>', 'nextend-facebook-connect'); ?>
  <?php _e('<li>Click on <b>Continue</b></li>', 'nextend-facebook-connect'); ?>
  <?php _e('<li>Go to the newly created <b>App settings page</b> and click <b>Edit Settings</b></li>', 'nextend-facebook-connect'); ?>
  <?php _e('<li>Fill out <b>App Domains</b> field with: <b>'.$domain.'</b></li>', 'nextend-facebook-connect'); ?>
  <?php _e('<li>Click on <b>Website with Facebook Login</b> tab abd fill out <b>Site URL</b> field with: <b>'.get_option('siteurl').'</b></li>', 'nextend-facebook-connect'); ?>
  <?php _e('<li>Click on <b>Save changes</b> and the top of the page contains the <b>App Id</b> and <b>App secret</b> which you have to copy and past below.</li>', 'nextend-facebook-connect'); ?>
  <?php _e('<li><b>Save changes!</b></li></ol>', 'nextend-facebook-connect'); ?>
  
  
  </p>
  <h3><?php _e('Usage', 'nextend-facebook-connect'); ?></h3>
  <h4><?php _e('Simple link', 'nextend-facebook-connect'); ?></h4>
	<p><?php _e('&lt;a href="'.new_fb_login_url().'&redirect='.get_option('siteurl').'" onclick="window.location = \''.new_fb_login_url().'&redirect=\'+window.location.href; return false;"&gt;Click here to login or register with Facebook&lt;/a&gt;', 'nextend-facebook-connect'); ?></p>
	
  <h4><?php _e('Image button', 'nextend-facebook-connect'); ?></h4>
	<p><?php _e('&lt;a href="'.new_fb_login_url().'&redirect='.get_option('siteurl').'" onclick="window.location = \''.new_fb_login_url().'&redirect=\'+window.location.href; return false;"&gt; &lt;img src="HereComeTheImage" /&gt; &lt;/a&gt;', 'nextend-facebook-connect'); ?></p>
  
  <h3><?php _e('Note', 'nextend-facebook-connect'); ?></h3>
  <p><?php _e('If the Facebook user\'s email address already used by another member of your site, the facebook profile will be automatically linked to the existing profile!', 'nextend-facebook-connect'); ?></p>
  
  </div>

	<!--right-->
	<div class="postbox-container" style="float:right;width:30%;">
	<div class="metabox-holder">
	<div class="meta-box-sortables">

	<!--about-->
	<div id="newfb-about" class="postbox">
	<h3 class="hndle"><?php _e('About this plugin', 'nextend-facebook-connect'); ?></h3>
	<div class="inside"><ul>
  
  <li><a href="http://www.nextendweb.com/social-connect-plugins-for-wordpress.html" target="_blank"><?php _e('Check the related <b>blog post</b>!', 'nextend-facebook-connect'); ?></a></li>
	<li><br></li>
	<li><a href="http://wordpress.org/extend/plugins/nextend-facebook-connect/" target="_blank"><?php _e('Nextend Facebook Connect', 'nextend-facebook-connect'); ?></a></li>
	<li><br></li>
  <li><a href="http://profiles.wordpress.org/nextendweb" target="_blank"><?php _e('Nextend  plugins at WordPress.org', 'nextend-facebook-connect'); ?></a></li>
	</ul></div>
	</div>
	<!--about end-->

	<!--others-->
	<!--others end-->

	</div></div></div>
	<!--right end-->

	<!--left-->
	<div class="postbox-container" style="float:left;width: 69%;">
	<div class="metabox-holder">
	<div class="meta-box-sortabless">

	<!--setting-->
	<div id="newfb-setting" class="postbox">
	<h3 class="hndle"><?php _e('Settings', 'nextend-facebook-connect'); ?></h3>
	<?php $nextend_fb_connect = maybe_unserialize(get_option('nextend_fb_connect')); ?>

	<form method="post" action="<?php echo get_bloginfo("wpurl"); ?>/wp-admin/options-general.php?page=nextend-facebook-connect">
	<input type="hidden" name="newfb_update_options" value="Y">

	<table class="form-table">
		<tr>
		<th scope="row"><?php _e('Facebook App ID:', 'nextend-facebook-connect'); ?></th>
		<td>
		<input type="text" name="fb_appid" value="<?php echo $nextend_fb_connect['fb_appid']; ?>" />
		</td>
		</tr>  
      
		<tr>
		<th scope="row"><?php _e('Facebook App Secret:', 'nextend-facebook-connect'); ?></th>
		<td>
		<input type="text" name="fb_secret" value="<?php echo $nextend_fb_connect['fb_secret']; ?>" />
		</td>
		</tr>

		<tr>
		<th scope="row"><?php _e('New user prefix:', 'nextend-facebook-connect'); ?></th>
		<td>
    <?php if(!isset($nextend_fb_connect['fb_user_prefix'])) $nextend_fb_connect['fb_user_prefix'] = 'Facebook - '; ?>
		<input type="text" name="fb_user_prefix" value="<?php echo $nextend_fb_connect['fb_user_prefix']; ?>" />
		</td>
		</tr>

		<tr>
		<th scope="row"><?php _e('Fixed redirect url for login:', 'nextend-facebook-connect'); ?></th>
		<td>
    <?php if(!isset($nextend_fb_connect['fb_redirect'])) $nextend_fb_connect['fb_redirect'] = 'auto'; ?>
		<input type="text" name="fb_redirect" value="<?php echo $nextend_fb_connect['fb_redirect']; ?>" />
		</td>
		</tr>

		<tr>
		<th scope="row"><?php _e('Fixed redirect url for register:', 'nextend-facebook-connect'); ?></th>
		<td>
    <?php if(!isset($nextend_fb_connect['fb_redirect_reg'])) $nextend_fb_connect['fb_redirect_reg'] = 'auto'; ?>
		<input type="text" name="fb_redirect_reg" value="<?php echo $nextend_fb_connect['fb_redirect_reg']; ?>" />
		</td>
		</tr>

		<tr>
		<th scope="row"><?php _e('Load button stylesheet:', 'nextend-facebook-connect'); ?></th>
		<td>
      <?php if(!isset($nextend_fb_connect['fb_load_style'])) $nextend_fb_connect['fb_load_style'] = 1; ?>
		<input name="fb_load_style" id="fb_load_style_yes" value="1" type="radio" <?php if(isset($nextend_fb_connect['fb_load_style']) && $nextend_fb_connect['fb_load_style']){?> checked <?php } ?>> Yes  &nbsp;&nbsp;&nbsp;&nbsp;
    <input name="fb_load_style" id="fb_load_style_no" value="0" type="radio" <?php if(isset($nextend_fb_connect['fb_load_style']) && $nextend_fb_connect['fb_load_style'] == 0){?> checked <?php } ?>> No		
		</td>
		</tr>
    
    <tr>
		<th scope="row"><?php _e('Login button:', 'nextend-facebook-connect'); ?></th>
		<td>
      <?php if(!isset($nextend_fb_connect['fb_login_button'])) $nextend_fb_connect['fb_login_button'] = '<div class="new-fb-btn new-fb-1 new-fb-default-anim"><div class="new-fb-1-1"><div class="new-fb-1-1-1">CONNECT WITH</div></div></div>'; ?>
		  <textarea cols="83" rows="3" name="fb_login_button"><?php echo $nextend_fb_connect['fb_login_button']; ?></textarea>
		</td>
		</tr>
    
    <tr>
		<th scope="row"><?php _e('Link account button:', 'nextend-facebook-connect'); ?></th>
		<td>
      <?php if(!isset($nextend_fb_connect['fb_link_button'])) $nextend_fb_connect['fb_link_button'] = '<div class="new-fb-btn new-fb-1 new-fb-default-anim"><div class="new-fb-1-1"><div class="new-fb-1-1-1">LINK ACCOUNT TO</div></div></div>'; ?>
		  <textarea cols="83" rows="3" name="fb_link_button"><?php echo $nextend_fb_connect['fb_link_button']; ?></textarea>
		</td>
		</tr>
    
    <tr>
		<th scope="row"><?php _e('Unlink account button:', 'nextend-facebook-connect'); ?></th>
		<td>
      <?php if(!isset($nextend_fb_connect['fb_unlink_button'])) $nextend_fb_connect['fb_unlink_button'] = '<div class="new-fb-btn new-fb-1 new-fb-default-anim"><div class="new-fb-1-1"><div class="new-fb-1-1-1">UNLINK ACCOUNT</div></div></div>'; ?>
		  <textarea cols="83" rows="3" name="fb_unlink_button"><?php echo $nextend_fb_connect['fb_unlink_button']; ?></textarea>
		</td>
		</tr>
    <tr>
		<th scope="row"></th>
		<td>
    <a href="http://www.nextendweb.com/social-connect-button-generator" target="_blank"><img style="margin-left: -4px;" src="<?php echo plugins_url('generatorbanner.png', __FILE__); ?>" /></a>
    </td>
		</tr>
	</table>

	<p class="submit">
	<input style="margin-left: 10%;" type="submit" name="Submit" value="<?php _e('Save Changes', 'nextend-facebook-connect'); ?>" />
	</p>
	</form>
	</div>
	<!--setting end-->

	<!--others-->
	<!--others end-->

	</div></div></div>
	<!--left end-->

	</div>
	</div>
	<?php
}

function NextendFB_Menu() {
	add_options_page(__('Nextend FB Connect'), __('Nextend FB Connect'), 'manage_options', 'nextend-facebook-connect', array(__CLASS__,'NextendFB_Options_Page'));
}

}
}
?>
