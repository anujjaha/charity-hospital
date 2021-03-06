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
                            <br>
                            ઉમર : {!! $booking->patient->age !!}<br>
                            ગામ : {!! isset($booking->patient->city) ? $booking->patient->city : 'GODHRA' !!}
                            </td>
                            <td width="50%">
                                બીલ નં : <strong>{!! $booking->department_number !!}</strong><br>
                                UNIQUE ID NO. : <strong>
                                    {!!  $booking->patient->patient_number !!}
                                </strong>
                                <br>
                                તારીખ : {!! date('d-m-Y', strtotime($booking->created_at)) !!}<br>
                                મોબાઈલ નંબર : {!! $booking->patient->mobile !!}
                            </td>
                        </tr>
        </table>
        <br />
        <hr>
        <br />
        <table cellpadding="0" cellspacing="0">
        </table>
    </div>
</body>
</html>