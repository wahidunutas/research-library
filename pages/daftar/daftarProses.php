<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Research Library</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="../../assets/logo-title.png" />
	<script src="../../assets/dist/css/sweetalert2/sweetalert2.all.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body id="page-top">
	<?php
	include "../../user/pages/koneksi.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// require 'PHPMailerAutoload.php';
	include 'PHPMailer-master/src/Exception.php';
	include 'PHPMailer-master/src/OAuth.php';
	include 'PHPMailer-master/src/PHPMailer.php';
	include 'PHPMailer-master/src/POP3.php';
	include 'PHPMailer-master/src/SMTP.php';

	error_reporting(0);
	$idConfirm = $_GET['idConfirm'];
	
	if(!isset($idConfirm)){
		$nama = $_POST['nama'];
		$role = $_POST['role'];
		$nip = $_POST['nip'];
		$fakultas = $_POST['fakultas'];
		$jurusan = $_POST['jurusan'];
		$email = $_POST['email'];
		$pw = $_POST['pw'];
		$pw2 = $_POST['pw2'];
		$code = md5($email . date('Y-m-d'));
	
		$sql = $koneksi->query("SELECT * FROM author WHERE email='$email'");
		$cek = mysqli_num_rows($sql);
		$sql2 = $koneksi->query("SELECT * FROM akses WHERE nip='$nip'");
		$cek2 = mysqli_num_rows($sql2);

		if ($pw !== $pw2) {
			echo "<script>
					Swal.fire({
					icon: 'error',
					title: 'Password Tidak Sesuai',
					text: 'Pastikan Password Sesuai!'
				})
				</script>";
			echo "<meta http-equiv='refresh' content='2;url=../../index.php?p=daftar'>";
		} elseif ($cek == 1) {
			echo "<script>
					Swal.fire({
					icon: 'error',
					title: 'Email Sudah Terdaftar',
					text: 'Gunakan Email Lain!'
				})
				</script>";
			echo "<meta http-equiv='refresh' content='2;url=../../index.php?p=daftar'>";
		} elseif ($cek2 == 1) {
			echo "<script>
					Swal.fire({
					icon: 'error',
					title: 'NIP Sudah Terdaftar',
					text: 'Pastikan Nip Benar!'
				})
				</script>";
			echo "<meta http-equiv='refresh' content='2;url=../../index.php?p=daftar'>";
		} else {
			$koneksi->query("INSERT INTO author(id_author, nama, email, jurusan, id_fakultas, alamat, no_telepon, status, img)VALUES('', '$nama', '$email', '$jurusan', '$fakultas', '', '', '$role', '')");

			$id_author = $koneksi->insert_id;
			$koneksi->query("INSERT INTO akses(id_akses, id_admin, id_author, nip, password, role, verif_code, is_verif)VALUES('', '', '$id_author', '$nip', '$pw', '$role', '$code', '')");

			echo "<script>
				Swal.fire({
				icon: 'success',
				title: 'Register Berhasil',
				text: 'Cek Email Secara Berkala Untuk Verifikasi'
			})
			</script>";
			echo "<meta http-equiv='refresh' content='3;url=../../index.php?p=daftar'>";
		}
	}else{
		$acc = $koneksi->query("SELECT * FROM akses JOIN author ON akses.id_author=author.id_author WHERE akses.id_akses = '$idConfirm'");
		$result = $acc->fetch_assoc();

		$nama = $result['nama'];
		$email = $result['email'];
		$codes = md5($email . date('Y-m-d'));


		$mail = new PHPMailer();

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		//SMTP::DEBUG_OFF = off (for production use)
		//SMTP::DEBUG_CLIENT = client messages
		//SMTP::DEBUG_SERVER = client and server messages
		$mail->SMTPDebug = SMTP::DEBUG_OFF;

		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
		//if your network does not support SMTP over IPv6,
		//though this may cause issues with TLS

		//Set the SMTP port number:
		// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
		// - 587 for SMTP+STARTTLS
		$mail->Port = 465;

		//Set the encryption mechanism to use:
		// - SMTPS (implicit TLS on port 465) or
		// - STARTTLS (explicit TLS on port 587)
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = 'repositorywebs@gmail.com';

		//Password to use for SMTP authentication
		$mail->Password = 'researchlibrary';

		//Set who the message is to be sent from
		//Note that with gmail you can only use your account address (same as `Username`)
		//or predefined aliases that you have configured within your account.
		//Do not use user-submitted addresses in here
		$mail->setFrom('no-reply@AcademicProduction.com', 'Research Library');

		//Set an alternative reply-to address
		//This is a good place to put user-submitted addresses
		// $mail->addReplyTo('replyto@example.com', 'First Last');

		//Set who the message is to be sent to
		$mail->addAddress($email, $nama);

		//Set the subject line
		$mail->Subject = 'Verification Account - Research Library';

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		// $mail->msgHTML(file_get_contents('?p=daftar&act=proses'), __DIR__);
		$body = "
			Hi," . $nama . "<br>
			Silahkan Klik Tombol Dibawah Ini Untuk Verifikasi Email Kamu: <br><br> <button><a href='http://localhost/research_library/research_library/pages/daftar/confirm.php?code=" . $codes . "'class='btn' style='style-decoration:none;'>Verifikasi</a></button><br><br>
			<br>Salam Hormat,<br>
			Admin Research Library";
		$mail->Body = $body;

		//Replace the plain text body with one created manually
		$mail->AltBody = 'Verification Account';

		// //send the message, check for errors
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo "<script>
				Swal.fire({
				icon: 'success',
				title: 'Notifikasi Berhasil Dikirim',
				text: 'Notifikasi Telah Dikirim Ke Alamat $email'
			})
			</script>";
			echo "<meta http-equiv='refresh' content='3;url=../../admin/index.php?p=mahasiswa'>";
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
	}

	?>