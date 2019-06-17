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
		    	<input type="text" value="<?php if(isset($_POST['inputScope'])) { echo htmlentities($_POST['inputScope']); } ?>" name="inputScope" class="form-control" id="input">
		  	</div>
		  	<input type="submit" name="findSNT" value="Tìm" class="btn btn-primary">
		</form>
		<br />
		<?php
			if (isset($_POST['findSNT'])){

				if (!isset($_POST['inputScope']) || $_POST['inputScope'] == '') {
					echo "Bạn chưa nhập";
					return;
				}

				$scope = $_POST['inputScope'];
				$arr_data = check_data($scope, ",", "-");
				if (empty($arr_data)) {
					echo("Sai dinh dang");
					return;
				}

				$arr_snt = find_snt($arr_data);
				if (empty($arr_snt)) {
					echo "Khong tim thay so nguyen to trong khoang";
					return;
				}

				echo "So nguyen to can tim: ";
				print_arr($arr_snt);
			}

			function soNguyenTo($var):bool 
			{
				if ($var < 2) {
					return false;
				}

			    for($i = 2; $i <= sqrt($var); $i++)
			   	{  
					if($var % $i == 0) return false;
			   	}
			  	return true;
			}			
			
			function check_data($value, $sym1, $sym2):array 
			{
				$arr1 = explode($sym1, $value);
				$arr_output = array();
				
				foreach ($arr1 as $key1 => $var1) {
					$arr2 = explode($sym2, $var1);

					if(count($arr2) !== 2) return $arr_output;
					if (!is_numeric($arr2[0]) || !is_numeric($arr2[1]) || ($arr2[0] > $arr2[1])) 
						return $arr_output;

					$arr2[0] = ceil($arr2[0]);
					$arr2[1] = floor($arr2[1]);
					array_push($arr_output, $arr2);
				}
				
				return $arr_output;
			}

			function find_snt($arr):array 
			{
				$arr_output = array();

				foreach ($arr as $var) {
					for ($i=$var[0]; $i <= $var[1]; $i++) {
						if (soNguyenTo($i) && !in_array($i, $arr_output)) {
							array_push($arr_output, $i);
						}
					}
				}

				return $arr_output;
			}

			function print_arr($arr) 
			{
				sort($arr);				
				foreach ($arr as $value) {
					echo($value. " ");
				}
			}

		?>
	</div>
	
</body>
</html>