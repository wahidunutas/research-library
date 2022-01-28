<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Research Library</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../../../assets/logo-title.png" />
    <script src="../../../../assets/dist/css/sweetalert2/sweetalert2.all.min.js"></script>

</head>

<body id="page-top">
    <?php
    include "../../../../user/pages/koneksi.php";
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $sql = "SELECT * FROM akses WHERE verif_code = '$code' ";

        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $id = $user['id_akses'];

            $sql = "UPDATE akses SET is_verif = 1 WHERE id_akses = '$id'";
            $query = mysqli_query($koneksi, $sql);
            if ($query) {
                echo "
            <script>
            Swal.fire(
                'Selamat!',
                'Kamu Telah Terkonfirmasi',
                'success'
                )
            </script>";
                echo "<meta http-equiv='refresh' content='3;url=../../../../index.php?p=masuk'>";
            } else {
                echo "verifikasi gagal : " . $query;
            }
        } else {
            echo "xxxx";
        }
    }
