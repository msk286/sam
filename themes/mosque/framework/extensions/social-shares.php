<?php
/*	
	*	CrunchPress Social Sharing File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file return the Social Sharing to the selected post_type
	*	---------------------------------------------------------------------
	*/
	function cp_include_social_shares(){
		
		global $cp_social_settings;
		
		//Social Sharing 
		$facebook_sharing = '';
		$twitter_sharing = '';
		$stumble_sharing = '';
		$delicious_sharing = '';
		$googleplus_sharing = '';
		$digg_sharing = '';
		$myspace_sharing = '';
		$reddit_sharing = '';	
		$cp_social_settings = '';
		
		//Getting Values from database
		$cp_social_settings = get_option('social_settings');
		if($cp_social_settings <> ''){
			$cp_social = new DOMDocument ();
			$cp_social->loadXML ( $cp_social_settings );
		
			// Social Sharing Values
			$facebook_sharing = cp_find_xml_value($cp_social->documentElement,'facebook_sharing');
			$twitter_sharing = cp_find_xml_value($cp_social->documentElement,'twitter_sharing');
			$stumble_sharing = cp_find_xml_value($cp_social->documentElement,'stumble_sharing');
			$delicious_sharing = cp_find_xml_value($cp_social->documentElement,'delicious_sharing');
			$googleplus_sharing = cp_find_xml_value($cp_social->documentElement,'googleplus_sharing');
			$digg_sharing = cp_find_xml_value($cp_social->documentElement,'digg_sharing');
			$myspace_sharing = cp_find_xml_value($cp_social->documentElement,'myspace_sharing');
			$reddit_sharing = cp_find_xml_value($cp_social->documentElement,'reddit_sharing');
		}
	
	
	
		$currentUrl = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		if( !empty($_SERVER['HTTPS']) ){
			$currentUrl = "https://" . $currentUrl;
		}else{
			$currentUrl = "http://" . $currentUrl;
		}
		$facebook = 'http://www.facebook.com/share.php?u='.$currentUrl;
		$twitter = 'http://twitter.com/home?status='.str_replace(" ", "%20", get_the_title()).'%20-%20'.$currentUrl;
		$delicious = 'http://delicious.com/post?url='.$currentUrl.'&#038;title='.get_the_title();
		$gplus = 'https://plus.google.com/share?url={'.$currentUrl.'}';
		$reddit = 'http://reddit.com/submit?url='.$currentUrl.'&#038;title='.get_the_title();
		$digg = 'http://digg.com/submit?url='.$currentUrl.'&#038;title='.get_the_title();
		$myspace = 'http://www.myspace.com/Modules/PostTo/Pages/?u='.$currentUrl;
		?>
			<ul class="topbar-social topbar-social-cp">
				<?php if($facebook_sharing == 'enable'){ ?><li><a href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i><span><?php esc_html_e('Facebook','mosque_crunchpress');?></span></a></li><?php }?>
				<?php if($twitter_sharing == 'enable'){ ?><li><a href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i><span><?php esc_html_e('Twitter','mosque_crunchpress');?></span></a></li><?php }?>
				<?php if($delicious_sharing == 'enable'){ ?><li><a href="<?php echo esc_url($delicious);?>"><i class="fa fa-delicious"></i><span><?php esc_html_e('Delicious','mosque_crunchpress');?></span></a></li><?php }?>
				<?php if($googleplus_sharing == 'enable'){ ?><li><a href="<?php echo esc_url($gplus);?>"><i class="fa fa-google-plus"></i><span><?php esc_html_e('Google Plus','mosque_crunchpress');?></span></a></li><?php }?>
				<?php if($reddit_sharing == 'enable'){ ?><li><a href="<?php echo esc_url($reddit);?>"><i class="fa fa-reddit"></i><span><?php esc_html_e('Reddit','mosque_crunchpress');?></span></a></li><?php }?>
				<?php if($digg_sharing == 'enable'){ ?><li><a href="<?php echo esc_url($digg);?>"><i class="fa fa-digg"></i><span><?php esc_html_e('Digg','mosque_crunchpress');?></span></a></li><?php }?>
				<?php if($myspace_sharing == 'enable'){ ?><li><a href="<?php echo esc_url($myspace);?>"><i class="fa fa-maxcdn"></i><span><?php esc_html_e('My Space','mosque_crunchpress');?></span></a></li><?php }?>
			</ul>				
		<?php
	}
	
?>