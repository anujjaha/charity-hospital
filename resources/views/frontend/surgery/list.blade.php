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
                    List All Surgeries
                  </div>
                <div style="margin-bottom: 10px;">
                  <a href="{!! route('frontend.user.surgery.create') !!}" class="btn btn-primary">
                    Create New
                  </a>
                </div>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="all-listing"  class="table table-striped">
                <thead>
                  <tr>
                      <th>Actions</th>
                      <th>Sr no.</th>
                      <th>Title</th>
                      <th>Fees</th>
                      <th>Notes</th>
                  </tr>
                </thead>
                <tbody>
                    @if(isset($surgeries))
                        @foreach($surgeries as $surgery)
                            <tr class="erow">
                                <td>
                                    <div class="dt-buttons">
                                        <a class="btn btn-info btn-sm" href="{!! route('frontend.user.surgery.edit', ['id' => $surgery->id]) !!}"><i class="mdi mdi-lead-pencil"></i></a>
                                        <a class="btn btn-danger btn-sm" href="{!! route('frontend.user.surgery.destroy', ['id' => $surgery->id]) !!}"><i class="mdi mdi-trash-can"></i></a>
                                    </div>
                                </td>
                                <td>{!! $surgery->id !!}</td>
                                <td> {!! $surgery->title !!}</td>
                                <td> {!! $surgery->fees !!}</td>
                                <td>{!! $surgery->notes !!}</td>
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
    jQuery('#all-listing').dataTable({
          autoWidth: false,
          drawCallback: function( settings ) {
              if(jQuery("#all-listing_wrapper"))
              {
                jQuery("#all-listing_wrapper").removeClass('form-inline');

              }
          }
        });
</script> 
@endsection