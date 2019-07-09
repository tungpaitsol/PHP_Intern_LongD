<?php 
    require 'data.php';

    /**
     * Class Member
     * Member($code, $fullName, $age, $gender, $maritalStatus, $salary, $startWorkTime, $workHour, $hasLunchBreak, $isFullTime, $totalWorkTime = 0, $workdays = 0, $totalSalary = 0)
     * setCode($code)
     * setFullName($fullName)
     * setAge($age)
     * setGender($gender)
     * setMaritalStatus($maritalStatus)
     * setTotalWorkTime($totalWorkTime)
     * setSalary($salary)
     * setWorkdays($workdays)
     * setStartWorkTime($startWorkTime)
     * setWorkHour($workHour) 
     * setHasLunchBreak($hasLunchBreak)
     * setIsFullTime($isFullTime)
     * setTotalSalary($totalSalary)
     *
     * getCode()
     * getFullName()
     * getAge()
     * getGender()
     * getMaritalStatus()
     * getTotalWorkTime()
     * getSalary()
     * getWorkdays()
     * getStartWorkTime()
     * getWorkHour() 
     * getHasLunchBreak()
     * getIsFullTime()
     * getTotalSalary()
     */
    class Member
    {
        const
            MEMBER_TYPE_FULLTIME = 1,
            MEMBER_TYPE_PATRTIME = 0;

        private 
            $_code,
            $_fullName,
            $_age,
            $_gender,
            $_maritalStatus,
            $_totalWorkTime,
            $_salary,
            $_workdays,
            $_startWorkTime,
            $_workHour,
            $_hasLunchBreak,
            $_isFullTime,
            $_totalSalary;

        function __construct($code, $fullName, $age, $gender, $maritalStatus, $salary, $startWorkTime, $workHour, $hasLunchBreak, $isFullTime, $totalWorkTime = 0, $workdays = 0, $totalSalary = 0)
        {
            $this->_code = $code;
            $this->_fullName = $fullName;
            $this->_age = $age;
            $this->_gender = $gender;
            $this->_maritalStatus = $maritalStatus;
            $this->_totalWorkTime = $totalWorkTime;
            $this->_salary = $salary;
            $this->_workdays = $workdays;
            $this->_startWorkTime = $startWorkTime;
            $this->_workHour = $workHour;
            $this->_hasLunchBreak = $hasLunchBreak;
            $this->_isFullTime = $isFullTime;
            $this->_totalSalary = $totalSalary;
        }

        // SET
        public function setCode($code)
        {
            $this->_code = $code;
        }
        
        public function setFullName($fullName)
        {
            $this->_fullName = $fullName;
        }
        
        public function setAge($age)
        {
            $this->_age = $age;
        }
        
        public function setGender($gender)
        {
            $this->_gender = $gender;
        }
        
        public function setMaritalStatus($maritalStatus)
        {
            $this->_maritalStatus = $maritalStatus;
        }
        
        public function setTotalWorkTime($totalWorkTime)
        {
            $this->_totalWorkTime = $totalWorkTime;
        }
        
        public function setSalary($salary)
        {
            $this->_salary = $salary;
        }
        
        public function setWorkdays($workdays)
        {
            $this->_workdays = $workdays;
        }
        
        public function setStartWorkTime($startWorkTime)
        {
            $this->_startWorkTime = $startWorkTime;
        }
        
        public function setWorkHour($workHour)
        {
            $this->_workHour = $workHour;
        }
        
        public function setHasLunchBreak($hasLunchBreak)
        {
            $this->_hasLunchBreak = $hasLunchBreak;
        }

        public function setIsFullTime($isFullTime)
        {
            $this->_isFullTime = $isFullTime;
        }

        public function setTotalSalary($totalSalary)
        {
            $this->_totalSalary = $totalSalary;
        }
        
        // GET        
        public function getCode()
        {
            return $this->_code;
        }
        
        public function getFullName()
        {
            return $this->_fullName;
        }
        
        public function getAge()
        {
            return $this->_age;
        }
        
        public function getGender()
        {
            return $this->_gender;
        }
        
        public function getMaritalStatus()
        {
            return $this->_maritalStatus;
        }
        
        public function getTotalWorkTime()
        {
            return $this->_totalWorkTime;
        }
        
        public function getSalary()
        {
            return $this->_salary;
        }
        
        public function getWorkdays()
        {
            return $this->_workdays;
        }
        
        public function getStartWorkTime()
        {
            return $this->_startWorkTime;
        }
        
        public function getWorkHour()
        {
            return $this->_workHour;
        }
        
        public function getHasLunchBreak():int
        {
            return $this->_hasLunchBreak;
        }

        public function getIsFullTime()
        {
            return $this->_isFullTime;
        }

        public function getTotalSalary()
        {
            return $this->_totalSalary;
        }
    }

    /**
     * Class WorkTime
     * WorkTime($memberCode, $startDatetime, $endDateTime)
     * setMemberCode($memberCode)
     * setStartDatetime($startDatetime)
     * setEndDateTime($endDateTime)
     *
     * getMemberCode()
     * getStartDatetime()
     * getEndDatetime()
     */
    class WorkTime 
    {
        private 
            $_memberCode,
            $_startDatetime,
            $_endDatetime;

        function __construct($memberCode, $startDatetime, $endDateTime)
        {
            $this->_memberCode = $memberCode;
            $this->_startDatetime = $startDatetime;
            $this->_endDatetime = $endDateTime;
        }

        //SET
        public function setMemberCode($memberCode)
        {
            $this->_memberCode = $memberCode;
        }

        public function setStartDatetime($startDatetime)
        {
            $this->_startDatetime = $startDatetime;
        }

        public function setEndDateTime($endDateTime)
        {
            $this->_endDateTime = $endDateTime;
        }

        //GET
        public function getMemberCode()
        {
            return $this->_memberCode;
        }

        public function getStartDatetime()
        {
            return $this->_startDatetime;
        }

        public function getEndDatetime()
        {
            return $this->_endDatetime;
        }
    }

    /**
     * Class DayOff
     * DayOff()
     * isHoliday($datetime)
     * isWeekday($datetime)
     * isMonthAndYear($datetime, $month, $year)
     * dayWorkOfMonth($month, $year)
     */
    class DayOff
    {        
        const 
            DATE_FORMAT_ISO   = 'Y-m-d',
            DATE_FORMAT_YEAR  = 'Y',
            DATE_FORMAT_MONTH  = 'm',
            HOLIDAY = array(
                '2019-01-01',
                '2019-02-04',
                '2019-02-05',
                '2019-02-06',
                '2019-02-07',
                '2019-02-08',
                '2019-04-14',
                '2019-04-15',
                '2019-05-01',
                '2019-09-02'
            );

        public function isHoliday($datetime):bool
        {
            $date = date(self::DATE_FORMAT_ISO, strtotime($datetime));
            if (in_array($date, self::HOLIDAY)) {
                return true;
            }

            return false;
        }

        public function isWeekday($datetime):bool
        {
            $dayName = date('l', strtotime($datetime));
            if ($dayName == 'Saturday' || $dayName == 'Sunday') {
                return true;
            }
            
            return false;
        }

        public function isMonthAndYear($datetime, $month, $year):bool
        {
            $datetimeToMonth = date(self::DATE_FORMAT_MONTH, strtotime($datetime));
            $datetimeToYear = date(self::DATE_FORMAT_YEAR, strtotime($datetime));
            if ($datetimeToMonth == $month && $datetimeToYear == $year) {
                return true;
            }
            
            return false;
        }

        public function dayWorkOfMonth($month, $year):int
        {
            $totalDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $dayOff = 0;
            for ($i=1; $i <= $totalDayOfMonth; $i++) { 
                $date = $year.'-'.$month.'-'.$i;
                if ($this->isHoliday($date) || $this->isWeekday($date)) {
                    $dayOff++;
                }
            }

            return $totalDayOfMonth - $dayOff;
        }
    }

    /**
     * Class ManagerSalaryMembers
     * ManagerSalaryMembers($members, $workTimes)
     * findMemberByCode($memberCode)
     * findWorkTimesByCode($memberCode, $month, $year)
     * calculatorWorkdays($member, $workTimes)
     * calculatorWorkdaysByCode($memberCode, $month, $year)
     * calculatorWorkdaysOfAllMember($month, $year)
     * calculatorSalary($memberCode, $totalDayOfMonth)
     * calculatorSalaryOfAllMember($totalDayOfMonth)
     */
    class ManagerSalaryMembers
    {
        const
            TIME_FORMAT_ISO = 'H:i:s',
            DATE_FORMAT_YEAR  = 'Y',
            DATE_FORMAT_MONTH  = 'm';

        private
            $_members,
            $_workTimes;
        
        function __construct($members, $workTimes)
        {
            $this->_members = $members;
            $this->_workTimes = $workTimes;
        }

        private function datetimeToSeconds($datetime):string
        {
            return strtotime(date(self::TIME_FORMAT_ISO, strtotime($datetime)));
        }

        public function findMemberByCode($memberCode):array
        {
            foreach ($this->_members as $member) {
                if ($member->getCode() == $memberCode) {
                    return array('status' => 1, 'data' => $member);
                }
            }

            return array('status' => 0, 'data' => null);
        }

        public function findWorkTimesByCode($memberCode, $month, $year) : array
        {
            $resWorkTime = array();
            foreach ($this->_workTimes as $workTime) {
                $datetimeToMonth = date(self::DATE_FORMAT_MONTH, strtotime($workTime->getStartDatetime()));
                $datetimeToYear = date(self::DATE_FORMAT_YEAR, strtotime($workTime->getStartDatetime()));
                if ($workTime->getMemberCode() != $memberCode || $datetimeToMonth != $month || $datetimeToYear != $year) {
                    continue;
                }

                $resWorkTime[] = $workTime;
            }

            return $resWorkTime;
        }

        public function calculatorWorkdays($member, $workTimes)
        {
            $startWorkTime = $this->datetimeToSeconds($member->getStartWorkTime());
            $timeLunchBreak = $member->getHasLunchBreak() == 1 ? 90*60 : 0;

            $workHour = $member->getWorkHour();
            $endWorkTime = $startWorkTime + $workHour*3600 + $timeLunchBreak;

            $workday = 0;
            foreach ($workTimes as $workTime) {
                $startTime = $this->datetimeToSeconds($workTime->getStartDatetime());
                $endTime = $this->datetimeToSeconds($workTime->getEndDatetime());
                $workday += ($startWorkTime < $startTime || $endWorkTime > $endTime) ? 0.5 : 1;
            }

            $member->setWorkdays($workday);
        }

        public function calculatorWorkdaysByCode($memberCode, $month, $year)
        {
            $member = $this->findMemberByCode($memberCode);
            if ($member['status'] == 0) {
                return false;
            }

            $workTimes = $this->findWorkTimesByCode($memberCode, $month, $year);
            $this->calculatorWorkdays($member['data'], $workTimes);
            return true;
        }

        public function calculatorWorkdaysOfAllMember($month, $year)
        {
            foreach ($this->_members as $member) {
                $memberCode = $member->getCode();
                $workTimes = $this->findWorkTimesByCode($memberCode, $month, $year);
                $this->calculatorWorkdays($member, $workTimes);
            }
        }

        public function calculatorSalary($memberCode, $totalDayOfMonth)
        {
            $member = $this->findMemberByCode($memberCode);
            if ($member['status'] == 0) {
                return false;
            }

            $totalSalary = $member['data']->getSalary() * ($member['data']->getWorkdays()/$totalDayOfMonth);
            $member['data']->setTotalSalary($totalSalary);
            return true;
        }

        public function calculatorSalaryOfAllMember($totalDayOfMonth)
        {
            foreach ($this->_members as $member) {                
                $totalSalary = $member->getSalary() * ($member->getWorkdays()/$totalDayOfMonth);
                $member->setTotalSalary($totalSalary);
            }

        }
    }


    $listMember = array();    
    $listWorkTimes = array();

    foreach ($listMemberFullTime as $member) {
        $listMember[] = new Member(
            $member['code'], 
            $member['full_name'], 
            $member['age'], 
            $member['gender'], 
            $member['marital_status'], 
            $member['salary'], 
            $member['start_work_time'], 
            $member['work_hour'], 
            $member['has_lunch_break'],
            Member::MEMBER_TYPE_FULLTIME
        );
    }

    foreach ($listMemberPartTime as $member) {
        $listMember[] = new Member(
            $member['code'], 
            $member['full_name'], 
            $member['age'], 
            $member['gender'], 
            $member['marital_status'], 
            $member['salary'], 
            $member['start_work_time'], 
            $member['work_hour'], 
            $member['has_lunch_break'],
            Member::MEMBER_TYPE_PATRTIME
        );
    }

    foreach ($listWorkTime as $workTime) {
        $listWorkTimes[] = new WorkTime(
            $workTime['member_code'], 
            $workTime['start_datetime'], 
            $workTime['end_datetime']
        );
    }

    $dayOff = new DayOff();
    $dayWorkOfMonth = $dayOff->dayWorkOfMonth(6, 2019);
    $managerMembers = new ManagerSalaryMembers($listMember, $listWorkTimes);

    $managerMembers->calculatorWorkdaysOfAllMember(6, 2019);
    $managerMembers->calculatorSalaryOfAllMember($dayWorkOfMonth);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bai 1 OOP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin: 50px auto; width: 70%">        
        <table class="table table-hover small">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Full Time</th>
                    <th scope="col">Workday</th>
                    <th scope="col">Total Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listMember as $member): ?>
                    <tr>
                        <th scope="row"><?= $member->getCode(); ?></th>
                        <td><?= $member->getFullName(); ?></td>
                        <td><?= $member->getSalary(); ?></td>
                        <td><?= $member->getIsFullTime(); ?></td>
                        <td><?= $member->getWorkdays(); ?></td>
                        <td><?= $member->getTotalSalary(); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>   
    </div> 
</body>
</html>