<?php
// Get php version
$phpver = phpversion();

// convert superglobals if php is lower then 4.1.0
if ($phpver < '4.1.0') {
  $_GET = $HTTP_GET_VARS;
  $_POST = $HTTP_POST_VARS;
  $_SERVER = $HTTP_SERVER_VARS;
  $_FILES = $HTTP_POST_FILES;
  $_ENV = $HTTP_ENV_VARS;
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $_REQUEST = $_POST;
  } elseif($_SERVER['REQUEST_METHOD'] == "GET") {
    $_REQUEST = $_GET;
  }
  if(isset($HTTP_COOKIE_VARS)) {
    $_COOKIE = $HTTP_COOKIE_VARS;
  }
  if(isset($HTTP_SESSION_VARS)) {
    $_SESSION = $HTTP_SESSION_VARS;
  }
}

// override old superglobals if php is higher then 4.1.0
if($phpver >= '4.1.0') {
  $HTTP_GET_VARS = $_GET;
  $HTTP_POST_VARS = $_POST;
  $HTTP_SERVER_VARS = $_SERVER;
  $HTTP_POST_FILES = $_FILES;
  $HTTP_ENV_VARS = $_ENV;
  $PHP_SELF = $_SERVER['PHP_SELF'];
  if(isset($_SESSION)) {
    $HTTP_SESSION_VARS = $_SESSION;
  }
  if(isset($_COOKIE)) {
    $HTTP_COOKIE_VARS= $_COOKIE;
  }
}

//check access direct to file
if (stristr(htmlentities($_SERVER['PHP_SELF']), "connect.php")) {
    header("Location: index.php");
    exit();
}

if ($phpver >= '4.0.4pl1' && isset($_SERVER['HTTP_USER_AGENT']) && strstr($_SERVER['HTTP_USER_AGENT'],'compatible')) {
  if (extension_loaded('zlib')) {
    @ob_end_clean();
    ob_start('ob_gzhandler');
  }
} elseif ($phpver > '4.0' && isset($_SERVER['HTTP_ACCEPT_ENCODING']) && !empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
  if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    if (extension_loaded('zlib')) {
      $do_gzip_compress = true;
      ob_start(array('ob_gzhandler',5));
      ob_implicit_flush(0);
      //header('Content-Encoding: gzip');
    }
  }
}

if (!ini_get('register_globals')) {
  @import_request_variables("GPC", "");
}

ini_set('display_errors', 1);
error_reporting(E_ALL^E_NOTICE);

if(!defined("PATH_FILE")){
	die("You can not access direct to this file...");
}


	if(defined("ADMIN_FILE")){
		$__pre = "../../";
	}elseif(defined("ADMIN_INDEX")){
		$__pre = "../";
	}else{
		$__pre = "";
	}
	define("__PATH", $__pre . "applications/");


require_once(__PATH . "config.php");
require_once(__PATH . "connect.php");

$adminuser=$_SESSION['admin'];
 
if(isset($admin) && $admin == $_COOKIE['admin'])
{
	$admin = $admin;
}

 
function is_admin($admin){
	global $prefix, $acookie, $db;
	//if(isset($admin)){
		acookie($admin);
		$res = $db->rows($db->query("select pass from ".$prefix."_admin where id='".$acookie[0]."'"));
		$pass = $res['pass'];
		if($pass==$acookie[2] && $pass!=""){
			return true;
		}else{
			return false;
		}
 }
 
 
 function is_admin1($admin){
	global $prefix, $db;
	//if(isset($admin)){
 		$res = $db->rows($db->query("select pass from ".$prefix."_admin where id=1"));
		$pass = $res['pass'];
 		if($pass==$_SESSION['password'] && $pass!=""){
			return true;
		}else{
			return false;
		}
 }
  
 

function acookie($admin){
	global $prefix, $acookie, $db;
	$admin = $admin;
	$acookie = explode(":^", $admin);
	$res = $db->rows($db->query("select admin, pass from ".$prefix."_admin where id='".$acookie[0]."'"));
	$acookie[1] = $res['admin'];
	$pass = $res['pass'];
	if($pass==$acookie[2] && $pass!=""){
		return $acookie;
	}else{
		unset($admin);
		unset($acookie);
	}
}

