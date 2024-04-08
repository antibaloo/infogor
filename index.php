<?php


require_once(str_replace('\\\\','/',dirname(__FILE__)).'/bd.php');
require_once(str_replace('\\\\','/',dirname(__FILE__)).'/functions.php');
require_once(str_replace('\\\\','/',dirname(__FILE__)).'/auth.php');
require_once(str_replace('\\\\','/',dirname(__FILE__)).'/auth_functions.php');









if (!in_array($_COOKIE['lang'], array("ru", "en", "cn"))) {
	setcookie("lang", "ru", time()+$GLOBALS['auth']['uptime'], "/");
	$GLOBALS['user']['lang']="ru";
}elseif(!in_array($GLOBALS['user']['lang'], array("ru", "en", "cn"))){
	setcookie("lang", $_COOKIE['lang'], time()+$GLOBALS['auth']['uptime'], "/");
	$GLOBALS['user']['lang']=$_COOKIE['lang'];
}


$now=time();
if ($now>mktime(20,0,0,date("n"),date("d"),date("Y")) and $now>text("telegram_stat")['value']) {

$query="SELECT count(id) as rn FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `stamp`>'".sql(mktime(20,0,0,date("n"),date("d")-1,date("Y")))."' and `stamp`<'".sql(mktime(19,59,59,date("n"),date("d"),date("Y")))."';";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);

$query2="SELECT count(id) as rn FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `regdate`>'".sql(mktime(20,0,0,date("n"),date("d")-1,date("Y")))."' and `regdate`<'".sql(mktime(19,59,59,date("n"),date("d"),date("Y")))."';";
$str2 = mysqlq($query2);
$arsql2=mysql_fetch_assoc($str2);

$query3="SELECT count(id) as rn FROM `".sql($GLOBALS['config']['bd_prefix'])."items_stat` WHERE `stamp`>'".sql(mktime(20,0,0,date("n"),date("d")-1,date("Y")))."';";
$str3 = mysqlq($query3);
$arsql3=mysql_fetch_assoc($str3);

$telegramtext="<b><u>‼️ Статистика за день:</u></b>\r\n▪️ Пользователей: ".d($arsql2['rn'])."\r\n▪️ Объявлений: ".d($arsql['rn'])."\r\n▪️ Просмотров: ".d($arsql3['rn']);


telegram_sendtext("-1001870312768", $telegramtext);
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."text` SET `value`='".sql(mktime(23,59,59,date("n"),date("d"),date("Y")))."' WHERE `name`='telegram_stat' LIMIT 1;");
}

if (in_array($_GET['lang'], array("ru", "en", "cn"))) {
	$GLOBALS['user']['lang']=$_GET['lang'];
}


if ($_POST['action']=="ajax_list") {
	
$val1=0;
$list1="";
$val2=0;
$list2="";
$val3=0;
$list3="";
$first1=0;
$first2=0;
$first3=0;
	
if (is_numeric($_POST['list1']) and $_POST['list1']>0) { $in1=$_POST['list1']; } else { $in1=145; }
if (is_numeric($_POST['list2']) and $_POST['list2']>0) { $in2=$_POST['list2']; } else { $in2=242; }
if (is_numeric($_POST['list3']) and $_POST['list3']>0) { $in3=$_POST['list3']; } else { $in3=319; }

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent`='0' and `status`='1' ORDER BY `name".langpx()."`;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {
$k=0;	
	do {
		$k++;
		if ($k==1) { $first1=$arsql['id']; }
		if ($in1==$arsql['id']) { $s=" SELECTED"; $val1=$arsql['id']; } else { $s=""; }
		$list1.="<option value=\"".d($arsql['id'])."\">".d($arsql['name'.langpx()])."</option>";
	}while($arsql=mysql_fetch_assoc($str));
}

if ($val1>0) {
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent`='".sql($val1)."' and `status`='1' ORDER BY `name".langpx()."`;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {
$k=0;		
	do {
		$k++;
		if ($k==1) { $first2=$arsql['id']; }
		if ($in2==$arsql['id']) { $s=" SELECTED"; $val2=$arsql['id']; } else { $s=""; }
		$list2.="<option value=\"".d($arsql['id'])."\">".d($arsql['name'.langpx()])."</option>";
	}while($arsql=mysql_fetch_assoc($str));
}
}

if ($val2>0) {
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent`='".sql($val2)."' and `status`='1' ORDER BY `name".langpx()."`;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {	
$k=0;	
	do {
		$k++;
		if ($k==1) { $first3=$arsql['id']; }
		if ($in3==$arsql['id']) { $s=" SELECTED"; $val3=$arsql['id']; } else { $s=""; }
		$list3.="<option value=\"".d($arsql['id'])."\">".d($arsql['name'.langpx()])."</option>";
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

if ($_POST['action']=="ajax_delete") {
	
if (!$GLOBALS['user']['id']>0 || !is_numeric($_POST['id'])) {
	echo json_encode(array("result" => "0"));
	exit;
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($_POST['id'])."' and `user`='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {			
	echo json_encode(array("result" => "0"));
	exit;
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($page['id'])."' and `type`='image';";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {
	do {
		if (file_exists("upload/items/".$arsql['file']) and mb_strlen($arsql['file'])>4) {
			$cache=cachename("upload/items/", $arsql['file']);
			if (file_exists("upload/items/cache/".$cache) and mb_strlen($cache)>4) {
				unlink("upload/items/cache/".$cache);
			}
			unlink("upload/items/".$arsql['file']);
		}
	
	}while($arsql=mysql_fetch_assoc($str));
	mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($page['id'])."' and `type`='image'");
}
mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."items_stat` WHERE `item`='".sql($page['id'])."'");
mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($page['id'])."'");

$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `user`='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
$str = mysqlq($query);
$numrows=mysql_num_rows($str);
if ($numrows==0) {			
	$refresh="1";
}else{
	$refresh="0";
}


	echo json_encode(array("result" => "1", "refresh" => $refresh));
	exit;
	
}



if ($_POST['action']=="ajax_edit_delete_photo") {
	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}	
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `id`='".sql($_POST['id'])."' and `type`='image' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {			
	echo json_encode(array("result" => "1", "id" => d($_POST['id'])));
	exit;
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($arsql['item'])."' and `user`='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {			
	echo json_encode(array("result" => "1", "id" => d($_POST['id'])));
	exit;
}

if (file_exists("upload/items/".$arsql['file']) and mb_strlen($arsql['file'])>4) {
	$cache=cachename("upload/items/", $arsql['file']);
	if (file_exists("upload/items/cache/".$cache) and mb_strlen($cache)>4) {
		unlink("upload/items/cache/".$cache);
	}
	unlink("upload/items/".$arsql['file']);
}
mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");

	echo json_encode(array("result" => "1", "id" => d($_POST['id'])));
	exit; 
	
}


if ($_POST['action']=="ajax_edit_show_photo") {
	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}

if (!is_numeric($_POST['id'])){
	echo json_encode(array("result" => "0"));
	exit;
}
	
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($_POST['id'])."' and `user`='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {			
	echo json_encode(array("result" => "0"));
	exit;
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($_POST['id'])."' and `type`='image' ORDER BY `position` DESC;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {
$arsql['position']=0;
}	

$files=restructureFilesArray($_FILES['file']);
$k=0;
$kk=0;
$total=$numrows;
	foreach($files as $file){
		
		if (mb_strlen($file['tmp_name'])>0) {
			if (checkimagef($file) and $total<10) {
					$fl=uploadf($file, "items");
				if (mb_strlen($fl)>4) {
					$kk++;
					mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."items_files` (`type`, `item`, `file`, `position`) VALUES ('image', '".sql($_POST['id'])."', '".sql($fl)."', '".sql($arsql['position']+$kk)."')");
					$total++;
				}else{
					
				}
			}else{
				
			}
		}
		$k++;
		
	} 


$html="";
$html.="<div class=\"image-uploader has-files s w-100\">";
$html.="<div class=\"uploaded sortable ui-sortable\">";



$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($_POST['id'])."' and `type`='image' ORDER BY `position`;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {			
	do {
		
		if (file_exists("upload/items/".$arsql['file']) and mb_strlen($arsql['file'])>4) {
		$html.="<div class=\"uploaded-image\" data-id=\"".d($arsql['id'])."\" data-index=\"0\" data-name=\""."/".imagecache("upload/items/", $arsql['file'])."\">";
		$html.="<img src=\""."/".imagecache("upload/items/", $arsql['file'])."\">";
		$html.="<button id=\"delete_photo".d($arsql['id'])."\" data-id=\"".d($arsql['id'])."\" class=\"delete-image\"><i class=\"fa fa-close\"></i></button>";
		$html.="</div>";
		}
	}while($arsql=mysql_fetch_assoc($str));
}


$html.="</div>";
$html.="</div>";

	echo json_encode(array("result" => "1", "html" => $html));
	exit;
	
}

if ($_POST['action']=="ajax_edit") {
	



	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}
$error=array();
		
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($_POST['id'])."' and `user`='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
$str = mysqlq($query);
$page=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {			
	echo json_encode(array("result" => "0"));
	exit;
}

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($page['catalog'])."' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {			
	echo json_encode(array("result" => "0"));
	exit;
}

if ($page['type']=="p" and $arsql['check_nb']=="1") {
	if ($_POST['nb']=="1") { $bu=1; } else { $bu=0; }
}else{
	$bu=$page['bu'];
}

if ($page['type']=="p" and $arsql['check_bp']=="1") {
	$bp=htmlr($_POST['bp']); 
}else{
	$bp=$page['bp'];
}





if (mb_strlen($_POST['name'])==0) { 
	$error['3']=1;
}else{
	$name=htmlr($_POST['name']); 
}


if (in_array($page['type'], array("p", "s"))) {
	if (!in_array($_POST['pricerange'], array("1", "2", "3", "4", "5"))) {
		$error['4']=1;
	}else{
		$pricerange=$_POST['pricerange'];
		if ($pricerange<4) {
			if (is_numeric($_POST['price']) || $_POST['price']>0) {
				$price=$_POST['price'];
				if (!in_array($_POST['pricecur'], array("1", "2", "3"))) {
					$error['4']=1;
				}else{
					$pricecur=$_POST['pricecur'];
					if ($pricecur=="1") {
						$price=ceil($price*100)/100;
					}
				}
			}else{
				$error['4']=1;
			}
		}	
	}
}
$text=htmlr($_POST['text']);
$text2=htmlr($_POST['text2']);
$video=htmlr($_POST['video']);

if (mb_strlen($video)>0) {
	if (!preg_match('~^(?:https?://)?(?:www[.])?(?:youtube[.]com/watch[?]v=|youtu[.]be/)([^&]{11})~x', $video, $matches)) {
		$error['5']=1;
	}
}

if (mb_strlen(implode("", $error))>0) {
	
	echo json_encode(array("result" => "1", "s" => "0", "error11" => $error['11'], "error12" => $error['12'], "error13" => $error['13'], "error2" => $error['2'], "error3" => $error['3'], "error4" => $error['4'], "error5" => $error['5']));
	exit;
	
}else{
	
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items` 
SET `name".retlang($page['lang'])."`='".sql($name)."', 
`bu`='".sql($bu)."', 
`bp".retlang($page['lang'])."`='".sql($bp)."', 
`price_type`='".sql($pricerange)."', 
`price`='".sql($price)."', 
`price_cur`='".sql($pricecur)."', 
`text".retlang($page['lang'])."`='".sql($text)."', 
`text2".retlang($page['lang'])."`='".sql($text2)."', 
`video`='".sql($video)."', 
`status`='2'
WHERE `id`='".sql($page['id'])."' LIMIT 1;");

$query="SELECT count(id) as rn FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `status`='2';";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);

$telegramtext="⚡️ <b>Объявление отредактировано и отправлено на модерацию.</b>\r\nВсего объявлений на модерации: ".$arsql['rn'];
telegram_sendtext("-1001870312768", $telegramtext);

$order=$_POST['order'];

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($page['id'])."' and `type`='image';";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows>0) {			
	do {
		if (is_numeric($order[$arsql['id']])){
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."items_files` SET `position`='".sql($order[$arsql['id']])."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
		}
	}while($arsql=mysql_fetch_assoc($str));
}


    $html="";
    $html.="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Объявление успешно изменено<br><br>После модерации оно будет немедленно опубликовано.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";

	
echo json_encode(array("result" => "1", "s" => "1", "html" => $html));

exit;
}
}






if ($_POST['action']=="ajax_add") {
	



	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}
$error=array();
		
if (!in_array($_POST['itemtype'], array("1", "2"))) {
	echo json_encode(array("result" => "0"));
	exit;
}else{
	$itemtype=$_POST['itemtype'];
}
if ($itemtype=="1") {
	$catalog=$_POST['radio_p'];
	$s="status_p";
	$itemtype="p";
}elseif($itemtype=="2") {
	$catalog=$_POST['radio_s'];
	$s="status_s";
	$itemtype="s";
}elseif($itemtype=="3") {
	$catalog=$_POST['radio_k'];
	$s="status_k";
	$itemtype="k";
}





if (!is_numeric($catalog) || $catalog<1) { $catalog=0; }

$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($catalog)."' and `".sql($s)."`='1' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);
if ($numrows==0) {	
	$error['11']=1; $error['12']=1; $error['13']=1;
}

if (haskids("catalog", $catalog, "`".sql($s)."`='1'")){
	$error['11']=1; $error['12']=1; $error['13']=1;
}

if ($arsql['check_nb']=="1" and $_POST['nb']=="1") { $bu=1; } else { $bu=0; }
if ($itemtype=="1" and $arsql['check_bp']=="1" and $_POST['bp']=="1") { $bp=htmlr($_POST['bp']); } else { $bp=""; }




if (is_numeric($_POST['list13'])) {
$list=$_POST['list13'];
}elseif(is_numeric($_POST['list12'])) {
$list=$_POST['list12'];
}elseif(is_numeric($_POST['list11'])) {
$list=$_POST['list11'];
}else{
	$error['2']=1;
}

$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `id`='".sql($list)."' and `type`='region' and `status`='1' LIMIT 1;";
$str = mysqlq($query);
$numrows=mysql_num_rows($str);
if ($numrows==0) {
	$error['2']=1;
}

if (haskids("lists", $list, "`type`='region'")){
	$error['2']=1;
}


if (mb_strlen($_POST['name'])==0) { 
	$error['3']=1;
}else{
	$name=htmlr($_POST['name']); 
}


if ($itemtype!="3") {
	if (!in_array($_POST['pricerange'], array("1", "2", "3", "4", "5"))) {
		$error['4']=1;
	}else{
		$pricerange=$_POST['pricerange'];
		if ($pricerange<4) {
			if (is_numeric($_POST['price']) and $_POST['price']>0) {
				$price=$_POST['price'];
				if (!in_array($_POST['pricecur'], array("1", "2", "3"))) {
					$error['4']=1;
				}else{
					$pricecur=$_POST['pricecur'];
					if ($pricecur=="1") {
						$price=ceil($price*100)/100;
					}
				}
			}else{
				$error['4']=1;
			}
		}	
	}
}
$text=htmlr($_POST['text']);
$text2=htmlr($_POST['text2']);
$video=htmlr($_POST['video']);

if (mb_strlen($video)>0) {
	if (!preg_match('~^(?:https?://)?(?:www[.])?(?:youtube[.]com/watch[?]v=|youtu[.]be/)([^&]{11})~x', $video, $matches)) {
		$error['5']=1;
	}
}

if (mb_strlen(implode("", $error))>0) {
	
	echo json_encode(array("result" => "1", "s" => "0", "error11" => $error['11'], "error12" => $error['12'], "error13" => $error['13'], "error2" => $error['2'], "error3" => $error['3'], "error4" => $error['4'], "error5" => $error['5']));
	exit;
	
}else{
	
$key=getkey("items");


mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."items` 
(`user`,
`ip`, 
`type`, 
`catalog`, 
`region`, 
`name".langpx()."`, 
`bu`, 
`bp".langpx()."`, 
`price_type`, 
`price`, 
`price_cur`, 
`text".langpx()."`, 
`text2".langpx()."`, 
`video`, 
`status`, 
`stamp`,
`key`,
`lang`) 
VALUES 
('".sql($GLOBALS['user']['id'])."', 
'".sql($GLOBALS['user']['ip'])."', 
'".sql($itemtype)."', 
'".sql($catalog)."', 
'".sql($list)."', 
'".sql($name)."', 
'".sql($bu)."', 
'".sql($bp)."', 
'".sql($pricerange)."', 
'".sql($price)."', 
'".sql($pricecur)."', 
'".sql($text)."', 
'".sql($text2)."', 
'".sql($video)."', 
'2', '".sql(time())."', '".sql($key)."', '".sql(langpx(""))."')");




$newid=putkey("items", $key);

if ($newid>0) {
$ords=$_POST['order'];
$files=restructureFilesArray($_FILES['file']);
$k=0;
$total=0;
	foreach($files as $file){
		
		if (mb_strlen($file['tmp_name'])>0) {
			if (checkimagef($file) and $total<10) {
				$fl=uploadf($file, "items");
				if (mb_strlen($fl)>4 and $ords[$k]!="") {
					mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."items_files` (`type`, `item`, `file`, `position`) VALUES ('image', '".sql($newid)."', '".sql($fl)."', '".sql($ords[$k])."')");
					$total++; $k++;
				}else{
					$k++; 
				}
			}else{
				$k++; 
			}
		}else{
			$k++;
		}
	} 
}


$query="SELECT count(id) as rn FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `status`='2';";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);

$telegramtext="⚡️ <b>Добавлено новое объявление на модерацию.</b>\r\nВсего объявлений на модерации: ".$arsql['rn'];
telegram_sendtext("-1001870312768", $telegramtext);


    $html="";
    $html.="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Объявление успешно добавлено<br><br>После модерации оно будет немедленно опубликовано.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";

	
echo json_encode(array("result" => "1", "s" => "1", "html" => $html));

exit;
}
}







if ($_GET['mod']=="en" and mb_strlen($_GET['slug'])==0) {
	setcookie("lang", "en", time()+$GLOBALS['auth']['uptime'], "/");
	$GLOBALS['user']['lang']="en";
	refcheck("en");
}elseif ($_GET['mod']=="cn" and mb_strlen($_GET['slug'])==0) {
	setcookie("lang", "cn", time()+$GLOBALS['auth']['uptime'], "/");
	$GLOBALS['user']['lang']="cn";
	refcheck("cn");
}elseif ($_GET['mod']=="ru" and mb_strlen($_GET['slug'])==0) {
	setcookie("lang", "ru", time()+$GLOBALS['auth']['uptime'], "/");
	$GLOBALS['user']['lang']="ru";
	refcheck("ru");
}

if (in_array($GLOBALS['user']['lang'], array("en", "cn")) and $_GET['mod']=="") {
	red('/'.$GLOBALS['user']['lang']."/");
}

$mod="";

if (in_array($_GET['mod'], array("add", "edit", "delete", "list", "catalog", "show", "item", "my"))) { $mod=$_GET['mod']; } 
if (in_array($_GET['mod'], array("registration", "confirm", "forgot", "recover", "logout", "profile", "profile2", "profile_org", "tarif"))) { $mod=$_GET['mod']; } 

if ($_GET['mod']=="add") {
	if ($GLOBALS['user']['public_phone']=="") {
		red(l("profile2", 0, $GLOBALS['user']['lang']));
	}
	
}

if ($_GET['mod']=="news" and $_GET['id']>0) { 
	$mod="news";
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `id`='".sql($_GET['id'])."' and `status`='1' LIMIT 1;";
	$str = mysqlq($query);
	$page=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);
	if ($numrows==0) {
		red("/page/13/404/");
	}elseif($_GET['slug']!=$page['slug'.langpx()]){
		red(flink("news", $page['id'], $page['slug'.langpx()]));
	}
}elseif($_GET['mod']=="news") {
	$mod="newslist";
	if ($_GET['slug']!="") {
		red(flink("news"));
	}
}

if ($_GET['mod']=="edit" and $_GET['id']>0) { 
	$mod="edit";
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($_GET['id'])."' and `user`='".sql($GLOBALS['user']['id'])."' LIMIT 1;";
	$str = mysqlq($query);
	$page=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);
	if ($numrows==0) {
		red("/page/13/404/");
	}
}elseif($_GET['mod']=="edit") {
	red("/page/13/404/");
}

if ($_GET['mod']=="page" and $_GET['id']>0) { 
	$mod="page";
	if ($_GET['id']=="13") {
		header("HTTP/1.0 404 Not Found");
	}
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."pages` WHERE `id`='".sql($_GET['id'])."' and `status`='1' LIMIT 1;";
	$str = mysqlq($query);
	$page=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);
	if ($numrows==0) {
		red("/page/13/404/");
	}elseif($_GET['slug']!=$page['slug'.langpx()]){
		red(flink("page", $page['id'], $page['slug'.langpx()]));
	}
}elseif($_GET['mod']=="page") {
		red("/page/13/404/");
}

if ($_GET['mod']=="item") {
	$mod="item";
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `id`='".sql($_GET['id'])."' and `status`='1' LIMIT 1;";
	$str = mysqlq($query);
	$page=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);
	if ($numrows==0) {
		red("/page/13/404/");
	}elseif($_GET['slug']!=$page['slug'.langpx()]){
		red(flink("item", $page['id'], $page['slug'.langpx()]));
	}
	$page['bread']="";
	$parent=$page['catalog'];
	if ($parent>0) {
		do {
			if ($parent>0) {
				$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($parent)."' and (`status_p`='1' || `status_s`='1' || `status_k`='1') LIMIT 1;";
				$str = mysqlq($query);
				$arsql=mysql_fetch_assoc($str);
				$numrows=mysql_num_rows($str);
				if ($numrows==1) {
					if ($arsql['slug'.langpx()]!="") { $arsql['slug'.langpx()].="/"; }
					$page['bread']=" > <a href=\"".l("catalog", $arsql['id'], $GLOBALS['user']['lang'])."\">".d($arsql['name'.langpx()])."</a>".$page['bread'];
					$parent=$arsql['parent'];
				}else{
					$parent=0;
				}
			}
		}while($parent!=0);
	}else{
		$id=0;
		$page['bread']="";
	}
}

if ($_GET['mod']=="catalog") { 
	if ($_GET['id']>0) {
		$mod="catalog";
		$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($_GET['id'])."' and (`status_p`='1' || `status_s`='1' || `status_k`='1') LIMIT 1;";
		$str = mysqlq($query);
		$page=mysql_fetch_assoc($str);
		$numrows=mysql_num_rows($str);
		if ($numrows==0) {
			red("/page/13/404/");
		}elseif($_GET['slug']!=$page['slug'.langpx()]){
			red(l("catalog", $page['id'], $GLOBALS['user']['lang']));
		}
		$page['bread']="";
		$parent=$page['id'];
		if (in_array($_GET['type'], array("p", "s", "k"))){
			$params="?type=".$_GET['type'];
		}else{
			$params="";
		}
		do {
			if ($parent>0) {
				$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($parent)."' and (`status_p`='1' || `status_s`='1' || `status_k`='1') LIMIT 1;";
				$str = mysqlq($query);
				$arsql=mysql_fetch_assoc($str);
				$numrows=mysql_num_rows($str);
				if ($numrows==1) {
					if ($arsql['slug'.langpx()]!="") { $arsql['slug'.langpx()].="/"; }
					$page['bread']=" > <a href=\"".d(l("catalog", $arsql['id'], $GLOBALS['user']['lang'], $params))."\">".d($arsql['name'.langpx()])."</a>".$page['bread'];
					$parent=$arsql['parent'];
				}else{
					$parent=0;
				}
			}
		}while($parent!=0);
		$pageslink=l("catalog", $page['id'], $GLOBALS['user']['lang']);
	}else{
		$id=0;
		$page['name'.langpx()]=lang("Информационная площадка");
		$page['bread']="";
		$page['status_p']="1";
		$page['status_s']="1";
		$page['status_k']="1";
		$page['id']=0;
		$pageslink=l("catalog", 0, $GLOBALS['user']['lang']);
	}
	
	if (in_array($_GET['type'], array("p", "s", "k"))){$page['type']=$_GET['type'];}else{if ($page['status_p']=="1") {$page['type']="p";}elseif($page['status_s']=="1"){$page['type']="s";}else{$page['type']="k";}}
	
}




if (in_array($mod, array("profile", "logout")) and $GLOBALS['user']['id']=="") { red("/"); }
if (in_array($mod, array("registration", "confirm")) and $GLOBALS['user']['id']>0) { red(l("profile", 0, $GLOBALS['user']['lang'])); }
if (in_array($mod, array("add", "profile", "profile2", "my", "profile_org")) and !$GLOBALS['user']['id']>0) { red("/registration/"); }




if ($_POST['action']=="ajax_profile1") {
	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}

mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `datetime`<'".sql(time()-120)."'");
	
$pass=md5($_POST['pass0']);

	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='8' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-60)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);
	if ($numrows2<5) {

		if ($GLOBALS['user']['pass']!=$pass) {
			mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");

			echo json_encode(array("result" => "0", "error1" => lang("Неправильный пароль")));
			exit;
		}else{
			$html="";
			
			
			$html.="<div class=\"alert alert-delay-hide alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Данные профиля успешно изменены");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
			
			
			
			$company=htmlr($_POST['company']);
			$name=htmlr($_POST['name']);
			$phone=htmlr($_POST['phone']);
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `company`='".sql($company)."', `name`='".sql($name)."', `phone`='".sql($phone)."' WHERE `id`='".sql($GLOBALS['user']['id'])."' LIMIT 1;");
			echo json_encode(array("result" => "1", "html" => $html));
			exit;
			
		}
	} else {
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	echo json_encode(array("result" => "0", "error1" => lang("Слишком много попыток изменения профиля.<br>Повторите попытку через несколько минут.")));
	exit;
	

	}
}

if ($_POST['action']=="ajax_profile2") {
	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}

mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `datetime`<'".sql(time()-120)."'");
	
$pass0=md5($_POST['pass0']);
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];



	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='8' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-60)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);
	if ($numrows2<5) {

		if ($GLOBALS['user']['pass']!=$pass0) {
			mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");

			echo json_encode(array("result" => "0", "error3" => lang("Неправильный пароль")));
			exit;
		}else{
			$error1="";
			$error2="";
			if (mb_strlen($pass1)<8){
				$error1.=lang("Пароль должен быть не менее 8 символов");
			}
			
			if (!preg_match("#[0-9]+#", $pass1) || !preg_match("#[A-Z]+#", $pass1)) {
				if (mb_strlen($error1)>0) { $error1.="<br>"; }
				$error1.=lang("Пароль должен содержать хотя бы одну цифру и одну заглавную букву");
			}
			
			if ($pass1!=$pass2) {
				$error2.=lang("Пароли не совпадают");
			}
			
			
			if ($error1.$error2=="") {
			
				$html="";
				
				$html.="<div class=\"alert alert-delay-hide alert-success alert-dismissible fade show\" role=\"alert\">";
				$html.="<i class=\"fa fa-check\"></i> ";
				$html.=lang("Пароль успешно изменён");
				$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
				$html.="</div>";
				
				$company=htmlr($_POST['company']);
				$name=htmlr($_POST['name']);
				$phone=htmlr($_POST['phone']);
				mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `pass`='".sql(md5($pass2))."' WHERE `id`='".sql($GLOBALS['user']['id'])."' LIMIT 1;");
				echo json_encode(array("result" => "1", "html" => $html));
				exit;
			}else{
				
			echo json_encode(array("result" => "0", "error1" => $error1, "error2" => $error2));
			exit;
			}
			
		}
	} else {
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	echo json_encode(array("result" => "0", "error3" => lang("Слишком много попыток изменения профиля.<br>Повторите попытку через несколько минут.")));
	exit;
	

	}
}

if ($_POST['action']=="ajax_profile3") {
	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}

mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `datetime`<'".sql(time()-120)."'");
	
$pass=md5($_POST['pass0']);

	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='8' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-60)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);
	if ($numrows2<5) {

		if ($GLOBALS['user']['pass']!=$pass) {
			mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");

			echo json_encode(array("result" => "0", "error1" => lang("Неправильный пароль")));
			exit;
		}else{
			$html="";
			
			
			$html.="<div class=\"alert alert-delay-hide alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Данные профиля успешно изменены");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
			
			$email=mb_strtolower($_POST['email']);
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$email="";
			}
			
			
			$name=htmlr($_POST['name']);
			$phone=htmlr($_POST['phone']);
			
			
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `public_email`='".sql($email)."', `public_name`='".sql($name)."', `public_phone`='".sql($phone)."' WHERE `id`='".sql($GLOBALS['user']['id'])."' LIMIT 1;");
			
			$fl="";
			
			if (file_exists("upload/profiles/".$GLOBALS['user']['public_logo']) and mb_strlen($GLOBALS['user']['public_logo'])>4) {
				$img=$GLOBALS['user']['public_logo'];
				$cache=cachename("upload/profiles/", $GLOBALS['user']['public_logo']);
			}else{
				$img="";
				$cache="";
			}
			
			if ($_POST['justdel']=="1") {
				$justdel=1;
			}else{
				$justdel=0;
			}
			
$fl="";		
$file=$_FILES['file'];
if (mb_strlen($file['tmp_name'])>0) {
	if (checkimagef($file)) {
		$fl=uploadf($file, "profiles");
		imagecache("upload/profiles/", $fl);
		if (mb_strlen($fl)>4) {
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `public_logo`='".sql($fl)."' WHERE `id`='".sql($GLOBALS['user']['id'])."' LIMIT 1;");
			$justdel=1;
		}
	}
}

if ($justdel=="1") {
		if (file_exists("upload/profiles/".$GLOBALS['user']['public_logo']) and mb_strlen($GLOBALS['user']['public_logo'])>4) {
			$cache=cachename("upload/profiles/", $GLOBALS['user']['public_logo']);
			if (file_exists("upload/profiles/cache/".$cache) and mb_strlen($cache)>4) {
				unlink("upload/profiles/cache/".$cache);
			}
			unlink("upload/profiles/".$GLOBALS['user']['public_logo']);
			$GLOBALS['user']['public_logo']="";
		}
}
	
			
			if (mb_strlen($fl)>4) { 
				$file="/upload/profiles/".$fl;
				$cache="/upload/profiles/cache/".cachename("upload/profiles/", $fl);
				$dontshow=0;
			}else{
				$file=$GLOBALS['user']['public_logo'];
				if (mb_strlen($GLOBALS['user']['public_logo'])>4) {
					$cache="/upload/profiles/cache/".cachename("upload/profiles/", $GLOBALS['user']['public_logo']);
					$dontshow=0;
				}else{
					$cache="";
					$dontshow=1;
				}
			}
			
			echo json_encode(array("result" => "1", "html" => $html, "file" => $file, "cache" => $cache, "dontshow" => $dontshow));
			exit;
			
		}
	} else {
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	echo json_encode(array("result" => "0", "error1" => lang("Слишком много попыток изменения профиля.<br>Повторите попытку через несколько минут.")));
	exit;
	

	}
}

