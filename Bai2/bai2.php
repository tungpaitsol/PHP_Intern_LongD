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
				$arr_data = xdata($ipn);
				if ($arr_data !== 0) {
					foreach ($arr_data as $value) {
						echo($value . "<br />");
					}
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
			
			function xdata($value) {
				$arr1 = explode(',', $value);
				$c = count($arr1);
				$arr_output[$c] = "";

				foreach ($arr1 as $key1 => $var1) {
					$arr2 = explode('-', $var1);				
					$temp = $var1;

					if(count($arr2) !== 2) return 0;
					if (!is_numeric($arr2[0]) || !is_numeric($arr2[1]) || ($arr2[0] > $arr2[1])) return 0;

					for ($i=$arr2[0]; $i <= $arr2[1]; $i++) {
						if (soNguyenTo($i)) {
							$temp = $temp . " " .soNguyenTo($i);
						}
					}
					$arr_output[$key1] = $temp;
				}
				return $arr_output;
			}
		?>
	</div>
	
</body>
</html>