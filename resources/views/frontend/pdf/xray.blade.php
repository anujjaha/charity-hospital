<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>X-Ray</title>
    
    <style>
    @page {
  size: A4;
  margin:20px;
}
    .invoice-box {
       width: 21cm;
    min-height: 29.7cm;
    padding:15px;
        margin:0 auto;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 0px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom:10px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 15px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
   
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    #items td{text-align:left;padding:0;height:24px;}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }

    .invoice-box {
       width: 21cm;
    min-height: 29.7cm;
    padding:15px;
        margin:0;
        border: 1px solid #eee;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 0px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom:10px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 15px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
   
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    #items td{text-align:left;padding:0;height:24px;}
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
                    <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr style="text-align:center;line-height:1.6;">
                                    <td>સદવિચાર પરિવાર ગોધરા સંચાલિત<br>
                                       
                                            પી. ટી. મીરાણીના સહયોગથી
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                        <tr>
                        <td>
                            દર્દી નું નામ : {!! $xray->patient->name !!}<br>
                            ઉમર : {!! $xray->patient->age !!}<br>
                            ગામ : {!! isset($xray->patient->city) ? $xray->patient->city : 'GODHRA' !!}
                            </td>
                            <td>
                                બીલ નં : {!! $xray->id !!}<br>
                                તારીખ : {!! date('d-m-Y', strtotime($xray->created_at)) !!}<br>
                                મોબાઈલ નંબર : {!! $xray->patient->mobile !!} 
                            </td>
                        </tr>
                        <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr style="text-align:center;line-height:1.6;">
                                    <td><h4 style="margin:0;">X-Ray</h4></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table id="items">
                                            <tbody>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Title</th>
                                                <th>Fees</th>
                                            </tr>
                                            
                                            <tr class="item-row">
                                                <td width="30" style="border-bottom: 1px solid gray;">1</td>
                                                <td style="border-bottom: .5px solid gray;" class="description">
                                                {!! $xray->xray_title !!}
                                                @if(strlen( $xray->xray_description) > 1)
                                                    ({!! $xray->xray_description !!})
                                                @endif
                                                </td>
                                                <td style="border-bottom: 1px solid gray;">
                                                {!! number_format($xray->xray_cost, 2) !!}/-</td>
                                            </tr>
                                            @if(isset($xray->chlidren) && count($xray->chlidren))
                                                @php
                                                    $sr = 2;
                                                @endphp
                                                @foreach($xray->chlidren as $smXray)
                                                    <tr class="item-row">
                                                        <td width="30" style="border-bottom: 1px solid gray;">
                                                            {!! $sr !!}
                                                        </td>
                                                        <td style="border-bottom: .5px solid gray;" class="description">
                                                        {!! $smXray->xray_title !!}
                                                        @if(strlen( $smXray->xray_description) > 1)
                                                            ({!! $smXray->xray_description !!})
                                                        @endif
                                                        </td>
                                                        <td style="border-bottom: 1px solid gray;">
                                                        {!! number_format($smXray->xray_cost, 2) !!}/-</td>
                                                    </tr>
                                                    @php
                                                        $sr++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                @sr = 1;
                                            @endif
                                            @for($i = $sr; $i <= 10; $i++)
                                                <tr class="item-row">
                                                    <td></td>
                                                    <td class="description"></td>
                                                    <td></td>
                                                </tr>
                                            @endfor

                                            <tr class="item-row">
                                                <td></td>
                                                <td class="description pull-right" style="margin-right: 10%;"> 
                                                   <strong>Total</strong>
                                                </td>
                                                <td style="border-bottom: 1px solid gray;">
                                                <strong>
                                                    @if(isset($xray->chlidren) && count($xray->chlidren))
                                                        @php
                                                            $total = $xray->xray_cost + $xray->chlidren->sum('xray_cost');
                                                            echo number_format($total, 2);
                                                        @endphp
                                                    @else
                                                        {!! number_format($xray->xray_cost, 2) !!}
                                                    @endif
                                                /-</strong>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="information">
                <td colspan="2">
                    <table style="padding-top:50px;">
                        <tr>
                            <td><strong></strong></td>
                            <td><strong>SIGN</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="line-height: 1.4;font-size:13px;">
                    હોસ્પિટલ માં ઉપલબ્ધ સુવિધા :    <br>
                    ૧. આંખ ની તાપસ - ૨. દાંત ની સારવાર  - ૩. શરીર ના તમામ રોગો ની સારવાર ( ફિઝિશિયન )   <br>
                    ૪. નવજાત શિશુ ની સારવાર - ૫.પ્રસુતિગૃહ - ૬.લેબોરેટોરી , એક્સ રે , સોનોગ્રાફી - ૭.ફિઝિયોથેરાપી <br>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>