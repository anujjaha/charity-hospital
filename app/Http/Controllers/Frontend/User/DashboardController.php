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
use Barryvdh\DomPDF\Facade as PDF;

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
            'age'       => isset($input['patient_age']) ? $input['patient_age'] : 0,
            'mobile'       => isset($input['mobile']) ? $input['mobile'] : 0,
        ];
        
        $patient = Patient::create($patientData);

        $patient->patient_number = $patient->id . date('d') . date('m');
        $patient->save();

        $bookingData = [
            'doctor_id'         => isset($input['doctor_id']) ? $input['doctor_id'] : null,
            'department_id'     => access()->user()->department_id,
            'patient_id'        => $patient->id,
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
        if(isset($input['surgery_id']) && isset($input['doctor_id']))
        {
            $surgeries  = Surgery::whereIn('id', $input['surgery_id'])->get();
            $doctor     = Doctor::where('id', $input['doctor_id'])->first();
            $patient    = Patient::where('patient_number', $input['new_patient_id'])->first();

            $inputData = [
                'department_id' => access()->user()->department_id,
                'patient_id'    => $patient->id,
                'doctor_id'     => $input['doctor_id'],
                'queue_number'  => access()->getQueueNumber(),
                'consulting_fees' => $doctor->fees,
                'total'         => $doctor->fees + $surgeries->sum('fees'),
                'booking_date'  => date('d-m-Y'),
                'notes'         => 'New Surgery Created'
            ];

            $booking = Booking::create($inputData);

            $patientSurgery = [];

            foreach($surgeries as $surgery)
            {
                $patientSurgery[] = [
                    'booking_id'    => $booking->id,
                    'patient_id'    => $patient->id,
                    'doctor_id'     => $input['doctor_id'],
                    'surgery_id'    => $surgery->id,
                    'notes'         => $input['surgery_notes'][$surgery->id]
                ];
            }

            if(isset($patientSurgery) && count($patientSurgery))
            {
                PatientSurgery::insert($patientSurgery);
            }

            return redirect()->route('frontend.index')->withFlashSuccess('Booking Created Successfully!');
        }

        return redirect()->route('frontend.index')->withFlashDanger('Something weng Wrong!');
    }

    public function getPatientDetails(Request $request)
    {
        if($request->has('patientId'))
        {
            $patient = Patient::where('patient_number', $request->get('patientId'))->first();

            if(isset($patient))
            {
                return json_encode([
                    'success' => true,
                    'patient' => $patient
                ]);
            }
        }
        return json_encode([
            'success' => false
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
        $today = date('d-m-Y');

        if($request->has('filterDate'))
        {
            $today = $request->get('filterDate');
        }

        $bookings = Booking::where('booking_date', $today)->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])
        ->orderBy('id', 'desc')
        ->get();
        
        return view('frontend.booking.list')->with([
            'bookings' => $bookings,
            'today'     => $today
        ]);
    }

    public function print($id, Request $request)
    {
        $booking = Booking::where('id', $id)->with(['doctor', 'patient', 'surgeries', 'surgeries.surgery'])->first();
        
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
}