function createthumb($name,$filename,$new_w,$new_h=""){
	$psize = getimagesize($name);
	if($new_h==""){
		$new_h = $psize[1]/($psize[0]/$new_w);
	}
	$system= str_replace(".", "", strtolower(substr($name, strrpos($name, "."))));
	if (preg_match('/jpg|jpeg/',$system)){
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/',$system)){
		$src_img=imagecreatefrompng($name);
	}
	if (preg_match('/gif/',$system)){
		$src_img=imagecreatefromgif($name);
	}
$old_x=imageSX($src_img);
$old_y=imageSY($src_img);
	$thumb_w=$new_w;
	$thumb_h=$new_h;
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
if (preg_match("/png/",$system[1]))
{
	imagepng($dst_img,$filename); 
}elseif(preg_match("/gif/",$system[1]))
{
	imagegif($dst_img,$filename);
} else {
	imagejpeg($dst_img,$filename); 
}
	@chmod($filename, 0777);
imagedestroy($dst_img); 
imagedestroy($src_img); 
}

function js($file){
	if(file_exists(__PATH . "js".$file)){
		?>
		<script src="<?php echo __PATH; ?>js/<?php echo $file; ?>"></script>
		<?php
	}
}

function rewrite($url){
	return $url;
}

function pagenum($link, $sql, $storynum, $pagenum){
	global $prefix, $db;
	$show = 5;
	$cfshow = ceil($show / 2);
	$acc = $show - $cfshow;
	$r = "";
	if ($pagenum == "") { $pagenum = 1 ; }
	$offset = ($pagenum-1) * $storynum ;
	$r['offset'] = $offset;


	$sql_pn = $sql;
	$result_pn = $db->query($sql_pn);
	$numstories = $db->nums($result_pn);
	$numpages = ceil($numstories / $storynum);
	$fpage = 1;
	$lpage = $numpages+1;
	$r['pagenum'] = "PAGES: ";
	if ($numpages > 1) {
		//$r['pagenum']="<span class=\"pagediv\">" ;
		if($numpages > $show){
			if($pagenum >= $cfshow){
				//$r['pagenum'].="<a href=\"".rewrite($link)."\" class=\"pagenum\" title=\""._FIRSTPAGE."\"><<</a> ... ";
				$fpage = $pagenum - $acc;
				$lpage = $pagenum + $acc;
			}
		}
		if($pagenum < $cfshow){
			$lpage = $show;
		}
		if($lpage > $numpages){
			$lpage = $numpages;
		}
		for ($i=$fpage; $i <= $lpage; $i++) {
			if ($i == $pagenum) {
				$r['pagenum'].="<font class=\"pagenum_current\">$i</font> ";
			} else {
					$r['pagenum'].="<a href=\"".rewrite("$link&pagenum=$i")."\" >$i</a> ";
			}
			if($i < $lpage){
				$r['pagenum'].=" | ";
			}
		}
		if($numpages > $show){
			if($lpage < $numpages){
				//$r['pagenum'].=" ... <a href=\"".rewrite("$link&pagenum=".$numpages)."\" class=\"pagenum\" title=\""._LASTPAGE."\">>></a>";
			}
		}
		//$r['pagenum'].="</span>" ;
	}else{
		$r['pagenum'] = "PAGES: 1 ";
	}
	//echo"lpage = $lpage<br>numpages = $numpages<br>";
	$r['storynum'] = $storynum;
	$r['now'] = $pagenum;
	$r['total'] = $numstories;
	return $r;
}

function showPagenum($pnum, $type){
	if($pnum!=""){
		echo"<div style=\"padding-top: 5px; padding-bottom: 5px; text-align: ".$type.";\">".$pnum."</div>";
	}
}

