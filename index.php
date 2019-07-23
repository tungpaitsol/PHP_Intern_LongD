<?php
    require_once 'BLL.php';
    setlocale(LC_ALL, 'vi_VN');
    $bll = new ManagerBLL();
    $billDetail = $bll->getBillDetailByBillId(1);
    $salaryMember = $bll->getSalaryMemberOfMonth(2019,7);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OOP-Bai 3</title>
    <style>
        .row {
            display: flex;
            margin: auto;
        }

        .row > div {
            flex: 1;
            padding: 5px 7px;
        }

        .bill-detail,
        .salary-detail {
            border: black solid 2px;
            margin: 15px auto;
            /*padding-left: 20px;*/
            /*padding-right: 20px;*/
        }

        .bill-detail .header {
            text-align: center;
            background: lightgrey;
            padding-top: 7px;
            padding-bottom: 7px;

        }

        .bill-detail .food-title>div,
        .bill-detail .staff-title>div,
        .bill-detail .money {
            border: black dashed 1px;
            text-align: center;
            font-weight: bold;
        }

        .bill-detail .header .title {
            font-size: 23px;
            font-weight: bold;
        }

        .bill-detail .datetime-check {
            border-top: black dashed 1px ;
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .salary-detail .header {
            text-align: center;
            background: lightgrey;
            padding-top: 7px;
            padding-bottom: 7px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="salary-detail" style="width: 500px">
        <div class="header">
            <div class="row">
                <div class="col-sm title">LƯƠNG NHÂN VIÊN</div>
            </div>
        </div>
        <div class="salary-member">
            <?php foreach ($salaryMember as $salary): ?>

            <div class="row">
                <div class="col-sm-8 title"><?= $salary->fullname ?></div>
                <div class="col-sm-4 title"><?= $bll->moneyFormat($salary->salary) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="bill-detail" style="width: 700px">
        <div class="header">
            <div class="row">
                <div class="col-sm title">HOÁ ĐƠN THANH HOÁ</div>
            </div>
            <div class="row">
                <div class="col-sm">Table: <?= $billDetail->tableid ?>--#<?= $billDetail->id ?></div>
            </div>
        </div>
        <div class="datetime-check">
            <div class="row">
                <div class="col-sm-6">Datetime Check In: </div>
                <div class="col-sm-6"><?= $billDetail->datecheckin ?></div>
            </div>
            <div class="row">
                <div class="col-sm-6">Datetime Check Out: </div>
                <div class="col-sm-6"><?= $billDetail->datecheckout ?></div>
            </div>
        </div>
        <div class="thong-ke">
            <div class="row food-title">
                <div class="col-sm-4" >Drink/Food</div>
                <div class="col-sm-3">Quantity</div>
                <div class="col-sm-2">Price</div>
                <div class="col-sm-2">Tax</div>
                <div class="col-sm-2">Total</div>
            </div>
            <?php foreach($billDetail->billfood as $food) : ?>
                <div class="row">
                    <div class="col-sm-4"><?= $food->name ?></div>
                    <div class="col-sm-2"><?= $food->quantity ?></div>
                    <div class="col-sm-2"><?= $bll->moneyFormat($food->price) ?></div>
                    <div class="col-sm-1"><?= $food->tax ?></div>
                    <div class="col-sm-3"><?= $bll->moneyFormat($food->totalmoney) ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row staff-title">
            <div class="col-sm-8">Full Name</div>
            <div class="col-sm-4">Service Money</div>
        </div>
        <?php foreach($billDetail->billstaff as $staff) : ?>
            <div class="row">
                <div class="col-sm-8"><?= $staff->fullname ?></div>
                <div class="col-sm-4"><?= $bll->moneyFormat($staff->servicemoney) ?></div>
            </div>
        <?php endforeach; ?>
        <div class="money">
            <div class="row">
                <div class="col-sm-8">Sub-total</div>
                <div class="col-sm-4"><?= $bll->moneyFormat($billDetail->submoney) ?></div>
            </div>
            <div class="row">
                <div class="col-sm-8">Tax(%)</div>
                <div class="col-sm-4"><?= $billDetail->tax ?></div>
            </div>
            <div class="row">
                <div class="col-sm-8">Discount</div>
                <div class="col-sm-4">-<?= $bll->moneyFormat($billDetail->discount) ?></div>
            </div>
            <div class="row">
                <div class="col-sm-8">Total</div>
                <div class="col-sm-4"><?= $bll->moneyFormat($billDetail->totalmoney) ?></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>