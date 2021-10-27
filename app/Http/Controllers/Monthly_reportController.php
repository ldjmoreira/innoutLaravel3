<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\date_utils;
use App\User;
use App\Working_hour;
use DateTime;
use App\Http\Resources\MonthlyReportCollection;
use App\Repository\MonthlyReportRepository;
class Monthly_reportController extends Controller
{
    /**
	 * @var Working_hour
	 */
	private $workingHour;

	public function __construct(Working_hour $workingHour)
    {
	    $this->workingHour = $workingHour;
    }
    public function indexHour()
    {
        $workingHours = $this->workingHour;
        $MonthlyReportRepository = new MonthlyReportRepository($workingHours);

        $currentDate = new DateTime();
        $users = User::All();
        $selectedUserId=Auth()->user()->id;
        $selectedPeriod = $currentDate->format('Y-m');

        $registries = $MonthlyReportRepository->getMonthlyReport($selectedUserId, $selectedPeriod) ;

        $reportArray = $MonthlyReportRepository->getTotalReport($registries,$selectedPeriod) ;

        return response()->json($reportArray);
        return new MonthlyReportCollection($reportArray);
    }





}
