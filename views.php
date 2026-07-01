<?php
session_start();
require_once("../app/conn_pdo.php");

error_reporting(0);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$updateA = $_GET['updateA'];
$match = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$result_select = $db->prepare("SELECT * from thannam_match  where id = :id");
$result_select->execute(['id' => $match]);
$result = $result_select->fetch();

$update_match = $db->prepare("UPDATE thannam_match set readA = readA + 1  where id = :id");
$update_match->execute(['id' => $match]);

// Common course array definitions used below
$course = array("", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N");
$course2 = array("", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N");

$id = $result['id'];
$msg = $result['msg'];
$tel = $result['tel'];
$pic = $result['pic'];
$email = $result['email'];

$user = $_POST['user'];
$pwd = $_POST['pwd'];
if ($user <> "" and $pwd <> "") {



    $sql = $db->prepare("SELECT * from  thannam_match where  id = :user  and  pass = :pwd");
    $sql->execute(['user' => $user, 'pwd' => $pwd]);
    $num_rows = $sql->rowCount();
    $result = $sql->fetch();


    if ($num_rows <> 0) {

        $_SESSION['idmatch'] = $result['id'];
        $_SESSION['pwdmatch'] = $result['pass'];
        header("Location: view-edit.php");
    } else {
        $err = " ผิด";
    }
}

$banner_select = $db->prepare("SELECT * from th_news  where ip = :id");
$banner_select->execute(['id' => $match]);
$banner = $banner_select->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>
        <?= $result['nameA'] ?>
        : ธารน้ำเทควันโด
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property=”og:image” content=”https://www.thannam.net/2016/banner/<?= $banner['pic'] ?>” />


    <link rel="stylesheet" href="../css/bootstrap.css" media="all" />
    <link rel="stylesheet" href="../css/font-awesome.css" media="all" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/superfish.css" media="all" />
    <link rel="stylesheet" href="../css/owl.carousel.css" media="all" />
    <link rel="stylesheet" href="../css/owl.theme.css" media="all" />
    <link rel="stylesheet" href="../css/jquery.navgoco.css" />
    <link rel="stylesheet" href="../css/flexslider.css" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/responsive.css" />
    <link href="../../champ/css/allteam.css" rel="stylesheet">
    <link rel="stylesheet" href="modern_style.css?v=<?= date("His") ?>">



    <script src="../js/modernizr.custom.js"></script>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../img/apple-touch-icon-114x114.png">

    <!-- Cleaned legacy styles to apply modern_style.css -->
</head>

<body class="punica-home-1">
    <?php include "../head_in-pdo.php"; ?>
    <div id="main-content">

        <!-- home-slider-box -->

        <div class="widget-area-1 clearfix">
            <div class="wrapper punica-shadow-box">
                <div class="widget-area-2 pull-left">
                    <div class="breadcrumb clearfix"> <span itemtype="http://data-vocabulary.org/Breadcrumb"
                            itemscope="">
                            <a href="../index.php" itemprop="url"> <span itemprop="title">Home</span> </a> </span>
                        <span>&nbsp;/&nbsp;</span> <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""
                            class="prev-page">
                            <a href="../match.php" itemprop="url"> <span itemprop="title">TOURNAMENT</span> </a> </span>
                        /
                        <?= $result['nameA'] ?>
                    </div>
                    <!-- breadcrumb -->
                    <?php if ($banner['pic'] <> '') { ?>
                        <a href="http://www.thannam.net/champ/allteam.php?match=<?= $id ?>"><img
                                src="../banner/<?= $banner['pic'] ?>"></a>
                        <br><br><?php } ?>


                    <section class="entry-box standard-post">
                        <div class="entry-thumb">
                            <div class="entry-caption">
                                <div class="entry-caption-inner">
                                    <h3 class="entry-title">
                                        <?= $result['nameA']; ?>
                                    </h3>

                                    <?php if ($result['changA'] == 1) { ?>
                                        <div class="chA2">
                                            <h2>เลื่อนการแข่งขัน</h2>
                                            <p>Postpone the competition </p>
                                        </div>
                                    <?php } ?>

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <div class="fb-like"
                                                    data-href="http://www.thannam.net/2016/match/views.php?id=<?= $_GET['id'] ?>"
                                                    data-layout="button_count" data-action="like" data-show-faces="true"
                                                    data-share="true"></div>
                                            </td>
                                            <td align="right"><?php if (empty($updateA)) { ?>
                                                    <table border="0" cellpadding="2" cellspacing="0"
                                                        class="table table-striped">
                                                        <tr>
                                                            <td align="right"><a
                                                                    href="?id=<?= $result['id']; ?>&updateA=yes"
                                                                    class="punica-button red-button medium-button">
                                                                    แก้ไขแมทการแข่งขันที่นี่ครับ </a></td>
                                                        </tr>
                                                    </table>
                                                <?php } else { ?>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="1"
                                                        class="table table-striped">
                                                        <form method="post"
                                                            action="views.php?id=<?= $result['id']; ?>&updateA=yes">
                                                            <tr>
                                                                <td align="right" class="style3"><strong> Password
                                                                        <?= $err; ?>
                                                                    </strong>&nbsp;
                                                                    <input name="user" type="hidden"
                                                                        value="<?= $_GET['id']; ?>"> <input type="password"
                                                                        name="pwd">
                                                                </td>
                                                                <td width="8%"><input type="submit" value="  แก้ไข  "></td>
                                                            </tr>
                                                        </form>
                                                    </table>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- end:entry-caption-inner -->
                            </div>
                            <!-- end:entry-caption -->
                        </div>
                        <!-- end:entry-thumb -->




                        <div class="entry-content clearfix">





                            <?php if ($result['regonline'] == '1') { ?>


                                <div style="justify-content: center; text-align:center;">
                                    <!-- <a class="punica-button big-button button"
                                        href="http://www.thannam.net/champ/allteam.php?match=<?= $id ?>"><i
                                            class="fa fa-laptop"></i> &nbsp; REGISTER ONLINE</a> -->
                                    <a class="punica-button big-button button-new"
                                        href="http://www.thannam.net/champ7/index.php?match=<?= $id ?>"><i
                                            class="fa fa-laptop"></i> &nbsp; REGISTER ONLINE NEW Version</a>

                                    <?php if ($result['mma'] <> '0') { ?>
                                        <a class="punica-button red-button big-button buttonHup"
                                            href="http://www.thannam.net/hapkido2/allteam.php?match=<?= $result['mma'] ?>"><i
                                                class="fa fa-laptop"></i> &nbsp; HAPKIDO REGISTER</a>
                                    <?php } ?>

                                    <?php if ($result['lg'] <> '') { ?>
                                        <a class="punica-button red-button big-button buttonHup"
                                            href="https://www.thannam.net/champ/match_lg.php?lg=<?= $result['lg'] ?>&match_id=<?= $_GET['id'] ?>"><i
                                                class="fa fa-laptop"></i> &nbsp; RANKING SCORE</a>
                                    <?php } ?>
                                </div>


                                <?php
                                // Consolidated queries using GROUP BY and indexed column queries
                                $stmt_class = $db->prepare("SELECT classA, count(id) as cnt from thannam_champion_mann WHERE match1 = :match GROUP BY classA");
                                $stmt_class->execute([':match' => $match]);
                                $class_counts = $stmt_class->fetchAll(PDO::FETCH_KEY_PAIR);

                                $NumA = isset($class_counts['A']) ? (int) $class_counts['A'] : 0;
                                $NumB = isset($class_counts['B']) ? (int) $class_counts['B'] : 0;
                                $NumC = isset($class_counts['C']) ? (int) $class_counts['C'] : 0;
                                $NumD = isset($class_counts['D']) ? (int) $class_counts['D'] : 0;
                                $NumE = isset($class_counts['E']) ? (int) $class_counts['E'] : 0;

                                $stmt_vr = $db->prepare("SELECT count(id) from thannam_champion_vr WHERE match1 = :match");
                                $stmt_vr->execute([':match' => $match]);
                                $NumVR = $stmt_vr->fetchColumn();

                                //======= SPEED =======
                                $NumSP = 0;
                                if ($result['speedK2'] == 1) {
                                    $stmt_sp = $db->prepare("SELECT count(id) from thannam_champion_speed WHERE match1 = :match");
                                    $stmt_sp->execute([':match' => $match]);
                                    $NumSP = $stmt_sp->fetchColumn();
                                }

                                //======= POOMSAE =======
                                $NumPS = 0;
                                if ($result['ps'] == 1) {
                                    $stmt_ps = $db->prepare("SELECT count(id) from thannam_champion_poomsae WHERE match1 = :match");
                                    $stmt_ps->execute([':match' => $match]);
                                    $NumPS = $stmt_ps->fetchColumn();
                                }

                                $stmt_kp = $db->prepare("SELECT count(id) from thannam_champion_kpa WHERE match1 = :match");
                                $stmt_kp->execute([':match' => $match]);
                                $NumKP = $stmt_kp->fetchColumn();

                                $stmt_kteam = $db->prepare("SELECT count(idteam2) from thannam_champion_manteam WHERE match1 = :match");
                                $stmt_kteam->execute([':match' => $match]);
                                $NumKTEAM = $stmt_kteam->fetchColumn();
                                $NumKTM = $NumKTEAM / 3;

                                $stmt_h = $db->prepare("SELECT count(id) from thannam_champion_hoshinsul WHERE match1 = :match");
                                $stmt_h->execute([':match' => $match]);
                                $NumH = $stmt_h->fetchColumn();

                                $stmt_form = $db->prepare("SELECT ps_cat, count(id) as cnt from thannam_champion_form WHERE match1 = :match AND ps_cat IN ('11', '12') GROUP BY ps_cat");
                                $stmt_form->execute([':match' => $match]);
                                $form_counts = $stmt_form->fetchAll(PDO::FETCH_KEY_PAIR);
                                $NumFH = isset($form_counts['11']) ? (int) $form_counts['11'] : 0;
                                $NumFW = isset($form_counts['12']) ? (int) $form_counts['12'] : 0;

                                $AllNUM = $NumA + $NumB + $NumC + $NumD + $NumE + $NumSP + $NumKP + $NumPS + $NumKTM + $NumVR
                                    + $NumH + $NumFH + $NumFW;
                                ?>

                                <br>



                                <div class="showCard">


                                    <?php if ($result['classa'] == 1) { ?>
                                        <div class="boxA">
                                            <span>CLASS A</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ7/kyorugi.php?match=<?= $match ?>&classA=A'"><?php echo $NumA; ?></button>
                                        </div>
                                    <?php } ?>

                                    <?php if ($result['classb'] == 1) { ?>
                                        <div class="boxA">
                                            <span>CLASS B</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ7/kyorugi.php?match=<?= $match ?>&classA=B'"><?php echo $NumB; ?></button>
                                        </div>
                                    <?php } ?>

                                    <?php if ($result['classc'] == 1) { ?>
                                        <div class="boxA">
                                            <span>CLASS C</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ7/kyorugi.php?match=<?= $match ?>&classA=C'"><?php echo $NumC; ?></button>
                                        </div>
                                    <?php } ?>

                                    <?php if ($result['classd'] == 1) { ?>
                                        <div class="boxA">
                                            <span>CLASS D</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ7/kyorugi.php?match=<?= $match ?>&classA=D'"><?php echo $NumD; ?></button>
                                        </div>
                                    <?php } ?>

                                    <?php if ($result['classe'] == 1) { ?>
                                        <div class="boxA">
                                            <span>CLASS E</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ7/kyorugi.php?match=<?= $match ?>&classA=E'"><?php echo $NumE; ?></button>
                                        </div>
                                    <?php } ?>

                                    <?php if ($result['ps'] == 1) { ?>
                                        <div class="boxA">
                                            <span>POOMSAE</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ7/poomsae.php?match=<?= $match ?>'"
                                                style="background-color: #09c3fb;"><?php echo $NumPS; ?></button>
                                        </div>
                                    <?php } ?>

                                    <!-- kpa2 -->
                                    <?php if ($result['speedK2'] == 1) { ?>
                                        <div class="boxA">
                                            <span>SPEED</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ7/speed.php?match=<?= $match ?>'"
                                                style="background-color: #dc59fc;"><?php echo $NumSP; ?></button>
                                        </div>
                                    <?php } ?>

                                    <!-- HAPKIDO -->
                                    <?php if ($result['hap'] == 1) { ?>
                                        <div class="boxA">
                                            <span>HOSHINSUL</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ/hoshinsul.php?match=<?= $match ?>'"
                                                style="background-color: #ff1a1a;"><?php echo $NumH; ?></button>
                                        </div>
                                        <div class="boxA">
                                            <span>F HAND</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ/form.php?match=<?= $match ?>'"
                                                style="background-color: #ff1a1a;"><?php echo $NumFH; ?></button>
                                        </div>
                                        <div class="boxA">
                                            <span>F WEAP</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ/form.php?match=<?= $match ?>'"
                                                style="background-color: #ff1a1a;"><?php echo $NumFW; ?></button>
                                        </div>
                                    <?php } ?>

                                    <!-- VR -->
                                    <?php if ($result['vrB'] == 1) { ?>
                                        <div class="boxA">
                                            <span>VR-TKD</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ/vr.php?match=<?= $match ?>'"
                                                style="background-color: #6964f2;"><?php echo $NumVR; ?></button>
                                        </div>
                                    <?php } ?>



                                    <?php if ($result['kteam2'] == 1) { ?>
                                        <div class="boxA">
                                            <span>K-TEAM</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ/kyoruki_team.php?match=<?= $match ?>'"
                                                style="background-color: #89e543;"><?php echo $NumKTM; ?></button>
                                        </div>
                                    <?php } ?>

                                    <?php if ($result['kpa2'] == 1) { ?>
                                        <div class="boxA">
                                            <span>KYUKPA</span>
                                            <button class="btnA"
                                                onclick="location.href='../../champ/kpa.php?match=<?= $match ?>'"
                                                style="background-color: #dc59fc;"><?php echo $NumKP; ?></button>
                                        </div>
                                    <?php } ?>

                                    <div class="boxA wid100">
                                        <span>TOTAL</span>
                                        <button class="btnA" style="background-color: #000;"><?php echo $AllNUM; ?></button>
                                    </div>


                                    <?php if ($result['documentA'] == 1) {
                                        ?>


                                        <div class="boxAA3 button">
                                            <a href="../../champ7/ground_show_non_test.php?match=<?= $match; ?>">
                                                LIVE! <br>Court
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ7/finaltotal-A.php?match=<?= $match; ?>">
                                                <span>BEST</span>
                                                <button class="btnA2">PLAYER</button>
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ7/special.php?match=<?= $match; ?>">
                                                <span>คู่</span>
                                                <button class="btnA2">พิเศษ</button>
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ7/ground.php?match=<?= $match; ?>">
                                                <span>คะแนนรวม</span>
                                                <button class="btnA2">Kyorugi</button>
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ7/ground_ps.php?match=<?= $match; ?>">
                                                <span>คะแนนรวม</span>
                                                <button class="btnA2">Poomsae</button>
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ7/ground_sp.php?match=<?= $match; ?>">
                                                <span>คะแนนรวม</span>
                                                <button class="btnA2">Speed</button>
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ7/medal_show.php?match=<?= $match; ?>">
                                                <span>ไม่ได้</span>
                                                <button class="btnA2">รับเหรียญ</button>
                                            </a>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if ($result['documentA'] == 1) {
                                        ?>

                                        <?php for ($x = 1; $x <= $result['downloadB']; $x++) { ?>
                                            <div class="boxAA4">
                                                <a href="../../champ7/bout_chart.php?match=<?= $match ?>&court=<?= $course[$x]; ?>">
                                                    สนาม <button class="btnB btnA"><?= $course[$x]; ?></button>
                                                </a>
                                            </div>
                                        <?php } ?>

                                        <div class="boxAA2">
                                            <a href="../../champ/download/<?= $match ?>/speed.pdf">
                                                <span>คู่สาย</span>
                                                <button class="btnA2" style="background-color: #dc59fc;">Speed</button>
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ/download/<?= $match ?>/poomsae.pdf">
                                                <span>คู่สาย</span>
                                                <button class="btnA2" style="background-color: #09c3fb;">Poomsae</button>
                                            </a>
                                        </div>

                                        <div class="boxAA2">
                                            <a href="../../champ/download/<?= $match ?>/kteam.pdf">
                                                <span>คู่สาย</span>
                                                <button class="btnA2" style="background-color:rgb(251, 9, 178);">K-TEAM</button>
                                            </a>
                                        </div>
                                    <?php } ?>





                                    <br>
                                </div>



                                <br><br>

                            <?php } ?>
                            <!-- ตารางสถานะ -->
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td width="26%">สถานที่จัดการแข่งขัน</td>
                                        <td width="74%"><?= $result['build']; ?>
                                            |
                                            <?= $result['city']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>แข่งขันวันที่</td>
                                        <td><?= $result['ddayA']; ?>/<?= $result['mmountA']; ?>/<?= $result['yyearA']; ?>
                                            <?php if ($result['ddayB'] <> 0) {
                                                echo '- ';
                                                echo $result['ddayB'];
                                                echo '/';
                                                echo $result['mmountA'];
                                                echo '/';
                                                echo $result['yyearB'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>กำหนดหมดเขต รับสมัคร </td>
                                        <td>
                                            <?= $result['finishDayA']; ?> 24:00 น.
                                            <div id="demo"></div>

                                        </td>
                                    </tr>
                                    <?php
                                    if (empty($tel)) {
                                    } else {
                                        ?>
                                        <tr>
                                            <td>เบอร์โทร</td>
                                            <td><?= $result['tel']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php
                                    if (empty($result['url'])) {
                                    } else {
                                        ?>
                                        <tr>
                                            <td>Url</td>
                                            <td><?= $result['url']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php

                                    if (empty($pic)) {
                                    } else {
                                        ?>
                                        <tr>
                                            <td>ใบสมัครเพื่อดาวน์โหลด<br>
                                                (โหลดไปแล้ว<span>
                                                    <?= $result['downloadA']; ?>
                                                    ครั้ง )</span></td>
                                            <td><a href="download.php?id=<?= $result['id']; ?>&amp;download=<?= $result['pic']; ?>"
                                                    class="punica-button black-button big-button"> ดาวน์โหลดเอกสาร </a></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>มีคนสนใจเปิดดูแล้ว</td>
                                        <td><?= $result['readA']; ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- end:entry-content -->




                        <div class="row">
                            <div class="col-md-12 col-sm-12 mb-20">
                                <div class="punica-tab-container-2">


                                    <?php
                                    $show_detail = !empty(trim($result['msg']));
                                    $show_medal = !empty($result['medalA']);
                                    $show_location = !empty($result['locationA']);
                                    $show_cer = !empty($result['cer_idcard']);

                                    $active_tab = "";
                                    if ($show_detail) {
                                        $active_tab = "home";
                                    } elseif ($show_medal) {
                                        $active_tab = "menu1";
                                    } elseif ($show_location) {
                                        $active_tab = "menu2";
                                    } elseif ($show_cer) {
                                        $active_tab = "menu3";
                                    }
                                    ?>

                                    <?php if ($show_detail || $show_medal || $show_location || $show_cer) { ?>
                                        <ul class="nav nav-tabs justify-content-center">
                                            <?php if ($show_detail) { ?>
                                                <li class="<?= $active_tab == 'home' ? 'active' : '' ?>"><a data-toggle="tab"
                                                        href="#home">Detail</a></li>
                                            <?php } ?>

                                            <?php if ($show_medal) { ?>
                                                <li class="<?= $active_tab == 'menu1' ? 'active' : '' ?>"><a data-toggle="tab"
                                                        href="#menu1">เหรียญรางวัล</a></li>
                                            <?php } ?>
                                            <?php if ($show_location) { ?>
                                                <li class="<?= $active_tab == 'menu2' ? 'active' : '' ?>"><a data-toggle="tab"
                                                        href="#menu2">Location</a></li>
                                            <?php } ?>
                                            <?php if ($show_cer) { ?>
                                                <li class="<?= $active_tab == 'menu3' ? 'active' : '' ?>"><a data-toggle="tab"
                                                        href="#menu3">ใบประกาศ ไอดีการ์ด</a></li>
                                            <?php } ?>
                                        </ul>

                                        <div class="tab-content">
                                            <?php if ($show_detail) { ?>
                                                <div id="home"
                                                    class="tab-pane fade <?= $active_tab == 'home' ? 'in active' : '' ?>">
                                                    <p>
                                                        <?= $result['msg']; ?>
                                                        <?php
                                                        if (!empty($result['medalA'])) {
                                                            echo '<h2>MEDAL</h2>';
                                                            echo $result['medalA'];
                                                        }
                                                        if (!empty($result['locationA'])) {
                                                            echo '<h2>LOCATION</h2>';
                                                            echo $result['locationA'];
                                                        }
                                                        if (!empty($result['cer_idcard'])) {
                                                            echo '<h2>CERTIFICATE - IDCARD</h2>';
                                                            echo $result['cer_idcard'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <?php if ($show_medal) { ?>
                                                <div id="menu1"
                                                    class="tab-pane fade <?= $active_tab == 'menu1' ? 'in active' : '' ?>">
                                                    <h3>Medal</h3>

                                                    <p>
                                                        <?php
                                                        if (!empty($result['medalA'])) {
                                                            echo $result['medalA'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <?php if ($show_location) { ?>
                                                <div id="menu2"
                                                    class="tab-pane fade <?= $active_tab == 'menu2' ? 'in active' : '' ?>">
                                                    <h3>LOCATION</h3>
                                                    <p>
                                                        <?php
                                                        if (!empty($result['locationA'])) {
                                                            echo $result['locationA'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            <?php } ?>

                                            <?php if ($show_cer) { ?>
                                                <div id="menu3"
                                                    class="tab-pane fade <?= $active_tab == 'menu3' ? 'in active' : '' ?>">
                                                    <h3>ใบประกาศ ไอดีการ์ด</h3>
                                                    <p>
                                                        <?php
                                                        if (!empty($result['cer_idcard'])) {
                                                            echo $result['cer_idcard'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>




                                </div>
                            </div>
                            <!-- row -->





                            <script>
                                // Set the date we're counting down to
                                var countDownDate = new Date("<?= $result['finishDayA'] ?> 24:00:00").getTime();

                                // Update the count down every 1 second
                                var x = setInterval(function () {

                                    // Get today's date and time
                                    var now = new Date().getTime();

                                    // Find the distance between now and the count down date
                                    var distance = countDownDate - now;

                                    // Time calculations for days, hours, minutes and seconds
                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                    // Output the result in an element with id="demo"
                                    document.getElementById("demo").innerHTML =
                                        "<div class='countdown-box'>" +
                                        "<div>" + days + "<small> วัน</small></div>" +
                                        "<div>" + hours + "<small> ชม.</small></div>" +
                                        "<div>" + minutes + "<small> นาที</small></div>" +
                                        "<div>" + seconds + "<small> วิ.</small></div>" +
                                        "</div>";

                                    // If the count down is over, write some text 
                                    if (distance < 0) {
                                        clearInterval(x);
                                        document.getElementById("demo").innerHTML = "<span>หมดเขตรับสมัคร</span>";
                                    }
                                }, 1000);
                            </script>









                            <div class="row mb-30">



                            </div>

                    </section>
                    <section id="comments">
                        <h3> Comments</h3>
                        <ol class="comments-list clearfix">
                            <li class="comment clearfix">
                                <article class="comment-wrap clearfix">
                                    <div class="comment-body clearfix">

                                        <div id="fb-root"></div>
                                        <script>
                                            (function (d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "//connect.facebook.net/th_TH/all.js#xfbml=1&appId=354580054607685";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));
                                        </script>
                                        <div class="fb-comments"
                                            data-href="http://www.thannam.net/2016/match/views.php?id=<?= $_GET['id'] ?>"
                                            data-numposts="20" data-colorscheme="light"></div>

                                    </div>
                                    <!--comment-body -->
                                </article>
                            </li>
                        </ol>
                        <!--comments-list-->

                        <!-- pagination -->

                        <div class="clear"></div>
                    </section>
                    <!-- end:comments -->

                </div>
                <!-- end:widget-area-2 -->

                <div class="widget-area-3 sidebar pull-left">

















                    <div class="widget punica-nothumb-widget clearfix">

                        <h4 class="widget-title">Tournament<span>Of the <?= date("F"); ?></span></h4>

                        <ul class="clearfix">
                            <?php
                            $ddm = date("m");
                            $sql = $db->prepare("SELECT * from thannam_match  where mmountA = :ddm  and  showA = '0' order by ddayA  asc");
                            $sql->execute(['ddm' => $ddm]);
                            $numm = $sql->rowCount();
                            while ($row_sidebar = $sql->fetch()) {
                                ?>
                                <li class="top-item">
                                    <article class="entry-item clearfix">
                                        <div class="entry-number pull-left"><?= $row_sidebar['ddayA'] ?></div>
                                        <div class="entry-content">
                                            <h6 class="entry-title"><a
                                                    href="views.php?id=<?= $row_sidebar['id'] ?>"><?= $row_sidebar['nameA'] ?></a>
                                            </h6>
                                        </div>
                                        <!-- end:entry-content -->
                                    </article>
                                    <!-- end:entry-item -->
                                </li>
                            <?php } ?>


                        </ul>

                        <a href="../match.php" class="load-more">More Tournament &raquo;</a>

                    </div>


                    <?php if ($numm < 2) { ?>
                        <div class="widget punica-nothumb-widget clearfix">
                            <h4 class="widget-title">Tournament<span> Next Month

                                </span></h4>
                            <ul class="clearfix">
                                <?php
                                $ddm = date('m', strtotime('first day of +1 month'));
                                $sql1 = $db->prepare("SELECT * from thannam_match  where mmountA = :ddm  and  showA = '0' order by ddayA  asc");
                                $sql1->execute(['ddm' => $ddm]);
                                while ($result1 = $sql1->fetch()) {
                                    ?>
                                    <li class="top-item">
                                        <article class="entry-item clearfix">
                                            <div class="entry-number pull-left">
                                                <?= $result1['ddayA'] ?>
                                            </div>
                                            <div class="entry-content">
                                                <h6 class="entry-title"><a href="views.php?id=<?= $result1['id'] ?>">
                                                        <?= $result1['nameA'] ?>
                                                    </a></h6><?= $result1['city'] ?>
                                            </div>
                                            <!-- end:entry-content -->
                                        </article>
                                        <!-- end:entry-item -->
                                    </li>
                                <?php } ?>
                            </ul>
                            <a href="index.php" class="load-more">More Tournament &raquo;</a>
                        </div>
                    <?php } ?>














                </div>
                <!-- end:widget-area-3 -->








                <div class="clear"></div>
            </div>
            <!-- end:punica-carousel-list-2-widget -->

        </div>
        <!-- end:wrapper -->
        <!-- end:wrapper -->

    </div>
    <!-- end:main-content -->

    <?php include "../footer_in.php"; ?>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <!-- <script src="../js/bootstrap.min.js"></script> -->
    <script src="../js/custom.js" charset="utf-8"></script>
    <script src="modal.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $('#myModal').modal(options)
    </script>

</body>

</html>