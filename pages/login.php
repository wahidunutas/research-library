<?php session_start(); ?>
<div class="row">
	<div class="col">
		<div class="wrap-login100">
			<form class="login100-form validate-form" method="post">
				<div class="wrap-input100 validate-input m-b-26" data-validate="Nip is required">
					<span class="label-input100">NIP/NIM</span>
					<input class="input100" type="text" name="nip" placeholder="Enter NIP/NIM">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
					<span class="label-input100">Password</span>
					<input class="input100" type="password" name="pw" placeholder="Enter Password">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit" name="go">
						Login
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4 mt-4">
		<h3>Belum Memiliki akun?<br></h3>
		<a href="?p=daftar"> Daftar!</a>
	</div>
</div>
<?php
if (isset($_POST['go'])) {
	$nip = $_POST['nip'];
	$pw = $_POST['pw'];

	$login = $koneksi->query("SELECT * FROM akses WHERE nip = '$nip' AND password = '$pw'");
	$cek = mysqli_num_rows($login);

	if ($cek == 1) {
		$akun = $login->fetch_assoc();
		if ($akun['role'] == "admin") {
			if ($akun['is_verif'] == 1) {
				$_SESSION['nip'] = $nip;
				$_SESSION['admin'] = $akun;
				$_SESSION['role'] = "admin";
				echo "<script>
					Swal.fire(
					'LOGIN BERHASIL!',
					'',
					'success',
					'1500'
					)
					;</script>";
				echo "<meta http-equiv='refresh' content='2;url=admin/index.php'>";
			} else {
				echo "<script>
				Swal.fire(
				'LOGIN GAGAL!',
				'Pastikan Sudah Verifikasi Email atau Pastikan NIP/NIM/Password Benar',
				'error',
				'1500'
				)
				;</script>";
				echo "<meta http-equiv='refresh' content='2;url=?p=masuk'>";
			}
		} elseif ($akun['role'] == "Mahasiswa") {
			if ($akun['is_verif'] == 1) {
				$_SESSION['nip'] = $nip;
				$_SESSION['login'] = $akun;
				$_SESSION['role'] = "Mahasiswa";
				echo "<script>
						Swal.fire(
						'LOGIN BERHASIL!',
						'',
						'success',
						'1500'
						)
						;</script>";
				echo "<meta http-equiv='refresh' content='2;url=user/index.php'>";
			} else {
				echo "<script>
				Swal.fire(
				'LOGIN GAGAL!',
				'Pastikan Sudah Verifikasi Email atau Pastikan NIP/NIM/Password Benar',
				'error',
				'1500'
				)
				;</script>";
				echo "<meta http-equiv='refresh' content='2;url=?p=masuk'>";
			}
		} elseif ($akun['role'] == "Dosen") {
			if ($akun['is_verif'] == 1) {
				$_SESSION['nip'] = $nip;
				$_SESSION['login'] = $akun;
				$_SESSION['role'] = "dosen";
				echo "<script>
						Swal.fire(
						'LOGIN BERHASIL!',
						'',
						'success',
						'1500'
						)
						;</script>";
				echo "<meta http-equiv='refresh' content='2;url=user/index.php'>";
			} else {
				echo "<script>
				Swal.fire(
				'LOGIN GAGAL!',
				'Pastikan Sudah Verifikasi Email atau Pastikan NIP/NIM/Password Benar',
				'error',
				'1500'
				)
				;</script>";
				echo "<meta http-equiv='refresh' content='2;url=?p=masuk'>";
			}
		} else {
			header("location:?p=masuk");
		}
	} else {
		echo "<script>
		Swal.fire(
		'LOGIN GAGAL!',
		'Pastikan Sudah Verifikasi Email atau Pastikan NIP/NIM/Password Benar',
		'error',
		'1500'
		)
		;</script>";
		echo "<meta http-equiv='refresh' content='2;url=?p=masuk'>";
	}
}
?>