<div class="box-body">
    <div class="form-group">
        {{ Form::label('department_id', 'Department Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('department_id', null, ['class' => 'form-control', 'placeholder' => 'Department Id', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('xray_id', 'Xray Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('xray_id', null, ['class' => 'form-control', 'placeholder' => 'Xray Id', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('patient_id', 'Patient Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('patient_id', null, ['class' => 'form-control', 'placeholder' => 'Patient Id', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('doctor_id', 'Doctor Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('doctor_id', null, ['class' => 'form-control', 'placeholder' => 'Doctor Id', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('xray_title', 'Xray Title :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('xray_title', null, ['class' => 'form-control', 'placeholder' => 'Xray Title', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('xray_cost', 'Xray Cost :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('xray_cost', null, ['class' => 'form-control', 'placeholder' => 'Xray Cost', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('xray_description', 'Xray Description :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('xray_description', null, ['class' => 'form-control', 'placeholder' => 'Xray Description', 'required' => 'required']) }}
        </div>
    </div>
</div>