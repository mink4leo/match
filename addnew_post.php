<?php
session_start();
ob_start();
require_once("app/conn_pdo.php");

if (!isset($_POST['id'])) {
    die("Invalid request.");
}

$id = (int) $_POST['id'];
$nameA = isset($_POST['nameA']) ? trim($_POST['nameA']) : '';

if ($nameA === '') {
    echo "<script language='javascript'> alert('PLEASE CHECK MATCH NAME'); window.location='view-edit.php'</script>";
    exit();
}

$changA = isset($_POST['changA']) ? (int) $_POST['changA'] : 0;

// Parse match_date_start (YYYY-MM-DD)
$match_date_start = isset($_POST['match_date_start']) ? $_POST['match_date_start'] : '';
$ddayA = '0';
$mmountA = '0';
$yyearA = '0';
if ($match_date_start !== '') {
    $parts = explode('-', $match_date_start);
    if (count($parts) === 3) {
        $ddayA = sprintf("%02d", (int)$parts[2]);
        $mmountA = sprintf("%02d", (int)$parts[1]);
        $yyearA = (string)((int)$parts[0] + 543);
    }
}

// Parse match_date_end (YYYY-MM-DD)
$match_date_end = isset($_POST['match_date_end']) ? $_POST['match_date_end'] : '';
$ddayB = '0';
$mmountB = '0';
$yyearB = '0';
if ($match_date_end !== '') {
    $parts = explode('-', $match_date_end);
    if (count($parts) === 3) {
        $ddayB = sprintf("%02d", (int)$parts[2]);
        $mmountB = sprintf("%02d", (int)$parts[1]);
        $yyearB = (string)((int)$parts[0] + 543);
    }
}

// Parse deadline_date (YYYY-MM-DD)
$deadline_date = isset($_POST['deadline_date']) ? $_POST['deadline_date'] : '';
$Fday = '0';
$Fmounth = '0';
$Fyear = '0';
if ($deadline_date !== '') {
    $parts = explode('-', $deadline_date);
    if (count($parts) === 3) {
        $Fday = sprintf("%02d", (int)$parts[2]);
        $Fmounth = sprintf("%02d", (int)$parts[1]);
        $Fyear = (string)((int)$parts[0] + 543);
    }
}

$finishDayAA = $Fmounth . "/" . $Fday . "/" . $Fyear;
$finishDayAA2 = $ddayA . "/" . $mmountA . "/" . $yyearA;
$timeA = isset($_POST['timeA']) ? $_POST['timeA'] : '1';
$build = isset($_POST['build']) ? trim($_POST['build']) : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';

$msg = isset($_POST['msg']) ? $_POST['msg'] : '';
$tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$url = isset($_POST['url']) ? trim($_POST['url']) : '';
$addr = isset($_POST['addr']) ? $_POST['addr'] : '';

$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
$dateA = date("Y-m-d H:i:s");
$topic_run = date("jmYHis");

$pic = null;
$picsql = "";

// Handle file upload securely
if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== "") {
    $picname = $_FILES['file']['name'];
    $pictemp = $_FILES['file']['tmp_name'];
    $ext = strtolower(substr($picname, strrpos($picname, ".")));
    $allowed_exts = ['.doc', '.docx', '.pdf'];

    if (in_array($ext, $allowed_exts)) {
        $filename = $topic_run . $ext;
        $filefolder = "../pic_macth/" . $filename;
        
        if (move_uploaded_file($pictemp, $filefolder)) {
            @chmod($filefolder, 0777);

            // Fetch and delete the old file
            $arrq_select = $db->prepare("SELECT pic FROM thannam_match WHERE id = :id");
            $arrq_select->execute([':id' => $id]);
            $arrq = $arrq_select->fetch();

            if ($arrq && !empty($arrq['pic'])) {
                $oldlink1 = "../pic_macth/" . $arrq['pic'];
                if (file_exists($oldlink1)) {
                    @unlink($oldlink1);
                }
            }
            $pic = $filename;
        }
    }
}

// Build SQL update dynamically
$sql = "UPDATE thannam_match SET
          nameA = :nameA,
          finishDayA = :finishDayA,
          build = :build,
          city = :city,
          timeA = :timeA,
          ddayA = :ddayA,
          mmountA = :mmountA,
          yyearA = :yyearA,
          ddayB = :ddayB,
          mmountB = :mmountB,
          yyearB = :yyearB,
          addr = :addr,
          tel = :tel,
          email = :email,
          url = :url,
          pass = :pass,
          dateupdate = :dateupdate,
          changA = :changA,
          msg = :msg";

$params = [
    ':nameA' => $nameA,
    ':finishDayA' => $finishDayAA,
    ':build' => $build,
    ':city' => $city,
    ':timeA' => $timeA,
    ':ddayA' => $ddayA,
    ':mmountA' => $mmountA,
    ':yyearA' => $yyearA,
    ':ddayB' => $ddayB,
    ':mmountB' => $mmountB,
    ':yyearB' => $yyearB,
    ':addr' => $addr,
    ':tel' => $tel,
    ':email' => $email,
    ':url' => $url,
    ':pass' => $pass,
    ':dateupdate' => $dateA,
    ':changA' => $changA,
    ':msg' => $msg,
    ':id' => $id
];

if ($pic !== null) {
    $sql .= ", pic = :pic";
    $params[':pic'] = $pic;
}

$sql .= " WHERE id = :id";

$updateA = $db->prepare($sql);
$updateA->execute($params);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tournament Update Status</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="modern_style.css">
  <meta http-equiv="refresh" content="1.5;url=view-edit.php">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm border-0 rounded-4 p-4 text-center">
        <div class="mb-4">
          <i class="fas fa-check-circle text-success fa-4x animate-bounce"></i>
        </div>
        <h4 class="fw-bold mb-3 text-success">แก้ไขข้อมูลเรียบร้อยแล้ว</h4>
        <p class="text-secondary mb-4">
          กำลังนำคุณกลับไปหน้ารายละเอียดการแก้ไขข้อมูล...
        </p>
        <div>
          <a href="view-edit.php" class="btn btn-primary px-4 rounded-3">กลับหน้าแก้ไขทันที</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
