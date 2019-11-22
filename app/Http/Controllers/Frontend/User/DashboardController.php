<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\EloquentProductRepository;
use App\Repositories\Order\EloquentOrderRepository;
use App\Models\Patient\Patient;
use App\Models\Booking\Booking;
use App\Models\Surgery\Surgery;
use App\Models\Department\Department;
use App\Models\Doctor\Doctor;
use App\Models\PatientSurgery\PatientSurgery;
use App\Models\XRay\XRay;
use App\Models\PatientXRay\PatientXRay;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Carbon\Carbon;
use Response;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
	/**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return redirect()->route('frontend.index');
        return view('frontend.user.dashboard');
    }
    
    public function createDoctor()
    {
        $departments = Department::where('status', 1)->pluck('name', 'id')->toArray();

        return view('frontend.doctor.create')->with([
            'departments' => $departments
        ]);
    }

    public function createPatient()
    {
        $doctors = Doctor::where('status', 1)->get();

        return view('frontend.patient.create')->with([
            'doctors' => $doctors
        ]);
    }

    public function listDoctor(Request $request)
    {
        $doctors = Doctor::where('status', 1)->get();

        return view('frontend.doctor.list')->with([
            'doctors' => $doctors
        ]);
    }

    public function listSurgery(Request $request)
    {
        $surgeries = Surgery::where('status', 1)->get();

        return view('frontend.surgery.list')->with([
            'surgeries' => $surgeries
        ]);
    }

    public function listPatient(Request $request)
    {
        $patients = Patient::where('status', 1)->get();

        return view('frontend.patient.list')->with([
            'patients' => $patients
        ]);
    }

    public function storeDoctor(Request $request)
    {
        $input  = $request->all();
        $doctor = Doctor::create($input);
        
        if(isset($doctor))
        {
            return redirect()->route('frontend.user.doctors.list')->withFlashSuccess('Doctor Added Successfully!');
        }

        return redirect()->route('frontend.index')->withFlashSuccess('Something weng Wrong!');
    }
    
    public function storePatient(Request $request)
    {
        $input  = $request->all();
        $input['name'] = strtoupper($input['name']);
        $patient = Patient::create($input);
        
        if(isset($patient))
        {
            $patient->patient_number = $patient->id . date('d') . date('m');

            $patient->save();
            return redirect()->route('frontend.user.patients.list')->withFlashSuccess('Patient Added Successfully!');
        }

        return redirect()->route('frontend.index')->withFlashSuccess('Something weng Wrong!');
    }

    public function updatePatient(Request $request)
    {
        $input  = $request->all();
        if(isset($input['patient_id']) && $input['patient_id'] != '')
        {
            $patient = Patient::find($input['patient_id']);

            if(isset($patient))
            {
                $patient->name          = $input['name'];
                $patient->age           = $input['age'];
                $patient->validity      = $input['validity'];
                $patient->mobile        = $input['mobile'];
                $patient->address       = $input['address'];
                $patient->city          = isset($input['city']) ? strtoupper($input['city']) : 'GODHRA';
                $patient->notes         = $input['notes'];

                if($patient->save())
                {
                    return redirect()->route('frontend.user.patients.list')->withFlashSuccess('Patient Edited Successfully!');
                }
            }
        }
        
        return redirect()->route('frontend.user.patients.list')->withFlashDanger('Something went Wrong!');
    }


    public function updateDoctor(Request $request)
    {
        $input  = $request->all();
        
        if(isset($input['doctor_id']) && $input['doctor_id'] != '')
        {
            $doctor = Doctor::find($input['doctor_id']);

            if(isset($doctor))
            {
                if($doctor->update($input))
                {
                    return redirect()->route('frontend.user.doctors.list')->withFlashSuccess('Doctor Edited Successfully!');
                }
            }
        }
        
        return redirect()->route('frontend.user.doctors.list')->withFlashDanger('Something went Wrong!');
    }

    public function showCart(Request $request)
    {
    	$user = access()->user();
    	return view('frontend.jewel.cart')->with('user', $user);
    }

    public function addProductToCart(Request $request)
    {
    	
    	$user 		= access()->user();
    	$productQty = $request->get('productQty') ? $request->get('productQty') : 1;
    	$repository = new EloquentProductRepository;
    	$status 	= $repository->addToCart($user->id, $request->get('productId'), $productQty);

        if($status)
        {
         	return response()->json((object) [
                    'status'    => true
                ], 200);
        }
    	
    	return response()->json((object) [
                    'status'    => false
            ], 200);
    }

    public function removeProductToCart(Request $request)
    {
    	$user 		= access()->user();
    	$repository = new EloquentProductRepository;
    	$status 	= $repository->removeProductFromCart($user->id, $request->get('productId'));

        if($status)
        {
         	return response()->json((object) [
                    'status'    => true
                ], 200);
        }
    	
    	return response()->json((object) [
                    'status'    => false
            ], 200);
    }

    public function createOrder(Request $request)
    {
        $userInfo = Auth()->user();

        if($userInfo->cart)
        {
        	$repository = new EloquentOrderRepository;
            $orderInfo 	= $repository->cartToOrder($userInfo, $userInfo->cart);

            if(isset($orderInfo) && $orderInfo)
            {
                return response()->json((object) [
                    'status'    => true
                ], 200);
            }
        }

        return response()->json((object) [
                    'status'    => false
            ], 200);
    }

    public function createNewPatient(Request $request)
    {
        $input       = $request->all(); 
        $patientData = [
            'name'          => isset($input['patient_name']) ? strtoupper($input['patient_name']) : '',
            'validity'  => isset($input['patient_validity']) ? $input['patient_validity'] : 6,
            'address'   => isset($input['patient_address']) ? strtoupper($input['patient_address']) : '',
            'city'      => isset($input['patient_city']) ? strtoupper($input['patient_city']) : 'GODHRA',
            'age'       => isset($input['patient_age']) ? $input['patient_age'] : 0,
            'mobile'    => isset($input['mobile']) ? $input['mobile'] : 0
        ];
        
        $patient = Patient::create($patientData);

        $patient->patient_number = $patient->id . date('d') . date('m');
        $patient->save();

        $bookingData = [
            'doctor_id'         => isset($input['doctor_id']) ? $input['doctor_id'] : null,
            'department_id'     => access()->user()->department_id,
            'patient_id'        => $patient->id,
            'department_number' => access()->getDepartmentNumber(),
            'queue_number'      => access()->getQueueNumber(),
            'consulting_fees'   => isset($input['fees']) ? $input['fees'] : 0,
            'total'             => isset($input['fees']) ? $input['fees'] : 0,
            'booking_date'      => date('d-m-Y'),
            'notes'             => 'New Patient Created'
        ];

        $booking = Booking::create($bookingData);

        if($booking)
        {
            return redirect()->route('frontend.user.history.list')->withFlashSuccess('New Booking Created Successfully!');
        }

        return redirect()->route('frontend.index')->withFlashSuccess('Something weng Wrong!');
    }

    public function createNewBooking(Request $request)
    {
        $input = $request->all();

       // dd($input);
        
        if(isset($input['surgery_id']) || isset($input['doctor_id']))
        {
            $doctor     = Doctor::where('id', $input['doctor_id'])->first();
            $patient    = Patient::where('patient_number', $input['new_patient_id'])->first();
            $consulting = 0;
            $surgeryTotal = 0;
            $gnotes     = null;
			$sgIds      = isset($input['surgery_id']) ? $input['surgery_id'] : null;

            if($sgIds && isset($input['surgery_id']) && isset($input['surgery_fees']))
            {
                $totalFees = 0;

                foreach($input['surgery_fees'] as $fKey => $sfees)
                {
					if(in_array($fKey, $sgIds))
					{
					    $totalFees = $totalFees + $sfees;
					}
                }
                /*$surgeries      = Surgery::whereIn('id', $input['surgery_id'])->get();
                $surgeryTotal   = $surgeries->sum('fees');*/
                $surgeryTotal   = $totalFees;
            }

			//dd($surgeryTotal);
			
            if(isset($input['general']) && $input['general'] == 'general')
            {
                $consulting = $input['general_fees'];
                $gnotes     = $input['general_notes'];
            }
            
            $inputData = [
                'department_id'     => access()->user()->department_id,
                'patient_id'        => $patient->id,
                'doctor_id'         => $input['doctor_id'],
                'department_number' => access()->getDepartmentNumber(),
                'queue_number'      => access()->getQueueNumber(),
                'consulting_fees'   => $consulting,
                'total'             => $consulting + $surgeryTotal,
                'booking_date'      => date('d-m-Y'),
                'notes'             => $gnotes ? $gnotes : 'New Surgery Created'
            ];

            $booking = Booking::create($inputData);

            $patientSurgery = [];

            if(isset($input['surgery_id']) && isset($input['surgery_fees']))
            {
                foreach($input['surgery_id'] as $surgeryId)
                {
                    $patientSurgery[] = [
                        'booking_id'    => $booking->id,
                        'patient_id'    => $patient->id,
                        'doctor_id'     => $input['doctor_id'],
                        'surgery_id'    => $input['surgery_id'][$surgeryId],
                        'surgery_fees'  => $input['surgery_fees'][$surgeryId],
                        'notes'         => $input['surgery_notes'][$surgeryId]
                    ];
                }

                if(isset($patientSurgery) && count($patientSurgery))
                {
                    PatientSurgery::insert($patientSurgery);
                }
            }

            return redirect()->route('frontend.user.history.list')->withFlashSuccess('Booking Created Successfully!');
        }

        return redirect()->route('frontend.index')->withFlashDanger('Please Select Doctor or Select Surgery!');
    }

    public function getPatientDetails(Request $request)
    {
        if($request->has('patientId'))
        {
            $patient    = Patient::where('patient_number', $request->get('patientId'))->first();

            if(isset($patient))
            {
                $today      = date('Y-m-d');
                $validTill  = date('Y-m-d', strtotime(date("Y-m-d", strtotime($patient->created_at)) . " +$patient->validity months"));

                if($today < $validTill)
                {
                    return json_encode([
                        'success' => true,
                        'isValid' => 1,
                        'patient' => $patient
                    ]);
                }

                return json_encode([
                    'success' => false,
                    'isValid' => 0,
                    'message' => 'Validity Expired !'
                ]);
            }
        }

        return json_encode([
            'success' => false,
            'isValid' => 2,
            'message' => 'No Patient Found !'
        ]);
    }

    public function timePiece(Request $request)
    {
        $user = access()->user();
        return view('frontend.jewel.page-template')->with('user', $user);
    }

    public function editPatient($id, Request $request)
    {
        $patient = Patient::find($id);

        if(isset($patient) && isset($patient->id))
        {
            return view('frontend.patient.edit')->with([
                'patient' => $patient
            ]);
        }

        return redirect()->route('frontend.user.patients.list')->withFlashDanger('No Patient Found!');
    }

    public function editDoctor($id, Request $request)
    {
        $doctor = Doctor::find($id);
        $departments = Department::where('status', 1)->pluck('name', 'id')->toArray();

        if(isset($doctor) && isset($doctor->id))
        {
            return view('frontend.doctor.edit')->with([
                'departments'   => $departments,
                'doctor'        => $doctor
            ]);
        }

        return redirect()->route('frontend.user.patients.list')->withFlashDanger('No Patient Found!');
    }

    public function deletePatient($id, Request $request)
    {
        $patient = Patient::find($id);

        if(isset($patient) && isset($patient->id))
        {
            $patient->status = 0;
            
            if($patient->save())
            {
                return redirect()->route('frontend.user.patients.list')->withFlashSuccess('Patient Deleted Successfully!');
            }
        }

        return redirect()->route('frontend.user.patients.list')->withFlashDanger('No Patient Found!');
    }

    public function deleteDoctor($id, Request $request)
    {
        $doctor = Doctor::find($id);

        if(isset($doctor) && isset($doctor->id))
        {
            $doctor->status = 0;
            
            if($doctor->save())
            {
                return redirect()->route('frontend.user.doctors.list')->withFlashSuccess('Doctor Deleted Successfully!');
            }
        }

        return redirect()->route('frontend.user.doctors.list')->withFlashDanger('No Doctor Found!');
    }

    public function createSurgery(Request $request)
    {
        return view('frontend.surgery.create');        
    }

    public function storeSurgery(Request $request)
    {
        $input = $request->all();

        $status = Surgery::create($input);

        if($status)
        {
            return redirect()->route('frontend.user.surgery.list')->withFlashSuccess('Surgery Created Successfully!');  
        }

        return redirect()->route('frontend.user.surgery.list')->withFlashDanger('Unable to Create New Surgery!');
    }

    public function editSurgery($id, Request $request)
    {
        $surgery = Surgery::find($id);

        if(isset($surgery) && isset($surgery->id))
        {
            return view('frontend.surgery.edit')->with([
                'surgery' => $surgery
            ]);
        }

        return redirect()->route('frontend.user.surgery.list')->withFlashDanger('No Surgery Found!');
    }  

    public function updateSurgery(Request $request)  
    {
        $input   = $request->all();

        if(isset($input['surgery_id']) && $input['surgery_id'] != '')
        {
            $surgery = Surgery::find($input['surgery_id']); 

            if(isset($surgery) && isset($surgery->id))
            {
                if($surgery->update($input))
                {
                    return redirect()->route('frontend.user.surgery.list')->withFlashSuccess('Surgery Updated Successfully!'); 
                }
            }
        }


        return redirect()->route('frontend.user.surgery.list')->withFlashDanger('No Surgery Found!');
    }

    public function deleteSurgery($id, Request $request)
    {
        $surgery = Surgery::find($id);

        if(isset($surgery) && isset($surgery->id))
        {
            $surgery->status = 0;
            if($surgery->save())
            {
                return redirect()->route('frontend.user.surgery.list')->withFlashSuccess('Surgery Deleted Successfully!'); 
            }
        }

        return redirect()->route('frontend.user.surgery.list')->withFlashDanger('No Surgery Found!');
    }

    public function history(Request $request)
    {
        $startDate  = date('Y-m-d', strtotime('-2 months')) . ' 00:00:00';
        $endDate    = date('Y-m-d') . ' 23:59:59';
        $input      = $request->all();

        if($request->has('startDate') && $request->has('endDate'))
        {
            $dateInput = explode("-", $input['startDate']);
            $customDate = $dateInput[1] . '/' . $dateInput[0]. '/'. $dateInput[2];
            $startDate = Carbon::parse($customDate)->format('Y-m-d') . ' 00:00:00';

            $dateInput = explode("-", $input['endDate']);
            $customDate = $dateInput[1] . '/' . $dateInput[0]. '/'. $dateInput[2];
            $endDate    = Carbon::parse($customDate)->format('Y-m-d') . ' 23:59:59';;
        }
        
        $deptId     = access()->user()->department_id;

        $bookings   = Booking::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('department_id', $deptId)
            ->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])
            ->orderBy('id', 'desc')
            ->get();
        
        return view('frontend.booking.list')->with([
            'bookings'      => $bookings,
            'startDate'     => $startDate,
            'endDate'       => $endDate
        ]);
    }

    public function printEye($id, Request $request)
    {
        $booking = Booking::where('id', $id)->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])->first();
        
        if(isset($booking) && $booking->department_id == 3)
        {
            return view('frontend.pdf.eye-surgery')->with([
                'booking' => $booking
            ]);
        }

        return redirect()->route('frontend.index');
    }

    public function printCasePaper($id, Request $request)
    {
        $booking = Booking::where('id', $id)->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])->first();
        
        if(isset($booking) && isset($booking->id))
        {
            return view('frontend.pdf.cash-paper')->with([
                'booking' => $booking
            ]);
        }

        return redirect()->route('frontend.index');
    }

    public function print($id, Request $request)
    {
        $booking = Booking::where('id', $id)->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])->first();
        
       /* if(isset($booking) && $booking->department_id == 1)
        {
            return view('frontend.pdf.eye-surgery')->with([
                'booking' => $booking
            ]);
        }*/
        
        if(isset($booking->surgeries) && count($booking->surgeries))
        {

            return view('frontend.pdf.surgery')->with([
                'booking' => $booking
            ]);
        }

        return view('frontend.pdf.cash')->with([
            'booking' => $booking
        ]);
    }

    public function printHistory(Request $request)
    {
        $startDate  = date('Y-m-d', strtotime('-2 months')) . ' 00:00:00';
        $endDate    = date('Y-m-d') . ' 23:59:59';
        $input      = $request->all();

        if($request->has('startDate') && $request->has('endDate'))
        {
            $startDate  = $request->get('startDate');
            $endDate    = $request->get('endDate');
        }
        
        $bookings = Booking::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])
            ->orderBy('id', 'desc')
            ->get();

        $filename = "report.csv";
        $handle = fopen($filename, 'w+');
        
        fputcsv($handle, [
                'Department',
                'Patient Name',
                'Patient Number',
                'Doctor',
                'Fees',
                'Total',
                'Surgery'
            ]);
            
        foreach($bookings as $booking) 
        {
            fputcsv($handle, [
                'dept'      => access()->getUserDepartment(),
                'name'      => $booking->patient->name,
                'number'    => $booking->patient->patient_number,
                'doctor'    => $booking->doctor->name,
                'fees'      => $booking->consulting_fees,
                'total'     => $booking->total,
                'surgery'   => isset($booking->surgeries) ? access()->getBookingSurgeries($booking->surgeries) : '-'
            ]);
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'report.csv', $headers);
    }

    public function printPDFHistory(Request $request)
    {
        $startDate  = date('Y-m-d', strtotime('-2 months')) . ' 00:00:00';
        $endDate    = date('Y-m-d') . ' 23:59:59';
        $input      = $request->all();

        if(access()->user()->id == 1)
        {
            $department = Department::where('id', $input['deptId'])->first();
        }
        else
        {
            $department = access()->getCurrentDepartment();
        }

        if($request->has('startDate') && $request->has('endDate'))
        {
            $startDate  = $request->get('startDate');
            $endDate    = $request->get('endDate');
        }
        
        $data = Booking::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('department_id', $department->id)
            ->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])
            ->orderBy('id')
            ->get();

        
        $departmentName = $department->name;
        $pdf = PDF::loadView('frontend.pdf.pdf-report', compact('data', 'startDate', 'endDate', 'departmentName'));
        
        return $pdf->download('report.pdf');
    }

    public function showXrayForm()
    {
        $user = access()->user();

        if($user)
        {
            $condition  = [
                'status'        => 1,
                'department_id' => $user->department_id 
            ];
        }
        else
        {
            $condition  = [
                'status'        => 1 
            ];
        }

        $doctors    = Doctor::where($condition)->pluck('name', 'id')->toArray();
        $xRays      = XRay::get();

        return view('frontend.x-ray.show-form')->with([
            'doctors'       => $doctors,
            'xRays'         => $xRays
        ]);
    }

    public function storeXray(Request $request)
    {
        $input = $request->all();

        //dd($input);

        $patientData = [
            'name'      => isset($input['patient_name']) ? strtoupper($input['patient_name']) : '',
            'validity'  => isset($input['patient_validity']) ? $input['patient_validity'] : 6,
            'address'   => isset($input['patient_address']) ? strtoupper($input['patient_address']) : '',
            'city'      => isset($input['patient_city']) ? strtoupper($input['patient_city']) : 'GODHRA',
            'age'       => isset($input['patient_age']) ? $input['patient_age'] : 0,
            'mobile'    => isset($input['mobile']) ? $input['mobile'] : 0
        ];

        $patient = Patient::create($patientData);

        if(isset($patient))
        {
            $patient->patient_number = $patient->id . date('d') . date('m');

            $patient->save();
        }

        if(isset($input['doctor_id']))
        {
            $doctor = Doctor::where('id', $input['doctor_id'])->first();
        }

        
        $selectedXray   = $input['xrayR'];
        $fXray          = null;
        $xRayData       = [];
        $myXray         = XRay::whereIn('id', $selectedXray)->get();

        if(isset($myXray) && count($myXray))
        {
            $sr = 0;
            foreach($myXray as $myX)
            {
                $xrayTitle      = $myX->title;
                $xrayCost       = $input['xray'][$myX->id];
                $xrayDesc       = $input['xrayD'][$myX->id];
               
                if($sr == 0) 
                {
                    $firstXRay = [
                        'department_id'     => access()->user()->department_id,
                        'patient_id'        => $patient->id,
                        'xray_id'           => $myX->id,
                        'doctor_id'         => isset($input['doctor_id']) ? $input['doctor_id'] : null,
                        'doctor_name'       => (isset($input['doctor_id']) && isset($doctor) && isset($doctor->id) )? $doctor->name : $input['outside_doctor'],
                        'xray_title'        => $xrayTitle,
                        'xray_cost'         => $xrayCost,
                        'xray_description'  => $xrayDesc
                    ];

                    $fXray = PatientXRay::create($firstXRay);
                }
                else
                {
                    $xRayData[] = [
                        'parent_id'         => isset($fXray) ? $fXray->id : null,
                        'department_id'     => access()->user()->department_id,
                        'patient_id'        => $patient->id,
                        'xray_id'           => $myX->id,
                        'doctor_id'         => isset($input['doctor_id']) ? $input['doctor_id'] : null,
                        'doctor_name'       => (isset($input['doctor_id']) && isset($doctor) && isset($doctor->id) )? $doctor->name : $input['outside_doctor'],
                        'xray_title'        => $xrayTitle,
                        'xray_cost'         => $xrayCost,
                        'xray_description'  => $xrayDesc
                    ];
                }

                $sr++;
            }

            if(isset($xRayData) && count($xRayData))
            {
                $xRayPatient = PatientXRay::insert($xRayData);
                
                if($xRayPatient)
                {
                    return redirect()->route('frontend.user.x-ray.list')->withFlashSuccess('XRay Added Successfully!');
                }
            }
        }
            
        return redirect()->route('frontend.user.x-ray.list')->withFlashDanger('Unable to Add XRay!');;
    }

    public function storeNewXray(Request $request)
    {
        $input      = $request->all();
        $patient    = Patient::where('patient_number', $input['new_patient_id'])->first();

        if(isset($patient))
        {
            if(isset($input['doctor_id']))
            {
                $doctor = Doctor::where('id', $input['doctor_id'])->first();
            }

            $selectedXray   = $input['xrayR'];
            $fXray          = null;
            $xRayData       = [];
            $myXray         = XRay::whereIn('id', $selectedXray)->get();

            if(isset($myXray) && count($myXray))
            {
                $sr = 0;
                foreach($myXray as $myX)
                {
                    $xrayTitle      = $myX->title;
                    $xrayCost       = $input['xray'][$myX->id];
                    $xrayDesc       = $input['xrayD'][$myX->id];
                   
                    if($sr == 0) 
                    {
                        $firstXRay = [
                            'department_id'     => access()->user()->department_id,
                            'patient_id'        => $patient->id,
                            'xray_id'           => $myX->id,
                            'doctor_id'         => isset($input['doctor_id']) ? $input['doctor_id'] : null,
                            'doctor_name'       => (isset($input['doctor_id']) && isset($doctor) && isset($doctor->id) )? $doctor->name : $input['outside_doctor'],
                            'xray_title'        => $xrayTitle,
                            'xray_cost'         => $xrayCost,
                            'xray_description'  => $xrayDesc
                        ];

                        $fXray = PatientXRay::create($firstXRay);
                    }
                    else
                    {
                        $xRayData[] = [
                            'parent_id'         => isset($fXray) ? $fXray->id : null,
                            'department_id'     => access()->user()->department_id,
                            'patient_id'        => $patient->id,
                            'xray_id'           => $myX->id,
                            'doctor_id'         => isset($input['doctor_id']) ? $input['doctor_id'] : null,
                            'doctor_name'       => (isset($input['doctor_id']) && isset($doctor) && isset($doctor->id) )? $doctor->name : $input['outside_doctor'],
                            'xray_title'        => $xrayTitle,
                            'xray_cost'         => $xrayCost,
                            'xray_description'  => $xrayDesc
                        ];
                    }

                    $sr++;
                }

                if(isset($xRayData) && count($xRayData))
                {
                    $xRayPatient = PatientXRay::insert($xRayData);
                    
                    if($xRayPatient)
                    {
                        return redirect()->route('frontend.user.x-ray.list')->withFlashSuccess('XRay Added Successfully!');
                    }
                }
            }

            /*$selectedXray   = $input['xrayR'];
            $myXray         = XRay::where('id', $selectedXray)->first();

            if(isset($myXray) && isset($myXray->id))
            {
                $xrayTitle      = $myXray->title;
                $xrayCost       = $input['xray'][$selectedXray];
                $xrayDesc       = $input['xrayD'][$selectedXray];

                $xRayData = [
                    'department_id'     => access()->user()->department_id,
                    'patient_id'        => $patient->id,
                    'xray_id'           => $input['xrayR'],
                    'doctor_id'         => isset($input['doctor_id']) ? $input['doctor_id'] : null,
                    'doctor_name'       => (isset($input['doctor_id']) && isset($doctor) && isset($doctor->id) )? $doctor->name : $input['outside_doctor'],
                    'xray_title'        => $xrayTitle,
                    'xray_cost'         => $xrayCost,
                    'xray_description'  => $xrayDesc
                ];

                $xRayPatient = PatientXRay::create($xRayData);

                if($xRayPatient)
                {
                    return redirect()->route('frontend.user.x-ray.list')->withFlashSuccess('XRay Added Successfully!');
                }
            }*/
        }

        return redirect()->route('frontend.user.x-ray.list')->withFlashDanger('Unable to Add XRay!');;
    }

    public function xrayList(Request $request)
    {
        $startDate  = date('Y-m-d', strtotime('-2 months')) . ' 00:00:00';
        $endDate    = date('Y-m-d') . ' 23:59:59';
        $input      = $request->all();

        if($request->has('startDate') && $request->has('endDate'))
        {
            $dateInput = explode("-", $input['startDate']);
            $customDate = $dateInput[1] . '/' . $dateInput[0]. '/'. $dateInput[2];
            $startDate = Carbon::parse($customDate)->format('Y-m-d') . ' 00:00:00';

            $edateInput = explode("-", $input['endDate']);
            $ecustomDate = $edateInput[1] . '/' . $edateInput[0]. '/'. $edateInput[2];
            $endDate    = Carbon::parse($ecustomDate)->format('Y-m-d') . ' 23:59:59';
        }

        $xrays = PatientXRay::with('chlidren')->where('department_id', access()->user()->department_id)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('parent_id', NULL)
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.x-ray.list')->with([
            'xrays'         => $xrays,
            'startDate'     => $startDate,
            'endDate'       => $endDate
        ]);        
    }

    public function xrayPrint($id, Request $request)
    {
        $xray = PatientXRay::with('chlidren')->where('id', $id)
            ->first();

        if(isset($xray) && isset($xray->id))
        {
            return view('frontend.pdf.xray')->with([
                'xray' => $xray
            ]);
        }

        return redirect()->route('frontend.index');
    }


    public function reportPDF(Request $request)
    {
        $department = access()->getCurrentDepartment();
        $startDate  = date('Y-m-d', strtotime('-2 months')) . ' 00:00:00';
        $endDate    = date('Y-m-d') . ' 23:59:59';
        $input      = $request->all();
        $department = access()->getCurrentDepartment();

        if($request->has('startDate') && $request->has('endDate'))
        {
            $startDate  = $request->get('startDate');
            $endDate    = $request->get('endDate');
        }

        if(access()->user()->id == 1)
        {
            $deptId = $request->has('department_id') ? $request->get('department_id')  : null;

            if(isset($deptId))
            {
                $data = PatientXRay::where('department_id', $deptId)
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->where('parent_id', '=', NULL)
                ->with(['patient'])
                ->orderBy('id')
                ->get();
            }
            else
            {
                $data = PatientXRay::where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->where('parent_id', '=', NULL)
                ->with(['patient'])
                ->orderBy('id')
                ->get();
            }

            $departmentName = "Admin Report";
        }
        else
        {
            $data = PatientXRay::with(['patient', 'department', 'chlidren'])->where('department_id', $department->id)
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->where('parent_id', '=', NULL)
                ->with(['patient'])
                ->orderBy('id')
                ->get();
            $departmentName = $department->name;
        }


        $pdf = PDF::loadView('frontend.pdf.pdf-xray-report', compact('data', 'startDate', 'endDate', 'departmentName'));
        
        return $pdf->download('report.pdf');        
    }
}
