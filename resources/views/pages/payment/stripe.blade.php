@extends('layouts.app')

@section('content')
    @include('layouts.menubar')

    @php
    $setting = DB::table('settings')->first();
    $charge = $setting->shipping_charge;
    $vat = $setting->vat;
    $cart = Cart::Content();
    @endphp

    <style>
        section {
            background: #ffffff;
            display: flex;
            flex-direction: column;
            width: 400px;
            height: 112px;
            border-radius: 6px;
            justify-content: space-between;
        }

        section .product {
            display: flex;
        }

        section .description {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        section p {
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 20px;
            letter-spacing: -0.154px;
            color: #242d60;
            height: 100%;
            width: 100%;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        section img {
            border-radius: 6px;
            margin: 10px;
            width: 54px;
            height: 57px;
        }

        section h3,
        h5 {
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 20px;
            letter-spacing: -0.154px;
            color: #242d60;
            margin: 0;
        }

        section h5 {
            opacity: 0.5;
        }

        section button {
            height: 36px;
            background: #556cd6;
            color: white;
            width: 100%;
            font-size: 14px;
            border: 0;
            font-weight: 500;
            cursor: pointer;
            letter-spacing: 0.6;
            border-radius: 0 0 6px 6px;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        }

        section button:hover {
            opacity: 0.8;
        }

    </style>


    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-7" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Cart Products</div>


                        <div class="cart_items">
                            <ul class="cart_list">

                                @foreach ($cart as $row)

                                    <li class="cart_item clearfix">



                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">

                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Product Image</b></div>
                                                <div class="cart_item_text"><img src="{{ asset($row->options->image) }} "
                                                        style="width: 70px; width: 70px;" alt=""></div>
                                            </div>


                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title"><b>Name</b></div>
                                                <div class="cart_item_text">{{ $row->name }}</div>
                                            </div>

                                            @if ($row->options->color == null)

                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"><b>Color</b></div>
                                                    <div class="cart_item_text"> {{ $row->options->color }}</div>
                                                </div>
                                            @endif


                                            @if ($row->options->size == null)

                                            @else
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title"><b>Size</b></div>
                                                    <div class="cart_item_text"> {{ $row->options->size }}</div>
                                                </div>
                                            @endif


                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title"><b>Quantity</b></div>
                                                <div class="cart_item_text"> {{ $row->qty }}</div>

                                            </div>



                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title"><b>Price</b></div>
                                                <div class="cart_item_text">${{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title"><b>Total</b></div>
                                                <div class="cart_item_text">${{ $row->price * $row->qty }}</div>
                                            </div>


                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <ul class="list-group col-lg-8" style="float: right;">
                            @if (Session::has('coupon'))
                                <li class="list-group-item">Subtotal : <span style="float: right;">
                                        ${{ Session::get('coupon')['balance'] }} </span> </li>
                                <li class="list-group-item">Coupon : ({{ Session::get('coupon')['name'] }} )
                                    <a href="{{ route('coupon.remove') }}" class="btn btn-danger btn-sm">X</a>
                                    <span style="float: right;">${{ Session::get('coupon')['discount'] }} </span>
                                </li>
                            @else
                                <li class="list-group-item">Subtotal : <span style="float: right;">
                                        ${{ Cart::Subtotal() }} </span> </li>
                            @endif



                            <li class="list-group-item">Shiping Charge : <span style="float: right;">${{ $charge }}
                                </span> </li>
                            <li class="list-group-item">Vat : <span style="float: right;">${{ $vat }} </span>
                            </li>
                            @if (Session::has('coupon'))
                                <li class="list-group-item">Total : <span
                                        style="float: right;">${{ Session::get('coupon')['balance'] + $charge + $vat }}
                                    </span> </li>
                            @else
                                <li class="list-group-item">Total : <span
                                        style="float: right;">${{ Cart::Subtotal() + $charge + $vat }} </span> </li>
                            @endif

                        </ul>



                    </div>
                </div>










                <div class="col-lg-5" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Shipping Address</div>

                        <div class="panel-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p><br>
                                </div>
                            @endif
                            <div class="mt-32">
                                <h2>Pay with Stripe</h2>

                                <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
                                <form accept-charset="UTF-8" action="{{ route('stripe.charge') }}"
                                    class="require-validation" data-cc-on-file="false"
                                    data-stripe-publishable-key="pk_test_51KFh18Jnbx4GcaTfVd4eR4fLmJLky5Ptqa1vERAoqXLqdHNLyjSphrx0zuRiLS9HCQC9he8qLwlJ8qNIFk1XKMBz00h278IKTk"
                                    id="payment-form" method="post">
                                    @csrf
                                    <div class='form-row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Card Holder Name</label> <input
                                                class='form-control' size='4' type='text'
                                                placeholder="Enter Card Holder Name">
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-xs-12 form-group card required'>
                                            <label class='control-label'>Card Number</label> <input autocomplete='off'
                                                class='form-control card-number' size='20' type='text'
                                                placeholder="Enter Card number">
                                        </div>
                                    </div>
                                    <div class='form-row'>
                                        <div class='col-xs-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                class='form-control card-cvc' placeholder='CVV' size='4' type='text'>
                                        </div>
                                        <div class='col-xs-4 form-group expiration required'>
                                            <label class='control-label'>Expiration</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-4 form-group expiration required'>
                                            <label class='control-label'>YEAR</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                            </div><br>

                            <input type="hidden" name="shipping" value="{{ $charge }} ">
                            <input type="hidden" name="vat" value="{{ $vat }} ">
                            <input type="hidden" name="total" value="{{ Cart::Subtotal() + $charge + $vat }} ">

                            <input type="hidden" name="ship_name" value="{{ $data['name'] }} ">
                            <input type="hidden" name="ship_phone" value="{{ $data['phone'] }} ">
                            <input type="hidden" name="ship_email" value="{{ $data['email'] }} ">
                            <input type="hidden" name="ship_address" value="{{ $data['address'] }} ">
                            <input type="hidden" name="ship_city" value="{{ $data['city'] }} ">
                            <input type="hidden" name="payment_type" value="{{ $data['payment'] }} ">

                            <div class='form-row'>
                                <div class='col-md-12 form-group'>
                                    <button class='form-control btn btn-primary submit-button' type='submit'
                                        style="margin-top: 10px;">Confirm</button>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>Please correct the errors and try
                                        again.</div>
                                </div>
                            </div>
                            </form>
                            @if (Session::has('success-message'))
                                <div class="alert alert-success col-md-12">
                                    {{ Session::get('success-message') }}</div>
                                @endif @if (Session::has('fail-message'))
                                    <div class="alert alert-danger col-md-12">
                                        {{ Session::get('fail-message') }}
                                    </div>
                                @endif
                        </div>

                        <!-- Display a payment form -->
                    </div>
                </div>







            </div>
        </div>
    </div>


    <!-- JavaScript SDK -->
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"
        integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>
    <script>
        $(function() {
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(e.target).closest('form'),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;

                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault(); // cancel on first error
                    }
                });
            });
        });

        $(function() {
            var $form = $("#payment-form");

            $form.on('submit', function(e) {
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    console.log(token);
                    $form.get(0).submit();
                }
            }
        })
    </script>



@endsection
