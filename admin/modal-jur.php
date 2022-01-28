<?php  
if(isset($_POST["data_id"])){
	$data_id = $_POST["data_id"];
	$output = "";
	$connect = mysqli_connect('localhost', 'root', '', 'repositoryweb');  
	$query = "SELECT * FROM jurusan JOIN fakultas ON fakultas.id_fakultas=jurusan.id_fakultas WHERE jurusan.id_fakultas = '$data_id' ";  
	$result = mysqli_query($connect, $query); 
	$output .= ' <ul class="list-group list-group-flush">'; 
	while($row = mysqli_fetch_assoc($result)){
     $output .= '  
		<li class="list-group-item"><i class="fas fa-angle-right"></i> '.$row["jur"].'</li>
          ';
	}
$output .= "</ul>";  
echo $output;  
}
 
?>