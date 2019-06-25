<?php
    session_start();

    $products = empty($_SESSION['products']) ? array() : $_SESSION['products'];
    $type_sort = array(
                    'id' => SORT_ASC,
                    'name' => SORT_ASC,
                    'id' => SORT_ASC,
                    'price' => SORT_ASC,
                    'quantity' => SORT_ASC,
                    'order' => SORT_ASC,
                    'total' => SORT_ASC
                );
    $message_error = '';

    if (isset($_POST['btnCreateProducts'])) {
        $check_amount = checkInputValue($_POST['inputAmount']);
        if ($check_amount['status'] === 1) {
            $products = createProduct($_POST['inputAmount']);
            $_SESSION['products'] = $products;
        } else {
            $message_error = $check_amount['message'];
        }
    }

    if (isset($_POST['btnID'])) {
        $type_sort['id'] = ($_POST['btnID'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $type_sort['id'], 'id');
    }

    if (isset($_POST['btnName'])) {
        $type_sort['name'] = ($_POST['btnName'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $type_sort['name'], 'name');
    }

    if (isset($_POST['btnPrice'])) {
        $type_sort['price'] = ($_POST['btnPrice'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $type_sort['price'], 'price');
    }

    if (isset($_POST['btnQuantity'])) {
        $type_sort['quantity'] = ($_POST['btnQuantity'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $type_sort['quantity'], 'quantity');
    }

    if (isset($_POST['btnOrder'])) {
        $type_sort['order'] = ($_POST['btnOrder'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $type_sort['order'], 'order');
    }

    if (isset($_POST['btnTotal'])) {
        $type_sort['total'] = ($_POST['btnTotal'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $type_sort['total'], 'total');
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
                        <button type="submit" class="btn" value="<?= $type_sort['id']; ?>" name="btnID">ID</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $type_sort['name']; ?>" name="btnName">Name</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $type_sort['price']; ?>" name="btnPrice">Price</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $type_sort['quantity']; ?>" name="btnQuantity">Quantity</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $type_sort['order']; ?>" name="btnOrder">Order</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $type_sort['total']; ?>" name="btnTotal">Total</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($products)): ?> 
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td scope="row"><?php echo($product['id']) ?></td>
                        <td><?php echo($product['name']) ?></td>
                        <td><?php echo($product['price']) ?></td>
                        <td><?php echo($product['quantity']) ?></td>
                        <td><?php echo($product['order']) ?></td>  
                        <td><?php echo($product['price']*$product['order']) ?></td>          
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
        <div class="form-inline">
            <input type="number" class="form-control" name="inputAmount">
            <input type="submit" name="btnCreateProducts" value="Tạo mới" class="btn btn-primary" style="margin: auto 5px">
            <?= $message_error; ?>
        </div>
    </form>
    
    <?php

        /**
         * Sắp xếp Sản phẩm bằng thuật toán nổi bọt
         * @param  [array] $products  [Mảng chứa tất cả các sản phẩm]
         * @param  [int] $type        [Kiểu sắp sếp sản phẩm: SORT_ASC, SORT_DESC]
         * @param  [string] $column   [Tên cột muốn sắp xếp]
         * @return [array]            [Mảng chứa tất cả các sản phẩm đã sắp xếp]
         */
        function bubbleSort($products, $type, $column):array
        {
            for ($i=0; $i < count($products); $i++) {
                for ($j=0; $j < count($products)-1-$i; $j++) {
                    $product1 = $column == 'total' ? $products[$j]['price']*$products[$j]['order'] : $products[$j][$column];
                    $product2 = $column == 'total' ? $products[$j+1]['price']*$products[$j+1]['order'] : $products[$j+1][$column] ;

                    if ($product1 > $product2 && $type == SORT_ASC) {
                        $products = swapProduct($products, $j, $j+1);
                        continue;
                    }

                    if ($product1 < $product2 && $type == SORT_DESC) {
                        $products = swapProduct($products, $j, $j+1);
                        continue;
                    }
                }
            }

            return $products;
        }

        /**
         * Hoán đổi vị trí giữa 2 sản phẩm
         * @param  [array] $products  [Mảng chứa sản phẩm]
         * @param  [int] $position1   [Vị trí của sản phẩm 1 trong mảng]
         * @param  [int] $position2   [Vị trí của sản phẩm 2 trong mảng]
         * @return [array]            [Mảng chứa sản phẩm đã hoán đổi]
         */
        function swapProduct($products, $position1, $position2):array
        {
            $temp = $products[$position1];
            $products[$position1] = $products[$position2];
            $products[$position2] = $temp;

            return $products;
        }

        /**
         * Tạo sản phẩm với 5 cột id, name, price, quantity, order.
         * @param  integer $amount [Số lượng sản phẩm muốn tạo]
         * @return [array]         [Mảng chứa các sản phẩm mới tạo]
         */
        function createProduct($amount):array
        {
            $list_product = array();
            for ($i=0; $i<$amount; $i++) {
                $product = array(
                    'id' => $i, 
                    'name' => "Product " .str_pad($i, strlen($amount), '0', STR_PAD_LEFT),
                    'price' => mt_rand(1000, 50000),
                    'quantity' => mt_rand(1, 100),
                    'order' => mt_rand(1, 100)
                );
                array_push($list_product, $product);
            }

            return $list_product;
        }

        /**
         * Kiểm tra giá trị nhập vào
         * @param  [string] $input_value [Tên giá trị cần kiểm tra]
         * @return [array]               [Mảng trả về key status, value message nếu có lỗi]
         */
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