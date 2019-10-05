@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                Department Summary
            </h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="btn btn-primary pull-right" style="margin-right: 10px; padding: 10px;">
                Sync Now
            </div>
        <div class="box-body">
            <form method="post" action="{!! route('admin.dashboard') !!}" id="filter">
              <input type="text" id="startDate" name="startDate" value="{!! date('d-m-Y', strtotime($startDate)) !!}">
             <input type="text" id="endDate" name="endDate" value="{!! date('d-m-Y', strtotime($endDate)) !!}">
              {{ csrf_field() }}
                <input type="submit" name="save-new" value="Filter"  class="btn btn-success mr-2 mt-1">

            </form>
            <table class="table">
                <tr>
                    <th>Department</th>
                    <th>Total</th>
                    <th>Print</th>
                </tr>

                @if(isset($bookings) && count($bookings))
                    @foreach($bookings as $booking)
                        <tr>
                            <td>
                            {!! $booking->name !!}
                            </td>
                            <td>
                                {!! $booking->bookings->sum('total') !!}
                            </td>
                            <td>
                                <a href="{!! route('frontend.user.history.print-pdf', [
                                  'startDate' => $startDate,
                                  'endDate'   => $endDate,
                                  'deptId'    => $booking->id
                                ]) !!}" class="btn btn-primary mr-2 mt-1" target="_blank">
                                  PDF
                                </a>
                            </td>
                        </tr>                    
                    @endforeach
                @endif
            </table>
        </div><!-- /.box-body -->
    </div><!--box box-success-->

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                X-Ray Summary
            </h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        
        <div class="box-body">
            <form method="post" action="{!! route('admin.dashboard') !!}" id="filter">
              <input type="text" id="startDate1" class="datepicker"  name="startDate" value="{!! date('d-m-Y', strtotime($startDate)) !!}">
             <input type="text" id="endDate2" class="datepicker" name="endDate" value="{!! date('d-m-Y', strtotime($endDate)) !!}">
              {{ csrf_field() }}
                <input type="submit" name="save-new" value="Filter"  class="btn btn-success mr-2 mt-1">
                <a href="{!! route('frontend.user.xray.report-pdf',[
                  'startDate' => $startDate,
                  'endDate'   => $endDate
                ])!!}" class="btn btn-primary mr-2 mt-1" target="_blank">
                  Print Report (PDF)
                </a>
            </form>

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
                                            <td>{!! $xray->xray_title !!}</td>
                                            <td>{!! $xray->xray_cost !!}</td>
                                            <td>{!! $xray->xray_description !!}</td>
                                        </tr>
                                        @php
                                          $total  = $total + $xray->xray_cost; 
                                        @endphp
                                    @endforeach
                                      
                                @endif
                            </tbody>
                            <tr>
                              <td>-</td>
                              <td colspan="4" align="center" class="text-bold">
                              Total</td>
                              <td>-</td>
                              <td style="text-align: right;">{!! $total !!}</td>
                              <td>-</td>
                            </tr>
                          </table>
            
        </div><!-- /.box-body -->
    </div><!--box box-success-->

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->render() !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection



@section('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
 <script type="text/javascript">
    jQuery(document).ready(function()
    {
        jQuery("#startDate").datepicker({
          format: 'dd-mm-yyyy',
        });

        jQuery("#endDate").datepicker({
          format: 'dd-mm-yyyy',
        });

        jQuery(".datepicker").datepicker({
          format: 'dd-mm-yyyy',
        });
    })
</script>
@endsection