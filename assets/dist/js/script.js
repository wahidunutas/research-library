$('.btn-del').on('click', function (e){
    e.preventDefault();
    const href = $(this).attr('href')
  
    Swal.fire({
        title: 'Yakin Ingin Menghapus Data Ini?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'IYA',
        cancelButtonText: 'BATAL'
    }).then((result) => {
        if(result.value) {
            document.location.href = href;
        }
    })
  })

// PREVIEW DATA 
function PreviewImageDB() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImageDB").files[0]);
    oFReader.onload = function (oFREvent)
    {
        document.getElementById("uploadPreviewDB").src = oFREvent.target.result;
    };
};

// $(function () {
//     $('.select2').select2()
//     $('.select2bs4').select2({
//     theme: 'bootstrap4'
//     })
// });


// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function(){
    $("#xxx").click(function(){
        $('#xxx').tooltip("toggle");
    });
  });

// show password
function show(){
    var pswrd = document.getElementById('pswrd');
    var icon = document.querySelector('.fas');
    if (pswrd.type === "password") {
        pswrd.type = "text";
    }else{
        pswrd.type = "password";
        icon.style.color = "grey";
    }
}

