<?php
  session_start();
  $data_products = empty($_SESSION['products']) ? createProduct() : $_SESSION['products'];

  // foreach ($_POST as $name => $value) {
  //    var_dump($name);
  //    var_dump($value);
  // }

  if (isset($_POST['btnCreateProducts'])) {
    $data_products = createProduct();
  }

  if (isset($_POST['btnID'])) {
    $data_products = (sortProduct($data_products, 'id'));
  }

  if (isset($_POST['btnName'])) {
    $data_products = (sortProduct($data_products, 'name'));
  }

  if (isset($_POST['btnPrince'])) {
    $data_products = (sortProduct($data_products, 'prince'));
  }

  if (isset($_POST['btnQuantity'])) {
    $data_products = (sortProduct($data_products, 'quantity'));
  }

  if (isset($_POST['btnOrder'])) {
    $data_products = (sortProduct($data_products, 'order'));
  }

  if (isset($_POST['btnTotal'])) {
    $data_products = (sortProduct($data_products, 'total'));
  }

  $_SESSION['products'] = $data_products;
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
            <th scope="col"><input type="submit" class="btn" value="ID" name="btnID"></th>
            <th scope="col"><input type="submit" class="btn" value="Name" name="btnName"></th>
            <th scope="col"><input type="submit" class="btn" value="Prince" name="btnPrince"></th>
            <th scope="col"><input type="submit" class="btn" value="Quantity" name="btnQuantity"></th>
            <th scope="col"><input type="submit" class="btn" value="Order" name="btnOrder"></th>
            <th scope="col"><input type="submit" class="btn" value="Total" name="btnTotal"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_products['products'] as $product): ?>
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
          <!-- <input type="text" class="form-control" name="inputIndexed"> -->
          <input type="submit" name="btnCreateProducts" value="Tạo mới" class="btn btn-primary">
      </div>      
    </form>
    
    <?php

      function sortProduct($data_products, $column):array
      {
        $arr_products = $data_products['products'];
        $arr_type = $data_products['sort_type'];
        $type = array_key_exists($column, $arr_type) ? ($arr_type[$column] == SORT_ASC ? SORT_DESC : SORT_ASC) : SORT_ASC;
        // $column_product = array_column($arr_products, $column);
        // array_multisort($column_product, $type, $arr_products);
        $arr_products = quickSort($arr_products, $type, $column);
        $arr_type = array($column => $type);
        return array('products' => $arr_products, 'sort_type' => $arr_type);
      }

      function quickSort($array_input, $array_sort_order, $column_key):array
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
            $array_sort_order == SORT_ASC ? array_push($left, $array_input[$i]) : array_push($right, $array_input[$i]);
          } else {
            $array_sort_order == SORT_DESC ? array_push($left, $array_input[$i]) : array_push($right, $array_input[$i]);
          }
        }

        return array_merge(quickSort($left, $array_sort_order, $column_key), array($array_input[0]), quickSort($right, $array_sort_order, $column_key));        
      }

      function createProduct():array
      {
        $list_product = array();
        $key_product = array("id", "name", "prince", "quantity", "order", "total");
        for ($i=0; $i<=9; $i++) {
          $prince = mt_rand(1000, 50000);
          $quantity = mt_rand(1, 100);
          $value_product = array($i, "Product " .($i+1), $prince ,$quantity ,mt_rand(1, 100), $prince*$quantity);
          $product = array_combine($key_product, $value_product);
          array_push($list_product, $product);
        }

        $data_products = array('products' => $list_product, 'sort_type' => array('id' => SORT_ASC));
        return $data_products;
      }
    ?>

  </div>  
</body>
</html>