<?php
	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Bai tap 3</title>
</head>
<body>
	<div class="content" style="width: 50%; margin: 20px auto">
		<form action="" method="POST" name="baitap3">
			<div class="form-group">
				<label for="inputIndexArr">Nhập số phần tử</label>
		    	<input type="text" value="<?php if(isset($_POST['indexArr'])) { echo htmlentities($_POST['indexArr']); } ?>" name="indexArr" class="form-control" id="inputIndexArr">
		  	</div>
		  	<div class="form-group-inline">
			  	<input type="submit" name="btnCreate" value="Tạo Mảng" class="btn btn-primary">
			  	<input type="submit" name="bntDivide" value="Chia Mảng" class="btn btn-secondary">
		  	</div>
		</form>

		<?php

			if (isset($_POST['btnCreate'])) {
				$indexed = $_POST['indexArr'];

				$get_err = checkErr($indexed);
				if ($get_err['stt'] == 0) {
					echo "<br />" .$get_err['message'];
					return;
				}

				$arr_create = arrCreate($indexed);
				$_SESSION['arrMain'] = $arr_create;

				var_dump($arr_create);
			}

			if (isset($_POST['bntDivide'])) {
				if (empty($_SESSION['arrMain'])) {
					echo "Chưa tạo mảng";
					return;
				}

				$arr_main = $_SESSION['arrMain'];
				$arr_divide = arrDivide($arr_main);

				var_dump($arr_divide);
			}

			function arrCreate($indexed):array
			{
				$scope_min = ceil($indexed/4);
				$scope_max = floor((3*$indexed)/4);
				$arr_rand = array();

				for ($i=0; $i < $indexed; $i++) {
					$push_rand = mt_rand(0, 1);
					$length_scope = mt_rand($scope_min, $scope_max);
					$element_rand = ($push_rand) ? randNumber($length_scope) : randString($length_scope);
					array_push($arr_rand, $element_rand);					
				}

				return $arr_rand;
			}

			function arrDivide($arr_rand):array
			{
				$arr_int = array();
				$arr_str = array();

				foreach ($arr_rand as $element) {
					is_string($element) ? array_push($arr_str, $element) : array_push($arr_int, $element);
				}

				return array('INT' => $arr_int, 'STR' => $arr_str);
			}

			function randNumber($length):int
			{				
				//$int_max = str_split(PHP_INT_MAX);
				$int_max = array_map('intval', str_split(PHP_INT_MAX));
				//var_dump($int_max[1]);
				$num_rand = mt_rand(1, $int_max[0]);

				if ($num_rand == $int_max[0] && $length == strlen(PHP_INT_MAX)) {
					for ($i=1; $i < $length; $i++) {
						$num_rand .= mt_rand(0, $int_max[$i]);
					}
					return $num_rand;
				}

				while (strlen($num_rand) < $length) {
					$num_rand .= mt_rand(0, 9);
				}

				return $num_rand;
			}

			function randString($length):string
			{
				$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$chars_length = strlen($chars);
				$str_rand = '';

				for ($i=0; $i < $length; $i++) { 
				 	$str_rand .= $chars[mt_rand(0, $chars_length - 1)];        			
				} 

				return $str_rand;
			}

			function checkErr($indexed):array
			{
				if ($indexed == '') {
					return array('stt' => 0, 'message' => 'Chưa nhập số phần tử');
				}

				if (!is_numeric($indexed) || !is_int($indexed)) {
					return array('stt' => 0, 'message' => 'Yêu cầu nhập số nguyên');
				}

				if ($indexed <= 1) {
					return array('stt' => 0, 'message' => 'Số phần tử phải là số lớn hơn 1');
				}

				if (floor(($indexed*3)/4) > strlen(PHP_INT_MAX)) {
					return array('stt' => 0, 'message' => 'Số phần tử phải là số nhỏ hơn ' .ceil(strlen(PHP_INT_MAX)/(3/4) + 1));
				}				
				
				return array('stt' => 1);
			}
			
		?>
	</div>
	

</body>
</html>
