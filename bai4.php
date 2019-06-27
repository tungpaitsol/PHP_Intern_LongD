<?php
    session_start();    

    $products = empty($_SESSION['products']) ? array() : $_SESSION['products'];
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
    
    $sortOrder = SORT_ASC;
    if (isset($_POST['sort']) && isset($_POST['order'])) {        
        $_SESSION['sort'] = array($_POST['order'] => $_POST['sort']);  

        if (array_key_exists($_POST['order'], $_SESSION['sort'])) {
            $sortOrder = $_POST['sort'] == SORT_ASC ? SORT_DESC : SORT_ASC;
        } else {
            $sortOrder = SORT_DESC;
        }

        $products = bubbleSort($products, $_POST['order'], $sortOrder);
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
                    <input type="hidden" name="sort" value="<?= $sortOrder ?>">
                    <th scope="col">
                        <button type="submit" class="btn" value="id" name="order">ID</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="name" name="order">Name</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="price" name="order">Price</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="quantity" name="order">Quantity</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="order" name="order">Order</button>
                    </th>
                    <th scope="col">
                        <button type="submit" class="btn" value="total" name="order">Total</button>
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
                    <td><?php echo($product['price']*$product['quantity']) ?></td>          
                </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
    <div class="form-inline">
        <input type="text" class="form-control" name="inputAmount">
        <input type="submit" name="btnCreateProducts" value="Tạo mới" class="btn btn-primary" style="margin: auto 5px">
        <?= $messageError; ?>
    </div>
</form>
    
    <?php

        /**
         * Sắp xếp Sản phẩm bằng thuật toán nổi bọt
         * @param  array   $products   Mảng chứa tất cả các sản phẩm
         * @param  integer $type       Tên kiểu sắp xếp: SORT_ASC, SORT_DESC
         * @param  integer $column     Tên cột muốn sắp xếp
         * @return array               Mảng chứa tất cả các sản phẩm đã sắp xếp
         */
        function bubbleSort($products, $column, $type):array
        {
            $element = count($products);
            for ($i=0; $i < $element; $i++) {
                for ($j=$i+1; $j < $element; $j++) {
                    $product1 = $column == 'total' ? $products[$i]['price']*$products[$i]['quantity'] : $products[$i][$column];
                    $product2 = $column == 'total' ? $products[$j]['price']*$products[$j]['quantity'] : $products[$j][$column];

                    if ($product1 > $product2 && $type == SORT_ASC) {
                        $products = swapProduct($products, $i, $j);
                        continue;
                    }

                    if ($product1 < $product2 && $type == SORT_DESC) {
                        $products = swapProduct($products, $i, $j);
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
            
            if (filter_var($inputValue, FILTER_VALIDATE_INT) === false || $inputValue < 0) {
                return array('status' => 0, 'message' => 'Yêu cầu nhập số nguyên dương lớn hơn 0');
            }

            return array('status' => 1);
        }

    ?>

</div>  
</body>
</html>