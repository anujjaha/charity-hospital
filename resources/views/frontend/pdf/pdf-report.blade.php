<style type="text/css">
    td {
        padding: 2px;
    }
</style>
<center><h1>Report for {!! date('d-m-Y', strtotime($startDate)) !!} to {!! date('d-m-Y', strtotime($endDate)) !!} </h1>
    <h3> Department : {!! $departmentName !!}
</center>
<table style="border: 2px solid;">
    <tr>
        <td style="border: 1px solid;">Sr No.</td>
        <td style="border: 1px solid;">Department</td>
        <td style="border: 1px solid;">Patient Name</td>
        <td style="border: 1px solid;">Patient Number</td>
        <td style="border: 1px solid;">Doctor</td>
        <td style="border: 1px solid;">Fees</td>
        <td style="border: 1px solid;">Total</td>
        <td style="border: 1px solid;">Surgery</td>
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
                <td  style="border: 1px solid;">{!! access()->getUserDepartment() !!}</td>
                <td  style="border: 1px solid;">{!! $record->patient->name !!}</td>
                <td  style="border: 1px solid;">{!! $record->patient->patient_number !!}</td>
                <td  style="border: 1px solid;">{!! $record->doctor->name !!}</td>
                <td  style="border: 1px solid;">{!! $record->consulting_fees  !!}</td>
                <td  style="border: 1px solid;">{!! $record->total !!}</td>
                <td  style="border: 1px solid;">{!! isset($record->surgeries) ? access()->getBookingSurgeries($record->surgeries) : '-' !!}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="text-align: center;border: 1px solid;">
                <strong>Total</strong>
            </td>
            <td style="border: 1px solid;">
                {!! $total !!}
            </td>
            <td style="border: 1px solid;"></td>
        </tr>
    @endif
</table>