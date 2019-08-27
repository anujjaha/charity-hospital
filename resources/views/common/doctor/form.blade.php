<div class="box-body">
    <div class="form-group">
        {{ Form::label('department_id', 'Department Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::select('department_id', ['' => 'Select Department'] + $departments,  null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'Name :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('designation', 'Designation :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('designation', null, ['class' => 'form-control', 'placeholder' => 'Designation', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('mobile', 'Mobile :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Mobile', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('other_contact', 'Other Contact :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('other_contact', null, ['class' => 'form-control', 'placeholder' => 'Other Contact']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('emailid', 'Emailid :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('emailid', null, ['class' => 'form-control', 'placeholder' => 'Emailid']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('address', 'Address :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Address']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('city', 'City :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('state', 'State :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('zip', 'Zip :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('zip', null, ['class' => 'form-control', 'placeholder' => 'Zip']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
        </div>
    </div>
</div>