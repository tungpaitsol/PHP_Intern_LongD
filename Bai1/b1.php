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
				<input type="text" name="nba" id="numbera" class="form-control">
			</div>
			<div class="form-group">
				<label for="numberb"> Nhập Số B</label>
				<input type="text" name="nbb" id="numberb" class="form-control">
			</div>
			<div class="form-group">
				<label for="numberc"> Nhập Số C</label>
				<input type="text" name="nbc" id="numberc" class="form-control">
			</div>
			
			<button type="submit" class="btn btn-primary">Tính</button>
		</form>
	

	<?php

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$nba = $_POST["nba"];
			$nbb = $_POST["nbb"];

			$nbc = ($_POST["nbc"]) == "" ? 0 : $_POST["nbc"];

			// if (!is_numeric($nba) || !is_numeric($nbb)|| !is_numeric($nbc)) {
			// 	echo("Yeu cau nhap so");
			// 	return;
			// }
			// 
			$varc = true;

			if (!is_numeric($nba)) {
				echo "A phải là số <br />";
				$varc = false;
			}

			if (!is_numeric($nbb)) {
				echo "B phải là số <br />";
				$varc = false;
			}

			if (!is_numeric($nbc)) {
				echo "C phải là số <br />";
				$varc = false;
			}

			

			if ($varc) {
				if ($nba == 0) {
					echo "Phuong trinh có nghiem x = " . (float)-$nbc/$nbb;
				} else {
					echo delta($nba, $nbb, $nbc);
				}
				
			}			
		}

		function delta($a, $b, $c) {
			$del = ($b*$b) - (4*$a*$c);
			$res = null;

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