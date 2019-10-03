<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> &nbsp; </title>
    
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
   
    .invoice-box table tr.border  td {
     vertical-align: middle;
    border-bottom: 1px solid #000 !important;
    padding: 6px 0 !important;
    font-size: 14px;
}
.invoice-box table tr.noborder td{border-color:#fff !important;    padding: 1px 0 !important;}
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
    .invoice-box table tr.border td {
       vertical-align: middle;
    border-bottom: 1px solid #000 !important;
    padding: 6px 0 !important;
    font-size: 14px;
}
.invoice-box table tr.noborder td{border-color:#fff !important;    padding: 1px 0 !important;}
    
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
                                    <td>SADVICHAR PRIVAR<br>
                                    <h3 style="margin:5px;">P. T. MIRANI EYE HOSPITAL<br>& ROTARY EYE CARE CENTER</h3>
                                    Dahod Road, Vavdi Bujarg, GODHRA, Ph. 265498</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
             </table>
             <table cellpadding="0" cellspacing="0">
                <tr class="border">
                    <td>
                        NAME : {!! $booking->patient->name !!}
                    </td>
                    <td style="width: 200px;text-align: left;">
                        DATE : {!! date('d-m-Y', strtotime($booking->created_at)) !!}
                    </td>
                </tr>
                <tr class="border">
                    <td>AGE : {!! $booking->patient->age !!} </td>
                    <td style="width: 200px;text-align: left;">
                        Mobile No : {!! $booking->patient->mobile !!}
                    </td>
                </tr>
				<tr class="border">
                    <td>Unique Number : {!! $booking->patient->patient_number !!} </td>
                    <td></td>
                                    </tr>
            </table>

<table cellpadding="0" cellspacing="0">
    <tr class="border"><td>ADDRESS : {!! $booking->patient->address !!} </td></tr>
    <tr class="border"><td>HISTORY </td></tr>
    <tr class="border"><td>PAST HISTORY </td></tr>
    <tr class="border"><td>VISION </td></tr>
</table>
            
        <table cellpadding="0" cellspacing="0">
                        <tr class="border">
                        <td>SAC</td>
                        <td style="text-align:left;width:300px;">ANT. SEG. EXAM.</td>
                        <td></td>
                        </tr>
                        <tr class="border">
                        <td>TENSION</td>
                        <td style="text-align:left">RE</td>
                        <td style="text-align:left">LE</td>
                        </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
                        <tr class="border noborder"><td>LIDS </td></tr>
                        <tr class="border noborder"><td>LASHES </td></tr>
                        <tr class="border noborder"><td>CONJUCTIVA </td></tr>
                        <tr class="border noborder"><td>SCLERA </td></tr>
                        <tr class="border noborder"><td>CORNERA </td></tr>
                        <tr class="border noborder"><td>AC </td></tr>
                        <tr class="border noborder"><td>IRIS </td></tr>
                        <tr class="border noborder"><td>PUPIL </td></tr>
                        <tr class="border noborder"><td></td></tr>
                        <tr class="border noborder"><td>LENSE </td></tr>
            </table>
        <img src="{!! url('images/invoicebg.png') !!}" style="width:100%;">
    </div>
</body>
</html>