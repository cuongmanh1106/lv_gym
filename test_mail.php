<?php

	require_once("smtpgmail/class.phpmailer.php");
	$mail=new PHPMailer();
	$mail->IsSMTP(); // Chứng thực SMTP
	$mail->SMTPAuth=TRUE;
	$mail->Host="smtp.gmail.com";
	$mail->Port=465;
	$mail->SMTPSecure="ssl";
	/* Server google*/
	$mail->Username="cuongmanh1106@gmail.com"; // Nhập mail 
	$mail->Password="nguyenmanhcuong"; // Mật khẩu
	/* Server google*/
	$mail->CharSet="utf-8";
	$noidung="Họ tên:asdasd" ;
	require_once 'print_view.php';
	$html = ob_get_clean();
	$mail->SetFrom("cuongmanh1106@gmail.com","Harrik");
	$mail->Subject="MC";
	$mail->MsgHTML($html);
	$mail->AddAddress("cuongmanh2311@gmail.com","Name"); // Mail người nhận
	$mail->Send();
	?>