if ($_POST['action']=="ajax_profile4") {
	
if (!$GLOBALS['user']['id']>0) {
	echo json_encode(array("result" => "0"));
	exit;
}

mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `datetime`<'".sql(time()-120)."'");
	
$pass=md5($_POST['pass']);

	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='8' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-60)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);
	if ($numrows2<5) {

		if ($GLOBALS['user']['pass']!=$pass) {
			mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");

			echo json_encode(array("result" => "0", "error1" => lang("Неправильный пароль")));
			exit;
		}else{
			$html="";
			
			$html.="<div class=\"alert alert-delay-hide alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Данные профиля успешно изменены");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
			
			$org_name=htmlr($_POST['org_name']);
			$org_fullname=htmlr($_POST['org_fullname']);
			$org_uadres=htmlr($_POST['org_uadres']);
			$org_fadres=htmlr($_POST['org_fadres']);
			if (is_numeric($_POST['org_ogrn'])) { $org_ogrn=$_POST['org_ogrn']; } else { $org_ogrn=""; }
			if (is_numeric($_POST['org_inn'])) { $org_inn=$_POST['org_inn']; } else { $org_inn=""; }
			if (is_numeric($_POST['org_kpp'])) { $org_kpp=$_POST['org_kpp']; } else { $org_kpp=""; }
			$org_bank=htmlr($_POST['org_bank']);
			if (is_numeric($_POST['org_rs'])) { $org_rs=$_POST['org_rs']; } else { $org_rs=""; }
			if (is_numeric($_POST['org_ks'])) { $org_ks=$_POST['org_ks']; } else { $org_ks=""; }
			if (is_numeric($_POST['org_bik'])) { $org_bik=$_POST['org_bik']; } else { $org_bik=""; }
			
			
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `org_name`='".sql($org_name)."',`org_fullname`='".sql($org_fullname)."', `org_uadres`='".sql($org_uadres)."', `org_fadres`='".sql($org_fadres)."', `org_ogrn`='".sql($org_ogrn)."', `org_inn`='".sql($org_inn)."', `org_kpp`='".sql($org_kpp)."', `org_bank`='".sql($org_bank)."', `org_rs`='".sql($org_rs)."', `org_ks`='".sql($org_ks)."', `org_bik`='".sql($org_bik)."' WHERE `id`='".sql($GLOBALS['user']['id'])."' LIMIT 1;");
			echo json_encode(array("result" => "1", "html" => $html));
			exit;
			
		}
	} else {
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('8', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	echo json_encode(array("result" => "0", "error1" => lang("Слишком много попыток изменения профиля.<br>Повторите попытку через несколько минут.")));
	exit;
	

	}
}


if ($_POST['action']=="ajax_auth") {
	
mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `datetime`<'".sql(time()-120)."'");

if (mb_strlen($_POST['email'])>=4 and mb_strlen($_POST['pass'])>4) {
$email=mb_strtolower($_POST['email']);
$pass=md5($_POST['pass']);

	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$email="";
	}
	
	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='1' and `email`='".sql($email)."' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-60)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);

	if ($numrows2<5) {
		
$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `email`='".sql($email)."' and `pass`='".sql($pass)."' and `del`='0' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	
if ($numrows==1 and $arsql['confirm']=="" and $arsql['blocked']=="0") {

if (mb_strlen($arsql['session'])==64 and $arsql['datetime']+$GLOBALS['auth']['uptime']>=time()) {
mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`, `email`) VALUES ('9', '".sql($GLOBALS['user']['ip'])."', '".time()."', '".sql($email)."')");

setcookie("site_session", $arsql['session'], time()+$GLOBALS['auth']['uptime'], "/");
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `datetime`='".sql(time())."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
}else{

$aknsession=gensession();

setcookie("site_session", $aknsession, time()+$GLOBALS['auth']['uptime'], "/");
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `session`='".sql($aknsession)."', `datetime`='".sql(time())."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");	
}
echo json_encode(array("result" => "1"));
exit;



} elseif ($numrows==1 and $arsql['confirm']!="") {
mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`, `email`) VALUES ('1', '".sql($GLOBALS['user']['ip'])."', '".time()."', '".sql($email)."')");
echo json_encode(array("result" => "0", "error1" => lang("Ваш аккаунт не подтвержден. Подтвердите аккаунт для авторизации")));
exit; 


} elseif ($numrows==1 and $arsql['blocked']!="0") {
mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`, `email`) VALUES ('1', '".sql($GLOBALS['user']['ip'])."', '".time()."', '".sql($email)."')");
echo json_encode(array("result" => "0", "error1" => lang("Обратитесь к администратору для активации аккаунта")));
exit;


} else {
mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`, `email`) VALUES ('1', '".sql($GLOBALS['user']['ip'])."', '".time()."', '".sql($email)."')");
echo json_encode(array("result" => "0", "error1" => lang("Неправильный логин или пароль")));
exit;


}

	
	} else {
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`, `email`) VALUES ('1', '".sql($GLOBALS['user']['ip'])."', '".time()."', '".sql($email)."')");
	echo json_encode(array("result" => "0", "error1" => lang("Слишком много попыток авторизоваться.<br>Повторите попытку через несколько минут.")));
	exit;
	

	}
	
}else{
	echo json_encode(array("result" => "0", "error1" =>  lang("Неправильный логин или пароль")));
	exit;
}
}



if ($_POST['action']=="ajax_forgot") {

mysqlq("DELETE FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `datetime`<'".sql(time()-120)."'");
mysqlq("UPDATE ".sql($GLOBALS['config']['bd_prefix'])."followers` SET `recdate`='0', `recover`='' WHERE `recdate`>0 and `recdate`<'".sql((time()-10800))."' and `recover`!=''");
	
	$error1="";
	$email=mb_strtolower($_POST['email']);
	


	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `email`='".sql($email)."' and `blocked`='0' and `del`='0' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$error1=lang("Аккаунт не найден или заблокирован");
		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('6', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	}

	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='6' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-120)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);

	if ($numrows2>4) {
	$error=array();
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	$error1=lang("Восстановление доступа временно ограничено.<br>Повторите попытку через несколько минут.");	
	}

	$html="";

	if ($error1!="") {
		echo json_encode(array("result" => "0", "error1" => $error1));
		exit; 
	}else{
		
				$recover=gensession("followers", "recover");
				mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `recover`='".sql($recover)."', `recdate`='".time()."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
				
				$headers="Content-Type: text/html; charset=utf-8\n";
				$headers.= "From: noreply@".$_SERVER['HTTP_HOST'];


				$body="Здравствуйте!<br><br>
				Вы запросили восстановление доступа к аккаунту на сайте ".mb_strtoupper($_SERVER['HTTP_HOST'])."!<br><br>

				Для сброса пароля перейдите <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/recover/?code=".d(htmlr($recover))."\">по ссылке</a><br><br>

				или введите адрес напрямую в браузер: <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/recover/?code=".d(htmlr($recover))."\">".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/auth_forgot.php?code=".d(htmlr($recover))."</a><br><br>

				<b>Если Вы не запрашивали восстановление доступа, просто проигнорируйте данные письмо.</b><br><br>

				С уважением,<br>
				Администрация проекта<br>
				<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
				
				$body_en="Hello!<br><br>
				You have requested the restoration of access to your account on the site: ".mb_strtoupper($_SERVER['HTTP_HOST'])."!<br><br>

				To reset your password, follow the <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/recover/?code=".d(htmlr($recover))."\">link</a><br><br>

				or enter the address directly into the browser: <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/recover/?code=".d(htmlr($recover))."\">".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/auth_forgot.php?code=".d(htmlr($recover))."</a><br><br>

				<b>If you have not requested access restoration, just ignore this email.</b><br><br>

				Sincerely,<br>
				Project administration<br>
				<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
				
				$body_cn="你好！<br><br>
				您已要求恢复访问您的帐户在网站上 ".mb_strtoupper($_SERVER['HTTP_HOST'])."!<br><br>

				要重置密码 <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/recover/?code=".d(htmlr($recover))."\">请转到</a><br><br>

				或者直接在浏览器中输入地址: <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/recover/?code=".d(htmlr($recover))."\">".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/auth_forgot.php?code=".d(htmlr($recover))."</a><br><br>

				<b>如果您没有请求访问恢复,请忽略此电子邮件.</b><br><br>

				真诚的，<br>
				项目管理<br>
				<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
				
				

				if ($GLOBALS['user']['lang']=="en") {
					@mail($email, "Password Recovery ".$_SERVER['HTTP_HOST'], $body_en, $headers);
				}elseif($GLOBALS['user']['lang']=="cn") {
					@mail($email, "恢复访问 ".$_SERVER['HTTP_HOST'], $body_cn, $headers);
				}else{
					@mail($email, "Восстановление доступа ".$_SERVER['HTTP_HOST'], $body, $headers);
				}					
		
		
		
			$html.="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Информация по восстановлению доступа успешно отправлена.<br>На указанный E-mail было отправлено письмо с инструкцией по восстановлению доступа.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
		
		echo json_encode(array("result" => "1", "html" => $html));
		exit;
	}


}






if ($_POST['action']=="ajax_confirm") {
	
	$error1="";

	
	$code=$_POST['code'];


	$query="SELECT id,email FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `confirm`='".sql($code)."' and `blocked`='0' and `del`='0' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$error1=lang("Код не найден, или аккаунт уже подтвержден");
		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('3', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	}

	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='3' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-120)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);

	if ($numrows2>4) {
	$error=array();
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	$error1=lang("Регистрация временно ограничена.<br>Повторите попытку через несколько минут.");	
	}

	$html="";

	if ($error1!="") {

		echo json_encode(array("result" => "0", "error1" => $error1));
		exit; 
	}else{
		
		if ($GLOBALS['value']['reg']==0) {
		$html.="<div class=\"col-12 mt-0 mb-0 text-center\" style=\"font-size: 7rem; line-height: 8rem;\">";
		$html.="<i class=\"fa fa-times\" style=\"width: auto; color: #f00;\"></i>";
		$html.="</div>";
		$html.="<h3 class=\"col-12 mt-0 mb-0 text-center text-danger\">";
		$html.=lang("Регистрация временно ограничена.<br>Повторите попытку через несколько минут или обратитесь к администраторам.");
		$html.="</h3>"; 
		echo json_encode(array("result" => "1", "html" => $html));
		exit; 
		}
		

		mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `confirm`='', `status`='1' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");

		$telegramtext="<b>✅ Пользователь ".d($arsql['email'])." подтвердил регистрацию</b>";
		telegram_sendtext("-1001870312768", $telegramtext);

		
		
		
			$html.="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Ваш аккаунт подтвержден.<br><br>Вы можете войти в свой аккаунт.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
		
		echo json_encode(array("result" => "1", "html" => $html));
		exit;
	}


}





if ($_POST['action']=="ajax_reg") {
	
	$error1="";
	$error2="";
	$error3="";
	$error4="";
	$error5="";
	
	
	
	
	$role=$_POST['role'];
	$email=mb_strtolower($_POST['email']);
	$pass1=$_POST['pass1'];
	$pass2=$_POST['pass2'];
	$company=htmlr($_POST['company']);
	$name=htmlr($_POST['name']);
	$phone=htmlr($_POST['phone']);
	$check=$_POST['check'];

	$query="SELECT id,name FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `id`='".sql($role)."' and `status`='1' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {
		$error1.=lang("Не указан статус");
	}
	$rolename=$arsql['name'];

	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$error2.=lang("Не указан адрес электронной почты");
	}
	
	if ($error2=="") {
	$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `email`='".sql($email)."' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==1) {
		$error2.=lang("Такой E-mail уже зарегистрирован");
	}
	}	
	


	if (mb_strlen($pass1)<8){
		$error3.=lang("Пароль должен быть не менее 8 символов");
	}
	
    if (!preg_match("#[0-9]+#", $pass1) || !preg_match("#[A-Z]+#", $pass1)) {
		if (mb_strlen($error3)>0) { $error3.="<br>"; }
        $error3.=lang("Пароль должен содержать хотя бы одну цифру и одну заглавную букву");
    }
	
	if ($pass1!=$pass2) {
		$error4.=lang("Пароли не совпадают");
	}

	if ($check!="1") {
		$error5.=lang("Без подтверждения регистрация невозможна");
	}



	$html="";

	if ($error1.$error2.$error3.$error4.$error5!="") {

		echo json_encode(array("result" => "0", "error1" => $error1, "error2" => $error2, "error3" => $error3, "error4" => $error4, "error5" => $error5));
		exit; 
	}else{
		
		if ($GLOBALS['value']['reg']==0) {
		
			$html.="<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Регистрация временно ограничена.<br>Повторите попытку через несколько минут или обратитесь к администраторам.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
			
			
		
		echo json_encode(array("result" => "1", "html" => $html));
		exit; 
		}
		
		$md5=md5($pass1);
		
		$confirm=confirmgen();
		
		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."followers` (`role`, `email`, `pass`, `name`, `company`, `phone`, `regdate`, `ip`, `confirm`, `blocked`, `status`) VALUES ('".sql($role)."', '".sql($email)."', '".sql($md5)."', '".sql($name)."', '".sql($company)."', '".sql($phone)."', '".sql(time())."', '".sql($GLOBALS['user']['ip'])."', '".sql($confirm)."', '0', '3')");
		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`, `email`) VALUES ('2', '".sql($GLOBALS['user']['ip'])."', '".time()."', '".sql($email)."')");

		$headers="Content-Type: text/html; charset=utf-8\n";
		$headers.= "From: noreply@".$_SERVER['HTTP_HOST'];


		$body="Здравствуйте!<br><br>
		Адрес Вашей электронной почты был указан в качестве контактного при регистрации на сайте ".mb_strtoupper($_SERVER['HTTP_HOST'])."!<br><br>

		Для подтверждения регистрации перейдите <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/confirm/?code=".d(htmlr($confirm))."\">по ссылке</a><br><br>

		или введите код на странице подтверждения: <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/confirm/?code=".d(htmlr($confirm))."\">".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/confirm/code=".d(htmlr($confirm))."</a><br><br>

		E-mail: ".d(htmlr($email))."<br>
		Код подтверждения: ".d(htmlr($confirm))."<br><br>

		С уважением,<br>
		Администрация проекта<br>
		<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
		
		$body_en="Hello!<br><br>
		Your email address was specified as a contact when registering on ".mb_strtoupper($_SERVER['HTTP_HOST'])."!<br><br>

		To confirm registration, follow the <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/confirm/?code=".d(htmlr($confirm))."\">link</a><br><br>

		or enter the code on the confirmation page: <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/confirm/?code=".d(htmlr($confirm))."\">".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/confirm/?code=".d(htmlr($confirm))."</a><br><br>

		E-mail: ".d(htmlr($email))."<br>
		Confirmation code: ".d(htmlr($confirm))."<br><br>

		Sincerely,<br>
		Project Administration<br>
		<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
		
		$body_cn="你好！<br><br>
		在网站上注册时，您的电子邮件地址被指定为联系人 ".mb_strtoupper($_SERVER['HTTP_HOST'])."!<br><br>

		要确认注册， <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/confirm/?code=".d(htmlr($confirm))."\">请转到</a><br><br>

		或在确认页面输入代码: <a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/confirm/?code=".d(htmlr($confirm))."\">".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/confirm/?code=".d(htmlr($confirm))."</a><br><br>

		电子邮件: ".d(htmlr($email))."<br>
		确认码: ".d(htmlr($confirm))."<br><br>

		真诚的，<br>
		项目管理<br>
		<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/confirm/\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
		
		
		
				if ($GLOBALS['user']['lang']=="en") {
					@mail($email, "Registration on ".$_SERVER['HTTP_HOST'], $body_en, $headers);
				}elseif($GLOBALS['user']['lang']=="cn") {
					@mail($email, "在网站上注册 ".$_SERVER['HTTP_HOST'], $body_cn, $headers);
				}else{
					@mail($email, "Регистрация на сайте ".$_SERVER['HTTP_HOST'], $body, $headers);
				}	
		
			
		
		$telegramtext="<b><u>⚡️ Зарегистрирован новый пользователь:</u></b>\r\n";
		$telegramtext.="<b>Статус:</b> ".d($rolename)."\r\n";
		$telegramtext.="<b>E-mail:</b> ".d($email)."\r\n";
		$telegramtext.="<b>Компания:</b> ".d($company)."\r\n";
		$telegramtext.="<b>Телефон:</b> ".phone_format($phone)."\r\n";
		$telegramtext.="<b>Контактное лицо:</b> ".d($name);
		
		telegram_sendtext("-1001870312768", $telegramtext);
		
		
		
			$html.="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Регистрация успешно завершена<br><br>На указанный E-mail было отправлено письмо с инструкцией по активации аккаунта.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
		
		echo json_encode(array("result" => "1", "html" => $html));
		exit;
	}


}




if ($mod=="logout") {

$aknsession=$_COOKIE['site_session'];


$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `session`='".sql($aknsession)."' and `datetime`>='".sql(time()-10800)."' LIMIT 1;";
$str = mysqlq($query);
$arsql=mysql_fetch_assoc($str);
$numrows=mysql_num_rows($str);	

setcookie("site_session", '', 0, '/');
if ($numrows==1) {
mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `session`='' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
}
red("/");
exit;

}


if ($mod=="recover") {
	
	$page['html']="";
	
	if ($_GET['code']) {
		
		
	$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."flogs` WHERE `t`='6' and `ip`='".sql($GLOBALS['user']['ip'])."' and `datetime`>'".sql(time()-120)."' LIMIT 16;";
	$str2 = mysqlq($query2);
	$arsql2=mysql_fetch_assoc($str2);
	$numrows2=mysql_num_rows($str2);

	if ($numrows2<5) {
		
		
		
	if (preg_match('/[A-Za-z0-9]{64}/Umi', $_GET['code'])) { $code=$_GET['code']; } else { $code="---"; }
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers` WHERE `recover`='".sql($code)."' and `recdate`>0 and `del`='0' LIMIT 1;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows==0) {	
		
		
			$page['html'].="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
			$page['html'].="<i class=\"fa fa-check\"></i> ";
			$page['html'].=lang("Код восстановления доступа не найден.");
			$page['html'].="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$page['html'].="</div>";

		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('6', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
		
	}else{
		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('6', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
		$pass=passgen();
		
			$md5=md5($pass);
			mysqlq("UPDATE `".sql($GLOBALS['config']['bd_prefix'])."followers` SET `session`='',`recover`='',`recdate`='0',`pass`='".sql($md5)."' WHERE `id`='".sql($arsql['id'])."' LIMIT 1;");
			$headers="Content-Type: text/html; charset=utf-8\n";
			$headers.= "From: noreply@".mb_strtolower($_SERVER['HTTP_HOST']);
			$confirm=$arsql['confirm'];

			$body="Здравствуйте!<br><br>
			Пароль Вашего аккаунта на сайте ".mb_strtoupper($_SERVER['HTTP_HOST'])." изменен!<br><br>

			Данные для авторизации:<br><br>

			E-mail: ".d(htmlr($arsql['email']))."<br>
			Пароль: ".d(htmlr($pass))."<br><br>
			
			Пожалуйста, поменяйте пароль на новый сразу же после авторизации!<br><br>

			С уважением,<br>
			Администрация проекта<br>
			<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
			
			$body_en="Hello!<br><br>
			Password of your account on ".mb_strtoupper($_SERVER['HTTP_HOST'])." has been changed!<br><br>

			Authorization data:<br><br>

			E-mail: ".d(htmlr($arsql['email']))."<br>
			Password: ".d(htmlr($pass))."<br><br>
			
			Please change your password to a new one immediately after logging in!<br><br>

			Sincerely,<br>
			Project Administration<br>
			<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/en/\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
			
			$body_cn="你好！<br><br>
			您的帐户密码 ".mb_strtoupper($_SERVER['HTTP_HOST'])." 已更改!<br><br>

			授权数据:<br><br>

			电子邮件: ".d(htmlr($arsql['email']))."<br>
			密码: ".d(htmlr($pass))."<br><br>
			
			请在登录后立即将您的密码更改为新的密码!<br><br>

			真诚的，<br>
			项目管理<br>
			<a href=\"".$GLOBALS['value']['ssl']."://".mb_strtolower($_SERVER['HTTP_HOST'])."/cn/\">".mb_strtoupper($_SERVER['HTTP_HOST'])."</a><br>";
			
				// @mail($arsql['email'], "Данные для доступа ".$_SERVER['HTTP_HOST'], $body, $headers);
				
				if ($GLOBALS['user']['lang']=="en") {
					@mail($arsql['email'], "Access data ".$_SERVER['HTTP_HOST'], $body_en, $headers);
				}elseif($GLOBALS['user']['lang']=="cn") {
					@mail($arsql['email'], "访问数据 ".$_SERVER['HTTP_HOST'], $body_cn, $headers);
				}else{
					@mail($arsql['email'], "Данные для доступа ".$_SERVER['HTTP_HOST'], $body, $headers);
				}	
		
				
		
			$page['html'].="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">";
			$page['html'].="<i class=\"fa fa-check\"></i> ";
			$page['html'].=lang("Данные для доступа успешно изменены.<br>На указанный E-mail было отправлено письмо с новыми данными для доступа");
			$page['html'].="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$page['html'].="</div>";
				
	}
	} else {
	if ($numrows2>7) { sleep(10); }elseif($numrows2>10){ sleep(15); } elseif ($numrows2>15) { sleep(30); }
	mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('6', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	
			$page['html'].="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
			$page['html'].="<i class=\"fa fa-check\"></i> ";
			$page['html'].=lang("Слишком много попыток восстановления доступа.<br>Повторите попытку через несколько минут.");
			$page['html'].="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$page['html'].="</div>";

	}
	
	
	
	}else{
		
			$page['html'].="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">";
			$page['html'].="<i class=\"fa fa-check\"></i> ";
			$page['html'].=lang("Код восстановления доступа не найден.");
			$page['html'].="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$page['html'].="</div>";

		mysqlq("INSERT INTO `".sql($GLOBALS['config']['bd_prefix'])."flogs` (`t`, `ip`, `datetime`) VALUES ('6', '".sql($GLOBALS['user']['ip'])."', '".time()."')");
	}
}


if (mb_strlen($page['title'.langpx()])==0) { 
	$page['title'.langpx()]=text("default_title".langpx())['value'];
}
if (mb_strlen($page['meta1'.langpx()])==0) { 
	$page['meta1'.langpx()]=text("default_meta1".langpx())['value'];
}
if (mb_strlen($page['meta2'.langpx()])==0) { 
	$page['meta2'.langpx()]=text("default_meta2".langpx())['value'];
}


$hreflang=array("ru"=>"", "en"=>"", "cn"=>"");

$uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('?', $uri, 2);
if (mb_strlen($uri_parts[1])>0) { $qstring="?".$uri_parts[1]; } else { $qstring=""; }



if ($mod=="catalog") {
	
	$array_vac1=itemsdown_t(5, "p");
	$array_vac2=itemsdown_t(5, "s");
	$array_vac=array_merge($array_vac1, $array_vac2);
	$array_vac=array_unique($array_vac);
	
	$hreflang['ru']=l("catalog", $page['id'], "ru").$qstring; 
	$hreflang['en']=l("catalog", $page['id'], "en").$qstring; 
	$hreflang['cn']=l("catalog", $page['id'], "cn").$qstring; 
	
	$page['title'.langpx()]=lang("Информационная площадка")." :: ".$page['name'.langpx()];
	if ($_GET['type']=="p" || $_GET['type']=="" ) { if (in_array($page['id'], $array_vac)) { $page['title'.langpx()].=" :: ".lang("Резюме"); } else { $page['title'.langpx()].=" :: ".lang("Предложение"); } } 
	elseif ($_GET['type']=="s") { if (in_array($page['id'], $array_vac)) { $page['title'.langpx()].=" :: ".lang("Вакансии"); } else { $page['title'.langpx()].=" :: ".lang("Спрос"); } } 
	elseif ($_GET['type']=="k") { $page['title'.langpx()].=" :: ".lang("Компании"); } 
	
}elseif($mod=="page") {
	$hreflang['ru']=l("page", $page['id'], "ru").$qstring; 
	$hreflang['en']=l("page", $page['id'], "en").$qstring; 
	$hreflang['cn']=l("page", $page['id'], "cn").$qstring; 
}elseif($mod=="news") {
	$hreflang['ru']=l("news", $page['id'], "ru").$qstring; 
	$hreflang['en']=l("news", $page['id'], "en").$qstring; 
	$hreflang['cn']=l("news", $page['id'], "cn").$qstring; 
}elseif($mod=="item") {
	$hreflang['ru']=l("item", $page['id'], "ru").$qstring; 
	$hreflang['en']=l("item", $page['id'], "en").$qstring; 
	$hreflang['cn']=l("item", $page['id'], "cn").$qstring; 
}elseif($mod=="newslist") {
	$hreflang['ru']="/newslist/".$qstring; 
	$hreflang['en']="/newslist/".$qstring; 
	$hreflang['cn']="/newslist/".$qstring; 
}elseif($mod==""){
	$hreflang['ru']="/"; 
	$hreflang['en']="/en/";
	$hreflang['cn']="/cn/";
}



?><!DOCTYPE html>
<html lang="<?php echo $GLOBALS['user']['lang']; ?>" class="notranslate" translate="no">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="google" content="notranslate">
    <title><?php echo d($page['title'.langpx()]); ?></title>
	<meta name="keywords" content="<?php echo d($page['meta2'.langpx()]); ?>" />
	<meta name="description" content="<?php echo d($page['meta1'.langpx()]); ?>" />
	<?php if ($hreflang['ru']!="") { ?><link rel="alternate" hreflang="ru" href="<?php echo d($hreflang['ru']); ?>" /><?php } ?>
	<?php if ($hreflang['en']!="") { ?><link rel="alternate" hreflang="en" href="<?php echo d($hreflang['en']); ?>" /><?php } ?>
	<?php if ($hreflang['cn']!="") { ?><link rel="alternate" hreflang="cn" href="<?php echo d($hreflang['cn']); ?>" /><?php } ?>
	
	<link rel="icon" href="/favicon.ico"> <!-- 32×32 -->
	<link rel="apple-touch-icon" href="/android-chrome-180x180.png">  <!-- 180×180 -->
	<link rel="manifest" href="/site.webmanifest">
	
    <link rel="stylesheet" href="/css/reset.css" />
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link
      rel="stylesheet"
      href="/css/all.min.css"
    />
    <link rel="stylesheet" type="text/css" href="/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css" />
	<link rel="stylesheet" href="/css/fancybox.css" />

    <link rel="stylesheet" href="/css/style.css?hash=17112023" />
    <link rel="stylesheet" href="/css/custom.css?hash=17112023" />

<?php echo text("jivosite")['value']; ?>
<?php echo text("metrika")['value']; ?>
  </head>

  <body class="d-flex flex-column min-vh-100">
    <div class="top-panel">
      <div class="container d-flex justify-content-between flex-wrap">
        <div class="langs d-flex align-items-center mx-auto mx-md-0 my-1 my-md-0 d-md-flex align-items-center gap-2">
          <div class="langs-item active">
            <a href="/ru/"><img src="/img/icons/ru.png" class="active" alt="" /> </a>
          </div>
          <div class="langs-item">
            <a href="/en/"><img src="/img/icons/eng.png" class="active" alt="" /></a>
          </div>
          <div class="langs-item">
            <a href="/cn/"><img src="/img/icons/ch.png" class="active" alt="" /> </a>
          </div>
        </div>
        <div class="login d-flex align-items-center mx-auto mx-md-0">
		<?php if ($GLOBALS['user']['id']>0) { ?>
          <div class="login-item d-flex align-items-center">
            <a href="<?php echo l("profile", 0, $GLOBALS['user']['lang']); ?>" class="d-flex gap-2 align-items-center">
              <i class="fa fa-user"></i> 
              <span><?php echo d($GLOBALS['user']['email']); ?></span>
            </a>
          </div>
          <div class="login-item">
            <a href="/logout/" class="d-flex gap-2 align-items-center">
		<span><?php echo lang("Выйти"); ?></span>
            </a>
          </div>
		  <div class="login-item">
            <a href="<?php echo l("add", 0, $GLOBALS['user']['lang']); ?>" class="btn">
              <span><?php echo lang("Разместить объявление"); ?></span>
            </a>
          </div>
		<?php }else{ ?>
          <div class="login-item d-flex align-items-center">
            <a href="#" data-bs-toggle="modal" data-bs-target="#authModal" class="d-flex gap-2 align-items-center">
              <i class="fa fa-user"></i> 
              <span><?php echo lang("Войти"); ?></span>
            </a>
          </div>
          <div class="login-item">
            <a href="<?php echo l("registration", 0, $GLOBALS['user']['lang']); ?>" class="d-flex gap-2 align-items-center">
              <span><?php echo lang("Регистрация"); ?></span>
            </a>
          </div>
		  <div class="login-item">
            <a href="<?php echo l("registration", 0, $GLOBALS['user']['lang']); ?>" class="btn">
              <span><?php echo lang("Разместить объявление"); ?></span>
            </a>
          </div>
		<?php } ?>
        </div>
      </div>
    </div>
	<?php if (text("test_mode")['value']=="1") { ?>
	<div class="text-center" style="background-color: #979797; font-size: 12px; color: #fff;">
      <?php echo lang("Внимание! Сайт находится в тестовом режиме. Приносим свои извинения за возможные неудобства."); ?>
    </div>
	<?php } ?>
    <header>
		<!-- Top.Mail.Ru counter -->
		<script type="text/javascript">
		var _tmr = window._tmr || (window._tmr = []);
		_tmr.push({id: "3424636", type: "pageView", start: (new Date()).getTime(), pid: "USER_ID"});
		(function (d, w, id) {
			if (d.getElementById(id))
				return;
			var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
			ts.src = "https://top-fwz1.mail.ru/js/code.js";
			var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else {
				f();
			}
		})(document, window, "tmr-code");
		</script>
		<noscript>
			<div><img src="https://top-fwz1.mail.ru/counter?id=3424636;js=na" style="position:absolute;left:-9999px;" alt="Top.Mail.Ru" /></div></noscript>
		<!-- /Top.Mail.Ru counter -->

		<!-- Rating@Mail.ru counter dynamic remarketing appendix -->
		<script type="text/javascript">
		var _tmr = _tmr || [];
		_tmr.push({
			type: 'itemView',
			productid: 'VALUE',
			pagetype: 'VALUE',
			list: 'VALUE',
			totalvalue: 'VALUE'
		});
		</script>
		<!-- // Rating@Mail.ru counter dynamic remarketing appendix -->
		
	<form action="<?php echo l("catalog", 0, $GLOBALS['user']['lang']); ?>" method="get"><input type="hidden" name="type" value="p">
      <div class="container d-flex align-items-center mb-lg-0 mb-0 mb-md-3">
        <div
          class="logo d-flex mx-auto mx-md-0 mb-2 mb-md-0 justify-content-center align-items-center flex-shrink-0"
          style="width: 263px; height: 56px"
        >
          <a href="/"><img src="/img/logo<?php echo langpx(); ?>.png" alt="" /></a>
        </div>
        <div class="search-bar d-none d-md-flex w-100 align-items-center">
          <input
            type="search" name="search"
            placeholder="<?php echo lang("Поиск по торговой площадке"); ?>"
            class="w-100"
          />
          <button><?php echo lang("Найти"); ?></button>
        </div>
        <div class="socials gap-1 flex-shrink-0 d-none d-md-flex">
			<!-- <div
            class="d-flex justify-content-center align-items-center flex-shrink-0"
          >
            <a href="<?php echo text("main_facebook".langpx())['value']; ?>"><i class="fa-brands fa-facebook"></i></a>
          </div>
          <div
            class="d-flex justify-content-center align-items-center flex-shrink-0"
          >
            <a href="<?php echo text("main_youtube".langpx())['value']; ?>"><i class="fa-brands fa-youtube"></i></a>
			</div> -->
          <div
            class="d-flex justify-content-center align-items-center flex-shrink-0"
          >
            <a href="<?php echo text("main_telegram".langpx())['value']; ?>"><i class="fa-brands fa-telegram"></i></a>
          </div>
        </div>
      </div>
	</form>
      <nav class="nav d-none d-lg-block">
        <div class="container">
          <ul class="d-flex gap-4">
		  <?php 

			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `parent`='0' and `status`='1' ORDER BY `position`, `id`;";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);	
			$topmenu1="";
			$topmenu2="";
			if ($numrows==0) {
				$topmenu1.="<li class=\"nav-item\">";
				$topmenu1.="<a href=\"/\" class=\"py-3 d-block\">".lang("Главная")."</a>";
				$topmenu1.="</li>";
			
				$topmenu2.="<li class=\"nav-item\">";
				$topmenu2.="<a href=\"/\" class=\"\">".lang("Главная")."</a>";
				$topmenu2.="</li>";
			}else{
				do {
				
					if ($arsql['type']=="2") {
						$topmenu1.="<li class=\"nav-item\">";
						$topmenu1.="<a href=\"".pre($arsql["link".langpx()])."\" class=\"py-3 d-block\">".pre($arsql["name".langpx()])."</a>";
						$topmenu1.="</li>";
					
						$topmenu2.="<li class=\"nav-item\">";
						$topmenu2.="<a href=\"".pre($arsql["link".langpx()])."\" class=\"\">".pre($arsql["name".langpx()])."</a>";
						$topmenu2.="</li>";
					}elseif($arsql['type']=="1") {
						
						$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."topmenu` WHERE `parent`='".sql($arsql['id'])."' and `status`='1' ORDER BY `position`, `id`;";
						$str2 = mysqlq($query2);
						$arsql2=mysql_fetch_assoc($str2);
						$numrows2=mysql_num_rows($str2);
						if ($numrows2==0) {
							$topmenu1.="<li class=\"nav-item\">";
							$topmenu1.="<a href=\"".pre($arsql["link".langpx()])."\" class=\"py-3 d-block\">".pre($arsql["name".langpx()])."</a>";
							$topmenu1.="</li>";
						
							$topmenu2.="<li class=\"nav-item\">";
							$topmenu2.="<a href=\"".pre($arsql["link".langpx()])."\" class=\"\">".pre($arsql["name".langpx()])."</a>";
							$topmenu2.="</li>";
						}else{
							$topmenu1.="<li class=\"nav-item dropdown\">";
							$topmenu1.="<a class=\"dropdown-toggle py-3 d-block\" href=\"".pre($arsql["link".langpx()])."\" id=\"navbarDropdown".d($arsql["id"])."\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">".pre($arsql["name".langpx()])."</a>";
							$topmenu2.="<li class=\"nav-item dropdown\">";
							$topmenu2.="<a class=\"dropdown-toggle\" href=\"".pre($arsql["link".langpx()])."\" id=\"navbarDropdown".d($arsql["id"])."\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">".pre($arsql["name".langpx()])."</a>";
							
							$topmenu1.="<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown".d($arsql["id"])."\">";
							$topmenu2.="<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown".d($arsql["id"])."\">";

							do {
								
								$topmenu1.="<li><a class=\"dropdown-item\" href=\"".pre($arsql2["link".langpx()])."\">".pre($arsql2["name".langpx()])."</a></li>";
								$topmenu2.="<li><a class=\"dropdown-item\" href=\"".pre($arsql2["link".langpx()])."\">".pre($arsql2["name".langpx()])."</a></li>";
								
							}while($arsql2=mysql_fetch_assoc($str2));
							
							$topmenu1.="</ul></li>";
							$topmenu2.="</ul></li>";

						}

					}				
				
				}while($arsql=mysql_fetch_assoc($str));

			}

		  ?>
            <?php echo $topmenu1;  ?>
          </ul>
        </div>
      </nav>
    </header>
    
    <!-- Слайд-шоу или заглушка -->
