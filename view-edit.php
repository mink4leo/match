<?php
session_start();
ob_start();
require_once("app/conn_pdo.php");

if (!isset($_SESSION['idmatch']) || $_SESSION['idmatch'] == "") {
  header("Location: ../match");
  exit();
}

$updateA = isset($_GET['updateA']) ? $_GET['updateA'] : '';

// Parameterized query to fetch match details safely
$rs_select = $db->prepare("SELECT * FROM thannam_match WHERE id = :id");
$rs_select->execute([':id' => $_SESSION['idmatch']]);
$rs = $rs_select->fetch();

if (!$rs) {
  die("Match not found.");
}

// Convert dates from database format (Buddhist Year) to YYYY-MM-DD for standard browser input type="date"
$match_date_start_val = "";
if (!empty($rs['yyearA']) && !empty($rs['mmountA']) && !empty($rs['ddayA'])) {
    $ad_year = (int)$rs['yyearA'] - 543;
    $match_date_start_val = sprintf("%04d-%02d-%02d", $ad_year, (int)$rs['mmountA'], (int)$rs['ddayA']);
}

$match_date_end_val = "";
if (!empty($rs['yyearB']) && !empty($rs['mmountB']) && !empty($rs['ddayB'])) {
    $ad_year_b = (int)$rs['yyearB'] - 543;
    $match_date_end_val = sprintf("%04d-%02d-%02d", $ad_year_b, (int)$rs['mmountB'], (int)$rs['ddayB']);
}

