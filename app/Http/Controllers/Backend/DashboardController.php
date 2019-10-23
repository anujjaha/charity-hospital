<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking\Booking;
use Carbon\Carbon;
use App\Models\Department\Department;
use App\Models\PatientXRay\PatientXRay;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
    	$startDate 	= date('Y-m-d', strtotime('-2 months')) . ' 00:00:00';
    	$endDate 	= date('Y-m-d') . ' 23:59:59';
    	$input 		= $request->all();
    	
    	if(array_key_exists('startDate', $input))
    	{
    		$dateInput = explode("-", $input['startDate']);
            $customDate = $dateInput[1] . '/' . $dateInput[0]. '/'. $dateInput[2];
    		$startDate = Carbon::parse($customDate)->format('Y-m-d') . ' 00:00:00';
        }

    	if(array_key_exists('endDate', $input))
    	{
    		$dateInput = explode("-", $input['endDate']);
            $customDate = $dateInput[1] . '/' . $dateInput[0]. '/'. $dateInput[2];
    		$endDate	= Carbon::parse($customDate)->format('Y-m-d') . ' 23:59:59';;
    	}
    	
    	$bookings = Department::with(['bookings' => function($q) use($startDate, $endDate)
    	{
    		return $q->where('created_at', '>=', $startDate)
    			->where('created_at', '<=', $endDate);
    	}])
    	->get();

        $xrays = PatientXRay::with(['patient', 'department', 'chlidren'])
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('parent_id', '=', NULL)
            ->orderBy('id', 'desc')
            ->get();
    	
        $xDetails = Department::with(['xrays' => function($q) use($startDate, $endDate)
        {
            return $q->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate);
        }])
        ->get();

    	return view('backend.dashboard')->with([
            'xrays'     => $xrays,
    		'bookings' 	=> $bookings,
            'xDetails'  => $xDetails,
    		'startDate' => $startDate,
    		'endDate'	=> $endDate
    	]);
    }
}
