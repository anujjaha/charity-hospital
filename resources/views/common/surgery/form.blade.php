
<div class="box-body">
    <div class="form-group">
        {{ Form::label('department_id', 'Department Id :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::select('department_id', ['' => 'Select Department'] + $departments,  null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
        </div>
    </div>
</div><div class="box-body">
    <div class="form-group">
        {{ Form::label('fees', 'Fees :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('fees', null, ['class' => 'form-control', 'placeholder' => 'Fees', 'required' => 'required']) }}
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
            {{ Form::select('status', 
            [
                1 => 'Active',
                0 => 'In-active'
            ],
             null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>