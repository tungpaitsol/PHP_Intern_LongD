<!DOCTYPE html>
<html>
<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Bai tap 2</title>
</head>
<body>
	<div class="content" style="width: 50%; margin: 20px auto">
		<form action="b2.php" method="POST" name="baitap2" class="form-inline">
			<div class="form-group">
			    <select class="form-control" name="nselect" id="select1">
			      	<option>11 - 30</option>
			      	<option>55 - 70</option>
			    </select>
			</div>
			<div class="form-group">
		    	<input type="number" name="ipn" class="form-control" id="input1">
		  	</div>
		  	<button type="submit" class="btn btn-primary">Check</button>
		</form>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["ipn"])){
				$n_ipn = $_POST["ipn"];
				$sec = $_POST["nselect"];
				//var_dump($sec);
				if (($sec == "11 - 30" && ($n_ipn < 11 || $n_ipn > 30)) || ($sec == "55 - 70" && ($n_ipn < 55 || $n_ipn > 70))) {
					echo "Sai dinh dang";
				} else {
					if (soNguyenTo($n_ipn)) {
						echo $n_ipn . " La so nguyen to";
					} else {
						echo $n_ipn . " Khong la so nguyen to";
					}
				}
				
			}

			function soNguyenTo($var) {				   
				//echo var_dump($var);
			    for($i = 2; $i < sqrt($var); $i++)  
			   	{  
					if($var % $i == 0)  
					{  
						return 0;  
					}  
			   	}  
			  	return 1;
			}
			
		?>
	</div>
	

</body>
</html>