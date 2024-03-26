<?php
/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
*/


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once(str_replace('\\\\','/',dirname(__FILE__)).'/bd.php');
require_once(str_replace('\\\\','/',dirname(__FILE__)).'/functions.php');
require_once(str_replace('\\\\','/',dirname(__FILE__)).'/auth.php');

if (text("under_construction")=="1" and $GLOBALS['user']['status']<3) {
header("Location: auth_500.php");
exit;
}



$GLOBALS['value']['fa']=array("fa fa-flag", "fa fa-fire", "fa fa-filter", "fa fa-flash", "fa fa-flask", "fa fa-wrench", "fa fa-tachometer", "fa fa-steam", "fa fa-sort-amount-desc", "fa fa-sort-amount-asc", "fa fa-space-shuttle", "fa fa-sliders", "fa fa-signal", "fa fa-send-o", "fa fa-rocket", "fa fa-plane", "fa fa-gears", "fa fa-cubes", "fa fa-building", "fa fa-adjust", "fa fa-adn", "fa fa-align-center", "fa fa-align-justify", "fa fa-align-left", "fa fa-align-right", "fa fa-ambulance", "fa fa-anchor", "fa fa-android", "fa fa-angle-double-down", "fa fa-angle-double-left", "fa fa-angle-double-right", "fa fa-angle-double-up", "fa fa-angle-down", "fa fa-angle-left", "fa fa-angle-right", "fa fa-angle-up", "fa fa-apple", "fa fa-archive", "fa fa-arrow-circle-down", "fa fa-arrow-circle-left", "fa fa-arrow-circle-o-down", "fa fa-arrow-circle-o-left", "fa fa-arrow-circle-o-right", "fa fa-arrow-circle-o-up", "fa fa-arrow-circle-right", "fa fa-arrow-circle-up", "fa fa-arrow-down", "fa fa-arrow-left", "fa fa-arrow-right", "fa fa-arrows", "fa fa-arrows-alt", "fa fa-arrows-h", "fa fa-arrows-v", "fa fa-arrow-up", "fa fa-asterisk", "fa fa-automobile", "fa fa-backward", "fa fa-ban", "fa fa-bank", "fa fa-bar-chart-o", "fa fa-barcode", "fa fa-bars", "fa fa-beer", "fa fa-behance", "fa fa-behance-square", "fa fa-bell", "fa fa-bell-o", "fa fa-bitbucket", "fa fa-bitbucket-square", "fa fa-bitcoin", "fa fa-bold", "fa fa-bolt", "fa fa-bomb", "fa fa-book", "fa fa-bookmark", "fa fa-bookmark-o", "fa fa-briefcase", "fa fa-btc", "fa fa-bug", "fa fa-building-o", "fa fa-bullhorn", "fa fa-bullseye", "fa fa-cab", "fa fa-calendar", "fa fa-calendar-o", "fa fa-camera", "fa fa-camera-retro", "fa fa-car", "fa fa-caret-down", "fa fa-caret-left", "fa fa-caret-right", "fa fa-caret-square-o-down", "fa fa-caret-square-o-left", "fa fa-caret-square-o-right", "fa fa-caret-square-o-up", "fa fa-caret-up", "fa fa-certificate", "fa fa-chain", "fa fa-chain-broken", "fa fa-check", "fa fa-check-circle", "fa fa-check-circle-o", "fa fa-check-square", "fa fa-check-square-o", "fa fa-chevron-circle-down", "fa fa-chevron-circle-left", "fa fa-chevron-circle-right", "fa fa-chevron-circle-up", "fa fa-chevron-down", "fa fa-chevron-left", "fa fa-chevron-right", "fa fa-chevron-up", "fa fa-child", "fa fa-circle", "fa fa-circle-o", "fa fa-circle-o-notch", "fa fa-circle-thin", "fa fa-clipboard", "fa fa-clock-o", "fa fa-cloud", "fa fa-cloud-download", "fa fa-cloud-upload", "fa fa-cny", "fa fa-code", "fa fa-code-fork", "fa fa-codepen", "fa fa-coffee", "fa fa-cog", "fa fa-cogs", "fa fa-columns", "fa fa-comment", "fa fa-comment-o", "fa fa-comments", "fa fa-comments-o", "fa fa-compass", "fa fa-compress", "fa fa-copy", "fa fa-credit-card", "fa fa-crop", "fa fa-crosshairs", "fa fa-css3", "fa fa-cube", "fa fa-cut", "fa fa-cutlery", "fa fa-dashboard", "fa fa-database", "fa fa-dedent", "fa fa-delicious", "fa fa-desktop", "fa fa-deviantart", "fa fa-digg", "fa fa-dollar", "fa fa-dot-circle-o", "fa fa-download", "fa fa-dribbble", "fa fa-dropbox", "fa fa-drupal", "fa fa-edit", "fa fa-eject", "fa fa-ellipsis-h", "fa fa-ellipsis-v", "fa fa-empire", "fa fa-envelope", "fa fa-envelope-o", "fa fa-envelope-square", "fa fa-eraser", "fa fa-eur", "fa fa-euro", "fa fa-exchange", "fa fa-exclamation", "fa fa-exclamation-circle", "fa fa-exclamation-triangle", "fa fa-expand", "fa fa-external-link", "fa fa-external-link-square", "fa fa-eye", "fa fa-eye-slash", "fa fa-facebook", "fa fa-facebook-square", "fa fa-fast-backward", "fa fa-fast-forward", "fa fa-fax", "fa fa-female", "fa fa-fighter-jet", "fa fa-file", "fa fa-file-archive-o", "fa fa-file-audio-o", "fa fa-file-code-o", "fa fa-file-excel-o", "fa fa-file-image-o", "fa fa-file-movie-o", "fa fa-file-o", "fa fa-file-pdf-o", "fa fa-file-photo-o", "fa fa-file-picture-o", "fa fa-file-powerpoint-o", "fa fa-files-o", "fa fa-file-sound-o", "fa fa-file-text", "fa fa-file-text-o", "fa fa-file-video-o", "fa fa-file-word-o", "fa fa-file-zip-o", "fa fa-film", "fa fa-fire-extinguisher", "fa fa-flag-checkered", "fa fa-flag-o", "fa fa-flickr", "fa fa-floppy-o", "fa fa-folder", "fa fa-folder-o", "fa fa-folder-open", "fa fa-folder-open-o", "fa fa-font", "fa fa-forward", "fa fa-foursquare", "fa fa-frown-o", "fa fa-gamepad", "fa fa-gavel", "fa fa-gbp", "fa fa-ge", "fa fa-gear", "fa fa-gift", "fa fa-git", "fa fa-github", "fa fa-github-alt", "fa fa-github-square", "fa fa-git-square", "fa fa-gittip", "fa fa-glass", "fa fa-globe", "fa fa-google", "fa fa-google-plus", "fa fa-google-plus-square", "fa fa-graduation-cap", "fa fa-group", "fa fa-hacker-news", "fa fa-hand-o-down", "fa fa-hand-o-left", "fa fa-hand-o-right", "fa fa-hand-o-up", "fa fa-hdd-o", "fa fa-header", "fa fa-headphones", "fa fa-heart", "fa fa-heart-o", "fa fa-history", "fa fa-home", "fa fa-hospital-o", "fa fa-h-square", "fa fa-html5", "fa fa-image", "fa fa-inbox", "fa fa-indent", "fa fa-info", "fa fa-info-circle", "fa fa-inr", "fa fa-instagram", "fa fa-institution", "fa fa-italic", "fa fa-joomla", "fa fa-jpy", "fa fa-jsfiddle", "fa fa-key", "fa fa-keyboard-o", "fa fa-krw", "fa fa-language", "fa fa-laptop", "fa fa-leaf", "fa fa-legal", "fa fa-lemon-o", "fa fa-level-down", "fa fa-level-up", "fa fa-life-bouy", "fa fa-life-ring", "fa fa-life-saver", "fa fa-lightbulb-o", "fa fa-link", "fa fa-linkedin", "fa fa-linkedin-square", "fa fa-linux", "fa fa-list", "fa fa-list-alt", "fa fa-list-ol", "fa fa-list-ul", "fa fa-location-arrow", "fa fa-lock", "fa fa-long-arrow-down", "fa fa-long-arrow-left", "fa fa-long-arrow-right", "fa fa-long-arrow-up", "fa fa-magic", "fa fa-magnet", "fa fa-mail-forward", "fa fa-mail-reply", "fa fa-mail-reply-all", "fa fa-male", "fa fa-map-marker", "fa fa-maxcdn", "fa fa-medkit", "fa fa-meh-o", "fa fa-microphone", "fa fa-microphone-slash", "fa fa-minus", "fa fa-minus-circle", "fa fa-minus-square", "fa fa-minus-square-o", "fa fa-mobile", "fa fa-mobile-phone", "fa fa-money", "fa fa-moon-o", "fa fa-mortar-board", "fa fa-music", "fa fa-navicon", "fa fa-openid", "fa fa-outdent", "fa fa-pagelines", "fa fa-paperclip", "fa fa-paper-plane", "fa fa-paper-plane-o", "fa fa-paragraph", "fa fa-paste", "fa fa-pause", "fa fa-paw", "fa fa-pencil", "fa fa-pencil-square", "fa fa-pencil-square-o", "fa fa-phone", "fa fa-phone-square", "fa fa-photo", "fa fa-picture-o", "fa fa-pied-piper", "fa fa-pied-piper-alt", "fa fa-pinterest", "fa fa-pinterest-square", "fa fa-play", "fa fa-play-circle", "fa fa-play-circle-o", "fa fa-plus", "fa fa-plus-circle", "fa fa-plus-square", "fa fa-plus-square-o", "fa fa-power-off", "fa fa-print", "fa fa-puzzle-piece", "fa fa-qq", "fa fa-qrcode", "fa fa-question", "fa fa-question-circle", "fa fa-quote-left", "fa fa-quote-right", "fa fa-ra", "fa fa-random", "fa fa-rebel", "fa fa-recycle", "fa fa-reddit", "fa fa-reddit-square", "fa fa-refresh", "fa fa-renren", "fa fa-reorder", "fa fa-repeat", "fa fa-reply", "fa fa-reply-all", "fa fa-retweet", "fa fa-rmb", "fa fa-road", "fa fa-rotate-left", "fa fa-rotate-right", "fa fa-rouble", "fa fa-rss", "fa fa-rss-square", "fa fa-rub", "fa fa-ruble", "fa fa-rupee", "fa fa-save", "fa fa-scissors", "fa fa-search", "fa fa-search-minus", "fa fa-search-plus", "fa fa-send", "fa fa-share", "fa fa-share-alt", "fa fa-share-alt-square", "fa fa-share-square", "fa fa-share-square-o", "fa fa-shield", "fa fa-shopping-cart", "fa fa-sign-in", "fa fa-sign-out", "fa fa-sitemap", "fa fa-skype", "fa fa-slack", "fa fa-smile-o", "fa fa-sort", "fa fa-sort-alpha-asc", "fa fa-sort-alpha-desc", "fa fa-sort-asc", "fa fa-sort-desc", "fa fa-sort-down", "fa fa-sort-numeric-asc", "fa fa-sort-numeric-desc", "fa fa-sort-up", "fa fa-soundcloud", "fa fa-spinner", "fa fa-spoon", "fa fa-spotify", "fa fa-square", "fa fa-square-o", "fa fa-stack-exchange", "fa fa-stack-overflow", "fa fa-star", "fa fa-star-half", "fa fa-star-half-empty", "fa fa-star-half-full", "fa fa-star-half-o", "fa fa-star-o", "fa fa-steam-square", "fa fa-step-backward", "fa fa-step-forward", "fa fa-stethoscope", "fa fa-stop", "fa fa-strikethrough", "fa fa-stumbleupon", "fa fa-stumbleupon-circle", "fa fa-subscript", "fa fa-suitcase", "fa fa-sun-o", "fa fa-superscript", "fa fa-support", "fa fa-table", "fa fa-tablet", "fa fa-tag", "fa fa-tags", "fa fa-tasks", "fa fa-taxi", "fa fa-tencent-weibo", "fa fa-terminal", "fa fa-text-height", "fa fa-text-width", "fa fa-th", "fa fa-th-large", "fa fa-th-list", "fa fa-thumbs-down", "fa fa-thumbs-o-down", "fa fa-thumbs-o-up", "fa fa-thumbs-up", "fa fa-thumb-tack", "fa fa-ticket", "fa fa-times", "fa fa-times-circle", "fa fa-times-circle-o", "fa fa-tint", "fa fa-toggle-down", "fa fa-toggle-left", "fa fa-toggle-right", "fa fa-toggle-up", "fa fa-trash-o", "fa fa-tree", "fa fa-trello", "fa fa-trophy", "fa fa-truck", "fa fa-try", "fa fa-tumblr", "fa fa-tumblr-square", "fa fa-turkish-lira", "fa fa-twitter", "fa fa-twitter-square", "fa fa-umbrella", "fa fa-underline", "fa fa-undo", "fa fa-university", "fa fa-unlink", "fa fa-unlock", "fa fa-unlock-alt", "fa fa-unsorted", "fa fa-upload", "fa fa-usd", "fa fa-user", "fa fa-user-md", "fa fa-users", "fa fa-video-camera", "fa fa-vimeo-square", "fa fa-vine", "fa fa-vk", "fa fa-volume-down", "fa fa-volume-off", "fa fa-volume-up", "fa fa-warning", "fa fa-wechat", "fa fa-weibo", "fa fa-weixin", "fa fa-wheelchair", "fa fa-windows", "fa fa-won", "fa fa-wordpress", "fa fa-xing", "fa fa-xing-square", "fa fa-yahoo", "fa fa-yen", "fa fa-youtube", "fa fa-youtube-play", "fa fa-youtube-square");
$GLOBALS['user']['user-agent']=user_agent();
$id="";
$mod="";
$agets=array();
$asces=array();



if ($GLOBALS['user']['status']==1) { 

	array_push($agets, "profile");

	array_push($asces, "profile");

}elseif ($GLOBALS['user']['status']==2) { 

	array_push($agets, "posts_add");
	array_push($agets, "users_list", "users_edit");
	array_push($agets, "profile");


	array_push($asces, "ajax_users_update");
	array_push($asces, "users_edit");
	array_push($asces, "profile");
	
}elseif ($GLOBALS['user']['status']==3) { 

	array_push($agets, "faq");
	array_push($agets, "text_add", "text_list", "text_edit", "text_delete");
	array_push($agets, "pages_add", "pages_list", "pages_edit", "pages_delete");
	array_push($agets, "topmenu_add", "topmenu_list", "topmenu_edit", "topmenu_delete");
	array_push($agets, "news_add", "news_list", "news_edit", "news_delete");
	array_push($agets, "slides_add", "slides_list", "slides_edit", "slides_delete");
	array_push($agets, "partners_add", "partners_list", "partners_edit", "partners_delete");
	array_push($agets, "users_list", "users_edit", "users_delete");
	array_push($agets, "followers_add", "followers_list", "followers_edit", "followers_delete", "followers_confirm");
	array_push($agets, "plain_edit_text_main_about");
	array_push($agets, "plain_edit_text_footer");
	array_push($agets, "plain_edit_text_social");
	array_push($agets, "catalog_add", "catalog_list", "catalog_edit", "catalog_delete");
	array_push($agets, "items_add", "items_list", "items_edit", "items_delete", "items_files_delete");
	array_push($agets, "filemanager_list");
	
	array_push($asces, "text_add", "text_edit");
	array_push($asces, "pages_add", "pages_edit", "ajax_changestatuspages", "ajax_pages_position");
	array_push($asces, "topmenu_add", "topmenu_edit", "ajax_changestatustopmenu", "ajax_topmenu_position");
	array_push($asces, "news_add", "news_edit", "ajax_changestatusnews");
	array_push($asces, "slides_add", "slides_edit", "ajax_changestatusslides", "ajax_slides_position");
	array_push($asces, "partners_add", "partners_edit", "ajax_changestatuspartners", "ajax_partners_position");
	array_push($asces, "ajax_text", "ajax_text_dp");
	array_push($asces, "users_edit");
	array_push($asces, "followers_add", "followers_edit");
	array_push($asces, "plain_edit_text_main_about");
	array_push($asces, "plain_edit_text_footer");
	array_push($asces, "plain_edit_text_social");
	array_push($asces, "catalog_add", "catalog_edit", "ajax_catalog_position", "ajax_changestatuscatalog");
	array_push($asces, "items_add", "items_edit", "ajax_changestatusitems");
	array_push($asces, "ajax_items_list1", "ajax_items_list2", "ajax_items_multicheck");
	array_push($asces, "ajax_functions_slug");
	
	array_push($agets, "profile");

	array_push($asces, "ajax_users_update");
	array_push($asces, "ajax_followers_update");
	array_push($asces, "profile");

}elseif ($GLOBALS['user']['status']==4) { 

	array_push($agets, "faq");
	array_push($agets, "text_add", "text_list", "text_edit", "text_delete");
	array_push($agets, "pages_add", "pages_list", "pages_edit", "pages_delete");
	array_push($agets, "topmenu_add", "topmenu_list", "topmenu_edit", "topmenu_delete");
	array_push($agets, "news_add", "news_list", "news_edit", "news_delete");
	array_push($agets, "slides_add", "slides_list", "slides_edit", "slides_delete");
	array_push($agets, "partners_add", "partners_list", "partners_edit", "partners_delete");
	array_push($agets, "users_list", "users_edit", "users_delete");
	array_push($agets, "followers_add", "followers_list", "followers_edit", "followers_delete", "followers_confirm");
	array_push($agets, "plain_edit_text_main_about");
	array_push($agets, "plain_edit_text_footer");
	array_push($agets, "plain_edit_text_social");
	array_push($agets, "catalog_add", "catalog_list", "catalog_edit", "catalog_delete");
	array_push($agets, "items_add", "items_list", "items_edit", "items_delete", "items_files_delete");
	
	array_push($asces, "text_add", "text_edit");
	array_push($asces, "pages_add", "pages_edit", "ajax_changestatuspages", "ajax_pages_position");
	array_push($asces, "topmenu_add", "topmenu_edit", "ajax_changestatustopmenu", "ajax_topmenu_position");
	array_push($asces, "news_add", "news_edit", "ajax_changestatusnews");
	array_push($asces, "slides_add", "slides_edit", "ajax_changestatusslides", "ajax_slides_position");
	array_push($asces, "partners_add", "partners_edit", "ajax_changestatuspartners", "ajax_partners_position");
	array_push($asces, "ajax_text", "ajax_text_dp");
	array_push($asces, "users_edit");
	array_push($asces, "followers_add", "followers_edit");
	array_push($asces, "plain_edit_text_main_about");
	array_push($asces, "plain_edit_text_footer");
	array_push($asces, "plain_edit_text_social");
	array_push($asces, "catalog_add", "catalog_edit", "ajax_catalog_position", "ajax_changestatuscatalog");
	array_push($asces, "items_add", "items_edit", "ajax_changestatusitems");
	array_push($asces, "ajax_items_list1", "ajax_items_list2", "ajax_items_multicheck");
	array_push($asces, "ajax_functions_slug");
	
	array_push($agets, "profile");

	array_push($asces, "ajax_users_update");
	array_push($asces, "ajax_followers_update");
	array_push($asces, "profile");
	

}elseif ($GLOBALS['user']['status']==9) { 

	array_push($agets, "pages_add", "pages_list", "pages_edit", "pages_delete");
	array_push($agets, "news_add", "news_list", "news_edit", "news_delete");
	array_push($agets, "slides_add", "slides_list", "slides_edit", "slides_delete");
	array_push($agets, "partners_add", "partners_list", "partners_edit", "partners_delete");
	array_push($agets, "plain_edit_text_main_about");
	array_push($agets, "plain_edit_text_social");
	
	array_push($asces, "pages_add", "pages_edit", "ajax_changestatuspages", "ajax_pages_position");
	array_push($asces, "news_add", "news_edit", "ajax_changestatusnews");
	array_push($asces, "slides_add", "slides_edit", "ajax_changestatusslides", "ajax_slides_position");
	array_push($asces, "partners_add", "partners_edit", "ajax_changestatuspartners", "ajax_partners_position");
	array_push($asces, "plain_edit_text_main_about");
	array_push($asces, "plain_edit_text_social");

	
	array_push($agets, "profile");

	array_push($asces, "profile");

}elseif ($GLOBALS['user']['status']==8) { 

	array_push($agets, "news_add", "news_list", "news_edit", "news_delete");
	array_push($agets, "catalog_add", "catalog_list", "catalog_edit", "catalog_delete");
	array_push($agets, "items_add", "items_list", "items_edit", "items_delete", "items_files_delete");
	array_push($agets, "followers_add", "followers_list", "followers_edit", "followers_delete", "followers_confirm");

	array_push($asces, "news_add", "news_edit", "ajax_changestatusnews");
	array_push($asces, "catalog_add", "catalog_edit", "ajax_catalog_position", "ajax_changestatuscatalog");
	array_push($asces, "items_add", "items_edit", "ajax_changestatusitems");
	array_push($asces, "ajax_items_list1", "ajax_items_list2", "ajax_items_multicheck");
	array_push($asces, "ajax_functions_slug");
	array_push($asces, "ajax_followers_update");
	array_push($asces, "followers_add", "followers_edit");

	
	array_push($agets, "profile");

	array_push($asces, "profile");


}else{

	array_push($agets, "profile");

	array_push($asces, "profile");

}



if ($GLOBALS['user']['blocked']=="1") { red('auth_logout.php'); }

if (isset($_POST['sce'])) if (in_array($_POST['sce'], $asces)) { $sce=$_POST['sce']; } // else { red('/?mod=logs_list'); }




if ($sce=="ajax_functions_slug") {



if (mb_strlen($_POST['table'])>0 and mb_strlen($_POST['name'])>0 and is_numeric($_POST['edit'])) {
	if (in_array($_POST['type'], array("en", "cn"))) {
		$field="slug_".$_POST['type'];
	}else{
		$field="slug";
	}
	$slug=slug(urldecode($_POST['name']), $_POST['table'], $_POST['edit'], $field);

}
	
echo json_encode(array("result" => "1", "slug" => $slug));
exit;	
	
}



if ($sce=="ajax_items_list2") {
	
	$in1="";
	$in2="";
	$in3="";
	$regs=array();
	
if (is_numeric($_POST['id']) and $_POST['id']>0) { $id=$_POST['id']; } else { $id=0; }
if ($id>0) {
	$regs=regionlist($id);
	if (count($regs)==3) {
		$in3=$regs[2];
		$in2=$regs[1];
		$in1=$regs[0];
	}elseif(count($regs)==2) {
		$in2=$regs[1];
		$in1=$regs[0];
		// $in1="";
	}elseif(count($regs)==1) {
		$in1=$regs[0];
		// $in2="";
		// $in1="";
	}
}/*else{
	$in3=319;
	$in2=242;
	$in1=145;
}*/

if (is_numeric($_POST['list1']) and $_POST['list1']>0) { $in1=$_POST['list1']; } elseif(mb_strlen($in1.$in2.$in3)==0) { $in1=145; }
if (is_numeric($_POST['list2']) and $_POST['list2']>0) { $in2=$_POST['list2']; } elseif(mb_strlen($in2.$in3)==0) { $in2=242; }
if (is_numeric($_POST['list3']) and $_POST['list3']>0) { $in3=$_POST['list3']; } elseif(mb_strlen($in3)==0) { $in3=319; }




$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent`='0' and `status`='1' ORDER BY `name`;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {
$k=0;	
	do {
		$k++;
		if ($k==1) { $first1=$arsql['id']; }
		if ($in1==$arsql['id']) { $s=" SELECTED"; $val1=$arsql['id']; } else { $s=""; }
		if (haskids("catalog", $arsql['id'])) { $dis=" disabled=\"disabled\""; } else { $dis=""; }
		$list1.="<option value=\"".d($arsql['id'])."\"".$dis."".$s.">".d($arsql['name'])."</option>";
	}while($arsql=mysql_fetch_assoc($str));
}

if ($val1>0) {
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent`='".sql($val1)."' and `status`='1' ORDER BY `name`;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {
$k=0;		
	do {
		$k++;
		if ($k==1) { $first2=$arsql['id']; }
		if ($in2==$arsql['id']) { $s=" SELECTED"; $val2=$arsql['id']; } else { $s=""; }
		$list2.="<option value=\"".d($arsql['id'])."\"".$s.">".d($arsql['name'])."</option>";
	}while($arsql=mysql_fetch_assoc($str));
}
}

if ($val2>0) {
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent`='".sql($val2)."' and `status`='1' ORDER BY `name`;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {	
$k=0;	
	do {
		$k++;
		if ($k==1) { $first3=$arsql['id']; }
		if ($in3==$arsql['id']) { $s=" SELECTED"; $val3=$arsql['id']; } else { $s=""; }
		$list3.="<option value=\"".d($arsql['id'])."\"".$s.">".d($arsql['name'])."</option>";
	}while($arsql=mysql_fetch_assoc($str));
}
}

if (mb_strlen($list1)>0 and $val1==0) { $val1=$first1; }
if (mb_strlen($list2)>0 and $val2==0) { $val2=$first2; }
if (mb_strlen($list3)>0 and $val3==0) { $val3=$first3; }


if (mb_strlen($list2)>0) { $hide2=0; } else { $hide2=1; }
if (mb_strlen($list3)>0) { $hide3=0; } else { $hide3=1; }

echo json_encode(array("result" => "1", "list1" => $list1, "list2" => $list2, "list3" => $list3, "val1" => $val1, "val2" => $val2, "val3" => $val3, "hide2" => $hide2, "hide3" => $hide3));

exit;	

}


if ($sce=="ajax_items_multicheck") {

if (is_numeric($_POST['id'])) { $id=$_POST['id']; } else { $id=0; }

	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0"));
		exit;
	}

	mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."items_multiedit` WHERE `stamp`<'".sql(time()-60)."'");

	
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_multiedit` WHERE `item`='".sql($id)."' and `user`='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."items_multiedit` (`item`, `user`, `stamp`, `start`) VALUES ('".sql($id)."', '".sql($GLOBALS['user']['id'])."', '".sql(time())."', '".sql(time())."')");
	}else{
		mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items_multiedit` SET `stamp`='".sql(time())."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
	}
	
	
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_multiedit` WHERE `item`='".sql($id)."' ORDER BY `start`;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows>1) {
		$html="<div role=\"alert\" class=\"multiedit alert alert-warning fade show\"><i class=\"fa fa-info\"></i> В данный момент объявление редактируют администраторы: ";
		$adms=array();
		do {
			$adm=user($arsql['user']);
			$adms[]=$adm['login'];
		}while($arsql=mysql_fetch_assoc($str));
		$html.=implode(", ", $adms);
		$html.="</div>";
	}else{
		$html="";
	}
	
	

		
echo json_encode(array("result" => "1", "html" => $html));
exit;

}

if ($sce=="ajax_items_list1") {

if (!in_array($_POST['type'], array("p", "s", "k"))) {
	echo json_encode(array("result" => "0"));
	exit;
}

if (is_numeric($_POST['id'])) { $id=$_POST['id']; } else { $id=0; }

$html=catalog_list1($_POST['type'], $id);

		
echo json_encode(array("result" => "1", "html" => $html));
exit;

}

if ($sce=="ajax_changestatusnews") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status']=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."news` SET `status`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
		}elseif ($arsql['status']=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."news` SET `status`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_changestatusslides") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status']=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."slides` SET `status`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
		}elseif ($arsql['status']=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."slides` SET `status`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_changestatuspartners") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status']=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."partners` SET `status`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
		}elseif ($arsql['status']=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."partners` SET `status`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_changestatusslides") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status']=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."slides` SET `status`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
		}elseif ($arsql['status']=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."slides` SET `status`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_changestatusitems") {


	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status']=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items` SET `status`='2' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-warning"; 
			$html="<i class=\"fa fa-eye\"></i>"; 
			
				if ($arsql['stamp']>(time()-86400)) {
					countadd($arsql['catalog'], $arsql['type'], 0, -1);
				}else{
					countadd($arsql['catalog'], $arsql['type'], -1, 0);	
				}
			
			
		}elseif ($arsql['status']=="2") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items` SET `status`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
			
				if ($arsql['stamp']>(time()-86400)) {
					countadd($arsql['catalog'], $arsql['type'], 0, -1);
				}else{
					countadd($arsql['catalog'], $arsql['type'], -1, 0);	
				}
			
		}elseif ($arsql['status']=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items` SET `status`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
			
				if ($arsql['stamp']>(time()-86400)) {
					countadd($arsql['catalog'], $arsql['type'], 0, 1);
				}else{
					countadd($arsql['catalog'], $arsql['type'], 1, 0);	
				}
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_changestatuspages") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status']=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."pages` SET `status`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
		}elseif ($arsql['status']=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."pages` SET `status`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_changestatuscatalog") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	if (!in_array($_POST['type'], array("p", "s", "k"))) { 
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		$type=$_POST['type'];
	}
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status_'.$type]=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."catalog` SET `status_".$type."`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
		}elseif ($arsql['status_'.$type]=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."catalog` SET `status_".$type."`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "type" => $type, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_changestatustopmenu") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if ($arsql['status']=="1") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."topmenu` SET `status`='3' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-danger"; 
			$html="<i class=\"fa fa-times\"></i>"; 
		}elseif ($arsql['status']=="3") { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."topmenu` SET `status`='1' WHERE `id`='".sql($id)."' LIMIT 1;");
			$status="btn-success"; 
			$html="<i class=\"fa fa-check\"></i>"; 
		}else{
			echo json_encode(array("result" => "0", "id" => $id));
			exit;
		}			
		echo json_encode(array("result" => "1", "id" => $id, "status" => $status, "html" => $html));
		exit;
	}
}

if ($sce=="ajax_pages_position") {
	
	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($id)."' and `type`='2' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if (is_numeric($_POST['value'])) { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."pages` SET `position`='".sql($_POST['value'])."' WHERE `id`='".sql($id)."' LIMIT 1;");		
			echo json_encode(array("result" => "1", "id" => $id, "value" => $_POST['value']));
			exit;
		}else{
			echo json_encode(array("result" => "1", "id" => $id, "value" => $arsql['position']));
			exit;
		}
	}
}

if ($sce=="ajax_catalog_position") {

	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if (is_numeric($_POST['value'])) { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."catalog` SET `position`='".sql($_POST['value'])."' WHERE `id`='".sql($id)."' LIMIT 1;");		
			echo json_encode(array("result" => "1", "id" => $id, "value" => $_POST['value']));
			exit;
		}else{
			echo json_encode(array("result" => "1", "id" => $id, "value" => $arsql['position']));
			exit;
		}
	}
}

if ($sce=="ajax_topmenu_position") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if (is_numeric($_POST['value'])) { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."topmenu` SET `position`='".sql($_POST['value'])."' WHERE `id`='".sql($id)."' LIMIT 1;");		
			echo json_encode(array("result" => "1", "id" => $id, "value" => $_POST['value']));
			exit;
		}else{
			echo json_encode(array("result" => "1", "id" => $id, "value" => $arsql['position']));
			exit;
		}
	}
}
if ($sce=="ajax_partners_position") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if (is_numeric($_POST['value'])) { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."partners` SET `position`='".sql($_POST['value'])."' WHERE `id`='".sql($id)."' LIMIT 1;");		
			echo json_encode(array("result" => "1", "id" => $id, "value" => $_POST['value']));
			exit;
		}else{
			echo json_encode(array("result" => "1", "id" => $id, "value" => $arsql['position']));
			exit;
		}
	}
}
if ($sce=="ajax_slides_position") {



	if (!is_numeric($_POST['id'])){ $id=0; }else{ $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0", "id" => $id));
		exit;
	}else{
		if (is_numeric($_POST['value'])) { 
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."slides` SET `position`='".sql($_POST['value'])."' WHERE `id`='".sql($id)."' LIMIT 1;");		
			echo json_encode(array("result" => "1", "id" => $id, "value" => $_POST['value']));
			exit;
		}else{
			echo json_encode(array("result" => "1", "id" => $id, "value" => $arsql['position']));
			exit;
		}
	}
}

if ($sce=="ajax_text_dp") {
	

	if(!is_numeric($_POST['id']) || $_POST['id']<=0){
		echo json_encode(array("result" => "0"));
		exit;
	}
	$id=$_POST['id'];
	
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0"));
		exit;
	}
	
	


	$dateto=strtotime($_POST['dateto']);

	if ($dateto>0) {
		mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET `dateto`='".sql($dateto)."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
		echo json_encode(array("result" => "1", "id" => $arsql['id'], "datavaluevalue" => date("d.m.Y H:i", $dateto), "dataraw" => $dateto*1000));
		exit;
	}else{
		$dateto=0;
		mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET `dateto`='".sql($dateto)."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
		echo json_encode(array("result" => "1", "id" => $arsql['id'], "datavaluevalue" => date("d.m.Y H:i", $dateto), "dataraw" => $dateto*1000));
		exit;
	}


}

if ($sce=="ajax_text") {
	

	if(!is_numeric($_POST['id']) || $_POST['id']<=0){
		echo json_encode(array("result" => "0"));
		exit;
	}
	$id=$_POST['id'];
	
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		echo json_encode(array("result" => "0"));
		exit;
	}
	
	


	$value=$_POST['value'];

	mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET `value`='".sql($value)."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
	echo json_encode(array("result" => "1", "id" => $arsql['id'], "value" => $value));
	exit;

}	
	


if ($sce=="ajax_users_update") {

		if (in_array($_POST['type'], array("status", "blocked"))) { $type=$_POST['type']; } else { echo json_encode(array("result" => "0")); exit; } 
			
		if (is_numeric($_POST['id']) and $_POST['id']>0) { $id=$_POST['id']; } else { $id=''; }
		if ($id==$GLOBALS['user']['id']) { echo json_encode(array("result" => "0")); exit; } 
		if ($GLOBALS['user']['status']<2) { echo json_encode(array("result" => "0")); exit; } 
		
		if (in_array($_POST['status'], array("0", "1", "2", "3"))){ $status=$_POST['status']; }
		if ($status>$GLOBALS['user']['status']) { $status=$GLOBALS['user']['status']; }
		if (in_array($_POST['blocked'], array("0", "1"))) { $blocked=$_POST['blocked']; }
		
		$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
		$str = mysqlq($query);
		$arsql=mysql_fetch_assoc($str);
		$numrows=mysql_num_rows($str);	
		if ($numrows==0) {
			echo json_encode(array("result" => "0")); exit;
		} 
		
		if ($arsql['status']>$GLOBALS['user']['status'] || ($arsql['status']==$GLOBALS['user']['status'] and $arsql['lockstatus']=="1")) { 
			echo json_encode(array("result" => "1", "st" => $arsql['status'], "bl" => $arsql['blocked'])); exit;	
		}

		if ($type=="status") {
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."users` SET `status`='".sql($status)."' WHERE `id`='".sql($arsql['id'])."' and `del`='0' LIMIT 1;");
			echo json_encode(array("result" => "1", "st" => $status, "bl" => $blocked)); exit;
		}elseif ($type=="blocked"){
			if ($blocked=="1") { $ands=", `session`=''"; } else { $ands=""; }
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."users` SET `blocked`='".sql($blocked)."'".$ands." WHERE `id`='".sql($arsql['id'])."' and `del`='0' LIMIT 1;");
			
			echo json_encode(array("result" => "1", "st" => $status, "bl" => $blocked)); exit;	
			
		}


}

if ($sce=="ajax_followers_update") {

		if (in_array($_POST['type'], array("status", "blocked"))) { $type=$_POST['type']; } else { echo json_encode(array("result" => "0")); exit; } 
			
		if (is_numeric($_POST['id']) and $_POST['id']>0) { $id=$_POST['id']; } else { $id=''; }

		if (in_array($_POST['status'], array("0", "1", "2", "3"))){ $status=$_POST['status']; }
		if (in_array($_POST['blocked'], array("0", "1"))) { $blocked=$_POST['blocked']; }
		
		$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
		$str = mysqlq($query);
		$arsql=mysql_fetch_assoc($str);
		$numrows=mysql_num_rows($str);	
		if ($numrows==0) {
			echo json_encode(array("result" => "0")); exit;
		} 
		
		if ($type=="status") {
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `status`='".sql($status)."' WHERE `id`='".sql($arsql['id'])."' and `del`='0' LIMIT 1;");
			echo json_encode(array("result" => "1", "st" => $status, "bl" => $blocked)); exit;
		}elseif ($type=="blocked"){
			if ($blocked=="1") { $ands=", `session`=''"; } else { $ands=""; }
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `blocked`='".sql($blocked)."'".$ands." WHERE `id`='".sql($arsql['id'])."' and `del`='0' LIMIT 1;");
			
			echo json_encode(array("result" => "1", "st" => $status, "bl" => $blocked)); exit;	
			
		}


}

//Добавление слайда
if ($sce=="slides_add") {
	
	
if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=1; }

	$query="SELECT max(position) as maxp, min(position) as minp FROM `".sql($GLOBALS['config']['bd_prefix'])."slides`;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$maxp=$arsql['maxp'];
	$minp=$arsql['minp'];
	
if ($_POST['input-position']==1) { $position=$minp-1; } else { $position=$maxp+1; }


if (mb_strlen($_POST['input-name'])==0) { $name=""; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-html'])==0) { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-link'])==0) { $link=""; } else { $link=$_POST['input-link']; }

