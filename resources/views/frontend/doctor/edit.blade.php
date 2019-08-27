@extends('frontend.layouts.app')

@section('content')

<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
        <div id="Add_Patient" class="col-md-6 p-0 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                <h3> Update Doctor </h3>
                <hr>

                <form method="post" action="{!! route('frontend.user.doctors.update') !!}" id="add_new">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" value="{!! $doctor->name !!}" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input  value="{!! $doctor->designation !!}" id="designation" name="designation" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fees">Fees</label>
                        <input  value="{!! $doctor->fees !!}" id="fees" name="fees" type="number" min="0" required="required" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Department</label>
                        {!! Form::select('department_id', ['' => 'Select Department'] + $departments, 
                            isset($doctor->department_id) ? $doctor->department_id : null,
                            [
                            'class' => 'form-control',
                            'required'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="mobile">Contact Number</label>
                        <input id="mobile" value="{!! $doctor->mobile !!}"  name="mobile" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control">{!! $doctor->notes !!}</textarea>
                    </div>

                    {{ csrf_field() }}
                    <input type="submit" name="save-new" value="Update"  class="btn btn-success mr-2 mt-1">
                    <input type="hidden" value="{!! $doctor->id !!}" name="doctor_id">
                    <button type="submit" class="btn btn-info mr-2 mt-1">Print</button>
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