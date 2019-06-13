<!DOCTYPE html>
<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Bai tap 2</title>
</head>
<body>
	<div class="content" style="width: 50%; margin: 20px auto">
		<form action="b2.php" method="POST" name="baitap2">
			<div class="form-group">
				<label for="input">Nhap khoang so</label>
		    	<input type="text" value="<?php if(isset($_POST['input1'])) { echo htmlentities($_POST['input1']); } ?>" name="input1" class="form-control" id="input">
		  	</div>
		  	<button type="submit" class="btn btn-primary">Check</button>
		</form>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST"){

				if ($_POST["input1"] == "") {
					echo "Bạn chưa nhập";
					die();
				}

				$ipn = $_POST["input1"];
				$arr_data = check_data($ipn, ",", "-");
				$arr_snt = find_snt($arr_data);

				if (!empty($arr_data) && !empty($arr_snt)) {
					echo "So nguyen to can tim: ";
					foreach ($arr_snt as $value) {
						echo($value. " ");
					}
				} elseif (!empty($arr_data) && empty($arr_snt)) {
					echo "Khong tim thay so nguyen to trong khoang";
				} else {
					echo("Sai dinh dang");
				}
			}

			function soNguyenTo($var) {
				if ($var < 2) {
					return 0;
				}

			    for($i = 2; $i <= sqrt($var); $i++)  
			   	{  
					if($var % $i == 0) return 0;
			   	}
			  	return $var;
			}			
			
			function check_data($value, $sym1, $sym2) {
				$arr1 = explode($sym1, $value);
				$arr_output = array();
				
				foreach ($arr1 as $key1 => $var1) {
					$arr2 = explode($sym2, $var1);

					if(count($arr2) !== 2) return $arr_output;
					if (!is_numeric($arr2[0]) || !is_numeric($arr2[1]) || ($arr2[0] > $arr2[1])) return $arr_output;

					array_push($arr_output, $arr2);
				}
				
				return $arr_output;
			}

			function find_snt($arr) {
				$arr_output = array();

				foreach ($arr as $var) {
					for ($i=$var[0]; $i <= $var[1]; $i++) {
						if (soNguyenTo($i)) {
							array_push($arr_output, soNguyenTo($i));
						}
					}
				}

				return $arr_output;
			}
		?>
	</div>
	
</body>
</html>