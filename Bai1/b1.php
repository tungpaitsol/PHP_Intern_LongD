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
			$a = $_POST['a'];
			$b = $_POST['b'];
			$c = $_POST['c'];

			if($a !== "" || $b !== "" || $c !== "") {
				
				$a = $a == "" ? 0 : $a;
				$b = $b == "" ? 0 : $b;
				$c = $c == "" ? 0 : $c;

				if(!is_numeric($a)) {
					echo "A phai la so <br />";
				}

				if(!is_numeric($b)) {
					echo "B phai la so <br />";
				}

				if(!is_numeric($c)) {
					echo "C phai la so <br />";
				}

				if (is_numeric($a) && (is_numeric($b) && is_numeric($c))) { 
					
					$var = ptbh($a, $b, $c);
					switch ($var['stt']) {
						case -1:
							echo "Phuong trinh vo nghiem";
							break;
						case 0:
							echo "Phuong trinh co nghiem x = " .$var['x1'];
							break;
						case 1:
							echo "Phuong trinh co 2 nghiem <br />x1 = " . $var['x1']. "<br />x2 = " . $var['x2'];
							break;
						case 2:
							echo "Phuong trinh co vo so nghiem";
							break;						
						default:
						
							break;
					}
					
				}
			} else {
				echo "Hay nhap so";
			}
		}
		
		/**
		 * ptbh
		 *
		 * @param [number] $a
		 * @param [number] $b
		 * @param [number] $c
		 * @return array
		 */
		function ptbh($a, $b, $c) {
			
			if ($a == 0 && $b == 0 && $c == 0) {
				return array('stt' => 2, 'x1' => null, 'x2' => null);
			}

			if ($a == 0 && $b == 0 && $c !== 0) {
				return array('stt' => -1, 'x1' => null, 'x2' => null);
			}

			if ($a == 0 && $b !== 0 ) {
				$x = -$c/$b;
				return array('stt' => 0, 'x1' => $x, 'x2' => $x);
			}

			$delta = $b*$b - 4*$a*$c;
			if ($delta < 0) {
				return array('stt' => -1, 'x1' => null, 'x2' => null);
			} elseif ($delta == 0) {
				$x = (-$b)/(2*$a);
				return array('stt' => 0, 'x1' => $x, 'x2' => $x);
			} else {
				$x1 = ($b + sqrt($delta))/(2 * $a);
				$x2 = ($b - sqrt($delta))/(2 * $a);
				return array('stt' => 0, 'x1' => $x1, 'x2' => $x2);
			}
		}
	?>

	</div>
</body>
</html>