if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-html-en'])==0) { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-link-en'])==0) { $link_en=""; } else { $link_en=$_POST['input-link-en']; }

if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }
if (mb_strlen($_POST['input-html-cn'])==0) { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-link-cn'])==0) { $link_cn=""; } else { $link_cn=$_POST['input-link-cn']; }

$file="";
if (mb_strlen($_FILES['input-file']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "slides");
	}else{
		alert("Ошибка загрузки!", "Не удалось загрузить слайд RU", "times", "danger");
	}
}

$file_en="";
if (mb_strlen($_FILES['input-file-en']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file-en'])) {
		$file_en=upload($_FILES['input-file-en'], "slides");
	}else{
		alert("Ошибка загрузки!", "Не удалось загрузить слайд EN", "times", "danger");
	}
}

$file_cn="";
if (mb_strlen($_FILES['input-file-cn']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file-cn'])) {
		$file_cn=upload($_FILES['input-file-cn'], "slides");
	}else{
		alert("Ошибка загрузки!", "Не удалось загрузить слайд CN", "times", "danger");
	}
}

mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."slides` (
`name`, 
`html`, 
`link`, 
`file`, 
`stamp`, 
`status`, 
`name_en`, 
`html_en`, 
`link_en`, 
`file_en`, 
`name_cn`, 
`html_cn`, 
`link_cn`, 
`file_cn`, 
`user`,
`ip`
) VALUES (
'".sql($name)."', 
'".sql($html)."', 
'".sql($link)."', 
'".sql($file)."', 
'".sql(time())."', 
'".sql($status)."', 
'".sql($name_en)."', 
'".sql($html_en)."', 
'".sql($link_en)."', 
'".sql($file_en)."', 
'".sql($name_cn)."', 
'".sql($html_cn)."', 
'".sql($link_cn)."', 
'".sql($file_cn)."', 
'".sql($GLOBALS['user']['id'])."',
'".sql($GLOBALS['user']['ip'])."')");


alert("Слайд добавлен!", "Слайд успешно добавлен", "check", "success");
red("?mod=slides_list");

}



if ($sce=="slides_edit") {
	
	
	
if (!is_numeric($_POST['id'])) { $id=0; } else { $id=$_POST['id']; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Слайд не найден", "times", "danger");
red("?mod=slides_list");	
}
	
if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=$page['status']; }

if (mb_strlen($_POST['input-name'])==0) { $name=""; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-html'])==0) { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-link'])==0) { $link=""; } else { $link=$_POST['input-link']; }

if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-html-en'])==0) { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-link-en'])==0) { $link_en=""; } else { $link_en=$_POST['input-link-en']; }

if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }
if (mb_strlen($_POST['input-html-cn'])==0) { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-link-cn'])==0) { $link_cn=""; } else { $link_cn=$_POST['input-link-cn']; }

if (mb_strlen($_FILES['input-file']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "slides");
		
	}else{ alert("Ошибка загрузки!", "Не удалось загрузить слайд RU", "times", "danger"); }
if ($file!="" and mb_strlen($page['file'])>4 and file_exists("../upload/slides/".$page['file'])) {
	unlink("../upload/slides/".$page['file']);
}elseif($file==""){
	$file=$page['file'];
}
}else{
	if($_POST['photo-del']=="1") {
		if (mb_strlen($page['file'])>4) {
			if (file_exists("../upload/slides/".$page['file'])){	
				unlink("../upload/slides/".$page['file']);
			}
		}
		$file="";
	}else{
		$file=$page['file'];
	}
}

if (mb_strlen($_FILES['input-file-en']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file-en'])) {
		$file_en=upload($_FILES['input-file-en'], "slides");
		
	}else{ alert("Ошибка загрузки!", "Не удалось загрузить слайд EN", "times", "danger"); }
if ($file_en!="" and mb_strlen($page['file_en'])>4 and file_exists("../upload/slides/".$page['file_en'])) {
	unlink("../upload/slides/".$page['file_en']);
}elseif($file_en==""){
	$file_en=$page['file_en'];
}
}else{
	if($_POST['photo-del-en']=="1") {
		if (mb_strlen($page['file_en'])>4) {
			if (file_exists("../upload/slides/".$page['file_en'])){	
				unlink("../upload/slides/".$page['file_en']);
			}
		}
		$file_en="";
	}else{
		$file_en=$page['file_en'];
	}
}

if (mb_strlen($_FILES['input-file-cn']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file-cn'])) {
		$file_cn=upload($_FILES['input-file-cn'], "slides");
		
	}else{ alert("Ошибка загрузки!", "Не удалось загрузить слайд CN", "times", "danger"); }
if ($file_cn!="" and mb_strlen($page['file_cn'])>4 and file_exists("../upload/slides/".$page['file_cn'])) {
	unlink("../upload/slides/".$page['file_cn']);
}elseif($file_cn==""){
	$file_cn=$page['file_cn'];
}
}else{
	if($_POST['photo-del-cn']=="1") {
		if (mb_strlen($page['file_cn'])>4) {
			if (file_exists("../upload/slides/".$page['file_cn'])){	
				unlink("../upload/slides/".$page['file_cn']);
			}
		}
		$file_cn="";
	}else{
		$file_cn=$page['file_cn'];
	}
}


mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."slides` SET
`name`='".sql($name)."', 
`html`='".sql($html)."', 
`link`='".sql($link)."', 
`file`='".sql($file)."', 
`status`='".sql($status)."', 
`name_en`='".sql($name_en)."', 
`html_en`='".sql($html_en)."', 
`link_en`='".sql($link_en)."', 
`file_en`='".sql($file_en)."', 
`name_cn`='".sql($name_cn)."', 
`html_cn`='".sql($html_cn)."', 
`link_cn`='".sql($link_cn)."', 
`file_cn`='".sql($file_cn)."' WHERE `id`='".sql($page['id'])."' LIMIT 1;");

alert("Слайд изменен!", "Слайд успешно изменен", "check", "success");
red("?mod=slides_list");

}



if ($sce=="partners_add") {
	
	
if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=1; }

	$query="SELECT max(position) as maxp, min(position) as minp FROM `".sql($GLOBALS['config']['bd_prefix'])."partners`;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$maxp=$arsql['maxp'];
	$minp=$arsql['minp'];
	
if ($_POST['input-position']==1) { $position=$minp-1; } else { $position=$maxp+1; }

if (mb_strlen($_POST['input-name'])==0) { $name=""; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-link'])==0) { $link=""; } else { $link=$_POST['input-link']; }

if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-link-en'])==0) { $link_en=""; } else { $link_en=$_POST['input-link-en']; }

if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }
if (mb_strlen($_POST['input-link-cn'])==0) { $link_cn=""; } else { $link_cn=$_POST['input-link-cn']; }

$file="";
if (mb_strlen($_FILES['input-file']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "partners");
	}else{
		alert("Ошибка загрузки!", "Не удалось загрузить логотип", "times", "danger");
	}
}

mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."partners` (
`name`, 
`link`, 
`file`, 
`stamp`, 
`position`, 
`status`, 
`name_en`, 
`link_en`, 
`name_cn`, 
`link_cn`, 
`user`,
`ip`
) VALUES (
'".sql($name)."', 
'".sql($link)."', 
'".sql($file)."', 
'".sql(time())."', 
'".sql($status)."', 
'".sql($position)."', 
'".sql($name_en)."', 
'".sql($link_en)."', 
'".sql($name_cn)."', 
'".sql($link_cn)."', 
'".sql($GLOBALS['user']['id'])."',
'".sql($GLOBALS['user']['ip'])."')");


alert("Партнёр добавлен!", "Партнёр успешно добавлен", "check", "success");
red("?mod=partners_list");

}



if ($sce=="partners_edit") {
	
	
	
if (!is_numeric($_POST['id'])) { $id=0; } else { $id=$_POST['id']; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Партнёр не найден", "times", "danger");
red("?mod=partners_list");	
}
	
if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=$page['status']; }

if (mb_strlen($_POST['input-name'])==0) { $name=""; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-link'])==0) { $link=""; } else { $link=$_POST['input-link']; }

if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-link-en'])==0) { $link_en=""; } else { $link_en=$_POST['input-link-en']; }

if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }
if (mb_strlen($_POST['input-link-cn'])==0) { $link_cn=""; } else { $link_cn=$_POST['input-link-cn']; }

if (mb_strlen($_FILES['input-file']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "partners");
		
	}else{ alert("Ошибка загрузки!", "Не удалось загрузить слайд RU", "times", "danger"); }
if ($file!="" and mb_strlen($page['file'])>4 and file_exists("../upload/partners/".$page['file'])) {
	unlink("../upload/partners/".$page['file']);
}elseif($file==""){
	$file=$page['file'];
}
}else{
	if($_POST['photo-del']=="1") {
		if (mb_strlen($page['file'])>4) {
			if (file_exists("../upload/partners/".$page['file'])){	
				unlink("../upload/partners/".$page['file']);
			}
		}
		$file="";
	}else{
		$file=$page['file'];
	}
}


mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."partners` SET
`name`='".sql($name)."', 
`link`='".sql($link)."', 
`file`='".sql($file)."', 
`status`='".sql($status)."', 
`name_en`='".sql($name_en)."', 
`link_en`='".sql($link_en)."', 
`name_cn`='".sql($name_cn)."', 
`link_cn`='".sql($link_cn)."' WHERE `id`='".sql($page['id'])."' LIMIT 1;");

alert("Партнёр изменен!", "Партнёр успешно изменен", "check", "success");
red("?mod=partners_list");

}


if ($sce=="news_add") {
	
	

if ($_POST['input-stamp']==0) { $stamp=time(); } else { $stamp=strtotime($_POST['input-stamp']);}
if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=1; }


if (mb_strlen($_POST['input-name'])==0) { $name="Новая публикация"; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-html'])==0) { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-preview'])==0) { $preview=necuttext(htmlr($html), 1024); } else { $preview=$_POST['input-preview']; }

if (mb_strlen($_POST['input-title'])==0) { $title=""; } else { $title=$_POST['input-title']; }
if (mb_strlen($_POST['input-desc'])==0) { $meta1=""; } else { $meta1=$_POST['input-desc']; }
if (mb_strlen($_POST['input-keyw'])==0) { $meta2=""; } else { $meta2=$_POST['input-keyw']; }

if (mb_strlen($_POST['input-slug'])==0) { $slug=slug($name, "news"); } else { $slug=$_POST['input-slug']; }


if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-html-en'])==0) { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-preview-en'])==0) { $preview_en=necuttext(htmlr($html_en), 1024); } else { $preview_en=$_POST['input-preview-en']; }

if (mb_strlen($_POST['input-title-en'])==0) { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
if (mb_strlen($_POST['input-desc-en'])==0) { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
if (mb_strlen($_POST['input-keyw-en'])==0) { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }

if (mb_strlen($_POST['input-slug-en'])==0) { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }


if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }
if (mb_strlen($_POST['input-html-cn'])==0) { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-preview-cn'])==0) { $preview_cn=necuttext(htmlr($html_cn), 1024); } else { $preview_cn=$_POST['input-preview-cn']; }

if (mb_strlen($_POST['input-title-cn'])==0) { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
if (mb_strlen($_POST['input-desc-cn'])==0) { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
if (mb_strlen($_POST['input-keyw-cn'])==0) { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }

if (mb_strlen($_POST['input-slug-cn'])==0) { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }


$file="";
if ($_FILES['input-file']) {
	if (checkimage($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "news");
	}else{
		alert("Ошибка загрузки!", "Не удалось загрузить фото", "times", "danger");
	}
}





mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."news` (
`name`, 
`preview`, 
`html`, 
`slug`, 
`title`, 
`meta1`, 
`meta2`, 
`file`, 
`stamp`, 
`status`, 
`name_en`, 
`preview_en`, 
`html_en`, 
`slug_en`, 
`title_en`, 
`meta1_en`, 
`meta2_en`, 
`name_cn`, 
`preview_cn`, 
`html_cn`, 
`slug_cn`, 
`title_cn`, 
`meta1_cn`, 
`meta2_cn`,
`user`,
`ip`
) VALUES (
'".sql($name)."', 
'".sql($preview)."', 
'".sql($html)."', 
'".sql($slug)."', 
'".sql($title)."', 
'".sql($meta1)."', 
'".sql($meta2)."', 
'".sql($file)."', 
'".sql($stamp)."', 
'".sql($status)."', 
'".sql($name_en)."', 
'".sql($preview_en)."', 
'".sql($html_en)."', 
'".sql($slug_en)."', 
'".sql($title_en)."', 
'".sql($meta1_en)."', 
'".sql($meta2_en)."', 
'".sql($name_cn)."', 
'".sql($preview_cn)."', 
'".sql($html_cn)."', 
'".sql($slug_cn)."', 
'".sql($title_cn)."', 
'".sql($meta1_cn)."', 
'".sql($meta2_cn)."',
'".sql($GLOBALS['user']['id'])."',
'".sql($GLOBALS['user']['ip'])."')");



alert("Публикация добавлена!", "Публикация успешно добавлена", "check", "success");
red("?mod=news_list");

}




if ($sce=="news_edit") {
	
if (!is_numeric($_POST['id'])) { $id=0; } else { $id=$_POST['id']; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Публикация не найдена", "times", "danger");
red("?mod=news_list");	
}
	
	
if ($_POST['input-stamp']==0) { $stamp=$page['stamp']; } else { $stamp=strtotime($_POST['input-stamp']);}

if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=$page['status']; }


if (mb_strlen($_POST['input-name'])==0) { $name=$page['name']; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-html'])==0) { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-preview'])==0) { $preview=necuttext(htmlr($html), 1024); } else { $preview=$_POST['input-preview']; }

if (mb_strlen($_POST['input-title'])==0) { $title=""; } else { $title=$_POST['input-title']; }
if (mb_strlen($_POST['input-desc'])==0) { $meta1=""; } else { $meta1=$_POST['input-desc']; }
if (mb_strlen($_POST['input-keyw'])==0) { $meta2=""; } else { $meta2=$_POST['input-keyw']; }

if (mb_strlen($_POST['input-slug'])==0) { $slug=slug($name, "news"); } else { $slug=$_POST['input-slug']; }


if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-html-en'])==0) { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-preview-en'])==0) { $preview_en=necuttext(htmlr($html_en), 1024); } else { $preview_en=$_POST['input-preview-en']; }

if (mb_strlen($_POST['input-title-en'])==0) { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
if (mb_strlen($_POST['input-desc-en'])==0) { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
if (mb_strlen($_POST['input-keyw-en'])==0) { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }

if (mb_strlen($_POST['input-slug-en'])==0) { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }


if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }
if (mb_strlen($_POST['input-html-cn'])==0) { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-preview-cn'])==0) { $preview_cn=necuttext(htmlr($html_cn), 1024); } else { $preview_cn=$_POST['input-preview-cn']; }

if (mb_strlen($_POST['input-title-cn'])==0) { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
if (mb_strlen($_POST['input-desc-cn'])==0) { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
if (mb_strlen($_POST['input-keyw-cn'])==0) { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }

if (mb_strlen($_POST['input-slug-cn'])==0) { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }

$file="";


if (mb_strlen($_FILES['input-file']['tmp_name'])>0) {
	if (checkimage($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "news");
		
	}else{ alert("Ошибка загрузки!", "Не удалось загрузить фото", "times", "danger"); }
if ($file!="" and mb_strlen($page['file'])>4 and file_exists("../upload/news/".$page['file'])) {
	unlink("../upload/news/".$page['file']);
}elseif($file==""){
	$file=$page['file'];
}
}else{
	if($_POST['photo-del']=="1") {
		if (mb_strlen($page['file'])>4) {
			if (file_exists("../upload/news/".$page['file'])){	
				unlink("../upload/news/".$page['file']);
			}
		}
		$file="";
	}else{
		$file=$page['file'];
	}
}






mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."news` SET
`name`='".sql($name)."', 
`preview`='".sql($preview)."', 
`html`='".sql($html)."', 
`slug`='".sql($slug)."', 
`title`='".sql($title)."', 
`meta1`='".sql($meta1)."', 
`meta2`='".sql($meta2)."', 
`file`='".sql($file)."', 
`stamp`='".sql($stamp)."', 
`status`='".sql($status)."', 
`name_en`='".sql($name_en)."', 
`preview_en`='".sql($preview_en)."', 
`html_en`='".sql($html_en)."', 
`slug_en`='".sql($slug_en)."', 
`title_en`='".sql($title_en)."', 
`meta1_en`='".sql($meta1_en)."', 
`meta2_en`='".sql($meta2_en)."', 
`name_cn`='".sql($name_cn)."', 
`preview_cn`='".sql($preview_cn)."', 
`html_cn`='".sql($html_cn)."', 
`slug_cn`='".sql($slug_cn)."', 
`title_cn`='".sql($title_cn)."', 
`meta1_cn`='".sql($meta1_cn)."', 
`meta2_cn`='".sql($meta2_cn)."' WHERE `id`='".sql($page['id'])."' LIMIT 1;");

alert("Публикация изменена!", "Публикация успешно изменена", "check", "success");
red("?mod=news_list");

}


if ($sce=="plain_edit_text_main_about") {
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_about")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_about не найдена", "times", "danger");
red("?mod=plain_edit_text_main_about");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_about_en")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_about_en не найдена", "times", "danger");
red("?mod=plain_edit_text_main_about");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_about_cn")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_about_cn не найдена", "times", "danger");
red("?mod=plain_edit_text_main_about");	
}	
	
if (mb_strlen($_POST['input-html'])==0) { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-html-en'])==0) { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-html-cn'])==0) { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }

$stamp=time();

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($html)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_about")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($html_en)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_about_en")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($html_cn)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_about_cn")."' LIMIT 1;");

alert("Настройки изменены!", "Настройки успешно изменены", "check", "success");
red("?mod=plain_edit_text_main_about");

}

if ($sce=="plain_edit_text_footer") {
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("footer")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка footer не найдена", "times", "danger");
red("?mod=plain_edit_text_footer");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("footer_en")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка footer_en не найдена", "times", "danger");
red("?mod=plain_edit_text_footer");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("footer_cn")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка footer_cn не найдена", "times", "danger");
red("?mod=plain_edit_text_footer");	
}	
	
if (mb_strlen($_POST['input-html'])==0) { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-html-en'])==0) { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-html-cn'])==0) { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }

$stamp=time();

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($html)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("footer")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($html_en)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("footer_en")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($html_cn)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("footer_cn")."' LIMIT 1;");

alert("Настройки изменены!", "Настройки успешно изменены", "check", "success");
red("?mod=plain_edit_text_footer");

}


if ($sce=="plain_edit_text_social") {
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_facebook")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_facebook не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_facebook_en")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_facebook_en не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_facebook_cn")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_facebook_cn не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}	

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_telegram")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_telegram не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_telegram_en")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_telegram_en не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_telegram_cn")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_telegram_cn не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}	

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_youtube")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_youtube не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_youtube_en")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_youtube_en не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql("main_youtube_cn")."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Настройка main_youtube_cn не найдена", "times", "danger");
red("?mod=plain_edit_text_social");	
}	

	
if (mb_strlen($_POST['input-facebook'])==0) { $facebook=""; } else { $facebook=$_POST['input-facebook']; }
if (mb_strlen($_POST['input-facebook-en'])==0) { $facebook_en=""; } else { $facebook_en=$_POST['input-facebook-en']; }
if (mb_strlen($_POST['input-facebook-cn'])==0) { $facebook_cn=""; } else { $facebook_cn=$_POST['input-facebook-cn']; }

if (mb_strlen($_POST['input-telegram'])==0) { $telegram=""; } else { $telegram=$_POST['input-telegram']; }
if (mb_strlen($_POST['input-telegram-en'])==0) { $telegram_en=""; } else { $telegram_en=$_POST['input-telegram-en']; }
if (mb_strlen($_POST['input-telegram-cn'])==0) { $telegram_cn=""; } else { $telegram_cn=$_POST['input-telegram-cn']; }

if (mb_strlen($_POST['input-youtube'])==0) { $youtube=""; } else { $youtube=$_POST['input-youtube']; }
if (mb_strlen($_POST['input-youtube-en'])==0) { $youtube_en=""; } else { $youtube_en=$_POST['input-youtube-en']; }
if (mb_strlen($_POST['input-youtube-cn'])==0) { $youtube_cn=""; } else { $youtube_cn=$_POST['input-youtube-cn']; }

$stamp=time();

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($facebook)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_facebook")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($facebook_en)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_facebook_en")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($facebook_cn)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_facebook_cn")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($telegram)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_telegram")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($telegram_en)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_telegram_en")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($telegram_cn)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_telegram_cn")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($youtube)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_youtube")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($youtube_en)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_youtube_en")."' LIMIT 1;");

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET
`value`='".sql($youtube_cn)."', 
`stamp`='".sql($stamp)."', 
`ip`='".sql($GLOBALS['user']['ip'])."', 
`user`='".sql($GLOBALS['user']['id'])."' WHERE `name`='".sql("main_youtube_cn")."' LIMIT 1;");

alert("Настройки изменены!", "Настройки успешно изменены", "check", "success");
red("?mod=plain_edit_text_social");

}


if ($sce=="items_add") {
	
	if (!in_array($_POST['input-type'], array("p", "s", "k"))) { $type="p"; } else { $type=$_POST['input-type']; }
	
	$follower=$_POST['input-follower'];
	
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($follower)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0){
		$follower=0;
	}
	
	$catalog=$_POST['input-catalog'];
	
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($catalog)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0){
		$catalog=0;
	} 
	if (haskids("catalog", $catalog)){
		$catalog=0;
	}
	
	if (is_numeric($_POST['input-list3'])) { $region=$_POST['input-list3']; }elseif(is_numeric($_POST['input-list2'])) {$region=$_POST['input-list2'];}else{$region=$_POST['input-list1'];}
	
	if ($_POST['input-bu']=="1") { $bu=1; } else { $bu=0; }
	
	$video=$_POST['input-video'];
	if (in_array($_POST['input-lang'], array("", "en", "cn"))){ $lang=$_POST['input-lang']; }else{ $lang=""; }
	
	if (in_array($_POST['input-status'], array("1", "2", "3"))){$status=$_POST['input-status']; }
	
	
	if (mb_strlen($_POST['input-name'])==0) { $name="Новое объявление"; } else { $name=$_POST['input-name']; }
	if (mb_strlen($_POST['input-name-en'])==0) { $name_en="New"; } else { $name_en=$_POST['input-name-en']; }
	if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn="New"; } else { $name_cn=$_POST['input-name-cn']; }

	if (mb_strlen($_POST['input-bp'])==0) { $bp=""; } else { $bp=$_POST['input-bp']; }
	if (mb_strlen($_POST['input-text'])==0) { $text=""; } else { $text=$_POST['input-text']; }
	if (mb_strlen($_POST['input-text2'])==0) { $text2=""; } else { $text2=$_POST['input-text2']; }
	if (mb_strlen($_POST['input-title'])==0) { $title=""; } else { $title=$_POST['input-title']; }
	if (mb_strlen($_POST['input-desc'])==0) { $meta1=""; } else { $meta1=$_POST['input-desc']; }
	if (mb_strlen($_POST['input-keyw'])==0) { $meta2=""; } else { $meta2=$_POST['input-keyw']; }

	if (mb_strlen($_POST['input-bp-en'])==0) { $bp_en=""; } else { $bp_en=$_POST['input-bp-en']; }
	if (mb_strlen($_POST['input-text-en'])==0) { $text_en=""; } else { $text_en=$_POST['input-text-en']; }
	if (mb_strlen($_POST['input-text2-en'])==0) { $text2_en=""; } else { $text2_en=$_POST['input-text2-en']; }
	if (mb_strlen($_POST['input-title-en'])==0) { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
	if (mb_strlen($_POST['input-desc-en'])==0) { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
	if (mb_strlen($_POST['input-keyw-en'])==0) { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }

	if (mb_strlen($_POST['input-bp-cn'])==0) { $bp_cn=""; } else { $bp_cn=$_POST['input-bp-cn']; }
	if (mb_strlen($_POST['input-text-cn'])==0) { $text_cn=""; } else { $text_cn=$_POST['input-text-cn']; }
	if (mb_strlen($_POST['input-text2-cn'])==0) { $text2_cn=""; } else { $text2_cn=$_POST['input-text2-cn']; }
	if (mb_strlen($_POST['input-title-cn'])==0) { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
	if (mb_strlen($_POST['input-desc-cn'])==0) { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
	if (mb_strlen($_POST['input-keyw-cn'])==0) { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }

	if (mb_strlen($_POST['input-slug'])==0) { $slug=""; } else { $slug=$_POST['input-slug']; }
	if (mb_strlen($_POST['input-slug-en'])==0) { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }
	if (mb_strlen($_POST['input-slug-cn'])==0) { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }




	if (in_array($_POST['price-type'], array("1", "2", "3", "4", "5"))) {
		$pricetype=$_POST['price-type'];
	}else{
		$pricetype=5;
	}
	
	if ($pricetype<4) {
		if (is_numeric($_POST['price']) and $_POST['price']>0) {
			$price=$_POST['price'];
		}else{
			$price=0;
		}
		if (in_array($_POST['price-cur'], array("1", "2", "3"))) {
			$pricecur=$_POST['price-cur'];
			if ($pricecur=="1") {
				$price=ceil($price*100)/100;
			}
		}
	}



$table=$GLOBALS['config']['bd_prefix']."items";



$key=getkey($table);

	
mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."items` 
(`user`,
`type`,
`catalog`,
`region`,
`name`,
`name_en`,
`name_cn`,
`text`,
`text_en`,
`text_cn`,
`price_type`, 
`price`, 
`price_cur`, 
`bu`,
`bp`,
`bp_en`,
`bp_cn`,
`text2`,
`text2_en`,
`text2_cn`,
`slug`, 
`title`, 
`meta1`, 
`meta2`, 
`slug_en`, 
`title_en`, 
`meta1_en`, 
`meta2_en`, 
`slug_cn`, 
`title_cn`, 
`meta1_cn`, 
`meta2_cn`,
`video`,
`lang`,
`status`,
`ip`,
`stamp`,
`key`
) VALUES (
'".sql($user)."',
'".sql($type)."',
'".sql($catalog)."',
'".sql($region)."',
'".sql($name)."',
'".sql($name_en)."',
'".sql($name_cn)."',
'".sql($text)."',
'".sql($text_en)."',
'".sql($text_cn)."',
'".sql($pricetype)."', 
'".sql($price)."', 
'".sql($pricecur)."', 
'".sql($bu)."',
'".sql($bp)."',
'".sql($bp_en)."',
'".sql($bp_cn)."',
'".sql($text2)."',
'".sql($text2_en)."',
'".sql($text2_cn)."',
'".sql($slug)."', 
'".sql($title)."', 
'".sql($meta1)."', 
'".sql($meta2)."', 
'".sql($slug_en)."', 
'".sql($title_en)."', 
'".sql($meta1_en)."', 
'".sql($meta2_en)."', 
'".sql($slug_cn)."', 
'".sql($title_cn)."', 
'".sql($meta1_cn)."', 
'".sql($meta2_cn)."',
'".sql($video)."',
'".sql($lang)."',
'".sql($status)."',
'".sql($GLOBALS['user']['ip'])."',
'".sql(time())."',
'".sql($key)."')");

if ($status=="1") {
	if ($stamp>(time()-86400)) {
	countadd($catalog, $type, 0, 1);
	}else{
	countadd($catalog, $type, 1, 0);	
	}
}

$newid=putkey($table, $key);

if ($newid>0) {
$files=restructureFilesArray($_FILES['input-file']);
$k=0;
$total=0;
	foreach($files as $file){
		
		if (mb_strlen($file['tmp_name'])>0) {
			if (checkimage($file) and $total<10) {
				$fl=upload($file, "items");
				if (mb_strlen($fl)>4) {
					mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."items_files` (`type`, `item`, `file`, `position`) VALUES ('image', '".sql($newid)."', '".sql($fl)."', '".sql($total)."')");
					$total++;
				}else{
					// Не все фотографии загрузились
				}
			}else{
				// Не все фотографии загрузились
			}
		}
		$k++;
		
	}
}	




alert("Объявление добавлено!", "Объявление успешно добавлено", "check", "success");
red("?mod=items_list&id=".$catalog);
	
}


if ($sce=="items_edit") {
	
	
	if (!is_numeric($_POST['id'])) { $id=0; } else { $id=$_POST['id']; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$page=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
	alert("Ошибка изменения", "Объявление не найдено", "times", "danger");
	red($_SERVER['HTTP_REFERER']);		
	}	
	
	if (!in_array($_POST['input-type'], array("p", "s", "k"))) { $type="p"; } else { $type=$_POST['input-type']; }
	
	$follower=$_POST['input-follower'];
	
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($follower)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0){
		$follower=0;
	}
	
	$catalog=$_POST['input-catalog'];
	
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($catalog)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0){
		$catalog=0;
	} 
	if (haskids("catalog", $catalog)){
		$catalog=0;
	}
	
	if (is_numeric($_POST['input-list3'])) { $region=$_POST['input-list3']; }elseif(is_numeric($_POST['input-list2'])) {$region=$_POST['input-list2'];}else{$region=$_POST['input-list1'];}
	
	if ($_POST['input-bu']=="1") { $bu=1; } else { $bu=0; }
	
	$video=$_POST['input-video'];
	if (in_array($_POST['input-lang'], array("", "en", "cn"))){ $lang=$_POST['input-lang']; }else{ $lang=""; }
	
	if (in_array($_POST['input-status'], array("1", "2", "3"))){$status=$_POST['input-status']; }
	
	
	if (mb_strlen($_POST['input-name'])==0) { $name=$page['name']; } else { $name=$_POST['input-name']; }
	if (mb_strlen($_POST['input-name-en'])==0) { $name_en=$page['name_en']; } else { $name_en=$_POST['input-name-en']; }
	if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=$page['name_cn']; } else { $name_cn=$_POST['input-name-cn']; }

	if (mb_strlen($_POST['input-bp'])==0) { $bp=""; } else { $bp=$_POST['input-bp']; }
	if (mb_strlen($_POST['input-text'])==0) { $text=""; } else { $text=$_POST['input-text']; }
	if (mb_strlen($_POST['input-text2'])==0) { $text2=""; } else { $text2=$_POST['input-text2']; }
	if (mb_strlen($_POST['input-title'])==0) { $title=""; } else { $title=$_POST['input-title']; }
	if (mb_strlen($_POST['input-desc'])==0) { $meta1=""; } else { $meta1=$_POST['input-desc']; }
	if (mb_strlen($_POST['input-keyw'])==0) { $meta2=""; } else { $meta2=$_POST['input-keyw']; }

	if (mb_strlen($_POST['input-bp-en'])==0) { $bp_en=""; } else { $bp_en=$_POST['input-bp-en']; }
	if (mb_strlen($_POST['input-text-en'])==0) { $text_en=""; } else { $text_en=$_POST['input-text-en']; }
	if (mb_strlen($_POST['input-text2-en'])==0) { $text2_en=""; } else { $text2_en=$_POST['input-text2-en']; }
	if (mb_strlen($_POST['input-title-en'])==0) { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
	if (mb_strlen($_POST['input-desc-en'])==0) { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
	if (mb_strlen($_POST['input-keyw-en'])==0) { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }

	if (mb_strlen($_POST['input-bp-cn'])==0) { $bp_cn=""; } else { $bp_cn=$_POST['input-bp-cn']; }
	if (mb_strlen($_POST['input-text-cn'])==0) { $text_cn=""; } else { $text_cn=$_POST['input-text-cn']; }
	if (mb_strlen($_POST['input-text2-cn'])==0) { $text2_cn=""; } else { $text2_cn=$_POST['input-text2-cn']; }
	if (mb_strlen($_POST['input-title-cn'])==0) { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
	if (mb_strlen($_POST['input-desc-cn'])==0) { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
	if (mb_strlen($_POST['input-keyw-cn'])==0) { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }

	if (mb_strlen($_POST['input-slug'])==0) { $slug=""; } else { $slug=$_POST['input-slug']; }
	if (mb_strlen($_POST['input-slug-en'])==0) { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }
	if (mb_strlen($_POST['input-slug-cn'])==0) { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }
	

	if (in_array($_POST['price-type'], array("1", "2", "3", "4", "5"))) {
		$pricetype=$_POST['price-type'];
	}else{
		$pricetype=5;
	}
	
	if ($pricetype<4) {
		if (is_numeric($_POST['price']) and $_POST['price']>0) {
			$price=$_POST['price'];
		}else{
			$price=0;
		}
		if (in_array($_POST['price-cur'], array("1", "2", "3"))) {
			$pricecur=$_POST['price-cur'];
			if ($pricecur=="1") {
				$price=ceil($price*100)/100;
			}
		}
	}


	
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items` SET
`user`='".sql($follower)."',
`type`='".sql($type)."',
`catalog`='".sql($catalog)."',
`region`='".sql($region)."',
`name`='".sql($name)."',
`name_en`='".sql($name_en)."',
`name_cn`='".sql($name_cn)."',
`text`='".sql($text)."',
`text_en`='".sql($text_en)."',
`text_cn`='".sql($text_cn)."',
`price_type`='".sql($pricetype)."', 
`price`='".sql($price)."', 
`price_cur`='".sql($pricecur)."', 
`bu`='".sql($bu)."',
`bp`='".sql($bp)."',
`bp_en`='".sql($bp_en)."',
`bp_cn`='".sql($bp_cn)."',
`text2`='".sql($text2)."',
`text2_en`='".sql($text2_en)."',
`text2_cn`='".sql($text2_cn)."',
`video`='".sql($video)."',
`lang`='".sql($lang)."',
`status`='".sql($status)."',
`slug`='".sql($slug)."', 
`title`='".sql($title)."', 
`meta1`='".sql($meta1)."', 
`meta2`='".sql($meta2)."', 
`slug_en`='".sql($slug_en)."', 
`title_en`='".sql($title_en)."', 
`meta1_en`='".sql($meta1_en)."', 
`meta2_en`='".sql($meta2_en)."', 
`slug_cn`='".sql($slug_cn)."', 
`title_cn`='".sql($title_cn)."', 
`meta1_cn`='".sql($meta1_cn)."', 
`meta2_cn`='".sql($meta2_cn)."'
WHERE `id`='".sql($page['id'])."' LIMIT 1;");

/*echo "UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items` SET
`user`='".sql($follower)."',
`type`='".sql($type)."',
`catalog`='".sql($catalog)."',
`region`='".sql($region)."',
`name`='".sql($name)."',
`name_en`='".sql($name_en)."',
`name_cn`='".sql($name_cn)."',
`text`='".sql($text)."',
`text_en`='".sql($text_en)."',
`text_cn`='".sql($text_cn)."',
`price_type`='".sql($pricetype)."', 
`price`='".sql($price)."', 
`price_cur`='".sql($pricecur)."', 
`bu`='".sql($bu)."',
`bp`='".sql($bp)."',
`bp_en`='".sql($bp_en)."',
`bp_cn`='".sql($bp_cn)."',
`text2`='".sql($text2)."',
`text2_en`='".sql($text2_en)."',
`text2_cn`='".sql($text2_cn)."',
`video`='".sql($video)."',
`lang`='".sql($lang)."',
`status`='".sql($status)."',
`slug`='".sql($slug)."', 
`title`='".sql($title)."', 
`meta1`='".sql($meta1)."', 
`meta2`='".sql($meta2)."', 
`slug_en`='".sql($slug_en)."', 
`title_en`='".sql($title_en)."', 
`meta1_en`='".sql($meta1_en)."', 
`meta2_en`='".sql($meta2_en)."', 
`slug_cn`='".sql($slug_cn)."', 
`title_cn`='".sql($title_cn)."', 
`meta1_cn`='".sql($meta1_cn)."', 
`meta2_cn`='".sql($meta2_cn)."'
WHERE `id`='".sql($page['id'])."' LIMIT 1;";

exit;*/

if ($status!=$page['status']) {
	if ($status=="1") {
		if ($page['stamp']>(time()-86400)) {
		countadd($catalog, $type, 0, 1);
		}else{
		countadd($catalog, $type, 1, 0);	
		}
	}else{	
		if ($page['stamp']>(time()-86400)) {
		countadd($catalog, $type, 0, -1);
		}else{
		countadd($catalog, $type, -1, 0);	
		}
	}
}elseif($catalog!=$page['catalog']){
	countrefresh();	
}




$pos=$_POST['pos'];

foreach ($pos as $k => $v)
{
	mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items_files` SET `position`='".sql($v)."' WHERE `id`='".sql($k)."' and `item`='".sql($page['id'])."' and `type`='image' LIMIT 1;");
}

$files=restructureFilesArray($_FILES['input-file']);
$k=0;
$kk=1;
	$query="SELECT count(id) as rm, max(position) as mp FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($page['id'])."' and `type`='image';";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$total=$arsql['rm'];
	$mp=$arsql['mp'];
	

	foreach($files as $file){
		
		if (mb_strlen($file['tmp_name'])>0) {
			if (checkimage($file) and $total<10) {
				$fl=upload($file, "items");
				if (mb_strlen($fl)>4) {
					mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."items_files` (`type`, `item`, `file`, `position`) VALUES ('image', '".sql($page['id'])."', '".sql($fl)."', '".sql($mp+$kk)."')");
					$kk++;
					$total++;
				}else{
					// Не все фотографии загрузились
				}
			}else{
				// Не все фотографии загрузились
			}
		}
		$k++;
		
	}
	
compacttable("items_files", "item");



alert("Объявление изменено!", "Объявление успешно изменено", "check", "success");
red($_SERVER['HTTP_REFERER']);	
	
}



