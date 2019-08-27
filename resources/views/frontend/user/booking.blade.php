@extends('frontend.layouts.app')

@section('content')

<main role="main" id="main-container">
<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
    <div class="content-wrapper">
    </div>
    </div>
</div>
</main>


@endsection

@section('footer')
 <script type="text/javascript">
       $("#add_new").hide();
       $("#add_old").hide();
       
    jQuery("input[name='optradio']:radio").change(function() 
    {
        console.log($(this).val());
        jQuery("#add_new").toggle($(this).val() == "New");
        jQuery("#add_old").toggle($(this).val() == "Existing");
    });
      
      $( "#Search_Patient" ).click(function()
      {
        $("#search_form").show();
        $("#Search_Patient").hide();
        });
      
      
      $( "#Show_History" ).click(function() {
  $("#history").show();
  $("#Add_Patient").hide();
});
$( "#Close_History" ).click(function() {
  $("#Add_Patient").show();
  $("#history").hide();
});
       
</script> 
@endsection