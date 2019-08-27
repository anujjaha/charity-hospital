@extends('frontend.layouts.app')

@section('content')
<style type="text/css">
#all-listing_wrapper {
    display: block !important;
}
</style>


<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
        <div id="Add_Patient" class="col-md-12 p-0 grid-margin stretch-card m-auto">
            <div class="card">
               <div class="card-body">
                <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    List All Doctors
                  </div>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="all-listing"  class="table table-striped">
                <thead>
                  <tr>
                      <th>Actions</th>
                      <th>Sr no.</th>
                      <th>Doctor Name</th>
                      <th>Department</th>
                      <th>Consulting fee</th>
                  </tr>
                </thead>
                <tbody>
                    @if(isset($doctors))
                        @foreach($doctors as $doctor)
                            <tr class="erow">
                                <td>
                                    <div class="dt-buttons">
                                        <a class="btn btn-info btn-sm" href="{!! route('frontend.user.doctors.edit', ['id' => $doctor->id]) !!}">
                                        <i class="mdi mdi-lead-pencil"></i></a>
                                        <a class="btn btn-danger btn-sm" href="{!! route('frontend.user.doctors.destroy', ['id' => $doctor->id]) !!}"><i class="mdi mdi-trash-can"></i></a>
                                    </div>
                                </td>
                                <td>{!! $doctor->id !!}</td>
                                <td>Dr. {!! $doctor->name !!}</td>
                                <td>{!! isset($doctor->department) ? $doctor->department->name : '' !!}</td>
                                <td>{!! $doctor->fees !!}</td>
                            </tr>

                        @endforeach
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</main>


@endsection

@section('footer')
{{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}
 <script type="text/javascript">
    jQuery(document).ready(function()
    {
        jQuery('#all-listing').dataTable();
    })
</script> 
@endsection