<?php
    $pagesWithSlideer = array(3,9,10,11,12,13,14,42);
    
    if ($mod == "" || in_array($page['id'],$pagesWithSlideer)) { ?>
     <section class="hero">
      <div class="hero-slides">
		<?php 
    $targetSql = ($mod == "") ? "m":"e";
    $maxSlides = 21;
		$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `status`='1' AND `target` = '".sql($targetSql)." 'ORDER BY rand() LIMIT ".sql($maxSlides).";";
		$str = mysqlq($query);
		$arsql=mysql_fetch_assoc($str);
		$numrows=mysql_num_rows($str);
    
    if ($numrows < 3){
      $query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `status`='1' AND `target` = '".sql($targetSql)."' UNION SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."slides` WHERE `status`='1' AND `target` = 's' LIMIT 3;";
		  $str = mysqlq($query);
		  $arsql=mysql_fetch_assoc($str);
		  $numrows=mysql_num_rows($str);
    }
		if ($numrows>0) { 
		do { 
		$file=$arsql['file'];
		if ($arsql['file'.langpx()]!=$file and file_exists("upload/slides/".$arsql['file'.langpx()]) and mb_strlen($arsql['file'.langpx()])>4) { $file=$arsql['file'.langpx()]; }
		?>
        <a href="<?php echo $arsql['link'.langpx()]; ?>" class="hero-slide d-flex flex-column justify-content-center" style="position: relative; background-image: url('/upload/slides/<?php echo d($file); ?>')">
        <?php echo $arsql['html'.langpx()]; ?>
          <span class="position-absolute px-1 py-0 annerspan"><?php echo $arsql['info']?></span>
          </a>
		<?php } while ($arsql=mysql_fetch_assoc($str)); ?>
		<?php } else { ?>
        <div class="hero-slide d-flex flex-column justify-content-center" style="background-image: url('img/slide1.png')"></div>
		<?php } ?>
      </div>
      <div class="slider-nav"></div>
    </section>   
   
    
    
<?php } else { ?>
<section class="hero-inner">
      <div><img src="/img/inner-hero.png" alt="" /></div>
    </section>
<?php } ?>
    
    <!-- -->
    <div class="d-lg-none d-block mt-3 mb-0">
	<form action="<?php echo l("catalog", 0, $GLOBALS['user']['lang']); ?>" method="get"><input type="hidden" name="type" value="p">
      <div class="container">
        <div class="d-flex justify-content-between px-3 align-items-center">
          <div class="search d-flex justify-content-center align-items-center">
            <i class="fa-solid fa-magnifying-glass"></i>
            <div class="search-bar w-100 align-items-center">
              <input
                type="search" name="search"
                placeholder="Поиск по торговой площадке"
                class="w-100"
              />
              <button><?php echo lang("Найти"); ?></button>
            </div>
          </div>
          <div class="socials gap-1 flex-shrink-0 d-flex">
           <!-- <div class="d-flex justify-content-center align-items-center flex-shrink-0">
              <a href="<?php echo text("main_facebook".langpx())['value']; ?>"><i class="fa-brands fa-facebook"></i></a>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-shrink-0">
              <a href="<?php echo text("main_youtube".langpx())['value']; ?>"><i class="fa-brands fa-youtube"></i></a>
            </div> -->
            <div class="d-flex justify-content-center align-items-center flex-shrink-0">
              <a href="<?php echo text("main_telegram".langpx())['value']; ?>"><i class="fa-brands fa-telegram"></i></a>
            </div>
          </div>
          <div>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarMenu"
            >
              <span></span>
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
	  </form>
      <div class="container">
        <div class="collapse mt-3" id="navbarMenu">
          <nav class="nav nav-mobile p-3">
            <div class="container">
              <ul class="d-flex gap-4 flex-column">
                <?php echo $topmenu2; ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
<?php if ($mod=="item") { 
$follower=user($page['user']);
itemst($page['id']);
$catalog=catalog($page['catalog']);
?>


    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="<?php echo flink("", "", ""); ?>"><?php echo lang("Главная"); ?></a> > <a href="<?php echo l("catalog", 0, $GLOBALS['user']['lang']); ?>"><?php echo lang("Информационная площадка"); ?></a><?php echo $page['bread']; ?>
        </div>
      </div>
    </div>
    <section class="ad px-3 px-md-0 mb-3">
      <div class="container">
        <h1 class="title-inner">
          <?php echo d($page['name'.langpx()]); ?><?php if ($page['type']=="p" and $catalog['check_nb']=="1") { if ($page['bu']=="1") { echo " [".lang("Б/у")."]"; } else { echo " [".lang("Новый")."]"; } } ?>
        </h1>
        <div class="row mb-5">
          <div class="col-12 col-md-4">
		  <?php 
		  
								$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($page['id'])."' and `type`='image' ORDER BY `position`, `id`;";
								$str2 = mysqlq($query2);
								$arsql2=mysql_fetch_assoc($str2);
								$numrows2=mysql_num_rows($str2);

		  ?>
            <div class="kd-slider-for">
			<?php if ($numrows2>0) { 
			
			
			
			$cachename="";
			$fullname="";	
				if (file_exists("upload/items/".$arsql2['file']) and mb_strlen($arsql2['file'])>4) {
					$cachename="/".imagecache("upload/items/", $arsql2['file']);
					$fullname="/upload/items/".$arsql2['file'];
				}
			} 
			if ($cachename=="") {
				if(file_exists("upload/profiles/".$follower['public_logo']) and mb_strlen($follower['public_logo'])>4) {
					$cachename="/".imagecache("upload/profiles/", $follower['public_logo']);
				}else{
					$cachename="/img/no_news_image.png";
				}
			}
			
			
			
			
			
			
			
			
			
			if (mb_strlen($fullname)>0) {
			?><a href="<?php echo d($fullname); ?>" data-fancybox="gallery"><img src="<?php echo d($cachename); ?>" alt="<?php echo d($page['name'.langpx()]); ?>" title="<?php echo d($page['name'.langpx()]); ?>" /></a><?php 				
			}else{
			?><img src="<?php echo d($cachename); ?>" alt="<?php echo d($page['name'.langpx()]); ?>" title="<?php echo d($page['name'.langpx()]); ?>" /><?php 				
			}
			
			
			
			if ($numrows2>1) { $arsql2=mysql_fetch_assoc($str2); } ?>
            </div>
            <div class="kd-slider-nav px-0 gap-2 my-2">
			<?php if ($numrows2>1) { do { 
			$cachename="";
			$fullname="";	
				if (file_exists("upload/items/".$arsql2['file']) and mb_strlen($arsql2['file'])>4) {
					$cachename="/".imagecache("upload/items/", $arsql2['file']);
					$fullname="/upload/items/".$arsql2['file'];
				}

			if ($cachename=="") {
				if(file_exists("upload/profiles/".$follower['public_logo']) and mb_strlen($follower['public_logo'])>4) {
					$cachename="/".imagecache("upload/profiles/", $follower['public_logo']);
				}else{
					$cachename="/img/no_news_image.png";
				}
			}

			if (mb_strlen($fullname)>0) {
			?><a href="<?php echo d($fullname); ?>" data-fancybox="gallery"><img src="<?php echo d($cachename); ?>" alt="<?php echo d($page['name'.langpx()]); ?>" title="<?php echo d($page['name'.langpx()]); ?>" /></a><?php 				
			}
			} while ($arsql2=mysql_fetch_assoc($str2)); } ?>
            </div>
          </div>
          <div class="col-12 col-md-8">
            <?php if (!in_array($page['catalog'], array("8"))) {?><div class="mb-2 date"><?php echo lang("Дата размещения"); ?>: <?php echo d(date("d.m.Y H:i", $page['stamp'])); ?></div><?php }?>
            <?php if (!in_array($page['catalog'], array("8"))) {?>
			<div class="d-flex gap-3 flex-wrap flex-md-nowrap">
              <div class="price text-nowrap"><?php if ($page['catalog']!=67) {if ($catalog['check_zp']==0) { echo lang("Цена"); }else{ echo lang("Зар.плата"); } ?>: <?php echo d(fullprice($page['price'], $page['price_type'], $page['price_cur'])); }?></div>

            </div>
			<?php } ?>
            <div class="address mt-2 d-flex align-items-center gap-1">
              <?php if ($page['catalog']!=67) echo '<i class="fa-solid fa-location-dot"></i>';?>
              <div>
			  <?php if ($page['catalog']!=67) echo implode(", ", regionfull($page['region'])); ?>
              </div>
            </div>
			<?php if (mb_strlen($follower['company'])>0) { ?>
            <div class="mt-2 position-relative">
              <div class="accordion-item icon mb-3">
                <h2 class="accordion-header position-relative">
                  <button
                    class="accordion-button collapsed collapser d-flex align-items-center gap-4"
                    type="button"
                    data-bs-toggle="collapse"
                  >
                    <img src="/img/icons/contacts.png" alt="" />
                     <?php echo d($follower['company']); ?>
                  </button>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="7"
                    viewBox="0 0 10 7"
                    class="position-absolute"
                  >
                    <g>
                      <g><path fill="#878787" d="M0 0h9.608L5 7h-.392z" /></g>
                    </g>
                  </svg>
                </h2>
                <div class="accordion-collapse collapse">
                  <div class="accordion-body">
                  </div>
                </div>

              </div>
            </div>
			<?php } ?>
			<?php if (mb_strlen($follower['public_phone'])>0) { ?>
            <div
              class="d-flex flex-column flex-md-row gap-2 gap-md-4 kd-socials"
            >
              <a href="#" class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-phone"></i>
                <?php echo phone_format($follower['public_phone']); ?>
              </a>

            </div>
			<?php } ?>
			<?php if (mb_strlen($page['video'])>0) { ?>
            <a href="<?php echo d($page['video']);?>" target="_blank" class="video d-flex align-items-center gap-2 mt-2">
              <i class="fa-brands fa-youtube"></i>
              <span><?php echo lang("Видео на YouTube"); ?></span>
            </a>
			<?php } ?>
            <div class="mt-3">
              <p><?php echo cl2br($page['text'.langpx()]); ?></p>
            </div>
			<?php if (mb_strlen($page['text2'.langpx()])>0) { ?>
            <div class="mt-3">
			  <h5><?php echo lang("Доп.сведения:"); ?></h5>
              <p><?php echo cl2br($page['text2'.langpx()]); ?></p>
            </div>
			<?php } ?>
			<?php if ($page['type']=="p" and mb_strlen($page['bp'.langpx()])>0) { ?>
            <div class="mt-3">
			  <h5><?php echo lang("Базис поставки:"); ?></h5>
              <p><?php echo d($page['bp'.langpx()]); ?></p>
            </div>
			<?php } ?>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Под объявлением на широких устройствах -->
    <?php if ($page['catalog'] != 67){?>
    <section class="kds d-none d-md-block pb-5">
      <div class="container">
        <h3 class="title"><?php echo lang("Форвардные объявления"); ?></h3>
        <div class="row mt-5">
		<?php
		$out1="";
		$out2="";
			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `type`='p' and `catalog`!='8' and `catalog`!='67' and `status`='1' ORDER BY id DESC LIMIT 6;";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);
			if ($numrows>0) { 
			$k=0;
			$out2.="<div>";
				do {
					$l=l("item", $arsql['id'], $GLOBALS['user']['lang']);
					$k++; if ($k>3) { $k=1; $out2.="</div><div>"; }
					$follower=user($arsql['user']);
					$name=$arsql['name'.langpx()];
					$price=fullprice($arsql['price'], $arsql['price_type'], $arsql['price_cur']);
					
					$cachename="";
					$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($arsql['id'])."' and `type`='image' ORDER BY `position`, `id` LIMIT 1;";
					$str2 = mysqlq($query2);
					$arsql2=mysql_fetch_assoc($str2);
					$numrows2=mysql_num_rows($str2);
					if ($numrows2>0) { 
						
						if (file_exists("upload/items/".$arsql2['file']) and mb_strlen($arsql2['file'])>4) {
							$cachename="/".imagecache("upload/items/", $arsql2['file']);
						}
					} 
					if ($cachename=="") {
						if(file_exists("upload/profiles/".$follower['public_logo']) and mb_strlen($follower['public_logo'])>4) {
							$cachename="/".imagecache("upload/profiles/", $follower['public_logo']);
						}else{
							$cachename="/img/no_news_image.png";
						}
					}
					
$out1.="<div class=\"col-12 col-md-4\">";
$out1.="<a class=\"d-flex gap-3 align-items-start mb-5 kdsa\" href=\"".d($l)."\">";
$out1.="<img class=\"kd-img kd-sm\" src=\"".d($cachename)."\" alt=\"\" />";
$out1.="<div class=\"kd-text\">";
$out1.="<span class=\"d-block\">".d($name)."</span>";
$out1.="<span>".d($price)."</span>";
$out1.="</div>";
$out1.="</a>";
$out1.="</div>";
					

$out2.="<a href=\"".d($l)."\" class=\"d-flex gap-3 align-items-start mb-5 px-3\">";
$out2.="<img class=\"kd-img kd-sm\" src=\"".d($cachename)."\" alt=\"\" />";
$out2.="<div class=\"kd-text\">";
$out2.="<span class=\"d-block\">".d($name)."</span>";
$out2.="<span>".d($price)."</span>";
$out2.="</div>";
$out2.="</a>";

					
				}while($arsql=mysql_fetch_assoc($str));
			$out2.="</div>";
			}
		
		
		?>
		 
			<?php echo $out1; ?>
        </div>
      </div>
    </section>
     <!-- Под объявлением на узких устройствах-->
    <section class="kds d-block d-md-none pb-5">
      <div class="container">
        <h3 class="title"><?php echo lang("Форвардные объявления"); ?></h3>
        <div class="row mt-5 kds-cards">
			<?php echo $out2; ?>
        </div>
      </div>
    </section>
	<?php }?>
<?php }elseif($mod=="catalog"){ 

		if (in_array($_GET['type'], array("p", "s", "k"))){
			$params="?type=".$_GET['type'];
		}else{
			$params="";
		}

?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="<?php echo l("", "", $GLOBALS['user']['lang']); ?>"><?php echo lang("Главная"); ?></a> > <a href="<?php echo d(l("catalog", "", $GLOBALS['user']['lang'], $params)); ?>"><?php echo lang("Информационная площадка"); ?></a><?php echo $page['bread']; ?>
        </div>
      </div>
    </div>
	
	<section class="kd-list px-3 px-md-0">
      <div class="container">
        <h1 class="title-inner">
          <?php echo d($page['name'.langpx()]); ?>
        </h1>
		<?php


		
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='".sql($page['id'])."' and `status_".sql($page['type'])."`='1' ORDER BY position;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);
	if ($numrows>0) { ?>
        <div class="row mb-5 ps-1">
		<?php do { 
		
		/* $result['total']=$arsql['count_'.$page['type']];
		$result['new']=$arsql['countnew_'.$page['type']];*/
		
		$result['total']=$arsql['i_'.$page['type']];
		$resunt['new']=0;

		$l=l("catalog", $arsql['id'], $GLOBALS['user']['lang'], $params);
		?>
			<div class="col-12 col-md-4 p-1">
                <a href="<?php echo d($l); ?>" class="subcat-new d-flex gap-2 px-4 py-2 border rounded-2 mb-1">
					<div class="subcat-new-content">
						<p class="st my-1 position-relative" style="font-size: 16px;">
						<span class="collapsed" type="button"><?php echo d($arsql['name'.langpx()]); ?></span>
						<svg class="position-absolute" xmlns="http://www.w3.org/2000/svg" style="top: 8px; left: -12px;" width="7" height="6" viewBox="0 0 7 6"><g><g><path fill="current" d="M.017.005L7 2.663v.482L.017 5.998z" /></g></g></svg>
						</p>
					</div>
                </a>
            </div>
		<?php } while($arsql=mysql_fetch_assoc($str)); ?>
		</div>
	<?php }  ?>
        <ul class="nav nav-tabs d-flex gap-2 mt-4 justify-content-center">
          <?php if ($page['status_p']=="1") { 
		  
		/*$result['total']=$arsql['count_p'];
		$result['new']=$arsql['countnew_p'];
		$result['raw']=$result['total']+$result['new'];*/
		
		$result['total']=$arsql['i_p'];
		$result['raw']=$arsql['i_p'];
		$resunt['new']=0;
		  
		  ?>
		  <li class="nav-item" role="presentation">
            <a href="<?php echo d(flink("catalog", $page['id'], $page['slug'.langpx()])); ?>?type=p" class="<?php if ($page['type']=="p") { echo " active"; } ?>">
              <?php if (in_array($page['id'], $array_vac)) { echo lang("РЕЗЮМЕ"); } else { echo lang("ПРЕДЛОЖЕНИЕ"); } ?><?php /* &nbsp;(<?php echo $result['raw']; ?>) */ ?>
            </a>
          </li>
		  <?php } ?>
          <?php if ($page['status_s']=="1") { 
		  
		/*$result['total']=$arsql['count_s'];
		$result['new']=$arsql['countnew_s'];
		$result['raw']=$result['total']+$result['new'];*/
		
		$result['total']=$arsql['i_s'];
		$result['raw']=$arsql['i_s'];
		$resunt['new']=0;
		  
		  ?>
          <li class="nav-item" role="presentation">
            <a href="<?php echo d(flink("catalog", $page['id'], $page['slug'.langpx()])); ?>?type=s" class="<?php if ($page['type']=="s") { echo " active"; } ?>">
              <?php if (in_array($page['id'], $array_vac)) { echo lang("ВАКАНСИИ"); } else { echo lang("СПРОС"); } ?><?php /* &nbsp;(<?php echo $result['raw']; ?>) */ ?>
            </a>
          </li>
		  <?php } ?>
          <?php if ($page['status_k']=="1") { 
		  
		/*$result['total']=$arsql['count_k'];
		$result['new']=$arsql['countnew_k'];
		$result['raw']=$result['total']+$result['new'];*/
		
		$result['total']=$arsql['i_k'];
		$result['raw']=$arsql['i_k'];
		$resunt['new']=0;
		  ?>
          
		  <li class="nav-item" role="presentation">
            <a href="<?php echo d(flink("catalog", $page['id'], $page['slug'.langpx()])); ?>?type=k" class="<?php if ($page['type']=="k") { echo " active"; } ?>">
              <?php echo lang("КОМПАНИИ"); ?>
            </a>
          </li>
		  
		  <?php } ?>
        </ul>
        <div>
          <div class="px-3 px-md-0">
            <div class="row">
              <div class="col-12 col-md-3 pt-5">
				<?php
				
				$searchsql="";
				
				$regions=$_GET['regions'];
				$regions=array_unique($regions);
				$regions_raw=array();
				$clear_regions=array();
				foreach ($regions as $rg)
				{
					if (is_numeric($rg) and $rg>0) {
						$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `id`='".sql($rg)."' LIMIT 1;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows==1) {
							$clear_regions[]=$rg;
							$regions_raw[]=$rg;
							$clear_regions=array_merge($clear_regions, region_kids($rg));
						}
					}
				}
				$regions=array_unique($clear_regions);
				
				
				if (count($regions)>0) {
					$searchsql.=" and `region` IN ('".implode("', '", $regions)."')";
				}
				
				if(mb_strlen($_GET['search'])>0) {
						$search=mb_strtolower(trim(htmlr($_GET['search'])));
						$searchsql.=" and (`name".langpx()."` LIKE '%".sql(htmlr($_GET['search']))."%' || `text".langpx()."` LIKE '%".sql($search)."%' || `text2` LIKE '%".sql($search)."%')"; 
				}
				
				

				$pis=array();
					$query="SELECT id,name,name_en,name_cn FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='pi' ORDER BY `name`;";
					$str = mysqlq($query);
					$arsql=mysql_fetch_assoc($str);
					$numrows=mysql_num_rows($str);
					if ($numrows>0) {
						do {
							$pis[$arsql['id']]=$arsql;
						} while($arsql=mysql_fetch_assoc($str));
					}

				
				
				
				$pi=array();
				
				if (is_array($_GET['pi'])){
					foreach ($_GET['pi'] as $piline)
					{
						if (array_key_exists($piline, $pis) and $piline!="") {
							$pi[]=$piline;
						}
					}
				}
				
				if (count($pi)>0) {
					
					$searchsql.="and (CONCAT(',', lu_opi, ',') like '%,";
					$searchsql.=implode(",%' || CONCAT(',', lu_opi, ',') like '%,", $pi);
					$searchsql.=",%')";
					
					
					echo $searchsql;
				}
				
	$array=itemsdown_t($page['id'], $page['type']);
	$array=array_unique($array);
	if ($page['id']!="8") {
		$newarray=array();
		foreach($array as $line)
		{
			if ($line!="8") { $newarray[]=$line; }
		}
		$array=$newarray;
	}
						$regionsf=array();
						$query="SELECT count(id) as rnum,region FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `type`='".sql($page['type'])."' and `catalog` IN ('".implode("' ,'", $array)."')".$searchsql." and `status`='1' GROUP BY `region` ORDER BY `rnum` DESC;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
							do {
								
								$regionsf[$arsql['region']]+=$arsql['rnum'];
								$region_parents=region_parents($arsql['region']);
								foreach ($region_parents as $rp)
								{
									$regionsf[$rp]=+$arsql['rnum'];
								}
							} while ($arsql=mysql_fetch_assoc($str));
						}else{
							$regionsf[0]=0;
						}
						
						arsort($regionsf);
						
						$regions1=array(); 
						$rlist1=array();
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent`='0' ORDER by FIELD(id, ".implode(",", array_reverse(array_keys($regionsf))).") DESC, `name`;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
							do {
								$regions1[$arsql['id']]=array("id" => $arsql['id'], "q" => $regionsf[$arsql['id']], "name" => $arsql['name'], "name_en" => $arsql['name_en'], "name_cn" => $arsql['name_cn']);
								$rlist1[]=$arsql['id'];
							} while ($arsql=mysql_fetch_assoc($str));
						}

						$regions2=array(); 
						$rlist2=array();
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent` IN ('".implode("', '", $rlist1)."') ORDER by FIELD(id, ".implode(",", array_reverse(array_keys($regionsf))).") DESC, `name`;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
							do {
								$regions2[$arsql['id']]=array("id" => $arsql['id'], "q" => $regionsf[$arsql['id']], "name" => $arsql['name'], "name_en" => $arsql['name_en'], "name_cn" => $arsql['name_cn']);
								if (!in_array()) { $regions1[$arsql['parent']]['kids'][]=$arsql['id']; }
								$rlist2[]=$arsql['id'];
							} while ($arsql=mysql_fetch_assoc($str));
						}
				
						$regions3=array(); 
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."lists` WHERE `type`='region' and `parent` IN ('".implode("', '", $rlist2)."') ORDER by FIELD(id, ".implode(",", array_reverse(array_keys($regionsf))).") DESC, `name`;";

						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);
						if ($numrows>0) {
							do {
								$regions3[$arsql['id']]=array("id" => $arsql['id'], "q" => $regionsf[$arsql['id']], "name" => $arsql['name'], "name_en" => $arsql['name_en'], "name_cn" => $arsql['name_cn']);
							} while ($arsql=mysql_fetch_assoc($str));
						}
								
				?>
                <form action="" method="GET">
				  <?php if (check_mobile_device()) { ?>
				  <h5 class="text-center" id="filter_mobile" data-target="filter"><span><?php echo lang("ФИЛЬТР"); ?></span></h5>
				  <?php } ?>
				  <?php if ($page['id']=="8") { ?>
					  <div id="filter"<?php if (check_mobile_device()) { echo " style=\"display: none;\""; } ?>>
						<div class="checkbox-wrapper">
						<label for=""><?php echo lang("ПОИСК"); ?></label>
						<div class="ps-0 mt-2 mb-3">
							<input type="text" class="form-control" name="search" value="<?php echo d($search); ?>" placeholder="<?php echo lang("Поиск по торговой площадке"); ?>">
						</div>
						<label for=""><?php echo lang("РЕГИОН"); ?></label>
						<div class="ps-0 mt-2 mb-3">
						<div class="p-1" style="height: 150px; overflow-y: scroll; border: 1px solid #eee;">
						<?php foreach ($regions2 as $r) { ?>
						  <span class="d-block mb-1">
							<input type="checkbox" class="regions2" name="regions[]" value="<?php echo d($r['id']); ?>" <?php if (in_array($r['id'], $regions_raw)) { echo " CHECKED=\"CHECKED\""; } ?>/> <?php echo d($r['name'.langpx()]); ?><?php if ($r['q']>0) { echo " [".d($r['q'])."]"; } ?>
						  </span>
						<?php } ?>
						</div>
						<div class="text-end p-1">
							<a href="#" class="clear" data-id="regions2"><?php echo lang("Очистить"); ?></a>
						</div>
						</div>
						<label for=""><?php echo lang("ОСНОВНЫЕ П/И"); ?></label>
						<div class="ps-0 mt-2 mb-3">
						<div class="p-1" style="height: 150px; overflow-y: scroll; border: 1px solid #eee;">
						<?php foreach ($pis as $r) { ?>
						  <span class="d-block mb-1">
							<input type="checkbox" class="pis" name="pi[]" value="<?php echo d($r['id']); ?>" <?php if (in_array($r['id'], $pi)) { echo " CHECKED=\"CHECKED\""; } ?>/> <?php echo d($r['name'.langpx()]); ?><?php if ($r['q']>0) { echo " [".d($r['q'])."]"; } ?>
						  </span>
						<?php } ?>
						</div>
						<div class="text-end p-1">
							<a href="#" class="clear" data-id="pis"><?php echo lang("Очистить"); ?></a>
						</div>
						</div>
						<div class="place-kd">
						<button class="btn btn-place-kd mx-auto mt-3 mb-5"><?php echo lang("Применить"); ?></button>
						</div>
					  </div>
					</div>

				  <?php }else{ ?>
					  <div id="filter"<?php if (check_mobile_device()) { echo " style=\"display: none;\""; } ?>>
						<div class="checkbox-wrapper">
						<label for=""><?php echo lang("ПОИСК"); ?></label>
						<div class="ps-0 mt-2 mb-3">
							<input type="text" class="form-control" name="search" value="<?php echo d($search); ?>" placeholder="<?php echo lang("Поиск по торговой площадке"); ?>">
						</div>
						<label for=""><?php echo lang("ГОРОД"); ?></label>
						<div class="ps-0 mt-2 mb-2">
						<div class="p-1" style="height: 150px; overflow-y: scroll; border: 1px solid #eee;">
						<?php foreach ($regions3 as $r) { ?>
						  <span class="d-block mb-1">
							<input type="checkbox" class="regions1" name="regions[]" value="<?php echo d($r['id']); ?>" <?php if (in_array($r['id'], $regions_raw)) { echo " CHECKED=\"CHECKED\""; } ?>/> <?php echo d($r['name'.langpx()]); ?><?php if ($r['q']>0) { echo " [".d($r['q'])."]"; } ?>
						  </span>
						<?php } ?>
						</div>
						<div class="text-end p-1">
							<a href="#" class="clear" data-id="regions1"><?php echo lang("Очистить"); ?></a>
						</div>
						</div>
						<label for=""><?php echo lang("РЕГИОН"); ?></label>
						<div class="ps-0 mt-2 mb-3">
						<div class="p-1" style="height: 150px; overflow-y: scroll; border: 1px solid #eee;">
						<?php foreach ($regions2 as $r) { ?>
						  <span class="d-block mb-1">
							<input type="checkbox" class="regions2" name="regions[]" value="<?php echo d($r['id']); ?>" <?php if (in_array($r['id'], $regions_raw)) { echo " CHECKED=\"CHECKED\""; } ?>/> <?php echo d($r['name'.langpx()]); ?><?php if ($r['q']>0) { echo " [".d($r['q'])."]"; } ?>
						  </span>
						<?php } ?>
						</div>
						<div class="text-end p-1">
							<a href="#" class="clear" data-id="regions2"><?php echo lang("Очистить"); ?></a>
						</div>
						</div>
						<label for=""><?php echo lang("СТРАНА"); ?></label>
						<div class="ps-0 mt-2 mb-2">
						<div class="p-1" style="height: 150px; overflow-y: scroll; border: 1px solid #eee;">
						<?php foreach ($regions1 as $r) { ?>
						  <span class="d-block mb-1">
							<input type="checkbox" class="regions3" name="regions[]" value="<?php echo d($r['id']); ?>" <?php if (in_array($r['id'], $regions_raw)) { echo " CHECKED=\"CHECKED\""; } ?>/> <?php echo d($r['name'.langpx()]); ?><?php if ($r['q']>0) { echo " [".d($r['q'])."]"; } ?>
						  </span>
						<?php } ?>
						</div>
						<div class="text-end p-1">
							<a href="#" class="clear" data-id="regions3"><?php echo lang("Очистить"); ?></a>
						</div>
						</div>
						<div class="place-kd">
						<button class="btn btn-place-kd mx-auto mt-3 mb-5"><?php echo lang("Применить"); ?></button>
						</div>
					  </div>
					</div>
				  <?php } ?>
                </form>
              </div>
              <div class="col-12 col-md-9">
                <div class="kd-cards pt-5">
