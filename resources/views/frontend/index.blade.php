@if(!access()->user())
<script type="text/javascript">
    window.location.assign('/login');
</script>
@endif
@extends('frontend.layouts.app')

@section('content')

<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
        <div id="Add_Patient" class="col-md-6 p-0 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                <div class="text-center col-sm-12"><h4 class="card-title mb-3">Add Patient</h4>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio" value="New">
                        <!-- {!! trans('labels.patel.new_patient') !!} -->
                            દર્દી  
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optradio" value="Existing">
                            <!-- {!! trans('labels.patel.old_patient') !!} -->
                            સારવાર / જૂનું દર્દી
                        </label>
                    </div>
                </div>

                <form method="post" action="{!! route('frontend.user.patient.create') !!}" id="add_new" style="display:none;">
                    <div class="form-group">
                        <label for="patient_name">{!! trans('labels.patel.patient_name') !!}</label>
                        <input  required="required" name="patient_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_age') !!}</label>
                        <input required="required" name="patient_age" type="number" min="0" max="100" step="1" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_contact') !!}</label>
                        <input name="mobile" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_validity') !!}</label>
                        <select  required="required" name="patient_validity" class="form-control">
                            <option value="">Select</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_address') !!}</label>
                        <input required="required" name="patient_address" id="patient_address" type="text" class="form-control">
                    </div> -->

                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_city') !!}</label>
                        <input required="required" name="patient_city" id="patient_city" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="doctor_id">{!! trans('labels.patel.consult_doctor') !!}</label>
                        {{ Form::select('doctor_id', ['' => 'Please select Doctor'] + $doctors, null, [
                            'id'    => 'doctor_id',
                            'class' => 'form-control',
                            'required'
                        ]) }}
                    </div>
                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.consulting_fees') !!}</label>
                        <input required="required" name="fees" id="doctor_fees" type="text" class="form-control">
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" name="save-new" value="Add"  class="btn btn-success mr-2 mt-1">
                    <input type="reset" class="btn btn-info" value="Reset">
                </form>

                <form method="post" action="{!! route('frontend.user.booking.create') !!}" id="add_old" style="display:none;">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_number') !!}</label>
                        <input type="text" class="form-control" value="" id="patient_id">
                    </div>
                    <div class="form-group">
                    <span id="Search_Patient" class="btn btn-success mr-2 mt-1">Search</span>
                    <span id="errorMessage" class="info mr-2 mt-1"></span>
                    </div>

                    <div id="search_form" style="display:none;">
                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_name') !!}</label>
                        <input required="required" type="text" class="form-control" id="patient_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_age') !!}</label>
                        <input required="required" type="text" class="form-control" id="patient_age" name="patient_age" value="0">
                    </div>
                    <div class="form-group">
                        <label for="">{!! trans('labels.patel.patient_validity') !!}</label>
                        <select required="required" name="patient_validity" id="patient_validity" class="form-control">
                            <option value="">Select</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                        </select>
                    </div>
    
                    <div class="form-group">
                        <label for="doctor_id">{!! trans('labels.patel.consult_doctor') !!}</label>
                        {{ Form::select('doctor_id', ['' => 'Please select Doctor'] + $doctors, null, [
                            'class' => 'form-control',
                            'required',
                            'id'    => 'general_doctor_id'
                        ]) }}
                    </div>
                    
                    <div class="form-group">
                    <label for="">{!! trans('labels.patel.select_surgery') !!}</label>

                        <div class="form-check display-block">
                        <label class="form-check-label display-inline">
                            <input name="general" type="checkbox" value="general" class="form-check-input">
                            General
                        </label>
                        <label>
                            
                        </label>

                            <input  name="general_notes" placeholder="Notes" type="text" class="form-control display-inline radio-input">

                            <input placeholder="General Fees" id="general_fees"  name="general_fees" type="text" class="form-control display-inline radio-input">


                        </div>

                        @if(isset($surgeries))
                            @foreach($surgeries as $surgery)
                                <div class="form-check display-block">
                                <label class="form-check-label display-inline">
                                    <input name="surgery_id[{!! $surgery->id !!}]" type="checkbox" value="{!! $surgery->id !!}" class="form-check-input">
                                    {!! $surgery->title !!}
                                </label>
                                <label>
                                    ( ₹ {!! $surgery->fees !!}  )
                                </label>

                                <input  name="surgery_notes[{!! $surgery->id !!}]" type="text" placeholder="Notes" class="form-control display-inline radio-input">

                                <input name="surgery_fees[{!! $surgery->id !!}]" value="{!! $surgery->fees !!}" type="number" placeholder="Fees" step="1" min="0" class="form-control display-inline radio-input">

                                
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <input type="hidden" name="new_patient_id" id="new_patient_id">
                    <input type="submit" name="Create" value="Save" class="btn btn-success mr-2 mt-1">
                    <a class="btn btn-info mr-2 mt-1" href="{!! route('frontend.user.history.list') !!}">
                        History
                    </a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</main>


