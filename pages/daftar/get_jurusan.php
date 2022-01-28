<?php
$koneksi = mysqli_connect("localhost", "root", "", "repositoryweb");
$fakultas = $_POST["fakultas"];
if ($fakultas !== "") {
    $query = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE id_fakultas = '$fakultas' ");
    $output = '<option value="">--Pilih Jurusan--</option>';
    while ($row = mysqli_fetch_array($query)) {
        $output .= '<option value="' . $row["jur"] . '">' . $row["jur"] . '</option>';
    }
} else {
    $output = '<option value="">--Tolong pilih data--</option>';
}
echo  $output;