<?php 





					$quoten=15;

						$query="SELECT id, md5(concat(name,name_en,name_cn,region)) as md FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `type`='".sql($page['type'])."' and `catalog` IN ('".implode("' ,'", $array)."')".$searchsql." and `status`='1' GROUP BY md ORDER BY `stamp` DESC ;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$total=mysql_num_rows($str);

						if ($_GET['pg'] and is_numeric($_GET['pg']) and $_GET['pg']>0 and $_GET['pg']==round($_GET['pg'])) { $pg=$_GET['pg']; } else { $pg=1; }
						
						if (($total%$quoten)==0) { $correct=0; } else {$correct=1;}
						$pages=mod($total, $quoten)+$correct;

						if ($pg>$pages) { $pg=$pages; }

						if (!$pg or (($pg%1)>0)) { $pg=1; }
						$start=($pg-1)*$quoten;





	$query="SELECT *, md5(concat(name,name_en,name_cn,region)) as md FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `type`='".sql($page['type'])."' and `catalog` IN ('".implode("' ,'", $array)."')".$searchsql." and `status`='1' GROUP BY md ORDER BY `stamp` DESC  LIMIT ".$start.", ".$quoten.";";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);
	if ($numrows>0) { 
	$k=0;
	do {
		$follower=user($arsql['user']);
		$l=l("item", $arsql['id'], $GLOBALS['user']['lang']);
	$k++;
?>
                  <a href="<?php echo d($l); ?>" class="kd-card flex-wrap flex-md-nowrap d-flex gap-4 mt-<?php if ($k==1) { echo "0"; } else { echo "5"; } ?><?php if ($k==$numrows) { echo " mb-5"; } ?>">
          <?php if (!in_array($page['id'], array("8"))){ ?>
		  <div class="kd-card__img flex-shrink-0 col-12 col-md-3">
                      
		  <?php 
			$cachename="";
			$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($arsql['id'])."' and `type`='image' ORDER BY `position`, `id` LIMIT 1;";
			$str2 = mysqlq($query2);
			$arsql2=mysql_fetch_assoc($str2);
			$numrows2=mysql_num_rows($str2);
			if ($numrows2>0) { 
				
				if (file_exists("upload/items/".$arsql2['file']) and mb_strlen($arsql2['file'])>4) {
					$cachename="/".imagecache("upload/items/", $arsql2['file']);
				}
			} 
			if ($cachename=="") {
				if(file_exists("upload/profiles/".$follower['public_logo']) and mb_strlen($follower['public_logo'])>4) {
					$cachename="/".imagecache("upload/profiles/", $follower['public_logo']);
				}else{
					$cachename="/img/no_news_image.png";
				}
			}
			
			?>
              <img src="<?php echo d($cachename); ?>" alt="<?php echo d($arsql['name'.langpx()]); ?>" title="<?php echo d($arsql['name'.langpx()]); ?>" />
                    </div>
		  <?php } ?>
                    <div class="w-100">
                      <div class="kd-card__title">
                        <?php echo d($arsql['name'.langpx()]); ?>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mt-2 kd-card__details">
                        <span class="fw-bold"><?php if ($arsql['catalog'] != 67) echo d(fullprice($arsql['price'], $arsql['price_type'], $arsql['price_cur'])); ?></span>
                        <span style="text-align: right;">
                          <?php if ($arsql['catalog'] == 67) { echo d(date("d.m.Y H:i", $arsql['stamp']));}else{
                                echo d(region($arsql['region'])['name'.langpx()]);
                                if ($page['type']!="k") echo ", ".d(date("d.m.Y H:i", $arsql['stamp']));
                          }?>
                        </span>
                      </div>
					  <div class="d-flex align-items-center justify-content-between mt-2 kd-socials kd-list-phone"><?php if (mb_strlen($follower['phone'])>0) { ?><div class="d-flex align-items-center gap-2"><i class="fa-solid fa-phone"></i> <?php echo phone_format($follower['phone']); ?></div><?php } ?></div>
                      <p class="my-2">
                        <?php echo nl2br(necuttext($arsql['text'.langpx()], 120)); ?>
                      </p>
					  <?php if ($page['type']!="k" and mb_strlen($follower['company'])>0) { ?>
                      <div>
                        <div class="accordion-item position-relative mb-3">
                          <h2 class="accordion-header position-relative">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse">
                              <?php echo "<i class=\"fa-regular fa-id-card\"></i>&nbsp;".d($follower['company']); ?>
                            </button>
                          </h2>
                        </div>
                      </div>
					  <?php } ?>
                    </div>
                  </a>
	<?php } while($arsql=mysql_fetch_assoc($str));
	}else{ ?>
	<div class="w-100 text-center"><?php echo lang("<b>Ничего не найдено</b><br>Попробуйте поискать в других разделах"); ?></div>
	<?php }  ?>
                </div>
                <?php
				if (mb_strlen($qstring)>0) { $sym="&"; } else { $sym="?"; }
					echo pages($pageslink.$qstring, $pg, $pages, $sym); 
				
				
				?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	
	
	



