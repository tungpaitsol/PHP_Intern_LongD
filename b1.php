<!DOCTYPE html>
<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Giai Phuong Trinh Bac 2</title>
</head>
<body>

	<div class="content" style="width: 50%; margin: 20px auto">
		<form action="b1.php" method="POST" name="ptbh">
			<div class="form-group">
				<label for="numbera"> Nhập Số A</label>
				<input type="number" name="nba" id="numbera" class="form-control">
			</div>
			<div class="form-group">
				<label for="numberb"> Nhập Số B</label>
				<input type="number" name="nbb" id="numberb" class="form-control">
			</div>
			<div class="form-group">
				<label for="numberc"> Nhập Số C</label>
				<input type="number" name="nbc" id="numberc" class="form-control">
			</div>
			
			<button type="submit" class="btn btn-primary">Tinh</button>
		</form>
	

	<?php

		if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nba"]) && !empty($_POST["nbb"]) && !empty($_POST["nbc"])) {

			$nba = $_POST["nba"];
			$nbb = $_POST["nbb"];
			$nbc = $_POST["nbc"];

			if (check_input($nba) && check_input($nbb) && check_input($nbc)) {				
				echo delta($nba, $nbb, $nbc);
			} else {
				echo "Nhap phai la so";
			}

		} else {
			echo "Nhap lai";
		}

		function check_input($var) {
			//var_dump($var);			
			return is_numeric($var);
			
		}

		function delta($a, $b, $c) {
			$del = ($b*$b) - (4*$a*$c);
			//echo $a . $b . $c . $del;
			$res = "";
			if ($del < 0) {
				$res = "Phuong trinh vo nghiem";
			} elseif ($del == 0) {
				$x = (float)$b/(2*$a);
				$res = "Phuong trinh co nghiem kep: x1 = x2 = " . -$x;
			} elseif ($del > 0) {
				$x = (float)($b + sqrt($del))/(2 * $a);
				$y = (float)($b - sqrt($del))/(2 * $a);
				$res = "Phuong trinh co 2 nghiem <br />x1 = " . $x . " <br /> x2 = " . $y;
			}

			return $res;
		}



	?>
	</div>
</body>
</html>