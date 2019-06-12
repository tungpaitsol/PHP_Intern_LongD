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
				<input type="text" value="<?php if(isset($_POST['a'])) { echo htmlentities($_POST['a']);} ?>" name="a" id="numbera" class="form-control">
			</div>
			<div class="form-group">
				<label for="numberb"> Nhập Số B</label>
				<input type="text" value="<?php if(isset($_POST['b'])) { echo htmlentities($_POST['b']);} ?>" name="b" id="numberb" class="form-control">
			</div>
			<div class="form-group">
				<label for="numberc"> Nhập Số C</label>
				<input type="text" value="<?php if(isset($_POST['c'])) { echo htmlentities($_POST['c']);} ?>" name="c" id="numberc" class="form-control">
			</div>			
			<button type="submit" class="btn btn-primary">Tính</button>
		</form>	

	<?php

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$a = ($_POST["a"] == "") ? 0 : $_POST["a"];
			$b = ($_POST["b"] == "") ? 0 : $_POST["b"];
			$c = ($_POST["c"] == "") ? 0 : $_POST["c"];

			if (check_err($a, $b, $c)) {
				if ($a == 0) {
					if ($b == 0) {
						$resVal = ($c == 0) ? "Phuong trinh co vo so nghiem" : "Phuong trinh vo nghiem" ;
						echo $resVal;
					} else {
						echo "Phuong trinh có nghiem x = " . (float)(-$c)/$b;
					}
				} else {
					echo delta($a, $b, $c);
				}				
			}			
		}

		function delta($a, $b, $c) {
			$a = $a ?? 0;
			$b = $b ?? 0;
			$c = $c ?? 0;

			$del = ($b*$b) - (4*$a*$c);
			$res = null;

			if ($del < 0) {
				$res = "Phuong trinh vo nghiem";
			} elseif ($del == 0) {
				$x = (float)$b/(2*$a);
				$res = "Phuong trinh co nghiem kep: x1 = x2 = " . (-$x);
			} elseif ($del > 0) {
				$x = (float)($b + sqrt($del))/(2 * $a);
				$y = (float)($b - sqrt($del))/(2 * $a);
				$res = "Phuong trinh co 2 nghiem <br />x1 = " . $x . " <br /> x2 = " . $y;
			}
			return $res;
		}

		function check_err($a, $b, $c) {
			$err = "";

			if ($a == "" && $b == "" && $c == "") {
				echo "Xin hay nhap so <br />";
				return 0;
			}

			if (!is_numeric($a)) $err = $err . "A phải là số <br />";
			if (!is_numeric($b)) $err = $err . "B phải là số <br />";
			if (!is_numeric($c)) $err = $err . "C phải là số <br />";

			if ($err !== "") {
				echo $err;
				return 0;
			}

			return 1;
		}

	?>

	</div>
</body>
</html>