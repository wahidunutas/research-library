<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
            <h3><?= $data_mhs;?></h3>
                <p>Data Civitas Akademik</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <a href="" class="small-box-footer"></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $data_jurnal ;?></h3>
                <p>Data Jurnal</p>
            </div>
            <div class="icon">
                <i class="fas fa-journal-whills"></i>
            </div>
            <a href="" class="small-box-footer"></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
            <h3><?= $data_app;?></h3>
                <p>Data Ilmiah Approved</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <a href="" class="small-box-footer"></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
            <h3><?= $data_pend;?></h3>

            <p>Data Ilmiah Pending</p>
            </div>
            <div class="icon">
            <i class="fas fa-spinner"></i>
            </div>
            <a href="" class="small-box-footer"></a>
        </div>
    </div>  
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">Downloads Chart</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
            <div class="chart">
            <!-- id="lineChart" -->
                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
    <!-- LINE CHART -->
    <div class="card card-primary card-outline">
            <div class="card-header">
            <h3 class="card-title">
                <i class="far fa-chart-bar"></i>
                Dokumen Chart
            </h3>
    
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
            <div id="bar-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
        </div>
    </div>
</div>
