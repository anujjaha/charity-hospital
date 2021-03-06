<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
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
                                        @if($booking->department_id == 1)
                                            પી. ટી. મીરાણીના સહયોગથી
                                            <h3 style="margin:5px;">સ્વ. સદા બા વિઠ્ઠલભાઈ પટેલ મેડીકલ સેન્ટર</h3>
                                            સ્વ. અમુલખરાય ભાઉરાય દેસાઈ
                                            <h3 style="margin:2px;">દાંતનું દવાખાનું</h3>
                                        @endif

                                        @if($booking->department_id == 2)
                                           પી. ટી. મીરાણીના સહયોગથી
                                            <h3 style="margin:5px;">સ્વ. સદા બા વિઠ્ઠલભાઈ પટેલ કલીનીક</h3>
                                        @endif

                                        @if($booking->department_id == 3)
                                            <h3 style="margin:5px;">પી. ટી. મીરાણી આઈ હોસ્પિટલ એન્ડ રોટરી આઈ કેર સેન્ટર</h3>
                                        @endif

                                        @if($booking->department_id == 4)
                                            પી. ટી. મીરાણીના સહયોગથી 
                                            <h3 style="margin:5px;">સ્વ. ચંપાબેન અંબાલાલ શાહ (ખારોલવાળા)</h3>
                                            <h3 style="margin:2px;">સાર્વજનિક પ્રસુતિગૃહ</h3>
                                        @endif

                                        @if($booking->department_id == 5)
                                            પી. ટી. મીરાણીના સહયોગથી 
                                            <h3 style="margin:5px;">સ્વ. સદા બા વિઠ્ઠલભાઈ પટેલ મેડીકલ સેન્ટર</h3>
                                             સ્વ. સવિતાબેન રતિલાલ દેસાઈ
                                            <h3 style="margin:2px;">ફીઝીયોથેરાપી સેન્ટર</h3>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                        <tr>
                        <td width="50%">
                            <strong>કેસ નંબર: </strong> :{!! $booking->queue_number !!}
                            <br>
                        	દર્દી નું નામ : {!! $booking->patient->name !!}
                            &nbsp; &nbsp; &nbsp; &nbsp; 
                            ઉમર : {!! $booking->patient->age !!}<br>
                            ગામ : {!! isset($booking->patient->city) ? $booking->patient->city : 'GODHRA' !!}
                            </td>
                        <td width="50%">
                            બીલ નં : {!! $booking->department_number !!}<br>
                            તારીખ : {!! date('d-m-Y', strtotime($booking->created_at)) !!}<br>
                            મોબાઈલ નંબર : {!! $booking->patient->mobile !!}
                        </td>
                        </tr>
                        <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr style="text-align:center;line-height:1.6;">
                                    <td><h4 style="margin:0;">PRESCRIPTION</h4></td>
                                </tr>
                                <tr>
                                	<td>
                                    	<table id="items">
                                            <tbody>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Details</th>
                                                <!--<th>QTY.</th>
                                                <th>M</th>
                                                <th>N</th>
                                                <th>E</th>
                                                <th>N</th>-->
                                            </tr>
                                            @for($i = 0; $i < 14; $i++)
                                                <tr class="item-row">
                                                    <td width="50"></td>
                                                    <td class="description"></td>
                                                </tr>
                                            @endfor
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
                	હોસ્પિટલ માં ઉપલબ્ધ સુવિધા :	<br>
                    ૧. આંખ ની તાપસ - ૨. દાંત ની સારવાર	- ૩. શરીર ના તમામ રોગો ની સારવાર ( ફિઝિશિયન )	<br>
                    ૪. નવજાત શિશુ ની સારવાર - ૫.પ્રસુતિગૃહ - ૬.લેબોરેટોરી , એક્સ રે , સોનોગ્રાફી - ૭.ફિઝિયોથેરાપી <br>
                    </td>
                </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
                    <tr class="information">
                        <td colspan="2">
                            <table style="text-align:center;margin-top:15px;border-top:1px dotted #555;">
                                <tr>
                                    <td><h3 style="margin:0;padding-top:15px;padding-bottom:5px;">CASH RECIEPT</h3>
                                   	સદવિચાર પરિવાર મેડિકલ સેન્ટર , ગોધરા</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    	<tr>
                        <td width="50%" style="text-align: right;"><strong>બીલ નં : </strong></td>
                        <td style="text-align: left; padding-left: 10px;">{!! $booking->department_number !!}</td>
                        </tr>
                        <tr>
                        <td style="text-align: right;"><strong>કેસ નંબર: </strong></td>
                        <td  style="text-align: left; padding-left: 10px;">{!! $booking->queue_number !!}</td>
                        </tr>
                        <tr>
                        <td style="text-align: right;"><strong>UNIQUE ID NO. : </strong></td>
                        <td  style="text-align: left; padding-left: 10px;">{!!  $booking->patient->patient_number !!}</td>
                        </tr>
                        <tr>
                        <td style="text-align: right;"><strong>તારીખ : </strong></td>
                        <td  style="text-align: left; padding-left: 10px;">{!! date('d-m-Y', strtotime($booking->created_at)) !!}</td>
                        </tr>
                        <tr>
                        <td style="text-align: right;"><strong>દર્દી નું નામ : </strong></td>
                        <td  style="text-align: left; padding-left: 10px;">{!! ucfirst($booking->patient->name) !!}</td>
                        </tr>
                        <tr>
                        <td style="text-align: right;"><strong>ગામ : </strong></td>
                        <td style="text-align: left; padding-left: 10px;">
                            {!! isset($booking->patient->city) ? $booking->patient->city : 'GODHRA' !!}
                        </td>
                        </tr>
                        <tr>
                        <td style="text-align: right;"><strong> મોબાઈલ નંબર : </strong></td> 
                        <td style="text-align: left; padding-left: 10px;">{!! $booking->patient->mobile !!}</td>
                        </tr>
                        <tr>
                        <td style="text-align: right;"><strong>કેસ ફી : </strong></td>
                        <td style="text-align: left; padding-left: 10px;">{!! $booking->total !!}/-</td>
                    </tr>
        </table>
    </div>
</body>
</html>