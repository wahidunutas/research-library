<?php
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB1', 'repositoryweb');
     
    // Buat Koneksinya
    $db1 = new mysqli(HOST, USER, PASS, DB1);

	$provinsi = $_POST['provinsi'];
 
	echo "<option value=''>Pilih Kabupaten</option>";
 
	$query = "SELECT * FROM jurusan WHERE id_fakultas=? ";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("i", $provinsi);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['id_jurusan'] . "'>" . $row['jur'] . "</option>";
	}
?>