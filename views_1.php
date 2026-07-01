<?php
session_start();
require_once("../app/conn_pdo.php");

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$updateA = $_GET['updateA'];


$result_select = $db->prepare("SELECT * from thannam_match  where id='$_GET[id]' ");
$result_select->execute();
$result = $result_select->fetch();

$update_match  =  $db->prepare("update thannam_match set readA=readA+1  where id='$_GET[id]'");
$update_match->execute();



$id = $result['id'];
$msg = $result['msg'];
$tel = $result['tel'];
$pic = $result['pic'];
$email = $result['email'];

$user =  $_POST['user'];
$pwd = $_POST['pwd'];
if ($user <> "" and  $pwd <> "") {



    $sql = $db->prepare("SELECT * from  thannam_match where  id='$user'  and  pass='$pwd'");
    $sql->execute();
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

$banner_select = $db->prepare("SELECT * from th_news  where ip='$id' ");
$banner_select->execute();
$banner = $banner_select->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>
        <?= $result['nameA'] ?>
        : ธารน้ำเทควันโด</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property=”og:image” content=”https://www.thannam.net/2016/banner/<?= $banner['pic'] ?>” />


    <link rel="stylesheet" href="../css/bootstrap.css" media="all" />
    <link rel="stylesheet" href="../css/font-awesome.css" media="all" />
    <link rel="stylesheet" href="../css/superfish.css" media="all" />
    <link rel="stylesheet" href="../css/owl.carousel.css" media="all" />
    <link rel="stylesheet" href="../css/owl.theme.css" media="all" />
    <link rel="stylesheet" href="../css/jquery.navgoco.css" />
    <link rel="stylesheet" href="../css/flexslider.css" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/responsive.css" />
    <script src="../js/modernizr.custom.js"></script>

    <!--[if lt IE 9]>
            <link rel="stylesheet" href="css/ie.css" type="text/css" media="all" />
        <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../img/apple-touch-icon-114x114.png">

    <style>
        .chA2 {

            padding: 20px;
            font-size: 30px;
            background-color: red;
            text-align: center;
            color: yellow;


        }
    </style>
</head>

<body class="punica-home-1">
    <?php include "../head_in-pdo.php"; ?>
    <div id="main-content">

        <!-- home-slider-box -->

        <div class="widget-area-1 clearfix">
            <div class="wrapper punica-shadow-box">
                <div class="widget-area-2 pull-left">
                    <div class="breadcrumb clearfix"> <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
                            <a href="../index.php" itemprop="url"> <span itemprop="title">Home</span> </a> </span> <span>&nbsp;/&nbsp;</span> <span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" class="prev-page">
                            <a href="../match.php" itemprop="url"> <span itemprop="title">TOURNAMENT</span> </a> </span> /
                        <?= $result['nameA'] ?>
                    </div>
                    <!-- breadcrumb -->
                    <?php if ($banner['pic'] <> '') { ?><img src="../banner/<?= $banner['pic'] ?>"><br><br><?php } ?>


                    <div class="row">
                        <div class="col-md-3 col-sm-3 mb-20">
                            <div class="card " style="width: 18rem; margin: 20px;">
                                <h5 class="card-header bg-danger text-white border-0">bootstrap</h5>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-success">Card component</h6>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, placeat.
                                    </p>
                                </div>
                                <div class="card-footer text-end border-0">
                                    <button class="btn btn-sm btn-primary me-2">button 1</button>
                                    <button class="btn btn-sm btn-info">button 2</button>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 mb-20">
                            <div class="card " style="width: 18rem; margin: 20px;">
                                <h5 class="card-header bg-danger text-white border-0">bootstrap</h5>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-success">Card component</h6>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, placeat.
                                    </p>
                                </div>
                                <div class="card-footer text-end border-0">
                                    <button class="btn btn-sm btn-primary me-2">button 1</button>
                                    <button class="btn btn-sm btn-info">button 2</button>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 mb-20">
                            <div class="card " style="width: 18rem; margin: 20px;">
                                <h5 class="card-header bg-danger text-white border-0">bootstrap</h5>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-success">Card component</h6>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, placeat.
                                    </p>
                                </div>
                                <div class="card-footer text-end border-0">
                                    <button class="btn btn-sm btn-primary me-2">button 1</button>
                                    <button class="btn btn-sm btn-info">button 2</button>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 mb-20">
                            <div class="card " style="width: 18rem; margin: 20px;">
                                <h5 class="card-header bg-danger text-white border-0">bootstrap</h5>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-success">Card component</h6>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, placeat.
                                    </p>
                                </div>
                                <div class="card-footer text-end border-0">
                                    <button class="btn btn-sm btn-primary me-2">button 1</button>
                                    <button class="btn btn-sm btn-info">button 2</button>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 mb-20">
                            <div class="card " style="width: 18rem; margin: 20px;">
                                <h5 class="card-header bg-danger text-white border-0">bootstrap</h5>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-success">Card component</h6>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, placeat.
                                    </p>
                                </div>
                                <div class="card-footer text-end border-0">
                                    <button class="btn btn-sm btn-primary me-2">button 1</button>
                                    <button class="btn btn-sm btn-info">button 2</button>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 mb-20">
                            <div class="card " style="width: 18rem; margin: 20px;">
                                <h5 class="card-header bg-danger text-white border-0">bootstrap</h5>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-success">Card component</h6>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, placeat.
                                    </p>
                                </div>
                                <div class="card-footer text-end border-0">
                                    <button class="btn btn-sm btn-primary me-2">button 1</button>
                                    <button class="btn btn-sm btn-info">button 2</button>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 mb-20">
                            <div class="card " style="width: 18rem; margin: 20px;">
                                <h5 class="card-header bg-danger text-white border-0">bootstrap</h5>
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-3 text-success">Card component</h6>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, placeat.
                                    </p>
                                </div>
                                <div class="card-footer text-end border-0">
                                    <button class="btn btn-sm btn-primary me-2">button 1</button>
                                    <button class="btn btn-sm btn-info">button 2</button>

                                </div>
                            </div>
                        </div>

                    </div>





                    <?php if ($result['documentA'] == 1) { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="10">
                            <tr>
                                <td bgcolor="#666666">

                                    <?php
                                    $course = array("", "A", "B",  "C",  "D",  "E",  "F",  "G",  "H",  "I",  "J", "K",  "L",  "M", "N");
                                    ?>

                                    <table border="0" align="center" cellpadding="20" cellspacing="1" class=" table-bordered">
                                        <tr>
                                            <td align="center" bgcolor="#FF9900"><strong><a href="../../champ/ground_show_non_test.php?match=<?= $id; ?>">Live! Court</a></strong></td>
                                            <td align="center" bgcolor="#FF9900"><strong><a href="../../champ/ground.php?match=<?= $id; ?>" style="color:#000">คะแนนรวม</a></strong></td>
                                            <td align="center" bgcolor="#FF9900"><strong><a href="../../champ/finaltotal-A.php?match=<?= $id; ?>" style="color:#000">นักกีฬายอดเยี่ยม</a></strong></td>
                                            <?php for ($x = 1; $x <= $result['downloadB']; $x++) { ?>
                                                <td align="center"><strong><a href="../../champNav2/bout_chart.php?match=<?= $id ?>&court=<?= $course[$x]; ?>" style="color:#FF0">สนาม <?= $course[$x]; ?></a></strong></td>
                                            <?php } ?>
                                            <td align="center" bgcolor="#FFFF00"><strong><a href="../../champ/poomsae_w.php?match=<?= $id ?>"> POOMSAE</a></strong></td>
                                            <!-- <td align="center" bgcolor="#FFFF00"><strong><a href="../../champ/download/<?= $id ?>/non.pdf"> ไม่มีคู่เตะ</a></strong></td> -->
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>

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
                                                <div class="fb-like" data-href="http://www.thannam.net/2016/match/views.php?id=<?= $_GET['id'] ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                            </td>
                                            <td align="right"><?php if (empty($updateA)) { ?>
                                                    <table border="0" cellpadding="2" cellspacing="0" class="table table-striped">
                                                        <tr>
                                                            <td align="right"><a href="?id=<?= $result['id']; ?>&updateA=yes" class="punica-button red-button medium-button"> แก้ไขแมทการแข่งขันที่นี่ครับ </a></td>
                                                        </tr>
                                                    </table>
                                                <?php } else { ?>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="table table-striped">
                                                        <form method="post" action="views.php?id=<?= $result['id']; ?>&updateA=yes">
                                                            <tr>
                                                                <td align="right" class="style3"><strong> Password
                                                                        <?= $err; ?>
                                                                    </strong>&nbsp;
                                                                    <input name="user" type="hidden" value="<?= $_GET['id']; ?>"> <input type="password" name="pwd">
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









                            <p>
                                <?php if ($result['regonline'] == '1') { ?>
                                    <a href="http://www.thannam.net/champ/allteam.php?match=<?= $id ?>" target="_blank"><img src="regisonline.gif" border="0" /></a>

                                    <?php if ($result['ju'] <> '0') { ?>
                                        <a href="http://www.thannam.net/ju2/allteam.php?match=<?= $result['ju'] ?>" target="_blank"><img src="regisonline2_01.gif" border="0" /></a>
                                        <a href="http://www.thannam.net/ju/views.php?id=<?= $result['ju'] ?>" target="_blank"><img src="regisonline2_02.gif" border="0" /></a>
                                    <?php } ?>

                                    <?php if ($result['mma'] <> '0') { ?>
                                        <a href="http://www.thannam.net/hapkido2/allteam.php?match=<?= $result['mma'] ?>" target="_blank"><img src="hapkido.jpg" border="0" /></a>
                                        <a href="http://www.thannam.net/hapkido/views.php?id=<?= $result['mma'] ?>" target="_blank"><img src="regisonline2_02.gif" border="0" /></a>
                                    <?php } ?>

                                <?php } ?>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td width="26%">สถานที่จัดการแข่งขัน</td>
                                        <td width="74%"><?= $result['build']; ?>
                                            |
                                            <?= $result['city']; ?></td>
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
                                        <td><?= $result['finishDayA']; ?></td>
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
                                            <td><a href="download.php?id=<?= $result['id']; ?>&amp;download=<?= $result['pic']; ?>" class="punica-button black-button big-button"> ดาวน์โหลดเอกสาร </a></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>มีคนสนใจเปิดดูแล้ว</td>
                                        <td><?= $result['readA']; ?></td>
                                    </tr>
                                    <?php
                                    if (empty($result['msg'])) {
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="2">
                                                <?= $result['msg']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </p>
                        </div>
                        <!-- end:entry-content -->

                        <div class="row mb-30">



                        </div>

                    </section>
                    <section id="comments">
                        <h3> Comments</h3>
                        <ol class="comments-list clearfix">
                            <li class="comment clearfix">
                                <article class="comment-wrap clearfix">
                                    <div class="comment-body clearfix">
                                        <p>

                                        <div id="fb-root"></div>
                                        <script>
                                            (function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "//connect.facebook.net/th_TH/all.js#xfbml=1&appId=354580054607685";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));
                                        </script>
                                        <div class="fb-comments" data-href="http://www.thannam.net/2016/match/views.php?id=<?= $_GET['id'] ?>" data-numposts="20" data-colorscheme="light"></div>


                                        </p>
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
                            $sql = $db->prepare("SELECT * from thannam_match  where mmountA='$ddm'  and  showA='0' order by ddayA  asc");
                            $sql->execute();
                            $numm = $sql->rowCount();
                            while ($result = $sql->fetch()) {
                            ?>
                                <li class="top-item">
                                    <article class="entry-item clearfix">
                                        <div class="entry-number pull-left"><?= $result['ddayA'] ?></div>
                                        <div class="entry-content">
                                            <h6 class="entry-title"><a href="views.php?id=<?= $result['id'] ?>"><?= $result['nameA'] ?></a></h6>
                                        </div>
                                        <!-- end:entry-content -->
                                    </article>
                                    <!-- end:entry-item -->
                                </li>
                            <?php } ?>


                        </ul>

                        <a href="match/index.php" class="load-more">More Tournament &raquo;</a>

                    </div>


                    <?php if ($numm < 2) { ?>
                        <div class="widget punica-nothumb-widget clearfix">
                            <h4 class="widget-title">Tournament<span> Next Month

                                </span></h4>
                            <ul class="clearfix">
                                <?php
                                $ddm = date("m") + 1;
                                $sql1 = $db->prepare("SELECT * from thannam_match  where mmountA='$ddm'  and  showA='0' order by ddayA  asc");
                                $sql1->execute();
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
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/custom.js" charset="utf-8"></script>
    <script src="modal.js"></script>
    <script>
        $('#myModal').modal(options)
    </script>
</body>

</html>