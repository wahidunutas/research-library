<?php 
$koneksi = mysqli_connect("localhost", "root", "", "repositoryweb");
$query = mysqli_query($koneksi, "SELECT * FROM fakultas ORDER BY id_fakultas");
$output = '<option value="">--Pilih Fakultas--</option>';
while($row = mysqli_fetch_array($query)){
	$output .= '<option value="'.$row["id_fakultas"].'">'.$row["fakul"].'</option>';
}
echo $output;
