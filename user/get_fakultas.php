<?php
	define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB1', 'repositoryweb');
     
    // Buat Koneksinya
    $db1 = new mysqli(HOST, USER, PASS, DB1);
 
	echo "<option value=''>Pilih Provinsi</option>";
 
	$query = "SELECT * FROM fakultas";
    $dewan1 = $db1->prepare($query);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['id_fakultas'] . "'>" . $row['fakul'] . "</option>";
	}
?>