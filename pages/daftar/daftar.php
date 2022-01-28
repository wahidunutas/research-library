<?php

?>
<div class="row">
	<div class="col">
		<div class="wrap-login100">
			<form class="login100-form validate-form" method="post" action="pages/daftar/daftarProses.php">
				<div class="wrap-input100 validate-input m-b-26" data-validate="Nama is required">
					<span class="label-input100">Nama</span>
					<input class="input100" type="text" name="nama" placeholder="Enter Nama">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-26" data-validate="Nip is required">
					<span class="label-input100">NIM</span>
					<input class="input100" type="text" name="nip" placeholder="Enter NIM">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 validate-input m-b-26" data-validate="Fakultas is required">
					<span class="label-input100">Fakultas</span>
					<select class="form-control form-control-sm" name="fakultas" id="fakultasDaftar">
						<option>-Pilih-</option>
					</select>
				</div>
				<div class="wrap-input100 validate-input m-b-26" data-validate="Fakultas is required">
					<span class="label-input100">Jurusan</span>
					<select class="form-control form-control-sm" name="jurusan" id="jurusanDaftar">
						<option>-Pilih-</option>
					</select>
				</div>

				<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
					<span class="label-input100">Email</span>
					<input class="input100" type="email" name="email" placeholder="Enter Email">
					<span class="focus-input100"></span>
				</div>

				<div class="row">
					<div class="col">
						<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
							<span class="label-input100">Password</span>
							<input class="input100" type="password" name="pw" placeholder="Enter Password">
							<span class="focus-input100"></span>
						</div>
					</div>
					<div class="col">
						<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
							<input class="input100" type="password" name="pw2" placeholder="Ulangi Password">
							<span class="focus-input100"></span>
						</div>
					</div>
				</div>
				<input type="hidden" name="role" value="Mahasiswa">

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit" name="daftar">
						Daftar
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-4 ml-4 mt-2">
		<h3>Sudah Mempunyai Akun?<br> </h3>
		<a href="?p=masuk">Login!</a>
	</div>
</div>
</div>