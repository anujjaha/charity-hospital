@extends('frontend.layouts.app')

@section('content')

<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
        <div id="Add_Patient" class="col-md-6 p-0 grid-margin stretch-card m-auto">
            <div class="card">
                <div class="card-body">
                <h3> Update Surgery </h3>
                <hr>

                <form method="post" action="{!! route('frontend.user.surgery.update') !!}" id="add_new">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" value="{!! $surgery->title !!}" type="text" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="fees">Fees</label>
                        <input id="fees"  value="{!! $surgery->fees !!}"  name="fees" type="number" min="0" required="required" class="form-control">
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control">{!! $surgery->notes !!}</textarea>
                    </div>

                    {{ csrf_field() }}
                    <input type="hidden" name="surgery_id" value="{!! $surgery->id !!}">
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