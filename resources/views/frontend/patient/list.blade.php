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
                    List All Patients
                  </div>
                <div class="clearfix"></div>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive ">
              <table id="all-listing" style="display: block;" class="table table-striped container-fluid d-block">
                <thead>
                  <tr>
                      <th>Actions</th>
                      <th>Sr no.</th>
                      <th>Unique Number</th>
                      <th>Name</th>
                      <th>Age</th>
                      <th>Validity</th>
                  </tr>
                </thead>
                <tbody>
                    @if(isset($patients))
                        @foreach($patients as $patient)
                            <tr class="erow">
                                <td>
                                    <div class="dt-buttons">
                                        <a class="btn btn-info btn-sm" href="{!! route('frontend.user.patients.edit', ['id' => $patient->id]) !!}">
                                          <i class="mdi mdi-lead-pencil"></i></a>
                                        <a class="btn btn-danger btn-sm" href="{!! route('frontend.user.patients.destroy', ['id' => $patient->id]) !!}"><i class="mdi mdi-trash-can"></i></a>
                                    </div>
                                </td>
                                <td>{!! $patient->id !!}</td>
                                <td>{!! $patient->patient_number !!}</td>
                                <td>{!! $patient->name !!}</td>
                                <td>{!! $patient->age !!}</td>
                                <td>{!! $patient->validity !!}</td>
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