<?php }elseif($mod=="add"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
		<a href="<?php echo flink("", "", ""); ?>"><?php echo lang("Главная"); ?></a> > <a href="/add/"><?php echo lang("Разместить предложение"); ?></a>
        </div>
      </div>
    </div>
    <div class="place-kd px-3 px-md-0">
      <div class="container">
	  <?php echo navmenu($mod); ?>
	  <form enctype="multipart/form-data">
        <h1 class="title-inner"><?php echo lang("Разместить объявление"); ?></h1>
        <div id="add_form" class="place-kd-form p-3 mb-4">
            <div class="tab-pane fade show active px-1 px-md-0">
              <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Тип объявления:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="w-100 mb-4">
				  <ul class="nav nav-tabs d-flex gap-2 mt-2 mb-0 justify-content-left" id="myTab" role="tablist">
				  <li class="nav-item" role="presentation">
					<button class="active add-type px-2 py-1" id="supply-tab" data-bs-toggle="tab" data-bs-target="#supply" type="button" role="tab">
					  <?php echo lang("ПРЕДЛОЖЕНИЕ"); ?>
					</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="add-type px-2 py-1" id="demand-tab" data-bs-toggle="tab" data-bs-target="#demand" type="button" role="tab">
					  <?php echo lang("СПРОС"); ?>
					</button>
				  </li>
				  </ul>
                </div>
              </div>
            </div>
		  <?php
		  
		  
		  
		  function catalog_tree($result, $parent=0)
		  {
			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='".sql($parent)."' ORDER BY `position`, `id`;";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);	
			if ($numrows>0) {
				if ($parent==0) {
                    $result = array();
                    $result['p'].="<ul class=\"show\">";
					$result['s'].="<ul class=\"show\">";
					$result['k'].="<ul class=\"show\">";
				}else{
					$result['p'].="<ul class=\"\">";
					$result['s'].="<ul class=\"\">";
					$result['k'].="<ul class=\"\">";
				}
				do {	
					if ($parent==0) { $v=" style=\"padding-left: 1px;\""; } else { $v=" style=\"padding-left: 1px;\""; }
					if ($arsql['check_zp']=="1") { $data_price_name="1"; } else { $data_price_name="0"; }
					if ($arsql['check_bp']=="1") { $data_bp="1"; } else { $data_bp="0"; }
					if ($arsql['check_nb']=="1") { $data_nb="1"; } else { $data_nb="0"; }
					if ($arsql['status_p']=="1") { 
						if (haskids("catalog", $arsql['id'], "`status_p`='1'")) {
							$result['p'].="<li><div class=\"close\">".d($arsql['name'.langpx()])."</div>";
						}else{
							$result['p'].="<li><div class=\"\"".$v."><input type=\"radio\" name=\"radio_p\" value=\"".d($arsql['id'])."\" data-price-name=\"".d($data_price_name)."\" data-bp=\"".d($data_bp)."\" data-nb=\"".d($data_nb)."\" style=\"height: auto;\"> ".d($arsql['name'.langpx()])."</div></li>";
						}
					}
					if ($arsql['status_s']=="1") { 
						if (haskids("catalog", $arsql['id'], "`status_s`='1'")) {
							$result['s'].="<li><div class=\"close\">".d($arsql['name'.langpx()])."</div>";
						}else{
							$result['s'].="<li><div class=\"\"".$v."><input type=\"radio\" name=\"radio_s\" value=\"".d($arsql['id'])."\" data-price-name=\"".d($data_price_name)."\" style=\"height: auto;\"> ".d($arsql['name'.langpx()])."</div></li>";
						}
					}
					
						$next=catalog_tree($arsql['id']);
						$result['p'].=$next['p'];
						$result['s'].=$next['s'];
						$result['k'].=$next['k'];
						
					
						
						
				}while($arsql=mysql_fetch_assoc($str));
				$result['p'].="</ul>";
				$result['s'].="</ul>";
				$result['k'].="</ul>";

			}
			return $result;
		  }
		  
		  $result=catalog_tree();
		  

		  
		  
		  
		  
		  
		  ?>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active px-1 px-md-0" id="supply" role="tabpanel" aria-labelledby="supply-tab">
              <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Раздел:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="catalog_list w-100 mb-2" id="catalog_list1">
				  <?php echo $result['p']; ?>
                </div>
              </div>
              <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2" style="height: 0;">&nbsp;</div>
                <div class="catalog_list w-100 mt-0 mb-2">
				  <div id="error11" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade px-3 px-md-0" id="demand" role="tabpanel" aria-labelledby="demand-tab">
              <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Раздел:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="catalog_list w-100 mb-2" id="catalog_list2">
				  <?php echo $result['s']; ?>
                </div>
              </div>
			  <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2" style="height: 0;">&nbsp;</div>
                <div class="catalog_list w-100 mt-0 mb-2">
				  <div id="error12" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
              </div>
            </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Регион:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="d-flex flex-column flex-md-row gap-1 gap-md-3 w-100">
				<div class="row w-100 m-0">
					<div class="col-12 col-md-4 p-0">
					  <select id="list11" name="country" class="w-100 p-1">
					  </select>
					</div>
					<div class="col-12 col-md-4 p-0 ps-md-1">
					  <select id="list12" name="country" class="w-100 p-1">
					  </select>
					</div>
					<div class="col-12 col-md-4 p-0 ps-md-1">
					  <select id="list13" name="country" class="w-100 p-1">
					  </select>
					</div>
                </div>
			  </div>
              </div>
			  <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2" style="height: 0;">&nbsp;</div>
                <div class="catalog_list w-100 mt-0 mb-2">
				  <div id="error2" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span id="name_name1"><?php echo lang("Наименование:"); ?></span><span id="name_name2" style="display: none;"><?php echo lang("Вакансия:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="d-flex gap-3 w-100">
                  <input type="text" id="name" name="name" class="w-100 px-2" />
                </div>
              </div>
			  <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2" style="height: 0;">&nbsp;</div>
                <div class="catalog_list w-100 mt-0 mb-2">
				  <div id="error3" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
              </div>
              <div id="nb_panel" class="w-100 flex-wrap flex-md-nowrap mt-3" style="display: none;">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Состояние:"); ?></span>
                </div>
                <div class="d-flex gap-3 w-100">
                  <select id="nb" name="nb" class="w-100 px-2" />
					<option value="0"><?php echo lang("Новое"); ?></option>
					<option value="1"><?php echo lang("Б/у"); ?></option>
				  </select>
                </div>
              </div>
			  <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2" style="height: 0;">&nbsp;</div>
                <div class="catalog_list w-100 mt-0 mb-2">
				  <div id="error3" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
              </div>
              <div id="price_panel" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span id="price_name1"><?php echo lang("Цена:"); ?></span><span id="price_name2" style="display: none;"><?php echo lang("Зар.плата:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="w-100">
                  <div class="d-flex gap-1">
                    <select name="price-range" id="price-range" class="px-2" id="">
                      <option value="1"><?php echo lang("от"); ?></option>
					  <option value="2"><?php echo lang("точная"); ?></option>
					  <option value="3"><?php echo lang("до"); ?></option>
					  <option value="4"><?php echo lang("договорная"); ?></option>
					  <option value="5"><?php echo lang("по запросу"); ?></option>
                    </select>
                    <input type="text" name="price" id="price" class="w-100 px-2" />
                    <select name="price-cur" id="price-cur" class="px-2" id="">
                      <option value="1"><?php echo lang("руб"); ?></option>
                      <option value="2"><?php echo lang("USD"); ?></option>
                      <option value="3"><?php echo lang("CNY"); ?></option>
                    </select>
                  </div>
                  <div id="error4" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
             </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Описание:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <textarea type="text" id="text" name="description" class="w-100 p-2" rows="7"></textarea>
                </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Доп.сведения:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <textarea type="text" id="text2" name="description2" class="w-100 p-2" rows="7"></textarea>
                </div>
              </div>
              <div id="bp_panel" class="w-100 flex-wrap flex-md-nowrap mt-3" style="display: none;">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Базис поставки:"); ?></span>
                </div>
                <div class="d-flex gap-3 w-100">
                  <input type="text" id="bp" name="bp" class="w-100 px-2" />
                </div>
              </div>
              <div id="file_panel1" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3" style="display: none;">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Фотографии:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <div class="w-100 input-images-1" style="padding-top: .5rem;"></div>
                </div>
              </div>
              <div id="file_panel2" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3" style="display: none;">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Логотип:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <input type="file" class="filepicker" />
                </div>
              </div>
              <div id="file_panel3" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3" style="display: none;">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Резюме:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <input type="file" class="filepicker" />
                </div>
              </div>
              <div id="youtube_panel" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3" style="display: none;">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Прикрепить видео:"); ?></span>
                </div>
                <div class="w-100">
                  <div class="d-flex w-100">
                    <input type="text" id="video" class="w-100 px-2" name="video" />
                  </div>
				  <div id="error5" class="warning-message" style="display: none;"><?php echo lang("Некорректная ссылка на YouTube!"); ?></div>
                  <div class="mt-2">
                    <p><?php echo lang("Укажите ссылку на видео на видеохостинге YouTube"); ?></p>
                    <p><?php echo lang("Примеры ссылок:"); ?></p>
                    <p>http://youtu.be/ArzdhadfGH</p>
                    <p>http://www.youtube.com/watch?v=ArzdhadfGH</p>
                  </div>
                </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Контактный телефон:"); ?></span>
                </div>
                <div class="w-100">
					<div class="d-flex gap-3 w-100">
					  <input type="text" name="public_phone" class="public-data w-100 px-2" readonly="readonly" value="<?php echo d($GLOBALS['user']['public_phone']); ?>" />
					</div>
					<div class="mt-2" style="display: none;">
					<?php echo lang("Контактные данные изменяются в настройках Профиля"); ?>
					</div>
				</div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Контактный E-mail:"); ?></span>
                </div>
                <div class="w-100">
					<div class="d-flex gap-3 w-100">
					  <input type="text" name="public_email" class="public-data w-100 px-2" readonly="readonly" value="<?php echo d($GLOBALS['user']['public_email']); ?>" />
					</div>
					<div class="mt-2" style="display: none;">
					<?php echo lang("Контактные данные изменяются в настройках Профиля"); ?>
					</div>
				</div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Контактное лицо:"); ?></span>
                </div>
                <div class="w-100">
					<div class="d-flex gap-3 w-100">
					  <input type="text" name="public_name" class="public-data w-100 px-2" readonly="readonly" value="<?php echo d($GLOBALS['user']['public_name']); ?>" />
					</div>
					<div class="mt-2" style="display: none;">
					<?php echo lang("Контактные данные изменяются в настройках Профиля"); ?>
					</div>
				</div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Правила размещения:"); ?></span>
                </div>
                <div>
                  <p>
                    <?php echo lang("Перед размещением объявления настоятельно рекомендуем внимательно ознакомиться с <a href=\"{{{link(page,11)}}}\" target=\"_blank\">Правилами размещения информации на портале</a>"); ?>
                  </p>
                </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100">
                  <span></span>
                </div>
                <div class="w-100">
                  <div class="ms-3 mt-5">
                    <p style="font-size: 14px">
                      <?php echo lang("* — Поля обязательны к заполнению."); ?>
                    </p>
                  </div>
                  <button id="sendform" class="btn btn-place-kd mx-auto mt-3">
                    <?php echo lang("Опубликовать"); ?>
                  </button>
                </div>
              </div>		  
          </div>
        </div>
		<div id="form_ok" class="p-3 mb-4" style="display: none;"></div>
		<div id="form_notok" class="p-3 mb-4" style="display: none;"></div>
		</form>
      </div>
    </div>
	
	
	
	
<?php }elseif($mod=="edit"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
		<a href="<?php echo flink("", "", ""); ?>"><?php echo lang("Главная"); ?></a> > <a href="<?php echo l("edit", 0, $GLOBALS['user']['lang']); ?><?php echo d($page['id']); ?>/"><?php echo d($page['name']); ?></a>
        </div>
      </div>
    </div>
    <div class="place-kd px-3 px-md-0">
      <div class="container">
	  <?php echo navmenu($mod); ?>
	  <form enctype="multipart/form-data">
        <h1 class="title-inner"><?php echo lang("Редактировать объявление"); ?></h1>
        <div id="add_form" class="place-kd-form p-3 mb-4">
            <div class="tab-pane fade show active px-1 px-md-0">
              <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Тип объявления:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="w-100 mb-1">
				  <ul class="nav nav-tabs d-flex gap-2 mt-2 mb-0 justify-content-left" id="myTab" role="tablist">
				  <li class="nav-item" role="presentation">
					<button class="<?php if ($page['type']=="p") { echo "active"; } ?> add-type px-2 py-1" id="supply-tab" type="button">
					  <?php echo lang("ПРЕДЛОЖЕНИЕ"); ?>
					</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="<?php if ($page['type']=="s") { echo "active"; } ?> add-type px-2 py-1" id="demand-tab" type="button">
					  <?php echo lang("СПРОС"); ?>
					</button>
				  </li>
				  </ul>
                </div>
              </div>
            </div>
		  <?php
		  
		  

		  function catalog_tree_edit($result, $parent=0, $page)
		  {
			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='".sql($parent)."' ORDER BY `position`, `id`;";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);	
			if ($numrows>0) {
				if ($parent==0) {
                    $result = array();
					$result['p'].="<ul class=\"show\">";
					$result['s'].="<ul class=\"show\">";
					$result['k'].="<ul class=\"show\">";
				}else{
					$result['p'].="<ul class=\"\">";
					$result['s'].="<ul class=\"\">";
					$result['k'].="<ul class=\"\">";
				}
				do {	
					if ($parent==0) { $v=" style=\"padding-left: 1px;\""; } else { $v=" style=\"padding-left: 1px;\""; }
					if ($arsql['check_zp']=="1") { $data_price_name="1"; } else { $data_price_name="0"; }
					if ($arsql['check_bp']=="1") { $data_bp="1"; } else { $data_bp="0"; }
					if ($arsql['check_nb']=="1") { $data_nb="1"; } else { $data_nb="0"; }
					if ($arsql['status_p']=="1") {
						if($page['type']=="p" and $page['catalog']==$arsql['id']){$selected=" checked=\"checked\"";}else{$selected="";}						
						if (haskids("catalog", $arsql['id'], "`status_p`='1'")) {
							$result['p'].="<li><div class=\"close\">".d($arsql['name'.langpx()])."</div>";
						}else{
							$result['p'].="<li><div class=\"\"".$v."><input type=\"radio\" name=\"radio_p\" value=\"".d($arsql['id'])."\" data-price-name=\"".d($data_price_name)."\" data-bp=\"".d($data_bp)."\" data-nb=\"".d($data_nb)."\" style=\"height: auto;\" disabled=\"disabled\"".$selected."> ".d($arsql['name'.langpx()])."</div></li>";
						}
					}
					if ($arsql['status_s']=="1") { 
						if($page['type']=="s" and $page['catalog']==$arsql['id']){$selected=" checked=\"checked\"";}else{$selected="";}	
						if (haskids("catalog", $arsql['id'], "`status_s`='1'")) {
							$result['s'].="<li><div class=\"close\">".d($arsql['name'.langpx()])."</div>";
						}else{
							$result['s'].="<li><div class=\"\"".$v."><input type=\"radio\" name=\"radio_s\" value=\"".d($arsql['id'])."\" data-price-name=\"".d($data_price_name)."\" style=\"height: auto;\" disabled=\"disabled\"".$selected."> ".d($arsql['name'.langpx()])."</div></li>";
						}
					}
					
						$next=catalog_tree_edit($arsql['id'], $page);
						$result['p'].=$next['p'];
						$result['s'].=$next['s'];
						$result['k'].=$next['k'];
						
					
						
						
				}while($arsql=mysql_fetch_assoc($str));
				$result['p'].="</ul>";
				$result['s'].="</ul>";
				$result['k'].="</ul>";

			}
			return $result;
		  }
		  
		 

			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `id`='".sql($page['catalog'])."' LIMIT 1;";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);	
			if ($numrows==1) {
				
					if ($arsql['check_zp']=="1") { $data_price_name="1"; } else { $data_price_name="0"; }
					if ($arsql['check_bp']=="1") { $data_bp="1"; } else { $data_bp="0"; }
					if ($arsql['check_nb']=="1") { $data_nb="1"; } else { $data_nb="0"; }
					$selected=" checked=\"checked\""; 
				if ($page['type']=="p") {
					$radio_hidden="<div style=\"display: none;\"><input type=\"radio\" name=\"radio_p\" value=\"".d($arsql['id'])."\" data-price-name=\"".d($data_price_name)."\" data-bp=\"".d($data_bp)."\" data-nb=\"".d($data_nb)."\" style=\"height: auto;\" disabled=\"disabled\"".$selected."></div>";
				}elseif($page['type']=="s"){
					$radio_hidden="<div style=\"display: none;\"><input type=\"radio\" name=\"radio_s\" value=\"".d($arsql['id'])."\" data-price-name=\"".d($data_price_name)."\" style=\"height: auto;\" disabled=\"disabled\"".$selected."></div>";
				}
		  
			}

		  ?>
          <div class="tab-content" id="myTabContent">
               <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-2">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Раздел:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="d-flex flex-column flex-md-row gap-1 gap-md-3 w-100">
				<div class="d-flex align-items-center gap-1 m-0 address">
					  <div>
					  <?php echo implode(" > ", catalogfull($page['catalog'])); ?><?php echo $radio_hidden; ?>
					  </div>
                </div>
			  </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-2">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Регион:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="d-flex flex-column flex-md-row gap-1 gap-md-3 w-100">
				<div class="d-flex align-items-center gap-1 m-0 address">
					  <div>
					  <?php echo implode(", ", regionfull($page['region'])); ?>
					  </div>
                </div>
			  </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-2">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Статус:"); ?></span>
                </div>
                <div class="d-flex flex-column flex-md-row gap-1 gap-md-3 w-100">
				<div class="d-flex align-items-center gap-1 m-0 address">
					  <div>
					  <?php echo item_status($page['status']); ?>
					  </div>
                </div>
			  </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span id="name_name1"><?php echo lang("Наименование:"); ?></span><span id="name_name2" style="display: none;"><?php echo lang("Вакансия:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="d-flex gap-3 w-100">
                  <input type="text" id="name" name="name" data-id="<?php echo d($page['id']); ?>" class="w-100 px-2" value="<?php echo d($page['name'.retlang($page['lang'])]); ?>" />
                </div>
              </div>
			  <div class="w-100 d-flex flex-wrap flex-md-nowrap">
                <div class="attr w-100 pt-2" style="height: 0;">&nbsp;</div>
                <div class="catalog_list w-100 mt-0 mb-2">
				  <div id="error3" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
              </div>
              <div id="nb_panel" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Состояние:"); ?></span>
                </div>
                <div class="d-flex gap-3 w-100">
                  <select id="nb" name="nb" class="w-100 px-2" />
					<option value="0"<?php if ($page['bu']==0) { echo " selected"; } ?>><?php echo lang("Новое"); ?></option>
					<option value="1"<?php if ($page['bu']==1) { echo " selected"; } ?>><?php echo lang("Б/у"); ?></option>
				  </select>
                </div>
              </div>
              <div id="price_panel" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span id="price_name1"><?php echo lang("Цена:"); ?></span><span id="price_name2"><?php echo lang("Зар.плата:"); ?></span><span class="warning-star ms-1">*</span>
                </div>
                <div class="w-100">
                  <div class="d-flex gap-1">
                    <select name="price-range" id="price-range" class="px-2" id="">
                      <option value="1"<?php if ($page['price_type']=="1") { echo " SELECTED"; } ?>><?php echo lang("от"); ?></option>
					  <option value="2"<?php if ($page['price_type']=="2") { echo " SELECTED"; } ?>><?php echo lang("точная"); ?></option>
					  <option value="3"<?php if ($page['price_type']=="3") { echo " SELECTED"; } ?>><?php echo lang("до"); ?></option>
					  <option value="4"<?php if ($page['price_type']=="4") { echo " SELECTED"; } ?>><?php echo lang("договорная"); ?></option>
					  <option value="5"<?php if ($page['price_type']=="5") { echo " SELECTED"; } ?>><?php echo lang("по запросу"); ?></option>
                    </select>
                    <input type="text" name="price" id="price" class="w-100 px-2" <?php if (in_array($page['price_type'], array("1", "2", "3"))) { echo "value=\"".d($page['price'])."\" "; } ?>/>
                    <select name="price-cur" id="price-cur" class="px-2" id="">
                      <option value="1"<?php if ($page['price_cur']=="1") { echo " SELECTED"; } ?>><?php echo lang("руб"); ?></option>
                      <option value="2"<?php if ($page['price_cur']=="2") { echo " SELECTED"; } ?>><?php echo lang("USD"); ?></option>
                      <option value="3"<?php if ($page['price_cur']=="3") { echo " SELECTED"; } ?>><?php echo lang("CNY"); ?></option>
                    </select>
                  </div>
                  <div id="error4" class="warning-message" style="display: none;"><?php echo lang("Это поле обязательно для заполнения!"); ?></div>
                </div>
             </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Описание:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <textarea type="text" id="text" name="description" class="w-100 p-2" rows="7"><?php echo $page['text'.retlang($page['lang'])]; ?></textarea>
                </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Доп.сведения:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <textarea type="text" id="text2" name="description2" class="w-100 p-2" rows="7"><?php echo $page['text2'.retlang($page['lang'])]; ?></textarea>
                </div>
              </div>
              <div id="bp_panel" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Базис поставки:"); ?></span>
                </div>
                <div class="d-flex gap-3 w-100">
                  <input type="text" id="bp" name="bp" class="w-100 px-2" value="<?php echo d($page['bp'.retlang($page['lang'])]); ?>" />
                </div>
              </div>
              <div id="file_panel1" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Фотографии:"); ?></span>
                </div>
                <div id="photo" class="d-flex w-100">
					<div class="image-uploader has-files s w-100">
					</div>
                </div>
              </div>
              <div id="file_panel4" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span>&nbsp;</span>
                </div>
                <div class="d-flex w-100">
					<input type="file" id="image-uploader" name="images[]" multiple="multiple" style="border:0;">
                </div>
              </div>
              <div id="file_panel2" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Логотип:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <input type="file" class="filepicker" />
                </div>
              </div>
              <div id="file_panel3" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Резюме:"); ?></span>
                </div>
                <div class="d-flex w-100">
                  <input type="file" class="filepicker" />
                </div>
              </div>
              <div id="youtube_panel" class="d-flex w-100 flex-wrap flex-md-nowrap mt-3" style="display: none;">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Прикрепить видео:"); ?></span>
                </div>
                <div class="w-100">
                  <div class="d-flex w-100">
                    <input type="text" id="video" class="w-100 px-2" name="video" value="<?php echo d($page['video']); ?>" />
                  </div>
				  <div id="error5" class="warning-message" style="display: none;"><?php echo lang("Некорректная ссылка на YouTube!"); ?></div>
                  <div class="mt-2">
                    <p><?php echo lang("Укажите ссылку на видео на видеохостинге YouTube"); ?></p>
                    <p><?php echo lang("Примеры ссылок:"); ?></p>
                    <p>http://youtu.be/ArzdhadfGH</p>
                    <p>http://www.youtube.com/watch?v=ArzdhadfGH</p>
                  </div>
                </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Контактный телефон:"); ?></span>
                </div>
                <div class="w-100">
					<div class="d-flex gap-3 w-100">
					  <input type="text" name="public_phone" class="public-data w-100 px-2" readonly="readonly" value="<?php echo d($GLOBALS['user']['public_phone']); ?>" />
					</div>
					<div class="mt-2" style="display: none;">
					<?php echo lang("Контактные данные изменяются в настройках Профиля"); ?>
					</div>
				</div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Контактный E-mail:"); ?></span>
                </div>
                <div class="w-100">
					<div class="d-flex gap-3 w-100">
					  <input type="text" name="public_email" class="public-data w-100 px-2" readonly="readonly" value="<?php echo d($GLOBALS['user']['public_email']); ?>" />
					</div>
					<div class="mt-2" style="display: none;">
					<?php echo lang("Контактные данные изменяются в настройках Профиля"); ?>
					</div>
				</div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Контактное лицо:"); ?></span>
                </div>
                <div class="w-100">
					<div class="d-flex gap-3 w-100">
					  <input type="text" name="public_name" class="public-data w-100 px-2" readonly="readonly" value="<?php echo d($GLOBALS['user']['public_name']); ?>" />
					</div>
					<div class="mt-2" style="display: none;">
					<?php echo lang("Контактные данные изменяются в настройках Профиля"); ?>
					</div>
				</div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100 pt-2">
                  <span><?php echo lang("Правила размещения:"); ?></span>
                </div>
                <div>
                  <p>
                    <?php echo lang("Перед размещением объявления настоятельно рекомендуем внимательно ознакомиться с <a href=\"{{{link(page,11)}}}\" target=\"_blank\">Правилами размещения информации на портале</a>"); ?>
                  </p>
                </div>
              </div>
              <div class="d-flex w-100 flex-wrap flex-md-nowrap mt-3">
                <div class="attr w-100">
                  <span></span>
                </div>
                <div class="w-100">
                  <div class="ms-3 mt-5">
                    <p style="font-size: 14px">
                      <?php echo lang("* — Поля обязательны к заполнению."); ?>
                    </p>
                  </div>
				  <div id="form_ok" class="mt-3 mb-0 text-center" style="display: none; color: #090;"></div>
                  <button id="sendform" class="btn btn-place-kd mx-auto mt-3">
                    <?php echo lang("Сохранить"); ?>
                  </button>
                </div>
              </div>		  
          </div>
        </div>
		<div id="form_notok" class="place-kd-form p-3 mb-4" style="display: none;"></div>
		</form>
      </div>
    </div>

<?php }elseif($mod=="registration"){ 

 ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="/registration/"><?php echo lang("Регистрация"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0">
		<div class="container">
			<?php

			$html="";
			$html.="<div class=\"alert alert-delay-hide alert-warning alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Для размещения объявлений на портале необходимо зарегистрироваться.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
			echo $html;

				?>
			<h1 class="title-inner"><?php echo lang("Регистрация"); ?></h1>
			<div class="row justify-content-center mb-4" style="background: #eee url(img/texture/back2.png);">
				<div class="col-12 col-md-7 p-3">
					<form id="regform">
					  <div class="mb-3">
						<label for="InputRole" class="form-label mb-0"><?php echo lang("Статус"); ?> <span class="text-danger">*</span></label>
						<select id="InputRole" name="role" class="form-select" id="">
						<?php 
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `status`='1' ORDER BY `position`, `id`;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);	
						if ($numrows>0) {
							do {
						?>
							<option value="<?php echo d($arsql['id']); ?>"><?php echo d($arsql['name'.langpx()]); ?></option>
						<?php } while($arsql=mysql_fetch_assoc($str)); } ?>
						</select>
						<div class="form-text"><?php echo lang("Укажите в каком качестве Вы хотите зарегистрироваться"); ?></div>
						<div id="ErrorRole" class="form-text text-danger" style="display: none;"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputEmail" class="form-label mb-0"><?php echo lang("Адрес электронной почты"); ?> <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp">
						<div id="ErrorEmail" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputPass1" class="form-label mb-0"><?php echo lang("Пароль"); ?> <span class="text-danger">*</span></label>
						<input type="password" name="pass1" class="form-control" id="InputPass1">
						<div id="ErrorPass1" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputPassword2" class="form-label mb-0"><?php echo lang("Повторите пароль"); ?> <span class="text-danger">*</span></label>
						<input type="password" name="pass2" class="form-control" id="InputPass2">
						<div id="ErrorPass2" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputCompany" class="form-label mb-0"><?php echo lang("Компания"); ?></label>
						<input type="text" name="company" class="form-control" id="InputCompany">
					  </div>
					  <div class="mb-3">
						<label for="InputName" class="form-label mb-0"><?php echo lang("Ф.И.О."); ?></label>
						<input type="text" name="name" class="form-control" id="InputName">
					  </div>
					  <div class="mb-3">
						<label for="InputPhone" class="form-label mb-0"><?php echo lang("Контактный телефон"); ?></label>
						<input type="text" name="phone" class="form-control" id="InputPhone">
					  </div>
					  <div class="mb-3 form-check">
						<input type="checkbox" name="check" class="form-check-input" id="InputCheck" value="1">
						<label class="form-check-label" for="Check"><?php echo lang("Подтверждаю")." "."<a href=\"".l("page", 17, $GLOBALS['user']['lang'])."\" target=\"_blank\">".lang("Согласие на обработку персональных данных")."</a>"." ".lang("в соответствии с")." "."<a href=\"".l("page", 16, $GLOBALS['user']['lang'])."\" target=\"_blank\">".lang("Политикой обработки персональных данных")."</a>"; ?></label>
						<div id="ErrorCheck" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <button id="regbtn" class="btn btn-place-cd mx-auto"><?php echo lang("Зарегистрироваться"); ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php }elseif($mod=="newslist"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="<?php echo flink("news"); ?>"><?php echo lang("Новости"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0">
		<div class="container">
			<h1 class="title-inner"><?php echo lang("Новости"); ?></h1>
			<div class="row justify-content-center mb-4">
		  <?php 
		  
					$quoten=10;

						$query="SELECT id FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `status`='1' ORDER BY `stamp` DESC, `id` DESC";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$total=mysql_num_rows($str);

						if ($_GET['pg'] and is_numeric($_GET['pg']) and $_GET['pg']>0 and $_GET['pg']==round($_GET['pg'])) { $pg=$_GET['pg']; } else { $pg=1; }
						
						if (($total%$quoten)==0) { $correct=0; } else {$correct=1;}
						$pages=mod($total, $quoten)+$correct;

						if ($pg>$pages) { $pg=$pages; }

						if (!$pg or (($pg%1)>0)) { $pg=1; }
						$start=($pg-1)*$quoten;
		  
		  
			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `status`='1' ORDER BY `stamp` DESC, `id` DESC LIMIT ".$start.", ".$quoten.";";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);	
			if ($numrows>0) {
				do {
					$out="";

					if (mb_strlen($arsql['file'])>4 and file_exists("upload/news/".$arsql['file'])) {
						$img="/upload/news/".$arsql['file'];
						$alt=d($arsql['name'.langpx()]);
					}else{
						$img="/img/no_news_image.png";
						$alt="";
					}

					$out.="<a href=\"".l("news", $arsql['id'], $GLOBALS['user']['lang'])."\" class=\"news-a row mb-2 mt-4 px-3\">";
					$out.="<div class=\"col-12 col-md-5 col-lg-3\">";
					$out.="<img src=\"".$img."\" class=\"w-100 w-md-auto\" alt=\"".$alt."\" title=\"".$alt."\">";
					$out.="</div>";
					$out.="<div class=\"col-12 col-md-7 col-lg-9\">";
					$out.="<h5 class=\"news-header mt-3 mt-md-0 d-block mb-3\">";
					$out.=d($arsql['name'.langpx()]);
					$out.="</h5>";
					$out.="<p class=\"news-preview\">";
					$out.=d($arsql['preview'.langpx()]);				
					$out.="</p>";
					$out.="<div class=\"d-flex align-items-center justify-content-between mt-2 news-more\">";
					$out.="<span>".date("d.m.Y H:i", $arsql['stamp'])."</span>";
					$out.="<span>".lang("Читать полностью...")."</span>";
					$out.="</div>";
					/* $out.="<div class=\"news-more d-flex justify-content-end\">";
					$out.=lang("Читать полностью...");
					$out.="</div>"; */
					$out.="</div>";
					$out.="</a>";
					
					
					echo $out;
				} while ($arsql=mysql_fetch_assoc($str));	
			}
			
			echo pages(flink("news"), $pg, $pages, "?"); 
			?>
			</div>
		</div>
	</div>
	

<?php }elseif($mod=="news"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="<?php echo flink("news"); ?>"><?php echo lang("Новости"); ?></a> > <a href="<?php echo flink("news", $page['id'], $page['slug'.langpx()]); ?>"><?php echo $page['name'.langpx()]; ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0">
		<div class="container">
			<h1 class="title-inner"><?php echo $page['name'.langpx()]; ?></h1>
			<div class="mb-2 clearfix">
				<?php if (mb_strlen($page['file'])>4 and file_exists("upload/news/".$page['file'])) { ?><a href="#"><img src="<?php echo "/upload/news/".$page['file']; ?>" class="float-start col-12 col-md-5 me-0 me-md-3 mb-0 mb-md-3" alt="<?php echo d($page['name'.langpx()]); ?>"></a><?php } ?>
				<p><?php echo $page['html'.langpx()]; ?></p>
			</div>
			<div class="text-end">
				<span><?php echo date("d.m.Y H:i", $page['stamp']); ?></span>
			</div>
			<div class="wrap_pagination text-center mt-1 mb-5">
					<a href="<?php echo backlink("/news/"); ?>"><?php echo lang("Вернуться назад"); ?></a>
			</div>
		</div>
	</div>
	

<?php }elseif($mod=="page"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="<?php echo flink("page", $page['id'], $page['slug'.langpx()]); ?>"><?php echo $page['name'.langpx()]; ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0">
		<div class="container">
			<h1 class="title-inner"><?php echo $page['name'.langpx()]; ?></h1>
			<div class="mb-4 clearfix">
				<p><?php echo pre($page['html'.langpx()]); ?></p>
			</div>
		</div>
	</div>
	



<?php }elseif($mod=="profile"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="<?php echo l("profile", 0, $GLOBALS['user']['lang']); ?>"><?php echo lang("Профиль"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0 place-kd">
		<div class="container">
		<?php echo navmenu($mod); ?>
			<h1 class="title-inner"><?php echo lang("Изменить данные"); ?></h1>
			<div class="row justify-content-center mb-3" style="background: #eee; background-image: url(img/texture/back2.png);">
				<h4 class="title text-center mt-3 pt-0 mb-0"><?php echo lang("Данные профиля"); ?></h4>
				<div class="col-12 col-md-7 p-3">
					<form id="profileform1">
					  <div class="mb-3">
						<label for="InputRole" class="form-label mb-0"><?php echo lang("Статус"); ?></label>
						<select id="InputRole" name="role" class="form-select" id="">
						<?php 
						$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."followers_types` WHERE `status`='1' ORDER BY `position`, `id`;";
						$str = mysqlq($query);
						$arsql=mysql_fetch_assoc($str);
						$numrows=mysql_num_rows($str);	
						if ($numrows>0) {
							do {
						?>
							<option value="<?php echo d($arsql['id']); ?>"<?php if ($GLOBALS['user']['role']==$arsql['id']) { echo " SELECTED"; } ?>><?php echo d($arsql['name'.langpx()]); ?></option>
						<?php } while($arsql=mysql_fetch_assoc($str)); } ?>
						</select>
						<div id="ErrorRole" class="form-text text-danger" style="display: none;"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputEmail" class="form-label mb-0"><?php echo lang("Адрес электронной почты"); ?> <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" value="<?php echo d($GLOBALS['user']['email']); ?>" disabled="disabled">
						<div id="emailHelp" class="form-text"><?php echo lang("Для изменения адреса электронной почты обратитесь к администратору."); ?></div>
						<div id="ErrorEmail" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputCompany" class="form-label mb-0"><?php echo lang("Компания"); ?></label>
						<input type="text" name="company" class="form-control" id="InputCompany" value="<?php echo d($GLOBALS['user']['company']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputName" class="form-label mb-0"><?php echo lang("Ф.И.О."); ?></label>
						<input type="text" name="name" class="form-control" id="InputName" value="<?php echo d($GLOBALS['user']['name']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputPhone" class="form-label mb-0"><?php echo lang("Контактный телефон"); ?></label>
						<input type="text" name="phone" class="form-control" id="InputPhone" value="<?php echo d($GLOBALS['user']['phone']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputPassword3" class="form-label mb-0"><?php echo lang("Укажите действующий пароль"); ?></label>
						<input type="password" name="pass3" class="form-control" id="InputPass3">
						<div id="ErrorPass3" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <button id="profilebtn1" class="btn btn-place-cd mx-auto"><?php echo lang("Сохранить"); ?></button>
					</form>
				</div>
			</div>
			<div class="row justify-content-center mb-3" style="background: #eee; background-image: url(img/texture/back2.png);">
				<h4 class="title text-center mt-3 pt-0 mb-0"><?php echo lang("Смена пароля"); ?></h4>
				<div class="col-12 col-md-7 p-3">
					<form id="profileform2">
					  <div class="mb-3">
						<label for="InputPass1" class="form-label mb-0"><?php echo lang("Новый пароль"); ?></label>
						<input type="password" name="pass1" class="form-control" id="InputPass1">
						<div id="ErrorPass1" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputPassword2" class="form-label mb-0"><?php echo lang("Повторите пароль"); ?></label>
						<input type="password" name="pass2" class="form-control" id="InputPass2">
						<div id="ErrorPass2" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <div class="mb-3">
						<label for="InputPassword0" class="form-label mb-0"><?php echo lang("Укажите действующий пароль"); ?></label>
						<input type="password" name="pass0" class="form-control" id="InputPass0">
						<div id="ErrorPass0" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <button id="profilebtn2" class="btn btn-place-cd mx-auto"><?php echo lang("Сохранить"); ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php }elseif($mod=="tarif"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="<?php echo l("tarif", 0, $GLOBALS['user']['lang']); ?>"><?php echo lang("Тарифы"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0 place-kd">
		<div class="container">
		<?php if ($GLOBALS['user']['id']>0) { echo navmenu($mod); } ?>

			<h1 class="title-inner"><?php echo lang("Информация о тарифах"); ?></h1>
			<div class="row justify-content-center mb-3">
				  
<?php if ($GLOBALS['user']['lang']=="en") { ?>
<p style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<span style="font-size: 14.6667px;"><b>PUBLIC OFFER</b></span><br></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="font-size: 14.6667px;">The information portal "Mining Exchange", located in the information and telecommunications network "Internet" on the website of the information portal, at: https://infogor.ru , represented by the Limited Liability Company Gorny Mir Management Company (LLC Gorny Mir Management Company) represented by General Director Dadashyan Alexander Alexandrovich, acting on the basis of the Charter, referred to as in the future, the "Contractor" publishes a Public Offer for the publication of thematic (advertising) information on the site.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="font-size: 14.6667px;"><br></span></p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>1.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>DEFINITION OF TERMS</b></span></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<ol>

	<li>
		<p align="JUSTIFY" style="margin-bottom: 0cm"><span style="font-size: 14.6667px;">A public offer (hereinafter referred to as the "Offer") is a public offer by the Contractor addressed to an indefinite circle of persons (hereinafter referred to as the "Customer") to conclude an agreement with the Contractor on the publication of thematic (advertising) information on the site (hereinafter referred to as the "Agreement") on the terms contained in this Offer, including all Appendices.</span><br></p>
	</li>
</ol>
<p align="JUSTIFY" style="margin-left: 1cm; margin-bottom: 0cm"><br>
</p>
<ol>
	<ol start="2">
		<li>
			<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt">The order for the publication of thematic (advertising) information on the site is an application specified by the Customer from the range of customizable ones in the Site panel, when making an application for the publication of thematic (advertising) information on the site.</font></p>
			<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p></li></ol></ol>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>2.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>GENERAL PROVISIONS</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.1.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">The Customer's order to publish thematic (advertising) information on the site means that the Customer agrees to all the terms of this Offer.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.2.
	The Contractor has the right to make changes to the Offer without notifying the Customer.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.3.&nbsp;The validity period of the Offer is unlimited, unless otherwise indicated on the website.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-align: left; margin-bottom: 0cm;"><font style="font-size: 11pt">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2.4.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">The Customer instructs, and the Contractor undertakes to provide the Customer with services for publishing the Customer's thematic (advertising) information</span></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm">
	<font style="font-size: 11pt">2.5. Terms of rendering the service by the Contractor: within 3 (three) business days from the date of receipt by the Contractor of all agreed information and advertising materials and this Agreement signed by the Customer by e-mail in the form of scanned copies.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.6.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">The Customer undertakes to pay for the Services specified in clause 2.1 of this Offer within the time limits and in accordance with the procedure provided for in this Agreement.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>3.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>THE COST OF SERVICES AND THE CALCULATION PROCEDURE</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><a name="Bookmark1"></a><font style="font-size: 11pt">3.1.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">The cost of Services under this Offer is an amount equivalent to the selected tariff plan (Appendix 1), which is an integral part of this agreement.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">3.2.</font>
	<font style="font-size: 11pt">
		<i>
		</i></font><font style="font-size: 11pt">Services under this Agreement are paid by the Customer in the amount of 100 (one hundred)% (percent) in advance, by bank transfer within 5 (five) banking days from the date of signing this Agreement.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">3.3.
	The cost for each publication of thematic (advertising) information is indicated on the website.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>4.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>RIGHTS AND OBLIGATIONS OF THE PARTIES</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.
	Obligations of the Contractor:</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.1.
	To accept and coordinate with the Customer all information and advertising materials to be published.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.2.
	To coordinate with the Customer the cost of services according to the tariff plan (Appendix 1), which is an integral part of this agreement.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"> </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm">
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.3.
	To provide the Customer with Services of appropriate quality in full and within the time limits agreed by the Parties;</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.4.
	Inform the Customer, upon request, about the process and result of preparing materials for publication;</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.5.
	The Contractor does not guarantee the publication of all information provided by the Customer. If it is impossible to publish information due to detected plagiarism or poor image quality, the Contractor reserves the right to refuse to publish information to the Customer. </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">Performer's rights:</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.1.
	To request from the Customer the information and documents necessary for the fulfillment of obligations under this Agreement;</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.2.
	If necessary and at its discretion, to involve third parties for the execution of this Agreement.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.3.
	Has the right to include information posted by the Customer in the mailing lists organized by the information portal "Mining Exchange", as well as during promotions and events.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.4.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">The Contractor has the right to provide other services to the Customer, the composition, content and conditions of which will be determined by additional agreements to this Agreement or separate agreements.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.
	Obligations of the Customer:</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.1.
	Provide the Contractor with all documents, information and advertising materials and information necessary for the execution of this Agreement. </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.2.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">The Customer is solely responsible for the truthfulness and reliability of the information provided, for compliance with copyright and patent rights, for the availability of documents confirming the Customer's permission to carry out a type of economic activity for the sale (production for sale) of the Goods (Services) advertised under this Agreement.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.3.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">To pay for the Contractor's Services in accordance with the procedure, terms and in the amount established by this Agreement.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4. Customer's rights:</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4.1.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">Request information from the Contractor at any time about the process and results of the Services;</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4.2.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">To refuse the Services of the Contractor, while reimbursing all costs and expenses incurred by the Contractor.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>5.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>OTHER CONDITIONS</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">5.1.
	In case of non-fulfillment or improper fulfillment of their obligations under this Agreement, the Parties bear responsibility provided for by the current legislation of the Russian Federation.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">5.2.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">All disputes under this Agreement are resolved by the Parties through negotiations, and if it is impossible to reach an agreement, in court at the location of the Contractor.</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>6.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>DETAILS OF THE CONTRACTOR</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<table width="327" border="0" cellpadding="7" cellspacing="0">
	<colgroup><col width="313">
	</colgroup>
	<tbody>
		<tr>
			<td width="313" height="13" valign="TOP">
				<p align="JUSTIFY" style="text-indent: 1cm; widows: 0; orphans: 0">
					<font color="#000000">
						<span style="font-size: 14.6667px;"><b>Executor</b></span></font><br></p>
			</td>
		</tr>
		<tr>
			<td width="313" height="143" valign="TOP">
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<span style="font-size: 14.6667px;"><b>LLC Management company "Gorny Mir"</b></span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">OGRN: 123 7700 38 2765</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">TIN: 9710115500, CHECKPOINT 771001001,</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Legal Address: RF. 125047, Moscow,</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">the wind. Municipal</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Tverskoy district, Fadeev str., 7 Page 1,</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">The room. 1/N</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Postal address: 109147, Moscow,</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">34 Marxistskaya str., building 7.</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">MIRBIS (Institute)</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Bank requisites:</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Payment account: 407 028 106 248 300 00490</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">VTB Bank (public joint stock company</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">society)</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">VTB Bank (PJSC)</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Correspondent account:</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">30101 810 145 250 000 411 in the Main</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">management of the Central Bank</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Of the Russian Federation on the Central</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">to the Federal district of Moscow</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Email address: info@infogor.ru</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">Phone: +7-936-200-00-92</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">______________________
							</font>
							<font style="font-size: 11pt"><span lang="en-US">/</span></font><font style="font-size: 11pt">&nbsp;</font></font></font>
					<span style="text-align: left; font-size: 14.6667px;"><font color="#000000">A.A.Dadashyan</font></span></p>
			</td>
		</tr>
	</tbody></table>
<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt">Carefully read the text of this public offer, and if you do not agree with any clause of the offer, you have the right to refuse the Contractor's services and not perform the actions specified in clause 2.2. of this Offer.</font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="LEFT" style="margin-bottom: 0cm"><br>
</p>
<p align="RIGHT" style="margin-bottom: 0cm; page-break-before: always"><b>Appendix No. 1</b><br></p>
<p align="RIGHT" style="margin-bottom: 0cm">to the Public Offer for the provision of services</p>
<p align="RIGHT" style="margin-bottom: 0cm">on the publication of thematic (advertising) information</p>
<p align="RIGHT" style="margin-bottom: 0cm">on the website of the Mining Exchange information portal</p>
<p style="text-align: center; margin-bottom: 0cm;"><b>Tariffs</b><br></p>
<p style="margin-bottom: 0cm"><br>
</p>
<p style="margin-bottom: 0cm" align="center"><br>
</p>
				<table class="table table-bordered">
					<tr>
						<th class="fw-bold col-1 col-md-1 text-center">№</th>
						<th class="fw-bold col-2 col-md-2 text-center">Tariff</th>
						<th class="fw-bold col-2 col-md-2 text-center">Price</th>
						<th class="fw-bold col-4 col-md-4 text-center">Options included</th>
						<th class="fw-bold col-3 col-md-3 text-center d-none d-md-table-cell">Subscription plan</th>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">1</td>
						<td class="text-center align-middle p-2">Standard</td>
						<td class="text-center align-middle p-2">5000 RUB<br>(upon payment more than 3 ads the price is 4500 RUB per ad, more than 5 ads the price is 4000 RUB per ad)</td>
						<td class="text-left align-middle p-2">This tariff enables the Customer to place one informational ad per month in one appropriate subsection (name of equipment, services, raw materials, besides staff section)</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 months – 12,000 RUB<br>6 months – 22,000 RUB<br>12 months– 40,000 RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">2</td>
						<td class="text-center align-middle p-2">Standard Plus</td>
						<td class="text-center align-middle p-2">7000 RUB<br>(upon payment more than 3 ads the price is 6500 RUB per ad, more than 5 ads the price is 6000 RUB per ad)</td>
						<td class="text-left align-middle p-2">This tariff enables the Customer to place one informational ad per month in one section (name of equipment, services, raw materials, besides staff section), with photo or demo video attachment to the ad</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 months – 18,000 RUB<br>6 months – 34,000 RUB<br>12 months – 65,000 RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3</td>
						<td class="text-center align-middle p-2">Advertising Banner Placement</td>
						<td class="text-center align-middle p-2">According to class</td>
						<td class="text-left align-middle p-2">This tariff enables the Customer to place one advertising banner<br>1100х100 — for PC-version;<br>409х100 — for mobile version</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell"><b>The advertiser is solely responsible for the accuracy of the information on the advertising banners.</b></td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.1</td>
						<td class="text-center align-middle p-2">A-class Banner Placement</td>
						<td class="text-center align-middle p-2">150,000 RUB per month</td>
						<td class="text-left align-middle p-2">On the front site page</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 months – 400,000 RUB<br>6 months – 750,000 RUB<br>12 months – 1,400,000 RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.2</td>
						<td class="text-center align-middle p-2">B-class Banner Placement</td>
						<td class="text-center align-middle p-2">100,000 RUB per month</td>
						<td class="text-left align-middle p-2">In thematic section<br>(for example Equipment)</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 months – 250,000 RUB<br>6 months – 450,000 RUB<br>12 months – 850,000 RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.3</td>
						<td class="text-center align-middle p-2">C-class Banner Placement</td>
						<td class="text-center align-middle p-2">50,000 RUB per month</td>
						<td class="text-left align-middle p-2">In thematic subsection<br>(for example Drilling Equipment)</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 months – 140,000 RUB<br>6 months – 270,000 RUB<br>12 months– 530,000 RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.4</td>
						<td class="text-center align-middle p-2">Banner design</td>
						<td class="text-center align-middle p-2">from 10,000 RUB</td>
						<td class="text-left align-middle p-2">Based on Customer’s materials</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell"></td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">4</td>
						<td class="text-center align-middle p-2">Article Placement</td>
						<td class="text-center align-middle p-2">50,000 RUB</td>
						<td class="text-left align-middle p-2">The tariff enables the Customer to place an article in News section<br>Up to 5000 characters— placement on the web-site;<br>Up to 2000 characters — in Telegram channel</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">5</td>
						<td class="text-center align-middle p-2">User</td>
						<td class="text-center align-middle p-2">Free of charge</td>
						<td class="text-left align-middle p-2">The tariff enables the registered Customer to look through information, placed on the site</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">6</td>
						<td class="text-center align-middle p-2">CV Placement</td>
						<td class="text-center align-middle p-2">Free of charge</td>
						<td class="text-left align-middle p-2">The tariff enables the registered Customer to place a CV in Personnel section for 3 months</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">7</td>
						<td class="text-center align-middle p-2">Vacancy Placement</td>
						<td class="text-center align-middle p-2">1000 RUB</td>
						<td class="text-left align-middle p-2">The tariff enables the Customer to place one vacancy in Vacancies section for one month</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">8</td>
						<td class="text-center align-middle p-2">Legal Services</td>
						<td class="text-center align-middle p-2">Agreed price</td>
						<td class="text-left align-middle p-2">Legal support as per request. Contract drafting and signing, contract management (support of the fulfillment of obligations under the contract).<br>Insurance and customs processing are formalized under request</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">9</td>
						<td class="text-center align-middle p-2">Customs Processing</td>
						<td class="text-center align-middle p-2">Agreed price</td>
						<td class="text-left align-middle p-2">Customs procedures of export contracts</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">10</td>
						<td class="text-center align-middle p-2">Strategic Partner</td>
						<td class="text-center align-middle p-2">Agreed price</td>
						<td class="text-left align-middle p-2">1-year membership in VIP club Gorny Mir.<br>This tariff enables the Customer to place advertising banner on the front page of the site and use the portal services at special agreed prices</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">11</td>
						<td class="text-center align-middle p-2">VIP Club Gorny Mir Membership</td>
						<td class="text-center align-middle p-2">100,000 RUB per year</td>
						<td class="text-left align-middle p-2">This tariff enables the Customer to participate in Gorny Mir Club’s meetings.<br>The Customer is admitted to Club’s database (exclusive offers of mines and raw materials sale)</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">12</td>
						<td class="text-center align-middle p-2">Silver Card</td>
						<td class="text-center align-middle p-2">1,000,000 RUB per year</td>
						<td class="text-left align-middle p-2">1-year membership in VIP club Gorny Mir.<br>This tariff has the following advantages:<br>- placement up to 10 (ten) ads in thematic sections (equipment, services, raw materials, etc.);<br>- advertising banner placement (+ placement of the link to the goods and services catalogue + attach the equipment demo).<br>This tariff includes:<br>- personal manager service;<br>- one article placement in News section.<br>This tariff provides the access to the portal database (including hidden details)</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">13</td>
						<td class="text-center align-middle p-2">Golden Card</td>
						<td class="text-center align-middle p-2">5,000,000 RUB per year</td>
						<td class="text-left align-middle p-2">1-year membership in VIP club Gorny Mir.<br>This tariff has the following advantages:<br>- placement up to 50 (fifty) ads in thematic sections (equipment, services, raw materials, etc.);<br>- advertising banner placement (+ placement of the link to the goods and services catalogue + attach the equipment<br></td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
				</table>

<?php }elseif($GLOBALS['user']['lang']=="cn") { ?>
<p style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<span style="font-size: 14.6667px;"><b>公开发售</b></span><br></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="font-size: 14.6667px;">信息门户“矿业交易所”，位于信息和电信网络“互联网”上的信息门户网站，网址为：https://infogor.ru，由戈尔尼米尔有限责任公司管理公司（LLC Gorny Mir）代表。管理公司）由总经理达达什扬·亚历山大·亚历山德罗维奇（Dadashyan Alexander Alexandrovich）代表，根据章程行事，称为未来，“承包商”发布公开要约，以便在网站上发布主题（广告）信息。</span><br></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>1.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>术语定义</b></span></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<ol>

	<li>
		<p align="JUSTIFY" style="margin-bottom: 0cm"><span style="font-size: 14.6667px;">公开要约（以下简称“要约”）是承包商向无限范围的人员（以下简称“客户”）发出的公开要约，目的是与承包商就发布主题（以下简称“客户”）达成协议。广告）网站上的信息（以下简称“协议”）中包含的本优惠条款，包括所有附录。</span><br></p>
	</li>
</ol>
<p align="JUSTIFY" style="margin-left: 1cm; margin-bottom: 0cm"><br>
</p>
<ol>
	<ol start="2">
		<li>
			<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt">在网站上发布主题（广告）信息的订单是客户在申请在网站上发布主题（广告）信息时从网站面板中的可定制的范围中指定的应用程序。</font></p>
		</li></ol>
</ol>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>2.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>一般规定</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.1.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">客户在网站上发布主题（广告）信息的订单意味着客户同意本优惠的所有条款。</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.2. 承包商有权在不通知客户的情况下更改报价。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.3.
	除非网站另有说明，优惠的有效期没有限制。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-align: left; margin-bottom: 0cm;"><font style="font-size: 11pt">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.4.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">客户指示，承包商承诺为客户提供发布客户主题（广告）信息的服务</span></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm">
	<font style="font-size: 11pt">2.5. 承包商提供服务的条款：自承包商收到客户通过电子邮件以扫描件形式签署的所有约定信息和广告材料以及本协议之日起 3（三）个工作日内。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.6.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">客户承诺在本协议规定的时限内并按照本协议规定的程序支付本要约第 2.1 条规定的服务费用。</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>3.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>服务成本和计算程序</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><a name="Bookmark1"></a><font style="font-size: 11pt">3.1.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">本优惠项下的服务费用相当于所选资费计划（附录 1）的金额，该资费计划是本协议不可分割的一部分。</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">3.2.</font>
	<font style="font-size: 11pt">
		<i>
		</i></font><font style="font-size: 11pt">本协议项下的服务由客户在签署本协议之日起 5（五）个银行工作日内通过银行转账提前支付 100（一百）%（百分比）的费用。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">3.3.
	网站上注明了每次发布主题（广告）信息的费用。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>4.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>双方的权利和义务</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.
	承包商的义务：</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.1.
	接受并与客户协调所有要发布的信息和广告材料。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.2.
	根据资费计划（附录 1）与客户协调服务成本，该资费计划是本协议的组成部分。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"> </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm">
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.3.
	在双方商定的期限内向客户提供适当质量的完整服务；</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.4.
	根据要求，告知客户准备出版材料的过程和结果；</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.5.
	承包商不保证客户提供的所有信息的公开。如果因发现抄袭或图像质量差而无法发布信息，承包商保留拒绝向客户发布信息的权利。 </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.
	表演者的权利：</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.1.
	向客户索取履行本协议项下义务所需的信息和文件；</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.2.
	如有必要，可酌情让第三方参与本协议的执行。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.3.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">有权将客户发布的信息包含在信息门户“Mining Exchange”组织的邮件列表中以及促销和活动期间。</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.4.
	承包商有权向客户提供其他服务，其组成、内容和条件将由本协议的附加协议或单独的协议确定。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.
	客户的义务：</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.1.
	向承包商提供执行本协议所需的所有文件、信息以及广告材料和信息。 </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.2.
	客户对所提供信息的真实性和可靠性、遵守版权和专利权、确认客户许可开展某种类型的销售（生产销售）经济活动的文件的可用性承担全部责任。根据本协议宣传的商品（服务）。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.3.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">根据本协议规定的程序、条款和金额支付承包商的服务费用。</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4. 客户的权利：</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4.1.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">随时向承包商索取有关服务过程和结果的信息；</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4.2. 拒绝承包商的服务，同时偿还承包商产生的所有费用和开支。</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>5.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>其他条件</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">5.1.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">如果不履行或不当履行本协议项下的义务，双方将承担俄罗斯联邦现行法律规定的责任。</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">5.2.&nbsp;</font><span style="text-align: left; font-size: 14.6667px;">本协议项下的所有争议均由双方协商解决，无法达成协议的，可通过承包商所在地法院解决。</span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><span style="text-align: left; font-size: 14.6667px;"><br></span></p>
<p align="JUSTIFY" style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>6.&nbsp;</b></font>
	<span style="text-align: left; font-size: 14.6667px;"><b>承包商的详细信息</b></span></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<table width="327" border="0" cellpadding="7" cellspacing="0">
	<colgroup><col width="313">
	</colgroup>
	<tbody>
		<tr>
			<td width="313" height="13" valign="TOP">
				<p align="JUSTIFY" style="text-indent: 1cm; widows: 0; orphans: 0">
					<font color="#000000">
						<span style="font-size: 14.6667px;"><b>执行者</b></span></font><br></p>
			</td>
		</tr>
		<tr>
			<td width="313" height="143" valign="TOP">
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<span style="font-size: 14.6667px;"><b>有限责任公司管理公司“Gorny Mir”</b></span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">OGRN：123 7700 38 2765</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">电话：9710115500，检查站 771001001，</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">法定地址：RF。 125047, 莫斯科,</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">风。市政</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">特维尔区，Fadeev 街，7 页 1，</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">房间。 1/N</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">邮政地址：109147，莫斯科，</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">马克思主义街 34 号，7 号楼。</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">米尔比斯（研究所）</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">银行要求：</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">付款账号：407 028 106 248 300 00490</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">VTB 银行（公共股份公司</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">社会）</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">VTB 银行 (PJSC)</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">往来账户：</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">30101 810 145 250 000 411 主要</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">中央银行的管理</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">俄罗斯联邦中央</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">前往莫斯科联邦管区</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">电子邮件地址：info@infogor.ru</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000"><span style="font-size: 14.6667px;">电话：+7-936-200-00-92</span></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">______________________
							</font>
							<font style="font-size: 11pt"><span lang="en-US">/</span></font><font style="font-size: 11pt">&nbsp;</font></font></font>
					<span style="text-align: left; font-size: 14.6667px;"><font color="#000000">&nbsp;A.A.Dadashyan</font></span></p>
			</td>
		</tr>
	</tbody></table>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt">请仔细阅读本公开要约的文本，如果您不同意要约的任何条款，您有权拒绝承包商的服务并且不执行第2.2条规定的行动。本优惠的。</font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="LEFT" style="margin-bottom: 0cm"><br>
</p>
<p align="RIGHT" style="margin-bottom: 0cm; page-break-before: always"><b>附录1</b><br></p>
<p align="RIGHT" style="margin-bottom: 0cm">公开发售以提供服务</p>
<p align="RIGHT" style="margin-bottom: 0cm">关于发布专题（广告）信息</p>
<p align="RIGHT" style="margin-bottom: 0cm">在矿业交易所信息门户网站上</p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; margin-bottom: 0cm;"><b>收费标准</b><br></p>
<p style="margin-bottom: 0cm"><br>
</p>
<p style="margin-bottom: 0cm" align="center"><br>
</p>
				<table class="table table-bordered">
					<tr>
						<th class="fw-bold col-1col-md-1 text-center">№</th>
						<th class="fw-bold col-2col-md-2 text-center">收费标准</th>
						<th class="fw-bold col-2col-md-2 text-center">价格</th>
						<th class="fw-bold col-4col-md-4 text-center">包含的选项</th>
						<th class="fw-bold col-3col-md-3 text-center d-none d-md-table-cell">订阅计划</th>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">1</td>
						<td class="text-center align-middle p-2">标准</td>
						<td class="text-center align-middle p-2">5000RUB<br>（支付超过3个广告的价格为每个广告4500RUB，超过5个广告的价格为每个广告4000RUB）</td>
						<td class="text-left align-middle p-2">此资费允许客户每月在一个适当的小节（设备，服务，原材料名称，员工部分除外）中放置一个信息广告</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">3个月-12,000RUB<br>6个月-22,000RUB<br>12个月-40,000RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">2</td>
						<td class="text-center align-middle p-2">标准加</td>
						<td class="text-center align-middle p-2">7000RUB<br>（支付超过3个广告的价格为每个广告6500RUB，超过5个广告的价格为每个广告6000RUB）</td>
						<td class="text-left align-middle p-2">此资费允许客户每月在一个部分（设备名称，服务，原材料，员工部分除外）放置一个信息广告，并在广告上附上照片或演示视频</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">3个月-18,000RUB<br>6个月-34,000RUB<br>12个月-65,000RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3</td>
						<td class="text-center align-middle p-2">广告横幅放置</td>
						<td class="text-center align-middle p-2">根据class</td>
						<td class="text-left align-middle p-2">此资费允许客户放置一个广告横幅<br>1100Х100—PC版;<br>409х100—移动版</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell"><b>广告商完全负责广告横幅的信息的准确性。</b></td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.1</td>
						<td class="text-center align-middle p-2">a类横幅放置</td>
						<td class="text-center align-middle p-2">每月150,000RUB</td>
						<td class="text-left align-middle p-2">首页</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">3个月-400,000RUB<br>6个月-750,000RUB<br>12个月-1,400,000RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.2</td>
						<td class="text-center align-middle p-2">B级横幅放置</td>
						<td class="text-center align-middle p-2">每月100,000RUB</td>
						<td class="text-left align-middle p-2">主题部分<br>（例如设备）</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">3个月-250,000RUB<br>6个月-450,000RUB<br>12个月-850,000RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.3</td>
						<td class="text-center align-middle p-2">C类横幅放置</td>
						<td class="text-center align-middle p-2">每月50,000RUB</td>
						<td class="text-left align-middle p-2">主题小节<br>（例如钻井设备）</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">3个月-140,000RUB<br>6个月-270,000RUB<br>12个月-530,000RUB</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.4</td>
						<td class="text-center align-middle p-2">横幅设计</td>
						<td class="text-center align-middle p-2">起10,000RUB</td>
						<td class="text-left align-middle p-2">基于客户的材料</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell"></td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">4</td>
						<td class="text-center align-middle p-2">文章放置</td>
						<td class="text-center align-middle p-2">50,000RUB</td>
						<td class="text-left align-middle p-2">关税使客户能够将文章放置在新闻部分<br>最多5000个字符—在网站上放置;<br>最多2000个字符-在电报频道</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">5</td>
						<td class="text-center align-middle p-2">用户</td>
						<td class="text-center align-middle p-2">免费</td>
						<td class="text-left align-middle p-2">关税使注册客户能够查看网站上的信息</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">6</td>
						<td class="text-center align-middle p-2">CV放置</td>
						<td class="text-center align-middle p-2">免费</td>
						<td class="text-left align-middle p-2">关税使注册客户能够在人事部分放置简历3个月</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">7</td>
						<td class="text-center align-middle p-2">空缺位置</td>
						<td class="text-center align-middle p-2">1000擦</td>
						<td class="text-left align-middle p-2">关税允许客户在空缺部分放置一个空缺一个月</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">8</td>
						<td class="text-center align-middle p-2">法律服务</td>
						<td class="text-center align-middle p-2">议定价格</td>
						<td class="text-left align-middle p-2">根据请求提供法律支持。 合同起草和签署，合同管理（支持履行合同义务）。<br>保险和海关处理根据要求正式化</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">9</td>
						<td class="text-center align-middle p-2">海关处理</td>
						<td class="text-center align-middle p-2">议定价格</td>
						<td class="text-left align-middle p-2">出口合同的海关手续</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">10</td>
						<td class="text-center align-middle p-2">战略合作伙伴</td>
						<td class="text-center align-middle p-2">议定价格</td>
						<td class="text-left align-middle p-2">VIP俱乐部Gorny Mir的1年会员资格。<br>此关税使客户能够在网站的首页放置广告横幅，并以特别商定的价格使用门户网站服务</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">11</td>
						<td class="text-center align-middle p-2">Vip Club Gorny Mir会员资格</td>
						<td class="text-center align-middle p-2">每年100,000RUB</td>
						<td class="text-left align-middle p-2">此资费使客户能够参加Gorny Mir Club的会议。<br>客户进入俱乐部的数据库（独家提供矿山和原材料销售）</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">12</td>
						<td class="text-center align-middle p-2">银卡</td>
						<td class="text-center align-middle p-2">每年1,000,000RUB</td>
						<td class="text-left align-middle p-2">VIP俱乐部Gorny Mir的1年会员资格。<br>此关税具有以下优点：<br>-在主题部分（设备，服务，原材料等）放置多达10（十）个广告。）;<br>-广告横幅放置（+放置商品和服务目录的链接+附上设备演示）。<br>此关税包括：<br>-个人经理服务;<br>-新闻部分的一篇文章。<br>此资费提供了访问门户数据库（包括隐藏的详细信息）</td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">13</td>
						<td class="text-center align-middle p-2">金卡</td>
						<td class="text-center align-middle p-2">每年5,000,000RUB</td>
						<td class="text-left align-middle p-2">VIP俱乐部Gorny Mir的1年会员资格。<br>此关税具有以下优点：<br>-在主题部分（设备，服务，原材料等）放置多达50（五十）个广告。）;<br>-广告横幅放置（+放置商品和服务目录的链接+附加设备<br></td>
						<td class="text-center align-middle p-2d-none d-md-table-cell">&nbsp;</td>
					</tr>
				</table>

<?php }else{ ?>
<p style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>ПУБЛИЧНАЯ
		ОФЕРТА</b></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm">
	<font style="font-size: 11pt">Информационный
		портал «Горная Биржа», расположенный
		в информационно-телекоммуникационной
		сети «Интернет» на сайте информационного
		портала, по адресу: <a href="https://infogor.ru">https://infogor.ru</a>,
		в лице Общество с ограниченной
		ответственностью Управляющая компания
		«Горный Мир»</font> <font style="font-size: 11pt">(ООО
	УК «Горный Мир») в лице Генерального
	директора Дадашяна Александра
	Александровича, действующего на основании
	Устава, именуемый в дальнейшем
	«Исполнитель»,</font> <font style="font-size: 11pt">публикует
	Публичную оферту о публикации тематической
	(рекламной) информации на сайте.</font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>1.
		ОПРЕДЕЛЕНИЕ ТЕРМИНОВ</b></font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<ol>

	<li>
		<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt">Публичная
			оферта (далее – «Оферта») - публичное
			предложение Исполнителя, адресованное
			неопределенному кругу лиц (далее –
			«Заказчик»), заключить с Исполнителем
			договор о публикации тематической
			(рекламной) информации на сайте (далее
			– «Договор»)</font> <font style="font-size: 11pt">на
			условиях, содержащихся в настоящей
			Оферте, включая все Приложения.</font></p>
	</li>
</ol>
<p align="JUSTIFY" style="margin-left: 1cm; margin-bottom: 0cm"><br>
</p>
<ol>
	<ol start="2">
		<li>
			<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt">Заказ
				публикации тематической (рекламной)
				информации на сайте – заявка, указанная
				Заказчиком из ассортимента настраиваемых
				в панели Сайта, при оформлении заявки
				на публикации тематической (рекламной)
				информации на сайте.</font></p>
		</li></ol>
</ol>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>2.
		ОБЩИЕ ПОЛОЖЕНИЯ</b></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.1.
	Заказ Заказчиком </font><font style="font-size: 11pt">публикации
	тематической (рекламной) информации на
	сайте означает, что Заказчик согласен
	со всеми условиями настоящей Оферты.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.2.
	Исполнитель имеет право вносить изменения
	в Оферту без уведомления Заказчика.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.3.
	Срок действия Оферты не ограничен, если
	иное не указано на сайте.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.4.&nbsp;</font><font style="text-align: left; font-size: 11pt;">Заказчик
	поручает, а Исполнитель</font>
	<font style="text-align: left; font-size: 11pt;"><b>
		</b></font><font style="text-align: left; font-size: 11pt;">обязуется
	оказать Заказчику услуги по публикации
	тематической (рекламной) информации
	Заказчика</font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm">
	<font style="font-size: 11pt">2.5. Сроки оказания
	услуги Исполнителем: в течение 3 (трех)
	рабочих дней с момента получения
	Исполнителем всех согласованных
	информационно-рекламных материалов и
	подписанного Заказчиком настоящего
	Договора по электронной почте в виде
	сканированных копий.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">2.6.
	Заказчик</font>
	<font style="font-size: 11pt">
		<i>
		</i></font><font style="font-size: 11pt">обязуется
	оплатить Услуги, указанные в п. 2.1
	настоящей Оферты в сроки и в порядке,
	предусмотренные настоящим Договором.
	</font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>3.
		СТОИМОСТЬ УСЛУГ И ПОРЯДОК РАСЧЕТА</b></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><a name="Bookmark1"></a><font style="font-size: 11pt">3.1. Стоимость Услуг
	по настоящей Оферте составляет </font><font style="font-size: 11pt">сумму,
	эквивалентную выбранному тарифному
	плану (Приложение 1), являющемуся
	неотъемлемой частью настоящего договора.</font><font style="font-size: 11pt">
	</font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">3.2.</font>
	<font style="font-size: 11pt">
		<i>
		</i></font><font style="font-size: 11pt">Услуги по
	настоящему Договору оплачиваются
	Заказчиком в размере 100 (ста) % (процентов)
	в порядке предоплаты, безналичным
	расчетом в течение 5 (пяти) банковских
	дней с момента подписания настоящего
	Договора.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">3.3.
	Стоимость на каждую публикацию
	тематической (рекламной) информации
	указана на сайте.</font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>4.
		ПРАВА И ОБЯЗАННОСТИ СТОРОН</b></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.
	Обязанности Исполнителя:</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.1.
	Принять и согласовать с Заказчиком все
	подлежащие к публикации информационно-рекламные
	материалы.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.2.
	Согласовать с Заказчиком стоимость
	услуг согласно тарифному плану (Приложение
	1), являющемуся неотъемлемой частью
	настоящего договора.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"><br></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt"> </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm">
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.3.
	Оказать Заказчику Услуги надлежащего
	качества в полном объеме и в согласованные
	Сторонами сроки;</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.4.
	Информировать Заказчика по его запросу
	о процессе и результате подготовки
	материалов к публикации;</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.1.5.
	Исполнитель не гарантирует публикацию
	всей информации, предоставленной
	Заказчиком. В случае невозможности
	публикации информации из-за выявленного
	плагиата или низкого качества изображений,
	Исполнитель оставляет за собой право
	отказать Заказчику в публикации
	информации. </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.
	Права Исполнителя:</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.1.
	Запрашивать у Заказчика сведения и
	документы, необходимые для исполнения
	обязательств по настоящему Договору;</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.2.
	При необходимости и по своему усмотрению
	привлекать третьих лиц для исполнения
	настоящего Договора.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.3.
	Имеет право включать информацию,
	размещенную Заказчиком в рассылки,
	организованные информационным порталом
	«Горная Биржа», а также при проведении
	рекламных акций и мероприятий.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.2.4.
	Исполнитель вправе оказывать иные
	услуги Заказчику, состав, содержание и
	условия оказания которых, будет
	определяться дополнительными соглашениями
	к настоящему Договору либо отдельными
	договорами.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.
	Обязанности Заказчика:</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.1.
	Обеспечить Исполнителя всеми документами,
	информационно-рекламными материалами
	и сведениями, необходимыми для исполнения
	настоящего Договора. </font>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.2.
	Заказчик самостоятельно несет
	ответственность за правдивость и
	достоверность предоставленной информации,
	за соблюдение авторских и патентных
	прав, за наличие документов, подтверждающих
	разрешение Заказчику осуществлять вид
	экономической деятельности по продаже
	(производству в целях продажи),
	рекламируемого в рамках настоящего
	Договора Товара (Услуг).</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.3.3.
	Оплатить Услуги Исполнителя</font>
	<font style="font-size: 11pt">
		<i><b>
			</b></i></font><font style="font-size: 11pt">в порядке,
	сроки и в размере, установленном настоящим
	Договором.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4. Права Заказчика:</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4.1. В любое время запрашивать у Исполнителя
	информацию о процессе и результатах
	выполнения Услуг;</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">4.4.2. Отказаться от Услуг Исполнителя,
	возместив при этом все понесенные
	Исполнителем затраты и расходы.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>5.
		ПРОЧИЕ УСЛОВИЯ</b></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">5.1.
	В случае неисполнения или ненадлежащего
	исполнения своих обязательств по
	настоящему Договору, Стороны несут
	ответственность, предусмотренную
	действующим законодательством Российской
	Федерации.</font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><font style="font-size: 11pt">5.2.
	Все споры по настоящему Договору
	разрешаются Сторонами путем переговоров,
	а при невозможности достижения согласия,
	в судебном порядке по месту нахождения
	</font><font style="font-size: 11pt">Исполнителя</font>
	<font style="font-size: 11pt"><b>.</b></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="text-align: center; text-indent: 1cm; margin-bottom: 0cm;">
	<font style="font-size: 11pt"><b>6.
		РЕКВИЗИТЫ ИСПОЛНИТЕЛЯ</b></font></p>
<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm"><br>
</p>
<table width="327" border="0" cellpadding="7" cellspacing="0">
	<colgroup><col width="313">
	</colgroup>
	<tbody>
		<tr>
			<td width="313" height="13" valign="TOP">
				<p align="JUSTIFY" style="text-indent: 1cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3">
							<font style="font-size: 11pt"><b>Исполнитель</b></font></font></font></p>
			</td>
		</tr>
		<tr>
			<td width="313" height="143" valign="TOP">
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3">
							<font style="font-size: 11pt"><b>ООО
								УК «Горный Мир»  </b></font></font></font>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">ОГРН:
							123 7700 38 2765</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">ИНН:
							9710115500, КПП 771001001, </font></font></font>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Юр.
							Адрес: РФ. 125047, г. Москва, </font></font></font>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">вн.
							тер. г. Муниципальный </font></font></font>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Округ
							Тверской, ул. Фадеева, д. 7 Стр. 1, </font></font></font>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Помещ.
							1/Н</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Почтовый
							адрес: 109147, г. Москва, </font></font></font>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">ул.
							Марксистская, дом 34, корпус 7.</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">«МИРБИС»
							(Институт)</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Банковские
							реквизиты:</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Расчетный
							счет:	407 028 106 248 300 00490</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Банк
							ВТБ (публичное акционерное</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">общество)</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Банк
							ВТБ (ПАО)</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Корреспондентский
							счёт:	</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">30101
							810 145 250 000 411 в Главном</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">управлении
							Центрального банка</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Российской
							Федерации по Центральному</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">федеральному
							округу г. Москва</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Электронный
							адрес: info@infogor.ru</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">Телефон:
							+7-936-200-00-92</font></font></font></p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; margin-bottom: 0cm; widows: 0; orphans: 0">
					<br>
				</p>
				<p align="JUSTIFY" style="text-indent: 1cm; widows: 0; orphans: 0">
					<font color="#000000">
						<font size="3"><font style="font-size: 11pt">______________________
							</font>
							<font style="font-size: 11pt"><span lang="en-US">/</span></font><font style="font-size: 11pt">
							А.А.Дадашян</font></font></font></p>
			</td>
		</tr>
	</tbody></table>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><font style="font-size: 11pt">Внимательно
	ознакомьтесь с текстом настоящей
	публичной оферты, и если Вы не согласны
	с каким-либо пунктом оферты, Вы вправе
	отказаться от услуг Исполнителя, и не
	совершать действий, указанный в п. 2.2.
	настоящей Оферты.</font></p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p align="LEFT" style="margin-bottom: 0cm"><br>
</p>
<p align="RIGHT" style="margin-bottom: 0cm; page-break-before: always"><b>Приложение
	№ 1</b></p>
<p align="RIGHT" style="margin-bottom: 0cm">к Публичной
	Оферте  на оказание услуг
</p>
<p align="RIGHT" style="margin-bottom: 0cm">по публикации
	тематической (рекламной) информации</p>
<p align="RIGHT" style="margin-bottom: 0cm">на сайте
	информационного портала «Горная Биржа»</p>
<p align="JUSTIFY" style="margin-bottom: 0cm"><br>
</p>
<p style="text-align: center; margin-bottom: 0cm;"><b>ТАРИФЫ</b></p>
<p style="margin-bottom: 0cm"><br>
</p>
<p style="margin-bottom: 0cm" align="center"><br>
</p>
				<table class="table table-bordered">
					<tr>
						<th class="fw-bold col-1 col-md-1 text-center">№</th>
						<th class="fw-bold col-2 col-md-2 text-center">Статус</th>
						<th class="fw-bold col-2 col-md-2 text-center">Стоимость</th>
						<th class="fw-bold col-4 col-md-4 text-center">Функции</th>
						<th class="fw-bold col-3 col-md-3 text-center d-none d-md-table-cell">Примечания</th>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">1</td>
						<td class="text-center align-middle p-2">Тариф Стандарт</td>
						<td class="text-center align-middle p-2">5 тыс. руб.<br>(при оплате более трех объявлений стоимость 4,5 тыс. руб., более пяти 4 тыс. руб.)</td>
						<td class="text-left align-middle p-2">Позволяет обладателю размещать на месяц в соответствующем подразделе одно информационное объявление (наименование оборудования, услуг, сырья и т.д. кроме вакансий).</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 мес. – 12 тыс. руб.<br>6 мес. – 22 тыс. руб.<br>1год – 40 тыс. руб.</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">2</td>
						<td class="text-center align-middle p-2">Тариф Стандарт плюс</td>
						<td class="text-center align-middle p-2">7 тыс. руб.<br>(при оплате более трех объявлений стоимость 6,5 тыс. руб., более пяти 6 тыс. руб.)</td>
						<td class="text-left align-middle p-2">Позволяет обладателю размещать на портале в соответствующем разделе одно информационное объявление в месяц (наименование оборудования, услуг, сырья и т.д. кроме вакансий), прикрепить поясняющее фото или демо-ролик своего объявления в течении одного месяца.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 мес. – 18 тыс. руб.<br>6 мес. – 34 тыс. руб.<br>1год – 65 тыс. руб.</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3</td>
						<td class="text-center align-middle p-2">Размещение баннера</td>
						<td class="text-center align-middle p-2">Согласно классности</td>
						<td class="text-left align-middle p-2">Позволяет разместить на месяц свой тематический рекламный баннер.<br>1100х100 — для ПК-версии;<br>409х100 — для моб. версии</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell"><b>Рекламодатель несёт полную ответственность за достоверность сведений, размещенных на рекламных баннерах.</b></td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.1</td>
						<td class="text-center align-middle p-2">Размещение баннера Класс А</td>
						<td class="text-center align-middle p-2">150 тыс. руб.</td>
						<td class="text-left align-middle p-2">на главной (первой) странице</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 мес. – 400 тыс. руб.<br>6 мес. – 750 тыс. руб.<br>1год – 1400 тыс. руб.</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.2</td>
						<td class="text-center align-middle p-2">Размещение баннера Класс B</td>
						<td class="text-center align-middle p-2">100 тыс. руб.</td>
						<td class="text-left align-middle p-2">в тематическом разделе<br>(например, «Оборудование»)</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 мес. – 250 тыс. руб.<br>6 мес. – 450 тыс. руб.<br>1год – 850 тыс. руб.</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.3</td>
						<td class="text-center align-middle p-2">Размещение баннера Класс C</td>
						<td class="text-center align-middle p-2">50 тыс. руб.</td>
						<td class="text-left align-middle p-2">в тематическом подразделе<br>(например, «Карьерная техника»)</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">3 мес. – 140 тыс. руб.<br>6 мес. – 270 тыс. руб.<br>1год – 530 тыс. руб.</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">3.4</td>
						<td class="text-center align-middle p-2">Изготовление баннера</td>
						<td class="text-center align-middle p-2">от 10 тыс. руб.</td>
						<td class="text-left align-middle p-2">по материалам заказчика</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell"></td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">4</td>
						<td class="text-center align-middle p-2">Размещение статьи</td>
						<td class="text-center align-middle p-2">50 тыс. руб.</td>
						<td class="text-left align-middle p-2">Позволяет разместить тематическую статью в разделе новостей.<br>До 5000 символов — на сайт; до 2000 символов — в Телеграм.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">5</td>
						<td class="text-center align-middle p-2">Тариф Пользователь</td>
						<td class="text-center align-middle p-2">Бесплатно</td>
						<td class="text-left align-middle p-2">Позволяет обладателю, после регистрации, просматривать всю информацию, имеющуюся на портале.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">6</td>
						<td class="text-center align-middle p-2">Размещение резюме</td>
						<td class="text-center align-middle p-2">Бесплатно</td>
						<td class="text-left align-middle p-2">Позволяет соискателю разместить свое резюме в соответствующем разделе на три месяца. </td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">7</td>
						<td class="text-center align-middle p-2">Размещение Вакансии</td>
						<td class="text-center align-middle p-2">1 тыс. руб.</td>
						<td class="text-left align-middle p-2">Позволяет предприятию разместить информацию о вакансии в соответствующем разделе на один месяц.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">8</td>
						<td class="text-center align-middle p-2">Юридическое сопровождение</td>
						<td class="text-center align-middle p-2">По договоренности</td>
						<td class="text-left align-middle p-2">Юридическое сопровождение поступившей заявки. Подготовка и заключение договора, сопровождение его до завершения (до подписания окончательных актов, окончательного расчета и получения оборудования/услуги).<br>При необходимости может оформляться страхование и таможенное сопровождение.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">9</td>
						<td class="text-center align-middle p-2">Таможенное сопровождение</td>
						<td class="text-center align-middle p-2">По договоренности</td>
						<td class="text-left align-middle p-2">Таможенное сопровождение договоров.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">10</td>
						<td class="text-center align-middle p-2">Стратегический партнер</td>
						<td class="text-center align-middle p-2">По договоренности</td>
						<td class="text-left align-middle p-2">Автоматически получает членство в VIP клубе «Горный Мир» сроком на один год.<br>Позволяет разместить на информационном поле портала свой баннер и пользоваться услугами портала по льготным (отдельно согласованным) расценкам.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">11</td>
						<td class="text-center align-middle p-2">Абонемент на членство в VIP клубе «Горный Мир»</td>
						<td class="text-center align-middle p-2">100 тыс. руб. на год.</td>
						<td class="text-left align-middle p-2">Дает право участвовать в заседаниях клуба «Горный Мир».<br>Дает право на получение информации рассчитанной только для членов клуба (эксклюзивные предложения о продаже месторождений и сырья).</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">12</td>
						<td class="text-center align-middle p-2">Серебряная карта</td>
						<td class="text-center align-middle p-2">1 млн руб.</td>
						<td class="text-left align-middle p-2">Автоматически получает членство в VIP клубе «Горный Мир» сроком на один год.<br>Позволяет обладателю в течении года:<br>-размещать на портале до 10 (десяти) тематических наименований (оборудования, услуг, вакансий, сырья и т.д.); <br>-имеет право разместить свой рекламный баннер (+разместить ссылку на свой каталог (продукции/услуг), +прикрепить демо-ролик своего оборудования).<br>Дает право:<br>-обслуживание персональным менеджером;<br>-размещение одной статьи в разделе новостей.<br>Также позволяет просматривать всю информацию (включая скрытые реквизиты), имеющуюся на портале в течении года.</td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center align-middle p-2">13</td>
						<td class="text-center align-middle p-2">Золотая карта</td>
						<td class="text-center align-middle p-2">5 млн руб.</td>
						<td class="text-left align-middle p-2">Автоматически получает членство в VIP клубе «Горный Мир» сроком на один год.<br>Позволяет обладателю в течении года:<br>-размещать на портале до 50 (пятидесяти) тематических наименований (оборудования, услуг, вакансий, сырья и т.д.); <br>-имеет право разместить свой рекламный баннер (+разместить ссылку на свой каталог (продукции/услуг), +прикрепить демо-ролик своего оборудования).<br>Дает право:<br>-обслуживание персональным менеджером;<br>-размещение пяти статей в разделе новостей (одна в квартал + годовая);<br>- ежеквартальную персональную рекламную рассылку по базе данных портала.<br>Также позволяет просматривать всю информацию (включая скрытые реквизиты), имеющуюся на портале в течении года.<br></td>
						<td class="text-center align-middle p-2 d-none d-md-table-cell">&nbsp;</td>
					</tr>
				</table>


<?php } ?>


			

				
				
				
			</div>
			
			
		</div>
	</div>

<?php }elseif($mod=="profile2"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="<?php echo l("profile2", 0, $GLOBALS['user']['lang']); ?>"><?php echo lang("Контактные данные на сайте"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0 place-kd">
		<div class="container">
		<?php echo navmenu($mod); ?>
			<h1 class="title-inner"><?php echo lang("Контактные данные на сайте"); ?></h1>
			<?php
			if ($GLOBALS['user']['public_phone']=="") {
			$html="";
			$html.="<div class=\"alert alert-delay-hide alert-warning alert-dismissible fade show\" role=\"alert\">";
			$html.="<i class=\"fa fa-check\"></i> ";
			$html.=lang("Для размещения объявлений на портале заполните Контактные данные на сайте.");
			$html.="<button type=\"button\" class=\"close close-sm\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>";
			$html.="</div>";
			echo $html;
			}
				?>
			<div class="row justify-content-center mb-3" style="background: #eee; background-image: url(img/texture/back2.png);">
				<h4 class="title text-center mt-3 pt-0 mb-0"><?php echo lang("Контактные данные на сайте"); ?></h4>
				<div class="col-12 col-md-7 p-3">
					<form id="profileform3">
					  <div class="mb-3">
					  <?php if (file_exists("upload/profiles/".$GLOBALS['user']['public_logo']) and mb_strlen($GLOBALS['user']['public_logo'])>4) { 
						$cachename=imagecache("upload/profiles/", $GLOBALS['user']['public_logo']);
					  }else{
						$cachename="";
					  }
						?>
						<div id="public_logo" class="w-100 text-center"<?php if ($cachename=="") { echo " style=\"display: none;\""; } ?>>
							<img class="currentlogo" src="<?php echo d("/".$cachename); ?>">
							<label for="InputPubLogo" style="line-height: 33px;" class="form-label w-100 mb-0 align-middle text-center currentlogo">
								<input type="checkbox" name="InputJustDel" id="InputJustDel" class="" value="1" style="height: auto;"> <?php echo lang("Удалить действующий логотип"); ?>
							</label>
						</div>
						<label for="InputPubLogo" class="form-label mb-0"><?php echo lang("Загрузить логотип"); ?></label>
						<input type="file" name="file" class="form-control" id="InputPubLogo">
					  </div>
					  <div class="mb-3">
						<label for="InputPubEmail" class="form-label mb-0"><?php echo lang("Адрес электронной почты"); ?></label>
						<input type="email" name="email" class="form-control" id="InputPubEmail" value="<?php echo d($GLOBALS['user']['public_email']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputPubName" class="form-label mb-0"><?php echo lang("Ф.И.О."); ?></label>
						<input type="text" name="name" class="form-control" id="InputPubName" value="<?php echo d($GLOBALS['user']['public_name']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputPubPhone" class="form-label mb-0"><?php echo lang("Контактный телефон"); ?></label>
						<input type="text" name="phone" class="form-control" id="InputPubPhone" value="<?php echo d($GLOBALS['user']['public_phone']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputPassword3" class="form-label mb-0"><?php echo lang("Укажите действующий пароль"); ?></label>
						<input type="password" name="pass4" class="form-control" id="InputPass4">
						<div id="ErrorPass4" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <button id="profilebtn3" class="btn btn-place-cd mx-auto"><?php echo lang("Сохранить"); ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php }elseif($mod=="profile_org"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="/profile_org/"><?php echo lang("Профиль"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0 place-kd">
		<div class="container">
		<?php echo navmenu($mod); ?>
			<h1 class="title-inner"><?php echo lang("Изменить данные"); ?></h1>
			<div class="row justify-content-center mb-3" style="background: #eee; background-image: url(img/texture/back2.png);">
				<h4 class="title text-center mt-3 pt-0 mb-0"><?php echo lang("Реквизиты"); ?></h4>
				<div class="col-12 col-md-7 p-3">
					<form id="profileform4">
					  <div class="mb-3">
						<label for="InputOrgName" class="form-label mb-0"><?php echo lang("Наименование организации:"); ?></label>
						<input type="text" name="orgname" class="form-control" id="orgname" value="<?php echo d($GLOBALS['user']['org_name']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgFullName" class="form-label mb-0"><?php echo lang("Полное наименование:"); ?></label>
						<input type="text" name="orgfullname" class="form-control" id="orgfullname" value="<?php echo d($GLOBALS['user']['org_fullname']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgUadres" class="form-label mb-0"><?php echo lang("Юр.адрес:"); ?></label>
						<input type="text" name="orguadres" class="form-control" id="orguadres" value="<?php echo d($GLOBALS['user']['org_uadres']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgFadres" class="form-label mb-0"><?php echo lang("Факт.адрес:"); ?></label>
						<input type="text" name="orgfadres" class="form-control" id="orgfadres" value="<?php echo d($GLOBALS['user']['org_fadres']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgOgrn" class="form-label mb-0"><?php echo lang("ОГРН:"); ?></label>
						<input type="text" name="orgorgn" class="form-control" id="orgogrn" value="<?php echo d($GLOBALS['user']['org_ogrn']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgInn" class="form-label mb-0"><?php echo lang("ИНН:"); ?></label>
						<input type="text" name="orginn" class="form-control" id="orginn" value="<?php echo d($GLOBALS['user']['org_inn']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgKpp" class="form-label mb-0"><?php echo lang("КПП:"); ?></label>
						<input type="text" name="orgkpp" class="form-control" id="orgkpp" value="<?php echo d($GLOBALS['user']['org_kpp']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgBank" class="form-label mb-0"><?php echo lang("Банк:"); ?></label>
						<input type="text" name="orgbank" class="form-control" id="orgbank" value="<?php echo d($GLOBALS['user']['org_bank']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgRs" class="form-label mb-0"><?php echo lang("Р/с:"); ?></label>
						<input type="text" name="orgrs" class="form-control" id="orgrs" value="<?php echo d($GLOBALS['user']['org_rs']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgKs" class="form-label mb-0"><?php echo lang("К/с:"); ?></label>
						<input type="text" name="orgks" class="form-control" id="orgks" value="<?php echo d($GLOBALS['user']['org_ks']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputOrgBik" class="form-label mb-0"><?php echo lang("БИК:"); ?></label>
						<input type="text" name="orgbik" class="form-control" id="orgbik" value="<?php echo d($GLOBALS['user']['org_bik']); ?>">
					  </div>
					  <div class="mb-3">
						<label for="InputPassword3" class="form-label mb-0"><?php echo lang("Укажите действующий пароль"); ?></label>
						<input type="password" name="pass3" class="form-control" id="InputPass3">
						<div id="ErrorPass3" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <button id="profilebtn4" class="btn btn-place-cd mx-auto"><?php echo lang("Сохранить"); ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
<?php }elseif($mod=="my"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="<?php echo l("add", 0, $GLOBALS['user']['lang']); ?>"><?php echo lang("Мои объявления"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0 place-kd">
		<div class="container">
		<?php echo navmenu($mod); ?>
				  
				  
			<h1 class="title-inner"><?php echo lang("Мои объявления"); ?></h1>
			<div class="row justify-content-center mb-3">
				<table class="table table-bordered">
					<tr>
						<th class="fw-bold col-1 col-md-1 text-center"><?php echo lang("ID"); ?></th>
						<th class="fw-bold col-1 col-md-1 text-center"><?php echo lang("Тип"); ?></th>
						<th class="fw-bold col-3 col-md-6"><?php echo lang("Раздел/Текст"); ?></th>
						<th class="fw-bold col-2 col-md-2 text-center"><?php echo lang("Статус"); ?></th>
						<th class="fw-bold col-2 col-md-1">&nbsp;</th>
						<th class="fw-bold col-2 col-md-1 text-center"><?php echo lang("Просмотры"); ?></th>
					</tr>
					<?php 
				$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `user`='".sql($GLOBALS['user']['id'])."' and (`type`='p' || `type`='s') ORDER BY `stamp` DESC;";
				$str = mysqlq($query);
				$arsql=mysql_fetch_assoc($str);
				$numrows=mysql_num_rows($str);	
				if ($numrows>0) { 
				do {
					
					$types=array("p" => lang("ПРЕДЛОЖЕНИЕ"),"s" => lang("СПРОС"),"k" => lang("КОМПАНИИ"),"" => lang("-"));
					$catalog=catalog($arsql['catalog']);
					$statuses=array("1" => lang("Опубликовано"), "2" => lang("На модерации"), "3" => lang("Отклонено"));
					$statuses_color=array("1" => "#090", "2" => "#f90", "3" => "#c00");
					?>
					<tr id="line<?php echo d($arsql['id']); ?>">
						<td class="text-center align-middle p-0 p-sm-1"><a href="<?php echo l("edit", 0, $GLOBALS['user']['lang']); ?><?php echo d($arsql['id']); ?>"><?php echo d($arsql['id']); ?></a></td>
						<td class="text-center align-middle p-0 p-sm-1" style="font-size: 80%;"><?php echo d($types[$arsql['type']]); ?></td>
						<td><?php echo "<span style=\"font-size: 90%;\">".implode(" > ", catalogfull($arsql['catalog']))."</span><br><a href=\"".l("edit", 0, $GLOBALS['user']['lang'])."".d($arsql['id'])."\" style=\"color: #222;\">".d($arsql['name'.langpx()]); ?></a></td>
						<td class="text-center align-middle p-0 p-sm-1" style="color: <?php echo $statuses_color[$arsql['status']]; ?>;"><span style="font-size: 90%;"><?php echo d($statuses[$arsql['status']]); ?></span></td>
						<td class="text-center align-middle p-0 p-sm-1">
						<div class="btn-group" role="group">
							<a href="<?php if ($arsql['status']=="1") { echo l("item", $arsql['id'], $GLOBALS['user']['lang']); } else { echo l("edit", 0, $GLOBALS['user']['lang']); echo d($arsql['id']); } ?>" class="btn btn-default p-1"><i class="fa fa-eye"></i></a>
							<a href="<?php echo l("edit", 0, $GLOBALS['user']['lang']); ?><?php echo d($arsql['id']); ?>" class="btn btn-default p-1"><i class="fa fa-edit"></i></a>
							<a href="#" data-id="<?php echo d($arsql['id']); ?>" data-title="<?php echo lang("Подтвердите удаление"); ?>" data-text="<?php echo lang("Вы действительно хотите удалить объявление?"); ?>" class="btn btn-default p-1 confirm"><i class="fa fa-close"></i></a>
						</div>
						</td>
						<td class="text-center align-middle p-0 p-sm-1" style="font-size: 90%;"><?php echo d($arsql['stat']); ?><br><a href="#"><?php echo lang("Отчёт"); ?></a></td>
					</tr>
				<?php } while ($arsql=mysql_fetch_assoc($str)); ?>
				<?php } else { ?>
					<tr>
						<td colspan="6" class="text-center"><?php echo lang("Объявлений не найдено"); ?></td>
					</tr>
				<?php } ?>
				</table>
			</div>
		</div>
	</div>
	
<?php }elseif($mod=="recover"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="#"><?php echo lang("Забыли пароль?"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0">
		<div class="container">
			<h1 class="title-inner"><?php echo lang("Восстановление доступа"); ?></h1>
			<div class="row justify-content-center mb-4" style="background: transparent;">
					<form id="forgotform">
						<?php echo $page['html']; ?>
					</form>
			</div>
		</div>
	</div>
	
<?php }elseif($mod=="forgot"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="#"><?php echo lang("Забыли пароль?"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0">
		<div class="container">
			<h1 class="title-inner"><?php echo lang("Восстановление доступа"); ?></h1>
			<div class="row justify-content-center mb-4" style="background: #eee; background-image: url(img/texture/back2.png);">
				<div class="col-12 col-md-7 p-3">
					<form id="forgotform">

					  <h3 class="text-center"><?php echo lang("Для сброса пароля укажите Ваш E-mail"); ?></h3>
					  <div class="mb-3">
						<label for="InputEmail" class="form-label mb-0"><?php echo lang("Адрес электронной почты"); ?> <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp">
						<div id="ErrorEmail" class="form-text text-danger mt-0 error-message"></div>
					  </div>
					  <button id="forgotbtn" class="btn btn-place-cd mx-auto"><?php echo lang("Восстановить"); ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
<?php }elseif($mod=="confirm"){ ?>

    <div class="breadcrumbs px-3 px-md-0">
      <div class="container">
        <div class="my-4 d-block">
          <a href="/"><?php echo lang("Главная"); ?></a> > <a href="#"><?php echo lang("Подтверждение регистрации"); ?></a>
        </div>
      </div>
    </div>
    <div class="px-3 px-md-0">
		<div class="container">
			<h1 class="title-inner"><?php echo lang("Подтверждение регистрации"); ?></h1>
			<div class="row justify-content-center mb-4" style="background: #eee; background-image: url(img/texture/back2.png);">
				<div class="col-12 col-md-7 p-3">
					<form id="confirmform">

					  <h3 class="text-center"><?php echo lang("Для завершения регистрации и активации аккаунта введите код подтверждения"); ?></h3>
					  <div class="mb-3">
						<label for="InputCode" class="form-label mb-0"><?php echo lang("Код подтверждения"); ?></label>
						<input type="text" name="code" class="form-control" id="InputCode" value="<?php if (preg_match('#[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}#', $_GET['code'])) { echo d($_GET['code']); } ?>">
						<div id="ErrorCode" class="form-text text-danger" style="display: none;"></div>
					  </div>
					  <button id="confirmbtn" class="btn btn-place-cd mx-auto"><?php echo lang("Подтвердить"); ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	

<?php }else{ ?>
    <section class="cat">
      <div class="container">
        <h3 class="title title-primary">
          <?php echo lang("Биржа горнодобывающей промышленности: информационная площадка"); ?>
        </h3>
        <ul
          class="nav nav-tabs d-flex gap-2 mt-4 justify-content-center"
          id="myTab"
          role="tablist"
        >
          <li class="nav-item" role="presentation">
            <button
              class="active"
              id="supply-tab"
              data-bs-toggle="tab"
              data-bs-target="#supply"
              type="button"
              role="tab"
            >
              <?php echo lang("ПРЕДЛОЖЕНИЕ"); ?>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              id="demand-tab"
              data-bs-toggle="tab"
              data-bs-target="#demand"
              type="button"
              role="tab"
            >
              <?php echo lang("СПРОС"); ?>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              id="companies-tab"
              data-bs-toggle="tab"
              data-bs-target="#companies"
              type="button"
              role="tab"
            >
              <?php echo lang("КОМПАНИИ"); ?>
            </button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active px-3 px-md-0" id="supply" role="tabpanel" aria-labelledby="supply-tab">
            <div class="row mt-5 mb-3">
			<?php 
			
			
			$statuspx="_p";
				$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='0' and `status".$statuspx."`='1' ORDER BY `position`, `id`;";
				$str = mysqlq($query);
				$arsql=mysql_fetch_assoc($str);
				$numrows=mysql_num_rows($str);	
				if ($numrows>0) { 
				do {
					if (mb_strlen($arsql['file'])>4 and file_exists("upload/catalog/".$arsql['file'])) {
						$img="/upload/catalog/".$arsql['file'];
					}else{
						$img="/img/no_category_image.png";
					}
					$l=l("catalog", $arsql['id'], $GLOBALS['user']['lang'], "?type=".mb_substr($statuspx,1,1));
			?>
              <div class="col-12 col-md-6 col-lg-4">
                <a href="<?php echo $l; ?>" class="subcat subcat-link mb-2 d-flex gap-2 p-4 pe-0 border rounded-2">
                  <div class="flex-shrink-0">
                    <img src="<?php echo $img; ?>" alt="<?php echo d($arsql['name'.langpx()]); ?>" title="<?php echo d($arsql['name']); ?>" />
                  </div>
                  <div class="subcat-content">
                    <span class="d-block my-3 me-0"><?php echo d($arsql['name'.langpx()]); ?></span>
				  </div>
                </a>
              </div>
				<?php } while($arsql=mysql_fetch_assoc($str));
				} 
			?>
            </div>
          </div>
          <div class="tab-pane fade px-3 px-md-0" id="demand" role="tabpanel" aria-labelledby="demand-tab">
            <div class="row mt-5 mb-3">
			<?php 
			$statuspx="_s";
				$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='0' and `status".$statuspx."`='1' ORDER BY `position`, `id`;";
				$str = mysqlq($query);
				$arsql=mysql_fetch_assoc($str);
				$numrows=mysql_num_rows($str);	
				if ($numrows>0) { 
				do {
					if (mb_strlen($arsql['file'])>4 and file_exists("upload/catalog/".$arsql['file'])) {
						$img="/upload/catalog/".$arsql['file'];
					}else{
						$img="/img/no_category_image.png";
					}
					$l=l("catalog", $arsql['id'], $GLOBALS['user']['lang'], "?type=".mb_substr($statuspx,1,1));
			?>
              <div class="col-12 col-md-6 col-lg-4">
                <a href="<?php echo $l; ?>" class="subcat subcat-link mb-2 d-flex gap-2 p-4 pe-0 border rounded-2">
                  <div class="flex-shrink-0">
                    <img src="<?php echo $img; ?>" alt="<?php echo d($arsql['name'.langpx()]); ?>" title="<?php echo d($arsql['name']); ?>" />
                  </div>
                  <div class="subcat-content">
                    <span class="d-block my-3 me-0"><?php echo d($arsql['name'.langpx()]); ?></span>
				  </div>
                </a>
              </div>
				<?php } while($arsql=mysql_fetch_assoc($str));
				} ?>
            </div>
          </div>
          <div class="tab-pane fade px-3 px-md-0" id="companies" role="tabpanel" aria-labelledby="companies-tab">
            <div class="row mt-5 mb-3">
			<?php 
			$statuspx="_k";
				$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."catalog` WHERE `parent`='0' and `status".$statuspx."`='1' ORDER BY `position`, `id`;";
				$str = mysqlq($query);
				$arsql=mysql_fetch_assoc($str);
				$numrows=mysql_num_rows($str);	
				if ($numrows>0) { 
				do {
					if (mb_strlen($arsql['file'])>4 and file_exists("upload/catalog/".$arsql['file'])) {
						$img="/upload/catalog/".$arsql['file'];
					}else{
						$img="/img/no_category_image.png";
					}
					$l=l("catalog", $arsql['id'], $GLOBALS['user']['lang'], "?type=".mb_substr($statuspx,1,1));
			?>
              <div class="col-12 col-md-6 col-lg-4">
                <a href="<?php echo $l; ?>" class="subcat subcat-link mb-2 d-flex gap-2 p-4 pe-0 border rounded-2">
                  <div class="flex-shrink-0">
                    <img src="<?php echo $img; ?>" alt="<?php echo d($arsql['name'.langpx()]); ?>" title="<?php echo d($arsql['name']); ?>" />
                  </div>
                  <div class="subcat-content">
                    <span class="d-block my-3 me-0"><?php echo d($arsql['name'.langpx()]); ?></span>
				  </div>
                </a>
              </div>
				<?php } while($arsql=mysql_fetch_assoc($str));
				} ?>
            </div>
          </div>
        </div>
      </div>
    </section>
	<?php 
	$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."partners` WHERE `status`='1' ORDER BY `position`, `id` LIMIT 5;";
	$str = mysqlq($query);
	$arsql=mysql_fetch_assoc($str);
	$numrows=mysql_num_rows($str);	
	if ($numrows>0) { ?>
	<section class="partners pb-4">
      <div class="container px-3 px-md-0">
        <h3 class="title"><?php echo lang("Наши партнёры"); ?></h3>
        <div class="grid gap-3">
			
		<?php do { ?>
		    <div class="partner-logo">
            <a href="<?php echo d($arsql['link'.langpx()]); ?>" target="_blank"><img src="/upload/partners/<?php echo d($arsql['file']); ?>" alt="<?php echo d($arsql['name'.langpx()]); ?>" /></a>
          </div>
		<?php } while ($arsql=mysql_fetch_assoc($str)); ?>
		</div>
		</div>	 
    </section>
	<?php } ?>	
		<!-- Главная страница -->
    <section class="kds d-none d-md-block pb-5">
      <div class="container">
        <h3 class="title"><?php echo lang("Форвардные объявления"); ?></h3>
        <div class="row mt-5">
		<?php
		$out1="";
		$out2="";
			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items` WHERE `type`='p' and `catalog`!='8' and `catalog`!='67' and `status`='1' ORDER BY id DESC LIMIT 6;";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);
			if ($numrows>0) { 
			$k=0;
			$out2.="<div>";
				do {
					$l=l("item", $arsql['id'], $GLOBALS['user']['lang']);
					$k++; if ($k>3) { $k=1; $out2.="</div><div>"; }
					$follower=user($arsql['user']);
					$name=$arsql['name'.langpx()];
					$price=fullprice($arsql['price'], $arsql['price_type'], $arsql['price_cur']);
					
					$cachename="";
					$query2="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."items_files` WHERE `item`='".sql($arsql['id'])."' and `type`='image' ORDER BY `position`, `id` LIMIT 1;";
					$str2 = mysqlq($query2);
					$arsql2=mysql_fetch_assoc($str2);
					$numrows2=mysql_num_rows($str2);
					if ($numrows2>0) { 
						
						if (file_exists("upload/items/".$arsql2['file']) and mb_strlen($arsql2['file'])>4) {
							$cachename="/".imagecache("upload/items/", $arsql2['file']);
						}
					} 
					if ($cachename=="") {
						if(file_exists("upload/profiles/".$follower['public_logo']) and mb_strlen($follower['public_logo'])>4) {
							$cachename="/".imagecache("upload/profiles/", $follower['public_logo']);
						}else{
							$cachename="/img/no_news_image.png";
						}
					}
					
$out1.="<div class=\"col-12 col-md-4\">";
$out1.="<a class=\"d-flex gap-3 align-items-start mb-5 kdsa\" href=\"".d($l)."\">";
$out1.="<img class=\"kd-img kd-sm\" src=\"".d($cachename)."\" alt=\"\" />";
$out1.="<div class=\"kd-text\">";
$out1.="<span class=\"d-block\">".d($name)."</span>";
$out1.="<span>".d($price)."</span>";
$out1.="</div>";
$out1.="</a>";
$out1.="</div>";
					

$out2.="<a href=\"".d($l)."\" class=\"d-flex gap-3 align-items-start mb-5 px-3\">";
$out2.="<img class=\"kd-img kd-sm\" src=\"".d($cachename)."\" alt=\"\" />";
$out2.="<div class=\"kd-text\">";
$out2.="<span class=\"d-block\">".d($name)."</span>";
$out2.="<span>".d($price)."</span>";
$out2.="</div>";
$out2.="</a>";

					
				}while($arsql=mysql_fetch_assoc($str));
			$out2.="</div>";
			}
		
		
		?>
		<!-- Главная на узких устройствах-->
			<?php echo $out1; ?>
        </div>
      </div>
    </section>
    <section class="kds d-block d-md-none pb-5">
      <div class="container">
        <h3 class="title"><?php echo lang("Форвардные объявления"); ?></h3>
        <div class="row mt-5 kds-cards">
			<?php echo $out2; ?>
        </div>
      </div>
    </section>
    <?php /* <section class="about pb-4">
      <div class="container">
        <h3 class="title"><?php echo lang("Информация о проекте"); ?></h3>
        <div class="d-flex gap-4 mt-5 flex-wrap flex-md-nowrap px-3 px-md-0">
          <?php echo text("main_about".langpx())['value']; ?>
        </div>
      </div>
    </section> */ ?>
    <section class="news">
      <div class="container mb-5">
        <div class="mb-5 position-relative">
          <h3 class="title"><?php echo lang("Новости горнодобывающей отрасли"); ?></h3>
          <a href="<?php echo flink("news"); ?>" class="all-news position-absolute end-0 d-flex d-md-block justify-content-center"><?php echo lang("Все новости"); ?> >></a>
        </div>
		  <?php 
			$query="SELECT * FROM `".sql($GLOBALS['config']['bd_prefix'])."news` WHERE `status`='1' ORDER BY `stamp` DESC LIMIT 3";
			$str = mysqlq($query);
			$arsql=mysql_fetch_assoc($str);
			$numrows=mysql_num_rows($str);	
			if ($numrows>0) {
				do {
					$out="";

					if (mb_strlen($arsql['file'])>4 and file_exists("upload/news/".$arsql['file'])) {
						$img="/upload/news/".$arsql['file'];
						$alt=d($arsql['name'.langpx()]);
					}else{
						$img="/img/no_news_image.png";
						$alt="";
					}

					$out.="<a href=\"".flink("news", $arsql['id'], $arsql['slug'.langpx()])."\" class=\"news-a row mb-2 mt-4 px-3\">";
					$out.="<div class=\"col-12 col-md-5 col-lg-3\">";
					$out.="<img src=\"".$img."\" class=\"w-100 w-md-auto\" alt=\"".$alt."\" title=\"".$alt."\">";
					$out.="</div>";
					$out.="<div class=\"col-12 col-md-7 col-lg-9\">";
					$out.="<h5 class=\"news-header mt-3 mt-md-0 d-block mb-3\">";
					$out.=d($arsql['name'.langpx()]);
					$out.="</h5>";
					$out.="<p class=\"news-preview\">";
					$out.=d($arsql['preview'.langpx()]);				
					$out.="</p>";
					$out.="<div class=\"d-flex align-items-center justify-content-between mt-2 news-more\">";
					$out.="<span>".date("d.m.Y H:i", $arsql['stamp'])."</span>";
					$out.="<span>".lang("Читать полностью...")."</span>";
					$out.="</div>";
					/* $out.="<div class=\"news-more d-flex justify-content-end\">";
					$out.=lang("Читать полностью...");
					$out.="</div>"; */
					$out.="</div>";
					$out.="</a>";
					
					
					echo $out;
				} while ($arsql=mysql_fetch_assoc($str));	
			}
			
			?>
      </div>
    </section>
	
<?php } ?>
	
    <footer class="footer py-4 mt-auto">
      <div class="container">
		<?php echo text("footer".langpx())['value']; ?>
      </div>
    </footer>
    <div class="bottom-panel py-4">
      <div class="container">
        <div
          class="d-flex justify-content-between align-items-center flex-wrap px-3 px-md-0 gap-2 gap-md-0"
        >
          <span class="text-center text-md-start"
            >© <?php echo date("Y").lang("г."); ?> <?php echo lang("Все права защищены"); ?></span
          >
          <span class="text-center text-md-start"
            ><?php echo lang("InfoGor.ru — информационный портал горнодобывающей отрасли"); ?></span
          >
          <a href="#" class="d-none d-md-flex align-items-center gap-1" style="line-height: 1.1;">
            <?php echo lang("НАВЕРХ"); ?>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="6"
              height="10"
              viewBox="0 0 6 10"
            >
              <g>
                <g>
                  <path
                    fill="current"
                    d="M3 0h1v.29l.017.036.143-.289.896.443-.496 1.005 1.434 3.06-.86.449-.197-.42-.804.42L4 4.709V10H3V4.64l-.16.324-.803-.398-.197.398-.896-.444 1.523-3.08-.46-.984.86-.449L3 .29z"
                  />
                </g>
              </g>
            </svg>
          </a>
        </div>
      </div>
    </div>
	<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel"><?php echo lang("Авторизация"); ?></h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo lang("Закрыть"); ?>"></button>
		  </div>
		  <div class="modal-body pb-0" id="authform">
			  <div class="mb-2">
				<label for="exampleInputEmail1" class="form-label mb-0"><?php echo lang("E-mail:"); ?></label>
				<input type="email" id="authemail" class="form-control" placeholder="<?php echo lang("Введите E-mail"); ?>">
			  </div>
			  <div class="mb-2">
				<label for="exampleInputPassword1" class="form-label mb-0"><?php echo lang("Пароль:"); ?></label>
				<input type="password" id="authpass" class="form-control" placeholder="<?php echo lang("Введите пароль"); ?>">
			  </div>
			  <div class="mb-2 text-center">
			    <div id="autherror" class="form-text text-danger" style="display: none;"></div>
				<a href="<?php echo l("forgot", 0, $GLOBALS['user']['lang']); ?>"><?php echo lang("Забыли пароль?"); ?></a> | <a href="<?php echo l("registration", 0, $GLOBALS['user']['lang']); ?>"><?php echo lang("Зарегистрироваться"); ?></a>
			  </div>
		  </div>
		  <div class="modal-footer">
			  <div class="mx-auto d-flex align-items-center">
				<button id="authbtn" type="button" class="btn btn-place-cd mx-1"><?php echo lang("Авторизоваться"); ?></button>				
			  </div>
		  </div>
		</div>
	  </div>
	</div>
    <script type="text/javascript" src="/js/jquery-3.7.0.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.ui.touch-punch.min.js"></script>
	<script src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>
    <script src="/js/scripts.js"></script>
	<script src="/js/bootbox.min.js"></script>
	<script src="/js/fancybox.umd.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		Fancybox.bind("[data-fancybox]", {

		});
		adelay();

		
	});
	
	function adelay(){
		$(".alert-delay-hide").delay(4000).slideUp(200, function() {
			$(this).alert('close');
		});
	}


	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
	
<?php if ($mod=="profile" || $mod=="profile2") { ?>
	
	$(document).on('click', 'input.error,select.error', function() {
		$(this).removeClass('error').parent().find('.error-message').hide();
	});
	
	$(document).on('click', '#profilebtn1', function() {
			event.preventDefault();
			var haserror=0;
			$('.text-success').remove();
						
						
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#profilebtn1').attr('disabled', 'disabled');
				$('#profileform1').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$.ajax({
				type: 'POST',
				url: '/',
				data: 'action=ajax_profile1&role='+$('#InputRole').val()+'&email='+'&pass0='+$('#InputPass3').val()+'&company='+$('#InputCompany').val()+'&name='+$('#InputName').val()+'&phone='+encodeURIComponent($('#InputPhone').val()),
		
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#profileform1').parent().prepend(jsondata.html);
						$('#profilebtn1').removeAttr('disabled');
						$('#InputPass3').val('');
						$('#profileform1').find('input,select').each(function(){
							if ($(this).attr('id')!="InputEmail"){
								$(this).removeAttr('disabled');
							}
						});
						adelay();
						
					}else{
						if(jsondata.error1!==''){
							$('#ErrorPass3').html(jsondata.error1).show();
							$('#InputPass3').addClass('error');
						}
						$('#profilebtn1').removeAttr('disabled');
						$('#profileform1').find('input,select').each(function(){
							if ($(this).attr('id')!="InputEmail"){
								$(this).removeAttr('disabled');
							}
						});
					}
				}
				});

		});
		
	$(document).on('click', '#profilebtn3', function() {
			event.preventDefault();
			var haserror=0;
			
			$('.text-success').remove();
						
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#profilebtn3').attr('disabled', 'disabled');
				$('#profileform3').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
		var formData = new FormData();
		formData.append('action', 'ajax_profile3');
		formData.append('email', $('#InputPubEmail').val());
		formData.append('name', $('#InputPubName').val());
		formData.append('phone', $('#InputPubPhone').val());
		formData.append('pass0', $('#InputPass4').val());
		formData.append('file', $('input[type=file]')[0].files[0]);
		if ($('#InputJustDel').is(":checked")) {
			formData.append('justdel', '1');
		} else {
			formData.append('justdel', '0');
		}

		$.ajax({
		url: '/',
		dataType: 'json',
        cache: false,
		processData: false,
		contentType: false,
		data: formData, 
		type: 'post',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#profileform3').parent().prepend(jsondata.html);
						$('#profilebtn3').removeAttr('disabled');
						$('#InputPass4').val('');
						$('#profileform3').find('input,select').each(function(){
							if ($(this).attr('id')!="InputEmail"){
								$(this).removeAttr('disabled');
							}
						});
						// alert('1'+jsondata.cache);
						$('img.currentlogo').attr('src', jsondata.cache);
						if (jsondata.dontshow=='1'){
							$('.currentlogo').parent().hide();
						}else{
							$('.currentlogo').parent().show();
						}
						$('#InputPubLogo').val('');
						adelay();
					}else{
						if(jsondata.error1!==''){
							$('#ErrorPass4').html(jsondata.error1).show();
							$('#InputPass4').addClass('error');
						}
						$('#profilebtn3').removeAttr('disabled');
						$('#profileform3').find('input,select').each(function(){
							$(this).removeAttr('disabled');
						});
						adelay();
					}
				}
				});
				
				
				
				
				
		
		});
	
	$(document).on('click', '#profilebtn2', function() {
			event.preventDefault();
			var haserror=0;
			
			$('.text-success').remove();
						
			
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#profilebtn2').attr('disabled', 'disabled');
				$('#profileform2').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$.ajax({
				type: 'POST',
				url: '/',
				data: 'action=ajax_profile2&pass0='+$('#InputPass0').val()+'&pass1='+$('#InputPass1').val()+'&pass2='+$('#InputPass2').val(),
		
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#profileform2').parent().prepend(jsondata.html);
						$('#profilebtn2').removeAttr('disabled');
						$('#profileform2').find('input,select').each(function(){
								$(this).val('').removeAttr('disabled');
						});
						adelay();
						
					}else{
						if(jsondata.error1!==''){
							$('#ErrorPass1').html(jsondata.error1).show();
							$('#InputPass1').addClass('error');
						}
						if(jsondata.error2!==''){
							$('#ErrorPass2').html(jsondata.error2).show();
							$('#InputPass2').addClass('error');
						}
						if(jsondata.error3!==''){
							$('#ErrorPass0').html(jsondata.error3).show();
							$('#InputPass0').addClass('error');
						}
						$('#profilebtn2').removeAttr('disabled');
						$('#profileform2').find('input,select').each(function(){
							if ($(this).attr('id')!="InputEmail"){
								$(this).removeAttr('disabled');
							}
						});
					}
				}
				});

		});
		
