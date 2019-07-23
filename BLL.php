<?php
    require_once 'DAL.php';

    class ManagerBLL extends ManagerDAL
    {
        private $serviceMoney=array(
            array(100000, 80000, 50000),
            array(80000, 60000, 40000)
        );

        public function moneyFormat($money, $locale = 'vi') {
            setlocale(LC_MONETARY, $locale);
            $money = number_format(
                $money,
                0,
                localeconv()['mon_decimal_point'],
                localeconv()['mon_thousands_sep']
            );

            return $money. ' ' . localeconv()['int_curr_symbol'];
        }

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
            $bill=$this->getBillById($billId);
            $timeCheckIn = ceil(strtotime($bill->datecheckin)/3600);
            $timeCheckOut = ceil(strtotime($bill->datecheckout)/3600);
            $numberHour=0;
            $listStaffInTime=[];

            for ($i = $timeCheckIn; $i <= $timeCheckOut; $i++) {
                $staffsInTime=[];
                foreach ($billStaffs as $billStaff) {
                    $startDateTime = strtotime($billStaff->startdatetime)/3600;
                    $endDateTime = (strtotime($billStaff->enddatetime)/3600);
                    $endDateTime = $endDateTime - $startDateTime < 1 ? floor($endDateTime) : ceil($endDateTime);
                    if (ceil($startDateTime) > $i || $endDateTime < $i) continue;

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
