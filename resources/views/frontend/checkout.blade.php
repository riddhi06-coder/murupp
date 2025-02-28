<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- page-title -->
        <div class="page-title">
            <div class="container">
                <h3 class="heading text-center">Check Out</h3>
                <ul class="breadcrumbs d-flex align-items-center">
                    <li><a class="link" href="{{ route('frontend.index') }}">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="shop-default-grid.html">Shop</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>View Cart</li>
                </ul>
            </div>
        </div>
        <!-- /page-title -->

        
        <!-- Section checkout -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="flat-spacing tf-page-checkout">
                            @if(!Auth::check())
                                <div class="wrap">
                                    <div class="title-login">
                                        <p>Already have an account?</p>
                                        <a href="{{ route('user.login') }}" class="text-button">Login here</a>
                                    </div>
                                    <form id="loginForm" class="login-box">
                                        @csrf
                                        <div class="grid-2">
                                            <input type="email" name="email" placeholder="Your Email" required>
                                            <input type="password" name="password" placeholder="Password" required>
                                        </div>
                                        <button class="tf-btn" type="submit"><span class="text">Register</span></button>
                                    </form>

                                    <div id="loginMessage"></div>
                            
                                </div>
                            @endif
                            <div class="wrap">
                                <h5 class="title">Information</h5>
                                <form class="info-box">
                                    <div class="grid-2">
                                        <input type="text" placeholder="First Name*">
                                        <input type="text" placeholder="Last Name*">
                                    </div>
                                    <div class="grid-2">
                                        <input type="text" placeholder="Email Address*">
                                        <input type="text" placeholder="Phone Number*">
                                    </div>
                                    <div class="tf-select">
                                        <select class="text-title" name="address[country]" data-default="">
                                            <option selected value="Choose Country/Region" data-provinces="[]">Choose Country/Region</option>
                                            <option value="United States">United States</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Czech Republic">Czechia</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Vietnam">Vietnam</option>
                                        </select>
                                    </div>
                                    <div class="grid-2">
                                        <input type="text" placeholder="Town/City*">
                                        <input type="text" placeholder="Street,...">
                                    </div>
                                    <div class="grid-2">
                                        <div class="tf-select">
                                            <select class="text-title">
                                                <option selected value="Choose State">Choose State</option>
                                                <option value="California">California</option>
                                                <option value="Alabama">Alabam</option>
                                                <option value="Alaska">Alaska</option>
                                                <option value="Arizona">Arizona</option>
                                                <option value="Arkansas">Arkansas</option>
                                                <option value="Florida">Florida</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Washington">Washington</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Iowa">Iowa</option>
                                                <option value="Nevada">Nevada</option>
                                                <option value="Illinois">Illinois</option>
                                            </select>
                                        </div>
                                        <input type="text" placeholder="Postal Code*">
                                    </div>
                                    <textarea placeholder="Write note..."></textarea>
                                </form>
                            </div>
                            <div class="wrap">
                                <h5 class="title">Choose payment Option:</h5>
                                <form class="form-payment">
                                    <div class="payment-box" id="payment-box">
                                        <div class="payment-item">
                                            <label for="credit-card-method" class="payment-header" >
                                                <input type="radio" name="payment-method" class="tf-check-rounded" id="credit-card-method" checked>
                                                <span class="text-title">Online Pyament</span>
                                            </label>
                                        </div>
                                    </div>
                                    <button class="tf-btn btn-reset"  id="payNowButton">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1">
                        <div class="line-separation"></div>
                    </div>
                    <div class="col-xl-5">
                        <div class="flat-spacing flat-sidebar-checkout">
                            <div class="sidebar-checkout-content">
                                <h5 class="title">Shopping Cart</h5>
                                <div class="list-product">
                                    @forelse ($cartItems as $cartItem)
                                        <div class="item-product">
                                            <a href="{{ route('product.show', $cartItem->slug) }}" class="img-product">
                                            <img src="{{ asset($cartItem->product_image) }}" alt="">

                                            </a>
                                            <div class="content-box">
                                                <div class="info">
                                                    <a href="{{ route('product.show', $cartItem->slug) }}" class="name-product link text-title">
                                                        {{ $cartItem->product_name }}
                                                    </a>
                                                    <div class="variant text-caption-1 text-secondary">
                                                        <span class="size">{{ $cartItem->size }}</span>
                                                        @if ($cartItem->colors)
                                                            / <span class="color">{{ $cartItem->colors }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="total-price text-button">
                                                    <span class="price"><i class="fa fa-inr" aria-hidden="true"></i> 
                                                        {{ number_format($cartItem->product_total_price) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">No items in your cart.</p>
                                    @endforelse
                                </div>

                                <div class="sec-total-price">
                                    <div class="top">
                                        <div class="item d-flex align-items-center justify-content-between text-button">
                                            <span>Shipping</span>
                                            <span>Free</span>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        @php
                                            $taxAmount = $total * 0.18; 
                                        @endphp
                                        <h5 class="d-flex justify-content-between">
                                            <span>Total</span>
                                            <span class="total-price-checkout">
                                                <i class="fa fa-inr" aria-hidden="true"></i> {{ number_format($total) }}
                                            </span>
                                        </h5>
                                        <small class="d-flex justify-content-between text-muted">
                                            <span>Including ₹ {{ number_format($taxAmount) }} in taxes</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /Section checkout -->

        @include('components.frontend.footer')

        @include('components.frontend.main-js')

     
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!----- Guest User Login AJax---->
    <script>
        $(document).ready(function () {
            $("#loginForm").submit(function (event) {
                event.preventDefault(); // Prevent page reload

                $.ajax({
                    url: "{{ route('login.authenticate') }}", // Adjust route accordingly
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $("#loginMessage").html("<p style='color: green;'>" + response.message + "</p>");
                            window.location.href = response.redirect; 
                        } else {
                            $("#loginMessage").html("<p style='color: red;'>" + response.message + "</p>");
                        }
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = "<ul style='color: red;'>";
                        $.each(errors, function (key, value) {
                            errorMsg += "<li>" + value[0] + "</li>";
                        });
                        errorMsg += "</ul>";
                        $("#loginMessage").html(errorMsg);
                    }
                });
            });
        });
    </script>
        
    <!----- Payment Gateway Js---->
    <script>
        document.getElementById("payNowButton").addEventListener("click", async function (event) {
            event.preventDefault(); 

            let amount = {{ $total }}; 

            if (amount <= 0) {
                alert("Your cart is empty!");
                return;
            }

            try {
                // Create Razorpay Order
                let response = await fetch("/process-payment", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({ amount: amount })
                });

                let data = await response.json();

                if (!data.order_id) {
                    alert("Error creating payment order!");
                    return;
                }

                var options = {
                    key: data.razorpay_key,
                    amount: data.amount * 100, 
                    currency: data.currency,
                    order_id: data.order_id,
                    name: "Your Store Name",
                    description: "Purchase from your store",
                    handler: async function (response) {
                        let verifyResponse = await fetch("/verify-payment", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            },
                            body: JSON.stringify(response)
                        });

                        let verifyData = await verifyResponse.json();
                        if (verifyData.status === "Payment Successful") {
                            window.location.href = "/thank-you"; 
                        }
                    },
                    theme: {
                        color: "#3399cc"
                    }
                };
                var rzp = new Razorpay(options);
                rzp.open();

            } catch (error) {
                console.error("Payment Error:", error);
            }
        });
    </script>


</body>

</html>