if ($sce=="catalog_add") {
	
if (in_array($_POST['input-type'], array("1", "2"))) { $type=$_POST['input-type']; } else { $type=2; }
if (in_array($_POST['input-status-p'], array("1", "3"))) { $status_p=$_POST['input-status-p']; } else { $status_p=1; }
if (in_array($_POST['input-status-s'], array("1", "3"))) { $status_s=$_POST['input-status-s']; } else { $status_s=1; }
if (in_array($_POST['input-status-k'], array("1", "3"))) { $status_k=$_POST['input-status-k']; } else { $status_k=1; }


$file="";
if (mb_strlen($_FILES['input-file']['tmp_name'])>0) {
	if (checkimagecat($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "catalog");
	}else{
		alert("Ошибка загрузки!", "Не удалось загрузить иконку", "times", "danger");
	}
}

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		$parent=$arsql['id'];
	}
}

	$query="SELECT max(position) as maxp, min(position) as minp FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='".sql($parent)."';";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$maxp=$arsql['maxp'];
	$minp=$arsql['minp'];
	
	if ($_POST['input-position']==1) { $position=$minp-1; } else { $position=$maxp+1; }

if (mb_strlen($_POST['input-name'])==0) { $name="Новая категория"; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-name-en'])==0) { $name_en="New category"; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn="New category"; } else { $name_cn=$_POST['input-name-cn']; }

if (mb_strlen($_POST['input-html'])==0 || $type=="1") { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-title'])==0 || $type=="1") { $title=""; } else { $title=$_POST['input-title']; }
if (mb_strlen($_POST['input-desc'])==0 || $type=="1") { $meta1=""; } else { $meta1=$_POST['input-desc']; }
if (mb_strlen($_POST['input-keyw'])==0 || $type=="1") { $meta2=""; } else { $meta2=$_POST['input-keyw']; }
if (mb_strlen($_POST['input-slug'])==0 || $type=="1") { $slug=slug($name, "pages"); } else { $slug=$_POST['input-slug']; }

if (mb_strlen($_POST['input-html-en'])==0 || $type=="1") { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-title-en'])==0 || $type=="1") { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
if (mb_strlen($_POST['input-desc-en'])==0 || $type=="1") { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
if (mb_strlen($_POST['input-keyw-en'])==0 || $type=="1") { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }
if (mb_strlen($_POST['input-slug-en'])==0 || $type=="1") { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }

if (mb_strlen($_POST['input-html-cn'])==0 || $type=="1") { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-title-cn'])==0 || $type=="1") { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
if (mb_strlen($_POST['input-desc-cn'])==0 || $type=="1") { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
if (mb_strlen($_POST['input-keyw-cn'])==0 || $type=="1") { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }
if (mb_strlen($_POST['input-slug-cn'])==0 || $type=="1") { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }


mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."catalog` (
`type`,
`parent`,
`name`, 
`file`, 
`html`, 
`slug`, 
`title`, 
`meta1`, 
`meta2`, 
`stamp`, 
`status_p`, 
`status_s`, 
`status_k`, 
`name_en`, 
`html_en`, 
`slug_en`, 
`title_en`, 
`meta1_en`, 
`meta2_en`, 
`name_cn`, 
`html_cn`, 
`slug_cn`, 
`title_cn`, 
`meta1_cn`, 
`meta2_cn`,
`position`, 
`user`,
`ip`
) VALUES (
'".sql($type)."', 
'".sql($parent)."', 
'".sql($name)."', 
'".sql($file)."', 
'".sql($html)."', 
'".sql($slug)."', 
'".sql($title)."', 
'".sql($meta1)."', 
'".sql($meta2)."', 
'".sql(time())."', 
'".sql($status_p)."', 
'".sql($status_s)."', 
'".sql($status_k)."', 
'".sql($name_en)."', 
'".sql($html_en)."', 
'".sql($slug_en)."', 
'".sql($title_en)."', 
'".sql($meta1_en)."', 
'".sql($meta2_en)."', 
'".sql($name_cn)."', 
'".sql($html_cn)."', 
'".sql($slug_cn)."', 
'".sql($title_cn)."', 
'".sql($meta1_cn)."', 
'".sql($meta2_cn)."',
'".sql($position)."',
'".sql($GLOBALS['user']['id'])."',
'".sql($GLOBALS['user']['ip'])."')");


superct("catalog", "type", 0);

alert("Категория добавлена!", "Категория успешно добавлена", "check", "success");
red("?mod=catalog_list&id=".$parent);

}



if ($sce=="catalog_edit") {
	
if (!is_numeric($_POST['id'])) { $id=0; } else { $id=$_POST['id']; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Категория не найдена", "times", "danger");
red("?mod=catalog_list");	
}	
	
		
if (in_array($_POST['input-type'], array("1", "2"))) { $type=$_POST['input-type']; } else { $type=$page['type']; }

	$query3="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='".sql($id)."' LIMIT 1;";
	$str3 = mysqlq($query3);
	$arsql3=mysql_fetch_assoc($str3);
	$numrows3=mysql_num_rows($str3);	
	if ($numrows3>0){
		$type=$page['type'];
	}

if (mb_strlen($_FILES['input-file']['tmp_name'])>0) {
	if (checkimagecat($_FILES['input-file'])) {
		$file=upload($_FILES['input-file'], "catalog");
		
	}else{ alert("Ошибка загрузки!", "Не удалось загрузить иконку", "times", "danger"); }
if ($file!="" and mb_strlen($page['file'])>4 and file_exists("../upload/catalog/".$page['file'])) {
	unlink("../upload/catalog/".$page['file']);
}elseif($file==""){
	$file=$page['file'];
}
}else{
	if($_POST['photo-del']=="1") {
		if (mb_strlen($page['file'])>4) {
			if (file_exists("../upload/catalog/".$page['file'])){	
				unlink("../upload/catalog/".$page['file']);
			}
		}
		$file="";
	}else{
		$file=$page['file'];
	}
}

if (in_array($_POST['input-status-p'], array("1", "3"))) { $status_p=$_POST['input-status-p']; } else { $status_p=1; }
if (in_array($_POST['input-status-s'], array("1", "3"))) { $status_s=$_POST['input-status-s']; } else { $status_s=1; }
if (in_array($_POST['input-status-k'], array("1", "3"))) { $status_k=$_POST['input-status-k']; } else { $status_k=1; }

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		$parent=$arsql['id'];
	}
}


if (mb_strlen($_POST['input-name'])==0) { $name=$page['name']; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }

if (mb_strlen($_POST['input-html'])==0 || $type=="1") { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-title'])==0 || $type=="1") { $title=""; } else { $title=$_POST['input-title']; }
if (mb_strlen($_POST['input-desc'])==0 || $type=="1") { $meta1=""; } else { $meta1=$_POST['input-desc']; }
if (mb_strlen($_POST['input-keyw'])==0 || $type=="1") { $meta2=""; } else { $meta2=$_POST['input-keyw']; }
if (mb_strlen($_POST['input-slug'])==0 || $type=="1") { $slug=slug($name, "pages"); } else { $slug=$_POST['input-slug']; }

if (mb_strlen($_POST['input-html-en'])==0 || $type=="1") { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-title-en'])==0 || $type=="1") { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
if (mb_strlen($_POST['input-desc-en'])==0 || $type=="1") { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
if (mb_strlen($_POST['input-keyw-en'])==0 || $type=="1") { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }
if (mb_strlen($_POST['input-slug-en'])==0 || $type=="1") { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }

if (mb_strlen($_POST['input-html-cn'])==0 || $type=="1") { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-title-cn'])==0 || $type=="1") { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
if (mb_strlen($_POST['input-desc-cn'])==0 || $type=="1") { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
if (mb_strlen($_POST['input-keyw-cn'])==0 || $type=="1") { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }
if (mb_strlen($_POST['input-slug-cn'])==0 || $type=="1") { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }


mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."catalog` SET
`type`='".sql($type)."', 
`parent`='".sql($parent)."', 
`name`='".sql($name)."', 
`html`='".sql($html)."', 
`slug`='".sql($slug)."', 
`title`='".sql($title)."', 
`meta1`='".sql($meta1)."', 
`meta2`='".sql($meta2)."', 
`file`='".sql($file)."', 
`status_p`='".sql($status_p)."', 
`status_s`='".sql($status_s)."', 
`status_k`='".sql($status_k)."', 
`name_en`='".sql($name_en)."', 
`html_en`='".sql($html_en)."', 
`slug_en`='".sql($slug_en)."', 
`title_en`='".sql($title_en)."', 
`meta1_en`='".sql($meta1_en)."', 
`meta2_en`='".sql($meta2_en)."', 
`name_cn`='".sql($name_cn)."', 
`html_cn`='".sql($html_cn)."', 
`slug_cn`='".sql($slug_cn)."', 
`title_cn`='".sql($title_cn)."', 
`meta1_cn`='".sql($meta1_cn)."', 
`meta2_cn`='".sql($meta2_cn)."' WHERE `id`='".sql($page['id'])."' LIMIT 1;");

countrefresh();

alert("Категория изменена!", "Категория успешно изменена", "check", "success");
red("?mod=catalog_list&id=".$parent);

}


if ($sce=="pages_add") {
	
if (in_array($_POST['input-type'], array("1", "2"))) { $type=$_POST['input-type']; } else { $type=2; }
if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=1; }

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		$parent=$arsql['id'];
	}
}

	$query="SELECT max(position) as maxp, min(position) as minp FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `parent`='".sql($parent)."' and `type`='2';";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$maxp=$arsql['maxp'];
	$minp=$arsql['minp'];
	
	if ($_POST['input-position']==1) { $position=$minp-1; } else { $position=$maxp+1; }

if (mb_strlen($_POST['input-name'])==0) { if ($type=="1") { $name="Новая папка"; } else { $name="Новая страница"; } } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }

if (mb_strlen($_POST['input-html'])==0 || $type=="1") { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-title'])==0 || $type=="1") { $title=""; } else { $title=$_POST['input-title']; }
if (mb_strlen($_POST['input-desc'])==0 || $type=="1") { $meta1=""; } else { $meta1=$_POST['input-desc']; }
if (mb_strlen($_POST['input-keyw'])==0 || $type=="1") { $meta2=""; } else { $meta2=$_POST['input-keyw']; }
if (mb_strlen($_POST['input-slug'])==0 || $type=="1") { $slug=slug($name, "pages"); } else { $slug=$_POST['input-slug']; }

if (mb_strlen($_POST['input-html-en'])==0 || $type=="1") { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-title-en'])==0 || $type=="1") { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
if (mb_strlen($_POST['input-desc-en'])==0 || $type=="1") { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
if (mb_strlen($_POST['input-keyw-en'])==0 || $type=="1") { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }
if (mb_strlen($_POST['input-slug-en'])==0 || $type=="1") { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }

if (mb_strlen($_POST['input-html-cn'])==0 || $type=="1") { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-title-cn'])==0 || $type=="1") { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
if (mb_strlen($_POST['input-desc-cn'])==0 || $type=="1") { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
if (mb_strlen($_POST['input-keyw-cn'])==0 || $type=="1") { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }
if (mb_strlen($_POST['input-slug-cn'])==0 || $type=="1") { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }


mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."pages` (
`type`,
`parent`,
`name`, 
`html`, 
`slug`, 
`title`, 
`meta1`, 
`meta2`, 
`stamp`, 
`status`, 
`name_en`, 
`html_en`, 
`slug_en`, 
`title_en`, 
`meta1_en`, 
`meta2_en`, 
`name_cn`, 
`html_cn`, 
`slug_cn`, 
`title_cn`, 
`meta1_cn`, 
`meta2_cn`,
`position`, 
`user`,
`ip`
) VALUES (
'".sql($type)."', 
'".sql($parent)."', 
'".sql($name)."', 
'".sql($html)."', 
'".sql($slug)."', 
'".sql($title)."', 
'".sql($meta1)."', 
'".sql($meta2)."', 
'".sql(time())."', 
'".sql($status)."', 
'".sql($name_en)."', 
'".sql($html_en)."', 
'".sql($slug_en)."', 
'".sql($title_en)."', 
'".sql($meta1_en)."', 
'".sql($meta2_en)."', 
'".sql($name_cn)."', 
'".sql($html_cn)."', 
'".sql($slug_cn)."', 
'".sql($title_cn)."', 
'".sql($meta1_cn)."', 
'".sql($meta2_cn)."',
'".sql($position)."',
'".sql($GLOBALS['user']['id'])."',
'".sql($GLOBALS['user']['ip'])."')");

superct("pages", "type", 0);

alert("Страница добавлена!", "Страница успешно добавлена", "check", "success");
red("?mod=pages_list&id=".$parent);

}




if ($sce=="pages_edit") {
	
if (!is_numeric($_POST['id'])) { $id=0; } else { $id=$_POST['id']; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Страница не найдена", "times", "danger");
red("?mod=pages_list");	
}	
	
		
if (in_array($_POST['input-type'], array("1", "2"))) { $type=$_POST['input-type']; } else { $type=$page['type']; }

	$query3="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `parent`='".sql($id)."' LIMIT 1;";
	$str3 = mysqlq($query3);
	$arsql3=mysql_fetch_assoc($str3);
	$numrows3=mysql_num_rows($str3);	
	if ($numrows3>0){
		$type=$page['type'];
	}

if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=$page['status']; }

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		$parent=$arsql['id'];
	}
}


if (mb_strlen($_POST['input-name'])==0) { $name=$page['name']; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }

if (mb_strlen($_POST['input-html'])==0 || $type=="1") { $html=""; } else { $html=$_POST['input-html']; }
if (mb_strlen($_POST['input-title'])==0 || $type=="1") { $title=""; } else { $title=$_POST['input-title']; }
if (mb_strlen($_POST['input-desc'])==0 || $type=="1") { $meta1=""; } else { $meta1=$_POST['input-desc']; }
if (mb_strlen($_POST['input-keyw'])==0 || $type=="1") { $meta2=""; } else { $meta2=$_POST['input-keyw']; }
if (mb_strlen($_POST['input-slug'])==0 || $type=="1") { $slug=slug($name, "pages"); } else { $slug=$_POST['input-slug']; }

if (mb_strlen($_POST['input-html-en'])==0 || $type=="1") { $html_en=""; } else { $html_en=$_POST['input-html-en']; }
if (mb_strlen($_POST['input-title-en'])==0 || $type=="1") { $title_en=""; } else { $title_en=$_POST['input-title-en']; }
if (mb_strlen($_POST['input-desc-en'])==0 || $type=="1") { $meta1_en=""; } else { $meta1_en=$_POST['input-desc-en']; }
if (mb_strlen($_POST['input-keyw-en'])==0 || $type=="1") { $meta2_en=""; } else { $meta2_en=$_POST['input-keyw-en']; }
if (mb_strlen($_POST['input-slug-en'])==0 || $type=="1") { $slug_en=""; } else { $slug_en=$_POST['input-slug-en']; }

if (mb_strlen($_POST['input-html-cn'])==0 || $type=="1") { $html_cn=""; } else { $html_cn=$_POST['input-html-cn']; }
if (mb_strlen($_POST['input-title-cn'])==0 || $type=="1") { $title_cn=""; } else { $title_cn=$_POST['input-title-cn']; }
if (mb_strlen($_POST['input-desc-cn'])==0 || $type=="1") { $meta1_cn=""; } else { $meta1_cn=$_POST['input-desc-cn']; }
if (mb_strlen($_POST['input-keyw-cn'])==0 || $type=="1") { $meta2_cn=""; } else { $meta2_cn=$_POST['input-keyw-cn']; }
if (mb_strlen($_POST['input-slug-cn'])==0 || $type=="1") { $slug_cn=""; } else { $slug_cn=$_POST['input-slug-cn']; }


mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."pages` SET
`type`='".sql($type)."', 
`parent`='".sql($parent)."', 
`name`='".sql($name)."', 
`html`='".sql($html)."', 
`slug`='".sql($slug)."', 
`title`='".sql($title)."', 
`meta1`='".sql($meta1)."', 
`meta2`='".sql($meta2)."', 
`status`='".sql($status)."', 
`name_en`='".sql($name_en)."', 
`html_en`='".sql($html_en)."', 
`slug_en`='".sql($slug_en)."', 
`title_en`='".sql($title_en)."', 
`meta1_en`='".sql($meta1_en)."', 
`meta2_en`='".sql($meta2_en)."', 
`name_cn`='".sql($name_cn)."', 
`html_cn`='".sql($html_cn)."', 
`slug_cn`='".sql($slug_cn)."', 
`title_cn`='".sql($title_cn)."', 
`meta1_cn`='".sql($meta1_cn)."', 
`meta2_cn`='".sql($meta2_cn)."' WHERE `id`='".sql($page['id'])."' LIMIT 1;");

alert("Страница изменена!", "Страница успешно изменена", "check", "success");
red("?mod=pages_list&id=".$parent);

}


if ($sce=="topmenu_add") {
	
if (in_array($_POST['input-type'], array("1", "2"))) { $type=$_POST['input-type']; } else { $type=2; }
if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=1; }

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		$parent=$arsql['id'];
	}
}

	$query="SELECT max(position) as maxp, min(position) as minp FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `parent`='".sql($parent)."' and `type`='2';";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$maxp=$arsql['maxp'];
	$minp=$arsql['minp'];
	
if ($_POST['input-position']==1) { $position=$minp-1; } else { $position=$maxp+1; }

if (mb_strlen($_POST['input-name'])==0) { if ($type=="1") { $name="Новая папка"; } else { $name="Новая ссылкаа"; } } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }

if (mb_strlen($_POST['input-link'])==0) { $link="#"; } else { $link=$_POST['input-link']; }
if (mb_strlen($_POST['input-link-en'])==0) { $link_en="#"; } else { $link_en=$_POST['input-link-en']; }
if (mb_strlen($_POST['input-link-cn'])==0) { $link_cn="#"; } else { $link_cn=$_POST['input-link-cn']; }

if (mb_strlen($_POST['input-blank'])=="1") { $blank="1"; } else { $blank="0"; }


mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."topmenu` (
`type`,
`parent`,
`name`, 
`link`, 
`name_en`, 
`link_en`, 
`name_cn`, 
`link_cn`, 
`blank`, 
`status`, 
`position`, 
`stamp`, 
`user`,
`ip`
) VALUES (
'".sql($type)."', 
'".sql($parent)."', 
'".sql($name)."', 
'".sql($link)."', 
'".sql($name_en)."', 
'".sql($link_en)."', 
'".sql($name_cn)."', 
'".sql($link_cn)."', 
'".sql($blank)."', 
'".sql($status)."', 
'".sql($position)."',
'".sql(time())."', 
'".sql($GLOBALS['user']['id'])."',
'".sql($GLOBALS['user']['ip'])."')");

superct("topmenu", "type", 0);

alert("Ссылка добавлена!", "Ссылка успешно добавлена", "check", "success");
red("?mod=topmenu_list&id=".$parent);

}




if ($sce=="topmenu_edit") {
	
if (!is_numeric($_POST['id'])) { $id=0; } else { $id=$_POST['id']; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Ссылка не найдена", "times", "danger");
red("?mod=topmenu_list");	
}	
	
		
if (in_array($_POST['input-type'], array("1", "2"))) { $type=$_POST['input-type']; } else { $type=$page['type']; }

	$query3="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `parent`='".sql($id)."' LIMIT 1;";
	$str3 = mysqlq($query3);
	$arsql3=mysql_fetch_assoc($str3);
	$numrows3=mysql_num_rows($str3);	
	if ($numrows3>0){
		$type=$page['type'];
	}


if (in_array($_POST['input-status'], array("1", "3"))) { $status=$_POST['input-status']; } else { $status=$page['status']; }

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		$parent=$arsql['id'];
	}
}


if (mb_strlen($_POST['input-name'])==0) { $name=$page['name']; } else { $name=$_POST['input-name']; }
if (mb_strlen($_POST['input-name-en'])==0) { $name_en=""; } else { $name_en=$_POST['input-name-en']; }
if (mb_strlen($_POST['input-name-cn'])==0) { $name_cn=""; } else { $name_cn=$_POST['input-name-cn']; }

if (mb_strlen($_POST['input-link'])==0) { $link=$page['link']; } else { $link=$_POST['input-link']; }
if (mb_strlen($_POST['input-link-en'])==0) { $link_en=""; } else { $link_en=$_POST['input-link-en']; }
if (mb_strlen($_POST['input-link-cn'])==0) { $link_cn=""; } else { $link_cn=$_POST['input-link-cn']; }

if (mb_strlen($_POST['input-blank'])=="1") { $blank="1"; } else { $blank="0"; }



mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."topmenu` SET
`type`='".sql($type)."', 
`parent`='".sql($parent)."', 
`name`='".sql($name)."', 
`link`='".sql($link)."', 
`name_en`='".sql($name_en)."', 
`link_en`='".sql($link_en)."', 
`name_cn`='".sql($name_cn)."', 
`link_cn`='".sql($link_cn)."', 
`status`='".sql($status)."', 
`blank`='".sql($blank)."'
 WHERE `id`='".sql($page['id'])."' LIMIT 1;");

alert("Ссылка изменена!", "Ссылка успешно изменена", "check", "success");
red("?mod=topmenu_list&id=".$parent);

}


if ($sce=="text_add") {
	
if (!in_array($_POST['input-type'], array("0", "1"))) { 
$type="0";
}else{
$type=$_POST['input-type'];
}

$name=mb_strtolower($_POST['input-name']);
$text=$_POST['input-desc'];

	if(mb_strlen($_POST['date-at'])>0) {
		$dateto=strtotime($_POST['date-at']);
	}else{
		$dateto=0;
	}
	
	$value=$_POST['input-value'];

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		$parent=$arsql['id'];
	}else{
		if ($type=="0") {
			alert("Ошибка добавления переменной!", "Родительская папка не найдена", "times", "danger");
		}else{
			alert("Ошибка добавления папки!", "Родительская папка не найдена", "times", "danger");
		}
		telegram_form(array("form" => "text_add", "type" => $type, "parent" => $parent, "name" => $name, "value" => $value, "dateto" => $dateto, "text" => $text, "fail" => '1'));
		red('?mod=text_add');
	}
}


if ($type=="0")
{
		if (!preg_match('/^[0-9a-z_]+$/', $name) and $type=="0") {
			alert("Ошибка добавления переменной!", "Некорректный ключ (только лат., цифры и _)", "times", "danger");
			telegram_form(array("form" => "text_add", "type" => $type, "parent" => $parent, "name" => $name, "value" => $value, "dateto" => $dateto, "text" => $text, "fail" => '1'));
			red('?mod=text_add');	
		}

	if (mb_strlen($name)==0)
	{
		alert("Ошибка добавления переменной!", "Не указан ключ", "times", "danger");
		telegram_form(array("form" => "text_add", "type" => $type, "parent" => $parent, "name" => $name, "value" => $value, "dateto" => $dateto, "text" => $text, "fail" => '1'));
		red('?mod=text_add');
	}

	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql($name)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1){
		alert("Ошибка добавления переменной!", "Такой ключ уже есть в системе", "times", "danger");
		telegram_form(array("form" => "text_add", "type" => $type, "parent" => $parent, "name" => $name, "value" => $value, "dateto" => $dateto, "text" => $text, "fail" => '1'));
		red('?mod=text_add');
	}
		
}else{
	$name="";
	$value="";
	$dateto=0;
}

mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."text` (`parent`, `type`, `name`, `value`, `text`, `dateto`, `stamp`, `user`, `ip`) VALUES ('".sql($parent)."', '".sql($type)."', '".sql($name)."', '".sql($value)."', '".sql($text)."', '".sql($dateto)."', '".sql(time())."', '".sql($GLOBALS['user']['id'])."', '".sql($GLOBALS['user']['ip'])."')");

alert("Переменная добавлена!", "Переменная успешно добавлена", "check", "success");
if ($parent>0) { $id="&id=".$parent; } else { $id=""; }
red("?mod=text_list".$id);


}


if ($sce=="text_edit") {
	
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($_POST['id'])."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0){
		alert("Ошибка редактирования", "Переменная/папка не найдена", "times", "danger");
		red('?mod=text_list');
	}
	
if (!in_array($_POST['input-type'], array("0", "1"))) { 
$type="0";
}else{
$type=$_POST['input-type'];
}

if ($type=="0" and $arsql['type']=="1"){
	
	$query2="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `parent`='".sql($arsql['id'])."' LIMIT 1;";
	$str2 = mysqlq($query2);
	$numrows2=mysql_num_rows($str2);	
	if ($numrows2>0){
		alert("Ошибка редактирования", "Папка содержит вложения", "times", "danger");
		$id="";
		if ($arsql['parent']>0) { $id="&id=".$arsql['parent']; }
		red('?mod=text_list'.$id);
	}
}

$parent=0;
if (is_numeric($_POST['parent']) and $_POST['parent']>0)
{
	$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($_POST['parent'])."' and `type`='1' and `id`!='".sql($arsql['id'])."' and `parent`!='".sql($arsql['id'])."' LIMIT 1;";
	$str3 = mysqlq($query3);
	$arsql3=mysql_fetch_assoc($str3);
	$numrows3=mysql_num_rows($str3);	
	if ($numrows3==1){
		$parent=$arsql3['id'];
		$parents=text_check_parents($arsql3['id']);
		if (in_array($arsql['id'], $parents)){
			alert("Ошибка редактирования", "Зацикливание родителей", "times", "danger");
			red('?mod=text_edit&id='.$arsql['id']);
		}
	}else{
		alert("Ошибка редактирования", "Родительская папка не найдена", "times", "danger");
		red('?mod=text_edit&id='.$arsql['id']);
	}
}

$dateto=0;

if ($type=="0")
{
	
	$name=mb_strtolower($_POST['input-name']);

		if (!preg_match('/^[0-9a-z_]+$/', $name) and $type=="0") {
			alert("Ошибка редкатирования!", "Некорректный ключ (только лат., цифры и _)", "times", "danger");
			red('?mod=text_edit&id='.$arsql['id']);	
		}

	if (mb_strlen($name)==0)
	{
		alert("Ошибка редактирования", "Не указан ключ", "times", "danger");
		red('?mod=text_edit&id='.$arsql['id']);
	}

	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `name`='".sql($name)."' and `id`!='".sql($arsql['id'])."' LIMIT 1;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);	
	if ($numrows2==1){
		alert("Ошибка редактирования", "Такой ключ уже есть в системе", "times", "danger");
		red('?mod=text_edit&id='.$arsql['id']);
	}
	
	if(mb_strlen($_POST['date-at'])>0) {
		$dateto=strtotime($_POST['date-at']);
	}
	
	$value=$_POST['input-value'];
	
}else{
	$name="";
	$value="";
	$dateto=0;
}

$text=$_POST['input-desc'];

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET `parent`='".sql($parent)."', `type`='".sql($type)."', `name`='".sql($name)."', `value`='".sql($value)."', `text`='".sql($text)."', `dateto`='".sql($dateto)."', `stamp`='".sql(time())."', `user`='".sql($GLOBALS['user']['id'])."', `ip`='".sql($GLOBALS['user']['ip'])."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");

if ($type=="0") {
alert("Переменная изменена!", "Переменная успешно изменена", "check", "success");
}else{
alert("Папка изменена!", "Папка успешно добавлена", "check", "success");
}
if ($parent>0) { $id="&id=".$parent; } else { $id=""; }
red("?mod=text_list".$id);


}









if ($sce=="profile") {
	
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($GLOBALS['user']['id'])."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
red("/");	
}

if ($_FILES['input-file']) {
$fileunit = $_FILES['input-file'];
if (checkimage_profile($fileunit)) {
$file=upload_profile($fileunit);
} else { $file=""; }
if ($file!="" and mb_strlen($arsql['photo'])>4 and file_exists("upload/profiles/".$arsql['photo'])) {
	unlink("upload/profiles/".$arsql['photo']);
}
}else{
	if($_POST['photo-del']=="1") {
		if (mb_strlen($arsql['photo'])>4) {
			if (file_exists("upload/profiles/".$arsql['photo'])){	
				unlink("upload/profiles/".$arsql['photo']);
			}
		}
		$file="";
	}else{
		$file=$arsql['photo'];
	}
}

$name=htmlr($_POST['input-name']); 
if (mb_strlen(htmlr($_POST['input-email']))==0) { $email=$arsql['email']; } else { 
$email=mb_strtolower($_POST['input-email']);
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	$email=$arsql['email'];
	alert("Ошибка E-mail", "Некорректный E-mail", "info", "warning");

}else{
	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `email`='".sql($email)."' and `id`!='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);	
	if ($numrows2>0) {
	$email=$arsql['email'];
	alert("Ошибка E-mail", "E-mail уже используется на другом аккаунте", "info", "warning");
	}
}
} 

$phone=htmlr($_POST['input-phone']); 



mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."users` SET `name`='".sql($name)."', `phone`='".sql($phone)."', `email`='".sql($email)."', `photo`='".sql($file)."' WHERE `id`='".$arsql['id']."' and `del`='0' LIMIT 1;");
alert("Пользователь изменен!", "Данные Пользователя успешно изменены", "check", "success");

	

	


if (mb_strlen($_POST['input-pass'])>0) {
$pass=$_POST['input-pass'];
$pass2=$_POST['input-pass2'];
$error=array();
if (mb_strlen($pass)<5) {
$error[]="слишком короткий пароль";
}
if ($pass!=$pass2) {
$error[]="пароли не совпадают";
}
$error=implode(", ", $error);

if (mb_strlen($error)>0) {
alert("Ошибка изменения пароля", mb_ucfirst($error), "info", "warning");
}else{
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."users` SET `pass`='".md5($pass)."' WHERE `id`='".$arsql['id']."' and `del`='0' LIMIT 1;");
	
}
}


red("?mod=profile");


	
	
}




if ($sce=="followers_edit") {
if (is_numeric($_POST['id'])) { $id=$_POST['id']; } else { $id=0; }
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
red("?mod=followers_list");	
}

$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `id`='".sql($_POST['input-status'])."' LIMIT 1;";
$str = mysqlq($query);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
	$role=$page['role'];
}else{
	$role=$_POST['input-status'];
}
	
if (filter_var($_POST['input-email'], FILTER_VALIDATE_EMAIL) === false) {
	$email=$page['email'];
}else{
	$email=$_POST['input-email'];
}

$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`!='".sql($id)."' and `email`='".sql($email)."' LIMIT 1;";
$str = mysqlq($query);
$numrows=mysql_num_rows($str);	
if ($numrows==1) {
	alert("E-mail уже используется", "Есть другой аккаунт с таким E-mail", "times", "danger");
	$email=$page['email'];
}

$name=htmlr($_POST['input-name']);
$phone=htmlr($_POST['input-phone']);
$company=htmlr($_POST['input-company']);

$public_email=htmlr($_POST['input-pubemail']);
$public_name=htmlr($_POST['input-pubname']);
$public_phone=htmlr($_POST['input-pubphone']);




$org_name=htmlr($_POST['input-orgname']);
$org_fullname=htmlr($_POST['input-orgfullname']);
$org_uadres=htmlr($_POST['input-orguadres']);
$org_fadres=htmlr($_POST['input-orgfadres']);
$org_ogrn=htmlr($_POST['input-orgorgn']);
$org_inn=htmlr($_POST['input-orginn']);
$org_kpp=htmlr($_POST['input-orgkpp']);
$org_bank=htmlr($_POST['input-orgbank']);
$org_rs=htmlr($_POST['input-orgrs']);
$org_ks=htmlr($_POST['input-orgks']);
$org_bik=htmlr($_POST['input-orgbik']);


mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET 
`role`='".sql($role)."', 
`email`='".sql($email)."', 
`name`='".sql($name)."', 
`company`='".sql($company)."', 
`phone`='".sql($phone)."', 
`public_phone`='".sql($public_phone)."', 
`public_name`='".sql($public_name)."', 
`public_email`='".sql($public_email)."', 
`org_name`='".sql($org_name)."', 
`org_fullname`='".sql($org_fullname)."', 
`org_uadres`='".sql($org_uadres)."', 
`org_fadres`='".sql($org_fadres)."', 
`org_ogrn`='".sql($org_ogrn)."', 
`org_inn`='".sql($org_inn)."', 
`org_kpp`='".sql($org_kpp)."', 
`org_bank`='".sql($org_bank)."', 
`org_rs`='".sql($org_rs)."', 
`org_ks`='".sql($org_ks)."', 
`org_bik`='".sql($org_bik)."' WHERE `id`='".sql($page['id'])."' LIMIT 1;");

alert("Аккаунт изменен!", "Данные Аккаунта успешно изменены", "check", "success");

	

	
red("?mod=followers_edit&id=".$page['id']);


	
	
}


if ($sce=="followers_add") {

if (filter_var($_POST['input-email'], FILTER_VALIDATE_EMAIL) === false) {
	alert("E-mail с ошибкой", "Не удалось распознать E-mail", "times", "danger");
	red("?mod=followers_add");
}else{
	$email=$_POST['input-email'];
	
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `email`='".sql($email)."' and `del`='0' LIMIT 1;";
	$str = mysqlq($query);
	$page=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1) {
	alert("E-mail уже используется", "Есть другой аккаунт с таким E-mail", "times", "danger");
	red("?mod=followers_edit&id=".$page['id']);	
	}
}

$name=htmlr($_POST['input-name']);
$phone=htmlr($_POST['input-phone']);
$company=htmlr($_POST['input-company']);

$public_email=htmlr($_POST['input-pubemail']);
$public_name=htmlr($_POST['input-pubname']);
$public_phone=htmlr($_POST['input-pubphone']);

$org_name=htmlr($_POST['input-orgname']);
$org_fullname=htmlr($_POST['input-orgfullname']);
$org_uadres=htmlr($_POST['input-orguadres']);
$org_fadres=htmlr($_POST['input-orgfadres']);
$org_ogrn=htmlr($_POST['input-orgorgn']);
$org_inn=htmlr($_POST['input-orginn']);
$org_kpp=htmlr($_POST['input-orgkpp']);
$org_bank=htmlr($_POST['input-orgbank']);
$org_rs=htmlr($_POST['input-orgrs']);
$org_ks=htmlr($_POST['input-orgks']);
$org_bik=htmlr($_POST['input-orgbik']);

$pass1=$_POST['input-pass1'];

if (mb_strlen($pass1)<4) { $pass1=$email; }

$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `id`='".sql($_POST['input-status'])."' LIMIT 1;";
$str = mysqlq($query);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
	$role=$page['role'];
}else{
	$role=0;
}

$md5=md5($pass1);
$confirm=confirmgen("followers");	



mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."followers` (`role`, 
`email`, 
`name`, 
`company`, 
`phone`, 
`public_phone`, 
`public_name`, 
`public_email`, 
`org_name`, 
`org_fullname`, 
`org_uadres`, 
`org_fadres`, 
`org_ogrn`, 
`org_inn`, 
`org_kpp`, 
`org_bank`, 
`org_rs`, 
`org_ks`, 
`org_bik`, 
`pass`, 
`regdate`, 
`ip`, 
`confirm`, 
`blocked`, 
`status`)
 VALUES 
('".sql($role)."', 
'".sql($email)."', 
'".sql($name)."', 
'".sql($company)."', 
'".sql($phone)."', 
'".sql($public_phone)."', 
'".sql($public_name)."', 
'".sql($public_email)."', 
'".sql($org_name)."', 
'".sql($org_fullname)."', 
'".sql($org_uadres)."', 
'".sql($org_fadres)."', 
'".sql($org_ogrn)."', 
'".sql($org_inn)."', 
'".sql($org_kpp)."', 
'".sql($org_bank)."', 
'".sql($org_rs)."', 
'".sql($org_ks)."', 
'".sql($org_bik)."', 
'".sql($pass)."', 
'".sql(time())."', 
'".sql($GLOBALS['user']['ip'])."', 
'".sql($confirm)."', 
'0', 
'3')");




	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `confirm`='".sql($confirm)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		alert("Ошибка", "Возможно, есть проблема с БД", "times", "danger");
		red("?mod=followers_add");	
	}
		
alert("Аккаунт добавлен!", "Аккаунт успешно добавлен", "check", "success");
red("?mod=followers_edit&id=".$arsql['id']);





	
}



if ($sce=="users_edit") {
if (is_numeric($_POST['id'])) { $id=$_POST['id']; } else { $id=0; }
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
red("/");	
}

if ($GLOBALS['user']['status']<=$arsql['status'] and $arsql['id']!=$GLOBALS['user']['id']) {
	alert("Ошибка изменения", "У Вас нет прав для внесения изменений", "times", "danger");
	red('?mod=users_list');
}

if ($arsql['lockstatus']=="1" and $GLOBALS['user']['status']<3) {
	alert("Ошибка изменения", "У Вас нет прав для внесения изменений", "times", "danger");
	red('?mod=users_list');	
}

$name=htmlr($_POST['input-name']); 
if (mb_strlen(htmlr($_POST['input-email']))==0) { $email=$arsql['email']; } else { 
$email=mb_strtolower($_POST['input-email']);
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	$email=$arsql['email'];
	alert("Ошибка E-mail", "Некорректный E-mail", "info", "warning");

}else{
	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `email`='".sql($email)."' and `id`!='".sql($id)."' LIMIT 1;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);	
	if ($numrows2>0) {
	$email=$arsql['email'];
	alert("Ошибка E-mail", "E-mail уже используется на другом аккаунте", "info", "warning");
	}
}
} 

