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
			<input type="submit" name="btnCal" value="Tính" class="btn btn-primary">
		</form>	
		<br />
	<?php

		if (isset($_POST['btnCal'])) {
			$a = $_POST['a'] == "" ? 0 : $_POST['a'];
			$b = $_POST['b'] == "" ? 0 : $_POST['b'];
			$c = $_POST['c'] == "" ? 0 : $_POST['c'];

			$get_err = check_err($a, $b, $c);
			if (!empty($get_err)) {
				foreach ($get_err as $err) {
					echo $err. "<br />";
				}
				return;
			}
				
			$get_ptbh = ptbh($a, $b, $c);
			switch ($get_ptbh['stt']) {
				case -1:
					echo "Phuong trinh vo nghiem";
					break;
				case 0:
					echo "Phuong trinh co nghiem x = " .$get_ptbh['x1'];
					break;
				case 1:
					echo "Phuong trinh co 2 nghiem <br />x1 = " . $get_ptbh['x1']. "<br />x2 = " . $get_ptbh['x2'];
					break;
				// case 2:
				// 	echo "Phuong trinh co vo so nghiem";
				// 	break;						
				default:				
					break;
			}
				
			
		}

		function check_err($a, $b, $c): array {
			$err = array();
			if(empty($a) && empty($b) && empty($c)) {
				array_push($err, "Yeu cau nhap so");
				return $err;
			}

			if(!is_numeric($a)) {
				array_push($err, "A phai la so");
			}

			if(!is_numeric($b)) {
				array_push($err, "B phai la so");
			}

			if(!is_numeric($c)) {
				array_push($err, "C phai la so");
			}

			return $err;

		}
		
		function ptbh($a, $b, $c) {
			
			// if ($a == 0 && $b == 0 && $c == 0) {
			// 	return arr_fmt(2);
			// }

			if ($a == 0 && $b == 0 && $c !== 0) {
				return arr_fmt(-1);
			}

			if ($a == 0 && $b !== 0 ) {
				$x = -$c/$b;
				return arr_fmt(0, $x, $x);
			}

			$delta = $b*$b - 4*$a*$c;
			if ($delta < 0) {
				return arr_fmt(-1);
			} elseif ($delta == 0) {
				$x = (-$b)/(2*$a);
				return arr_fmt(0, $x, $x);
			} else {
				$x1 = ($b + sqrt($delta))/(2 * $a);
				$x2 = ($b - sqrt($delta))/(2 * $a);
				return arr_fmt(1, $x1, $x2);
			}
		}

		function arr_fmt($stt, $x1 = null, $x2 = null) {
			return array('stt' => $stt, 'x1' => $x1, 'x2' => $x2);
		}
	?>

	</div>
</body>
</html>