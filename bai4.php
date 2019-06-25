<?php
    session_start();

    $products = empty($_SESSION['products']) ? array() : $_SESSION['products'];
    $typeSort = array(
                    'id' => SORT_ASC,
                    'name' => SORT_ASC,
                    'id' => SORT_ASC,
                    'price' => SORT_ASC,
                    'quantity' => SORT_ASC,
                    'order' => SORT_ASC,
                    'total' => SORT_ASC
                );
    $messageError = '';

    if (isset($_POST['btnCreateProducts'])) {
        $checkAmount = checkInputValue($_POST['inputAmount']);
        if ($checkAmount['status'] === 1) {
            $products = createProduct($_POST['inputAmount']);
            $_SESSION['products'] = $products;
        } else {
            $messageError = $checkAmount['message'];
        }
    }

    if (isset($_POST['btnID'])) {
        $typeSort['id'] = ($_POST['btnID'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $typeSort['id'], 'id');
    }

    if (isset($_POST['btnName'])) {
        $typeSort['name'] = ($_POST['btnName'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $typeSort['name'], 'name');
    }

    if (isset($_POST['btnPrice'])) {
        $typeSort['price'] = ($_POST['btnPrice'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $typeSort['price'], 'price');
    }

    if (isset($_POST['btnQuantity'])) {
        $typeSort['quantity'] = ($_POST['btnQuantity'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $typeSort['quantity'], 'quantity');
    }

    if (isset($_POST['btnOrder'])) {
        $typeSort['order'] = ($_POST['btnOrder'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $typeSort['order'], 'order');
    }

    if (isset($_POST['btnTotal'])) {
        $typeSort['total'] = ($_POST['btnTotal'] == SORT_DESC) ? SORT_ASC : SORT_DESC;
        $products = bubbleSort($products, $typeSort['total'], 'total');
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
                        <button type="submit" class="btn" value="<?= $typeSort['id']; ?>" name="btnID">ID</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $typeSort['name']; ?>" name="btnName">Name</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $typeSort['price']; ?>" name="btnPrice">Price</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $typeSort['quantity']; ?>" name="btnQuantity">Quantity</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $typeSort['order']; ?>" name="btnOrder">Order</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="<?= $typeSort['total']; ?>" name="btnTotal">Total</button>
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
            <?= $messageError; ?>
        </div>
    </form>
    
    <?php

        /**
         * Sắp xếp Sản phẩm bằng thuật toán nổi bọt
         * @param  array   $products   Mảng chứa tất cả các sản phẩm
         * @param  integer $type       Kiểu sắp sếp sản phẩm: SORT_ASC, SORT_DESC
         * @param  integer $column     Tên cột muốn sắp xếp
         * @return array               Mảng chứa tất cả các sản phẩm đã sắp xếp
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
         * @param  array   $products    Mảng chứa sản phẩm
         * @param  integer $position1   Vị trí của sản phẩm 1 trong mảng
         * @param  integer $position2   Vị trí của sản phẩm 2 trong mảng
         * @return array                Mảng chứa sản phẩm đã hoán đổi
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
         * @param  integer $amount  Số lượng sản phẩm muốn tạo
         * @return array            Mảng chứa các sản phẩm mới tạo
         */
        function createProduct($amount):array
        {
            $listProduct = array();
            for ($i=0; $i<$amount; $i++) {
                $product = array(
                    'id' => $i, 
                    'name' => "Product " .str_pad($i, strlen($amount), '0', STR_PAD_LEFT),
                    'price' => mt_rand(1000, 50000),
                    'quantity' => mt_rand(1, 100),
                    'order' => mt_rand(1, 100)
                );
                array_push($listProduct, $product);
            }

            return $listProduct;
        }

        /**
         * Kiểm tra giá trị nhập vào
         * @param  string $inputValue  Tên giá trị cần kiểm tra
         * @return array               Mảng trả về key status, value message nếu có lỗi
         */
        function checkInputValue($inputValue):array
        {
            if ($inputValue == '') {
                return array('status' => 0, 'message' => 'Chưa nhập số lượng sản phẩm');
            }
            
            if (!is_numeric($inputValue) || $inputValue - (int)$inputValue != 0 || $inputValue < 0) {
                return array('status' => 0, 'message' => 'Yêu cầu nhập số nguyên dương lớn hơn 0');
            }

            return array('status' => 1);
        }

    ?>

</div>  
</body>
</html>