$phone=htmlr($_POST['input-phone']); 

if ($GLOBALS['user']['status']>=3 and in_array($_POST['input-lockstatus'], array("0", "1"))){
$lockstatus=$_POST['input-lockstatus'];
}else{
$lockstatus=$arsql['lockstatus'];	
}
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."users` SET `name`='".sql($name)."', `phone`='".sql($phone)."', `email`='".sql($email)."', `lockstatus`='".sql($lockstatus)."' WHERE `id`='".$arsql['id']."' and `del`='0' LIMIT 1;");
alert("Пользователь изменен!", "Данные Пользователя успешно изменены", "check", "success");

	

	


if (mb_strlen($_POST['input-pass'])>0) {
$pass=$_POST['input-pass'];
$pass2=$_POST['input-pass2'];
$error=array();
if (mb_strlen($pass)<5) {
$error[]="слишком короткий пароль";
}
if ($pass!=$pass2) {
$error[]="пароли не совпадают";
}
$error=implode(", ", $error);

if (mb_strlen($error)>0) {
alert("Ошибка изменения пароля", mb_ucfirst($error), "info", "warning");
}else{
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."users` SET `pass`='".md5($pass)."' WHERE `id`='".$arsql['id']."' and `del`='0' LIMIT 1;");
	
}
}


red("?mod=users_list");


	
	
}

if (in_array($_GET['mod'], $agets)) { $mod=$_GET['mod']; } // else { red('/?mod=logs_list'); }
if (is_numeric($_GET['id'])) { $id=$_GET['id']; } 


if ($mod=="main") {

}

if ($mod=="filemanager_list") {
	$folder=array();
	$parentfolder=array();
	if ($_GET['folder']!="") {
		$folders=explode("/", $_GET['folder']."/");
		foreach ($folders as $fff)
		{
			$fff=trim($fff);
			// echo $fff;

			if (mb_strlen($fff)>0 and !in_array($fff, array("..", "."))) {
				if (file_exists("../upload/".implode("/", $folder)."/".$fff)) {
					$parentfolder=$folder;
					$folder[]=$fff;
				}
			}
		}
		$folder=implode("/", $folder);
		$parentfolder=implode("/", $parentfolder);
	}else{
		$folder="";
		$parentfolder="";
	}
}

if ($mod=="items_list"){

}
if ($mod=="catalog_list"){
	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
	if ($_GET['ct']=="1") {
		superct("catalog", "type", 0);
		red("?mod=catalog_list&id=".$id);	
	}
}
if ($mod=="pages_list"){
	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
	if ($_GET['ct']=="1") {
		superct("pages", "type", 0);
		red("?mod=pages_list&id=".$id);	
	}
}

if ($mod=="pages_add"){

	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
}

if ($mod=="catalog_add"){

	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
}

if ($mod=="items_add"){

	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
}


if ($mod=="items_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Объявление не найдено", "times", "danger");

red($_SERVER['HTTP_REFERER']);	
}
compacttable("items_files", "item");






}

if ($mod=="catalog_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Категория не найдена", "times", "danger");

red("?mod=catalog_list");	
}		
}

if ($mod=="pages_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Страница/папка не найдена", "times", "danger");

red("?mod=pages_list");	
}		
}

if ($mod=="topmenu_list"){
	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
	if ($_GET['ct']=="1") {
		superct("topmenu", "type", 0);
		red("?mod=topmenu_list&id=".$id);	
	}
}

if ($mod=="slides_list"){

	if ($_GET['ct']=="1") {
		superct("slides");
		red("?mod=slides_list");	
	}
}

if ($mod=="partners_list"){

	if ($_GET['ct']=="1") {
		superct("partners");
		red("?mod=partners_list");	
	}
}

if ($mod=="topmenu_add"){

	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
}


if ($mod=="topmenu_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Ссылка не найдена", "times", "danger");

red("?mod=topmenu_list");	
}		
}

if ($mod=="news_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Публикация не найдена", "times", "danger");

red("?mod=news_list");	
}		
}

if ($mod=="slides_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Слайд не найден", "times", "danger");

red("?mod=slides_list");	
}		
}

if ($mod=="partners_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Партнёр не найден", "times", "danger");

red("?mod=partners_list");	
}		
}


if ($mod=="text_add"){
	
		$fxpromo_array=text("flex_promo");
		if ($fxpromo_array['dateto']>time()){
			$fxpromo=$fxpromo_array['value'];
		}else{
			$fxpromo="";
		}
		
	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($id)."' and `type`='1' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
}

if ($mod=="text_edit"){
	if (!is_numeric($id)) { $id=0; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$page=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		alert("Ошибка редактирования", "Переменная/папка не найдена", "times", "danger");
		red('?mod=text_list');
	}
}

if ($mod=="text_list"){
	if (!is_numeric($id)) { $id=0; }
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($id)."' LIMIT 1;";
	$str = mysqlq($query);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$id=0;
	}
}


if ($mod=="users_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Пользователь не найден", "times", "danger");

red("?mod=users_list");	
}		
}



if ($mod=="followers_edit") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка изменения", "Пользователь не найден", "times", "danger");

red("?mod=followers_list");	
}		
}

if ($mod=="followers_confirm") {

if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
	
alert("Ошибка подтверждения", "Пользователь не найден", "times", "danger");
red("?mod=followers_list");	
}

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `confirm`='', `status`='1' WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;"); 

alert("Аккаунт подтвержден", "Аккаунт успешно подтвержден", "check", "success");
red("?mod=followers_edit&id=".$page['id']);			
}



if ($mod=="faq") { $page['header']="Вопрос-ответ"; }
elseif ($mod=="text_add") { $page['header']="Добавить переменную"; }
elseif ($mod=="text_edit") { $page['header']="Редактирование переменной"; }
elseif ($mod=="text_list") { $page['header']="Настройки"; }
elseif ($mod=="news_add") { $page['header']="Добавить публикацию"; }
elseif ($mod=="news_edit") { $page['header']="Редактирование публикации"; }
elseif ($mod=="news_list") { $page['header']="Все публикации"; }
elseif ($mod=="pages_add") { $page['header']="Добавить страницу"; }
elseif ($mod=="pages_edit") { $page['header']="Редактирование страницы"; }
elseif ($mod=="pages_list") { $page['header']="Все страницы"; }
elseif ($mod=="items_add") { $page['header']="Добавить объявление"; }
elseif ($mod=="items_edit") { $page['header']="Редактирование объявления"; }
elseif ($mod=="items_list") { $page['header']="Все объявления"; }
elseif ($mod=="catalog_add") { $page['header']="Добавить категорию"; }
elseif ($mod=="catalog_edit") { $page['header']="Редактирование категории"; }
elseif ($mod=="catalog_list") { $page['header']="Все категории"; }
elseif ($mod=="filemanager_list") { $page['header']="Менеджер файлов"; }
elseif ($mod=="topmenu_add") { $page['header']="Добавить ссылку в верхнее меню"; }
elseif ($mod=="topmenu_edit") { $page['header']="Редактирование ссылки верхнего меню"; }
elseif ($mod=="topmenu_list") { $page['header']="Верхнее меню"; }
elseif ($mod=="slides_add") { $page['header']="Добавить слайд"; }
elseif ($mod=="slides_edit") { $page['header']="Редактирование слайда"; }
elseif ($mod=="slides_list") { $page['header']="Все слайды"; }
elseif ($mod=="partners_add") { $page['header']="Добавить партнёра"; }
elseif ($mod=="partners_edit") { $page['header']="Редактирование партнёра"; }
elseif ($mod=="partners_list") { $page['header']="Все партнёры"; }
elseif ($mod=="plain_edit_text_main_about") { $page['header']="Информация о нас"; }
elseif ($mod=="plain_edit_text_footer") { $page['header']="Футер"; }
elseif ($mod=="plain_edit_text_social") { $page['header']="Соцсети"; }
elseif ($mod=="profile") { $page['header']="Профиль пользвателя"; }
elseif ($mod=="users_list") { $page['header']="Пользователи"; }
elseif ($mod=="users_edit") { $page['header']="Редактирование пользователя"; }
elseif ($mod=="followers_list") { $page['header']="Аккаунты"; }
elseif ($mod=="followers_edit") { $page['header']="Редактирование аккаунта"; }
else{ $page['header']=$GLOBALS['value']['header']; }


if ($mod=="catalog_delete") {
	
	if (!is_numeric($id)) { $id=0; }
	if (is_numeric($_GET['folder']) and $_GET['folder']>0) { $folder="&id=".$_GET['folder']; } else { $folder=""; }


if (catalog_delete("catalog", $id)){
	countrefresh();
	alert("Категория удалена!", "Категория успешно удалена", "check", "warning");
	red('?mod=catalog_list'.$folder);
}else{
	alert("Ошибка удаления", "Категория не найдена", "times", "danger");
	red('?mod=catalog_list'.$folder);
}
	
}

if ($mod=="items_delete") {
	
	if (!is_numeric($id)) { $id=0; }

if (items_delete($id)){
	alert("Объявление удалено!", "Объявление успешно удалено", "check", "warning");
	red($_SERVER['HTTP_REFERER']);
}else{
	alert("Ошибка удаления", "Объявление не найдено", "times", "danger");
	red($_SERVER['HTTP_REFERER']);
}
	
}
if ($mod=="items_files_delete") {
	if (!is_numeric($id)) { $id=0; }
	
			$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `id`='".sql($id)."' and `type`='image'";
			$str2 = mysqlq($query2);
			$arsql2=mysql_fetch_assoc($str2);
			$numrows2=mysql_num_rows($str2);	
				if ($numrows2==1){
						$cachename=cachename("upload/items/", $arsql2['file']);
						if (file_exists("../upload/items/cache/".$cachename) and mb_strlen($cachename)>4) { unlink("../upload/items/cache/".$cachename); }
						if (file_exists("../upload/items/".$arsql2['file']) and mb_strlen($arsql2['file'])>4) { unlink("../upload/items/".$arsql2['file']); }

				mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `id`='".sql($arsql2['id'])."' LIMIT 1;");
				alert("Изображение удалено!", "Изображение успешно удалено", "check", "warning");
				red($_SERVER['HTTP_REFERER']);				
				}
			mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `id`='".sql($arsql2['id'])."' LIMIT 1;");	
			alert("Ошибка удаления", "Изображение не найдено", "times", "danger");
			red($_SERVER['HTTP_REFERER']);
	
}

if ($mod=="pages_delete") {
	
	if (!is_numeric($id)) { $id=0; }
	if (is_numeric($_GET['folder']) and $_GET['folder']>0) { $folder="&id=".$_GET['folder']; } else { $folder=""; }


if (pages_delete("pages", $id)){
	alert("Страница/папка удалена!", "Страница/папка успешно удалена", "check", "warning");
	red('?mod=pages_list'.$folder);
}else{
	alert("Ошибка удаления", "Страница/папка не найдена", "times", "danger");
	red('?mod=pages_list'.$folder);
}
	
}


if ($mod=="topmenu_delete") {
	
	if (!is_numeric($id)) { $id=0; }
	if (is_numeric($_GET['folder']) and $_GET['folder']>0) { $folder="&id=".$_GET['folder']; } else { $folder=""; }


if (pages_delete("topmenu", $id)){
	alert("Ссылка/папка удалена!", "Ссылка/папка успешно удалена", "check", "warning");
	red('?mod=topmenu_list'.$folder);
}else{
	alert("Ошибка удаления", "Ссылка/папка не найдена", "times", "danger");
	red('?mod=topmenu_list'.$folder);
}
	
}

if ($mod=="text_delete") {
	
	if (!is_numeric($id)) { $id=0; }

		$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($id)."' LIMIT 1;";
		$str = mysqlq($query);
		$arsql=mysql_fetch_assoc($str);
		$numrows=mysql_num_rows($str);	
		if ($numrows==0){
			alert("Ошибка удаления", "Переменная/папка не найдена", "times", "danger");
			red('?mod=text_list');
		}
		
	if ($arsql['type']=="1"){
		
		$query2="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `parent`='".sql($arsql['id'])."' LIMIT 1;";
		$str2 = mysqlq($query2);
		$numrows2=mysql_num_rows($str2);	
		if ($numrows2>0){
			alert("Ошибка удаления", "Папка содержит вложения", "times", "danger");
			$id="";
			if ($arsql['parent']>0) { $id="&id=".$arsql['parent']; }
			red('?mod=text_list'.$id);
		}
	}

	mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");

	if ($arsql['type']==0) {
	alert("Переменная удалена!", "Переменная успешно удалена", "check", "warning");
	}else{
	alert("Переменная удалена!", "Переменная успешно удалена", "check", "warning");
	}

	$id="";
	if ($arsql['parent']>0) { $id="&id=".$arsql['parent']; }
	red('?mod=text_list'.$id);	

	
}

if ($mod=="users_delete") {
	
if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка удаления!", "Пользователь не найден", "times", "danger");
red("?mod=users_list");	
}

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."users` SET `del`='1' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");


alert("Пользователь удален!", "Для отмены обратитесь к разработчику", "check", "warning");
red("?mod=users_list");	

	
}

if ($mod=="followers_delete") {
	
if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($id)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка удаления!", "Аккаунт не найден", "times", "danger");
red("?mod=followers_list");	
}

mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `del`='1' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");


alert("Аккаунт удален!", "Для отмены обратитесь к разработчику", "check", "warning");
red("?mod=followers_list");	

	
}

if ($mod=="news_delete") {
	
if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка удаления!", "Публикация не найдена", "times", "danger");
red("?mod=news_list");	
}

if (mb_strlen($arsql['file'])>4) {
	if (file_exists("../upload/news/".$arsql['file'])){	
		unlink("../upload/news/".$arsql['file']);
	}
}

mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");


alert("Публикация удалена!", "Публикация успешно удалена", "check", "warning");
red("?mod=news_list");	

	
}

if ($mod=="slides_delete") {
	
if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка удаления!", "Слайд не найден", "times", "danger");
red("?mod=slides_list");	
}

if (mb_strlen($arsql['file'])>4) {
	if (file_exists("../upload/slides/".$arsql['file'])){	
		unlink("../upload/slides/".$arsql['file']);
	}
}

if (mb_strlen($arsql['file_en'])>4) {
	if (file_exists("../upload/slides/".$arsql['file_en'])){	
		unlink("../upload/slides/".$arsql['file_en']);
	}
}

if (mb_strlen($arsql['file_cn'])>4) {
	if (file_exists("../upload/slides/".$arsql['file_cn'])){	
		unlink("../upload/slides/".$arsql['file_cn']);
	}
}
mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");


alert("Слайд удален!", "Слайд успешно удален", "check", "warning");
red("?mod=slides_list");	

	
}


if ($mod=="partners_delete") {
	
if (!is_numeric($id)) { $id=0; }
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `id`='".sql($id)."' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==0) {
alert("Ошибка удаления!", "Партнёр не найден", "times", "danger");
red("?mod=partners_list");	
}

if (mb_strlen($arsql['file'])>4) {
	if (file_exists("../upload/partners/".$arsql['file'])){	
		unlink("../upload/partners/".$arsql['file']);
	}
}

mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");


alert("Партнёр удален!", "Партнёр успешно удален", "check", "warning");
red("?mod=partners_list");	

	
}

