<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Admin Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=dataadmin">Home</a></li>
                    <li class="breadcrumb-item active"><?= $page; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<form action="pages/data_admin/tambah_admin/proses.php" method="post">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" required placeholder="Enter Nama">
                    </div>
                    <div class="form-group">
                        <label>Nip</label>
                        <input type="text" class="form-control" name="nip" required placeholder="Enter NIP">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" class="form-control" name="no" placeholder="Enter No Telepon">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" required placeholder="Ex. Mahasiswa,Dosen, Lainya">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="pw" required placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input type="password" class="form-control" name="pw2" required placeholder="Ulangi Password">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="status" value="admin">
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="?p=dataadmin" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <img src="../assets/dist/img/no image.jpg" alt="" style="width:270px;" id="uploadPreviewDB">
                <div class="form-group">
                    <label>Upload PRofile</label>
                    <input type="file" class="form-control" id="uploadImageDB" onchange="PreviewImageDB();" name="profile" >
                </div>
            </div>
        </div> -->
        </div>
    </div>
</form>