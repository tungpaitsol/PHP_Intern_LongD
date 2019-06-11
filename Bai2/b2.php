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
				<label for="input1">Nhap khoang so</label>
		    	<input type="text" value="<?php if(isset($_POST['ipn1'])) { echo htmlentities($_POST['ipn1']); } ?>" name="ipn1" class="form-control" id="input1">
		  	</div>
		  	<button type="submit" class="btn btn-primary">Check</button>
		</form>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST"){

				if (empty($_POST["ipn1"])) {
					echo "Sai dinh dang";
					die();
				}

				$n_ipn = $_POST["ipn1"];

				$arr1 = explode(',', $n_ipn);
				foreach ($arr1 as $var1) {
					$arr2 = explode('-', $var1);					

					if(count($arr2) !== 2) {
						echo "Sai dinh dang";
						die();
					}

					echo "<br />";
					if (is_numeric($arr2[0]) && is_numeric($arr2[1]) && ($arr2[0] <= $arr2[1])) {
						echo $arr2[0] ."-". $arr2[1] . "|";
						for ($i=$arr2[0]; $i <= $arr2[1]; $i++) { 
							if (soNguyenTo($i)) {
								echo " " .soNguyenTo($i);
							}
						}
					} else {
						echo("Sai dinh dang!");
					}
				}				
			}

			function soNguyenTo($var) {
				if ($var < 2) {
					return 0;
				}

			    for($i = 2; $i < sqrt($var); $i++)  
			   	{  
					if($var % $i == 0) return 0;
			   	}
			  	return $var;
			}
			
		?>
	</div>
	

</body>
</html>