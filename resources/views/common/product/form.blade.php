<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'Title :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('category_id', 'Choose Category :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('category_id', $categoryRepository->getSelectOptions('id', 'title') , null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('product_code', 'Product Code :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' => 'Product Code', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('price', 'Price :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::number('price', isset($item->price) ? $item->price : 0.00, ['min' => 0.00, 'step' => 0.1, 'class' => 'form-control', 'placeholder' => 'Price', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('qty', 'Quantity :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::number('qty', isset($item->qty) ? $item->qty : 1, ['min' => 1, 'step' => 1, 'class' => 'form-control', 'placeholder' => 'Quantity', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('description', 'Description :', ['class' => 'col-lg-2 control-label']) }}
        <div class="col-lg-10">
            {{ Form::textarea('description', null, ['rows' => 4, 'cols' => 40, 'class' => 'form-control']) }}
        </div>
    </div>
</div>


<div class="box-body">
    <div class="form-group">
        {{ Form::label('image', 'Select Image :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image))
            {{ Html::image('/uploads/product/'.$item->image, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('image1', 'Select Image1 :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image1', null, ['class' => 'form-control']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image1))
            {{ Html::image('/uploads/product/'.$item->image1, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('image2', 'Select Image2 :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image2', null, ['class' => 'form-control']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image2))
            {{ Html::image('/uploads/product/'.$item->image2, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('image3', 'Select Image3 :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('image3', null, ['class' => 'form-control']) }}
        </div>

    </div>
    <center>
        @if(isset($item->image3))
            {{ Html::image('/uploads/product/'.$item->image3, 'Image', ['width' => 250, 'height' => 250]) }}
        @endif
    </center>
</div>