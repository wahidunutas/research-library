<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Research Library | ADMIN</title>

	<link rel="icon" type="image/x-icon" href="../../../../assets/favicon.ico" />
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<script src="../../../../assets/dist/css/sweetalert2/sweetalert2.all.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
	<?php
	include "../../../../user/pages/koneksi.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;

	include '../../../../pages/daftar/PHPMailer-master/src/Exception.php';
	include '../../../../pages/daftar/PHPMailer-master/src/OAuth.php';
	include '../../../../pages/daftar/PHPMailer-master/src/PHPMailer.php';
	include '../../../../pages/daftar/PHPMailer-master/src/POP3.php';
	include '../../../../pages/daftar/PHPMailer-master/src/SMTP.php';

	// if(isset($_POST['daftar'])){
	$nama = $_POST['nama'];
	$nip = $_POST['nip'];
	$fakultas = $_POST['fakultas'];
	$email = $_POST['email'];
	$no = $_POST['no'];
	$alamat = $_POST['alamat'];
	$pw = $_POST['pw'];
	$pw2 = $_POST['pw2'];
	$status = $_POST['status'];
	$code = md5($email . date('Y-m-d'));

	$sql = $koneksi->query("SELECT * FROM author WHERE email='$email'");
	$cekemail = $sql->num_rows;

	if ($pw !== $pw2) {
		echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Password Tidak Sesuai',
                text: 'Pastikan Password Sesuai!'
            })
            </script>";
		echo "<meta http-equiv='refresh' content='2;url=../../../?p=dosen'>";
	} elseif ($cekemail == 1) {
		echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Opps!',
                text: 'Email Sudah Digunakan!'
                })
            </script>";
		echo "<meta http-equiv='refresh' content='2;url=../../../?p=dosen'>";
	} else {
		$koneksi->query("INSERT INTO author(nama, email, id_fakultas, alamat, no_telepon, status)VALUES('$nama', '$email', '$fakultas', '$alamat', '$no', '$status')");

		$id_author = $koneksi->insert_id;
		$koneksi->query("INSERT INTO akses(id_author, nip, password, role, verif_code, is_verif, is_confirm)VALUES('$id_author', '$nip', '$pw', '$status', '$code', '1', '1')");

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
		$mail->Subject = 'Verification Account -  Research Library';

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		// $mail->msgHTML(file_get_contents('?p=daftar&act=proses'), __DIR__);
		$body = "Hi, " . $nama . "<br>
		Selamat, Akun Anda Berhasil Dibuat.<br>
		Berikut Profile Pengguna Anda:<br>
		<ul>
			<li>Nip: " . $nip . "</li>
			<li>Email: " . $email . "</li>
			<li>Password: " . $pw . "</li>
		</ul>
		<br>
		Salam Hormat,<br>
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
				title: 'Register Berhasil',
				text: 'Silahkan Cek Email Anda'
			})
			</script>";
			echo "<meta http-equiv='refresh' content='3;url=../../../index.php?p=dosen'>";
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
		// echo "<script>
		// Swal.fire(
		//     'Berhasil Daftar!',
		//     '',
		//     'success'
		//     );
		//     </script>";
		// echo "<meta http-equiv='refresh' content='2;url=?p=dosen'>";
	}
	// }
	?>