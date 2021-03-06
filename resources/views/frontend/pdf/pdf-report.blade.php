<style type="text/css">
    td {
        padding: 2px;
        font-size: 11px;
    }
</style>
<center><h1>Report for {!! date('d-m-Y', strtotime($startDate)) !!} to {!! date('d-m-Y', strtotime($endDate)) !!} </h1>
    <h3> Department : {!! $departmentName !!}
</center>
<table style="border: 2px solid; width: 100%">
    <tr>
        <td style="border: 1px solid;">Sr No.</td>
        <td style="border: 1px solid;">Patient Name</td>
        <td style="border: 1px solid;">Patient Number</td>
        <td style="border: 1px solid;">Consulting Fees</td>
        <td style="border: 1px solid;">Treatment Fees</td>
        <td style="border: 1px solid;">Total</td>
        <!-- <td style="border: 1px solid;">Surgery</td> -->
    </tr>

    @if(isset($data) && count($data))
        @php
            $sr = 0;
            $total = 0;
        @endphp

        @foreach($data as $record)
            @php
                $sr++;
                $total = $total + $record->total;
            @endphp
            <tr>
                <td style="border: 1px solid;">{!! $record->department_number !!}</td>
                <td  style="border: 1px solid;">{!! $record->patient->name !!}</td>
                <td  style="border: 1px solid;">{!! $record->patient->patient_number !!}</td>
                <td  style="border: 1px solid;">{!! $record->consulting_fees  !!}</td>
                <td  style="border: 1px solid;">{!! $record->total - $record->consulting_fees  !!}</td>
                <td  style="border: 1px solid; text-align: right;">{!! $record->total !!}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align: center;border: 1px solid; text-align: center;">
                <strong>Total</strong>
            </td>
            <td style="border: 1px solid; text-align: right;">
                {!! $total !!}
            </td>
        </tr>
    @endif
</table>