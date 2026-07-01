<?php
session_start();
require_once("app/conn_pdo.php");

// Clean GET parameters safely without dangerous extract()
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

$nameA = isset($_POST['nameA']) ? trim($_POST['nameA']) : "";

if ($nameA === "") {
    die("คุณยังไม่ได้เขียนหัวข้อเลย! <a href='addnew.php' class='btn btn-sm btn-outline-danger mt-2'>กลับไปกรอกใหม่</a>");
}

if (!isset($_POST['simage'])) {
    die("\n<br><h3><span style='color:#ff0000;'>For Internal Use only</span></h3>");
}

$word = trim($_POST['simage']);
$sWord = isset($_SESSION['secWord']) ? $_SESSION['secWord'] : "";

if ($sWord === "") {
    die("\n<br><h3><span style='color:#ff0000;'>Session Already Expired..</span></h3>");
}

if ($word === $sWord) {
    $toPrint = "บันทึกข้อมูลเรียบร้อย (Passed)";
    $color = "#198754"; // Success Green
    $alertClass = "alert-success";
    $success = true;
    
    $topic_run = date("jmYHis");
    $picSql = '';

    // Handle file upload securely
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== "") {
        $numrand = mt_rand();
        $upload = $_FILES['file']['name'];

        if ($upload !== '') {
            $typefile = strrchr($_FILES['file']['name'], ".");
            $allowed_exts = ['.doc', '.docx', '.pdf'];
            
            if (in_array(strtolower($typefile), $allowed_exts)) {
                $path = "../pic_macth/";
                $filename = $topic_run . $typefile;
                $filefolder = $path . $filename;
                $pictemp = $_FILES['file']['tmp_name'];
                
                if (move_uploaded_file($pictemp, $filefolder)) {
                    @chmod($filefolder, 0777);
                    $picSql = $filename;
                }
            }
        }
    }

    // Parse match_date (YYYY-MM-DD)
    $match_date = isset($_POST['match_date']) ? $_POST['match_date'] : '';
    $ddayA = '0';
    $mmountA = '0';
    $yyearA = '0';
    if ($match_date !== '') {
        $parts = explode('-', $match_date);
        if (count($parts) === 3) {
            $ddayA = sprintf("%02d", (int)$parts[2]);
            $mmountA = sprintf("%02d", (int)$parts[1]);
            $yyearA = (string)((int)$parts[0] + 543);
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

    $build = isset($_POST['build']) ? trim($_POST['build']) : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $timeA = isset($_POST['timeA']) ? $_POST['timeA'] : '1';
    $msg = isset($_POST['msg']) ? $_POST['msg'] : '';
    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';
    $addr = isset($_POST['addr']) ? $_POST['addr'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    $dateA = date("Y-m-d H:i:s");

    // Secure database insert using bound parameters
    $insertA = $db->prepare("INSERT INTO thannam_match  
        (nameA, build, city, ddayA, mmountA, yyearA, timeA, finishDayA, addr, tel, email, url, msg, pic, pass, readA, downloadA, dateA, showA, ip, sponsorA, regonline, dstart2, mma)  
        VALUES
        (:nameA, :build, :city, :ddayA, :mmountA, :yyearA, :timeA, :finishDayA, :addr, :tel, :email, :url, :msg, :pic, :pass, 0, 0, :dateA, 0, :ip, 0, 0, :dstart2, 0)");
    
    $insertA->execute([
        ':nameA' => $nameA,
        ':build' => $build,
        ':city' => $city,
        ':ddayA' => $ddayA,
        ':mmountA' => $mmountA,
        ':yyearA' => $yyearA,
        ':timeA' => $timeA,
        ':finishDayA' => $finishDayAA,
        ':addr' => $addr,
        ':tel' => $tel,
        ':email' => $email,
        ':url' => $url,
        ':msg' => $msg,
        ':pic' => $picSql,
        ':pass' => $pass,
        ':dateA' => $dateA,
        ':ip' => $ip,
        ':dstart2' => $finishDayAA2
    ]);

} else {
    $toPrint = "รหัสความปลอดภัยไม่ถูกต้อง (Verification Failed!)";
    $color = "#dc3545"; // Bootstrap Danger Red
    $alertClass = "alert-danger";
    $success = false;
}

$_SESSION['secWord'] = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tournament Registration Status</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="modern_style.css">
  <?php if ($success): ?>
    <meta http-equiv="refresh" content="2;url=../index.php">
  <?php endif; ?>
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm border-0 rounded-4 p-4 text-center">
        <div class="mb-4">
          <?php if ($success): ?>
            <i class="fas fa-check-circle text-success fa-4x animate-bounce"></i>
          <?php else: ?>
            <i class="fas fa-times-circle text-danger fa-4x"></i>
          <?php endif; ?>
        </div>
        <h4 class="fw-bold mb-3" style="color: <?php echo $color; ?>;"><?php echo $toPrint; ?></h4>
        <p class="text-secondary mb-4">
          <?php if ($success): ?>
            ระบบกำลังนำท่านกลับไปยังหน้าหลัก กรุณารอสักครู่...
          <?php else: ?>
            กรุณากลับไปตรวจสอบรหัสยืนยันตัวตนอีกครั้ง
          <?php endif; ?>
        </p>
        <div>
          <?php if ($success): ?>
            <a href="../index.php" class="btn btn-primary px-4 rounded-3">ไปยังหน้าหลักทันที</a>
          <?php else: ?>
            <a href="javascript:history.back()" class="btn btn-danger px-4 rounded-3">ย้อนกลับ</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>