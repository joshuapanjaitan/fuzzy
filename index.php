<!DOCTYPE html>
<html>
<head>
	<title>Fuzzy Logic</title>
</head>

<?php 
//Configurasi database
	require 'function.php';
	//$karyawan = query("SELECT * FROM karyawan");
	$conn = mysqli_connect("localhost","root","","fuzzy");

 ?>

<?php if (isset($_POST["submit"])) { ?>

<?php 
	if($_FILES['file']['name']){
		$filename = explode('.',$_FILES['file']['name']);
		if($filename[1]=='csv'){
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			while($data = fgetcsv($handle)){
				$item1 = $data[0];
				$item2 = $data[1];
				$item3 = $data[2];
				$sql = "INSERT INTO `karyawan`(id,pendapatan,hutang) VALUES ('$item1','$item2','$item3')";
				mysqli_query($conn, $sql);
			}
			fclose($handle);
			print "import Done";
		}
	}
 ?>

<?php } else { ?>
	<p>Harap Inputkan Upload File</p>
<?php } ?>

<?php 
	$karyawan = query("SELECT * FROM karyawan");
	foreach ($karyawan as $row) {
	$pendapatan = $row['pendapatan'];
	$hutang = $row['hutang'];
	$id  = $row['id'];

	$psr = Psr($pendapatan);
	$pr = Pr($pendapatan);
	$plr = Plr($pendapatan);
	$ps = Ps($pendapatan);
	$pls = Pls($pendapatan);
	$pht = Pht($pendapatan);
	$pst = pst($pendapatan);

	$hr = Hr($hutang);
	$hlr = Hlr($hutang);
	$hs = Hs($hutang);
	$hls = Hls($hutang);
	$hht = Hht($hutang);
	$hhnt = Hhnt($hutang);
	$hst = Hst($hutang); 

//yes
	$Y1 = findMin($pr,$hst);
	$Y2 = findMin($plr, $hst);
	$Y3 = findMin($plr, $hst);
	$Y4 = findMin($pr, $hhnt);
	$Y5 = findMin($plr, $hhnt);
	$Y6 = findMin($psr, $hls);
	$Y7 = findMin($psr, $hht);
	$Y8 = findMin($psr, $hhnt);
	$Y9 = findMin($psr, $hst);
//yes

//Maybe Yes
	$My1 = findMin($pr, $hht);
	$My2 = findMin($plr, $hht);
	$My3 = findMin($ps, $hht);
	$My4 = findMin($pls, $hht);
	$My5 = findMin($pls, $hst);
	$My6 = findMin($pr, $hls);
	$My7 = findMin($ps ,$hhnt);
	$My8 = findMin($pls,$hhnt);
	$My9 = findMin($psr, $hlr);
	$My10 = findMin($psr, $hs);

//Maybe Yes


//maybe
	$M2 = findMin($plr, $hls);
	$M3 = findMin($ps, $hls);
	$M4 = findMin($pls, $hls);
	$M5 = findMin($pht, $hht);
	$M6 = findMin($pht, $hst);
	$M7 = findMin($pr, $hs);
	$M8 = findMin($pht, $hhnt);
	$M9 = findMin($psr, $hr);
//maybe

//Maybe no
	
	$Mn2 = findMin($plr, $hs);
	$Mn3 = findMin($ps, $hs);
	$Mn4 = findMin($pls, $hs);
	$Mn5 = findMin($pht, $hls);
	$Mn6 = findMin($pst, $hls);
	$Mn7 = findMin($pst, $hht);
	$Mn8 = findMin($pst, $hst);
	$Mn9 = findMin($pr, $hlr);
	$Mn10 = findMin($pst, $hhnt);
//Maybe No

//no
	$N1 = findMin($pr, $hr);
	
	$N3 = findMin($plr, $hr);
	$N4 = findMin($plr, $hlr);
	$N5 = findMin($ps, $hr);
	$N6 = findMin($ps, $hlr);
	$N7 = findMin($pls, $hr);
	$N8 = findMin($pls, $hlr);
	$N9 = findMin($pht, $hr);
	$N10 = findMin($pht, $hlr);
	$N11 = findMin($pht, $hs);
	$N12 = findMin($pst, $hr);
	$N13 = findMin($pst, $hlr);
	$N14 = findMin($pst, $hs);
//no

$yes = array($Y1,$Y2,$Y3,$Y4,$Y5,$Y6,$Y7,$Y8,$Y9);
$maybeYes = array($My6, $My2, $My3, $My4, $My5, $My1, $My7, $My8, $My9, $My10);
$maybe = array($M7,$M2,$M3, $My4, $M5, $M6, $M8, $M9);
$maybeNo = array($Mn9, $Mn2, $Mn3, $Mn4, $Mn5, $Mn6, $Mn7, $Mn8,$Mn10);
$no = array($N1,$N3,$N4,$N5,$N6,$N7, $N8,$N9,$N10,$N11,$N12,$N13,$N14);



$MaxYes = max($yes);
$MaxMaybeYes = max($maybeYes);
$MaxMay = max($maybe);
$MaxMaybeNo = max($maybeNo);
$MaxNo = max($no);

$score = score($MaxYes,$MaxMaybeYes,$MaxMay,$MaxMaybeNo,$MaxNo);

mysqli_query($conn,"UPDATE karyawan SET score ='$score' WHERE id = '$id'");


} ?>


<body>

	<?php 
		$blt = query("SELECT * FROM karyawan ORDER BY score DESC LIMIT 20");
	 ?>

	<form method="post" enctype="multipart/form-data">
			Upload CSV : <input type="file" name="file">	<br>
			<input type="submit" name="submit" value="Import">
	</form>


	<h1>Daftar Karyawan Yang dapat BLT</h1>

	<table border="1" cellpadding="10" cellspacing="0">
		
		<tr>
			<th>Id</th>
			<th>Pendapatan</th>
			<th>Hutang</th>
			<th>Score</th>
		</tr>
		<?php foreach ($blt as $key) { ?>
		<tr>
			<td><?= $key['id']; ?></td>
			<td><?= $key['pendapatan']; ?></td>
			<td><?= $key['hutang']; ?></td>
			<td><?=$key['score']; ?></td>
		</tr>
		<?php } ?>
	</table>

	<form method="post" action="excel.php">
		<input type="submit" name="export" value="Download File To Excel">
	</form>

	
</body>
</html>