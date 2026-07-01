<?php
session_start();
ob_start();
require_once("app/conn_pdo.php");

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// $match = $_GET['match'];

// $matchrow_select = $db->prepare("select * from thannam_match   where id= :id");
// $matchrow_select->bindValue(':id', $_GET['match']);
// $matchrow_select->execute();
// $matchrow = $matchrow_select->fetch();
// // $rsmatch = $matchrow_select->fetch();

if ($_SESSION['idmatch'] == "") {
  header("Location: ../match");
  exit();
}

$updateA = $_GET['updateA'];

$rs_select = $db->prepare("select * from  thannam_match where id = '$_SESSION[idmatch]'");
$rs_select->execute();
$rs = $rs_select->fetch();

?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<!-- <link href="../STYLE.CSS" rel="stylesheet" type="text/css"> -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css">
<style type="text/css">
  .style1 {
    font-weight: bold
  }

  .style2 {
    color: #FFFF00
  }
</style>
<meta charset="utf-8">
<table width="779" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="20%" align="center">

    </td>
  </tr>


  <tr>
    <td align="center" colspan="2"><?= date('Y-m-d H:i:s'); ?></td>
  </tr>
  <tr>
    <td align="center" colspan="2">


      <script language="javaScript">
        function Linkup() {
          var number = document.DD.timeAA.selectedIndex;
          location.href = document.DD.timeAA.options[number].value;
        }
      </script>
      <FORM METHOD="post" ENCTYPE="multipart/form-data" ACTION="addnew_post.php" onSubmit="putdata()" onChange="Linkup(this.form)" name="DD">
        <table border="0" cellspacing="1" cellpadding="3" align="center" bgcolor="#FFFFFF">
          <tr align="center" bgcolor="#FF0000">
            <td colspan="2">
              <font size="3" class="big style2">ทางผู้จัดที่ลงทะเบียนแมทแข่งไปแล้วกรุณา เข้าไปแก้ไขรายละเอียด ในแมทของท่าน<br>
                ที่ได้ลงไว้แล้ว เพื่อไม่ให้ผู้อ่านสับสน และเพื่อความเป็นระเบียบเรียบร้อย<br>
                เหมาะสมในการค้นหาแมทแข่ง<br>
                <strong>หากแมทการแข่งขันใดเพิ่มหัวข้อแมทของท่านมากเกินความจำเป็น<br>
                  ทางเราต้องของลดปริมาณหัวข้อของท่านโดยไม่แจ้งให้ทราบนะครับ</strong>
              </font>
            </td>
          </tr>
          <tr align="center" bgcolor="#D8D8D8">
            <td height="17" colspan="2">
              <font color="#333333" size="3"><b>ลงทะเบียนแมทการแข่งขัน</b></font>
            </td>
          </tr>
          <tr>
            <td width="143" align="right"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">ชื่อแมทการแข่งขัน</font>
                </font>
              </strong></td>
            <td width="621"><input name="nameA" type="text" id="nameA" value="<?= $rs['nameA'] ?>" size="40">
              <input name="id" type="hidden" id="id" value="<?= $rs['id'] ?>" size="40" />
            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">สถานที่จัดการแข่งขัน</font>
                </font>
              </strong></td>
            <td>
              <input name="build" id="build" value="<?= $rs['build'] ?>" size="40">
              <select name=city size="1">
                <option value="<?= $rs['city'] ?>" selected="selected"><?= $rs['city'] ?></option>
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
                <option value="เชียงใหม">เชียงใหม่</option>
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
                <option value="ปทุมธาน">ปทุมธานี</option>
                <option value="ประจวบคีรีขันธ">ประจวบคีรีขันธ์</option>
                <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                <option value="ปัตตานี">ปัตตานี</option>
                <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                <option value="พังงา">พังงา</option>
                <option value="พัทลุง">พัทลุง</option>
                <option value="พิจิตร">พิจิตร</option>
                <option value="พิษณุโลก">พิษณุโลก</option>
                <option value="เพชรบุรี">เพชรบุรี</option>
                <option value="เพชรบูรณ">เพชรบูรณ์</option>
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
                <option value="สุรินทร">สุรินทร์</option>
                <option value="หนองคาย">หนองคาย</option>
                <option value="อ่างทอง">อ่างทอง</option>
                <option value="อุดรธานี">อุดรธานี</option>
                <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                <option value="อุทัยธาน">อุทัยธานี</option>
                <option value="อุบลราชธานี">อุบลราชธานี</option>
                <option value="นครปฐม-สามพราน">นครปฐม-สามพราน</option>
                <option value="หาดใหญ">หาดใหญ่</option>
                <option value="พะเยา">พะเยา</option>
                <option value="มุกดาหาร">มุกดาหาร</option>
                <option value="ต่างประเทศ">ต่างประเทศ</option>
                <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                <option value="สระแก้ว">สระแก้ว</option>
                <option value="หนองบัวลำภู">หนองบัวลำภู</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font color="#000033" size="1" face="mS Sans Serif">จำนวนวันที่จัดแข่ง</font>
              </strong></td>
            <td>

              <select name="timeA" id="timeA">
                <option value="<?= $rs['timeA'] ?>"><?= $rs['timeA'] ?> วัน</option>
                <option value="1">1 วัน</option>
                <option value="2">2 วัน</option>
                <option value="3">3 วัน</option>
              </select>
            </td>
          </tr>
          <tr bgcolor="#FFFFCC">
            <td align="right"><strong>
                <font color="#000033" size="1" face="mS Sans Serif">แข่งขันวันที่</font>
              </strong></td>
            <td>
              <span class="verdana_black_big">
                <select name="ddayA" id="select6">
                  <option value="">วัน</option>
                  <?php
                  $day = $rs['ddayA'];
                  for ($i = 1; $i <= 31; $i++) {
                    $ii = sprintf("%02d", $i); ?>
                    <option value=<?= $ii ?><?php if ($day == $ii) {
                                              echo " selected";
                                            } ?>><?= $ii; ?></option>
                  <?php } ?>
                </select>
                <select name="mmountA" id="select8">
                  <option value="">เดือน</option>
                  <option value="01" <?php if ($rs['mmountA'] == "01") {
                                        echo " selected";
                                      } ?>>มกราคม</option>
                  <option value="02" <?php if ($rs['mmountA'] == "02") {
                                        echo " selected";
                                      } ?>>กุมภาพันธ์</option>
                  <option value="03" <?php if ($rs['mmountA'] == "03") {
                                        echo " selected";
                                      } ?>>มีนาคม</option>
                  <option value="04" <?php if ($rs['mmountA'] == "04") {
                                        echo " selected";
                                      } ?>>เมษายน</option>
                  <option value="05" <?php if ($rs['mmountA'] == "05") {
                                        echo " selected";
                                      } ?>>พฤษภาคม</option>
                  <option value="06" <?php if ($rs['mmountA'] == "06") {
                                        echo " selected";
                                      } ?>>มิถุนายน</option>
                  <option value="07" <?php if ($rs['mmountA'] == "07") {
                                        echo " selected";
                                      } ?>>กรกฎาคม</option>
                  <option value="08" <?php if ($rs['mmountA'] == "08") {
                                        echo " selected";
                                      } ?>>สิงหาคม</option>
                  <option value="09" <?php if ($rs['mmountA'] == "09") {
                                        echo " selected";
                                      } ?>>กันยายน</option>
                  <option value="10" <?php if ($rs['mmountA'] == "10") {
                                        echo " selected";
                                      } ?>>ตุลาคม</option>
                  <option value="11" <?php if ($rs['mmountA'] == "11") {
                                        echo " selected";
                                      } ?>>พฤศจิกายน</option>
                  <option value="12" <?php if ($rs['mmountA'] == "12") {
                                        echo " selected";
                                      } ?>>ธันวาคม</option>
                </select>


                <?php
                echo '<select name="yyearA">';
                ?>
                <option value='<?= $rs['yyearA'] ?>' selected='selected'><?= $rs['yyearA'] ?></option>
                <?php
                for ($i = 2556; $i <= 2566; $i++) {
                  echo '<option value="' . $i . '">' . $i . '</option>';
                }
                echo '</select>';
                ?>



              </span><strong></strong>

            </td>
          </tr>



          <tr bgcolor="#FFFFCC">
            <td align="right"><strong>
                <font size="1" face="mS Sans Serif">ถึง</font>
              </strong></td>
            <td><select name="ddayB" id="ddayB">
                <option value="">วัน</option>
                <option value="<?= $rs['ddayB'] ?>" selected="selected"><?= $rs['ddayB'] ?> </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>
              <span class="verdana_black_big">
                <select name="mmountB" id="select2">
                  <option value="">เดือน</option>
                  <option value="01" <?php if ($rs['mmountB'] == "01") {
                                        echo " selected";
                                      } ?>>มกราคม</option>
                  <option value="02" <?php if ($rs['mmountB'] == "02") {
                                        echo " selected";
                                      } ?>>กุมภาพันธ์</option>
                  <option value="03" <?php if ($rs['mmountB'] == "03") {
                                        echo " selected";
                                      } ?>>มีนาคม</option>
                  <option value="04" <?php if ($rs['mmountB'] == "04") {
                                        echo " selected";
                                      } ?>>เมษายน</option>
                  <option value="05" <?php if ($rs['mmountB'] == "05") {
                                        echo " selected";
                                      } ?>>พฤษภาคม</option>
                  <option value="06" <?php if ($rs['mmountB'] == "06") {
                                        echo " selected";
                                      } ?>>มิถุนายน</option>
                  <option value="07" <?php if ($rs['mmountB'] == "07") {
                                        echo " selected";
                                      } ?>>กรกฎาคม</option>
                  <option value="08" <?php if ($rs['mmountB'] == "08") {
                                        echo " selected";
                                      } ?>>สิงหาคม</option>
                  <option value="09" <?php if ($rs['mmountB'] == "09") {
                                        echo " selected";
                                      } ?>>กันยายน</option>
                  <option value="10" <?php if ($rs['mmountB'] == "10") {
                                        echo " selected";
                                      } ?>>ตุลาคม</option>
                  <option value="11" <?php if ($rs['mmountB'] == "11") {
                                        echo " selected";
                                      } ?>>พฤศจิกายน</option>
                  <option value="12" <?php if ($rs['mmountB'] == "12") {
                                        echo " selected";
                                      } ?>>ธันวาคม</option>
                </select>
                <select name="yyearB" id="select3">
                  <option value="">พ.ศ.</option>
                  <option value="<?= $rs['yyearB'] ?>"><?= $rs['yyearB'] ?> </option>
                  <option value="2554">2554</option>
                  <option value="2555">2555</option>
                  <option value="2556">2556</option>
                </select>
              </span>
            </td>
          </tr>

          <tr bgcolor="#F5F5F5">
            <td align="right"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">กำหนดหมดเขต รับสมัคร </font>
                </font>
              </strong></td>
            <td>
              <input type="date" name="finishDayA" id="finishDayA" value="<?= $rs['finishDayA'] ?>" />

            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">สถานที่ติดต่อได้ ทางไปรษณีย์</font>
                </font>
              </strong></td>
            <td>
              <textarea name="addr" cols="70" rows="4" id="addr"><?= $rs['addr'] ?>
            </textarea>
            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">เบอร์โทรติดต่อ</font>
                </font>
              </strong></td>
            <td>
              <input name="tel" type="text" value="<?= $rs['tel'] ?>" size="70">
            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">Email</font>
                </font>
              </strong></td>
            <td>
              <input name="email" type="text" value="<?= $rs['email'] ?>" size="35">
            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">Url</font>
                </font>
              </strong></td>
            <td>
              <input name="url" type="text" value="<?= $rs['url'] ?>" size="35">
            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font color="#000033" size="1" face="mS Sans Serif">ใบสมัครเพื่อดาวโหลดน์</font>
              </strong></td>
            <td><input type="file" name="file" class="textbox">
              <b>
                <font color="#FF3300">
                  <font color="#FF0000" size="2"> ให้ใช้ไฟด์นามสกุล .zip, .doc, .rar เท่านั้นนะครับ<br />
                    <?php
                    if (empty($rs['pic'])) {
                    } else {
                      echo "<a href=../pic_macth/$rs[pic]>" . $rs['pic'] . "</a>";
                    } ?></font>
                </font>
              </b>
            </td>
          </tr>
          <tr>
            <td align="right"><strong>
                <font size="1" face="mS Sans Serif">พาสเวิด</font>
              </strong></td>
            <td><input name="pass" type="text" id="pass" value="<?= $rs['pass'] ?>" size="10">
              <span class="big">ใว้สำหรับแก้ไขข้อมูล * (กรุณากรอกพาสเวิร์ดเพื่อใช้แก้ไขแมทการแข่งขันภายหลังมีการเปลี่ยนแปลง) </span>
            </td>
          </tr>
          <tr>
            <td align="right" valign="top"><strong>
                <font size="2">
                  <font color="#000033" size="1" face="mS Sans Serif">รายละเอียด แมทการแข่งขัน</font>
                </font>
              </strong></td>
            <td><strong></strong>

              <textarea name="msg" cols="49" rows="9" id="msg"><?= $rs['msg'] ?>
               </textarea>
              <script type="text/javascript">
                //<![CDATA[
                CKEDITOR.replace('msg', {
                  skin: 'kama',
                  language: 'en',
                  extraPlugins: 'uicolor',
                  uiColor: '#ccc',
                  height: 400,
                  width: 620,
                  toolbar:


                    [
                      ['Source', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates', 'Smiley'],
                      ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker', 'Scayt'],
                      ['Undo', 'Redo', '-', 'Find', 'Replace', '-'],
                      '/',
                      ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
                      ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
                      ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                      ['Link', 'Unlink', 'Anchor'],
                      '/',
                      ['Styles', 'Format', 'Font', 'FontSize'],
                      ['TextColor', 'BGColor'],
                      ['Maximize', 'ShowBlocks', '-']

                    ],






                  filebrowserBrowseUrl: '../ckfinder/ckfinder.html',
                  filebrowserImageBrowseUrl: '../ckfinder/ckfinder.html?Type=Images',
                  filebrowserFlashBrowseUrl: '../ckfinder/ckfinder.html?Type=Flash',
                  filebrowserUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                  filebrowserImageUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                  filebrowserFlashUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

                });
                //]]>
              </script><br>
              <span class="style1">
                <font size="2">สามารถ Copy รายละเอียดส่วนสำคัญของใบสมัครท่าน วาง ลง ในช่องได้เลยครับ</font>
              </span>
            </td>
          </tr>
          <tr>
            <td align="center">
              <font color="#000033">&nbsp;</font>
            </td>
            <td bgcolor="#FAFFE8">

              <input type="checkbox" name="changA" value='1' <?php if ($rs['changA'] == 1) { ?> checked <?php } ?>> เลื่อนการแข่งขัน
              <br><br>

              <input type="submit" value=" Update " name="submit" class=input1>
              <input type="reset" name="Submit2" value="ลบข้อความใหม่" class=input1>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
  <tr>
    <td align="center" colspan="2">&nbsp;</td>
  </tr>
</table>