<?php } ?>
	
	$(document).on('click', '#regbtn', function() {
			event.preventDefault();
			var haserror=0;
			
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#regbtn').attr('disabled', 'disabled');
				$('#regform').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$.ajax({
				type: 'POST',
				url: '/',
				data: 'action=ajax_reg&role='+$('#InputRole').val()+'&email='+$('#InputEmail').val()+'&pass1='+$('#InputPass1').val()+'&pass2='+$('#InputPass2').val()+'&company='+$('#InputCompany').val()+'&name='+$('#InputName').val()+'&phone='+encodeURIComponent($('#InputPhone').val())+'&check='+$('#InputCheck:checked').val(),
		
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#regform').parent().parent().css('background', 'transparent').html(jsondata.html);
					}else{
						if(jsondata.error1!==''){
							$('#ErrorRole').html(jsondata.error1).show();
							$('#InputRole').addClass('error');
						}
						if(jsondata.error2!==''){
							$('#ErrorEmail').html(jsondata.error2).show();
							$('#InputEmail').addClass('error');
						}
						if(jsondata.error3!==''){
							$('#ErrorPass1').html(jsondata.error3).show();
							$('#InputPass1').addClass('error');
						}
						if(jsondata.error4!==''){
							$('#ErrorPass2').html(jsondata.error4).show();
							$('#InputPass2').addClass('error');
						}
						if(jsondata.error5!==''){
							$('#ErrorCheck').html(jsondata.error5).show();
							$('#InputCheck').addClass('error');
						}
						$('#regbtn').removeAttr('disabled');
						$('#regform').find('input,select').each(function(){
							$(this).removeAttr('disabled');
						});
					}
				}
				});

		});
		

	
	$(document).on('click', '#confirmbtn', function() {
			event.preventDefault();
			var haserror=0;
			
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#confirmbtn').attr('disabled', 'disabled');
				$('#confirmform').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$.ajax({
				type: 'POST',
				url: '/',
				data: 'action=ajax_confirm&code='+$('#InputCode').val(),
		
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#confirmform').parent().parent().css('background', 'transparent').html(jsondata.html);
					}else{
						if(jsondata.error1!==''){
							$('#ErrorCode').html(jsondata.error1).show();
							$('#InputCode').addClass('error');
							$('#confirmbtn').removeAttr('disabled');
							$('#confirmform').find('input,select').each(function(){
								$(this).removeAttr('disabled');
							});

						}

					}
				}
				});

		});	
		
		
	$(document).on('click', '#forgotbtn', function() {
			event.preventDefault();
			var haserror=0;
			
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#forgotbtn').attr('disabled', 'disabled');
				$('#forgotform').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$.ajax({
				type: 'POST',
				url: '/',
				data: 'action=ajax_forgot&email='+$('#InputEmail').val(),
		
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#forgotform').parent().parent().css('background', 'transparent').html(jsondata.html);
					}else{
						if(jsondata.error1!==''){
							$('#ErrorEmail').html(jsondata.error1).show();
							$('#InputEmail').addClass('error');
							$('#forgotbtn').removeAttr('disabled');
							$('#forgotform').find('input,select').each(function(){
								$(this).removeAttr('disabled');
							});

						}

					}
				}
				});

		});
		
		
		
	$(document).on('click', '#authbtn', function() {
			event.preventDefault();
			var haserror=0;
			
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#authbtn').attr('disabled', 'disabled');
				$('#authform').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
				$.ajax({
				type: 'POST',
				url: '/',
				data: 'action=ajax_auth&email='+$('#authemail').val()+'&pass='+$('#authpass').val(),
		
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						location.reload();
					}else{
						if(jsondata.error1!==''){
							$('#autherror').html(jsondata.error1).show();
							$('#authbtn').removeAttr('disabled');
							$('#authform').find('input,select').each(function(){
								$(this).removeAttr('disabled');
							});

						}

					}
				}
				});

		});
		
		
