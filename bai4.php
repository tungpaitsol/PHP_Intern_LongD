<?php
    session_start();
    $products = empty($_SESSION['products']) ? array() : $_SESSION['products'];

    if (isset($_POST['btnCreateProducts'])) {
        $check_amount = checkInputValue($_POST['inputAmount']);
        if ($check_amount['status'] === 1) {
            $products = createProduct($_POST['inputAmount']);
            $_SESSION['products'] = $products;
        }
    }

    if (isset($_POST['btnID'])) {
        $sort_type_id = ($_POST['btnID'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $sort_type_id, 'id');
    }

    if (isset($_POST['btnName'])) {
        $sort_type_name = ($_POST['btnName'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $sort_type_name, 'name');
    }

    if (isset($_POST['btnPrince'])) {
        $sort_type_prince = ($_POST['btnPrince'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $sort_type_prince, 'prince');
    }

    if (isset($_POST['btnQuantity'])) {
        $sort_type_quantity = ($_POST['btnQuantity'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $sort_type_quantity, 'quantity');
    }

    if (isset($_POST['btnOrder'])) {
        $sort_type_order = ($_POST['btnOrder'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $sort_type_order, 'order');
    }

    if (isset($_POST['btnTotal'])) {
        $sort_type_total = ($_POST['btnTotal'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = quickSort($products, $sort_type_total, 'total');
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
                        <button type="submit" class="btn" value="<?= isset($sort_type_id) ? $sort_type_id: 4; ?>" name="btnID">ID</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= isset($sort_type_name) ? $sort_type_name : 4; ?>" name="btnName">Name</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= isset($sort_type_prince) ? $sort_type_prince : 4; ?>" name="btnPrince">Prince</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= isset($sort_type_quantity) ? $sort_type_quantity : 4; ?>" name="btnQuantity">Quantity</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= isset($sort_type_order) ? $sort_type_order : 4; ?>" name="btnOrder">Order</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= isset($sort_type_total) ? $sort_type_total : 4; ?>" name="btnTotal">Total</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($products)) foreach ($products as $product): ?>
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
            <input type="number" class="form-control" name="inputAmount">
            <input type="submit" name="btnCreateProducts" value="Tạo mới" class="btn btn-primary" style="margin: auto 5px">
            <?php if(!empty($check_amount['message'])) { echo $check_amount['message'];}?>
        </div>    
    </form>
    
    <?php

        function quickSort($array_input, $sort_order, $column_key):array
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
                    $sort_order == SORT_ASC ? $left[] = $array_input[$i] : $right[] = $array_input[$i];
                    continue;
                }

                $sort_order == SORT_DESC ? $left[] = $array_input[$i] : $right[] = $array_input[$i];                
            }

            return array_merge(
                    quickSort($left, $sort_order, $column_key),
                    array($array_input[0]),
                    quickSort($right, $sort_order, $column_key)
            );        
        }

        function createProduct($amount = 10):array
        {
            $list_product = array();
            for ($i=0; $i<$amount; $i++) {
                $prince = mt_rand(1000, 50000);
                $quantity = mt_rand(1, 100);
                $product = array(
                    'id' => $i, 
                    'name' => "Product " .str_pad($i, strlen($amount), '0', STR_PAD_LEFT),
                    'prince' => $prince ,
                    'quantity' => $quantity ,
                    'order' => mt_rand(1, 100),
                    'total' => $prince*$quantity
                );
                array_push($list_product, $product);
            }

            return $list_product;
        }

        function checkInputValue($input_value):array
        {
            if ($input_value == '') {
                return array('status' => 0, 'message' => 'Chưa nhập số lượng sản phẩm');
            }
            
            if (!is_numeric($input_value) || $input_value - (int)$input_value != 0 || $input_value < 0) {
                return array('status' => 0, 'message' => 'Yêu cầu nhập số nguyên dương lớn hơn 0');
            }

            return array('status' => 1);
        }

    ?>

</div>  
</body>
</html>