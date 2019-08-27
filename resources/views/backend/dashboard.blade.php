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
                Booking Status
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
                        </tr>                    
                    @endforeach
                @endif
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
    })
</script>
@endsection