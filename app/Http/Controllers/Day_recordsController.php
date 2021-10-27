<?php

namespace App\Http\Controllers;
use App\Http\Controllers\date_utils;
use App\Http\Resources\DaysRecordCollection;
use App\Http\Resources\DaysRecordResource;
use Illuminate\Http\Request;
use App\Repository\DaysRecordsRepository;
 use App\Working_hour;
class Day_recordsController extends Controller
{
	/**
	 * @var Working_hour
	 */
	private $workingHour;

	public function __construct(Working_hour $workingHour)
    {
	    $this->workingHour = $workingHour;
    }
    public function index()
    {
        
        $workingHours = $this->workingHour;
        $workingHourRepository = new DaysRecordsRepository($workingHours);
       // dd($workingHours);

        $HoursWorked = $workingHourRepository->loadFromUserAndDate();
        
       // $workingHours = \App\Working_hour::where([['user_id',\Auth::id()],['work_date',date('Y-m-d')]])->get();
       // dd($workingHours);
       return new DaysRecordResource($HoursWorked);
       
        
    }
    public function innout()
    {
        $workingHours = $this->workingHour;
        $data = $this->workingHour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
        if(isset($data[0]->id)) {

            $workingHourRepository = new DaysRecordsRepository($workingHours);
            
            $algo = $workingHourRepository->execInnout($data);
    
            return response()->json(null, 204);
          } else {
    

       
            $workingHours->user_id = Auth()->user()->id;
            $workingHours->work_date = date('Y-m-d');
            $workingHours->time1 = date("H:i:s");
            $workingHours->worked_time =0;
            $workingHours->save();
    
            return response()->json(null, 204);
    
          }
    }
    public function innout2(Request $request)
    {

      $workingHours = $this->workingHour;
      $data = $this->workingHour::where([['user_id', Auth()->user()->id],['work_date',date('Y-m-d')]])->get();
      $currentTime = $request->forcedTime;
      
      
      if(isset($data[0]->id)) {

        $workingHourRepository = new DaysRecordsRepository($workingHours);  

        $algo = $workingHourRepository->execInnout($data,$currentTime); // colocar num try/cath

        return response()->json(null, 204);

      }else{

   
        $workingHours->user_id = Auth()->user()->id;

        $workingHours->work_date = date('Y-m-d');
        $workingHours->time1 = $currentTime;
        $workingHours->worked_time =0;
        $workingHours->save();

        return response()->json(null, 204);
      }
    }


}
