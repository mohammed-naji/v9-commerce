@extends('front.master')

@php
    $name = 'name_' . app()->currentLocale();
@endphp

@section('title', 'Shop | ' . env('APP_NAME'))

@section('content')

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">Checkout</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('site.home') }}">Home</a></li>
                        <li class="active">checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-wrapper">
    <div class="cart shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="block">
                        <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>

                        <form action="{{ route('site.result') }}" class="paymentWidgets" data-brands="VISA MASTER AMEX CABALDEBIT"></form>

                        {{-- <!-- Set up a container element for the button -->
                        <div id="paypal-button-container"></div>

                        <!-- Include the PayPal JavaScript SDK -->
                        <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

                        <script>
                            // Render the PayPal button into #paypal-button-container
                            paypal.Buttons({

                                // Set up the transaction
                                createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: '88.44'
                                            }
                                        }]
                                    });
                                },

                                // Finalize the transaction
                                onApprove: function(data, actions) {
                                    return actions.order.capture().then(function(orderData) {
                                        // Successful capture! For demo purposes:
                                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                        var transaction = orderData.purchase_units[0].payments.captures[0];
                                        alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                                        // Replace the above to show a success message within this page, e.g.
                                        // const element = document.getElementById('paypal-button-container');
                                        // element.innerHTML = '';
                                        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                        // Or go to another URL:  actions.redirect('thank_you.html');
                                    });
                                }


                            }).render('#paypal-button-container');
                        </script> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
