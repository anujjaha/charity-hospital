@extends('frontend.layouts.app')

@section('content')

<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
        <div id="Add_Patient" class="col-md-6 p-0 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                <h3> Edit Patient </h3>
                <hr>

                <form method="post" action="{!! route('frontend.user.patients.update') !!}" id="add_new">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" value="{!! $patient->name !!}" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input  value="{!! $patient->age !!}"  id="age" name="age" max="100" type="number" min="0" required="required" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="validity">Validity</label>
                        {!! Form::select('validity', ['' => 'Select Validity',
                                1 => 1,
                                2 => 2,
                                3 => 3,
                                4 => 4,
                                5 => 5,
                                6 => 6
                            ], isset($patient->validity) ? $patient->validity : null, [
                            'class' => 'form-control',
                            'required'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="designation">Contact Number</label>
                        <input  value="{!! $patient->mobile !!}"  id="mobile" name="mobile" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address"  class="form-control">{!! $patient->address !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control">{!! $patient->notes !!}</textarea>
                    </div>

                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" value="{!! $patient->id !!}">
                    <input type="submit" name="save-new" value="Update"  class="btn btn-success mr-2 mt-1">
                    <input type="reset" class="btn btn-info" value="Reset">
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
</script> 
@endsection