<?php if ($mod=="profile_org") { ?>

	$(document).on('click', '#profilebtn4', function() {
			event.preventDefault();
			var haserror=0;
			
			$('.text-success').remove();
						
			
			$('.error').removeClass('error');
			$('.error-message').html('').hide();
			
				$('#profilebtn4').attr('disabled', 'disabled');
				$('#profileform4').find('input,select').each(function(){
					$(this).attr('disabled', 'disabled');
				});
				
		var formData = new FormData();
		formData.append('action', 'ajax_profile4');
		formData.append('org_name', $('#orgname').val());
		formData.append('org_fullname', $('#orgfullname').val());
		formData.append('org_uadres', $('#orguadres').val());
		formData.append('org_fadres', $('#orgfadres').val());
		formData.append('org_ogrn', $('#orgogrn').val());
		formData.append('org_inn', $('#orginn').val());
		formData.append('org_kpp', $('#orgkpp').val());
		formData.append('org_bank', $('#orgbank').val());
		formData.append('org_rs', $('#orgrs').val());
		formData.append('org_ks', $('#orgks').val());
		formData.append('org_bik', $('#orgbik').val());
		formData.append('pass', $('#InputPass3').val());
		

		$.ajax({
		url: '/',
		dataType: 'json',
        cache: false,
		processData: false,
		contentType: false,
		data: formData, 
		type: 'post',
		success: function(jsondata){
			if (jsondata.result=='1') {
						$('#profileform4').parent().prepend(jsondata.html);
						$('#profilebtn4').removeAttr('disabled');
						$('#InputPass3').val('');
						$('#profileform4').find('input,select').each(function(){
								$(this).removeAttr('disabled');
						});
				
			}else{
						if(jsondata.error1!==''){
							$('#ErrorPass3').html(jsondata.error1).show();
							$('#InputPass3').addClass('error');
						}
						$('#profilebtn4').removeAttr('disabled');
						$('#profileform4').find('input,select').each(function(){
								$(this).removeAttr('disabled');
						});
			}
		},
		});
				


		});


<?php } ?>
		
