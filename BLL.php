<?php
    require_once 'DAL.php';

    class ManagerBLL extends ManagerDAL
    {
        private $serviceMoney=array(
            array(100000, 80000, 50000),
            array(80000, 60000, 40000)
        );

        private function getServiceMoneyStaffOfHour($numberStaff, $numberHour)
        {
            $maxStaff=count($this->serviceMoney);
            $maxHour=count($this->serviceMoney[0]);
            $numberStaff=min($numberStaff, $maxStaff);
            $numberHour=min($numberHour, $maxHour);
            return $this->serviceMoney[$numberStaff - 1][$numberHour - 1];
        }

        public function calServiceMoneyStaffByBillId($billId)
        {
            $billStaffs=$this->getListBillStaffInfoByBillId($billId);
            $timeWork=$this->getMinTimeAndMaxTimeByBillId($billId);
            $numberHour=0;
            $listStaffInTime=[];

            for ($i=$timeWork->mintime; $i <= $timeWork->maxtime; $i+=3600) {
                $staffsInTime=[];
                foreach ($billStaffs as $billStaff) {
                    if ($billStaff->startdatetime > $i + 3600 || $billStaff->enddatetime < $i) continue;

                    $staffsInTime[$billStaff->id]=$billStaff->id;
                }
                if (empty($staffsInTime)) continue;

                $numberHour++;
                $serviceMoneyOfHour=$this->getServiceMoneyStaffOfHour(count($staffsInTime), $numberHour);

                foreach ($staffsInTime as $staffInTime) {
                    $listStaffInTime[$staffInTime][]=$serviceMoneyOfHour;
                }
            }

            foreach ($listStaffInTime as $billStaffId=>$serviceMoney) {
                $totalServiceMoney=array_sum($serviceMoney);
                $this->setServiceMoney($billStaffId, $totalServiceMoney);
            }
        }

        public function getBillDetailByBillId($billId) {
            $this->calServiceMoneyStaffByBillId($billId);
            $bill = $this->getBillById($billId);
            $bill->billstaff= $this->getListBillStaffByBillId($billId);
            $bill->billfood = $this->getListBillFoodByBillId($billId);
            $totalMoneyBillStaff = array_sum(array_column($bill->billstaff, 'servicemoney'));
            $totalMoneyBillFood = array_sum(array_column($bill->billfood, 'totalmoney'));
            $bill->submoney = ($totalMoneyBillFood + $totalMoneyBillStaff);
            $bill->totalmoney = $bill->submoney + $bill->submoney*$bill->tax/100 - $bill->discount;
            $this->setTotalMoneyOfBillByBillId($billId, $bill->totalmoney);
            return $bill;
        }
    }
