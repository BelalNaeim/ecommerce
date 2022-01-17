@extends('layouts.app')

@section('content')
    @include('layouts.menubar')

    @php
    $setting = DB::table('settings')->first();
    $charge = $setting->shipping_charge;
    $vat = $setting->vat;
    $cart = Cart::Content();
    @endphp




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
                                <h2>Pay with Paypal</h2>


                                <!-- Buttons container -->
                                <table border="0" align="center" valign="top" bgcolor="#FFFFFF" style="width: 39%">
                                    <tr>
                                        <td colspan="2">
                                            <div id="paypal-button-container"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                </table>
                                <!-- Advanced credit and debit card payments form -->
                                <div class="card_container">
                                    <form method="post" id="card-form" action="{{ route('stripe.charge') }}">
                                        @csrf

                                        <label for="card-number">Card Number</label>
                                        <div id="card-number" class="card_field"></div>
                                        <div>
                                            <label for="expiration-date">Expiration Date</label>
                                            <div id="expiration-date" class="card_field"></div>
                                        </div>
                                        <div>
                                            <label for="cvv">CVV</label>
                                            <div id="cvv" class="card_field"></div>
                                        </div>
                                        <label for="card-holder-name">Name on Card</label>
                                        <input type="text" id="card-holder-name" name="card-holder-name" autocomplete="off"
                                            placeholder="card holder name" />
                                        <div>
                                            <label for="card-billing-address-street">Billing Address</label>
                                            <input type="text" id="card-billing-address-street"
                                                name="card-billing-address-street" autocomplete="off"
                                                placeholder="street address" />
                                        </div>
                                        <div>
                                            <label for="card-billing-address-unit">&nbsp;</label>
                                            <input type="text" id="card-billing-address-unit"
                                                name="card-billing-address-unit" autocomplete="off" placeholder="unit" />
                                        </div>
                                        <div>
                                            <input type="text" id="card-billing-address-city"
                                                name="card-billing-address-city" autocomplete="off" placeholder="city" />
                                        </div>
                                        <div>
                                            <input type="text" id="card-billing-address-state"
                                                name="card-billing-address-state" autocomplete="off" placeholder="state" />
                                        </div>
                                        <div>
                                            <input type="text" id="card-billing-address-zip" name="card-billing-address-zip"
                                                autocomplete="off" placeholder="zip / postal code" />
                                        </div>
                                        <div>
                                            <input type="text" id="card-billing-address-country"
                                                name="card-billing-address-country" autocomplete="off"
                                                placeholder="country code" />
                                        </div>
                                        <br /><br />
                                        <button value="submit" id="submit" class="btn">Pay</button>
                                    </form>
                                </div>

                            </div>

                            <!-- Display a payment form -->
                        </div>
                    </div>







                </div>
            </div>
        </div>


      <!-- JavaScript SDK -->
 <script src="https://www.paypal.com/sdk/js?components=buttons,hosted-fields&client-id=Accb-FApbTn312LbTXYCmWxH4BQGLB1-f5hqUyy-lcruuPaKjV16b2K4APgW26F8QtEtAuuI41VaWze3
 " data-client-token="eyJicmFpbnRyZWUiOnsiYXV0aG9yaXphdGlvbkZpbmdlcnByaW50IjoiYjA0MWE2M2JlMTM4M2NlZGUxZTI3OWFlNDlhMWIyNzZlY2FjOTYzOWU2NjlhMGIzODQyYTdkMTY3NzcwYmY0OHxtZXJjaGFudF9pZD1yd3dua3FnMnhnNTZobTJuJnB1YmxpY19rZXk9czlic3BuaGtxMmYzaDk0NCZjcmVhdGVkX2F0PTIwMTgtMTEtMTRUMTE6MTg6MDAuMTU3WiIsInZlcnNpb24iOiIzLXBheXBhbCJ9LCJwYXlwYWwiOnsiYWNjZXNzVG9rZW4iOiJBMjFBQUhNVExyMmctVDlhSTJacUZHUmlFZ0ZFZGRHTGwxTzRlX0lvdk9ESVg2Q3pSdW5BVy02TzI2MjdiWUJ2cDNjQ0FNWi1lTFBNc2NDWnN0bDUyNHJyUGhUQklJNlBBIn19"></script>

       <!-- Implementation -->
   <script>
    let orderId;

    // Displays PayPal buttons
    paypal.Buttons({
      style: {
        layout: 'horizontal'
      },
       createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: "1.00"
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            window.location.href = '/success.html';
          });
        }
    }).render("#paypal-button-container");

    // If this returns false or the card fields aren't visible, see Step #1.
    if (paypal.HostedFields.isEligible()) {

      // Renders card fields
      paypal.HostedFields.render({
        // Call your server to set up the transaction
        createOrder: function () {
          return fetch('/your-server/paypal/order', {
           method: 'post'
         }).then(function(res) {
             return res.json();
         }).then(function(orderData) {
           orderId = orderData.id;
           return orderId;
         });
        },

        styles: {
          '.valid': {
           'color': 'green'
          },
          '.invalid': {
           'color': 'red'
          }
        },

        fields: {
          number: {
            selector: "#card-number",
            placeholder: "4111 1111 1111 1111"
          },
          cvv: {
            selector: "#cvv",
            placeholder: "123"
          },
          expirationDate: {
            selector: "#expiration-date",
            placeholder: "MM/YY"
          }
        }
      }).then(function (cardFields) {
        document.querySelector("#card-form").addEventListener('submit', (event) => {
          event.preventDefault();

          cardFields.submit({
            // Cardholder's first and last name
            cardholderName: document.getElementById('card-holder-name').value,
            // Billing Address
            billingAddress: {
              // Street address, line 1
              streetAddress: document.getElementById('card-billing-address-street').value,
              // Street address, line 2 (Ex: Unit, Apartment, etc.)
              extendedAddress: document.getElementById('card-billing-address-unit').value,
              // State
              region: document.getElementById('card-billing-address-state').value,
              // City
              locality: document.getElementById('card-billing-address-city').value,
              // Postal Code
              postalCode: document.getElementById('card-billing-address-zip').value,
              // Country Code
              countryCodeAlpha2: document.getElementById('card-billing-address-country').value
            }
          }).then(function () {
            fetch('/your-server/api/order/' + orderId + '/capture/', {
              method: 'post'
            }).then(function(res) {
               return res.json();
            }).then(function (orderData) {
               // Three cases to handle:
               //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
               //   (2) Other non-recoverable errors -> Show a failure message
               //   (3) Successful transaction -> Show confirmation or thank you

               // This example reads a v2/checkout/orders capture response, propagated from the server
               // You could use a different API or structure for your 'orderData'
               var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

               if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                 return actions.restart(); // Recoverable state, per:
                 // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
               }

               if (errorDetail) {
                   var msg = 'Sorry, your transaction could not be processed.';
                   if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                   if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                   return alert(msg); // Show a failure message
               }

               // Show a success message or redirect
               alert('Transaction completed!');
            })
         }).catch(function (err) {
           alert('Payment could not be captured! ' + JSON.stringify(err))
         });
        });
      });
    } else {
      // Hides card fields if the merchant isn't eligible
      document.querySelector("#card-form").style = 'display: none';
    }
  </script>



    @endsection
