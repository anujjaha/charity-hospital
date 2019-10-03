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
                    Booking List
                </div>
              <div class="pull-right">
              <form method="post" action="{!! route('frontend.user.history.list') !!}" id="filter">
                <input class="datepicker" type="text" id="startDate" name="startDate" value="{!! date('d-m-Y', strtotime($startDate)) !!}">
                <input  class="datepicker" type="text" id="endDate" name="endDate" value="{!! date('d-m-Y', strtotime($endDate)) !!}">
                {{ csrf_field() }}
                  <input type="submit" name="save-new" value="Filter"  class="btn btn-success mr-2 mt-1">
                <a href="{!! route('frontend.user.history.print', [
                  'startDate' => $startDate,
                  'endDate'   => $endDate
                ]) !!}" class="btn btn-primary mr-2 mt-1" target="_blank">
                  Print
                </a>

                <a href="{!! route('frontend.user.history.print-pdf', [
                  'startDate' => $startDate,
                  'endDate'   => $endDate
                ]) !!}" class="btn btn-primary mr-2 mt-1" target="_blank">
                  PDF
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
                      <th>Queue Number</th>
                      <th>
                        {!! trans('labels.patel.consulting_fees') !!}
                      </th>
                      <th>Total</th>
                      <th>Surgery</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                      $total = 0;
                    @endphp
                    @if(isset($bookings))
                        @foreach($bookings as $booking)
                            <tr class="erow">
                                <td>{!! $booking->department_number !!}</td>
                                <td>  
                                  <a class="btn btn-primary" target="_blank" href="{!! route('frontend.user.receipt.print', ['id' => $booking->id ]) !!}">
                                    Print
                                  </a> 
								  {{-- dd($booking) --}}

                                  @if(isset($booking->department_id) && $booking->department_id == 3)
                                    <a class="btn btn-primary" target="_blank" href="{!! route('frontend.user.receipt.print-eye', ['id' => $booking->id ]) !!}">
                                      Eye Print 
                                    </a>
                                  @endif
                                </td>
                                <td>{!! $booking->patient->name !!}</td>
                                <td>{!! $booking->patient->patient_number !!}</td>
                                <td>Dr. {!! $booking->doctor->name !!}</td>
                                <td>{!! $booking->queue_number !!}</td>
                                <td>{!! $booking->consulting_fees !!}</td>
                                <td>{!! $booking->total !!}</td>
                                <td>
                                  @if(isset($booking->surgeries) && count($booking->surgeries))
                                    {!! access()->getBookingSurgeries($booking->surgeries) !!}
                                  @else
                                    No
                                  @endif
                                </td>
                                
                            </tr>
                            @php
                              $total  = $total + $booking->total; 
                            @endphp
                        @endforeach
                          
                    @endif
                </tbody>
                <tr>
                  <td>-</td>
                  <td colspan="5" align="center" class="text-bold">
                  Total for {!! date('d-m-Y', strtotime($startDate)) !!} - {!! date('d-m-Y', strtotime($endDate)) !!}</td>
                  <td>{!! $total !!}</td>
                  <td>-</td>
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