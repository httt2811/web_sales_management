<?php 
include('admin/config/config.php');
require('mail/mail.php');
require('carbon/autoload.php');
	use Carbon\Carbon;
    use Carbon\CarbonInterval;
    
	$now = Carbon::now('Asia/Ho_Chi_Minh');
// session_start();
$ten=$_SESSION['user'];
$id_khachhang = $_SESSION['id_khachhang'];
$id=$_GET['thutu'];


	$sql ="SELECT * FROM tbl_sanpham WHERE thutu='".$id."' limit 1";
	$query= mysqli_query($mysqli,$sql);

	$row=mysqli_fetch_array($query);


if ($_SESSION['user']==false) {
	echo "<p style='color:red'>Vui lòng đăng nhập</p>";
	# code...
}

$ma_donhang=rand(0,99999);
$insert_cart = "INSERT INTO tbl_giohang(ten_khachhang,ma_donhang,trangthai,thoigian) VALUE('".$ten."','".$ma_donhang."',1,'".$now."')";
$cart_query = mysqli_query($mysqli,$insert_cart);

if($cart_query){
	//them gio hang chi tiet
	foreach($_SESSION['them'] as $key => $value){
		$id_sanpham = $value['thutu'];
		$soluong = $value['soluong'];
		$insert_order_details = "INSERT INTO tbl_thongtingiohang(id_thongtingiohang,ma_donhang,soluong) VALUE('".$id_sanpham."','".$ma_donhang."','".$soluong."')";
		mysqli_query($mysqli,$insert_order_details);
	}
	$tieude = "Đặt hàng website Dolce far niente thành công!";
	$noidung = "<p>Cảm ơn quý khách đã đặt hàng của chúng tôi . Đơn hàng của bạn có mã : ".$ma_donhang."</p>";
	$noidung.="<h4>Đơn hàng của bạn bao gồm :</h4p>";

	foreach($_SESSION['them'] as $key => $val){
		$noidung.= "<ul style='border:1px solid blue;margin:10px;'>
			<li>".$val['ten_sanpham']."</li>
			<li>".$val['ma_sanpham']."</li>
			<li>".number_format($val['gia_sanpham'],0,',','.')."đ</li>
			<li>".$val['soluong']."</li>
			</ul>";
	}
	$maildathang = $_SESSION['user'];
	$mail = new Mailer();
	$mail->dathangmail($tieude,$noidung,$maildathang);
}
unset($_SESSION['them']);


?>

<script> location.replace("index1.php?quanly=camon"); </script>
<div class="container">
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="index1.php?quanly=giohang" >Giỏ hàng</a></span> </div>
    <div class="step done"> <span><a href="index1.php?quanly=vanchuyen" >Vận chuyển</a></span> </div>
    <div class="step current"> <span><a href="index1.php?quanly=thongtinthanhtoan" >Thanh toán</a><span> </div>
    <div class="step"> <span><a href="index1.php?quanly=donhangdadat" >Lịch sử đơn hàng</a><span> </div>
   
  </div>
 
</div>