@endsection

@section('footer')
 <script type="text/javascript">

    var allDoctors = JSON.parse('{!! isset($allDoctors) ?  json_encode($allDoctors) : json_encode([])!!}');

    if(document.getElementById("doctor_id"))
    {
        document.getElementById("doctor_id").onchange = function(e)
        {
            resetFees(e.target.value);
        }
    }

    if(document.getElementById("general_doctor_id"))
    {
        document.getElementById("general_doctor_id").onchange = function(e)
        {
            resetGeneralFees(e.target.value);
        }
    }

    function resetFees(doctorId)
    {
        for(var i = 0; i < allDoctors.length; i++)
        {
            if(allDoctors[i].id == doctorId)
            {
                document.getElementById('doctor_fees').value = allDoctors[i].fees;
            }
        }
    }

    function resetGeneralFees(doctorId)
    {
        for(var i = 0; i < allDoctors.length; i++)
        {
            if(allDoctors[i].id == doctorId)
            {
                document.getElementById('general_fees').value = allDoctors[i].fees;
            }
        }
    }
    console.log(allDoctors);

       $("#add_new").hide();
       $("#add_old").hide();
       
    jQuery("input[name='optradio']:radio").change(function() 
    {
        console.log($(this).val());
        jQuery("#add_new").toggle($(this).val() == "New");
        jQuery("#add_old").toggle($(this).val() == "Existing");
    });
      
      $( "#Search_Patient" ).click(function()
      {
        fetchPatientById();
       
      });
      
      $( "#Show_History" ).click(function() {
  $("#history").show();
  $("#Add_Patient").hide();
});
$( "#Close_History" ).click(function() {
  $("#Add_Patient").show();
  $("#history").hide();
});

function fetchPatientById()
{
    jQuery.ajax(
    {
        url: "{!! route('frontend.user.patient.get-patient-details') !!}",
        method: 'POST',
        dataType: 'JSON',
        data: {
            patientId: document.getElementById('patient_id').value,
            "_token": "{{ csrf_token() }}",
        },
        success: function(data)
        {
            if(data.success == true)
            {
                document.getElementById('errorMessage').innerHTML = '';
                    
                resetPatientDetails(data.patient);
                jQuery("#search_form").show();
                jQuery("#Search_Patient").hide();

                document.getElementById('new_patient_id').value = document.getElementById('patient_id').value;
                return;
            }
            
            if(data.isValid.toString() == "0") 
            {
                document.getElementById('errorMessage').innerHTML = '<span style="color: red;">'+ data.message + '</span>' ;
                return 
            }

            document.getElementById('errorMessage').innerHTML = data.message;
        },
        error: function(data)
        {
            document.getElementById('errorMessage').innerHTML = "No Patient Found!";
        }
    });
}

function resetPatientDetails(patient)
{
    document.getElementById('patient_name').value       = patient.name;
    document.getElementById('patient_age').value        = patient.age;
    document.getElementById('patient_validity').value   = patient.validity;
}
</script> 
@endsection