?><!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $GLOBALS['value']['header']; if ($page['header']!=$GLOBALS['value']['header'] and mb_strlen($page['header'])>0) { echo " :: ".$page['header']; } ?></title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/main.css?5">
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/jquery.fancybox.min.css">
		<link rel="stylesheet" href="css/datepicker.crm.css">
        <link rel="stylesheet" href="css/mainfix.css?5">
		<link href="summernote/summernote-bs4.mod.css" rel="stylesheet">


		<style>
			.mwp-140 {
				max-width: 140px;
			}
			.mhp-140 {
				max-height: 140px;
			}
			.mwp-100 {
				max-width: 100px;
			}
			.mhp-100 {
				max-height: 100px;
			}
			.mwp-40 {
				max-width: 40px;
			}
			.mhp-40 {
				max-height: 40px;
			}
			.mwp-70 {
				max-width: 70px;
			}
			.mhp-70 {
				max-height: 70px;
			}
			.page-link {
				color: #393939;
			}
			.page-item.active .page-link {
				background-color: #9f9f9f;
				border-color: #8a8a8a;
			}
		</style>
    </head>
    <body class="o-page">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- SIDEBAR -->
        <div class="o-page__sidebar js-page-sidebar">
            <div class="c-sidebar">
                <a class="c-sidebar__brand" href="#">
                    <img class="c-sidebar__brand-img" src="img/logo.png" alt="Logo"> <?php echo d($GLOBALS['value']['header']); ?>
                </a>
			<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "9"))) { ?>
				<h4 class="c-sidebar__title">Страницы</h4>
                <ul class="c-sidebar__list">
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=pages_add">
                            <i class="fa fa-file-o u-mr-xsmall"></i>Добавить страницу
                        </a>
                    </li>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=pages_list">
                            <i class="fa fa-bars u-mr-xsmall"></i>Все страницы
                        </a>
                    </li>
                </ul>
			<?php } ?>
			
			<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "8", "9"))) { ?>
				<h4 class="c-sidebar__title">Публикации</h4>
                <ul class="c-sidebar__list">
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=news_add">
                            <i class="fa fa-file-o u-mr-xsmall"></i>Добавить пост
                        </a>
                    </li>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=news_list">
                            <i class="fa fa-bars u-mr-xsmall"></i>Все посты
                        </a>
                    </li>
                </ul>
			<?php } ?>
			
			<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "8"))) { 
			
											$query="SELECT count(id) as rnum FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `status`='2';";
											$str = mysqlq($query);
											$arsql=mysql_fetch_assoc($str);
			
			
			?>
				<h4 class="c-sidebar__title">Объявления</h4>
                <ul class="c-sidebar__list">
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=catalog_list">
                            <i class="fa fa-bars u-mr-xsmall"></i>Категории
                        </a>
                        <a class="c-sidebar__link" href="?mod=items_list&status=2">
                            <i class="fa fa-eye u-mr-xsmall"></i>Модерация <?php if ($arsql['rnum']>0) { echo "(".$arsql['rnum'].")"; } ?>
                        </a>
                        <a class="c-sidebar__link" href="?mod=items_list">
                            <i class="fa fa-file-o u-mr-xsmall"></i>Объявления
                        </a>
                    </li>
                </ul>
			<?php } ?>	
			<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "9"))) { ?>	
				<h4 class="c-sidebar__title">Главная страница</h4>
                <ul class="c-sidebar__list">
					<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "9"))) { ?>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=plain_edit_text_social">
                            <i class="fa fa-link u-mr-xsmall"></i>Соцсети
                        </a>
                    </li>
					<?php } ?>
					<?php if (in_array($GLOBALS['user']['status'], array("3", "4"))) { ?>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=topmenu_list">
                            <i class="fa fa-arrow-up u-mr-xsmall"></i>Верхнее меню
                        </a>
                    </li>
					<?php } ?>
					<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "9"))) { ?>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=slides_list">
                            <i class="fa fa-image u-mr-xsmall"></i>Слайд-шоу
                        </a>
                    </li>
					<?php } ?>
					<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "9"))) { ?>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=partners_list">
                            <i class="fa fa-suitcase u-mr-xsmall"></i>Партнёры
                        </a>
                    </li>
					<?php } ?>
					<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "9"))) { ?>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=plain_edit_text_main_about">
                            <i class="fa fa-info-circle u-mr-xsmall"></i>Информация о нас
                        </a>
                    </li>
					<?php } ?>
					<?php if (in_array($GLOBALS['user']['status'], array("3", "4"))) { ?>
					<li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=plain_edit_text_footer">
                            <i class="fa fa-arrow-down u-mr-xsmall"></i>Футер
                        </a>
                    </li>
					<?php } ?>
                </ul>
				<?php } ?>
				
				<?php if (in_array($GLOBALS['user']['status'], array("3"))) { ?>
                <h4 class="c-sidebar__title">Настройки</h4>
                <ul class="c-sidebar__list">
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=text_list">
                            <i class="fa fa-link u-mr-xsmall"></i>Переменные
                        </a>
                    </li>
                </ul>
				<?php } ?>
				
				<?php if (in_array($GLOBALS['user']['status'], array("3", "4", "8"))) { ?>
                <h4 class="c-sidebar__title">Управление порталом</h4>
                <ul class="c-sidebar__list">
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=followers_list">
                            <i class="fa fa-user-o u-mr-xsmall"></i>Аккаунты
                        </a>
                    </li>
                </ul>
				<?php } ?>
				
				<?php if (in_array($GLOBALS['user']['status'], array("3"))) { ?>
                <h4 class="c-sidebar__title">Администрирование</h4>
                <ul class="c-sidebar__list">
					<?php if (in_array($GLOBALS['user']['status'], array("3"))) { ?>
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=users_list">
                            <i class="fa fa-user-o u-mr-xsmall"></i>Пользователи
                        </a>
                    </li>
					<?php } ?>
					<?php if (in_array($GLOBALS['user']['status'], array("3"))) { ?>
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=filemanager_list">
                            <i class="fa fa-user-o u-mr-xsmall"></i>Менеджер файлов
                        </a>
                    </li>
					<?php } ?>
                </ul>
				<?php } ?>

				<?php if (in_array($GLOBALS['user']['status'], array("33"))) { ?>
                <h4 class="c-sidebar__title">Помощь</h4>
                <ul class="c-sidebar__list">
                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="?mod=faq">
                            <i class="fa fa-quote-left u-mr-xsmall"></i>Вопрос-ответ
                        </a>
                    </li>
                </ul>
				<?php } ?>
				
				<br><br>
            </div><!-- // .c-sidebar -->
        </div><!-- // .o-page__sidebar -->

        <!-- MAIN CONTENT -->
        <main class="o-page__content">
            <header class="c-navbar u-mb-medium">
                <button class="c-sidebar-toggle js-sidebar-toggle">
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                </button>
                
                <h2 class="c-navbar__title u-mr-auto"><?php echo d($page['header']); ?></h2>
				<?php
											
											$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."alerts` WHERE `user`>0 and `user`='".sql($GLOBALS['user']['id'])."' ORDER BY `stamp` DESC, `id` DESC LIMIT 12;";
											$str = mysqlq($query);
											$arsql=mysql_fetch_assoc($str);
											$numrows=mysql_num_rows($str);
											if ($numrows>0) {
				?>
                <div class="c-dropdown dropdown u-mr-medium u-ml-small u-hidden-down@mobile">
                    <a class="c-notification dropdown-toggle" href="?mod=calls_list" id="dropdownMenuAlerts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="c-notification__icon">
                            <i class="fa fa-bell-o"></i>
                        </span>
                    </a>

                    <div class="c-dropdown__menu c-dropdown__menu--large dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuAlerts">
					<?php do { ?>
                        <a href="#" class="c-dropdown__item dropdown-item o-media">
                            <span class="o-media__img u-mr-xsmall">
                                <span class="c-avatar c-avatar--xsmall">
                                    <span class="c-avatar__img u-bg-<?php if ($arsql['c']!="") { echo d($arsql['c']); } else { echo "warning"; } ?> u-flex u-justify-center u-align-items-center">
                                        <i class="fa fa-<?php if ($arsql['i']!="") { echo d($arsql['i']); } else { echo "info"; } ?> u-text-large u-color-white"></i>
                                    </span>
                                </span>
                                
                            </span>
                            <div class="o-media__body">
                                <h6 class="u-mb-zero"><?php echo d($arsql['t']); ?></h6>
                                <p class="u-text-mute"><?php echo d($arsql['d']); ?></p>
                            </div>
                        </a>
					<?php } while($arsql=mysql_fetch_assoc($str)); ?>
                    </div>
                </div>
											<?php } ?>
                <div class="c-dropdown dropdown">
                    <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle bafter-0" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="c-avatar__img" src="<?php if (mb_strlen($GLOBALS['user']['photo'])>4 and file_exists("upload/profiles/".$GLOBALS['user']['photo'])) { echo "upload/profiles/".$GLOBALS['user']['photo']; } else { echo "img/avatar-72.png"; } ?>">
                    </a>

                    <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                        <a class="c-dropdown__item dropdown-item" href="?mod=profile">Пользователь</a>
                        <div class="dropdown-divider m-0 mt-1 mb-1"></div>
                        <a class="c-dropdown__item dropdown-item" href="auth_logout.php">Выйти</a>
                    </div>
                </div>
            </header><!-- // .c-navbar -->
			
            <div class="container">
                <div class="row ml-0 mr-0">
				<?php echo get_active_alerts(); ?>
				</div>
			</div>


					<?php if ($mod=="text_add") { 
										$query0="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."form` WHERE `form`='".sql($mod)."' and `user_id`='".sql($GLOBALS['user']['id'])."' ORDER BY `id` DESC LIMIT 1;";

										$str0 = mysqlq($query0);
										$last=mysql_fetch_assoc($str0);
										$numrows0=mysql_num_rows($str0);	
										if ($numrows0==0){ $last=array(); }

										if ($last['fail']=="0") { $last=array(); }
										mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."form` SET `fail`='0' WHERE `form`='".sql($mod)."' and `user_id`='".sql($GLOBALS['user']['id'])."' ORDER BY `id` DESC LIMIT 1;");
					?>					
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form id="form" method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="text_add">
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
                                <div class="col-sm-12">
                                    <select id="input-type" name="input-type" class="form-control form-control-sm">
										<option value="0"<?php if ($last['type']=="0") { echo " SELECTED"; } ?>>Переменная</option>
										<option value="1"<?php if ($last['type']=="1") { echo " SELECTED"; } ?>>Папка</option>
									</select>
								</div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="parent">Папка</label>
                                <div class="col-sm-12">
                                    <select id="parent" name="parent" class="form-control form-control-sm">
										<option value="0"<?php if ($last['parent']=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
										<?php 
										if ($last['parent']>0) { $par=$last['parent']; } else { $par=$id; } 
										echo text_folders($t=0,"",$par); ?>
									</select>
								</div>
                            </div>
							<div class="form-group row ml-0 mr-0" style="display: none;">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Ключ(лат.)</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php if (mb_strlen($last['name'])>0) { echo d($last['name']); } ?>">
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Название</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm" value="<?php if (mb_strlen($last['text'])>0) { echo d($last['text']); } ?>">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0" style="display: none;">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-value">Значение</label>
                                <div class="col-sm-12">
                                    <textarea id="input-value" name="input-value" class="form-control-sm w-100 h-100 border" rows="10"><?php if (mb_strlen($last['value'])>0) { echo d($last['value']); } ?></textarea>
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0" style="display: none;">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="date-at">Срок действия</label>
                                <div class="col-sm-12">
									<?php if ($last['dateto']>0) { ?>
                                    <input type="text" id="date-at" name="date-at" class="form-control form-control-sm datepicker-here" data-value="<?php echo d($last['dateto']*1000); ?>" value="<?php echo date("d.m.Y H:i", $last['dateto']); ?>">
									<?php }else{ ?>
									<input type="text" id="date-at" name="date-at" class="form-control form-control-sm datepicker-here" value="">
									<?php } ?>
								</div>
                            </div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->  

					<?php }elseif($mod=="catalog_list") { ?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=catalog_list&id=<?php echo $id; ?>&ct=1" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i></a>
					<a href="?mod=catalog_add&id=<?php echo $id; ?>" class="btn btn-sm btn-success">Добавить категорию</a>
				</div>
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 75% !important;">Контент</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Позиция</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Пользователь</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center" style="min-width: 120px;">Статус</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$searchsql="";
						$searchsql=" and `parent`='".sql($id)."'"; 
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`>0".$searchsql." ORDER BY `position`, `name`, `id`;";

						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						
						
						
						
						
							if ($id>0) {
								
								$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($id)."' LIMIT 1;";
								$str2 = mysqlq($query2);
								$arsql2=mysql_fetch_assoc($str2);
								$numrows2=mysql_num_rows($str2);
								if ($numrows2>0) {
							?>
                            <tr class="c-table__row">
								
                                <td class="c-table__cell p-1 text-left pl-3">
									<?php echo "<a class=\"font-weight-bold\" href=\"?mod=catalog_list&id=".$arsql2['parent']."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-folder-o\"></i>&nbsp; </span>..</a>"; ?>
                                </td>

                                <td class="c-table__cell p-1 d-none d-md-table-cell text-center">
									<?php echo d(""); ?>
                                </td>
							
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<div class="c-dropdown dropdown">
										<button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton0" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a href="?mod=catalog_list" class="c-dropdown__item dropdown-item p-1 pl-2">В корневую папку</a>
                                        </div>
									</div>
                                </td>

                            </tr>
							<?php
								}
								}
						
						
						
						
						
						
						
						
						
						
						
						
						if ($numrows>0) {
						do {
						if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
						
						
						$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($arsql['user'])."' and `del`='0' LIMIT 1;";
						$str3 = mysqlq($query3);
						$arsql3=mysql_fetch_assoc($str3);
						$numrows3=mysql_num_rows($str3);
						if ($numrows3==1) { 
							if (mb_strlen($arsql3['name'])>0) { $uname=$arsql3['name']; } else { $uname=$arsql3['login']; }
							if (mb_strlen($arsql3['phone'])>0) { $uphone=$arsql3['phone']; } else { $uphone=""; }			
						}else{
							$uname="unknown";
							$uphone="";
						}
					
						$upost=implode("<br>", array_diff(array(htmlr($uname), htmlr($uphone)), array('', NULL, false)));
						
						
						?>
										
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">

                                <td class="c-table__cell p-1 align-top text-left pl-3">
									<?php 
									if ($arsql['type']=="1") {
										echo "<a href=\"?mod=catalog_list&id=".d($arsql['id'])."\"><b><i class=\"fa fa-folder\"></i> ".d($arsql['name'])."</a>"; 
									}else{
										echo d($arsql['name']); 
									} ?>
									<span class="d-md-none admin_comment_blue"><br><?php echo d($upost); ?></span>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center mwp-70">
									<input type="text" class="form-control form-control-sm text-center positioncatalog" data-id="<?php echo d($arsql['id']); ?>" id="pos<?php echo d($arsql['id']); ?>" name="pos[<?php echo d($arsql['position']); ?>]" value="<?php echo d($arsql['position']); ?>">
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center">
									<?php echo $upost; ?>
                                </td>

                                <td class="c-table__cell p-0 pt-2 pb-2 text-center align-top">
									<?php if ($arsql['status_p']=="1") { 
										echo "<button id=\"statuscatalogp".d($arsql['id'])."\" data-type=\"p\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatuscatalog\"><b>П</b></button>";
									} elseif ($arsql['status_p']=="3") { 
										echo "<button id=\"statuscatalogp".d($arsql['id'])."\" data-type=\"p\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatuscatalog\"><b>П</b></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>	
									<?php if ($arsql['status_s']=="1") { 
										echo "<button id=\"statuscatalogs".d($arsql['id'])."\" data-type=\"s\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatuscatalog\"><b>С</b></button>";
									} elseif ($arsql['status_s']=="3") { 
										echo "<button id=\"statuscatalogs".d($arsql['id'])."\" data-type=\"s\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatuscatalog\"><b>С</b></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>	
									<?php if ($arsql['status_k']=="1") { 
										echo "<button id=\"statuscatalogk".d($arsql['id'])."\" data-type=\"k\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatuscatalog\"><b>К</b></button>";
									} elseif ($arsql['status_k']=="3") { 
										echo "<button id=\"statuscatalogk".d($arsql['id'])."\" data-type=\"k\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatuscatalog\"><b>К</b></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>										
                                </td>
								
                                <td class="c-table__cell p-0 pt-2 text-center align-top">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=catalog_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" эту категорию" href="?mod=catalog_delete&id=<?php echo $arsql['id']; ?>&folder=<?php echo $arsql['parent']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="5" class="c-table__cell text-center">Категорий не найдено</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
                        </tbody>
                    </table>

					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    
			
			
					
					<?php }elseif($mod=="items_list") { 
					
					$searchsql="";
					$link=array();
					$link[]="?mod=items_list";
					
					$time1=strtotime($_GET['date-from']);
					$time2=strtotime($_GET['date-to']);
					
					if ($time1<=946587600) { $time1=0; } 
					if ($time2<=946587600) { $time2=0; }
					
					if ($time2<$time1 and $time>0) { list($time1, $time2) = array($time2, $time1); }
					
					if ($time1>0) { $time1=strtotime(date("Y-m-d",$time1)." 00:00:00"); }
					if ($time2>0) { $time2=strtotime(date("Y-m-d",$time2)." 23:59:59"); }
					
					
					if ($time1>0 and $time2>0) {
						$searchsql.=" and `stamp`>='".$time1."' and `stamp`<='".$time2."'";
						$link[]="date-from=".date("d.m.Y", $time1);
						$link[]="date-to=".date("d.m.Y", $time2);
					}elseif($time1>0){
						$searchsql.=" and `stamp`>='".$time1."'";
						$link[]="date-from=".date("d.m.Y", $time1);
					}elseif($time2>0){
						$searchsql.=" and `stamp`<='".$time2."'";
						$link[]="date-to=".date("d.m.Y", $time2);
					}
					
					if (is_numeric($_GET['user']) and $_GET['user']>0) { 
						$searchsql.=" and `user`='".sql($_GET['user'])."'"; 
						$link[]="user=".$_GET['user'];
					}
					
					if (in_array($_GET['type'], array("p", "s", "k"))) {
						$searchsql.=" and `type`='".sql($_GET['type'])."'"; 
						$link[]="type=".$_GET['type'];
					}
					
					if (is_numeric($_GET['catalog']) and $_GET['catalog']>0) {
						
						$kidsfull=kidsfull("catalog", $_GET['catalog'], $q="");
						$kidsfull=implode("' || `catalog`='", $kidsfull);
						$searchsql.=" and (`catalog`='".$kidsfull."')"; 
						
						
						$link[]="catalog=".$_GET['catalog'];
					}
					
					if (in_array($_GET['status'], array("1", "2", "3"))) {
						$searchsql.=" and `status`='".sql($_GET['status'])."'"; 
						$link[]="status=".$_GET['status'];
					}

					if (mb_strlen($_GET['name'])>0) {
						$searchsql.=" and `name` LIKE '%".sql($_GET['name'])."%'"; 
						$link[]="name=".$_GET['name'];
					}
					
					
					
					
					$quoten=10;

						$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`>0".$searchsql." ORDER BY `stamp` DESC, `id` DESC";
						// echo $query;
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$total=mysql_num_rows($str);

						if ($_GET['pg'] and is_numeric($_GET['pg']) and $_GET['pg']>0 and $_GET['pg']==round($_GET['pg'])) { $pg=$_GET['pg']; } else { $pg=1; }
						
						if (($total%$quoten)==0) { $correct=0; } else {$correct=1;}
						$pages=mod($total, $quoten)+$correct;

						if ($pg>$pages) { $pg=$pages; }

						if (!$pg or (($pg%1)>0)) { $pg=1; }
						$start=($pg-1)*$quoten;
					
					
					
					
					?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=items_add" class="btn btn-sm btn-success">Добавить объявление</a>
				</div>
                <div class="row ml-0 mr-0 mb-3" style="background-color: #F5F8FA; border: 1px solid #dee2e6;">
					<form method="get" class="w-100 row m-0 p-0"><input type="hidden" name="mod" value="items_list"><input type="hidden" name="pg" value="1">
						<div class="col-12 col-sm-21 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="date-from">Дата от</label>
                                <div class="col-12 pl-2 pr-2">
                                    <input type="text" id="date-from" name="date-from" class="form-control form-control-sm datepicker-here"<?php if ($time1>0) { echo " data-value=\"".d($time1*1000)."\""; } ?> value="<?php if ($time1>0) { echo date("d.m.Y", $time1); } ?>">
                                </div>
                            </div>
						</div>
						<div class="col-12 col-sm-21 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="date-to">Дата до</label>
                                <div class="col-12 pl-2 pr-2">
                                    <input type="text" id="date-to" name="date-to" class="form-control form-control-sm datepicker-here"<?php if ($time2>0) { echo " data-value=\"".d($time2*1000)."\""; } ?> value="<?php if ($time2>0) { echo date("d.m.Y", $time2); } ?>">
                                </div>
                            </div>
						</div>
						
						<div class="col-12 col-sm-21 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="type">Тип</label>
                                <div class="col-12 pl-2 pr-2">
                                    <select id="type" name="type" class="form-control form-control-sm">
										<option value=""></option>
										<option value="p"<?php if ($_GET['type']=="p") { echo " SELECTED"; } ?>>Предложение</option>
										<option value="s"<?php if ($_GET['type']=="s") { echo " SELECTED"; } ?>>Спрос</option>
										<option value="k"<?php if ($_GET['type']=="k") { echo " SELECTED"; } ?>>Компании</option>
									</select>	
								</div>
                            </div>
						</div>
						<div class="col-12 col-sm-21 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="catalog">Кат<span class="d-none d-lg-inline-block">егория</span></label>
                                <div class="col-12 pl-2 pr-2">
                                    <select id="catalog" name="catalog" class="form-control form-control-sm">
										<option value=""></option>
										<?php if (is_numeric($_GET['catalog']) and $_GET['catalog']>0) { echo catalog_list2($_GET['catalog']); } else { echo catalog_list2(); } ?>
									</select>	
								</div>
                            </div>
						</div>
						<div class="col-12 col-sm-21 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="name">Текст</label>
                                <div class="col-12 pl-2 pr-2">
                                    <input type="text" id="name" name="name" class="form-control form-control-sm" value="<?php if (mb_strlen($_GET['name'])>0) { $dataname=addslashes($_GET['name']); echo $dataname; } else { $dataname=""; } ?>">
								</div>
                            </div>
						</div>
						<div class="col-12 col-sm-21 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="status">Статус</label>
                                <div class="col-12 pl-2 pr-2">
                                    <select id="status" name="status" class="form-control form-control-sm">
										<option value=""></option>
										<option value="1"<?php if ($_GET['status']=="1") { echo " SELECTED"; } ?>>Опубликовано</option>
										<option value="2"<?php if ($_GET['status']=="2") { echo " SELECTED"; } ?>>Модерация</option>
										<option value="3"<?php if ($_GET['status']=="3") { echo " SELECTED"; } ?>>Отклонено</option>
									</select>	
								</div>
                            </div>
						</div>
						<div class="col-12 col-sm-21 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="user">Польз<span class="d-none d-lg-inline-block">ователь</span></label>
                                <div class="col-12 pl-2 pr-2">
                                    <select id="user" name="user" class="form-control form-control-sm c-select has-search select2-hidden-accessible">
										<option value="">&nbsp;</option>
										<?php
										$datauser="";
											$array=array();
											
											$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` ORDER BY `name`, `id`";
											$str2 = mysqlq($query2);
											$arsql2=mysql_fetch_assoc($str2);
											$numrows2=mysql_num_rows($str2);
											if ($numrows2>0) {
											do {
											?><option value="<?php echo d($arsql2['id']); ?>"<?php if ($_GET['user']==$arsql2['id']) { echo " SELECTED"; $datauser=$key; } ?>>[<?php echo d($arsql2['id']); ?>] <?php echo d($arsql2['name']); ?><?php if (mb_strlen($arsql2['company'])>0) { echo " (".d($arsql2['company']).")"; } ?></option><?php

											}while($arsql2=mysql_fetch_assoc($str2)); 
											}
											?>
									</select>	
								</div>
                            </div>
						</div>
						<div class="col-12 p-0">
                            <div class="form-group row ml-0 mr-0 form-actions text-right mt-2 mb-2">
                                <div class="col-12 pl-2 pr-2">
									<span id="logstotal" class="btn btn-sm btn-default pull-left pl-0"><?php if ($total>0) { ?><?php echo $total; ?> зап., <?php echo $pg; ?>/<?php echo $pages; ?> стр.<?php } else { ?>Записей не найдено<?php } ?></span>
                                    <input type="submit" class="btn btn-sm btn-success" value="Применить">
                                </div>
                            </div>
						</div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center mwp-70">Дата</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center mwp-70">ID</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Польз.</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Тип</th>
                              <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 75% !important;">Кат./Наим./Регион</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center">Статус</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$array_types=array("p" => "П", "s" => "С", "k" => "К");
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`>0".$searchsql." ORDER BY `stamp` DESC, `id` DESC LIMIT ".$start.", ".$quoten.";";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
						do {
						if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
						
						
						$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`='".sql($arsql['user'])."' LIMIT 1;";
						$str3 = mysqlq($query3);
						$follower3=mysql_fetch_assoc($str3);
						$numrows3=mysql_num_rows($str3);
						if ($numrows3==0) { 
							$follower3['name']="н/д";
						}
					

												
						?>

                            <tr class="c-table__row" data-items-id="<?php echo $arsql['id']; ?>">
                                <td class="c-table__cell p-1 text-center align-middle">
									<?php echo date("d.m.Y", $arsql['stamp'])."<br>".date("H:i:s", $arsql['stamp']); ?><div class="d-md-none admin_comment_blue"><?php echo d($follower3['name']); ?></div>
								</td>
								
                                <td class="c-table__cell p-1 text-center align-middle">
									<?php echo d($arsql['id']); ?></div>
								</td>
								
                                <td class="c-table__cell p-1 align-middle d-none d-md-table-cell text-center">
									<?php $arp=array();
									
									if (mb_strlen($follower3['company'])>0) { $arp[]=d($follower3['company']); } 
									if (mb_strlen($follower3['name'])>0) { $arp[]=d($follower3['name']); } 
									
									echo implode("<br>", $arp);
									
									?>
                                </td>
	
                                <td class="c-table__cell p-1 align-middle d-none d-md-table-cell text-center">
									<?php echo d($array_types[$arsql['type']]); ?>
                                </td>
								
                                <td class="c-table__cell d-md-table-cell p-1 align-top text-left">
									<div class="admin_comment_green"><?php $catalog=catalogfull($arsql['catalog']); echo d(implode(" > ", $catalog)); ?></div>
									<div class="admin_comment_blue"><?php $region=regionfull($arsql['region']); echo d(implode(" > ", $region)); ?></div>
									<?php echo d($arsql['name']); ?>
                                </td>
								
								<td class="c-table__cell p-1 pl-2 pr-2 align-middle text-center">
									<?php if ($arsql['status']=="1") { 
										echo "<button id=\"statusitems".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatusitems\"><i class=\"fa fa-check\"></i></button>";
									} elseif ($arsql['status']=="2") { 
										echo "<button id=\"statusitems".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-warning changestatusitems\"><i class=\"fa fa-eye\"></i></button>"; 
									} elseif ($arsql['status']=="3") { 
										echo "<button id=\"statusitems".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatusitems\"><i class=\"fa fa-times\"></i></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>	
								</td>

								
                                <td class="c-table__cell p-0 pt-0 text-center align-middle">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("item", $arsql['id'], "ru"); ?>">Просмотр RU</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("item", $arsql['id'], "en"); ?>">Просмотр EN</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("item", $arsql['id'], "cn"); ?>">Просмотр CN</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=items_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" это объявление" href="?mod=items_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="7" class="c-table__cell text-center">Объявлений не найдено</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
						<caption id="caption" class="c-table__title table-bordered text-right p-2" data-maxid="<?php echo $maxid; ?>" data-date-from="<?php if ($time1>0) { echo date("d.m.Y", $time1); } ?>" data-date-to="<?php if ($time2>0) { echo date("d.m.Y", $time2); } ?>" data-autom="<?php if (is_numeric($_GET['autom']) and $_GET['autom']>0) { echo $_GET['autom']; } ?>" data-user="<?php echo $datauser; ?>" data-type="<?php echo $datatype; ?>" data-name="<?php echo $dataname; ?>">
						</caption>     
                        </tbody>
                    </table>
					<table class="c-table">
                        <tbody>
                            <tr>
                                <td class="c-table__cell text-center">
									<?php 
																	
									echo pages($link, $pg, $pages); ?>
								</td>
							</tr>
                        </tbody>
                    </table>
					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    



					<?php }elseif($mod=="filemanager_list") { ?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=catalog_list&id=<?php echo $id; ?>&ct=1" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i></a>
					<a href="?mod=catalog_add&id=<?php echo $id; ?>" class="btn btn-sm btn-success">Добавить категорию</a>
				</div>
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center" style="max-width: 50px;">&nbsp;</th>
							  <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 75% !important;">Имя</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Размер</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Дата</th>
                              <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						if ($folder!="") { 
						$dir="../upload/".$folder."/";
						}else{
						$dir="../upload/";
						}
						$files=array();
						$dirs=array();
						if (is_dir($dir)) {
							if ($dh = opendir($dir)) {
								while (($file = readdir($dh)) !== false) {
									if (!in_array($file, array(".", ".."))) {
										if (is_dir($dir.$file)) {
											$dirs[]=$file;
										}else{
											$files[]=$file;
										}
									}
								}
								closedir($dh);
							}
						}
						
						sort($dirs);
						sort($files);
						$files=array_merge($dirs, $files);
						$dirs="";
						$result=array();
						$k=0;
						foreach ($files as $file) {
							$result[$k]['id']=$k;
							if (is_dir($dir.$file)) {
								$result[$k]['type']="d";
								$result[$k]['size']=0;
								$result[$k]['mime']="";
								$result[$k]['stamp']=filemtime($dir.$file);
							}else{
								$result[$k]['type']="f";
								$result[$k]['size']=filesize($dir.$file);
								$result[$k]['mime']=typemime($dir.$file);
								$result[$k]['stamp']=filemtime($dir.$file);
							}
							$result[$k]['name']=$file;
							// echo $result[$k]['name']."\t".$result[$k]['type']."\t".$result[$k]['size']."\t".$result[$k]['mime']."<br>";
							$k++;
						}
						



						if ($folder!="") { ?>
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">

                                <td class="c-table__cell p-1 align-middle text-center">
									&nbsp;
                                </td>
								
                                <td class="c-table__cell p-1 align-middle text-left pl-3">
									<?php 
										echo "<a class=\"font-weight-bold\" href=\"?mod=filemanager_list&folder=".d($parentfolder)."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-folder-o\"></i>&nbsp; </span>..</a>"; 
									?>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-middle text-center mwp-70">
									<?php echo "&nbsp;"; ?>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-middle text-center">
									<?php echo "&nbsp;"; ?>
                                </td>

                               <td class="c-table__cell p-0 text-center align-middle">
                                    <?php echo "&nbsp;"; ?>
                                </td>
                            </tr>
						<?php } 

						
						$numrows=count($result);
						if ($numrows>0) {
							foreach ($result as $arsql) {

						?>
										
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">

                                <td class="c-table__cell p-1 align-middle text-center">
									<input type="checkbox" class="form-control form-control-sm text-center" name="f[]">
                                </td>
								
                                <td class="c-table__cell p-1 align-middle text-left pl-3">
									<?php 
										$newfolder="";
										$newpath="";
										if ($folder!="") {
											$newfolder=$folder."//".$arsql['name'];
											$newpath=$folder."//";
										}else{
											$newfolder=$arsql['name'];
											$newpath="";
										}
									if ($arsql['type']=="d") { 
										echo "<a class=\"font-weight-bold\" href=\"?mod=filemanager_list&folder=".d($newfolder)."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-folder-o\"></i>&nbsp; </span>".d($arsql['name'])."</a>"; 
									}else{
										if ($arsql['mime']=="photo") {
											echo "<a data-fancybox=\"gallery\" class=\"\" href=\"\upload\\".d($newpath.$arsql['name'])."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-image\"></i>&nbsp; </span>".d($arsql['name'])."</a>"; 
										}else{
											echo "<a class=\"\" href=\"#\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-sheet\"></i>&nbsp; </span>".d($arsql['name'])."</a>"; 
										}
									} 
									?>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-middle text-center mwp-70">
									<?php if ($arsql['size']==0) { echo "&nbsp;" ; } else { echo d(formatBytes($arsql['size'])); } ?>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-middle text-center">
									<?php echo d(date("d.m.Y H:i:s", $arsql['stamp'])); ?>
                                </td>

                               <td class="c-table__cell p-0 text-center align-middle">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=catalog_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" эту категорию" href="?mod=catalog_delete&id=<?php echo $arsql['id']; ?>&folder=<?php echo $arsql['parent']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="5" class="c-table__cell text-center">Папка пуста</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
                        </tbody>
                    </table>

					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    


					<?php }elseif($mod=="pages_list") { ?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=pages_list&id=<?php echo $id; ?>&ct=1" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i></a>
					<a href="?mod=pages_add&id=<?php echo $id; ?>" class="btn btn-sm btn-success">Добавить страницу/папку</a>
				</div>
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 75% !important;">Контент</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Позиция</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Пользователь</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center">Статус</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$searchsql="";
						$searchsql=" and `parent`='".sql($id)."'"; 
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`>0".$searchsql." ORDER BY `type`, `position`, `name`, `id`;";

						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						
						
						
						
						
							if ($id>0) {
								
								$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($id)."' LIMIT 1;";
								$str2 = mysqlq($query2);
								$arsql2=mysql_fetch_assoc($str2);
								$numrows2=mysql_num_rows($str2);
								if ($numrows2>0) {
							?>
                            <tr class="c-table__row">
								
                                <td class="c-table__cell p-1 text-left pl-3">
									<?php echo "<a class=\"font-weight-bold\" href=\"?mod=pages_list&id=".$arsql2['parent']."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-folder-o\"></i>&nbsp; </span>..</a>"; ?>
                                </td>

                                <td class="c-table__cell p-1 d-none d-md-table-cell text-center">
									<?php echo d(""); ?>
                                </td>
							
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<div class="c-dropdown dropdown">
										<button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton0" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a href="?mod=pages_list" class="c-dropdown__item dropdown-item p-1 pl-2">В корневую папку</a>
                                        </div>
									</div>
                                </td>

                            </tr>
							<?php
								}
								}
						
						
						
						
						
						
						
						
						
						
						
						
						if ($numrows>0) {
						do {
						if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
						
						
						$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($arsql['user'])."' and `del`='0' LIMIT 1;";
						$str3 = mysqlq($query3);
						$arsql3=mysql_fetch_assoc($str3);
						$numrows3=mysql_num_rows($str3);
						if ($numrows3==1) { 
							if (mb_strlen($arsql3['name'])>0) { $uname=$arsql3['name']; } else { $uname=$arsql3['login']; }
							if (mb_strlen($arsql3['phone'])>0) { $uphone=$arsql3['phone']; } else { $uphone=""; }			
						}else{
							$uname="unknown";
							$uphone="";
						}
					
						$upost=implode("<br>", array_diff(array(htmlr($uname), htmlr($uphone)), array('', NULL, false)));
						
						
						?>
										
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">

                                <td class="c-table__cell p-1 align-top text-left pl-3">
									<?php 
									if ($arsql['type']=="1") {
										echo "<a href=\"?mod=pages_list&id=".d($arsql['id'])."\"><b><i class=\"fa fa-folder\"></i> ".d($arsql['name'])."</a>"; 
									}else{
										echo d($arsql['name']); 
									} ?>
									<span class="d-md-none admin_comment_blue"><br><?php echo d($upost); ?></span>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center mwp-70">
									<?php if ($arsql['type']!="1") { ?><input type="text" class="form-control form-control-sm text-center positionpages" data-id="<?php echo d($arsql['id']); ?>" id="pos<?php echo d($arsql['id']); ?>" name="pos[<?php echo d($arsql['position']); ?>]" value="<?php echo d($arsql['position']); ?>"><?php }else{ echo "&nbsp;"; } ?>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center">
									<?php echo $upost; ?>
                                </td>

                                <td class="c-table__cell p-0 pt-2 pb-2 text-center align-top">
									<?php if ($arsql['status']=="1") { 
										echo "<button id=\"statuspages".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatuspages\"><i class=\"fa fa-check\"></i></button>";
									} elseif ($arsql['status']=="3") { 
										echo "<button id=\"statuspages".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatuspages\"><i class=\"fa fa-times\"></i></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>								
                                </td>
								
                                <td class="c-table__cell p-0 pt-2 text-center align-top">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <?php if ($arsql['type']!="1") { ?>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("page", $arsql['id'], "ru"); ?>">Просмотр RU</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("page", $arsql['id'], "en"); ?>">Просмотр EN</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("page", $arsql['id'], "cn"); ?>">Просмотр CN</a>
											<?php } ?>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=pages_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" эту страницу" href="?mod=pages_delete&id=<?php echo $arsql['id']; ?>&folder=<?php echo $arsql['parent']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="5" class="c-table__cell text-center">Страниц не найдено</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
                        </tbody>
                    </table>

					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    

	
					<?php }elseif($mod=="topmenu_list") { ?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=topmenu_list&id=<?php echo $id; ?>&ct=1" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i></a>
					<a href="?mod=topmenu_add&id=<?php echo $id; ?>" class="btn btn-sm btn-success">Добавить ссылку/папку</a>
				</div>
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 75% !important;">Папка/ссылка</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Позиция</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Пользователь</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center">Статус</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$searchsql="";
						$searchsql=" and `parent`='".sql($id)."'"; 
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`>0".$searchsql." ORDER BY `position`, `name`, `id`;";

						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						
						
						
						
						
							if ($id>0) {
								
								$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `id`='".sql($id)."' LIMIT 1;";
								$str2 = mysqlq($query2);
								$arsql2=mysql_fetch_assoc($str2);
								$numrows2=mysql_num_rows($str2);
								if ($numrows2>0) {
							?>
                            <tr class="c-table__row">
								
                                <td class="c-table__cell p-1 text-left pl-3">
									<?php echo "<a class=\"font-weight-bold\" href=\"?mod=topmenu_list&id=".$arsql2['parent']."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-folder-o\"></i>&nbsp; </span>..</a>"; ?>
                                </td>

                                <td class="c-table__cell p-1 d-none d-md-table-cell text-center">
									<?php echo d(""); ?>
                                </td>
							
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<div class="c-dropdown dropdown">
										<button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton0" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a href="?mod=topmenu_list" class="c-dropdown__item dropdown-item p-1 pl-2">В корневую папку</a>
                                        </div>
									</div>
                                </td>

                            </tr>
							<?php
								}
								}
						
						
						
						
						
						
						
						
						
						
						
						
						if ($numrows>0) {
						do {
						if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
						
						
						$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($arsql['user'])."' and `del`='0' LIMIT 1;";
						$str3 = mysqlq($query3);
						$arsql3=mysql_fetch_assoc($str3);
						$numrows3=mysql_num_rows($str3);
						if ($numrows3==1) { 
							if (mb_strlen($arsql3['name'])>0) { $uname=$arsql3['name']; } else { $uname=$arsql3['login']; }
							if (mb_strlen($arsql3['phone'])>0) { $uphone=$arsql3['phone']; } else { $uphone=""; }			
						}else{
							$uname="unknown";
							$uphone="";
						}
					
						$upost=implode("<br>", array_diff(array(htmlr($uname), htmlr($uphone)), array('', NULL, false)));
						
						
						?>
										
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">

                                <td class="c-table__cell p-1 align-top text-left pl-3">
									<?php 
									if ($arsql['type']=="1") {
										echo "<a href=\"?mod=topmenu_list&id=".d($arsql['id'])."\"><b><i class=\"fa fa-folder\"></i> ".d(pre($arsql['name']))."</a>"; 
									}else{
										echo d(pre($arsql['name'])); 
									} ?>
									<span class="d-md-none admin_comment_blue"><br><?php echo d($upost); ?></span>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center mwp-70">
									<input type="text" class="form-control form-control-sm text-center positiontopmenu" data-id="<?php echo d($arsql['id']); ?>" id="pos<?php echo d($arsql['id']); ?>" name="pos[<?php echo d($arsql['position']); ?>]" value="<?php echo d($arsql['position']); ?>">
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center">
									<?php echo $upost; ?>
                                </td>

                                <td class="c-table__cell p-0 pt-2 pb-2 text-center align-top">
									<?php if ($arsql['status']=="1") { 
										echo "<button id=\"statustopmenu".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatustopmenu\"><i class=\"fa fa-check\"></i></button>";
									} elseif ($arsql['status']=="3") { 
										echo "<button id=\"statustopmenu".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatustopmenu\"><i class=\"fa fa-times\"></i></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>								
                                </td>
								
                                <td class="c-table__cell p-0 pt-2 text-center align-top">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=topmenu_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" эту ссылку" href="?mod=topmenu_delete&id=<?php echo $arsql['id']; ?>&folder=<?php echo $arsql['parent']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="5" class="c-table__cell text-center">Ссылок не найдено</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
                        </tbody>
                    </table>

					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    

					<?php }elseif($mod=="slides_list") { ?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=slides_list&ct=1" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i></a>
					<a href="?mod=slides_add" class="btn btn-sm btn-primary">Добавить слайд</a>
				</div>
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-1 text-center mwp-70">Слайд</th>
                              <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 75% !important;">Контент</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Позиция</th>
							  <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Пользователь</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center">Статус</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `id`>0 ORDER BY `position`, `id` DESC;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
						do {
						if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
						
						
						$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($arsql['user'])."' and `del`='0' LIMIT 1;";
						$str3 = mysqlq($query3);
						$arsql3=mysql_fetch_assoc($str3);
						$numrows3=mysql_num_rows($str3);
						if ($numrows3==1) { 
							if (mb_strlen($arsql3['name'])>0) { $uname=$arsql3['name']; } else { $uname=$arsql3['login']; }
							if (mb_strlen($arsql3['phone'])>0) { $uphone=$arsql3['phone']; } else { $uphone=""; }			
						}else{
							$uname="unknown";
							$uphone="";
						}
					
						$upost=implode("<br>", array_diff(array(htmlr($uname), htmlr($uphone)), array('', NULL, false)));
						
						
						?>
										
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">
                                <td class="c-table__cell p-1 text-center align-top">
								<?php if (file_exists("../upload/slides/".$arsql['file']) and mb_strlen($arsql['file'])>4) { ?>
									<a data-fancybox="gallery" href="<?php echo "../upload/slides/".$arsql['file']; ?>"><img src="<?php echo "../upload/slides/".$arsql['file']; ?>" class="mwp-40 mhp-40"></a>
								<?php } else { ?>
									<img src="img/empty.png" class="mwp-40 mhp-40">
								<?php } ?>
								</td>

                                <td class="c-table__cell p-1 align-top text-left">
									<b><?php echo d($arsql['name']); ?></b>
									<span class="d-md-none admin_comment_blue"><br><?php echo d($upost); ?></span>
                                </td>

								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center mwp-70">
									<input type="text" class="form-control form-control-sm text-center positionslides" data-id="<?php echo d($arsql['id']); ?>" id="pos<?php echo d($arsql['id']); ?>" name="pos[<?php echo d($arsql['position']); ?>]" value="<?php echo d($arsql['position']); ?>">
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center">
									<?php echo $upost; ?>
                                </td>

                                <td class="c-table__cell p-0 pt-2 pb-2 text-center align-top">
									<?php if ($arsql['status']=="1") { 
										echo "<button id=\"statusslides".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatusslides\"><i class=\"fa fa-check\"></i></button>";
									} elseif ($arsql['status']=="3") { 
										echo "<button id=\"statusslides".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatusslides\"><i class=\"fa fa-times\"></i></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>								
                                </td>
								
                                <td class="c-table__cell p-0 pt-2 text-center align-top">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=slides_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" этот слайд" href="?mod=slides_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="6" class="c-table__cell text-center">Слайдов не найдено</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
                        </tbody>
                    </table>

					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    


					<?php }elseif($mod=="partners_list") { ?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=partners_list&ct=1" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i></a>
					<a href="?mod=partners_add" class="btn btn-sm btn-primary">Добавить партнёра</a>
				</div>
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-1 text-center mwp-70">Логотип</th>
                              <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 75% !important;">Заголовок</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center mwp-70">Позиция</th>
							  <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Пользователь</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center">Статус</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `id`>0 ORDER BY `position`, `id` DESC;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
						do {
						if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
						
						
						$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($arsql['user'])."' and `del`='0' LIMIT 1;";
						$str3 = mysqlq($query3);
						$arsql3=mysql_fetch_assoc($str3);
						$numrows3=mysql_num_rows($str3);
						if ($numrows3==1) { 
							if (mb_strlen($arsql3['name'])>0) { $uname=$arsql3['name']; } else { $uname=$arsql3['login']; }
							if (mb_strlen($arsql3['phone'])>0) { $uphone=$arsql3['phone']; } else { $uphone=""; }			
						}else{
							$uname="unknown";
							$uphone="";
						}
					
						$upost=implode("<br>", array_diff(array(htmlr($uname), htmlr($uphone)), array('', NULL, false)));
						
						
						?>
										
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">
                                <td class="c-table__cell p-1 text-center align-top">
								<?php if (file_exists("../upload/partners/".$arsql['file']) and mb_strlen($arsql['file'])>4) { ?>
									<a data-fancybox="gallery" href="<?php echo "../upload/partners/".$arsql['file']; ?>"><img src="<?php echo "../upload/partners/".$arsql['file']; ?>" class="mwp-40 mhp-40"></a>
								<?php } else { ?>
									<img src="img/empty.png" class="mwp-40 mhp-40">
								<?php } ?>
								</td>

                                <td class="c-table__cell p-1 align-top text-left">
									<b><?php echo d($arsql['name']); ?></b>
									<span class="d-md-none admin_comment_blue"><br><?php echo d($upost); ?></span>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center mwp-70">
									<input type="text" class="form-control form-control-sm text-center positionpartners" data-id="<?php echo d($arsql['id']); ?>" id="pos<?php echo d($arsql['id']); ?>" name="pos[<?php echo d($arsql['position']); ?>]" value="<?php echo d($arsql['position']); ?>">
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center">
									<?php echo $upost; ?>
                                </td>

                                <td class="c-table__cell p-0 pt-2 pb-2 text-center align-top">
									<?php if ($arsql['status']=="1") { 
										echo "<button id=\"statuspartners".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatuspartners\"><i class=\"fa fa-check\"></i></button>";
									} elseif ($arsql['status']=="3") { 
										echo "<button id=\"statuspartners".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatuspartners\"><i class=\"fa fa-times\"></i></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>								
                                </td>
								
                                <td class="c-table__cell p-0 pt-2 text-center align-top">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=partners_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" этого партнёра" href="?mod=partners_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="6" class="c-table__cell text-center">Партнёров не найдено</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
                        </tbody>
                    </table>

					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    


					
					<?php }elseif($mod=="news_list") { 
					
					$searchsql="";
					$link=array();
					$link[]="?mod=news_list";
					
					$time1=strtotime($_GET['date-from']);
					$time2=strtotime($_GET['date-to']);
					
					if ($time1<=946587600) { $time1=0; } 
					if ($time2<=946587600) { $time2=0; }
					
					if ($time2<$time1 and $time>0) { list($time1, $time2) = array($time2, $time1); }
					
					if ($time1>0) { $time1=strtotime(date("Y-m-d",$time1)." 00:00:00"); }
					if ($time2>0) { $time2=strtotime(date("Y-m-d",$time2)." 23:59:59"); }
					
					
					if ($time1>0 and $time2>0) {
						$searchsql.=" and `stamp`>='".$time1."' and `stamp`<='".$time2."'";
						$link[]="date-from=".date("d.m.Y", $time1);
						$link[]="date-to=".date("d.m.Y", $time2);
					}elseif($time1>0){
						$searchsql.=" and `stamp`>='".$time1."'";
						$link[]="date-from=".date("d.m.Y", $time1);
					}elseif($time2>0){
						$searchsql.=" and `stamp`<='".$time2."'";
						$link[]="date-to=".date("d.m.Y", $time2);
					}

					if (is_numeric($_GET['user']) and $_GET['user']>0) { 
						$searchsql.=" and `user`='".sql($_GET['user'])."'"; 
						$link[]="user=".$_GET['user'];
					}
					if (mb_strlen($_GET['text'])>0) {
						$searchsql.=" and (`name` LIKE '%".sql($_GET['text'])."%' || `preview` LIKE '%".sql($_GET['text'])."%' || `html` LIKE '%".sql($_GET['text'])."%' || `name_en` LIKE '%".sql($_GET['text'])."%' || `preview_en` LIKE '%".sql($_GET['text'])."%' || `html_en` LIKE '%".sql($_GET['text'])."%' || `name_cn` LIKE '%".sql($_GET['text'])."%' || `preview_cn` LIKE '%".sql($_GET['text'])."%' || `html_cn` LIKE '%".sql($_GET['text'])."%')";
						$link[]="text=".$_GET['text'];
					}
					
					
					
					
					$quoten=20;

						$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`>0".$searchsql." ORDER BY `stamp` DESC, `id` DESC";
						// echo $query;
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$total=mysql_num_rows($str);

						if ($_GET['pg'] and is_numeric($_GET['pg']) and $_GET['pg']>0 and $_GET['pg']==round($_GET['pg'])) { $pg=$_GET['pg']; } else { $pg=1; }
						
						if (($total%$quoten)==0) { $correct=0; } else {$correct=1;}
						$pages=mod($total, $quoten)+$correct;

						if ($pg>$pages) { $pg=$pages; }

						if (!$pg or (($pg%1)>0)) { $pg=1; }
						$start=($pg-1)*$quoten;
					
					
					
					
					?>

            <div class="container">
                <div class="row ml-0 mr-0 mb-3" style="background-color: #F5F8FA; border: 1px solid #dee2e6;">
					<form method="get" class="w-100 row m-0 p-0"><input type="hidden" name="mod" value="news_list"><input type="hidden" name="pg" value="1">
						<div class="col-12 col-sm-2 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="date-from">Дата от</label>
                                <div class="col-12 pl-2 pr-2">
                                    <input type="text" id="date-from" name="date-from" class="form-control form-control-sm datepicker-here"<?php if ($time1>0) { echo " data-value=\"".d($time1*1000)."\""; } ?> value="<?php if ($time1>0) { echo date("d.m.Y", $time1); } ?>">
                                </div>
                            </div>
						</div>
						<div class="col-12 col-sm-2 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="date-to">Дата до</label>
                                <div class="col-12 pl-2 pr-2">
                                    <input type="text" id="date-to" name="date-to" class="form-control form-control-sm datepicker-here"<?php if ($time2>0) { echo " data-value=\"".d($time2*1000)."\""; } ?> value="<?php if ($time2>0) { echo date("d.m.Y", $time2); } ?>">
                                </div>
                            </div>
						</div>
						<div class="col-12 col-sm-6 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="autom">Поиск<span class="d-none d-lg-inline-block">&nbsp;по тексту</span></label>
                                <div class="col-12 pl-2 pr-2">
                                    <input type="text" id="text" name="text" class="form-control form-control-sm" value="<?php if (mb_strlen($_GET['text'])>0) { $dataname=addslashes($_GET['text']); echo $dataname; } else { $dataname=""; } ?>">
								</div>
                            </div>
						</div>
						<div class="col-12 col-sm-2 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="user">Польз<span class="d-none d-lg-inline-block">ователь</span></label>
                                <div class="col-12 pl-2 pr-2">
                                    <select id="user" name="user" class="form-control form-control-sm">
										<option value=""></option>
										<?php
										$datauser="";
											$array=array();
											
											$query2="SELECT count(id) as lognum, user FROM `".sql($GLOBALS['config']['bd_prefix'])."news` GROUP BY `user` ORDER BY lognum";
											$str2 = mysqlq($query2);
											$arsql2=mysql_fetch_assoc($str2);
											$numrows2=mysql_num_rows($str2);
											if ($numrows2>0) {
											do {
												$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($arsql2['user'])."' and `del`='0' LIMIT 1;";
												$str3 = mysqlq($query3);
												$arsql3=mysql_fetch_assoc($str3);
												$numrows3=mysql_num_rows($str3);
												if ($numrows3>0) {
													if (mb_strlen($arsql3['name'])>0) { $uname=$arsql3['name']; } else { $uname=$arsql3['login']; }
													$array[$arsql3['id']]=$uname; 
												}
											}while($arsql2=mysql_fetch_assoc($str2)); 
											}
											foreach ($array as $key => $val){
										?>
										<option value="<?php echo d($key); ?>"<?php if ($_GET['user']==$key) { echo " SELECTED"; $datauser=$key; } ?>><?php echo d($val); ?></option>
											<?php }  ?>
									</select>	
								</div>
                            </div>
						</div>
						<div class="col-12 p-0">
                            <div class="form-group row ml-0 mr-0 form-actions text-right mt-2 mb-2">
                                <div class="col-12 pl-2 pr-2">
									<span id="logstotal" class="btn btn-sm btn-default pull-left pl-0"><?php if ($total>0) { ?><?php echo $total; ?> зап., <?php echo $pg; ?>/<?php echo $pages; ?> стр.<?php } else { ?>Записей не найдено<?php } ?></span>
                                    <input type="submit" class="btn btn-sm btn-success" value="Применить">
                                </div>
                            </div>
						</div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-1 text-center mwp-40">Фото</th>
                              <th class="c-table__cell c-table__cell--head p-0 text-center mwp-40">Дата<span class="d-none d-lg-inline-block">/время</span></th>
                              <th class="c-table__cell c-table__cell--head p-2 w-100" style="max-width: 45% !important;">Контент</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Пользователь</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-md-table-cell text-center">Статус</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`>0".$searchsql." ORDER BY `stamp` DESC, `id` DESC LIMIT ".$start.", ".$quoten.";";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
						do {
						if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
						
						
						$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `id`='".sql($arsql['user'])."' and `del`='0' LIMIT 1;";
						$str3 = mysqlq($query3);
						$arsql3=mysql_fetch_assoc($str3);
						$numrows3=mysql_num_rows($str3);
						if ($numrows3==1) { 
							if (mb_strlen($arsql3['name'])>0) { $uname=$arsql3['name']; } else { $uname=$arsql3['login']; }
							if (mb_strlen($arsql3['phone'])>0) { $uphone=$arsql3['phone']; } else { $uphone=""; }			
						}else{
							$uname="unknown";
							$uphone="";
						}
					
						$upost=implode("<br>", array_diff(array(htmlr($uname), htmlr($uphone)), array('', NULL, false)));
						
						
						?>
										
                            <tr class="c-table__row" data-logs-id="<?php echo $arsql['id']; ?>">
                                <td class="c-table__cell p-1 text-center align-top">
								<?php if (file_exists("../upload/news/".$arsql['file']) and mb_strlen($arsql['file'])>4) { ?>
									<a data-fancybox="gallery" href="<?php echo "../upload/news/".$arsql['file']; ?>"><img src="<?php echo "../upload/news/".$arsql['file']; ?>" class="mwp-40 mhp-40"></a>
								<?php } else { ?>
									<img src="img/empty.png" class="mwp-40 mhp-40">
								<?php } ?>
								</td>
							
                                <td class="c-table__cell p-1 text-center align-top">
									<?php echo date("d.m.Y", $arsql['stamp'])."<br>".date("H:i:s", $arsql['stamp']); ?>
								</td>
								
                                <td class="c-table__cell p-1 align-top text-left">
									<b><?php echo d($arsql['name']); ?></b>
									<?php if (mb_strlen($arsql['preview'])>0) { ?><br><?php echo d($arsql['preview']); ?><?php } ?>
									<span class="d-md-none admin_comment_blue"><br><?php echo d($upost); ?></span>
                                </td>
								
								<td class="c-table__cell d-none d-md-table-cell p-1 align-top text-center">
									<?php echo $upost; ?>
                                </td>

                                <td class="c-table__cell p-0 pt-2 pb-2 text-center align-top">
									<?php if ($arsql['status']=="1") { 
										echo "<button id=\"statusnews".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-success changestatusnews\"><i class=\"fa fa-check\"></i></button>";
									} elseif ($arsql['status']=="3") { 
										echo "<button id=\"statusnews".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"btn btn-sm btn-danger changestatusnews\"><i class=\"fa fa-times\"></i></button>"; 
									} else {
										echo "&nbsp;";
									}
									?>								
                                </td>
								
                                <td class="c-table__cell p-0 pt-2 text-center align-top">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("news", $arsql['id'], "ru"); ?>">Просмотр RU</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("news", $arsql['id'], "en"); ?>">Просмотр EN</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="<?php echo l("news", $arsql['id'], "cn"); ?>">Просмотр CN</a>
											<a class="c-dropdown__item dropdown-item p-1 pl-2" href="?mod=news_edit&id=<?php echo $arsql['id']; ?>">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
                                            <a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" эту публикацию" href="?mod=news_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="6" class="c-table__cell text-center">Публикаций не найдено</td>
							</tr>
						<?php } ?>
						<?php
						$link=implode("&", $link);
						?>
                        </tbody>
                    </table>
					<table class="c-table">
                        <tbody>
                            <tr>
                                <td class="c-table__cell text-center">
									<?php 
																	
									echo pages($link, $pg, $pages); ?>
								</td>
							</tr>
                        </tbody>
                    </table>
					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    


					
					<?php }elseif ($mod=="text_edit") { 

					?>					
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form id="form" method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="text_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
                                <div class="col-sm-12">
                                    <select id="input-type" name="input-type" class="form-control form-control-sm">
										<option value="0"<?php if ($page['type']=="0") { echo " SELECTED"; } ?>>Переменная</option>
										<option value="1"<?php if ($page['type']=="1") { echo " SELECTED"; } ?>>Папка</option>
									</select>
								</div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="parent">Папка</label>
                                <div class="col-sm-12">
                                    <select id="parent<?php echo $page['parent']; ?>" name="parent" class="form-control form-control-sm">
										<option value="0"<?php if ($page['parent']=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
										<?php echo text_folders($t=0,"",$page['parent']); ?>
									</select>
								</div>
                            </div>
							<div class="form-group row ml-0 mr-0" style="display: none;">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Ключ(лат.)</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php if (mb_strlen($page['name'])>0) { echo d($page['name']); } ?>">
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Название</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm" value="<?php if (mb_strlen($page['text'])>0) { echo d($page['text']); } ?>">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0" style="display: none;">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-value">Значение</label>
                                <div class="col-sm-12">
                                    <textarea id="input-value" name="input-value" class="form-control-sm w-100 h-100 border" rows="10"><?php echo d($page['value']); ?></textarea>
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0" style="display: none;">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="date-at">Срок действия</label>
                                <div class="col-sm-12">
									<?php if ($page['dateto']>0) { ?>
                                    <input type="text" id="date-at" name="date-at" class="form-control form-control-sm datepicker-here" data-value="<?php echo d($page['dateto']*1000); ?>" value="<?php echo date("d.m.Y H:i", $page['dateto']); ?>">
									<?php }else{ ?>
									<input type="text" id="date-at" name="date-at" class="form-control form-control-sm datepicker-here" value="">
									<?php } ?>
								
								</div>
                            </div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Изменить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					


					
					<?php }elseif($mod=="faq") { 


					
					
					?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-left">
					
					<style>
						// Just for kicks and layout
						body {
						  margin-top: 30px;
						  background-color: #eee;
						}


						// FAQ
						.faq-nav {
							flex-direction: column;
							margin: 0 0 32px;
							border-radius: 2px;    
							border: 1px solid #ddd;
							box-shadow: 0 1px 5px rgba(85, 85, 85, 0.15);
							
							.nav-link {
								position: relative;
								display: block;
								margin: 0;
								padding: 13px 16px;
								background-color: #fff;
								border: 0;
								border-bottom: 1px solid #ddd;
								border-radius: 0;
								color: #616161;
								transition: background-color .2s ease;
								
								&:hover {
									background-color: #f6f6f6;
								}
								
								&.active {
									background-color: #f6f6f6;
									font-weight: 700;
									color: rgba(0,0,0,.87);        
								}
								
								&:last-of-type {
									border-bottom-left-radius: 2px;
									border-bottom-right-radius: 2px;
									border-bottom: 0;
								}
								
								i.mdi {
									margin-right: 5px;
									font-size: 18px;
									position: relative;
								}
							}
						}

						// TAB CONTENT
						.tab-content {
							box-shadow: 0 1px 5px rgba(85, 85, 85, 0.15);
							
							.card {
								border-radius: 0;
							}
							
							.card-header {
								padding: 15px 16px;
								border-radius: 0;
								background-color: #f6f6f6;
								
								h5 {
									margin: 0;
									
									button {
										display: block;
										width: 100%;
										padding: 0;
										border: 0;
										font-weight: 700;
										color: rgba(0,0,0,.87);
										text-align: left;
										white-space: normal;
										
										&:hover,
										&:focus,
										&:active,
										&:hover:active {
											text-decoration: none;
										}
									}
								}
							}
							
							.card-body {
								p {
									color: #616161;
									
									&:last-of-type {
										margin: 0;
									}
								}
							}
						}


						// BORDER FIX
						.accordion {
							> .card {
								&:not(:first-child) {
									border-top: 0;
								}   
							}
						}

						.collapse.show {
							.card-body {
								border-bottom: 1px solid rgba(0,0,0,.125);
							}
						}
						.collapse {
						  visibility: hidden;
						}
						.collapse.show {
						  visibility: visible;
						  display: block;
						}
						.collapsing {
						  position: relative;
						  height: 0;
						  overflow: hidden;
						  -webkit-transition-property: height, visibility;
						  transition-property: height, visibility;
						  -webkit-transition-duration: 0.35s;
						  transition-duration: 0.35s;
						  -webkit-transition-timing-function: ease;
						  transition-timing-function: ease;
						}
						.collapsing.width {
						  -webkit-transition-property: width, visibility;
						  transition-property: width, visibility;
						  width: 0;
						  height: auto;
						}
					</style>


					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-12">
								<div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
									<a href="#tab1" class="nav-link w-100 active" data-toggle="pill" role="tab" aria-controls="tab1" aria-selected="true">
										<i class="mdi mdi-help-circle"></i> Frequently Asked Questions
									</a>
									<a href="#tab2" class="nav-link w-100" data-toggle="pill" role="tab" aria-controls="tab2" aria-selected="false">
										<i class="mdi mdi-account"></i> Profile
									</a>
									<a href="#tab3" class="nav-link w-100" data-toggle="pill" role="tab" aria-controls="tab3" aria-selected="false">
										<i class="mdi mdi-account-settings"></i> Account
									</a>
									<a href="#tab4" class="nav-link w-100" data-toggle="pill" role="tab" aria-controls="tab4" aria-selected="false">
										<i class="mdi mdi-heart"></i> Favorites
									</a>
									<a href="#tab5" class="nav-link w-100" data-toggle="pill" role="tab" aria-controls="tab5" aria-selected="false">
										<i class="mdi mdi-coin"></i> Transactions
									</a>
									<a href="#tab6" class="nav-link w-100" data-toggle="pill" role="tab" aria-controls="tab6" aria-selected="false">
										<i class="mdi mdi-help"></i> General help
									</a>
								</div>
							</div>
							<div class="col-lg-9 col-12">
								<div class="tab-content" id="faq-tab-content">
									<div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
										<div class="accordion" id="accordion-tab-1">
											<div class="card">
												<div class="card-header" id="accordion-tab-1-heading-1">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-1" aria-expanded="false" aria-controls="accordion-tab-1-content-1">Just once I'd like to eat dinner with a celebrity?</button>
													</h5>
												</div>
												<div class="collapse show" id="accordion-tab-1-content-1" aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
													<div class="card-body">
														<p>Yes, if you make it look like an electrical fire. When you do things right, people won't be sure you've done anything at all. I was having the most wonderful dream. Except you were there, and you were there, and you were there! No argument here. Goodbye, cruel world. Goodbye, cruel lamp. Goodbye, cruel velvet drapes, lined with what would appear to be some sort of cruel muslin and the cute little pom-pom curtain pull cords. Cruel though they may be.</p>
														<p><strong>Example: </strong>Shut up and get to the point!</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-1-heading-2">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-2" aria-expanded="false" aria-controls="accordion-tab-1-content-2">Bender, I didn't know you liked cooking?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-1-content-2" aria-labelledby="accordion-tab-1-heading-2" data-parent="#accordion-tab-1">
													<div class="card-body">
														<p>That's so cute. Can we have Bender Burgers again? Is the Space Pope reptilian!? I wish! It's a nickel. Bender! Ship! Stop bickering or I'm going to come back there and change your opinions manually!</p>
														<p><strong>Example: </strong>Okay, I like a challenge. Is that a cooking show? No argument here.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-1-heading-3">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-3" aria-expanded="false" aria-controls="accordion-tab-1-content-3">My fellow Earthicans?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-1-content-3" aria-labelledby="accordion-tab-1-heading-3" data-parent="#accordion-tab-1">
													<div class="card-body">
														<p>As I have explained in my book 'Earth in the Balance', and the much more popular 'Harry Potter and the Balance of Earth', we need to defend our planet against pollution. Also dark wizards. Fry, you can't just sit here in the dark listening to classical music.</p>
														<p><strong>Example: </strong>Actually, that's still true. Well, let's just dump it in the sewer and say we delivered it.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-1-heading-4">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-4" aria-expanded="false" aria-controls="accordion-tab-1-content-4">Who am I making this out to?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-1-content-4" aria-labelledby="accordion-tab-1-heading-4" data-parent="#accordion-tab-1">
													<div class="card-body">
														<p>Morbo can't understand his teleprompter because he forgot how you say that letter that's shaped like a man wearing a hat. Also Zoidberg. Can we have Bender Burgers again? Goodbye, cruel world. Goodbye, cruel lamp. Goodbye, cruel velvet drapes, lined with what would appear to be some sort of cruel muslin and the cute little pom-pom curtain pull cords.</p>
														<p><strong>Example: </strong>Cruel though they may be...</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
										<div class="accordion" id="accordion-tab-2">
											<div class="card">
												<div class="card-header" id="accordion-tab-2-heading-1">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-1" aria-expanded="false" aria-controls="accordion-tab-2-content-1">Does anybody else feel jealous and aroused and worried?</button>
													</h5>
												</div>
												<div class="collapse show" id="accordion-tab-2-content-1" aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
													<div class="card-body">
														<p>Kif, I have mated with a woman. Inform the men. This is the worst part. The calm before the battle. Bender, being God isn't easy. If you do too much, people get dependent on you, and if you do nothing, they lose hope. You have to use a light touch. Like a safecracker, or a pickpocket.</p>
														<p><strong>Example: </strong>There's no part of that sentence I didn't like! You, a bobsleder!? That I'd like to see!</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-2-heading-2">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-2" aria-expanded="false" aria-controls="accordion-tab-2-content-2">This opera's as lousy as it is brilliant?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-2-content-2" aria-labelledby="accordion-tab-2-heading-2" data-parent="#accordion-tab-2">
													<div class="card-body">
														<p>Your lyrics lack subtlety. You can't just have your characters announce how they feel. That makes me feel angry! It's okay, Bender. I like cooking too. Interesting. No, wait, the other thing: tedious.</p>
														<p><strong>Example: </strong>Of all the friends I've had… you're the first. But I know you in the future. I cleaned your poop. Then we'll go with that data file!</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-2-heading-3">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-3" aria-expanded="false" aria-controls="accordion-tab-2-content-3">Who are you, my warranty?!</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-2-content-3" aria-labelledby="accordion-tab-2-heading-3" data-parent="#accordion-tab-2">
													<div class="card-body">
														<p>Oh, I think we should just stay friends. I'll tell them you went down prying the wedding ring off his cold, dead finger. Aww, it's true. I've been hiding it for so long. Say it in Russian! Then throw her in the laundry room, which will hereafter be referred to as "the brig".</p>
														<p><strong>Example: </strong> We're rescuing ya. Robot 1-X, save my friends! And Zoidberg! <em>Then we'll go with that data file!</em> Okay, I like a challenge.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-2-heading-4">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-4" aria-expanded="false" aria-controls="accordion-tab-2-content-4">I haven't felt much of anything since my guinea pig died?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-2-content-4" aria-labelledby="accordion-tab-2-heading-4" data-parent="#accordion-tab-2">
													<div class="card-body">
														<p>And I'm his friend Jesus. Oh right. I forgot about the battle. OK, if everyone's finished being stupid. We'll need to have a look inside you with this camera. I'm just glad my fat, ugly mama isn't alive to see this day.</p>
														<p><strong>Example: </strong> Isn't it true that you have been paid for your testimony? Quite possible.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
										<div class="accordion" id="accordion-tab-3">
											<div class="card">
												<div class="card-header" id="accordion-tab-3-heading-1">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-1" aria-expanded="false" aria-controls="accordion-tab-3-content-1">Michelle, I don't regret this, but I both rue and lament it?</button>
													</h5>
												</div>
												<div class="collapse show" id="accordion-tab-3-content-1" aria-labelledby="accordion-tab-3-heading-1" data-parent="#accordion-tab-3">
													<div class="card-body">
														<p>Look, last night was a mistake. We'll need to have a look inside you with this camera. Good news, everyone! There's a report on TV with some very bad news! You know, I was God once. You lived before you met me?!</p>
														<p><strong>Example: </strong>I'm Santa Claus! Pansy. That's a popular name today. Little "e", big "B"?</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-3-heading-2">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-2" aria-expanded="false" aria-controls="accordion-tab-3-content-2">Why am I sticky and naked?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-3-content-2" aria-labelledby="accordion-tab-3-heading-2" data-parent="#accordion-tab-3">
													<div class="card-body">
														<p>Did I miss something fun? Humans dating robots is sick. You people wonder why I'm still single? It's 'cause all the fine robot sisters are dating humans! Kids don't turn rotten just from watching TV.</p>
														<p><strong>Example: </strong>I usually try to keep my sadness pent up inside where it can fester quietly as a mental illness.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-3-heading-3">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-3" aria-expanded="false" aria-controls="accordion-tab-3-content-3">Is that a cooking show?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-3-content-3" aria-labelledby="accordion-tab-3-heading-3" data-parent="#accordion-tab-3">
													<div class="card-body">
														<p>OK, this has gotta stop. I'm going to remind Fry of his humanity the way only a woman can. You seem malnourished. Are you suffering from intestinal parasites? Check it out, y'all. Everyone who was invited is here. I am Singing Wind, Chief of the Martians.</p>
														<p><strong>Example: </strong>Man, I'm sore all over. I feel like I just went ten rounds with mighty Thor.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-3-heading-4">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-4" aria-expanded="false" aria-controls="accordion-tab-3-content-4">You are the last hope of the universe?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-3-content-4" aria-labelledby="accordion-tab-3-heading-4" data-parent="#accordion-tab-3">
													<div class="card-body">
														<p>I don't want to be rescued. I videotape every customer that comes in here, so that I may blackmail them later. Ah, computer dating. It's like pimping, but you rarely have to use the phrase "upside your head."</p>
														<p><strong>Example: </strong>Tell them I hate them.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
										<div class="accordion" id="accordion-tab-4">
											<div class="card">
												<div class="card-header" id="accordion-tab-4-heading-1">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-1" aria-expanded="false" aria-controls="accordion-tab-4-content-1">You, minion. Lift my arm?</button>
													</h5>
												</div>
												<div class="collapse show" id="accordion-tab-4-content-1" aria-labelledby="accordion-tab-4-heading-1" data-parent="#accordion-tab-4">
													<div class="card-body">
														<p>AFTER HIM! A true inspiration for the children. What are you hacking off? Is it my torso?! 'It is!' My precious torso! I saw you with those two "ladies of the evening" at Elzars. Explain that. She also liked to shut up! Why not indeed!</p>
														<p><strong>Example: </strong>I feel like I was mauled by Jesus. Hello, little man. I will destroy you!</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-4-heading-2">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-2" aria-expanded="false" aria-controls="accordion-tab-4-content-2">No, I'm Santa Claus?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-4-content-2" aria-labelledby="accordion-tab-4-heading-2" data-parent="#accordion-tab-4">
													<div class="card-body">
														<p>I meant 'physically'. Look, perhaps you could let me work for a little food? I could clean the floors or paint a fence, or service you sexually? When the lights go out, it's nobody's business what goes on between two consenting adults.</p>
														<p><strong>Example: </strong>Nay, I respect and admire Harold Zoid too much to beat him to death with his own Oscar.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-4-heading-3">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-3" aria-expanded="false" aria-controls="accordion-tab-4-content-3">Belligerent and numerous?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-4-content-3" aria-labelledby="accordion-tab-4-heading-3" data-parent="#accordion-tab-4">
													<div class="card-body">
														<p>Hey, what kinda party is this? There's no booze and only one hooker. I'm just glad my fat, ugly mama isn't alive to see this day. Wow! A superpowers drug you can just rub onto your skin? You'd think it would be something you'd have to freebase. Well, let's just dump it in the sewer and say we delivered it. You guys realize you live in a sewer, right? </p>
														<p><strong>Example: </strong>Oh Leela! You're the only person I could turn to; you're the only person who ever loved me.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-4-heading-4">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-4" aria-expanded="false" aria-controls="accordion-tab-4-content-4">Take me to your leader?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-4-content-4" aria-labelledby="accordion-tab-4-heading-4" data-parent="#accordion-tab-4">
													<div class="card-body">
														<p>PUNY HUMAN NUMBER ONE, PUNY HUMAN NUMBER TWO, and Morbo's good friend, Richard Nixon. Interesting. No, wait, the other thing: tedious. All I want is to be a monkey of moderate intelligence who wears a suit… that's why I'm transferring to business school! Morbo can't understand his teleprompter because he forgot how you say that letter that's shaped like a man wearing a hat.</p>
														<p><strong>Example: </strong>If rubbin' frozen dirt in your crotch is wrong, hey I don't wanna be right.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab5" role="tabpanel" aria-labelledby="tab5">
										<div class="accordion" id="accordion-tab-5">
											<div class="card">
												<div class="card-header" id="accordion-tab-5-heading-1">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-1" aria-expanded="false" aria-controls="accordion-tab-5-content-1">Say what?</button>
													</h5>
												</div>
												<div class="collapse show" id="accordion-tab-5-content-1" aria-labelledby="accordion-tab-5-heading-1" data-parent="#accordion-tab-5">
													<div class="card-body">
														<p>That could be 'my' beautiful soul sitting naked on a couch. If I could just learn to play this stupid thing. Oh, I don't have time for this. I have to go and buy a single piece of fruit with a coupon and then return it, making people wait behind me while I complain. I'm just glad my fat, ugly mama isn't alive to see this day. For one beautiful night I knew what it was like to be a grandmother. Subjugated, yet honored. But existing is basically all I do! I never loved you.</p>
														<p><strong>Example: </strong>A sexy mistake. And I'd do it again!</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-5-heading-2">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-2" aria-expanded="false" aria-controls="accordion-tab-5-content-2">Who's brave enough to fly into something we all keep calling a death sphere?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-5-content-2" aria-labelledby="accordion-tab-5-heading-2" data-parent="#accordion-tab-5">
													<div class="card-body">
														<p>Maybe I love you so much I love you no matter who you are pretending to be. Ah, the 'Breakfast Club' soundtrack! I can't wait til I'm old enough to feel ways about stuff! Now Fry, it's been a few years since medical school, so remind me.</p>
														<p><strong>Example: </strong>Disemboweling in your species: fatal or non-fatal?</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-5-heading-3">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-3" aria-expanded="false" aria-controls="accordion-tab-5-content-3">You mean while I'm sleeping in it?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-5-content-3" aria-labelledby="accordion-tab-5-heading-3" data-parent="#accordion-tab-5">
													<div class="card-body">
														<p>We can't compete with Mom! Her company is big and evil! Ours is small and neutral! Look, everyone wants to be like Germany, but do we really have the pure strength of 'will'? I just told you! You've killed me!</p>
														<p><strong>Example: </strong>But, like most politicians, he promised more than he could deliver.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-5-heading-4">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-5-content-4" aria-expanded="false" aria-controls="accordion-tab-5-content-4">And until then, I can never die?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-5-content-4" aria-labelledby="accordion-tab-5-heading-4" data-parent="#accordion-tab-5">
													<div class="card-body">
														<p>I don't know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Well, let's just dump it in the sewer and say we delivered it.</p>
														<p><strong>Example: </strong>Have you ever tried just turning off the TV, sitting down with your children, and hitting them? Hey, tell me something. You've got all this money. How come you always dress like you're doing your laundry?</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab6" role="tabpanel" aria-labelledby="tab6">
										<div class="accordion" id="accordion-tab-6">
											<div class="card">
												<div class="card-header" id="accordion-tab-6-heading-1">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-1" aria-expanded="false" aria-controls="accordion-tab-6-content-1">Doomsday device?</button>
													</h5>
												</div>
												<div class="collapse show" id="accordion-tab-6-content-1" aria-labelledby="accordion-tab-6-heading-1" data-parent="#accordion-tab-6">
													<div class="card-body">
														<p>Ah, now the ball's in Farnsworth's court! We'll need to have a look inside you with this camera. Stop it, stop it. It's fine. I will 'destroy' you! Bender! Ship! Stop bickering or I'm going to come back there and change your opinions manually!</p>
														<p><strong>Example: </strong>So I really am important? How I feel when I'm drunk is correct?</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-6-heading-2">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-2" aria-expanded="false" aria-controls="accordion-tab-6-content-2">And so we say goodbye to our beloved pet, Nibbler?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-6-content-2" aria-labelledby="accordion-tab-6-heading-2" data-parent="#accordion-tab-6">
													<div class="card-body">
														<p>Nibbler, who's gone to a place where I, too, hope one day to go. The toilet. But existing is basically all I do! I suppose I could part with 'one' and still be feared. I just told you! You've killed me!</p>
														<p><strong>Example: </strong>What's with you kids? Every other day it's food, food, food.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-6-heading-3">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-3" aria-expanded="false" aria-controls="accordion-tab-6-content-3">Tell her you just want to talk?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-6-content-3" aria-labelledby="accordion-tab-6-heading-3" data-parent="#accordion-tab-6">
													<div class="card-body">
														<p>It has nothing to do with mating. Soon enough. There, now he's trapped in a book I wrote: a crummy world of plot holes and spelling errors! Daylight and everything. Hey! I'm a porno-dealing monster, what do I care what you think?</p>
														<p><strong>Example: </strong>Is that a cooking show? It doesn't look so shiny to me. And why did 'I' have to take a cab?</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="accordion-tab-6-heading-4">
													<h5>
														<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#accordion-tab-6-content-4" aria-expanded="false" aria-controls="accordion-tab-6-content-4">Good man. Nixon's pro-war and pro-family?</button>
													</h5>
												</div>
												<div class="collapse" id="accordion-tab-6-content-4" aria-labelledby="accordion-tab-6-heading-4" data-parent="#accordion-tab-6">
													<div class="card-body">
														<p>I don't 'need' to drink. I can quit anytime I want! THE BIG BRAIN AM WINNING AGAIN! I AM THE GREETEST! NOW I AM LEAVING EARTH, FOR NO RAISEN! There's one way and only one way to determine if an animal is intelligent. Dissect its brain!</p>
														<p><strong>Example: </strong>Guess again. Yeah, I do that with my stupidness. And when we woke up, we had these bodies.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>







				</div>
            </div><!-- // .container -->    




					<?php }elseif ($mod=="slides_add") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="slides_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1" SELECTED>Активен</option>
													<option value="3">Скрыт</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Слайд RU</label>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link">Ссылка RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-link" name="input-link" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file-en">Слайд EN</label>
											<div class="col-sm-12">
												<input type="file" id="input-file-en" name="input-file-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-en">Ссылка EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-en" name="input-link-en" class="form-control form-control-sm">
											</div>
										</div>	
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file-cn">Слайд CN</label>
											<div class="col-sm-12">
												<input type="file" id="input-file-cn" name="input-file-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-cn">Ссылка CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-cn" name="input-link-cn" class="form-control form-control-sm">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    

					<?php }elseif ($mod=="slides_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="slides_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1"<?php if ($page['status']=="1") { echo " SELECTED"; } ?>>Активен</option>
													<option value="3"<?php if ($page['status']=="3") { echo " SELECTED"; } ?>>Скрыт</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Слайд RU</label>
											<?php if (mb_strlen($page['file'])>4 and file_exists("../upload/slides/".$page['file'])) { ?>
											<div class="col-sm-12">
												<a data-fancybox="gallery" href="/upload/slides/<?php echo d($page['file']); ?>">
													<img src="/upload/slides/<?php echo d($page['file']); ?>" style="max-width: 80px; max-height: 80px;">
												</a>
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">
											<?php } ?>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Файл JPG, не более 1Мб</label>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link">Ссылка RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-link" name="input-link" class="form-control form-control-sm" value="<?php echo d($page['link']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file-en">Слайд EN</label>
											<?php if (mb_strlen($page['file_en'])>4 and file_exists("../upload/slides/".$page['file_en'])) { ?>
											<div class="col-sm-12">
												<a data-fancybox="gallery" href="/upload/slides/<?php echo d($page['file_en']); ?>">
													<img src="/upload/slides/<?php echo d($page['file_en']); ?>" style="max-width: 80px; max-height: 80px;">
												</a>
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file-en"><input type="checkbox" name="photo-del-en" class="" value="1"> — удалить слайд</label>
											<?php } ?>
											<div class="col-sm-12">
												<input type="file" id="input-file-en" name="input-file-en" class="form-control form-control-sm">
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Файл JPG, не более 1Мб</label>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm" value="<?php echo d($page['name_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_en']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-en">Ссылка EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-en" name="input-link-en" class="form-control form-control-sm" value="<?php echo d($page['link_en']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file-cn">Слайд CN</label>
											<?php if (mb_strlen($page['file_cn'])>4 and file_exists("../upload/slides/".$page['file_cn'])) { ?>
											<div class="col-sm-12">
												<a data-fancybox="gallery" href="/upload/slides/<?php echo d($page['file_cn']); ?>">
													<img src="/upload/slides/<?php echo d($page['file_cn']); ?>" style="max-width: 80px; max-height: 80px;">
												</a>
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file-cn"><input type="checkbox" name="photo-del-cn" class="" value="1"> — удалить слайд</label>
											<?php } ?>
											<div class="col-sm-12">
												<input type="file" id="input-file-cn" name="input-file-cn" class="form-control form-control-sm">
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Файл JPG, не более 1Мб</label>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm" value="<?php echo d($page['name_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_cn']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-cn">Ссылка CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-cn" name="input-link-cn" class="form-control form-control-sm" value="<?php echo d($page['link_cn']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=slides_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    

					<?php }elseif ($mod=="partners_add") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="partners_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Логотип</label>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-position">Позиция</label>
											<div class="col-sm-12">
												<select id="input-position" name="input-position" class="form-control form-control-sm">
													<option value="1">В начало</option>
													<option value="2" SELECTED>В конец</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1" SELECTED>Активен</option>
													<option value="3">Скрыт</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link">Ссылка RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-link" name="input-link" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-en">Ссылка EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-en" name="input-link-en" class="form-control form-control-sm">
											</div>
										</div>	
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-cn">Ссылка CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-cn" name="input-link-cn" class="form-control form-control-sm">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    

					<?php }elseif ($mod=="partners_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="partners_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Логотип</label>
											<?php if (mb_strlen($page['file'])>4 and file_exists("../upload/partners/".$page['file'])) { ?>
											<div class="col-sm-12">
												<a data-fancybox="gallery" href="/upload/partners/<?php echo d($page['file']); ?>">
													<img src="/upload/partners/<?php echo d($page['file']); ?>" style="max-width: 80px; max-height: 80px;">
												</a>
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">
											<?php } ?>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Файл JPG, не более 1Мб</label>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1"<?php if ($page['status']=="1") { echo " SELECTED"; } ?>>Активен</option>
													<option value="3"<?php if ($page['status']=="3") { echo " SELECTED"; } ?>>Скрыт</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link">Ссылка RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-link" name="input-link" class="form-control form-control-sm" value="<?php echo d($page['link']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm" value="<?php echo d($page['name_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-en">Ссылка EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-en" name="input-link-en" class="form-control form-control-sm" value="<?php echo d($page['link_en']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm" value="<?php echo d($page['name_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-cn">Ссылка CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-cn" name="input-link-cn" class="form-control form-control-sm" value="<?php echo d($page['link_cn']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=partners_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    




					<?php }elseif ($mod=="news_add") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="news_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-stamp">Дата создания</label>
											<div class="col-sm-12">
												<input type="text" id="input-stamp" name="input-stamp" class="form-control form-control-sm" value="<?php echo date("d.m.Y H:i:s", time()); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Фото</label>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1" SELECTED>Активна</option>
													<option value="3">Скрыта</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-preview">Превью RU</label>
											<div class="col-sm-12">
												<textarea id="input-preview" name="input-preview" class="form-control-sm w-100 h-100 border" rows="5"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug</label>
											<div class="col-sm-12 input-group">
												<button data-table="news" data-edit="0" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-preview-en">Превью EN</label>
											<div class="col-sm-12">
												<textarea id="input-preview-en" name="input-preview-en" class="form-control-sm w-100 h-100 border" rows="5"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="news" data-edit="0" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-preview-cn">Превью CN</label>
											<div class="col-sm-12">
												<textarea id="input-preview-cn" name="input-preview-cn" class="form-control-sm w-100 h-100 border" rows="5"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					

					<?php }elseif ($mod=="news_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="news_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-stamp">Дата создания</label>
											<div class="col-sm-12">
												<input type="text" id="input-stamp" name="input-stamp" class="form-control form-control-sm" value="<?php echo date("d.m.Y H:i:s", $page['stamp']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Фото</label>
											<?php if (mb_strlen($page['file'])>4 and file_exists("../upload/news/".$page['file'])) { ?>
											<div class="col-sm-12">
												<a data-fancybox="gallery" href="/upload/news/<?php echo d($page['file']); ?>">
													<img src="/upload/news/<?php echo d($page['file']); ?>" style="max-width: 80px; max-height: 80px;">
												</a>
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file"><input type="checkbox" name="photo-del" class="" value="1"> — удалить фото</label>
											<?php } ?>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Файл JPG, не более 1Мб</label>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1"<?php if ($page['status']=="1") { echo " SELECTED"; } ?>>Активна</option>
													<option value="3"<?php if ($page['status']=="3") { echo " SELECTED"; } ?>>Скрыта</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-preview">Превью RU</label>
											<div class="col-sm-12">
												<textarea id="input-preview" name="input-preview" class="form-control-sm w-100 h-100 border" rows="5"><?php echo $page['preview']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug</label>
											<div class="col-sm-12 input-group">
												<button data-table="news" data-edit="<?php echo d($page['id']); ?>" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm" value="<?php echo d($page['slug']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm" value="<?php echo d($page['title']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm" value="<?php echo d($page['meta1']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm" value="<?php echo d($page['meta2']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm" value="<?php echo d($page['name_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-preview-en">Превью EN</label>
											<div class="col-sm-12">
												<textarea id="input-preview-en" name="input-preview-en" class="form-control-sm w-100 h-100 border" rows="5"><?php echo $page['preview_en']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_en']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="news" data-edit="<?php echo d($page['id']); ?>" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm" value="<?php echo d($page['slug_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm" value="<?php echo d($page['title_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm" value="<?php echo d($page['meta1_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm" value="<?php echo d($page['meta2_en']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm" value="<?php echo d($page['name_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-preview-cn">Превью CN</label>
											<div class="col-sm-12">
												<textarea id="input-preview-cn" name="input-preview-cn" class="form-control-sm w-100 h-100 border" rows="5"><?php echo $page['preview_cn']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_cn']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm" value="<?php echo d($page['slug_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm" value="<?php echo d($page['title_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm" value="<?php echo d($page['meta1_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm" value="<?php echo d($page['meta2_cn']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=news_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					
					<?php }elseif ($mod=="plain_edit_text_main_about") { 
					$html=text("main_about");
					$html_en=text("main_about_en");
					$html_cn=text("main_about_cn");
					?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="plain_edit_text_main_about">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border" rows="20"><?php echo $html['value']; ?></textarea>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border" rows="20"><?php echo $html_en['value']; ?></textarea>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border" rows="20"><?php echo $html_cn['value']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					
					
					<?php }elseif ($mod=="plain_edit_text_footer") { 
					$html=text("footer");
					$html_en=text("footer_en");
					$html_cn=text("footer_cn");
					?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="plain_edit_text_footer">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border" rows="20"><?php echo $html['value']; ?></textarea>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border" rows="20"><?php echo $html_en['value']; ?></textarea>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border" rows="20"><?php echo $html_cn['value']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					
					<?php }elseif ($mod=="plain_edit_text_social") { 
					$facebook=text("main_facebook");
					$facebook_en=text("main_facebook_en");
					$facebook_cn=text("main_facebook_cn");
					$telegram=text("main_telegram");
					$telegram_en=text("main_telegram_en");
					$telegram_cn=text("main_telegram_cn");
					$youtube=text("main_youtube");
					$youtube_en=text("main_youtube_en");
					$youtube_cn=text("main_youtube_cn");
					?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="plain_edit_text_social">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-facebook">Facebook RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-facebook" name="input-facebook" class="form-control form-control-sm" value="<?php echo d($facebook['value']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-telegram">Telegram RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-telegram" name="input-telegram" class="form-control form-control-sm" value="<?php echo d($telegram['value']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-youtube">Youtube RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-youtube" name="input-youtube" class="form-control form-control-sm" value="<?php echo d($youtube['value']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-facebook-en">Facebook RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-facebook-en" name="input-facebook-en" class="form-control form-control-sm" value="<?php echo d($facebook_en['value']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-telegram-en">Telegram RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-telegram-en" name="input-telegram-en" class="form-control form-control-sm" value="<?php echo d($telegram_en['value']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-youtube-en">Youtube RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-youtube-en" name="input-youtube-en" class="form-control form-control-sm" value="<?php echo d($youtube_en['value']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-facebook-cn">Facebook RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-facebook-cn" name="input-facebook-cn" class="form-control form-control-sm" value="<?php echo d($facebook_cn['value']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-telegram-cn">Telegram RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-telegram-cn" name="input-telegram-cn" class="form-control form-control-sm" value="<?php echo d($telegram_cn['value']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-youtube-cn">Youtube RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-youtube-cn" name="input-youtube-cn" class="form-control form-control-sm" value="<?php echo d($youtube_cn['value']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->  

					<?php }elseif ($mod=="items_add") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="items_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_files">Файлы</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
									
									
									
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Пользователь</label>
											<div class="col-sm-12">
												<select id="input-follower" name="input-follower" class="form-control form-control-sm c-select has-search select2-hidden-accessible" data-select2-id="input-follower" tabindex="-1" aria-hidden="true">
													<option value="0" SELECTED>Администратор</option>
													<?php
													$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `status`='1' ORDER BY `id`;";
													$str = mysqlq($query);
													$arsql=mysql_fetch_assoc($str);
													$numrows=mysql_num_rows($str);
													if ($numrows>0) {
														do { ?>
													<option value="<?php echo d($arsql['id']); ?>">[<?php echo d($arsql['id']); ?>] <?php echo d($arsql['email']); if (mb_strlen($arsql['name'])>0) { echo d($arsql['name']); } ?><?php if (mb_strlen($arsql['company'])>0) { echo " (".d($arsql['company']).")"; } ?></option>
														<?php } while($arsql=mysql_fetch_assoc($str)); ?>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm">
													<option value="p">Предложение</option>
													<option value="s">Спрос</option>
													<option value="k">Компания</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-catalog">Категория</label>
											<div class="col-sm-12">
												<select id="input-catalog" name="input-catalog" class="form-control form-control-sm">
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0">Регион</label>
											<div class="col-sm-12 input-group">
												<select id="input-list1" name="input-list1" class="form-control form-control-sm"></select>
												<select id="input-list2" name="input-list2" class="form-control form-control-sm"></select>
												<select id="input-list3" name="input-list3" class="form-control form-control-sm"></select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0">Цена/зарплата</label>
											<div class="col-sm-12 input-group">
												<select id="price-type" name="price-type" class="form-control form-control-sm">
												  <option value="1">от</option>
												  <option value="2">точная</option>
												  <option value="3">до</option>
												  <option value="4">договорная</option>
												  <option value="5">по запросу</option>
												</select>
												<input type="text" name="price" id="price" class="form-control form-control-sm">
												<select id="price-cur" name="price-cur" class="form-control form-control-sm">
													<option value="1">руб</option>
													<option value="2">USD</option>
													<option value="3">CNY</option></select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bu">Состояние</label>
											<div class="col-sm-12">
												<select id="input-bu" name="input-bu" class="form-control form-control-sm">
													<option value="0">Новый</option>
													<option value="1">Б/у</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-video">Видео</label>
											<div class="col-sm-12">
												<input type="text" id="input-video" name="input-video" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-lang">Язык</label>
											<div class="col-sm-12">
												<select id="input-lang" name="input-lang" class="form-control form-control-sm">
													<option value="">RU</option>
													<option value="en">EN</option>
													<option value="cn">CN</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-status">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1">Опубликовано</option>
													<option value="2">На модерации</option>
													<option value="3">Отклонено</option>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Наименование</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text">Описание</label>
											<div class="col-sm-12">
												<textarea id="input-text" name="input-text" class="form-control-sm w-100 h-100 border" rows="10"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text2">Доп.сведения</label>
											<div class="col-sm-12">
												<textarea id="input-text2" name="input-text2" class="form-control-sm w-100 h-100 border" rows="10"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bp">Базис поставки</label>
											<div class="col-sm-12">
												<input type="text" id="input-bp" name="input-bp" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug</label>
											<div class="col-sm-12 input-group">
												<button data-table="items" data-edit="0" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Наименование EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text-en">Описание EN</label>
											<div class="col-sm-12">
												<textarea id="input-text-en" name="input-text-en" class="form-control-sm w-100 h-100 border" rows="10"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text2-en">Доп.сведения EN</label>
											<div class="col-sm-12">
												<textarea id="input-text2-en" name="input-text2-en" class="form-control-sm w-100 h-100 border" rows="10"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bp-en">Базис поставки EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-bp-en" name="input-bp-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="items" data-edit="0" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Наименование CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text-cn">Описание CN</label>
											<div class="col-sm-12">
												<textarea id="input-text-cn" name="input-text-cn" class="form-control-sm w-100 h-100 border" rows="10"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text2-cn">Доп.сведения CN</label>
											<div class="col-sm-12">
												<textarea id="input-text2-cn" name="input-text2-cn" class="form-control-sm w-100 h-100 border" rows="10"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bp-cn">Базис поставки CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-bp-cn" name="input-bp-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_files">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Изображения</label>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file[]" class="form-control form-control-sm" multiple="multiple">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
			
	
						<?php }elseif ($mod=="items_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="items_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_files">Файлы</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
									
									
									
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Пользователь</label>
											<div class="col-sm-12">
												<select id="input-follower" name="input-follower" class="form-control form-control-sm c-select has-search select2-hidden-accessible" data-select2-id="input-follower" tabindex="-1" aria-hidden="true">
													<option value="0"<?php if ($page['user']==0) { echo " SELECTED"; } ?>>Администратор</option>
													<?php
													$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `status`='1' ORDER BY `id`;";
													$str = mysqlq($query);
													$arsql=mysql_fetch_assoc($str);
													$numrows=mysql_num_rows($str);
													if ($numrows>0) {
														do { ?>
													<option value="<?php echo d($arsql['id']); ?>"<?php if ($page['user']==$arsql['id']) { echo " SELECTED"; } ?>>[<?php echo d($arsql['id']); ?>] <?php echo d($arsql['name']); ?><?php if (mb_strlen($arsql['company'])>0) { echo " (".d($arsql['company']).")"; } ?></option>
														<?php } while($arsql=mysql_fetch_assoc($str)); ?>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm">
													<option value="p"<?php if ($page['type']=="p") { echo " SELECTED"; } ?>>Предложение</option>
													<option value="s"<?php if ($page['type']=="s") { echo " SELECTED"; } ?>>Спрос</option>
													<option value="k"<?php if ($page['type']=="k") { echo " SELECTED"; } ?>>Компания</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-catalog">Категория</label>
											<div class="col-sm-12">
												<select id="input-catalog" data-id="<?php echo d($page['catalog']); ?>" name="input-catalog" class="form-control form-control-sm">
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0">Регион</label>
											<div class="col-sm-12 input-group">
												<select id="input-list1" data-id="<?php echo d($page['region']); ?>" name="input-list1" class="form-control form-control-sm"></select>
												<select id="input-list2" name="input-list2" class="form-control form-control-sm"></select>
												<select id="input-list3" name="input-list3" class="form-control form-control-sm"></select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0">Цена/зарплата</label>
											<div class="col-sm-12 input-group">
												<select id="price-type" name="price-type" class="form-control form-control-sm">
												  <option value="1"<?php if ($page['price_type']=="1") { echo " SELECTED"; } ?>>от</option>
												  <option value="2"<?php if ($page['price_type']=="2") { echo " SELECTED"; } ?>>точная</option>
												  <option value="3"<?php if ($page['price_type']=="3") { echo " SELECTED"; } ?>>до</option>
												  <option value="4"<?php if ($page['price_type']=="4") { echo " SELECTED"; } ?>>договорная</option>
												  <option value="5"<?php if ($page['price_type']=="5") { echo " SELECTED"; } ?>>по запросу</option>
												</select>
												<input type="text" name="price" id="price" class="form-control form-control-sm" value="<?php echo d($page['price']); ?>">
												<select id="price-cur" name="price-cur" class="form-control form-control-sm">
													<option value="1"<?php if ($page['price_cur']=="1") { echo " SELECTED"; } ?>>руб</option>
													<option value="2"<?php if ($page['price_cur']=="2") { echo " SELECTED"; } ?>>USD</option>
													<option value="3"<?php if ($page['price_cur']=="3") { echo " SELECTED"; } ?>>CNY</option></select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bu">Состояние</label>
											<div class="col-sm-12">
												<select id="input-bu" name="input-bu" class="form-control form-control-sm">
													<option value="0"<?php if ($page['bu']=="0") { echo " SELECTED"; } ?>>Новый</option>
													<option value="1"<?php if ($page['bu']=="1") { echo " SELECTED"; } ?>>Б/у</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-video">Видео</label>
											<div class="col-sm-12">
												<input type="text" id="input-video" name="input-video" class="form-control form-control-sm" value="<?php echo d($page['video']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-lang">Язык</label>
											<div class="col-sm-12">
												<select id="input-lang" name="input-lang" class="form-control form-control-sm">
													<option value=""<?php if ($page['lang']=="") { echo " SELECTED"; } ?>>RU</option>
													<option value="en"<?php if ($page['lang']=="en") { echo " SELECTED"; } ?>>EN</option>
													<option value="cn"<?php if ($page['lang']=="cn") { echo " SELECTED"; } ?>>CN</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-status">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1"<?php if ($page['status']=="1") { echo " SELECTED"; } ?>>Опубликовано</option>
													<option value="2"<?php if ($page['status']=="2") { echo " SELECTED"; } ?>>На модерации</option>
													<option value="3"<?php if ($page['status']=="3") { echo " SELECTED"; } ?>>Отклонено</option>
												</select>
											</div>
										</div>										
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Наименование</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text">Описание</label>
											<div class="col-sm-12">
												<textarea id="input-text" name="input-text" class="form-control-sm w-100 h-100 border" rows="10"><?php echo $page['text']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text2">Доп.сведения</label>
											<div class="col-sm-12">
												<textarea id="input-text2" name="input-text2" class="form-control-sm w-100 h-100 border" rows="10"><?php echo $page['text2']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bp">Базис поставки</label>
											<div class="col-sm-12">
												<input type="text" id="input-bp" name="input-bp" class="form-control form-control-sm" value="<?php echo d($page['bp']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug</label>
											<div class="col-sm-12 input-group">
												<button data-table="items" data-edit="<?php echo d($page['id']); ?>" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm" value="<?php echo d($page['slug']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm" value="<?php echo d($page['title']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm" value="<?php echo d($page['meta1']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm" value="<?php echo d($page['meta2']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Наименование EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm" value="<?php echo d($page['name_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text-en">Описание EN</label>
											<div class="col-sm-12">
												<textarea id="input-text-en" name="input-text-en" class="form-control-sm w-100 h-100 border" rows="10"><?php echo $page['text_en']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text2-en">Доп.сведения EN</label>
											<div class="col-sm-12">
												<textarea id="input-text2-en" name="input-text2-en" class="form-control-sm w-100 h-100 border" rows="10"><?php echo $page['text2_en']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bp-en">Базис поставки EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-bp-en" name="input-bp-en" class="form-control form-control-sm" value="<?php echo d($page['bp_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="news" data-edit="<?php echo d($page['id']); ?>" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm" value="<?php echo d($page['slug_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm" value="<?php echo d($page['title_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm" value="<?php echo d($page['meta1_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm" value="<?php echo d($page['meta2_en']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Наименование CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm" value="<?php echo d($page['name_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text-cn">Описание CN</label>
											<div class="col-sm-12">
												<textarea id="input-text-cn" name="input-text-cn" class="form-control-sm w-100 h-100 border" rows="10"><?php echo $page['text_cn']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-text2-cn">Доп.сведения CN</label>
											<div class="col-sm-12">
												<textarea id="input-text2-cn" name="input-text2-cn" class="form-control-sm w-100 h-100 border" rows="10"><?php echo $page['text2_cn']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-bp-cn">Базис поставки CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-bp-cn" name="input-bp-cn" class="form-control form-control-sm" value="<?php echo d($page['bp_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm" value="<?php echo d($page['slug_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm" value="<?php echo d($page['title_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm" value="<?php echo d($page['meta1_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm" value="<?php echo d($page['meta2_cn']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_files">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Добавить изображения</label>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file[]" class="form-control form-control-sm" multiple="multiple">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0 w-100">
											<form method="post" class="w-100">
											<table id="maintable" class="c-table table-bordered table-hover">


												<thead class="c-table__head c-table__head--slim">
													<tr class="c-table__row">
													  <th class="c-table__cell c-table__cell--head p-1 text-center">Фото</th>
													  <th class="c-table__cell c-table__cell--head p-1 text-center w-100">&nbsp;</th>
													  <th class="c-table__cell c-table__cell--head p-1 text-center mwp-70">Позиция</th>
													  <th class="c-table__cell c-table__cell--head p-0 text-center" style="max-width: 15% !important;">&nbsp;</th>
													</tr>
												</thead>

												<tbody>
												
												<?php
												
												$maxid=0;
												$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($page['id'])."' and `id`>0 ORDER BY `position`, `id` DESC;";
												$str = mysqlq($query);
												$arsql=mysql_fetch_assoc($str);
												$numrows=mysql_num_rows($str);
												if ($numrows>0) {
												do {
												if ($maxid<$arsql['id']) { $maxid=$arsql['id']; }
												

												
												
												?>
																
													<tr class="c-table__row" id="row<?php echo $arsql['id']; ?>" data-id="<?php echo $arsql['id']; ?>">
														<td class="c-table__cell p-2 text-center align-top">
														<?php if (file_exists("../upload/items/".$arsql['file']) and mb_strlen($arsql['file'])>4) { ?>
															<a data-fancybox="gallery" href="<?php echo "../upload/items/".$arsql['file']; ?>"><img src="<?php echo "../upload/items/".$arsql['file']; ?>" class="mwp-140 mhp-140"></a>
														<?php } else { ?>
															<img src="img/empty.png" class="mwp-140 mhp-140">
														<?php } ?>
														</td>


														<td class="c-table__cell p-2 align-top text-center">
															&nbsp;
														</td>

														<td class="c-table__cell p-2 align-top text-center mwp-70">
															<input type="text" class="form-control form-control-sm text-center positionslides" data-id="<?php echo d($arsql['id']); ?>" id="pos<?php echo d($arsql['id']); ?>" name="pos[<?php echo d($arsql['id']); ?>]" value="<?php echo d($arsql['position']); ?>">
														</td>

														
														<td class="c-table__cell p-0 pt-2 text-center align-top">
															<div class="c-dropdown dropdown">
																<button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
																
																<div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
																	<a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" это изображение" href="?mod=items_files_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
																</div>
															</div>
														</td>
													</tr>
												<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
												<?php }else{ ?>
													<tr>
														<td colspan="4" class="c-table__cell text-center">Изображений не найдено</td>
													</tr>
												<?php } ?>
												<?php
												$link=implode("&", $link);
												?>
												</tbody>
											</table>


											

										</div>

									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Изменить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
			
	
					

					<?php }elseif ($mod=="catalog_add") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="catalog_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm">
													<option value="1">Папка</option>
													<option value="2" SELECTED>Категория</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Иконка</label>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="parent">Родительская папка</label>
											<div class="col-sm-12">
												<select id="parent" name="parent" class="form-control form-control-sm">
													<option value="0"<?php if ($id=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
													<?php 
													echo folders("catalog",0,"",$id); ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0 mb-0">
											<div class="col-12 col-md-4">
												<div class="form-group row ml-0 mr-0">
													<label class="col-form-label-sm col-sm-12 mb-0 pl-0 pr-0" for="input-status-p">ПРЕДЛОЖЕНИЕ</label>
													<div class="col-sm-12 pl-0 pr-0">
														<select id="input-status" name="input-status-p" class="form-control form-control-sm">
															<option value="1" SELECTED>Активна</option>
															<option value="3">Скрыта</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group row ml-0 mr-0">
													<label class="col-form-label-sm col-sm-12 mb-0 pl-0 pr-0" for="input-status-s">СПРОС</label>
													<div class="col-sm-12 pl-0 pr-0">
														<select id="input-status" name="input-status-s" class="form-control form-control-sm">
															<option value="1" SELECTED>Активна</option>
															<option value="3">Скрыта</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group row ml-0 mr-0">
													<label class="col-form-label-sm col-sm-12 mb-0 pl-0 pr-0" for="input-status-k">КОМПАНИИ</label>
													<div class="col-sm-12 pl-0 pr-0">
														<select id="input-status" name="input-status-k" class="form-control form-control-sm">
															<option value="1" SELECTED>Активна</option>
															<option value="3">Скрыта</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-position">Позиция</label>
											<div class="col-sm-12">
												<select id="input-position" name="input-position" class="form-control form-control-sm">
													<option value="1">В начало</option>
													<option value="2" SELECTED>В конец</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Наименование RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug RU</label>
											<div class="col-sm-12 input-group">
												<button data-table="catalog" data-edit="0" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Наименование EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="catalog" data-edit="0" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Наименование CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
			
			

					<?php }elseif ($mod=="catalog_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="catalog_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm"<?php
												
													$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `parent`='".sql($page['id'])."' LIMIT 1;";
													$str3 = mysqlq($query3);
													$arsql3=mysql_fetch_assoc($str3);
													$numrows3=mysql_num_rows($str3);	
													if ($numrows3==1){
														echo " disabled=\"disabled\"";
													}
												?>>
													<option value="1"<?php if ($page['type']=="1") { echo " SELECTED"; } ?>>Папка</option>
													<option value="2"<?php if ($page['type']=="2") { echo " SELECTED"; } ?>>Категория</option>
												</select>
												<?php if ($numrows3==1) { ?>
												<label class="col-form-label-sm col-sm-12 mb-0 admin_comment_red" for="input-type">Изменение типа заблокировано, т.к. есть дочерние элементы</label>
												<?php } ?>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="parent">Родительская папка</label>
											<div class="col-sm-12">
												<select id="parent" name="parent" class="form-control form-control-sm">
													<option value="0"<?php if ($page['parent']=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
													<?php 
													echo folders("catalog",0,"",$page['parent']); ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Иконка</label>
											<?php if (mb_strlen($page['file'])>4 and file_exists("../upload/catalog/".$page['file'])) { ?>
											<div class="col-sm-12">
												<a data-fancybox="gallery" href="/upload/catalog/<?php echo d($page['file']); ?>">
													<img src="/upload/catalog/<?php echo d($page['file']); ?>" style="max-width: 80px; max-height: 80px;">
												</a>
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">
											<?php } ?>
											<div class="col-sm-12">
												<input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
											</div>
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">&nbsp;</label>
										</div>
										<div class="form-group row ml-0 mr-0 mb-0">
											<div class="col-12 col-md-4">
												<div class="form-group row ml-0 mr-0">
													<label class="col-form-label-sm col-sm-12 mb-0 pl-0 pr-0" for="input-status-p">ПРЕДЛОЖЕНИЕ</label>
													<div class="col-sm-12 pl-0 pr-0">
														<select id="input-status" name="input-status-p" class="form-control form-control-sm">
															<option value="1"<?php if ($page['status_p']=="1") { echo " SELECTED"; } ?>>Активна</option>
															<option value="3"<?php if ($page['status_p']=="3") { echo " SELECTED"; } ?>>Скрыта</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group row ml-0 mr-0">
													<label class="col-form-label-sm col-sm-12 mb-0 pl-0 pr-0" for="input-status-s">СПРОС</label>
													<div class="col-sm-12 pl-0 pr-0">
														<select id="input-status" name="input-status-s" class="form-control form-control-sm">
															<option value="1"<?php if ($page['status_s']=="1") { echo " SELECTED"; } ?>>Активна</option>
															<option value="3"<?php if ($page['status_s']=="3") { echo " SELECTED"; } ?>>Скрыта</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group row ml-0 mr-0">
													<label class="col-form-label-sm col-sm-12 mb-0 pl-0 pr-0" for="input-status-k">КОМПАНИИ</label>
													<div class="col-sm-12 pl-0 pr-0">
														<select id="input-status" name="input-status-k" class="form-control form-control-sm">
															<option value="1"<?php if ($page['status_k']=="1") { echo " SELECTED"; } ?>>Активна</option>
															<option value="3"<?php if ($page['status_k']=="3") { echo " SELECTED"; } ?>>Скрыта</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug RU</label>
											<div class="col-sm-12 input-group">
												<button data-table="catalog" data-edit="<?php echo d($page['id']); ?>" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm" value="<?php echo d($page['slug']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm" value="<?php echo d($page['title']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm" value="<?php echo d($page['meta1']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm" value="<?php echo d($page['meta2']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm" value="<?php echo d($page['name_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_en']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="catalog" data-edit="<?php echo d($page['id']); ?>" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm" value="<?php echo d($page['slug_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm" value="<?php echo d($page['title_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm" value="<?php echo d($page['meta1_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm" value="<?php echo d($page['meta2_en']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm" value="<?php echo d($page['name_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_cn']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm" value="<?php echo d($page['slug_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm" value="<?php echo d($page['title_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm" value="<?php echo d($page['meta1_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm" value="<?php echo d($page['meta2_cn']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=catalog_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					

	
					<?php }elseif ($mod=="pages_add") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="pages_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm">
													<option value="1">Папка</option>
													<option value="2" SELECTED>Страница</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="parent">Родительская папка</label>
											<div class="col-sm-12">
												<select id="parent" name="parent" class="form-control form-control-sm">
													<option value="0"<?php if ($id=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
													<?php 
													echo folders("pages",0,"",$id); ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-status">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1" SELECTED>Активна</option>
													<option value="3">Скрыта</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-position">Позиция</label>
											<div class="col-sm-12">
												<select id="input-position" name="input-position" class="form-control form-control-sm">
													<option value="1">В начало</option>
													<option value="2" SELECTED>В конец</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug RU</label>
											<div class="col-sm-12 input-group">
												<button data-table="pages" data-edit="0" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="pages" data-edit="0" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					

					<?php }elseif ($mod=="pages_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="pages_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm"<?php
												
													$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `parent`='".sql($page['id'])."' LIMIT 1;";
													$str3 = mysqlq($query3);
													$arsql3=mysql_fetch_assoc($str3);
													$numrows3=mysql_num_rows($str3);	
													if ($numrows3==1){
														echo " disabled=\"disabled\"";
													}
												?>>
													<option value="1"<?php if ($page['type']=="1") { echo " SELECTED"; } ?>>Папка</option>
													<option value="2"<?php if ($page['type']=="2") { echo " SELECTED"; } ?>>Страница</option>
												</select>
												<?php if ($numrows3==1) { ?>
												<label class="col-form-label-sm col-sm-12 mb-0 admin_comment_red" for="input-type">Изменение типа заблокировано, т.к. есть дочерние страницы/папки</label>
												<?php } ?>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="parent">Родительская папка</label>
											<div class="col-sm-12">
												<select id="parent" name="parent" class="form-control form-control-sm">
													<option value="0"<?php if ($page['parent']=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
													<?php 
													echo folders("pages",0,"",$page['parent']); ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1"<?php if ($page['status']=="1") { echo " SELECTED"; } ?>>Активна</option>
													<option value="3"<?php if ($page['status']=="3") { echo " SELECTED"; } ?>>Скрыта</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Заголовок RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html">HTML RU</label>
											<div class="col-sm-12">
												<textarea id="input-html" name="input-html" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug">Slug RU</label>
											<div class="col-sm-12 input-group">
												<button data-table="pages" data-edit="<?php echo d($page['id']); ?>" data-type="" data-id="input-slug" data-from="input-name" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug" name="input-slug" class="form-control form-control-sm" value="<?php echo d($page['slug']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title">Title RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-title" name="input-title" class="form-control form-control-sm" value="<?php echo d($page['title']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc">Description RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc" name="input-desc" class="form-control form-control-sm" value="<?php echo d($page['meta1']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw">Keywords RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw" name="input-keyw" class="form-control form-control-sm" value="<?php echo d($page['meta2']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Заголовок EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm" value="<?php echo d($page['name_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-en">HTML EN</label>
											<div class="col-sm-12">
												<textarea id="input-html-en" name="input-html-en" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_en']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-en">Slug EN</label>
											<div class="col-sm-12 input-group">
												<button data-table="pages" data-edit="<?php echo d($page['id']); ?>" data-type="en" data-id="input-slug-en" data-from="input-name-en" class="btn-slug btn btn-sm btn-secondary"><i class="fa fa-text-width"></i></button>
												<input type="text" id="input-slug-en" name="input-slug-en" class="form-control form-control-sm" value="<?php echo d($page['slug_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-en">Title EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-en" name="input-title-en" class="form-control form-control-sm" value="<?php echo d($page['title_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-en">Description EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-en" name="input-desc-en" class="form-control form-control-sm" value="<?php echo d($page['meta1_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-en">Keywords EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-en" name="input-keyw-en" class="form-control form-control-sm" value="<?php echo d($page['meta2_en']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Заголовок CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm" value="<?php echo d($page['name_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-html-cn">HTML CN</label>
											<div class="col-sm-12">
												<textarea id="input-html-cn" name="input-html-cn" class="form-control-sm w-100 h-100 border summernote" rows="20"><?php echo $page['html_cn']; ?></textarea>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-slug-cn">Slug CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-slug-cn" name="input-slug-cn" class="form-control form-control-sm" value="<?php echo d($page['slug_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-title-cn">Title CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-title-cn" name="input-title-cn" class="form-control form-control-sm" value="<?php echo d($page['title_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-desc-cn">Description CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-desc-cn" name="input-desc-cn" class="form-control form-control-sm" value="<?php echo d($page['meta1_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-keyw-cn">Keywords CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-keyw-cn" name="input-keyw-cn" class="form-control form-control-sm" value="<?php echo d($page['meta2_cn']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=pages_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					

					

					<?php }elseif ($mod=="topmenu_add") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="topmenu_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm">
													<option value="1">Папка</option>
													<option value="2" SELECTED>Ссылка</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="parent">Родительская папка</label>
											<div class="col-sm-12">
												<select id="parent" name="parent" class="form-control form-control-sm">
													<option value="0"<?php if ($id=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
													<?php 
													echo folders("topmenu",0,"",$id); ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-blank"><input type="checkbox" id="input-blank" name="input-blank" class="" value="1"> - Открывать в новом окне</label>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-status">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1" SELECTED>Активна</option>
													<option value="3">Скрыта</option>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-position">Позиция</label>
											<div class="col-sm-12">
												<select id="input-position" name="input-position" class="form-control form-control-sm">
													<option value="1">В начало</option>
													<option value="2" SELECTED>В конец</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Анкор RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link">Ссылка RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-link" name="input-link" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Анкор EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-en">Ссылка EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-en" name="input-link-en" class="form-control form-control-sm">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Анкор CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-cn">Ссылка CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-cn" name="input-link-cn" class="form-control form-control-sm">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					

					<?php }elseif ($mod=="topmenu_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="topmenu_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_ru">🇷🇺 RU</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_en">🇬🇧 EN</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_cn">🇨🇳 CN</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Тип</label>
											<div class="col-sm-12">
												<select id="input-type" name="input-type" class="form-control form-control-sm"<?php
												
													$query3="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `parent`='".sql($page['id'])."' LIMIT 1;";
													$str3 = mysqlq($query3);
													$arsql3=mysql_fetch_assoc($str3);
													$numrows3=mysql_num_rows($str3);	
													if ($numrows3==1){
														echo " disabled=\"disabled\"";
													}
												?>>
													<option value="1"<?php if ($page['type']=="1") { echo " SELECTED"; } ?>>Папка</option>
													<option value="2"<?php if ($page['type']=="2") { echo " SELECTED"; } ?>>Ссылка</option>
												</select>
												<?php if ($numrows3==1) { ?>
												<label class="col-form-label-sm col-sm-12 mb-0 admin_comment_red" for="input-type">Изменение типа заблокировано, т.к. есть дочерние страницы/папки</label>
												<?php } ?>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="parent">Родительская папка</label>
											<div class="col-sm-12">
												<select id="parent" name="parent" class="form-control form-control-sm">
													<option value="0"<?php if ($page['parent']=="0") { echo " SELECTED"; } ?>>В корневую папку</option>
													<?php 
													echo folders("topmenu",0,"",$page['parent']); ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-blank"><input type="checkbox" id="input-blank" name="input-blank" class="" value="1"<?php if ($page['blank']=="1") { echo " CHECKED"; } ?>> - Открывать в новом окне</label>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
													<option value="1"<?php if ($page['status']=="1") { echo " SELECTED"; } ?>>Активна</option>
													<option value="3"<?php if ($page['status']=="3") { echo " SELECTED"; } ?>>Скрыта</option>
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_ru">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Анкор RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link">Ссылка RU</label>
											<div class="col-sm-12">
												<input type="text" id="input-link" name="input-link" class="form-control form-control-sm" value="<?php echo d($page['link']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_en">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-en">Анкор EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-en" name="input-name-en" class="form-control form-control-sm" value="<?php echo d($page['name_en']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-en">Ссылка EN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-en" name="input-link-en" class="form-control form-control-sm" value="<?php echo d($page['link_en']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_cn">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name-cn">Анкор CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-name-cn" name="input-name-cn" class="form-control form-control-sm" value="<?php echo d($page['name_cn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-link-cn">Ссылка CN</label>
											<div class="col-sm-12">
												<input type="text" id="input-link-cn" name="input-link-cn" class="form-control form-control-sm" value="<?php echo d($page['link_cn']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=topmenu_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					




					<?php }elseif ($mod=="users_edit") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100"><input type="hidden" name="sce" value="users_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-name">ID аккаунта</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-control-sm" value="<?php echo d($page['id']); ?>" disabled="disabled">
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Доступ</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-control-sm" value="<?php 

										if ($page['status']==0) { echo "Просмотр"; }
										elseif ($page['status']==1) { echo "Пользователь"; }
										elseif ($page['status']==2) { echo "Администратор"; }
										elseif ($page['status']==3) { echo "Суперадмин"; }
										else { echo "&nbsp;"; }
									?>" disabled="disabled">
                                </div>
                            </div>
							<?php if ($GLOBALS['user']['status']>=3) {?>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-type">Изменение профиля</label>
                                <div class="col-sm-12">
                                    <select id="input-type" name="input-type" class="form-control form-control-sm">
										<option value="0"<?php if ($page['lockstatus']=="0") { echo " SELECTED"; }?>>Разрешить</option>
										<option value="1"<?php if ($page['lockstatus']=="1") { echo " SELECTED"; }?>>Заблокировать</option>
									</select>
								</div>
                            </div>
							<?php } ?>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Фамилия, имя, отчество</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-phone">Телефон</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-phone" name="input-phone" class="form-control form-control-sm" value="<?php echo d($page['phone']); ?>">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-email">E-mail</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-email" name="input-email" class="form-control form-control-sm" value="<?php echo d($page['email']); ?>">
                                </div>
                            </div>
							
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-pass">Смена пароля</label>
                                <div class="col-sm-12">
                                    <input type="password" id="input-pass" name="input-pass" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-pass2">Подтверждение пароля</label>
                                <div class="col-sm-12">
                                    <input type="password" id="input-pass2" name="input-pass2" class="form-control form-control-sm" value="">
                                </div>
                            </div>
							
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
									<input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=users_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					







                </div><!-- // .row -->
            </div><!-- // .container -->    

					<?php }elseif ($mod=="followers_edit") { ?>
					
					
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="followers_edit"><input type="hidden" name="id" value="<?php echo d($page['id']); ?>">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_pub">Публичные</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_org">Реквизиты</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_pan">Управление</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">ID аккаунта</label>
											<div class="col-sm-12">
												<input type="text" class="form-control form-control-sm" value="<?php echo d($page['id']); ?>" disabled="disabled">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-status">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
												<?php 
												$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `status`='1' ORDER BY `position`, `id`;";
												$str = mysqlq($query);
												$arsql=mysql_fetch_assoc($str);
												$numrows=mysql_num_rows($str);	
												if ($numrows>0) {
													do {
												?>
													<option value="<?php echo d($arsql['id']); ?>"<?php if ($page['role']==$arsql['id']) { echo " SELECTED"; } ?>><?php echo d($arsql['name']); ?></option>
												<?php } while($arsql=mysql_fetch_assoc($str)); } ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-email">E-mail</label>
											<div class="col-sm-12">
												<input type="text" id="input-email" name="input-email" class="form-control form-control-sm" value="<?php echo d($page['email']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Фамилия, имя, отчество</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($page['name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-company">Компания</label>
											<div class="col-sm-12">
												<input type="text" id="input-company" name="input-company" class="form-control form-control-sm" value="<?php echo d($page['company']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-phone">Телефон</label>
											<div class="col-sm-12">
												<input type="text" id="input-phone" name="input-phone" class="form-control form-control-sm" value="<?php echo d($page['phone']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_pub">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubemail">E-mail</label>
											<div class="col-sm-12">
												<input type="text" id="input-pubemail" name="input-pubemail" class="form-control form-control-sm" value="<?php echo d($page['public_email']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Фамилия, имя, отчество</label>
											<div class="col-sm-12">
												<input type="text" id="input-pubname" name="input-pubname" class="form-control form-control-sm" value="<?php echo d($page['public_name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubphone">Телефон</label>
											<div class="col-sm-12">
												<input type="text" id="input-pubphone" name="input-pubphone" class="form-control form-control-sm" value="<?php echo d($page['public_phone']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_org">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Наименование организации</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgname" name="input-orgname" class="form-control form-control-sm" id="orgname" value="<?php echo d($page['org_name']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Полное наименование</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgfullname" name="input-orgfullname" class="form-control form-control-sm" id="orgfullname" value="<?php echo d($page['org_fullname']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Юр.адрес</label>
											<div class="col-sm-12">
												<input type="text" id="input-orguadres" name="input-orguadres" class="form-control form-control-sm" id="orguadres" value="<?php echo d($page['org_uadres']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Факт.адрес</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgfadres" name="input-orgfadres" class="form-control form-control-sm" id="orgfadres" value="<?php echo d($page['org_fadres']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">ОГРН</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgn" name="input-orgorgn" class="form-control form-control-sm" id="orgogrn" value="<?php echo d($page['org_ogrn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">ИНН</label>
											<div class="col-sm-12">
												<input type="text" id="input-orginn" name="input-orginn" class="form-control form-control-sm" id="orginn" value="<?php echo d($page['org_inn']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">КПП</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgkpp" name="input-orgkpp" class="form-control form-control-sm" id="orgkpp" value="<?php echo d($page['org_kpp']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Банк</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgbank" name="input-orgbank" class="form-control form-control-sm" id="orgbank" value="<?php echo d($page['org_bank']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Р/с</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgrs" name="input-orgrs" class="form-control form-control-sm" id="orgrs" value="<?php echo d($page['org_rs']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">К/с</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgks" name="input-orgks" class="form-control form-control-sm" id="orgks" value="<?php echo d($page['org_ks']); ?>">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">БИК</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgbik" name="input-orgbik" class="form-control form-control-sm" id="orgbik" value="<?php echo d($page['org_bik']); ?>">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_pan">
									<?php if ($page['confirm']!="" and $page['status']==3) { ?>
										<div class="form-group row ml-0 mr-0">
											<a class="confirmation btn btn-sm btn-success m-3 mb-5" data-title="Подтвердить аккаунт" data-message="Вы уверены, что хотите подтвердить аккаунт?" href="?mod=followers_confirm&id=<?php echo $page['id']; ?>">Подтвердить аккаунт</a>
										</div>
									<?php } ?>
									</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=followers_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					
  

					<?php }elseif ($mod=="followers_add") { ?>
					
					
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="followers_add">
							<div class="form-group">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tab">Общие</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_pub">Публичные</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tab_org">Реквизиты</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade show active" id="tab">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-status">Статус</label>
											<div class="col-sm-12">
												<select id="input-status" name="input-status" class="form-control form-control-sm">
												<?php 
												$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `status`='1' ORDER BY `position`, `id`;";
												$str = mysqlq($query);
												$arsql=mysql_fetch_assoc($str);
												$numrows=mysql_num_rows($str);	
												if ($numrows>0) {
													do {
												?>
													<option value="<?php echo d($arsql['id']); ?>"><?php echo d($arsql['name']); ?></option>
												<?php } while($arsql=mysql_fetch_assoc($str)); } ?>
												</select>
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-email">E-mail</label>
											<div class="col-sm-12">
												<input type="text" id="input-email" name="input-email" class="form-control form-control-sm" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Фамилия, имя, отчество</label>
											<div class="col-sm-12">
												<input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-company">Компания</label>
											<div class="col-sm-12">
												<input type="text" id="input-company" name="input-company" class="form-control form-control-sm" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-phone">Телефон</label>
											<div class="col-sm-12">
												<input type="text" id="input-phone" name="input-phone" class="form-control form-control-sm" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pass1">Пароль</label>
											<div class="col-sm-12">
												<input type="text" id="input-pass1" name="input-pass1" class="form-control form-control-sm" value="">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_pub">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubemail">E-mail</label>
											<div class="col-sm-12">
												<input type="text" id="input-pubemail" name="input-pubemail" class="form-control form-control-sm" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Фамилия, имя, отчество</label>
											<div class="col-sm-12">
												<input type="text" id="input-pubname" name="input-pubname" class="form-control form-control-sm" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubphone">Телефон</label>
											<div class="col-sm-12">
												<input type="text" id="input-pubphone" name="input-pubphone" class="form-control form-control-sm" value="">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_org">
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Наименование организации</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgname" name="input-orgname" class="form-control form-control-sm" id="orgname" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Полное наименование</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgfullname" name="input-orgfullname" class="form-control form-control-sm" id="orgfullname" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Юр.адрес</label>
											<div class="col-sm-12">
												<input type="text" id="input-orguadres" name="input-orguadres" class="form-control form-control-sm" id="orguadres" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Факт.адрес</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgfadres" name="input-orgfadres" class="form-control form-control-sm" id="orgfadres" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">ОГРН</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgn" name="input-orgorgn" class="form-control form-control-sm" id="orgogrn" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">ИНН</label>
											<div class="col-sm-12">
												<input type="text" id="input-orginn" name="input-orginn" class="form-control form-control-sm" id="orginn" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">КПП</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgkpp" name="input-orgkpp" class="form-control form-control-sm" id="orgkpp" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Банк</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgbank" name="input-orgbank" class="form-control form-control-sm" id="orgbank" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">Р/с</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgrs" name="input-orgrs" class="form-control form-control-sm" id="orgrs" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">К/с</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgks" name="input-orgks" class="form-control form-control-sm" id="orgks" value="">
											</div>
										</div>
										<div class="form-group row ml-0 mr-0">
											<label class="col-form-label-sm col-sm-12 mb-0" for="input-pubname">БИК</label>
											<div class="col-sm-12">
												<input type="text" id="input-orgbik" name="input-orgbik" class="form-control form-control-sm" id="orgbik" value="">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tab_pan">

									</div>
								</div>
							</div>
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-sm btn-success" value="Добавить">
                                </div>
                            </div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
            </div><!-- // .container -->    
					
  

		   
 

					<?php }elseif($mod=="text_list") { ?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=text_add&id=<?php echo $id; ?>" class="btn btn-sm btn-primary">Добавить настройку</a>
				</div>
				<div class="row ml-0 mr-0 mb-2">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell col-3 c-table__cell--head p-1 text-left pl-3">Название</th>
                              <th class="c-table__cell col-2 c-table__cell--head p-1 text-center">Ключ</th>
                              <th class="c-table__cell col-4 d-none d-md-table-cell c-table__cell--head p-1 text-left pl-3">Значение</th>
                              <th class="c-table__cell col-2 c-table__cell--head p-1 text-center">Срок</th>
							  <th class="c-table__cell col-1 c-table__cell--head p-0 text-center">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `parent`='".sql($id)."' ORDER BY `type` DESC, `text`, `id`;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);

							
							if ($id>0) {
								
								$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."text` WHERE `id`='".sql($id)."' LIMIT 1;";
								$str2 = mysqlq($query2);
								$arsql2=mysql_fetch_assoc($str2);
								$numrows2=mysql_num_rows($str2);
								if ($numrows2>0) {
							?>
                            <tr class="c-table__row">
								
                                <td class="c-table__cell p-1 text-left pl-3">
									<?php echo "<a class=\"font-weight-bold\" href=\"?mod=text_list&id=".$arsql2['parent']."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-folder-o\"></i>&nbsp; </span>..</a>"; ?>
                                </td>

                                <td class="c-table__cell p-1 d-none d-md-table-cell text-center">
									<?php echo d(""); ?>
                                </td>
							
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<?php echo d(""); ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
									<div class="c-dropdown dropdown">
										<button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton0" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a href="?mod=text_list" class="c-dropdown__item dropdown-item p-1 pl-2">В корневую папку</a>
                                        </div>
									</div>
                                </td>

                            </tr>
							<?php
								}
								}
						if ($numrows>0) {
						do {
						?>
										
                            <tr class="c-table__row">
								
                                <td class="c-table__cell p-1 text-left pl-3">
									<?php if ($arsql['type']=="1") { echo "<a class=\"font-weight-bold\" href=\"?mod=text_list&id=".$arsql['id']."\"><span class=\"d-none d-md-table-cell\"><i class=\"fa fa-folder-o\"></i>&nbsp; </span>"; } echo d($arsql['text']); if ($arsql['type']=="1") { echo "</a>"; } ?>
                                </td>

                                <td class="c-table__cell p-1 d-none d-md-table-cell text-center">
								<?php if ($arsql['type']=="0") { echo d($arsql['name']); } else { echo d(""); } ?>
                                </td>
							
                                <td class="c-table__cell p-1 text-left">
								<?php if ($arsql['type']=="0") { ?>
									<textarea id="textvalue<?php echo $arsql['id']; ?>" data-id="<?php echo d($arsql['id']); ?>" class="textvalue form-control-sm w-100 border" rows="1"><?php echo d($arsql['value']); ?></textarea>
								<?php } else { echo d(""); } ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
								<?php if ($arsql['type']=="0" and $arsql['dateto']>0) { ?>
									<input type="text" id="textdateto<?php echo d($arsql['id']); ?>" class="form-control form-control-sm text-center datepicker-here"<?php echo " data-value=\"".d($arsql['dateto']*1000)."\""; ?> data-id="<?php echo d($arsql['id']); ?>" data-value-value="<?php echo date("d.m.Y H:i", $arsql['dateto']); ?>" value="<?php echo date("d.m.Y H:i", $arsql['dateto']); ?>">
								<?php } else { echo d(""); } ?>
                                </td>
								
                                <td class="c-table__cell p-1 text-center">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton<?php echo $arsql['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton<?php echo $arsql['id']; ?>" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<a href="?mod=text_edit&id=<?php echo $arsql['id']; ?>" class="c-dropdown__item dropdown-item p-1 pl-2">Изменить</a>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
											<a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" эту <?php if ($arsql['type']=="1") { echo "папку"; } else { echo "переменную"; } ?>" href="?mod=text_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="5" class="c-table__cell text-center">Записей не найдено</td>
							</tr>
						<?php } ?>
                        </tbody>
                    </table>
					</form>
                </div><!-- // .row -->
            </div><!-- // .container -->   					


					<?php }elseif($mod=="users_list") { ?>

            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-0 text-center">&nbsp;</th>
                              <th class="c-table__cell c-table__cell--head p-1 text-center">Ф.И.О.</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">E-mail</th>
                              <th class="c-table__cell c-table__cell--head p-1 text-center">Статус</th>
                              <th class="c-table__cell c-table__cell--head p-1 text-center">&nbsp;</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php
						
						$maxid=0;
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."users` WHERE `del`='0' ORDER BY `blocked`, `name`, `id`;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
						do {
						?>
										
                            <tr class="c-table__row">
                                <td class="c-table__cell p-1 text-center">
									<?php if ($arsql['datetime']>=(time()-1200)) { echo "<div class=\"admin_comment_green\">Онлайн</div>"; } else { echo "<div class=\"admin_comment_red\">Не&nbsp;в&nbsp;сети</div>"; } ?>
								</td>
								
                                <td class="c-table__cell p-1 text-center">
									<div class="d-md-none"><b><?php echo d($arsql['email']); ?></b></div>
									<?php $br=0; if (mb_strlen($arsql['name'])>0) { echo d($arsql['name']); $br=1; } ?>
									<?php if (mb_strlen($arsql['phone'])>0) { if ($br==1) { echo "<br>"; } echo d($arsql['phone']); } ?>
                                </td>
                                <td class="c-table__cell p-1 d-none d-md-table-cell text-center">
									<?php echo d($arsql['email']); ?>
                                </td>
                                <td class="c-table__cell p-1 text-center">
								    <select class="form-control form-control-sm user-status user-status<?php echo $arsql['id']; ?>" data-id="<?php echo $arsql['id']; ?>"<?php if ($GLOBALS['user']['status']<$arsql['status'] || $GLOBALS['user']['status']<2 || $GLOBALS['user']['id']==$arsql['id'] || $arsql['status']=="3" || ($GLOBALS['user']['status']<3 and $arsql['lockstatus']=="1")) { echo " disabled=\"disabled\""; } ?>>
										<option value="0"<?php if ($arsql['status']==0) { echo " SELECTED"; } ?>>Просмотр</option>
										<option value="1"<?php if ($arsql['status']==1) { echo " SELECTED"; } ?>>Пользователь</option>
										<option value="2"<?php if ($arsql['status']==2) { echo " SELECTED"; } ?>>Администратор</option>
										<option value="3"<?php if ($arsql['status']==3) { echo " SELECTED"; } ?>>Суперадмин</option>
									</select>
                                </td>

                                <td class="c-table__cell p-1 text-center">
								    <select class="form-control form-control-sm user-blocked user-blocked<?php echo $arsql['id']; ?>" data-id="<?php echo $arsql['id']; ?>"<?php if ($GLOBALS['user']['status']<$arsql['status'] || $GLOBALS['user']['status']<2 || $GLOBALS['user']['id']==$arsql['id'] || $arsql['status']=="3" || ($GLOBALS['user']['status']<3 and $arsql['lockstatus']=="1")) { echo " disabled=\"disabled\""; } ?>>
										<option value="0"<?php if ($arsql['blocked']==0) { echo " SELECTED"; } ?>>Активен</option>
										<option value="1"<?php if ($arsql['blocked']==1) { echo " SELECTED"; } ?>>Заблокирован</option>
									</select>
                                </td>
							
                                <td class="c-table__cell p-1 text-center">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<?php if ($GLOBALS['user']['status']>=2) { ?>
											<<?php if ($GLOBALS['user']['status']<3 and $arsql['lockstatus']=="1") { echo "span"; } else { echo "a href=\"?mod=users_edit&id=".$arsql['id']."\""; } ?> class="c-dropdown__item dropdown-item p-1 pl-2">Изменить</<?php if ($GLOBALS['user']['status']<3 and $arsql['lockstatus']=="1") { echo "span"; } else { echo "a"; } ?>>
											<?php } ?>
											<?php if ($GLOBALS['user']['status']>=3) { ?>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
											<a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" этого пользователя" href="?mod=users_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
											<?php } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="6" class="c-table__cell text-center">Пользователей не найдено</td>
							</tr>
						<?php } ?>
                        </tbody>
                    </table>
					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    



			
					<?php }elseif($mod=="followers_list") { 
					
						$ftypes=array();
							$query="SELECT id,name FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `status`='1';";
							$str = mysqlq($query);
							$arsql=mysql_fetch_assoc($str);
							$numrows=mysql_num_rows($str);	
							if ($numrows>0) {
								do {
									$ftypes[$arsql['id']]=$arsql['name'];
								}while($arsql=mysql_fetch_assoc($str));
							}
							
					$searchsql="";
					$link=array();
					$link[]="?mod=followers_list";
					
					
					if (array_key_exists($_GET['type'], $ftypes)) {
						$searchsql.=" and `role`='".sql($_GET['type'])."'"; 
						$link[]="type=".$_GET['type'];
					}
					
					if (in_array($_GET['status'], array("1", "3"))) {
						if ($_GET['status']=="1") {
							$searchsql.=" and `datetime`>='".(time()-432000)."'"; 
						}else{
							$searchsql.=" and `datetime`<'".(time()-432000)."'"; 
						}						
						$link[]="status=".$_GET['status'];
					}

					if (mb_strlen($_GET['name'])>0) {
						$searchsql.=" and CONCAT(`email`, `name`, `company`, `phone`, `public_phone`, `public_name`, `public_email`) LIKE '%".sql($_GET['name'])."%'"; 
						$link[]="name=".$_GET['name'];
					}
					
					
					
					
					$quoten=10;

						$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`>0".$searchsql." ORDER BY `blocked`, `name`, `id`";
						// echo $query;
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$total=mysql_num_rows($str);

						if ($_GET['pg'] and is_numeric($_GET['pg']) and $_GET['pg']>0 and $_GET['pg']==round($_GET['pg'])) { $pg=$_GET['pg']; } else { $pg=1; }
						
						if (($total%$quoten)==0) { $correct=0; } else {$correct=1;}
						$pages=mod($total, $quoten)+$correct;

						if ($pg>$pages) { $pg=$pages; }

						if (!$pg or (($pg%1)>0)) { $pg=1; }
						$start=($pg-1)*$quoten;
					
					
					
					
					
					
					
					
					
					?>

            <div class="container">
				<div class="ml-0 mr-0 mb-2 text-right">
					<a href="?mod=followers_add" class="btn btn-sm btn-success">Добавить аккаунт</a>
				</div>
                <div class="row ml-0 mr-0 mb-3" style="background-color: #F5F8FA; border: 1px solid #dee2e6;">
					<form method="get" class="w-100 row m-0 p-0"><input type="hidden" name="mod" value="followers_list"><input type="hidden" name="pg" value="1">
						<div class="col-12 col-sm-3 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="type">Тип</label>
                                <div class="col-12 pl-2 pr-2">
                                    <select id="type" name="type" class="form-control form-control-sm">
										<option value=""></option>
										<?php foreach ($ftypes as $kk=>$vv) { ?>
										<option value="<?php echo $kk; ?>"<?php if ($_GET['type']==$kk) { echo " SELECTED"; } ?>><?php echo d($vv); ?></option>
										<?php } ?>
									</select>	
								</div>
                            </div>
						</div>
						<div class="col-12 col-sm-3 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="status">Статус</label>
                                <div class="col-12 pl-2 pr-2">
                                    <select id="status" name="status" class="form-control form-control-sm">
										<option value=""></option>
										<option value="1"<?php if ($_GET['status']=="1") { echo " SELECTED"; } ?>>В сети</option>
										<option value="3"<?php if ($_GET['status']=="3") { echo " SELECTED"; } ?>>Не в сети</option>
									</select>	
								</div>
                            </div>
						</div>
						<div class="col-12 col-sm-6 m-0 p-0">
                            <div class="form-group row ml-0 mr-0 mb-0">
                                <label class="col-form-label-sm col-12 mb-0 pl-2 pr-2" for="name">Текст</label>
                                <div class="col-12 pl-2 pr-2">
                                    <input type="text" id="name" name="name" class="form-control form-control-sm" value="<?php if (mb_strlen($_GET['name'])>0) { $dataname=addslashes($_GET['name']); echo $dataname; } else { $dataname=""; } ?>">
								</div>
                            </div>
						</div>
						<div class="col-12 p-0">
                            <div class="form-group row ml-0 mr-0 form-actions text-right mt-2 mb-2">
                                <div class="col-12 pl-2 pr-2">
									<span id="logstotal" class="btn btn-sm btn-default pull-left pl-0"><?php if ($total>0) { ?><?php echo $total; ?> зап., <?php echo $pg; ?>/<?php echo $pages; ?> стр.<?php } else { ?>Записей не найдено<?php } ?></span>
                                    <input type="submit" class="btn btn-sm btn-success" value="Применить">
                                </div>
                            </div>
						</div>
                    </form>
					
					
					
					
                </div><!-- // .row -->
                <div class="row ml-0 mr-0">
					<form method="post" class="w-100">
					<table id="maintable" class="c-table table-bordered table-hover">


                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                              <th class="c-table__cell c-table__cell--head p-0 text-center">&nbsp;</th>
                              <th class="c-table__cell c-table__cell--head p-1 text-center">Аккаунт</th>
                              <th class="c-table__cell c-table__cell--head p-1 d-none d-md-table-cell text-center">Public</th>
                              <th class="c-table__cell c-table__cell--head p-1 text-center">Тип</th>
                              <th class="c-table__cell c-table__cell--head p-1 text-center">&nbsp;</th>
							  <th class="c-table__cell c-table__cell--head p-0 text-center">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
						
						<?php

						
						$maxid=0;
						// $query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `del`='0' ORDER BY `blocked`, `name`, `id`;";
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `id`>0".$searchsql." ORDER BY `blocked`, `name`, `id` LIMIT ".$start.", ".$quoten.";";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
						do {
						?>
										
                            <tr class="c-table__row">
                                <td class="c-table__cell p-1 text-center">
									<?php if ($arsql['datetime']>=(time()-432000)) { echo "<div class=\"admin_comment_green\">Онлайн</div>"; } else { echo "<div class=\"admin_comment_red\">Не&nbsp;в&nbsp;сети</div>"; } ?>
								</td>
								
                                <td class="c-table__cell p-1 text-center">
									<b><?php $br=0; echo d($arsql['email']); $br=1; ?></b>
									<?php if (mb_strlen($arsql['name'])>0) { if ($br==1) { echo "<br>"; } echo d($arsql['name']); $br=1; } ?>
									<?php if (mb_strlen($arsql['company'])>0) { if ($br==1) { echo "<br>"; } echo d($arsql['company']); } ?>
									<?php if (mb_strlen($arsql['phone'])>0) { if ($br==1) { echo "<br>"; } echo d($arsql['phone']); } ?>
                                </td>
                                <td class="c-table__cell p-1 d-none d-md-table-cell text-center">
									<?php if (mb_strlen($arsql['public_email'].$arsql['public_phone'].$arsql['public_name'])==0) { echo d("Не указаны"); } else { echo implode("<br>", array_filter(array("<b>".d($arsql['public_email'])."</b>",d($arsql['public_phone']),d($arsql['public_name'])))); } ?>
                                </td>
                                <td class="c-table__cell p-1 text-center">
								    <?php echo d($ftypes[$arsql['role']]); ?>
                                </td>

                                <td class="c-table__cell p-1 text-center">
								    <select class="form-control form-control-sm user-blocked user-blocked<?php echo $arsql['id']; ?>" data-id="<?php echo $arsql['id']; ?>">
										<option value="0"<?php if ($arsql['blocked']==0) { echo " SELECTED"; } ?>>Активен</option>
										<option value="1"<?php if ($arsql['blocked']==1) { echo " SELECTED"; } ?>>Заблокирован</option>
									</select>
                                </td>
							
                                <td class="c-table__cell p-1 text-center">
                                    <div class="c-dropdown dropdown">
                                        <button class="btn btn-sm p-1 w-100 btn-secondary has-dropdown dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars u-mr-xsmall"></i></button>
                                        
                                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
											<?php if ($GLOBALS['user']['status']>=2) { ?>
											<<?php if ($GLOBALS['user']['status']<3 and $arsql['lockstatus']=="1") { echo "span"; } else { echo "a href=\"?mod=followers_edit&id=".$arsql['id']."\""; } ?> class="c-dropdown__item dropdown-item p-1 pl-2">Изменить</<?php if ($GLOBALS['user']['status']<3 and $arsql['lockstatus']=="1") { echo "span"; } else { echo "a"; } ?>>
											<?php } ?>
											<?php if ($GLOBALS['user']['status']>=3) { ?>
											<div class="dropdown-divider m-0 mt-1 mb-1"></div>
											<a class="confirm c-dropdown__item dropdown-item p-1 pl-2" data-text=" этого аккаунта" href="?mod=followers_delete&id=<?php echo $arsql['id']; ?>">Удалить</a>
											<?php } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
						<?php } while ($arsql=mysql_fetch_assoc($str)); ?> 
						<?php }else{ ?>
                            <tr>
                                <td colspan="6" class="c-table__cell text-center">Аккаунты не найдены</td>
							</tr>
						<?php } ?>
                        </tbody>
                    </table>
						<?php
						$link=implode("&", $link);
						?>
					<table class="c-table">
                        <tbody>
                            <tr>
                                <td class="c-table__cell text-center">
									<?php 
																	
									echo pages($link, $pg, $pages); ?>
								</td>
							</tr>
                        </tbody>
                    </table>
					
					</form>
					






                </div><!-- // .row -->
            </div><!-- // .container -->    



			

					<?php }elseif ($mod=="profile") { ?>
					
            <div class="container">
                <div class="row ml-0 mr-0">
					<form method="post" enctype="multipart/form-data" class="w-100"><input type="hidden" name="sce" value="profile">
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-id">ID аккаунта</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-control-sm" value="<?php echo d($GLOBALS['user']['id']); ?>" disabled="disabled">
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-login">Логин</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-control-sm" value="<?php echo d($GLOBALS['user']['login']); ?>" disabled="disabled">
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Фото профиля</label>
                                <?php if (mb_strlen($GLOBALS['user']['photo'])>4 and file_exists("upload/profiles/".$GLOBALS['user']['photo'])) { ?>
								<div class="col-sm-12">
                                    <a data-fancybox="gallery" href="upload/profiles/<?php echo d($GLOBALS['user']['photo']); ?>">
										<img src="upload/profiles/<?php echo d($GLOBALS['user']['photo']); ?>" style="max-width: 80px; max-height: 80px;">
									</a>
                                </div>
								<label class="col-form-label-sm col-sm-12 mb-0" for="input-file"><input type="checkbox" name="photo-del" class="" value="1"> — удалить фото профиля</label>
								<?php } ?>
                                <div class="col-sm-12">
                                    <input type="file" id="input-file" name="input-file" class="form-control form-control-sm">
                                </div>
								<label class="col-form-label-sm col-sm-12 mb-0" for="input-file">Файл JPG, не более 1Мб</label>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Доступ</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-control-sm" value="<?php 

										if ($GLOBALS['user']['status']==0) { echo "Просмотр"; }
										elseif ($GLOBALS['user']['status']==1) { echo "Пользователь"; }
										elseif ($GLOBALS['user']['status']==2) { echo "Администратор"; }
										elseif ($GLOBALS['user']['status']==3) { echo "Суперадмин"; }
										else { echo "&nbsp;"; }
									?>" disabled="disabled">
                                </div>
                            </div>
							<div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-name">Фамилия, имя, отчество</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-name" name="input-name" class="form-control form-control-sm" value="<?php echo d($GLOBALS['user']['name']); ?>">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-phone">Телефон</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-phone" name="input-phone" class="form-control form-control-sm" value="<?php echo d($GLOBALS['user']['phone']); ?>">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-email">E-mail</label>
                                <div class="col-sm-12">
                                    <input type="text" id="input-email" name="input-email" class="form-control form-control-sm" value="<?php echo d($GLOBALS['user']['email']); ?>">
                                </div>
                            </div>
							
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-pass">Смена пароля</label>
                                <div class="col-sm-12">
                                    <input type="password" id="input-pass" name="input-pass" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="form-group row ml-0 mr-0">
                                <label class="col-form-label-sm col-sm-12 mb-0" for="input-pass2">Подтверждение пароля</label>
                                <div class="col-sm-12">
                                    <input type="password" id="input-pass2" name="input-pass2" class="form-control form-control-sm" value="">
                                </div>
                            </div>
							
                            <div class="form-group row ml-0 mr-0 form-actions">
                                <div class="col-sm-10 col-sm-offset-2">
									<input type="submit" class="btn btn-sm btn-success" value="Сохранить">
									<a href="?mod=logs_list" class="btn btn-sm btn-danger">Отменить</a>
                                </div>
                            </div>
                    </form>
					







                </div><!-- // .row -->
            </div><!-- // .container -->    

		

					<?php } ?>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					

        </main>
        

        <script src="js/main.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootbox.min.js"></script>
		<script src="js/jquery.fancybox.min.js"></script>
		<script src="js/datepicker.crm.js"></script>
		<script src="summernote/summernote-bs4.mod.js"></script>
		<script src="summernote/summernote-bs4-upload.mod.js"></script>
		<script src="summernote/lang/summernote-ru-RU.min.js"></script>
	
		<script type="text/javascript">
		
		function escapeHtml(text) {
		  var map = {
			'&': '&amp;',
			'<': '&lt;',
			'>': '&gt;',
			'"': '&quot;',
			"'": '&#039;'
		  };

		  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
		}
		
		$(document).on('click', '.confirm', function(event){
			event.preventDefault();
			var currentLink = $(this);
			bootbox.confirm({
				title: "Подтвердите удаление",
				message: "Вы уверены, что хотите удалить"+currentLink.attr('data-text')+"?",
				buttons: {
					confirm: {
						label: 'Да',
						className: 'btn-success'
					},
					cancel: {
						label: 'Нет',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result) { window.location.href = currentLink.attr('href'); }
				}
			});
		});
		
		$(document).ready(function(){
			$(".alert-delay-hide").delay(4000).slideUp(200, function() {
				$(this).alert('close');
			});
			$('.summernote').summernote({
				placeholder: '',
				lang: 'ru-RU',
				tabsize: 2,
				height: 500
			});
			 
			$(".btn-slug").on('click', function(){
				event.preventDefault();
				
				var slugbtn = $(this);
				
				$('#'+$(this).attr('data-id')).attr('disabled', 'disabled');
				$(this).attr('disabled', 'disabled');
				
				$.ajax({
				type: 'POST',
				url: '',
				data: 'sce=ajax_functions_slug&table='+$(this).attr('data-table')+'&edit='+$(this).attr('data-edit')+'&type='+$(this).attr('data-type')+'&name='+encodeURI($('#'+$(this).attr('data-from')).val()),
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#'+slugbtn.attr('data-id')).val(jsondata.slug).removeAttr('disabled');
						slugbtn.removeAttr('disabled');
					}
				}
				});
			});
			
	  
		});
		
<?php if ($mod=="followers_edit") { ?>	


		$(document).on('click', '.confirmation', function(event){
			event.preventDefault();
			var currentLink = $(this);
			bootbox.confirm({
				title: currentLink.attr('data-title'),
				message: currentLink.attr('data-message'),
				buttons: {
					confirm: {
						label: 'Да',
						className: 'btn-success'
					},
					cancel: {
						label: 'Нет',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result) { window.location.href = currentLink.attr('href'); }
				}
			});
		});	




<?php } ?>

<?php if ($mod=="items_add") { ?>

function type_check()
{
	$('#input-type').attr('disabled', 'disabled');
	$('#input-catalog').attr('disabled', 'disabled');
		$.ajax({
		type: 'POST',
		url: '',
		data: 'sce=ajax_items_list1&type='+$('#input-type').val(),
		dataType: 'json',
		success: function(jsondata){
			if (jsondata.result=='1') {
				$('#input-catalog').html(jsondata.html).removeAttr('disabled'); 
				$('#input-type').removeAttr('disabled'); 
			}
		}
	});
}

function region_check()
{
$('#input-list1, #input-list2, #input-list3').attr('disabled', 'disabled');
	$.ajax({
		type: 'POST',
		url: '',
		data: 'sce=ajax_items_list2&list1='+$('#input-list1').val()+'&list2='+$('#input-list2').val()+'&list3='+$('#input-list3').val(),
		dataType: 'json',
		success: function(jsondata){
			if (jsondata.result=='1') {
				$('#input-list1').html(jsondata.list1).val(jsondata.val1);
				$('#input-list2').html(jsondata.list2).val(jsondata.val2);
				$('#input-list3').html(jsondata.list3).val(jsondata.val3);
			
				if (jsondata.hide2=='1') {
					$('#input-list2').hide();
				}else{
					$('#input-list2').show();
				}
				if (jsondata.hide3=='1') {
					$('#input-list3').hide();
				}else{
					$('#input-list3').show();
				}
				$('#input-list1, #input-list2, #input-list3').removeAttr('disabled');
			}
		},
	});
}

function price_check()
{
	if ($('#price-type').val()>3) {
		$('#price,#price-cur').hide();
	}else{
		$('#price,#price-cur').show();
	}
}

$(document).ready(function(){
	type_check();
	region_check();
	price_check();
	$('#price-type').on('change', function(){
		price_check();
	});
	$('#input-type').on('change', function(){
		type_check();
	});
	$('#input-list1, #input-list2, #input-list3').on('change', function(){
		region_check();
	});
});





<?php } ?>
<?php if ($mod=="items_edit") { ?>

function type_check()
{
	$('#input-type').attr('disabled', 'disabled');
	$('#input-catalog').attr('disabled', 'disabled');
		$.ajax({
		type: 'POST',
		url: '',
		data: 'sce=ajax_items_list1&type='+$('#input-type').val()+'&id='+$('#input-catalog').attr('data-id'),
		dataType: 'json',
		success: function(jsondata){
			if (jsondata.result=='1') {
				$('#input-catalog').html(jsondata.html).removeAttr('disabled'); 
				$('#input-type').removeAttr('disabled'); 
			}
		}
	});
}

function multiedit_check()
{
		$.ajax({
		type: 'POST',
		url: '',
		data: 'sce=ajax_items_multicheck&id=<?php echo $page['id']; ?>',
		dataType: 'json',
		success: function(jsondata){
			if (jsondata.result=='1') {
					$('.multiedit').remove();
				if (jsondata.html!='') {
					$('form').prepend(jsondata.html);
				}
			}
		}
	});
}

function region_check()
{
$('#input-list1, #input-list2, #input-list3').attr('disabled', 'disabled');
	$.ajax({
		type: 'POST',
		url: '',
		data: 'sce=ajax_items_list2&list1='+$('#input-list1').val()+'&list2='+$('#input-list2').val()+'&list3='+$('#input-list3').val()+'&id='+$('#input-list1').attr('data-id'),
		dataType: 'json',
		success: function(jsondata){
			if (jsondata.result=='1') {
				// alert(jsondata.q);
				$('#input-list1').html(jsondata.list1).val(jsondata.val1);
				$('#input-list2').html(jsondata.list2).val(jsondata.val2);
				$('#input-list3').html(jsondata.list3).val(jsondata.val3);
			
				if (jsondata.hide2=='1') {
					$('#input-list2').hide();
				}else{
					$('#input-list2').show();
				}
				if (jsondata.hide3=='1') {
					$('#input-list3').hide();
				}else{
					$('#input-list3').show();
				}
				$('#input-list1, #input-list2, #input-list3').removeAttr('disabled');
			}
		},
	});
}

function price_check()
{
	if ($('#price-type').val()>3) {
		$('#price,#price-cur').hide();
	}else{
		$('#price,#price-cur').show();
	}
}

$(document).ready(function(){
	type_check();
	region_check();
	price_check();
	multiedit_check();
	$('#price-type').on('change', function(){
		price_check();
	});
	$('#input-type').on('change', function(){
		type_check();
	});
	$('#input-list1, #input-list2, #input-list3').on('change', function(){
		region_check();
	});
});

setTimeout(multiedit_check, 30000);



<?php } ?>
<?php if ($mod=="text_add" || $mod=="text_edit") { ?>

function type_check()
{
	if($('#input-type').val()=='1'){
		$('#date-at').parent().parent().hide();
		$('#input-name').parent().parent().hide();
		$('#input-value').parent().parent().hide();
	}else{
		$('#date-at').parent().parent().show();
		$('#input-name').parent().parent().show();
		$('#input-value').parent().parent().show();
	}
}

$(document).ready(function(){
	type_check();
	$('#input-type').on('change', function(){
		type_check();
	});
});


<?php } ?>

<?php if ($mod=="pages_list") { ?>


$(document).ready(function(){
			$('.positionpages').on('change', function(){
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_pages_position&id='+$(this).attr('data-id')+'&value='+$(this).val(),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#pos'+jsondata.id).html(jsondata.value).removeAttr('disabled'); 
						}
					}
					});
			});
			
			$('.changestatuspages').on('click', function(){
					event.preventDefault();
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_changestatuspages&id='+$(this).attr('data-id'),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#statuspages'+jsondata.id).removeClass('btn-success').removeClass('btn-danger').addClass(jsondata.status).html(jsondata.html).removeAttr('disabled'); 
						}else{
							$('#statuspages'+jsondata.id).removeAttr('disabled'); 
						}
					}
					});
			});
			

});

<?php } ?>

<?php if ($mod=="items_list") { ?>


$(document).ready(function(){
			
			$('.changestatusitems').on('click', function(){
					event.preventDefault();
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_changestatusitems&id='+$(this).attr('data-id'),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#statusitems'+jsondata.id).removeClass('btn-success').removeClass('btn-warning').removeClass('btn-danger').addClass(jsondata.status).html(jsondata.html).removeAttr('disabled'); 
						}else{
							$('#statusitems'+jsondata.id).removeAttr('disabled'); 
						}
					}
					});
			});
			

});

<?php } ?>

<?php if ($mod=="catalog_list") { ?>


$(document).ready(function(){
			$('.positioncatalog').on('change', function(){
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_catalog_position&id='+$(this).attr('data-id')+'&value='+$(this).val(),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#pos'+jsondata.id).html(jsondata.value).removeAttr('disabled'); 
						}
					}
					});
			});
			
			$('.changestatuscatalog').on('click', function(){
					event.preventDefault();
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_changestatuscatalog&type='+$(this).attr('data-type')+'&id='+$(this).attr('data-id'),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#statuscatalog'+jsondata.type+jsondata.id).removeClass('btn-success').removeClass('btn-danger').addClass(jsondata.status).removeAttr('disabled'); 
						}else{
							$('#statuscatalog'+jsondata.type+jsondata.id).removeAttr('disabled'); 
						}
					}
					});
			});
			

});

<?php } ?>

<?php if ($mod=="pages_add" || $mod=="pages_edit") { ?>

function type_check()
{
	if($('#input-type').val()=='1'){
		
		$('#input-html').parent().parent().hide();
		$('#input-html-en').parent().parent().hide();
		$('#input-html-cn').parent().parent().hide();
		$('#input-position').parent().parent().hide();
		
		$('#input-slug').parent().parent().hide();
		$('#input-title').parent().parent().hide();
		$('#input-desc').parent().parent().hide();
		$('#input-keyw').parent().parent().hide();
		
		$('#input-slug-en').parent().parent().hide();
		$('#input-title-en').parent().parent().hide();
		$('#input-desc-en').parent().parent().hide();
		$('#input-keyw-en').parent().parent().hide();
		
		$('#input-slug-cn').parent().parent().hide();
		$('#input-title-cn').parent().parent().hide();
		$('#input-desc-cn').parent().parent().hide();
		$('#input-keyw-cn').parent().parent().hide();
		

	}else{
		
		$('#input-html').parent().parent().show();
		$('#input-html-en').parent().parent().show();
		$('#input-html-cn').parent().parent().show();
		$('#input-position').parent().parent().show();
		
		$('#input-slug').parent().parent().show();
		$('#input-title').parent().parent().show();
		$('#input-desc').parent().parent().show();
		$('#input-keyw').parent().parent().show();
		
		$('#input-slug-en').parent().parent().show();
		$('#input-title-en').parent().parent().show();
		$('#input-desc-en').parent().parent().show();
		$('#input-keyw-en').parent().parent().show();
		
		$('#input-slug-cn').parent().parent().show();
		$('#input-title-cn').parent().parent().show();
		$('#input-desc-cn').parent().parent().show();
		$('#input-keyw-cn').parent().parent().show();
	}
}

$(document).ready(function(){
	type_check();
	$('#input-type').on('change', function(){
		type_check();
	});
});


<?php } ?>


<?php if ($mod=="topmenu_list") { ?>


$(document).ready(function(){
			$('.positiontopmenu').on('change', function(){
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_topmenu_position&id='+$(this).attr('data-id')+'&value='+$(this).val(),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#pos'+jsondata.id).html(jsondata.value).removeAttr('disabled'); 
						}
					}
					});
			});
			
			$('.changestatustopmenu').on('click', function(){
					event.preventDefault();
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_changestatustopmenu&id='+$(this).attr('data-id'),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#statustopmenu'+jsondata.id).removeClass('btn-success').removeClass('btn-danger').addClass(jsondata.status).html(jsondata.html).removeAttr('disabled'); 
						}else{
							$('#statustopmenu'+jsondata.id).removeAttr('disabled'); 
						}
					}
					});
			});
			

});

<?php } ?>



<?php if ($mod=="topmenu_add" || $mod=="topmenu_edit") { ?>

function type_check()
{
	if($('#input-type').val()=='1'){
		
		$('#input-blank').parent().parent().hide();

	}else{
		
		$('#input-blank').parent().parent().show();
	}
}

$(document).ready(function(){
	type_check();
	$('#input-type').on('change', function(){
		type_check();
	});
});


<?php } ?>


<?php if ($mod=="users_list") { ?>

		$('.user-status, .user-blocked').on('change', function(){
			var id=$(this).attr('data-id');
			if ($(this).hasClass('user-status')){
				var cl='status';
				var msg='Вы уверены, что хотите изменить уровень доступа на «'+$(this).find("option:selected").text()+'»?'
			}else{
				var cl='blocked';
				var msg='Вы уверены, что хотите изменить статус на «'+$(this).find("option:selected").text()+'»?'
			}
			
			
			
			bootbox.confirm({
				title: "Подтвердите изменение",
				message: msg,
				buttons: {
					confirm: {
						label: 'Да',
						className: 'btn-success'
					},
					cancel: {
						label: 'Нет',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result) { 
						$('.user-'+cl+id).attr('disabled', 'disabled');
						$.ajax({
						type: 'POST',
						url: '/',
						data: 'sce=ajax_users_update&type='+cl+'&'+cl+'='+$('.user-'+cl+id).val()+'&id='+id,
						dataType: 'json',
						success: function(jsondata){
							if (jsondata.result=='1') {
								console.log(jsondata.result);
								console.log('===>1'+jsondata.st);
								if (cl=='status'){
									$('.user-status'+id).val(jsondata.st).removeAttr('disabled');
									console.log('===>1'+jsondata.st);
								}else{
									$('.user-blocked'+id).val(jsondata.bl).removeAttr('disabled');
									console.log('===>2'+jsondata.bl);
								}
							}
						}
						});
					}
				}
			});
			
			

			
		});


<?php } ?>

<?php if ($mod=="followers_list") { ?>

		$('.user-status, .user-blocked').on('change', function(){
			var id=$(this).attr('data-id');
			if ($(this).hasClass('user-status')){
				var cl='status';
				var msg='Вы уверены, что хотите изменить уровень доступа на «'+$(this).find("option:selected").text()+'»?'
			}else{
				var cl='blocked';
				var msg='Вы уверены, что хотите изменить статус на «'+$(this).find("option:selected").text()+'»?'
			}
			
			
			
			bootbox.confirm({
				title: "Подтвердите изменение",
				message: msg,
				buttons: {
					confirm: {
						label: 'Да',
						className: 'btn-success'
					},
					cancel: {
						label: 'Нет',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result) { 
						$('.user-'+cl+id).attr('disabled', 'disabled');
						$.ajax({
						type: 'POST',
						url: '/',
						data: 'sce=ajax_followers_update&type='+cl+'&'+cl+'='+$('.user-'+cl+id).val()+'&id='+id,
						dataType: 'json',
						success: function(jsondata){
							if (jsondata.result=='1') {
								console.log(jsondata.result);
								console.log('===>1'+jsondata.st);
								if (cl=='status'){
									$('.user-status'+id).val(jsondata.st).removeAttr('disabled');
									console.log('===>1'+jsondata.st);
								}else{
									$('.user-blocked'+id).val(jsondata.bl).removeAttr('disabled');
									console.log('===>2'+jsondata.bl);
								}
							}
						}
						});
					}
				}
			});
			
			

			
		});


<?php } ?>



<?php if ($mod=="text_list") { ?>







		$(document).ready(function(){

			$('.datepicker-here').each(function(){
				if($(this).attr('data-value')!==undefined) {
					$(this).data('datepicker').selectDate(new Date(Number($(this).attr('data-value'))));
				}else{
					$(this).data('datepicker');	
				}
			});
						
			$('.datepicker-here').datepicker({
				onHide: function() {
					var sh=0;
					$('.datepicker').each(function(){
						if ($(this).css('left')!=='-100000px'){
							sh = 1;
						}
					});
					if(sh==0){
						$('.datepicker-here').each(function(){
							if($(this).attr('data-value-value')!==$(this).val())
							{
								$(this).attr('disabled', 'disabled');
								$.ajax({
								type: 'POST',
								url: '/',
								data: 'sce=ajax_text_dp&id='+$(this).attr('data-id')+'&dateto='+$(this).val(),
								dataType: 'json',
								success: function(jsondata){
									if (jsondata.result=='1') {
										if (jsondata.dataraw!==0){
											$('#textdateto'+jsondata.id).attr('data-value-value', jsondata.datavaluevalue).attr('data-value', jsondata.dataraw).data('datepicker').selectDate(new Date(Number($('#textdateto'+jsondata.id).attr('data-value'))));
											$('#textdateto'+jsondata.id).removeAttr('disabled'); 
										}else{
											$('#textdateto'+jsondata.id).parent().html('&nbsp;');
										}
									}
								}
								});
							}
						});
						
					}
				}
			});
			
			$('.datepicker-here').on('change', function(){
				if($(this).attr('data-value-value')!==$(this).val())
				{
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '/',
					data: 'sce=ajax_text_dp&id='+$(this).attr('data-id')+'&dateto='+$(this).val(),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							if (jsondata.dataraw!==0){
								$('#textdateto'+jsondata.id).attr('data-value-value', jsondata.datavaluevalue).attr('data-value', jsondata.dataraw).data('datepicker').selectDate(new Date(Number($('#textdateto'+jsondata.id).attr('data-value'))));
								$('#textdateto'+jsondata.id).removeAttr('disabled'); 

							}else{
								$('#textdateto'+jsondata.id).parent().html('&nbsp;');
							}
						}
					}
					});
				}
			});
			
			$('.textvalue').on('change', function(){
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_text&id='+$(this).attr('data-id')+'&value='+$(this).val(),
					dataType: 'json',
					success: function(jsondata){

						if (jsondata.result=='1') {
							$('#textvalue'+jsondata.id).html(jsondata.value).removeAttr('disabled'); 
						}
					}
					});
			});
			

		
		});
			

<?php } ?>

























<?php if ($mod=="news_list") { ?>







		$(document).ready(function(){


			$('.changestatusnews').on('click', function(){
					event.preventDefault();
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_changestatusnews&id='+$(this).attr('data-id'),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#statusnews'+jsondata.id).removeClass('btn-success').removeClass('btn-danger').addClass(jsondata.status).html(jsondata.html).removeAttr('disabled'); 
						}else{
							$('#statusnews'+jsondata.id).removeAttr('disabled'); 
						}
					}
					});
			});
			

		
		});
			

<?php } ?>



<?php if ($mod=="slides_list") { ?>







		$(document).ready(function(){


			$('.positionslides').on('change', function(){
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_slides_position&id='+$(this).attr('data-id')+'&value='+$(this).val(),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#pos'+jsondata.id).html(jsondata.value).removeAttr('disabled'); 
						}
					}
					});
			});
			
			$('.changestatusslides').on('click', function(){
					event.preventDefault();
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_changestatusslides&id='+$(this).attr('data-id'),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#statusslides'+jsondata.id).removeClass('btn-success').removeClass('btn-danger').addClass(jsondata.status).html(jsondata.html).removeAttr('disabled'); 
						}else{
							$('#statusslides'+jsondata.id).removeAttr('disabled'); 
						}
					}
					});
			});
			

		
		});
			

<?php } ?>


<?php if ($mod=="partners_list") { ?>







		$(document).ready(function(){


			$('.positionpartners').on('change', function(){
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_partners_position&id='+$(this).attr('data-id')+'&value='+$(this).val(),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#pos'+jsondata.id).html(jsondata.value).removeAttr('disabled'); 
						}
					}
					});
			});
			

			$('.changestatuspartners').on('click', function(){
					event.preventDefault();
					$(this).attr('disabled', 'disabled');
					$.ajax({
					type: 'POST',
					url: '',
					data: 'sce=ajax_changestatuspartners&id='+$(this).attr('data-id'),
					dataType: 'json',
					success: function(jsondata){
						if (jsondata.result=='1') {
							$('#statuspartners'+jsondata.id).removeClass('btn-success').removeClass('btn-danger').addClass(jsondata.status).html(jsondata.html).removeAttr('disabled'); 
						}else{
							$('#statuspartners'+jsondata.id).removeAttr('disabled'); 
						}
					}
					});
			});
			
			
			

		
		});
			

<?php } ?>







</script>
<audio id="bulk" preload="auto">
	<source src="bulk.ogg" type="audio/ogg">
</audio>
    </body>
</html><?php
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."alerts` SET `read`='1' WHERE `user`>0 and `user`='".sql($GLOBALS['user']['id'])."'");

?>