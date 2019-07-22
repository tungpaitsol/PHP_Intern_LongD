<?php
    require_once 'DBConnect.php';

    class ManagerDAL extends Database
    {
        public function getBillById($billId) {
            $query='SELECT b.id             id,
                           b.table_id       tableid,
                           b.date_check_in  datecheckin,
                           b.date_check_out datecheckout,
                           b.tax            tax,
                           b.discount       discount,
                           b.total_money    totalmoney,
                           b.status         status
                    FROM bill b
                    WHERE b.id = ?';
            $this->setQuery($query);
            return $this->loadRow([$billId]);
        }

        public function setTotalMoneyOfBillByBillId($billId, $totalMoney) {
            $query='UPDATE bill
                      SET total_money=?
                      WHERE id=?';
            $this->setQuery($query);
            return $this->loadCount([$totalMoney, $billId]);
        }

        public function getMemberById($memberId)
        {
            $query='SELECT * FROM member WHERE id=? LIMIT 1';
            $this->setQuery($query);
            return $this->loadRow([$memberId]);
        }

        public function getListBillFoodByBillId($billId)
        {
            $query='SELECT f.name                                                               name,
                           bf.quantity                                                          quantity,
                           bf.price                                                             price,
                           bf.tax                                                               tax,
                           ((bf.quantity * bf.price * bf.tax / 100) + (bf.quantity * bf.price)) totalmoney
                    FROM bill_food_info bf
                             LEFT JOIN food f on bf.food_id = f.id
                    WHERE bf.bill_id = ?';
            $this->setQuery($query);
            return $this->loadAllRows([$billId]);
        }

        public function getMinTimeAndMaxTimeByBillId($billId)
        {
            $query='SELECT UNIX_TIMESTAMP(MIN(bs.start_datetime)) mintime,
                           UNIX_TIMESTAMP(MAX(bs.end_datetime))   maxtime
                    FROM bill_staff_info bs
                    WHERE bs.bill_id = ?';

            $this->setQuery($query);
            return $this->loadRow([$billId]);
        }

        public function getListBillStaffInfoByBillId($billId)
        {
            $query='SELECT bs.id                             id,
                           bs.member_id                      memberid,
                           bs.bill_id                        billid,
                           UNIX_TIMESTAMP(bs.start_datetime) startdatetime,
                           UNIX_TIMESTAMP(bs.end_datetime)   enddatetime,
                           bs.member_type                    membertype,
                           bs.service_money                  servicemoney
                    FROM bill_staff_info bs
                    WHERE bill_id = ?';
            $this->setQuery($query);
            return $this->loadAllRows([$billId]);
        }

        public function setServiceMoney($billId, $serviceMoney)
        {
            $query='UPDATE bill_staff_info
                      SET service_money=?
                      WHERE id=?';
            $this->setQuery($query);
            return $this->loadCount([$serviceMoney, $billId]);
        }

        public function getListBillStaffByBillId($billId)
        {
            $query='SELECT bs.id, m.full_name fullname, SUM(service_money) servicemoney
                    FROM bill_staff_info bs
                             LEFT JOIN member m on bs.member_id = m.id
                    WHERE bill_id = ?
                    GROUP BY member_id';
            $this->setQuery($query);
            return $this->loadAllRows([$billId]);
        }

        public function getSalaryMemberOfMonth($year, $month) {
            $query='SELECT bs.member_id                                              memberid,
                           m.full_name                                               fullname,
                           DATE_FORMAT(bs.start_datetime, \'%m/%Y\')                   date,
                           SUM(bs.service_money * 40 / 100) +
                           SUM(b.total_money * IF(bs.member_type = 1, 1.5, 1) / 100) salary
                    FROM bill_staff_info bs
                             LEFT JOIN member m on bs.member_id = m.id
                             LEFT JOIN bill b on bs.bill_id = b.id
                    WHERE YEAR(bs.start_datetime) = ?
                      AND MONTH(bs.start_datetime) = ?
                    GROUP BY member_id';
            $this->setQuery($query);
            return $this->loadAllRows([$year, $month]);
        }
    }