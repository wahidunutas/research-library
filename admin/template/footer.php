<footer class="main-footer">
  <strong>&copy; 2021 <a href="../index.php">Research Library</a>.</strong>
  All Rights Reserved
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<script src="../assets/dist/js/script.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/plugins/jquery.flot.pie.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script type="text/javascript" src="../assets/ck/ckeditor.js"></script>

<script>
  $(function() {
    <?php
    $no = 1;
    $sql = $koneksi->query("SELECT * FROM tipe ");
    while ($tipe = $sql->fetch_assoc()) {
      $no++;
      $datatipe[] = $tipe;
    }
    ?>
    var bar_data = {
      data: [
        // [1, <?php
        //     $jumlah_skripsi = mysqli_query($koneksi, "SELECT * FROM info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe where tipe.nama_tipe='Skripsi'");
        //     echo mysqli_num_rows($jumlah_skripsi);
        //     ?>],
        // [2, <?php
        //     $tesis = mysqli_query($koneksi, "SELECT * FROM info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe where tipe.nama_tipe='Thesis'");
        //     echo mysqli_num_rows($tesis);
        //     ?>],
        // [3, <?php
        //     $jurnal = mysqli_query($koneksi, "SELECT * FROM jurnal");
        //     echo mysqli_num_rows($jurnal);
        //     ?>],
        // [4, <?php
        //     $magang = mysqli_query($koneksi, "SELECT * FROM info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe where tipe.nama_tipe='Laporan Magang'");
        //     echo mysqli_num_rows($magang);
        //     ?>]
        <?php foreach($datatipe as $key => $value):?>
        <?php $x = $value['nama_tipe'];?>
          [<?= $key;?>, <?php
            if($x !== 'Jurnal'){
              $jumlah_skripsi = mysqli_query($koneksi, "SELECT * FROM info_doc JOIN tipe ON tipe.id_tipe=info_doc.id_tipe WHERE tipe.nama_tipe='$x'");
              echo mysqli_num_rows($jumlah_skripsi);
            }else{
              $jurnal = mysqli_query($koneksi, "SELECT * FROM jurnal");
              echo mysqli_num_rows($jurnal);
            }
            ?>],
        <?php endforeach;?>
      ],
      bars: {
        show: true
      }
    }
    $.plot('#bar-chart', [bar_data], {
      grid: {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor: '#f3f3f3'
      },
      series: {
        bars: {
          show: true,
          barWidth: 0.5,
          align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis: {
        ticks: [
          <?php foreach($datatipe as $key => $value):?>
            [<?= $key;?>, '<?= $value['nama_tipe'];?>'],
          <?php endforeach;?>
          
        ]
      }
    })
    /* END BAR CHART */
  })
</script>
<script>
  $(function() {
    var areaChartData = {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Agus", "Sept", "Okt", "Nov", "Des"],
      datasets: [{
          label: 'Downloads',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: true,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: <?php
                for ($bulan = 1; $bulan < 13; $bulan++) {
                  $query = $koneksi->query("SELECT sum(jml) AS jml FROM downloads WHERE MONTH(date)= '$bulan' ");
                  $row = mysqli_fetch_array($query);
                  $data[] = $row["jml"];
                }
                echo json_encode($data);
                ?>
        },
        {
        }
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio: true,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: true,
          }
        }],
        yAxes: [{
          gridLines: {
            display: true,
          }
        }]
      }
    }

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })


    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
<script>
  $(function() {
    // Summernote
    $('#summernote').summernote({
      height: 130,
    })

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<script>
  $(document).ready(function() {
    $('.view_data').click(function() {
      var data_id = $(this).data("id")
      $.ajax({
        url: "modal-jur.php",
        method: "POST",
        data: {
          data_id: data_id
        },
        success: function(data) {
          $("#jur").html(data)
          $("#dataJur").modal('show')
        }
      })
    })
  })
</script>
</body>

</html>