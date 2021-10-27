<?php
namespace App\Repository;

use App\Http\Controllers\date_utils;
use Illuminate\Database\Eloquent\Model;
use DateTime;
abstract class AbstractRepository
{
	/**
	 * @var Model
	 */
	private $model;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function selectCoditions($coditions)
	{
		$expressions = explode(';', $coditions);
		foreach($expressions as $e) {
			$exp = explode(':', $e);

			$this->model = $this->model->where($exp[0], $exp[1], $exp[2]);
		}
	}

	public function selectFilter($filters)
	{
		$this->model = $this->model->selectRaw($filters);
	}

	public function getResult()
	{
		return $this->model;
	}
	public  function loadFromUserAndDate(){
        
        $workingHours = $this->model->where([['user_id',Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
       // dd(date('Y-m-d'));
        return $workingHours ;
    }
	public  function execInnout($data,$currentTime=0)
    {
        
        $timeColumn = static::getNextTime($data);
        if(!$timeColumn){
           // throw new AppException("Você já fez os 4 batimentos do dia!");

			abort(408, "Você já fez os 4 batimentos do dia!");
        }
       // $data = \App\Working_hour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
       
       $workingHours = $this->model->find($data[0]->id);
       
       
       $workingHours->user_id = Auth()->user()->id;
       $workingHours->work_date = date('Y-m-d');

       if($currentTime==0) {
            // if($timeColumn == "time1"){$workingHours->time1 = date("H:i:s");}
            if($timeColumn == "time2"){$workingHours->time2 = date("H:i:s");}
            if($timeColumn == "time3"){$workingHours->time3 = date("H:i:s");}
            if($timeColumn == "time4"){$workingHours->time4 = date("H:i:s");}
        }else{
            if($timeColumn == "time2"){$workingHours->time2 = $currentTime;}
            if($timeColumn == "time3"){$workingHours->time3 = $currentTime;}
            if($timeColumn == "time4"){$workingHours->time4 = $currentTime;}
        }
      
       

       
       $workingHours->worked_time = date_utils::getSecondsFromDateInterval($this->getWorkedInterval($workingHours));
    	return   $workingHours->save();

    //   $id = $data[0]->id;
     //   dd($id);

    }
	public static function getNextTime($data)
    {
     //   $data = \App\Working_hour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
       
       if(!($data[0]->time1)) return 'time1';
       if(!($data[0]->time2)) return 'time2';
       if(!($data[0]->time3)) return 'time3';
       if(!($data[0]->time4)) return 'time4';
       return null;
    }
	public  function getWorkedInterval($workingHours) 
    {
        [$t1, $t2, $t3, $t4] = $this->getTimes($workingHours);

        $part1 = new \DateInterval('PT0S');
        $part2 = new \DateInterval('PT0S');

        if($t1) $part1 = $t1->diff(new DateTime());
        if($t2) $part1 = $t1->diff($t2);
        if($t3) $part2 = $t3->diff(new DateTime());
        if($t4) $part2 = $t3->diff($t4);

        return date_utils::sumIntervals($part1, $part2);
    }
	public  function getTimes($workingHours) 
    {
        $times = [];
        


        $workingHours->time1 ? array_push($times,date_utils::getDateFromString($workingHours->time1)) : array_push($times,null);
        $workingHours->time2 ? array_push($times,date_utils::getDateFromString($workingHours->time2)) : array_push($times,null);
        $workingHours->time3 ? array_push($times,date_utils::getDateFromString($workingHours->time3)) : array_push($times,null);
        $workingHours->time4 ? array_push($times,date_utils::getDateFromString($workingHours->time4)) : array_push($times,null);
       


        return $times;
    }


}