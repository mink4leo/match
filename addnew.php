<?php
session_start();
ob_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADD MATCH TOURNAMENT</title>
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
        <h4 class="mb-0 text-center text-white"><i class="fas fa-trophy me-2"></i>ลงทะเบียนแมทการแข่งขัน (Tournament Registration)</h4>
      </div>
      
      <div class="card-body p-4">
        <!-- Clean warning alert -->
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4" role="alert">
          <div class="d-flex">
            <div class="me-3 mt-1">
              <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
            </div>
            <div>
              <h5 class="alert-heading text-danger fw-bold mb-2">ข้อแนะนำในการลงทะเบียน</h5>
              <p class="mb-1 text-dark" style="font-size: 14.5px;">
                ทางผู้จัดที่ลงทะเบียนแมทแข่งไปแล้วกรุณา <strong>เข้าไปแก้ไขรายละเอียด ในแมทของท่านที่ได้ลงไว้แล้ว</strong> เพื่อไม่ให้ผู้อ่านสับสน และเพื่อความเป็นระเบียบเรียบร้อย เหมาะสมในการค้นหาแมทแข่ง
              </p>
              <hr class="border-danger-subtle my-2">
              <p class="mb-0 text-danger fw-bold" style="font-size: 14px;">
                * หากแมทการแข่งขันใดเพิ่มหัวข้อแมทของท่านมากเกินความจำเป็น ทางเราต้องขออนุญาตลดปริมาณหัวข้อของท่านโดยไม่แจ้งให้ทราบนะครับ
              </p>
            </div>
          </div>
        </div>

        <form method="post" enctype="multipart/form-data" action="addnew_post1.php" name="DD">
          <div class="row g-3">
            
            <!-- Match Name -->
            <div class="col-12">
              <label for="nameA" class="form-label fw-semibold text-secondary"><i class="fas fa-heading me-1 text-primary"></i> ชื่อแมทการแข่งขัน <span class="text-danger">*</span></label>
              <input name="nameA" id="nameA" type="text" class="form-control" placeholder="ระบุชื่อแมทการแข่งขัน เช่น ธารน้ำ เทควันโด แชมเปี้ยนชิพ" required>
            </div>

            <!-- Location & City -->
            <div class="col-md-8">
              <label for="build" class="form-label fw-semibold text-secondary"><i class="fas fa-map-marker-alt me-1 text-primary"></i> สถานที่จัดการแข่งขัน <span class="text-danger">*</span></label>
              <input name="build" id="build" type="text" class="form-control" placeholder="ระบุสถานที่จัดการแข่งขัน (เช่น อาคารยิมเนเซียม...)" required>
            </div>
            
            <div class="col-md-4">
              <label for="city" class="form-label fw-semibold text-secondary"><i class="fas fa-city me-1 text-primary"></i> จังหวัด <span class="text-danger">*</span></label>
              <select name="city" id="city" class="form-select" required>
                <option value="กรุงเทพมหานคร" selected>กรุงเทพมหานคร</option>
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
              <input name="timeA" id="timeA" value="1" type="hidden" />
            </div>

            <!-- Date of Competition -->
            <div class="col-md-6">
              <label for="match_date" class="form-label fw-semibold text-secondary"><i class="far fa-calendar-alt me-1 text-primary"></i> แข่งขันวันที่ <span class="text-danger">*</span></label>
              <input type="date" name="match_date" id="match_date" class="form-control" required>
            </div>

            <!-- Registration Deadline -->
            <div class="col-md-6">
              <label for="deadline_date" class="form-label fw-semibold text-secondary"><i class="far fa-calendar-check me-1 text-primary"></i> เปลี่ยนวันปิดระบบ <span class="text-danger">*</span></label>
              <input type="date" name="deadline_date" id="deadline_date" class="form-control" required>
            </div>

            <!-- Contact Address -->
            <div class="col-12">
              <label for="addr" class="form-label fw-semibold text-secondary"><i class="fas fa-map-marked-alt me-1 text-primary"></i> สถานที่ติดต่อได้ ทางไปรษณีย์</label>
              <textarea name="addr" cols="70" rows="3" id="addr" class="form-control" placeholder="ระบุที่อยู่ติดต่อจัดส่งพัสดุ/เอกสาร"></textarea>
            </div>

            <!-- Tel & Email -->
            <div class="col-md-6">
              <label for="tel" class="form-label fw-semibold text-secondary"><i class="fas fa-phone-alt me-1 text-primary"></i> เบอร์โทรติดต่อ <span class="text-danger">*</span></label>
              <input name="tel" id="tel" type="text" class="form-control" placeholder="ระบุเบอร์โทรศัพท์ติดต่อ" required>
            </div>
            
            <div class="col-md-6">
              <label for="email" class="form-label fw-semibold text-secondary"><i class="far fa-envelope me-1 text-primary"></i> Email</label>
              <input name="email" id="email" type="email" class="form-control" placeholder="ระบุอีเมลผู้ประสานงาน">
            </div>

            <!-- Url & Form Upload -->
            <div class="col-md-6">
              <label for="url" class="form-label fw-semibold text-secondary"><i class="fas fa-link me-1 text-primary"></i> Url เว็บไซต์ (ลิงก์เพิ่มเติม)</label>
              <input name="url" id="url" type="text" class="form-control" placeholder="ระบุลิงก์เว็บไซต์เพิ่มเติม (ถ้ามี)">
            </div>
            
            <div class="col-md-6">
              <label for="file" class="form-label fw-semibold text-secondary"><i class="fas fa-file-download me-1 text-primary"></i> ใบสมัครเพื่อดาวน์โหลด (เอกสารแนบ)</label>
              <input type="file" name="file" id="file" class="form-control">
              <small class="text-muted d-block mt-1">ประเภทไฟล์ที่อนุญาต: <strong class="text-danger">.doc, .docx, .pdf</strong> เท่านั้น</small>
            </div>

            <!-- Edit Password -->
            <div class="col-md-6">
              <label for="pass" class="form-label fw-semibold text-secondary"><i class="fas fa-key me-1 text-primary"></i> พาสเวิร์ดสำหรับแก้ไขข้อมูล <span class="text-danger">*</span></label>
              <input name="pass" id="pass" type="text" class="form-control" placeholder="กำหนดพาสเวิร์ดสำหรับกลับมาแก้ไขแมทภายหลัง" required>
            </div>

            <!-- Security Captcha -->
            <div class="col-md-6">
              <label class="form-label fw-semibold text-secondary d-block"><i class="fas fa-shield-alt me-1 text-primary"></i> ยืนยันตัวตน (Security Image)</label>
              <div class="d-flex align-items-center gap-3">
                <div class="bg-light p-2 border rounded-3 d-inline-flex align-items-center justify-content-center shadow-inner" style="height: 48px;">
                  <?php
                  session_name("myImageSecurity");
                  $sesID = session_id();
                  require("../sImage.php");
                  $_SESSION['nChars'] = 4;
                  $imgHTML = $_SESSION['imgHTML'];
                  ?>
                  <input type="hidden" name="myImageSecurity" value="<?php echo $sesID ?>" />
                  <?php echo $imgHTML ?>
                </div>
                <div>
                  <input name="simage" type="text" class="form-control" placeholder="ระบุรหัสความปลอดภัย" size="7" style="width: 150px;" required />
                </div>
              </div>
            </div>

            <!-- Match Details / CKEditor -->
            <div class="col-12 mt-4">
              <label class="form-label fw-semibold text-secondary"><i class="fas fa-file-alt me-1 text-primary"></i> รายละเอียดแมทการแข่งขัน</label>
              <textarea name="msg" cols="49" rows="9" id="msg" class="form-control"></textarea>
              <small class="text-muted d-block mt-1">สามารถคัดลอกรายละเอียดส่วนสำคัญของใบสมัครมาวางลงในช่องนี้ได้เลยครับ</small>
            </div>

            <!-- Action Buttons -->
            <div class="col-12 text-center mt-5">
              <button type="submit" name="submit" class="btn btn-primary btn-lg px-5 py-2.5 rounded-3 border-0 shadow-sm me-3"><i class="fas fa-check-circle me-2"></i>ลงทะเบียน</button>
              <button type="reset" class="btn btn-outline-secondary btn-lg px-4 py-2.5 rounded-3"><i class="fas fa-trash-alt me-2"></i>ล้างข้อความใหม่</button>
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
    .create(document.querySelector('#msg'), {
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