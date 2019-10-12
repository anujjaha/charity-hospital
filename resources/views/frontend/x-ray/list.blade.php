@extends('frontend.layouts.app')

@section('content')
<style type="text/css">
#all-listing_wrapper {
    display: block !important;
}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
        <div id="Add_Patient" class="col-md-12 p-0 grid-margin stretch-card m-auto">
            <div class="card">
               <div class="card-body">
                <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    X-Ray List
                </div>
                <div class="pull-right">
                <form method="post" action="{!! route('frontend.user.x-ray.list') !!}" id="filter">
                  <input class="datepicker" type="text" id="startDate" name="startDate" value="{!! date('d-m-Y', strtotime($startDate)) !!}">
                <input  class="datepicker" type="text" id="endDate" name="endDate" value="{!! date('d-m-Y', strtotime($endDate)) !!}">
                {{ csrf_field() }}
                  <input type="submit" name="save-new" value="Filter"  class="btn btn-success mr-2 mt-1">
                  <a href="{!! route('frontend.user.xray.report-pdf',[
                    'startDate' => $startDate,
                    'endDate'   => $endDate
                  ])!!}" class="btn btn-primary mr-2 mt-1" target="_blank">
                    Print Report (PDF)
                  </a>

                   <a href="{!! route('frontend.user.x-ray.form')!!}" class="btn btn-success mr-2 mt-1">
                    Add New
                  </a>
                </form>
              </div>
          <div class="clearfix"></div>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive container-fluid">
              <table id="all-listing"  class="table table-striped">
                <thead>
                  <tr>
                      <th>Serial No.</th>
                      <th>Print</th>
                      <th>Patient</th>
                      <th>Patient Number</th>
                      <th>Doctor</th>
                      <th>X-Ray</th>
                      <th>X-Cost</th>
                      <th>X-Description</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                      $total = 0;
                    @endphp
                    @if(isset($xrays))
                        @foreach($xrays as $xray)
                            <tr class="erow">
                                <td>{!! $xray->id !!}</td>
                                <td>  
                                  <a class="btn btn-primary" target="_blank" href="{!! route('frontend.user.x-ray.print', ['id' => $xray->id ]) !!}">
                                    Print
                                  </a> 
								                </td>
                                <td>{!! $xray->patient->name !!}</td>
                                <td>{!! $xray->patient->patient_number !!}</td>
                                <td>Dr. {!! $xray->doctor_name !!}</td>
                                <td>
                                  {!! $xray->xray_title !!}
                                  @if(isset($xray->chlidren) && count($xray->chlidren))
                                  <br>
                                    {!! implode(",", $xray->chlidren->pluck('xray_title')->toArray()) !!}
                                  @endif
                                </td>
                                <td>
                                  @if(isset($xray->chlidren) && count($xray->chlidren))
                                    @php
                                      $sbTotal = $xray->xray_cost + $xray->chlidren->sum('xray_cost');
                                    @endphp
                                  @else
                                    @php
                                      $sbTotal = $xray->xray_cost;
                                    @endphp
                                  @endif

                                  @php
                                    echo number_format($sbTotal, 2);
                                  @endphp

                                <td>
                                  {!! $xray->xray_description !!}
                                  @if(isset($xray->chlidren) && count($xray->chlidren))
                                  <br>
                                    {!! implode(",", $xray->chlidren->pluck('xray_description')->toArray()) !!}
                                  @endif
                                </td>
                            </tr>
                            @php
                              $total  = $total + $sbTotal; 
                            @endphp
                        @endforeach
                          
                    @endif
                </tbody>
                <tr>
                  <td>-</td>
                  <td colspan="4" align="center" class="text-bold">
                  Total</td>
                  <td>-</td>
                  <td style="text-align: right;">{!! number_format($total, 2) !!}</td>
                  <td>-</td>
                </tr>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
 <script type="text/javascript">
    jQuery(document).ready(function()
    {
        jQuery('#all-listing').dataTable({
          "order": [[ 0, "desc" ]]
        });
        jQuery(".datepicker").datepicker({
          format: 'dd-mm-yyyy',
        });
    })
</script> 


@endsection