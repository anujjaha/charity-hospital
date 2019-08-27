<div class="box-body">
    <div class="form-group">
        {{ Form::label('doctor_id', 'Doctor Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('doctor_id', null, ['class' => 'form-control', 'placeholder' => 'Doctor Id', 'required' => 'required']) }}
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
        {{ Form::label('queue_number', 'Queue Number :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('queue_number', null, ['class' => 'form-control', 'placeholder' => 'Queue Number', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('consulting_fees', 'Consulting Fees :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('consulting_fees', null, ['class' => 'form-control', 'placeholder' => 'Consulting Fees', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('notes', 'Notes :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('notes', null, ['class' => 'form-control', 'placeholder' => 'Notes', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('status', 'Status :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('status', null, ['class' => 'form-control', 'placeholder' => 'Status', 'required' => 'required']) }}
        </div>
    </div>
</div>