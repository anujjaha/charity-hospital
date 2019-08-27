@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.view'))

@section('page-header')
    <h1>
        Manage Tier Permission
        <small>Manage</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.view') }}</h3>

            <div class="box-tools pull-right">
                
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($tiers as $tier)

                        @php $active = ($tier->id == 1) ? 'active' : ''; @endphp

                        <li role="presentation" class="{{ $active }}">
                            <a href="#{{ $tier->id }}" aria-controls="overview" role="tab" data-toggle="tab">{{ $tier->title }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                @php
                    $categories = $repository->getAll();
                    $firstTier  = $repository->getFirstLevelCategories()->pluck('category_id')->toArray();
                    $secondTier  = $repository->getSecondLevelCategories()->pluck('category_id')->toArray();
                @endphp

                    @foreach($tiers as $tier)
                        @php
                            $active         = ($tier->id == 1) ? 'active' : ''; 
                            $tierPermission = $repository->getPermissionByTier($tier->id)->pluck('category_id')->toArray();
                        @endphp
                        <div role="tabpanel" class="tab-pane mt-30 {{$active}}" id="{{ $tier->id }}">
                            <div class="row">
                               @foreach($categories as $category)
                                    <div class="col-md-3">
                                        <label>
                                            <input class="level-permissions-{{ $tier->id }}" type="checkbox" {{ in_array($category->id, $tierPermission) ? 'checked="checked"' : '' }}  name="{{ $tier->title }}" value="{{ $category->id }}">{{ $category->title }}
                                        </label>
                                    </div>
                               @endforeach
                               <div class="col-md-12 text-center">
                                    <a href="javascript:void(0);" data-id="{{ $tier->id }}" id="tierOneUpdatexx" class="btn btn-success lg tier-btn-update">Update Tier {{  $tier->title }}</a>
                               </div>
                            </div>
                        </div>
                    @endforeach    
                </div>

            </div><!--tab panel-->

        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts')
    <script>

    var url = '{!! route('admin.access.update-permission-tier') !!}';

    jQuery(".tier-btn-update").on('click', function(element)
    {
        var key = jQuery(element.target).attr('data-id');
        console.log(key, 'test');


        var checkedVals = jQuery('.level-permissions-'+key+':checkbox:checked').map(function() 
        {
            return this.value;
        }).get();
        

        var permissions = checkedVals.join(",");
        
        jQuery.ajax(
        {
            url: url,
            method: "POST",
            dataType: "JSON",
            data: {
                values:     permissions,
                tierLevel:  key
            },
            success: function(data)
            {
                if(data.status == true)
                {
                    alert("Permission Updated Succesfuly !");
                    return true;
                }
                
                alert("Somethin Went Wrong !");
            },
            error: function(data)
            {
                alert("Somethin Went Wrong !");
            }   
        })
    });
    jQuery("#tierOneUpdate").on('click', function()
    {
        var checkedVals = jQuery('.leavel-one-permission:checkbox:checked').map(function() 
        {
            return this.value;
        }).get();
        

        var tierOnePermissions = checkedVals.join(",");

        jQuery.ajax(
        {
            url: url,
            method: "POST",
            dataType: "JSON",
            data: {
                values:     tierOnePermissions,
                tierLevel:  1
            },
            success: function(data)
            {
                if(data.status == true)
                {
                    alert("Permission Updated Succesfuly !");
                    return true;
                }
                
                alert("Somethin Went Wrong !");
            },
            error: function(data)
            {
                alert("Somethin Went Wrong !");
            }   
        })
    });

     jQuery("#tierTwoUpdate").on('click', function()
    {
        var checkedVals = jQuery('.leavel-two-permission:checkbox:checked').map(function() 
        {
            return this.value;
        }).get();
        

        var tierOnePermissions = checkedVals.join(",");

        jQuery.ajax(
        {
            url: url,
            method: "POST",
            dataType: "JSON",
            data: {
                values:     tierOnePermissions,
                tierLevel:  2
            },
            success: function(data)
            {
                if(data.status == true)
                {
                    alert("Permission Updated Succesfuly !");
                    return true;
                }
                
                alert("Somethin Went Wrong !");
            },
            error: function(data)
            {
                alert("Somethin Went Wrong !");
            }   
        })
    })
    </script>
@endsection