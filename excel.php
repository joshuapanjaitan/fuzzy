<?php 
	$conn = mysqli_connect("localhost","root","","fuzzy");
	$output= '';

	if(isset($_POST["export"])){
		$sql = "SELECT id FROM karyawan ORDER BY score DESC LIMIT 20";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result)>0){
			$output = 'ID
			'
			;
			while($row = mysqli_fetch_array($result)){
				$output .= ''.$row["id"].'
				';
			}
			
			header("Content-Type: application/csv");
			header("Content-Disposition: attachment; filename=TebakanTugas2.csv");
			echo  $output;
		}
	}

 ?>