<?php if ($mod=="my") { ?>

		$(document).on('click', '.confirm', function(event){
			event.preventDefault();
			var currentLink = $(this);
			bootbox.confirm({
				title: currentLink.attr('data-title'),
				message: currentLink.attr('data-text'),
				buttons: {
					confirm: {
						label: '<?php echo lang("Да"); ?>',
						className: 'btn-success'
					},
					cancel: {
						label: '<?php echo lang("Нет"); ?>',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result) { 
						var formData = new FormData();
						formData.append('action', 'ajax_delete');
						formData.append('id', currentLink.attr('data-id'));
						
						$('#line'+currentLink.attr('data-id')).css('opacity', '0.5');
						
						$.ajax({
						url: '/',
						dataType: 'json',
						cache: false,
						processData: false,
						contentType: false,
						data: formData, 
						type: 'post',
						success: function(jsondata){
							if (jsondata.result=='1') {
										$('#line'+currentLink.attr('data-id')).remove();
								if (jsondata.refresh=='1') {
									location.reload();
								}
							}
						},
						});

					}
				}
			});
		});

<?php } ?>

<?php if ($mod=="edit") { ?>

		function refresh_edit()
		{
			if ($('#supply-tab').hasClass('active')){
				if($('input[name="radio_p"]:checked').attr('data-nb')=="1"){
					$('#nb_panel').addClass('d-flex').show();
				}else{
					$('#nb_panel').addClass('d-flex').removeClass('d-flex').hide();
				}
				if($('input[name="radio_p"]:checked').attr('data-bp')=="1"){
					$('#bp_panel').addClass('d-flex').show();
				}else{
					$('#bp_panel').addClass('d-flex').removeClass('d-flex').hide();
				}				
				$('#file_panel1,#youtube_panel').addClass('d-flex').show();
				$('#file_panel2,#file_panel3').removeClass('d-flex').hide();
				if($('input[name="radio_p"]:checked').attr('data-price-name')=="1"){
					$('#price_name1,#name_name1').hide(); 
					$('#price_name2,#name_name2').show(); 
				}else{
					$('#price_name1,#name_name1').show(); 
					$('#price_name2,#name_name2').hide(); 
				}
				$('#price_panel').addClass('d-flex').show(); 
				$('#youtube_panel').show();
			}else if($('#demand-tab').hasClass('active')){
				$('#nb_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#bp_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#file_panel1,#file_panel2,#file_panel3,#file_panel4,#youtube_panel').removeClass('d-flex').hide();
				if($('input[name="radio_s"]:checked').attr('data-price-name')=="1"){
					$('#price_name1,#name_name1').hide(); 
					$('#price_name2,#name_name2').show(); 
					$('#file_panel1,#file_panel2,#youtube_panel').removeClass('d-flex').hide();
					$('#file_panel3').addClass('d-flex').show();
				}else{
					$('#price_name1,#name_name1').show(); 
					$('#price_name2,#name_name2').hide(); 
				}
				$('#price_panel').addClass('d-flex').show(); 
				$('#youtube_panel').hide();		
			}else if($('#companies-tab').hasClass('active')){
				$('#nb_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#bp_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#file_panel1,#file_panel2,#file_panel3,#file_panel4,#youtube_panel').removeClass('d-flex').hide();
				if($('input[name="radio_k"]:checked').attr('data-price-name')=="1"){
					$('#price_name1,#name_name1').hide(); 
					$('#price_name2,#name_name2').show(); 
				}else{
					$('#price_name1,#name_name1').show(); 
					$('#price_name2,#name_name2').hide(); 
				}
				$('#price_panel').removeClass('d-flex').hide(); 
				$('#youtube_panel').hide();	 
			}
			if ($('#price-range').val()>3) {
				$('#price,#price-cur').hide();
			}else{
				$('#price,#price-cur').show();
			}
		}
		
	function ajax_edit_show_photo()
	{
		var formData = new FormData();
		formData.append('action', 'ajax_edit_show_photo');
		formData.append('id', $('#name').attr('data-id'));
		
			$.each($('#image-uploader')[0].files,function(key, input){
				formData.append('file[]', input);
			});
		
		$.ajax({
		url: '/',
		dataType: 'json',
        cache: false,
		processData: false,
		contentType: false,
		data: formData, 
		type: 'post',
		success: function(jsondata){
			if (jsondata.result=='1') {
				$('#photo').html(jsondata.html);
				$('.sortable').sortable();
				$('#image-uploader').val('');
				
			}
		},
		});
		
	}
		
	$(document).ready(function(){
		refresh_edit();
		ajax_edit_show_photo();
	});
	
	$(document).on('change', '#price-range', function() {
		refresh_edit();
	});	
	$(document).on('change', '#image-uploader', function() {

		ajax_edit_show_photo();
		
	});	
	
	$(document).on('click', '.delete-image', function(){
		event.preventDefault();
		
		var th=$(this);
		
			bootbox.confirm({
				title: '<?php echo lang("Подтверждение удаления"); ?>',
				message: '<?php echo lang("Вы уверены, что хотите удалить это изображение?"); ?>',
				buttons: {
					confirm: {
						label: '<?php echo lang("Да"); ?>',
						className: 'btn-success'
					},
					cancel: {
						label: '<?php echo lang("Нет"); ?>',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result) { 
								
						th.parent().css('opacity', '0.5');
						
						var formData = new FormData();
						formData.append('action', 'ajax_edit_delete_photo');
						formData.append('id', th.attr('data-id'));
						
						$.ajax({
						url: '/',
						dataType: 'json',
						cache: false,
						processData: false,
						contentType: false,
						data: formData, 
						type: 'post',
						success: function(jsondata){
							if (jsondata.result=='1') {
								$('#delete_photo'+jsondata.id).parent().remove();
							}
						},
						});

					}
				}
			});
		
		
		
		
		
		
		
		
		
		
		

	});
	
	$(document).on('click', '#sendform', function(){
		event.preventDefault();
		
		
		$('.container').find('select, input, textarea').each(function(){
			$(this).attr('disabled', 'disabled');
		});
		$('.warning-message').hide();
		$('#sendform').attr('disabled', 'disabled');
		
		var formData = new FormData();

		var k=0;
		$.each($(".uploaded-image"), function(){
			formData.append('order['+$(this).attr('data-id')+']', k);
			k++;
		});
		
		formData.append('action', 'ajax_edit');
		formData.append('id', $('#name').attr('data-id'));
		formData.append('name', $('#name').val());
		formData.append('pricerange', $('#price-range').val());
		formData.append('price', $('#price').val());
		formData.append('pricecur', $('#price-cur').val());
		formData.append('text', $('#text').val());
		formData.append('text2', $('#text2').val());
		formData.append('bp', $('#bp').val());
		formData.append('nb', $('#nb').val());
		formData.append('video', $('#video').val());
		
		$.ajax({
		url: '/',
		dataType: 'json',
        cache: false,
		processData: false,
		contentType: false,
		data: formData, 
		type: 'post',
		success: function(jsondata){
			if (jsondata.result=='1') {
				$('.container').find('select, input, textarea').each(function(){
					$(this).removeAttr('disabled');
				});
				$('#sendform').removeAttr('disabled');
				if (jsondata.s=='0'){
					if (jsondata.error11=='1') { $('#error11').show(); }
					if (jsondata.error12=='1') { $('#error12').show(); }
					if (jsondata.error13=='1') { $('#error13').show(); }
					if (jsondata.error2=='1') { $('#error2').show(); }
					if (jsondata.error3=='1') { $('#error3').show(); }
					if (jsondata.error4=='1') { $('#error4').show(); }
					if (jsondata.error5=='1') { $('#error5').show(); }
					
				}else{
					$('#form_ok').html(jsondata.html).show();
				}
			}
		},
		});
	});
	

		
	$(document).on('click', '.public-data', function(){
		$(this).parent().parent().find('div.mt-2').show();
	});



<?php } ?>


<?php if ($mod=="catalog") { ?>


	$(document).on('click', '.clear', function(){
		event.preventDefault();
		$('.'+$(this).attr('data-id')).prop('checked', false);
	});

	$(document).on('click', '#filter_mobile', function(){
		event.preventDefault();
		$('#'+$(this).attr('data-target')).toggle(300);
	});
	
<?php } ?>

		
<?php if ($mod=="add") { ?>

(function($){$.fn.imageUploader=function(options){let defaults={preloaded:[],imagesInputName:'images',preloadedInputName:'preloaded',label:'<?php echo lang("Перенесите файлы для загрузки сюда или нажмите для выбора"); ?>'};let plugin=this;plugin.settings={};plugin.init=function(){plugin.settings=$.extend(plugin.settings,defaults,options);plugin.each(function(i,wrapper){let $container=createContainer();$(wrapper).append($container);$container.on("dragover",fileDragHover.bind($container));$container.on("dragleave",fileDragHover.bind($container));$container.on("drop",fileSelectHandler.bind($container));if(plugin.settings.preloaded.length){$container.addClass('has-files');let $uploadedContainer=$container.find('.uploaded');for(let i=0;i<plugin.settings.preloaded.length;i++){$uploadedContainer.append(createImg(plugin.settings.preloaded[i].src,plugin.settings.preloaded[i].id,!0))}}})};let dataTransfer=new DataTransfer();let createContainer=function(){let $container=$('<div>',{class:'image-uploader'}),$input=$('<input>',{type:'file',id:plugin.settings.imagesInputName+'-'+random(),name:plugin.settings.imagesInputName+'[]',multiple:''}).appendTo($container),$uploadedContainer=$('<div>',{class:'uploaded sortable'}).appendTo($container).sortable(),$textContainer=$('<div>',{class:'upload-text'}).appendTo($container),$i=$('<i>',{class:'fa fa-cloud-arrow-up',text:''}).appendTo($textContainer),$span=$('<span>',{text:plugin.settings.label}).appendTo($textContainer);$container.on('click',function(e){prevent(e);$input.trigger('click')});$input.on("click",function(e){e.stopPropagation()});$input.on('change',fileSelectHandler.bind($container));return $container};let prevent=function(e){e.preventDefault();e.stopPropagation()};let createImg=function(src,id){let $container=$('<div>',{class:'uploaded-image'}),$img=$('<img>',{src:src}).appendTo($container),$button=$('<button>',{class:'delete-image'}).appendTo($container),$i=$('<i>',{class:'fa fa-close',text:''}).appendTo($button);if(plugin.settings.preloaded.length){$container.attr('data-preloaded',!0);let $preloaded=$('<input>',{type:'hidden',name:plugin.settings.preloadedInputName+'[]',value:id}).appendTo($container)}else{$container.attr('data-index',id),$container.attr('data-name',src)}
$container.on("click",function(e){prevent(e)});$button.on("click",function(e){prevent(e);if($container.data('index')){let index=parseInt($container.data('index'));$container.find('.uploaded-image[data-index]').each(function(i,cont){if(i>index){$(cont).attr('data-index',i-1)}});dataTransfer.items.remove(index)}
$container.remove();if(!$container.find('.uploaded-image').length){$container.removeClass('has-files')}});return $container};let fileDragHover=function(e){prevent(e);if(e.type==="dragover"){$(this).addClass('drag-over')}else{$(this).removeClass('drag-over')}};let fileSelectHandler=function(e){prevent(e);let $container=$(this);$container.removeClass('drag-over');let files=e.target.files||e.originalEvent.dataTransfer.files;setPreview($container,files)};let setPreview=function($container,files){$container.addClass('has-files').addClass('s');let $uploadedContainer=$container.find('.uploaded'),$input=$container.find('input[type="file"]');$(files).each(function(i,file){dataTransfer.items.add(file);$uploadedContainer.append(createImg(URL.createObjectURL(file),dataTransfer.items.length-1))});$input.prop('files',dataTransfer.files)};let random=function(){return Date.now()+Math.floor((Math.random()*100)+1)};this.init();return this}}(jQuery))
		
		function refresh_list1()
		{
				$('#list11, #list12, #list13').attr('disabled', 'disabled');
				$.ajax({
				type: 'POST',
				url: '/',
				data: 'action=ajax_list&list1='+$('#list11').val()+'&list2='+$('#list12').val()+'&list3='+$('#list13').val(),
				dataType: 'json',
				success: function(jsondata){
					if (jsondata.result=='1') {
						$('#list11').html(jsondata.list1).val(jsondata.val1);
						$('#list12').html(jsondata.list2).val(jsondata.val2);
						$('#list13').html(jsondata.list3).val(jsondata.val3);
			
						if (jsondata.hide2=='1') {
							$('#list12').hide();
						}else{
							$('#list12').show();
						}
						if (jsondata.hide3=='1') {
							$('#list13').hide();
						}else{
							$('#list13').show();
						}
						$('#list11, #list12, #list13').removeAttr('disabled');
					}
				},
				});
		}
		
		function refresh_add_type()
		{
			if ($('#supply-tab').hasClass('active')){
				if($('input[name="radio_p"]:checked').attr('data-nb')=="1"){
					$('#nb_panel').addClass('d-flex').show();
				}else{
					$('#nb_panel').addClass('d-flex').removeClass('d-flex').hide();
				}
				if($('input[name="radio_p"]:checked').attr('data-bp')=="1"){
					$('#bp_panel').addClass('d-flex').show();
				}else{
					$('#bp_panel').addClass('d-flex').removeClass('d-flex').hide();
				}				
				$('#file_panel1,#youtube_panel').addClass('d-flex').show();
				$('#file_panel2,#file_panel3').removeClass('d-flex').hide();
				if($('input[name="radio_p"]:checked').attr('data-price-name')=="1"){
					$('#price_name1,#name_name1').hide(); 
					$('#price_name2,#name_name2').show(); 
				}else{
					$('#price_name1,#name_name1').show(); 
					$('#price_name2,#name_name2').hide(); 
				}
				$('#price_panel').addClass('d-flex').show(); 
				$('#youtube_panel').show();
			}else if($('#demand-tab').hasClass('active')){
				$('#nb_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#bp_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#file_panel1,#file_panel2,#file_panel3,#youtube_panel').removeClass('d-flex').hide();
				if($('input[name="radio_s"]:checked').attr('data-price-name')=="1"){
					$('#price_name1,#name_name1').hide(); 
					$('#price_name2,#name_name2').show(); 
					$('#file_panel1,#file_panel2,#file_panel3,#youtube_panel').removeClass('d-flex').hide();
				}else{
					$('#price_name1,#name_name1').show(); 
					$('#price_name2,#name_name2').hide(); 
				}
				$('#price_panel').addClass('d-flex').show(); 
				$('#youtube_panel').hide();		
			}else if($('#companies-tab').hasClass('active')){
				$('#nb_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#bp_panel').addClass('d-flex').removeClass('d-flex').hide();
				$('#file_panel1,#file_panel2,#file_panel3,#youtube_panel').removeClass('d-flex').hide();
				if($('input[name="radio_k"]:checked').attr('data-price-name')=="1"){
					$('#price_name1,#name_name1').hide(); 
					$('#price_name2,#name_name2').show(); 
				}else{
					$('#price_name1,#name_name1').show(); 
					$('#price_name2,#name_name2').hide(); 
				}
				$('#price_panel').removeClass('d-flex').hide(); 
				$('#youtube_panel').hide();	 			
			}
			if ($('#price-range').val()>3) {
				$('#price,#price-cur').hide();
			}else{
				$('#price,#price-cur').show();
			}
		}
		
		
		
	$(document).ready(function(){
		refresh_list1();
		refresh_add_type();
		$('.input-images-1').imageUploader();
	});
	$(document).on('change', '#list11,#list12,#list13', function() {
		refresh_list1();
	});
	$(document).on('click', '.add-type', function() {
		refresh_add_type();
	});
	$(document).on('click', '.warning', function() {
		$(this).removeClass('warning');
		$(this).parent().parent().find('.warning').each(function(){
			$(this).removeClass('warning');
		});
		$(this).parent().parent().find('.warning-message').each(function(){
			$(this).hide();
		});
	});
	$(document).on('change', 'input[name="radio_p"],input[name="radio_s"],input[name="radio_k"],#price-range', function() {
		refresh_add_type();
	});	
	
	$(document).on('click', '.public-data', function(){
		$(this).parent().parent().find('div.mt-2').show();
	});
	$(document).on('click', '#sendform', function(){
		event.preventDefault();

		var itemtype = 0;
		var formData = new FormData();
		
		if ($('#supply-tab').hasClass('active')){
			var itemtype = 1;
			
			
			$.each($(".image-uploader input")[0].files,function(key, input){
				formData.append('file[]', input);
			});
			
			var k=0;
			$.each($(".uploaded-image"), function(){
				formData.append('order['+$(this).attr('data-index')+']', k);
				k++;
			});

		}else if($('#demand-tab').hasClass('active')){	
			var itemtype = 2;
		}else if($('#companies-tab').hasClass('active')){
			var itemtype = 3;
		}	
		$('.container').find('select, input, textarea').each(function(){
			$(this).attr('disabled', 'disabled');
		});
		$('.warning-message').hide();
		$('#sendform').attr('disabled', 'disabled');

		
		formData.append('action', 'ajax_add');
		formData.append('itemtype', itemtype);
		formData.append('radio_p', $('input[name="radio_p"]:checked').val());
		formData.append('radio_s', $('input[name="radio_s"]:checked').val());
		formData.append('radio_k', $('input[name="radio_k"]:checked').val());
		formData.append('list11', $('#list11').val());
		formData.append('list12', $('#list12').val());
		formData.append('list13', $('#list13').val());
		formData.append('name', $('#name').val());
		formData.append('pricerange', $('#price-range').val());
		formData.append('price', $('#price').val());
		formData.append('pricecur', $('#price-cur').val());
		formData.append('text', $('#text').val());
		formData.append('text2', $('#text2').val());
		formData.append('bp', $('#bp').val());
		formData.append('nb', $('#nb').val());
		formData.append('video', $('#video').val());
		
		$.ajax({
		url: '/',
		dataType: 'json',
        cache: false,
		processData: false,
		contentType: false,
		data: formData, 
		type: 'post',
		success: function(jsondata){
			if (jsondata.result=='1') {
				$('.container').find('select, input, textarea').each(function(){
					$(this).removeAttr('disabled');
				});
				$('#sendform').removeAttr('disabled');
				if (jsondata.s=='0'){
					if (jsondata.error11=='1') { $('#error11').show(); }
					if (jsondata.error12=='1') { $('#error12').show(); }
					if (jsondata.error13=='1') { $('#error13').show(); }
					if (jsondata.error2=='1') { $('#error2').show(); }
					if (jsondata.error3=='1') { $('#error3').show(); }
					if (jsondata.error4=='1') { $('#error4').show(); }
					if (jsondata.error5=='1') { $('#error5').show(); }
					
				}else{
					$('#add_form').remove();
					$('#form_ok').html(jsondata.html).show();
				}
			}
		},
		});
	});
<?php } ?>	
		
	</script>

  </body>
</html>