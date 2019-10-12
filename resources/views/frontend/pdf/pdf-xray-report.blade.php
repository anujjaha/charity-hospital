<style type="text/css">
    td {
        padding: 2px;
        font-size: 11px;
    }
</style>
<center><h1>X-Ray Report</h1>
    <h3> Department : {!! $departmentName !!}
</center>
<table style="border: 2px solid; width: 100%">
    <tr>
        <td style="border: 1px solid;">Sr No.</td>
        <td style="border: 1px solid;">Doctor Name</td>
        <td style="border: 1px solid;">Patient Name</td>
        <td style="border: 1px solid;">Patient Number</td>
        <td style="border: 1px solid;">Title</td>
        <td style="border: 1px solid;">Fees</td>
        <td style="border: 1px solid;">Description</td>
    </tr>

    @if(isset($data) && count($data))
        @php
            $sr = 0;
            $total = 0;
        @endphp

        @foreach($data as $record)
            <tr>
                <td style="border: 1px solid;">{!! $record->id !!}</td>
                <td  style="border: 1px solid;">{!! $record->doctor_name !!}</td>
                <td  style="border: 1px solid;">{!! $record->patient->name !!}</td>
                <td  style="border: 1px solid;">{!! $record->patient->patient_number !!}</td>
                <td style="border: 1px solid;">
                  {!! $record->xray_title !!}
                  @if(isset($record->chlidren) && count($record->chlidren))
                  <br>
                    {!! implode(",", $record->chlidren->pluck('xray_title')->toArray()) !!}
                  @endif
                </td>
                <td style="border: 1px solid; text-align: right;">
                  @if(isset($record->chlidren) && count($record->chlidren))
                    @php
                      $sbTotal = $record->xray_cost + $record->chlidren->sum('xray_cost');
                    @endphp
                  @else
                    @php
                      $sbTotal = $record->xray_cost;
                    @endphp
                  @endif

                  @php
                    echo number_format($sbTotal, 2);
                  @endphp
                </td>
                
                <td  style="border: 1px solid;">
                    {!! $record->xray_description !!}
                    @if(isset($record->chlidren) && count($record->chlidren))
                        <br>
                        {!! implode(",", $record->chlidren->pluck('xray_description')->toArray()) !!}
                    @endif
                </td>
            </tr>

            @php
                $total  = $total + $sbTotal;
                $sr++; 
            @endphp
        @endforeach
        <tr>
            <td colspan="5" style="text-align: center;border: 1px solid; text-align: center;">
                <strong>Total</strong>
            </td>
            <td style="border: 1px solid; text-align: right;">
                {!! $total !!}
            </td>
            <td style="border: 1px solid; text-align: right;"></td>
        </tr>
    @endif
</table>