function sendmail($to, $subject, $detail, $from, $name = ""){
	global $sitename;
	$xheaders = "From: " . $from . "\n";
	$xheaders .= "X-Sender: <" . $from . ">\n";
	$xheaders .= "X-Mailer: PHP\n"; // mailer
	$xheaders .= "X-Priority: 6\n"; // Urgent message!
	$xheaders .= "Content-Type: text/html; charset="._CHARSET."\n"; // Mime type
	$mailhead = "<style>\n"
	."TD {font-family: Tahoma, Sans Serif; color: #696969; font-size: 12px;}\n"
	."</style>\n"
	."<table width=100%>"
	."<tr><Td width=100% valign=top>";
	$mailfoot = "</td></tR></table>";
	$chk = mail("$to","$subject","$mailhead$detail$mailfoot",$xheaders);
	return $chk;
} 
if($lang=='eng'){
	$en= "_en";
	$allteam = "All Team";
	$register = "Register";
	$kyoruki = "Kyoruki";
	$kteam = "Kyoruki Team";
	$poomsae = "Poomsae";
	$totalscore = "Total Score";
	$courseA = "Course";
	$rank = "Ranking";
	$expri = "Deadline Applied";
	$expridetail = "Please Contact";
	$calsssA = "Class A (Open)";
	$calsssB = "Class B (Begin)";
	$calsssC = "Class C (New)";
	$calsssD = "Class D (First)";
	$sexm = "Male";
	$sexf = "FeMale";
	$beltA = "Belt";
	$poomsaeA = "Poomsae";
	$poomsaepair = "Poomsae Pair";
	$poomsaeteam = "Poomsae Team";
	$editteam = "Edit Team";
	$changepassm = "Change Password";
	$pricem ="Price";
	$resultA = "Match Result";
	$sendresult ="Send Result";
	$certificateA  ="Certificate";
	$editnamea ="Edit Name";
	$weightAA  ="Weight";
	$ccategory = "Change Category";
	$cclass = "Change Class";
	$allmm = "all athletes";
	$certeam = "Certificate Team";
	$cerdone ="Print Done";
	$passa = "Pass";
	$passb = "Waiting";
	
}else{
	$en= "";
	$allteam = "หน้ารวมทีม";
	$register = "ลงทะเบียน";
	$kyoruki = "ต่อสู้";
	$kteam = "ต่อสูทีม";
	$poomsae = "Poomsae";
	$totalscore = "คะแนนรวม";
	$courseA = "สนาม";
	$rank = "ตรวจสอบ Ranking นักกีฬา";
	$expri = "หมดเขตรับสมัคร";
	$expridetail = "ท่านไม่สามารถเพิ่มชื่อนักกีฬาได้  มีปัญหากรุณาติดต่อ";
	$calsssA = "Class A (Open)";
	$calsssB = "Class B (มือใหม่)";
	$calsssC = "Class C (มือใหม่พิเศษ)";
	$calsssD = "Class D (เริ่มต้น กลุ่มโรงเรียน)";
	$sexm = "ชาย";
	$sexf = "หญิง";
	$beltA = "สาย";
	$poomsaeA = "พุ่มเซ่เดี่ยว";
	$poomsaepair = "พุ่มเซ่ คู่-ผสม";
	$poomsaeteam = "พุ่มเซ่ทีม";
	$editteam = "เพิ่มเติมแก้ไขรายชื่อนักกีฬา";
	$changepassm = "เปลี่ยนพาสเวิด";
	$pricem ="ค่าสมัครแข่ง";
	$resultA = "ผลการแข่งขัน";
	$sendresult ="ส่งผล";
	$certificateA  ="ใบประกาศ";
	$editnamea ="แก้ไขชื่อ";
	$weightAA  ="ชั่งน้ำหนัก";
	$ccategory = "เปลี่ยนรุ่นแขงขน";
	$cclass = "เปลี่ยน Class";
	$allmm = "นักกีฬาทั้งหมด";
	$certeam = "รับใบประกาศ";
	$cerdone ="Print แล้ว";
	$passa = "ผ่าน";
	$passb = "ยังไม่ผ่าน";
	
}
?>