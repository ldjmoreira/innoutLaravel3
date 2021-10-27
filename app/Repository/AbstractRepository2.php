<?php
namespace App\Repository;

use App\Http\Controllers\date_utils;
use Illuminate\Database\Eloquent\Model;
use App\Working_hour;
use DateTime;


abstract class AbstractRepository2
{
    	/**
	 * @var Model
	 */
	private $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}
    public  function getMonthlyReport($userId, $date) 
    {
        $registries = [];
        $startDate = date_utils::getFirstDayOfMonth($date)->format('Y-m-d');
        $endDate = date_utils::getLastDayOfMonth($date)->format('Y-m-d');
       
        
        $results = $this->model->where('user_id', Auth()->user()->id)
        ->whereBetween('work_date', [$startDate, $endDate])
        ->get();

        foreach($results as $result){
            $result->balance = $result->getBalance();
        }
        
        foreach($results as $result){
            $registries[$result->work_date] = $result;
        }





        return $registries;
    }

    public  function getTotalReport($registries,$selectedPeriod) 
    {
        $report = [];
        $workDay = 0;
        $sumOfWorkedTime = 0;
        $lastDay = date_utils::getLastDayOfMonth($selectedPeriod)->format('d');
        
        for($day =1; $day <=$lastDay; $day++){
            $date = $selectedPeriod . '-' .sprintf('%02d',$day);
            if(date_utils::isPastWorkday($date)) $workDay++;

            $registry = false;
            foreach($registries as $register) {
                if($register->work_date == $date ) {
                    $registry = $registries[$date];

                    $dateCutted = substr($date, -2);

                    $registry->id = $dateCutted;
                }
            }

            if($registry){
                $sumOfWorkedTime += $registry->worked_time;
                array_push($report, $registry);
            }else{
          //      $workingHours = $this->model; // é uma passagem por referencia! (error) | não é a criação de um novo objeto
                $workingHours = new Working_hour;
                
                $workingHours->work_date = $date;
                $workingHours->worked_time =0;
                $workingHours->balance ="-08:00:00";
                
                $dateCutted = substr($date, -2); 

                $workingHours->id = $dateCutted;

                array_push($report, $workingHours);
               
            }

        }

        $expectedTime = $workDay * 60*60*8;
        $balance = date_utils::getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));
        $sign = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';
        
        $balanceSign= $sign . $balance;

        $sumOfWorkTime = date_utils::getTimeStringFromSeconds($sumOfWorkedTime);

        $reportArray = ['data' => $report, 
        'balanceSign' => $balanceSign,
        'sumOfWorkTime' =>$sumOfWorkTime];

       // return $report;

        return $reportArray;
    }




}