$( document ).ready(function() {
    //untuk memanggil plugin select2
   $('#fakultas').select2({
      placeholder: 'Pilih Fakultas',
    });
    $('#jurusan').select2({
       placeholder: 'Pilih Jurusan',
    });
   
    //saat pilihan provinsi di pilih, maka akan mengambil data kota
    //di data-wilayah.php menggunakan ajax
    $.ajax({
        type: 'POST',
          url: "get_fakultas.php",
          cache: false, 
          success: function(msg){
          $("#fakultas").html(msg);
        }
    });

      $("#fakultas").change(function(){
      var provinsi = $("#fakultas").val();
          $.ajax({
              type: 'POST',
              url: "get_jurusan.php",
              data: {provinsi: provinsi},
              cache: false,
              success: function(msg){
              $("#jurusan").html(msg);
            }
        });
    });
});