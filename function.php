<?php 
	$conn = mysqli_connect("localhost","root","","fuzzy");


	function query($query){
		global $conn;

		$result = mysqli_query($conn, $query);
		$rows = [];
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}

		return $rows;

	}

	


// Function Membership Untuk Pendapatan Pr, Plr, Ps, Pls ,Pht, Pst
//P huruf besar artinya pendapatan, jika terdapat huruf kecil setelahnya 
//r = rendah
//lr = lumayan rendah
//s = sedang
//ls = lumayan sedang
//ht = hampir tinggi
//st = sudah tinggi 


	function Psr($pendapatan){ //Pendapatan sangat rendah
		if($pendapatan<0.2){
			$x = 1;
		}else if($pendapatan>=0.2 && $pendapatan<=1.6){
			$atas = 1.6 - $pendapatan;
			$bawah = 1.6 - 0.2;
			$x = $atas/$bawah;
		}else{
			$x = 0;
		}
		return $x;
	}

	function Pr($pendapatan){  //Pendapatan Rendah
		if($pendapatan <= 0.4){
			$x = 1;
		}else{
			if($pendapatan>0.4 && $pendapatan<1.8){
				$atas = 1.9 - $pendapatan;
				$bawah = 1.9 - 0.4;
				$x = $atas/$bawah;
			}else{
				$x = 0;
			}
			
		}
		return $x;
	}

	function Plr($pendapatan){  //Pendapatan lumayan rendah
		if($pendapatan > 0.4 && $pendapatan < 0.6){
			$x = 1;
		}else{
			if($pendapatan<=0.4){
				$atas = $pendapatan;
				$bawah = 0.4;

				$x = $atas/$bawah;
			}else if($pendapatan>=0.6 && $pendapatan<=1.8){
				$atas = 1.8 - $pendapatan;
				$bawah = 1.8 - 0.6;

				$x = $atas/$bawah;
			}else{
				$x= 0;
			}
		}
		return $x;
	}


	function Ps($pendapatan){ // sedang
		if($pendapatan>0.7 && $pendapatan<1.2){
			$x = 1;
		}else{
			if($pendapatan<=0.7){
				$atas = $pendapatan;
				$bawah = 0.7;

				$x = $atas/$bawah;
			}if($pendapatan>=1.2){
				$atas = 1.9 - $pendapatan;
				$bawah = 1.9 - 1.2;
				$x = $atas/$bawah;
			}

		}
		return $x;
	} 


	function Pls($pendapatan){ //Pendapatan lumayan sedang
		if($pendapatan>=0.8 && $pendapatan<1.4){
			$x= 1;
		}else{
			if($pendapatan<0.8){
				$atas = $pendapatan;
				$bawah = 0.8;
				$x= $atas/$bawah;
			}else{
				$atas = 1.9 - $pendapatan;
				$bawah = 1.9- 1.4;
				$x = $atas/$bawah;
			}
		}
		return $x;
	}

	function Pht($pendapatan){ //pendapatan hampir Tinggi
		if($pendapatan>1 && $pendapatan<1.7){
			$x = 1;
		}else{
			if($pendapatan<=1  && $pendapatan>=0.1){
				$atas = $pendapatan - 0.1;
				$bawah = 1 - 0.1;
				$x= $atas/$bawah;
			}if($pendapatan>=1.7){
				$atas =1.9 - $pendapatan;
				$bawah = 1.9 - 1.7;

				$x = $atas/$bawah;
			}else{
				$x = 0;
			}
		}
		return $x;
	}

	function Pst($pendapatan){ //pendapatan sudah tinggi
		if($pendapatan>1.7){
			$x=1;
		}else{
			if($pendapatan<=1.7 &&$pendapatan>0.4){
				$atas = $pendapatan - 0.4;
				$bawah = 1.7 - 0.4;
				$x = $atas/$bawah;

			}else{
				$x = 0;
			}
		}
		return $x;
	}

