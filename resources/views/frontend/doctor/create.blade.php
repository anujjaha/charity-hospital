@extends('frontend.layouts.app')

@section('content')

<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
        <div id="Add_Patient" class="col-md-6 p-0 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                <h3> Create New Doctor </h3>
                <hr>

                <form method="post" action="{!! route('frontend.user.doctors.store') !!}" id="add_new">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input id="designation" name="designation" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fees">Fees</label>
                        <input id="fees" name="fees" type="number" min="0" required="required" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Department</label>
                        {!! Form::select('department_id', ['' => 'Select Department'] + $departments, null, [
                            'class' => 'form-control',
                            'required'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="designation">Contact Number</label>
                        <input id="mobile" name="mobile" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>

                    {{ csrf_field() }}
                    <input type="submit" name="save-new" value="Create"  class="btn btn-success mr-2 mt-1">
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