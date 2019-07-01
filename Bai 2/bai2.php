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
				$get_scope = checkScope($scope, ",", "-");
				if (empty($get_scope)) {
					echo("Sai dinh dang");
					return;
				}

				$get_snt = findSNT($get_scope);
				if (empty($get_snt)) {
					echo "Khong tim thay so nguyen to trong khoang";
					return;
				}

				echo "So nguyen to can tim: ";
				echo implode(" ", $get_snt);
			}

			function soNguyenTo($number):bool
			{
				if ($number < 2) {
					return false;
				}

			    for($i = 2; $i <= sqrt($number); $i++)
			   	{  
					if($number % $i == 0) return false;
			   	}
			  	return true;
			}			
			
			function checkScope($scope, $sym1, $sym2):array 
			{
				$split_scope = explode($sym1, $scope);
				if (empty($split_scope)) {
					return array();
				}

				$scope_output = array();
				
				foreach ($split_scope as $child_scope) {
					$child_scope = explode($sym2, $child_scope);

					if(count($child_scope) !== 2) return array();
					if (!is_numeric($child_scope[0]) || !is_numeric($child_scope[1]) || ($child_scope[0] > $child_scope[1]))
						return array();

					$child_scope[0] = (int)ceil($child_scope[0]);
					$child_scope[1] = (int)floor($child_scope[1]);
					array_push($scope_output, $child_scope);
				}
				
				return $scope_output;
			}

			function findSNT($scope):array 
			{
				$snt_array = array();
				foreach ($scope as $child_scope) {
					for ($i=$child_scope[0]; $i <= $child_scope[1]; $i++) {
						if (!soNguyenTo($i) || in_array($i, $snt_array)) continue;
						array_push($snt_array, $i);					
					}
				}

				sort($snt_array);
				return $snt_array;
			}

		?>
	</div>
	
</body>
</html>