// End Of Function Membership Untuk Pendapatan 



//Function Membership Untuk Hutang Hr, Hlr, Hs, Hls, Hht, Hst

	function Hr($hutang){ // Hutang Rendah  
		if($hutang<= 10){
			$x = 1;
		}else{
			if($hutang>10 && $hutang<=90){
				$atas = 90 - $hutang;
				$bawah = 90-10;

				$x = $atas/$bawah;

			}else{
				$x = 0;
			}
		}
		return $x;
	}

	function Hlr($hutang){ //Hutang lumayan rendah
		if($hutang > 15 && $hutang < 20 ){
			$x = 1;
		}else{
			if($hutang<=15){
				$atas = $hutang;
				$bawah  =15;

				$x = $atas/$bawah;
			}if($hutang >=20 && $hutang<=90){
				$atas = 90-$hutang;
				$bawah = 90-20;

				$x = $atas/$bawah;
			}else{
				$x = 0;
			}
		}
		return $x;
	}


function Hs($hutang){ //Hutang Sedang
	if($hutang>17 && $hutang<30){
		$x =1;
	}else{
		if($hutang<=17){
			$atas = $hutang;
			$bawah = 17;

			$x = $atas/$bawah;
		}if($hutang>=30 && $hutang<=90){
			$atas = 90 - $hutang;
			$bawah = 90-30;

			$x = $atas/$bawah;
		}else{
			$x= 0;
		}

	}
	return $x;
}

function Hls($hutang){ //Hutang lumayan sedang
	if($hutang>21 && $hutang<40){
		$x = 1;
	}else{
		if($hutang <= 21){
			$atas = $hutang;
			$bawah = 21;

			$x = $atas/$bawah;
		}if($hutang>=40){
			$atas = 98- $hutang;
			$bawah = 98 - 40;
			$x= $atas/$bawah;
		}
	}
	return $x;
}

function Hht($hutang){ //hutang hampir tinggi
	if($hutang>40 && $hutang<60){
		$x = 1;
	}else{
		if($hutang<=40){
			$atas = $hutang;
			$bawah = 40;
			$x = $atas/$bawah;
		}else{
			$atas = 98- $hutang;
			$bawah = 98- 60;
			$x = $atas/$bawah;
		}
	}
	return $x;
}

function Hhnt($hutang){ //hutang nyaris tinggi
	if($hutang>60 && $hutang<80){
		$x = 1;
	}else{
		if($hutang<=60 && $hutang >=10){
			$atas = 60 - $hutang;
			$bawah = 60 - 10;
			$x = $atas/$bawah;
		}if($hutang >= 80){
			$atas = 98 - $hutang;
			$bawah = 98 - 80;
			$x = $atas/$bawah;
		}else{
			$x = 0;
		}
	}
	return $x;
}

function Hst($hutang){ //Hutang sudah tinggi
	if($hutang>80){
		$x= 1;
	}else{
		if($hutang<=80 && $hutang>=10){
			$atas = $hutang -10;
			$bawah= 80-10;

			$x = $atas/$bawah;
		}else{
			$x = 0;
		}
	}
	return $x;
}
//End Of Function Membership Untuk Hutang Hr, Hs, Hl, Ht

//Function menentukan nilai Inference
function findMin($a, $b){
	if($a<=$b){
		return $a;
	}else{
		return $b;
	}
}

//End OF function menentukan nilai Inference


//function menghitung score dengan metode sugeno

function score($yes,$mayYes,$maybe,$mayNo,$no){
	$iNo = 30*$no;
	$iMayNo = 45*$mayNo;
	$iMaybe = 60*$maybe;
	$iMayYes = 75*$mayYes;
	$iYes = 100*$yes;

	$tot = $yes+$maybe+$no+$mayYes+$mayNo;

	$atas = $iNo+$iMaybe+$iYes+$iMayYes+$iMayNo;

	$score = $atas/$tot;

	return $score; 
}


 ?>