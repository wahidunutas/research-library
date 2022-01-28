<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Karya Ilmiah</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pending" data-toggle="pill" href="#home-pending" role="tab" aria-controls="home-pending" aria-selected="true">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="acc" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">Disetujui</a>
            </li>
            <!-- <li class="nav-item"> -->
            <a class="nav-link" href="?p=dokumen&aksi=seeall">Lihat Semua</a>
            <!-- </li> -->

        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="home-pending" role="tabpanel" aria-labelledby="pending">
               <?php include "pending.php";?>
            </div>

            <!-- PENDING -->
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="acc">
                <?php include "acc.php";?>
            </div>

            
        </div>
    </div>
</div>
<!-- /.card -->