$deadline_date_val = "";
if (!empty($rs['finishDayA'])) {
    $parts = explode("/", $rs['finishDayA']);
    if (count($parts) === 3) {
        $m = (int)$parts[0];
        $d = (int)$parts[1];
        $y = (int)$parts[2] - 543;
        $deadline_date_val = sprintf("%04d-%02d-%02d", $y, $m, $d);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EDIT MATCH TOURNAMENT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="modern_style.css">
  <link href="../style.css" rel="stylesheet" type="text/css">
  <style>
    .ck-editor__editable {
      min-height: 350px !important;
    }
  </style>
</head>
<body>

<div class="container py-4">
  <div class="form-container">
    <div class="card shadow-sm border-0 rounded-4">
      <div class="card-header bg-primary text-white py-3 rounded-top-4">
        <h4 class="mb-0 text-center text-white"><i class="fas fa-edit me-2"></i>แก้ไขรายละเอียดแมทการแข่งขัน (Edit Tournament Details)</h4>
      </div>

      <div class="card-body p-4">
        <!-- Clean warning alert -->
        <div class="alert alert-warning border-0 shadow-sm rounded-3 mb-4" role="alert">
          <div class="d-flex">
            <div class="me-3 mt-1">
              <i class="fas fa-info-circle fa-2x text-warning"></i>
            </div>
            <div>
              <h5 class="alert-heading text-warning-emphasis fw-bold mb-2">คำชี้แจงในการแก้ไขข้อมูล</h5>
              <p class="mb-1 text-dark" style="font-size: 14.5px;">
                กรุณาแก้ไขรายละเอียดแมทการแข่งขันของท่านให้ถูกต้องและครบถ้วน เพื่อไม่ให้ผู้อ่านสับสน และเหมาะสมในการค้นหาแมทแข่ง
              </p>
              <p class="mb-0 text-secondary" style="font-size: 13px;">
                แก้ไขล่าสุดเมื่อ: <?= htmlspecialchars($rs['dateupdate'] ?? $rs['dateA'] ?? '', ENT_QUOTES, 'UTF-8') ?>
              </p>
            </div>
          </div>
        </div>

        <form method="post" enctype="multipart/form-data" action="addnew_post.php" name="DD">
          <div class="row g-3">

            <!-- Match Name -->
            <div class="col-12">
              <label for="nameA" class="form-label fw-semibold text-secondary"><i class="fas fa-heading me-1 text-primary"></i> ชื่อแมทการแข่งขัน <span class="text-danger">*</span></label>
              <input name="nameA" id="nameA" type="text" class="form-control" value="<?= htmlspecialchars($rs['nameA'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
              <input name="id" type="hidden" id="id" value="<?= htmlspecialchars($rs['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>" />
            </div>

            <!-- Location & City -->
            <div class="col-md-8">
              <label for="build" class="form-label fw-semibold text-secondary"><i class="fas fa-map-marker-alt me-1 text-primary"></i> สถานที่จัดการแข่งขัน <span class="text-danger">*</span></label>
              <input name="build" id="build" type="text" class="form-control" value="<?= htmlspecialchars($rs['build'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="col-md-4">
              <label for="city" class="form-label fw-semibold text-secondary"><i class="fas fa-city me-1 text-primary"></i> จังหวัด <span class="text-danger">*</span></label>
              <select name="city" id="city" class="form-select" required>
                <option value="<?= htmlspecialchars($rs['city'] ?? '', ENT_QUOTES, 'UTF-8') ?>" selected="selected"><?= htmlspecialchars($rs['city'] ?? '', ENT_QUOTES, 'UTF-8') ?></option>
                <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                <option value="กาญจนบุรี">กาญจนบุรี</option>
                <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                <option value="กำแพงเพชร">กำแพงเพชร</option>
                <option value="กระบี่">กระบี่</option>
                <option value="ขอนแก่น">ขอนแก่น</option>
                <option value="จันทบุรี">จันทบุรี</option>
                <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                <option value="ชลบุรี">ชลบุรี</option>
                <option value="ชัยนาท">ชัยนาท</option>
                <option value="ชัยภูมิ">ชัยภูมิ</option>
                <option value="ชุมพร">ชุมพร</option>
                <option value="เชียงราย">เชียงราย</option>
                <option value="เชียงใหม่">เชียงใหม่</option>
                <option value="ตรัง">ตรัง</option>
                <option value="ตราด">ตราด</option>
                <option value="ตาก">ตาก</option>
                <option value="นครนายก">นครนายก</option>
                <option value="นครปฐม">นครปฐม</option>
                <option value="นครพนม">นครพนม</option>
                <option value="นครราชสีมา">นครราชสีมา</option>
                <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                <option value="นครสวรรค์">นครสวรรค์</option>
                <option value="นนทบุรี">นนทบุรี</option>
                <option value="นราธิวาส">นราธิวาส</option>
                <option value="น่าน">น่าน</option>
                <option value="บุรีรัมย์">บุรีรัมย์</option>
                <option value="ปทุมธานี">ปทุมธานี</option>
                <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                <option value="ปัตตานี">ปัตตานี</option>
                <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                <option value="พังงา">พังงา</option>
                <option value="พัทลุง">พัทลุง</option>
                <option value="พิจิตร">พิจิตร</option>
                <option value="พิษณุโลก">พิษณุโลก</option>
                <option value="เพชรบุรี">เพชรบุรี</option>
                <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                <option value="แพร่">แพร่</option>
                <option value="ภูเก็ต">ภูเก็ต</option>
                <option value="มหาสารคาม">มหาสารคาม</option>
                <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                <option value="ยโสธร">ยโสธร</option>
                <option value="ยะลา">ยะลา</option>
                <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                <option value="ระนอง">ระนอง</option>
                <option value="ระยอง">ระยอง</option>
                <option value="ราชบุรี">ราชบุรี</option>
                <option value="ลพบุรี">ลพบุรี</option>
                <option value="ลำปาง">ลำปาง</option>
                <option value="ลำพูน">ลำพูน</option>
                <option value="เลย">เลย</option>
                <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                <option value="สกลนคร">สกลนคร</option>
                <option value="สงขลา">สงขลา</option>
                <option value="สตูล">สตูล</option>
                <option value="สมุทรปราการ">สมุทรปราการ</option>
                <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                <option value="สมุทรสาคร">สมุทรสาคร</option>
                <option value="สระบุรี">สระบุรี</option>
                <option value="สิงห์บุรี">สิงห์บุรี</option>
                <option value="สุโขทัย">สุโขทัย</option>
                <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                <option value="สุรินทร์">สุรินทร์</option>
                <option value="หนองคาย">หนองคาย</option>
                <option value="อ่างทอง">อ่างทอง</option>
                <option value="อุดรธานี">อุดรธานี</option>
                <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                <option value="อุทัยธานี">อุทัยธานี</option>
                <option value="อุบลราชธานี">อุบลราชธานี</option>
                <option value="นครปฐม-สามพราน">นครปฐม-สามพราน</option>
                <option value="หาดใหญ่">หาดใหญ่</option>
                <option value="พะเยา">พะเยา</option>
                <option value="มุกดาหาร">มุกดาหาร</option>
                <option value="ต่างประเทศ">ต่างประเทศ</option>
                <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                <option value="สระแก้ว">สระแก้ว</option>
                <option value="หนองบัวลำภู">หนองบัวลำภู</option>
              </select>
            </div>

            <!-- Number of Days -->
            <div class="col-md-4">
              <label for="timeA" class="form-label fw-semibold text-secondary"><i class="fas fa-clock me-1 text-primary"></i> จำนวนวันที่จัดแข่ง</label>
              <select name="timeA" id="timeA" class="form-select">
                <option value="<?= htmlspecialchars($rs['timeA'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($rs['timeA'] ?? '', ENT_QUOTES, 'UTF-8') ?> วัน</option>
                <option value="1">1 วัน</option>
                <option value="2">2 วัน</option>
                <option value="3">3 วัน</option>
              </select>
            </div>

            <!-- Start Date -->
            <div class="col-md-4">
              <label for="match_date_start" class="form-label fw-semibold text-secondary"><i class="far fa-calendar-alt me-1 text-primary"></i> แข่งขันวันที่ <span class="text-danger">*</span></label>
              <input type="date" name="match_date_start" id="match_date_start" class="form-control" value="<?= $match_date_start_val ?>" required>
            </div>

            <!-- End Date (B) -->
            <div class="col-md-4">
              <label for="match_date_end" class="form-label fw-semibold text-secondary"><i class="fas fa-arrow-right me-1 text-primary"></i> ถึงวันที่</label>
              <input type="date" name="match_date_end" id="match_date_end" class="form-control" value="<?= $match_date_end_val ?>">
            </div>

            <!-- Registration Deadline Date Field -->
            <div class="col-md-6">
              <label for="deadline_date" class="form-label fw-semibold text-secondary"><i class="far fa-calendar-check me-1 text-primary"></i> เปลี่ยนวันปิดระบบ <span class="text-danger">*</span></label>
              <input type="date" name="deadline_date" id="deadline_date" class="form-control" value="<?= $deadline_date_val ?>" required />
            </div>

            <!-- Contact Address -->
            <div class="col-12">
              <label for="addr" class="form-label fw-semibold text-secondary"><i class="fas fa-map-marked-alt me-1 text-primary"></i> สถานที่ติดต่อได้ ทางไปรษณีย์</label>
              <textarea name="addr" cols="70" rows="3" id="addr" class="form-control"><?= htmlspecialchars($rs['addr'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <!-- Tel & Email -->
            <div class="col-md-6">
              <label for="tel" class="form-label fw-semibold text-secondary"><i class="fas fa-phone-alt me-1 text-primary"></i> เบอร์โทรติดต่อ <span class="text-danger">*</span></label>
              <input name="tel" id="tel" type="text" class="form-control" value="<?= htmlspecialchars($rs['tel'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label fw-semibold text-secondary"><i class="far fa-envelope me-1 text-primary"></i> Email</label>
              <input name="email" id="email" type="email" class="form-control" value="<?= htmlspecialchars($rs['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <!-- Url & Form Upload -->
            <div class="col-md-6">
              <label for="url" class="form-label fw-semibold text-secondary"><i class="fas fa-link me-1 text-primary"></i> Url เว็บไซต์ (ลิงก์เพิ่มเติม)</label>
              <input name="url" id="url" type="text" class="form-control" value="<?= htmlspecialchars($rs['url'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>

            <div class="col-md-6">
              <label for="file" class="form-label fw-semibold text-secondary"><i class="fas fa-file-download me-1 text-primary"></i> ใบสมัครเพื่อดาวน์โหลด (เอกสารแนบ)</label>
              <input type="file" name="file" id="file" class="form-control">
              <small class="text-muted d-block mt-1">ประเภทไฟล์ที่อนุญาต: <strong class="text-danger">.doc, .docx, .pdf</strong> เท่านั้น</small>
              <?php if (!empty($rs['pic'])): ?>
                <div class="mt-2 p-2 bg-light border rounded d-inline-block">
                  เอกสารเดิม: <a href="../pic_macth/<?= htmlspecialchars($rs['pic'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" class="fw-bold"><i class="fas fa-file-download me-1"></i><?= htmlspecialchars($rs['pic'], ENT_QUOTES, 'UTF-8') ?></a>
                </div>
              <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="col-md-6">
              <label for="pass" class="form-label fw-semibold text-secondary"><i class="fas fa-key me-1 text-primary"></i> พาสเวิร์ดสำหรับแก้ไขข้อมูล <span class="text-danger">*</span></label>
              <input name="pass" id="pass" type="text" class="form-control" value="<?= htmlspecialchars($rs['pass'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <!-- Checkbox Option -->
            <div class="col-md-6 d-flex align-items-center mt-auto pb-2">
              <div class="form-check form-switch p-3 bg-light rounded border border-danger-subtle d-inline-block w-100">
                <input class="form-check-input ms-0 me-2" type="checkbox" name="changA" id="changA" value="1" <?php if ($rs['changA'] == 1) { echo "checked"; } ?>>
                <label class="form-check-label fw-bold text-danger" for="changA"><i class="fas fa-clock me-1 animate-pulse"></i> เลื่อนการแข่งขัน (Postpone Tournament)</label>
              </div>
            </div>

            <!-- Match Details / CKEditor -->
            <div class="col-12 mt-4">
              <label class="form-label fw-semibold text-secondary"><i class="fas fa-file-alt me-1 text-primary"></i> รายละเอียดแมทการแข่งขัน</label>
              <textarea name="msg" cols="49" rows="9" id="editor" class="form-control"><?= htmlspecialchars($rs['msg'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
              <small class="text-muted d-block mt-1">สามารถคัดลอกรายละเอียดส่วนสำคัญของใบสมัครมาวางลงในช่องนี้ได้เลยครับ</small>
            </div>

            <!-- Action Buttons -->
            <div class="col-12 text-center mt-5">
              <button type="submit" name="submit" class="btn btn-primary btn-lg px-5 py-2.5 rounded-3 border-0 shadow-sm me-3"><i class="fas fa-save me-2"></i>บันทึกการแก้ไข (Update)</button>
              <button type="reset" class="btn btn-outline-secondary btn-lg px-4 py-2.5 rounded-3"><i class="fas fa-undo me-2"></i>คืนค่าข้อมูลเดิม</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create(document.querySelector('#editor'), {
      toolbar: [
        'heading', '|',
        'bold', 'italic', 'underline', 'strikethrough', '|',
        'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
        'undo', 'redo'
      ]
    })
    .catch(error => {
      console.error(error);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>