<?php
    session_start();
    $_SESSION['products'] = empty($_SESSION['products']) ? createProduct() : $_SESSION['products'];
    $products = $_SESSION['products'];

    if (isset($_POST['btnCreateProducts'])) {
        $get_error = checkErr($_POST['inputIndexed']);
        if ($get_error['stt'] === 1) {
            $products = createProduct($_POST['inputIndexed']);
            $_SESSION['products'] = $products;
        }
    }
    
    if (isset($_POST['btnID'])) {
        $type_id = $_POST['btnID'] == SORT_DESC ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $type_id, 'id');
    }

    if (isset($_POST['btnName'])) {
        $type_name = $_POST['btnName'] == SORT_DESC ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $type_name, 'name');
    }

    if (isset($_POST['btnPrince'])) {
        $type_prince = $_POST['btnPrince'] == SORT_DESC ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $type_prince, 'prince');
    }

    if (isset($_POST['btnQuantity'])) {
        $type_quantity = $_POST['btnQuantity'] == SORT_DESC ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $type_quantity, 'quantity');        
    }

    if (isset($_POST['btnOrder'])) {
        $type_order = $_POST['btnOrder'] == SORT_DESC ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $type_order, 'order');
    }

    if (isset($_POST['btnTotal'])) {
        $type_total = $_POST['btnTotal'] == SORT_DESC ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $type_total, 'total');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Bài 4</title>
    <style type="text/css">
        tr .btn {
          font-weight: bold;
          width: 100%;
        }
    </style>
</head>
<body>
<div class="container" style="margin: 50px auto;width: 70%">
    <form action="" method="POST">
        <table class="table table-hover table-striped table-sm table-bordered">
            <thead>
                <tr>            
                    <th scope="col">
                        <button type="submit" class="btn" value="<?php echo $type_id ?? 4; ?>" name="btnID">ID</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?php echo $type_name ?? 4; ?>" name="btnName">Name</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?php echo $type_prince ?? 4; ?>" name="btnPrince">Prince</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?php echo $type_quantity ?? 4; ?>" name="btnQuantity">Quantity</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?php echo $type_order ?? 4; ?>" name="btnOrder">Order</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?php echo $type_total ?? 4; ?>" name="btnTotal">Total</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($products)) foreach ($products as $product): ?>
                <tr>
                    <td scope="row"><?php echo($product['id']) ?></td>
                    <td><?php echo($product['name']) ?></td>
                    <td><?php echo($product['prince']) ?></td>
                    <td><?php echo($product['quantity']) ?></td>
                    <td><?php echo($product['order']) ?></td>  
                    <td><?php echo($product['total']) ?></td>          
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="form-inline">
            <input type="number" class="form-control" name="inputIndexed">
            <input type="submit" name="btnCreateProducts" value="Tạo mới" class="btn btn-primary" style="margin: auto 5px">
            <?php if(!empty($get_error['message'])) { echo $get_error['message'];}?>
        </div>    
    </form>
    
    <?php

        function quickSort($array_input, $sort_type, $column_key):array
        {
            if (count($array_input) <= 1) {
              return $array_input;
            }

            $pivot = $array_input[0][$column_key];
            $left = array();
            $right = array();

            for($i = 1; $i < count($array_input); $i++)
            {
                if($array_input[$i][$column_key] < $pivot) {
                    $sort_type == SORT_ASC ? $left[] = $array_input[$i] : $right[] = $array_input[$i];
                    continue;
                }

                $sort_type == SORT_DESC ? $left[] = $array_input[$i] : $right[] = $array_input[$i];                
            }

            return array_merge(quickSort($left, $sort_type, $column_key), array($array_input[0]), quickSort($right, $sort_type, $column_key));        
        }

        function createProduct($indexed = 10):array
        {
            $list_product = array();
            $key_product = array("id", "name", "prince", "quantity", "order", "total");
            for ($i=0; $i<$indexed; $i++) {
                $prince = mt_rand(1000, 50000);
                $quantity = mt_rand(1, 100);
                $value_product = array($i, "Product " .str_pad($i, count($indexed)+1, '0', STR_PAD_LEFT), $prince ,$quantity ,mt_rand(1, 100), $prince*$quantity);
                $product = array_combine($key_product, $value_product);
                array_push($list_product, $product);
            }

            return $list_product;
        }

        function checkErr($number):array
        {
            if ($number == '') {
                return array('stt' => 0, 'message' => 'Chưa nhập số lượng sản phẩm');
            }
            
            if (!is_numeric($number) || $number - (int)$number != 0 || $number < 0) {
                return array('stt' => 0, 'message' => 'Yêu cầu nhập số nguyên dương lớn hơn 0');
            }
           
            return array('stt' => 1);
        }

    ?>

</div>  
</body>
</html>