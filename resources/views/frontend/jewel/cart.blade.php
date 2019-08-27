@extends('frontend.layouts.app')

@section('content')
<body class="inner-bg">

@include('frontend.jewel.menu')

<main role="main" id="main-container">

<div class="container">
        <div class="row form-block">
            <div class="col-lg-6">
                <div class="cart-head">My Cart</div>
            </div>
            <div class="col-lg-6">
                <div class="cart-head"><span><em>Total Items:</em> 03</span></div>
            </div>
        </div>
        <div class="row form-block">
            <div class="col-lg-12">
                <div class="cart-info-table">
                <div class="table-responsive"> 
                    <table class="table table-striped"> 
                        <thead> 
                            <tr> 
                                <th>Product Description</th>
                                <th>Action</th> 
                                <th>Quantity</th> 
                                <th>Unit Price</th> 
                                <th>Total Price</th> 
                            </tr> 
                        </thead> 
                            <tbody> 
                                <?php $total = 0 ;?>
                                @foreach($user->cart as $cart)
                                    <tr id="cartPId-{{ $cart->product->id }}"> 
                                        <td>
                                            <span>
                                                {{ Html::image('uploads/product/'.$cart->product->image, $cart->product->title) }}
                                            
                                            </span>
                                            <p>
                                                <h3>{{ $cart->product->title }}</h3>
                                                {{ $cart->product->description }}</p>
                                        </td>  
                                        <td>
                                            <div class="edit">
                                                <a href="javascript:void(0);" class="remove-product" data-id="{{ $cart->product->id }} ">
                                                    {{ Html::image('images/remove-btn.png', 'remove', ['data-id' => $cart->product->id]) }}Remove
                                                </a>
                                            </div>
                                            <div class="edit">
                                                <a href="javascript:void(0);" class="update-cart" data-id="{{ $cart->product->id }} ">
                                                    {{ Html::image('images/edit-btn.png', 'edit', ['data-id' => $cart->product->id]) }}
                                                    Edit
                                                </a>
                                            </div>
                                        </td> 
                                        <td>
                                        <select class="small_select" id="productQty-{{ $cart->product->id }}">

                                          <option {{ ($cart->qty == 1) ? 'selected="selected"' : '' }} value="1">1</option>
                                          <option {{ ($cart->qty == 2) ? 'selected="selected"' : '' }} value="2">2</option>
                                          <option {{ ($cart->qty == 3) ? 'selected="selected"' : '' }} value="3">3</option>
                                          <option {{ ($cart->qty == 4) ? 'selected="selected"' : '' }} value="4">4</option>
                                        </select>
                                        </td> 
                                        <td><div class="price">$ {{ $cart->product->price }}</div></td> 
                                        <td><div class="price">$ {{ $cart->product->price *  $cart->qty }}</div></td> 
                                        <?php
                                            $total = $total + $cart->product->price *  $cart->qty;
                                        ?>
                                    </tr>
                                @endforeach
                            </tbody> 
                        </table> </div>
            </div>
            </div>
            <div class="col-lg-12">
                <div class="total-amount-box">Total Amount <span>$ <?php echo $total;?></span></div>
                @if(count($user->cart))
                    <div class="text-right">
                        <a href="javascript:void(0);" id="createOrderBtn" class="btn btn-primary"> Place an Order </a>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</main>

@include('frontend.jewel.footer')

@endsection

@section('footer-js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/slick.min.js')}}"></script>

<script type="text/javascript">

jQuery(document).on('click', '.remove-product', function(element)
    {   
        var productId = element.target.getAttribute('data-id');

        jQuery.ajax(
        {
            url: "{!! route('frontend.user.remove-product-from-cart') !!}",
            method: "POST",
            dataType: 'json',
            data: {
                'productId': productId
            },
            success: function(data)
            {
                if(data.status == true)
                {
                    alert("Product Removed From Cart Successfully!");
                    jQuery("#cartPId-"+productId).html('');
                    return true;
                }

                alert("Somethin went Wront !");
                return false;
            },
            error: function(data)
            {
                console.log(data);
            }
        });
    });


jQuery("#createOrderBtn").on('click', function()
{
    jQuery.ajax(
    {
        url: "{!! route('frontend.user.create-order') !!}",
        method: "POST",
        dataType: 'json',
        data: {
            
        },
        success: function(data)
        {
            if(data.status == true)
            {

                alert("Order Created Successfully !");
                window.location.reload();
                return true;
            }

            alert("Somethin went Wront !");
            return false;
        },
        error: function(data)
        {
            console.log(data);
        }
    });
})

jQuery(document).on('click', '.update-cart', function(element)
    {   
        var productId   = element.target.getAttribute('data-id'),
            productQty  = jQuery("#productQty-"+productId ).val();

        jQuery.ajax(
        {
            url: "{!! route('frontend.user.add-product-to-cart') !!}",
            method: "POST",
            dataType: 'json',
            data: {
                productId:  productId,
                productQty: productQty
            },
            success: function(data)
            {
                if(data.status == true)
                {
                    alert("Product Quantity Updated Successfully!");
                    return true;
                }

                alert("Somethin went Wront !");
                return false;
            },
            error: function(data)
            {
                console.log(data);
            }
        });
    });    


    var slick = jQuery('.stack').slick(
        {
            centerPadding: '50px',
            centerMode: true,
            infinite: true,
            arrows: true,
            draggable: false,
            touchMove: true,
            variableWidth: true,
            dots: false,
            //swipeToSlide: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            focusOnSelect: true,
            mobileFirst: true
        });

</script>

@endsection