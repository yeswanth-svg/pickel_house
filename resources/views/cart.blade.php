@extends('layouts.app')
@section('title', 'Cart')
@section('content')

    <style>
        /* styles for the cart page */


        /* General Styles */
        hr {
            height: 1px;
            background-color: #e5c7c5;
            border: none;
        }

        /* Card Styles */
        .card {
            width: 100%;
            /* background: #f93827; */
            box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px,
                rgba(0, 0, 0, 0.1) 0px 2px 4px 0px,
                rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;
            border-radius: 19px 19px 0px 0px;
        }

        /* Title Section */
        .title {
            width: 100%;
            height: 40px;
            display: flex;
            align-items: center;
            padding-left: 20px;
            border-bottom: 1px solid #e5c7c5;
            font-weight: 700;
            font-size: 20px;
            color: white;
            font-family: "Montserrat", sans-serif;
        }

        /* Cart Section */
        .cart .steps {
            padding: 20px;
        }

        .cart .steps .step {
            gap: 10px;
        }

        .cart .steps .step span {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin-bottom: 8px;
            display: block;
            font-family: "Montserrat", sans-serif;
        }

        .cart .steps .step p {
            font-size: 15px;
            font-weight: 600;
            color: white;
            font-family: "Montserrat", sans-serif;
            margin-top: 0px;
        }

        /* Shipping */
        .shipping .form button {
            padding: 10px 18px;
            gap: 10px;
            width: 75%;
            height: 41px;
        }

        /* Promo Section */
        .promo .available-coupons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .input_field {
            width: 73%;
            height: 36px;
            padding: 0 12px;
            border-radius: 5px;
            outline: none;
            border: 1px solid #e5c7c5;
            transition: all 0.3s ease-in-out;
        }

        .input_field:focus {
            border: 1px solid transparent;
            box-shadow: 0px 0px 0px 2px #f3d2c9;
        }

        .promo .available-coupons button {
            height: 36px;
            border-radius: 5px;
            border: 0;
            font-weight: 600;
            font-size: 12px;
            padding: 10px 18px;
        }

        /* Checkout */
        .checkout-container .row {
            display: flex;
            align-items: stretch;
        }

        .checkout-container .col-lg-4 {
            display: flex;
            flex-direction: column;
        }

        .checkout-container .card {
            flex-grow: 1;
        }

        .checkout-container .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Payment Section */
        .payments .details {
            display: grid;
            /* grid-template-columns: 8fr 1fr; */
            gap: 5px;
            word-wrap: break-word;
        }

        .payments .details span {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        /* Total Price Styling */
        .price {
            font-size: 18px;
            color: white;
            font-weight: bold;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }

        /* Ensure total does not appear negative */
        .negative-total {
            color: red;
            font-weight: bold;
        }

        /* Checkout Button */
        .checkout .footer {
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #ff7d29;
            border-radius: 19px 19px 0px 0px;
        }

        .checkout .footer .checkout-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000000;
            font-size: 16px;
            font-weight: 600;
        }

        /* Button Styles */
        .button-30 {
            align-items: center;
            background-color: #fcfcfd;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,
                rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #d6d6e7 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395a;
            cursor: pointer;
            display: inline-flex;
            font-family: "Montserrat", sans-serif;
            height: 48px;
            justify-content: center;
            padding-left: 16px;
            padding-right: 16px;
            transition: box-shadow 0.15s, transform 0.15s;
            font-size: 18px;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px,
                rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #d6d6e7 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #d6d6e7 0 3px 7px inset;
            transform: translateY(2px);
        }

        /* Address Section */
        .address-container {
            padding: 1.5rem;
            width: 100%;
            background: #f93827;
            border-radius: 19px 19px 0px 0px;
        }

        .address-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .address-card {
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: box-shadow 0.3s ease;
        }

        .address-card.selected {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        }

        .address-details {
            max-width: 70%;
            color: #ffffff;
        }

        .address-actions {
            display: flex;
            gap: 0.5rem;
        }

        .address-label.active-label {
            border: 2px solid #007bff;
            border-radius: 8px;
            background-color: #e7f1ff;
        }

        /* modal desings */
        .modal-content {
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
            background-color: #fff;
            padding: 20px;
        }

        .modal-header {
            padding-bottom: 10px;
            border-bottom: none;
        }

        .modal-header .btn-close {
            background: transparent;
            border: none;
            font-size: 1.2rem;
        }

        .modal-body {
            padding: 20px 15px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.2);
        }

        .address-label .form-check-input {
            display: none;
        }

        .address-label .form-check-label {
            display: inline-block;
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-label .form-check-label:hover {
            background-color: #f8f9fa;
        }

        .address-label .form-check-input:checked+.form-check-label {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card .coupons-section {
            background: #f93827;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>

    <div class="container-fluid">
        <!-- Left Panel: Dishes and Total -->
        <div class="row">
            <div class="left-panel col-12 col-lg-8">
                <h2 style="margin-bottom: 1rem; font-size: 1.5rem; font-weight: bold;">Your Order</h2>

                @foreach ($cartItems as $item)
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding: 1rem; background: #fff; border: 1px solid #ddd; border-radius: 8px; flex-wrap: wrap;">

                        <!-- Image and Details -->
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <img src="{{ asset('dish_images/' . $item->dish->image) }}" alt="{{ $item->dish->name }}"
                                style="width: 80px; height: 80px; border-radius: 8px; object-fit: cover;">
                            <div>
                                <h3 style="margin: 0; font-size: 1rem; font-weight: bold; color: #333;">{{ $item->dish->name }}
                                </h3>
                                <p style="margin: 0; font-size: 0.9rem; color: #777;">{{ $item->quantity->quantity }} gm</p>
                                <p style="margin: 0; font-size: 0.9rem; color: #777;">Ready to dispatch in 3 - 5 business days
                                </p>
                            </div>
                        </div>

                        <!-- Cart Quantity Counter -->
                        <!-- <div class="input-group input-group-sm me-2" style="width: 100px;">
                                                                    <button type="button" class="btn btn-outline-secondary btn-sm decrease-qty"
                                                                        data-item-id="{{ $item->id }}">−</button>
                                                                    <input type="number" name="cart_quantity" class="form-control text-center cart-quantity" min="1"
                                                                        value="{{ $item->cart_quantity }}" style="width: 29px; font-size: 14px;">
                                                                    <button type="button" class="btn btn-outline-secondary btn-sm increase-qty"
                                                                        data-item-id="{{ $item->id }}">+</button>
                                                                </div> -->

                        <!-- Price -->
                        <div style="font-size: 1rem; color: #555; text-align: right;">
                            <span
                                style="text-decoration: line-through; color: #888;">${{ formatCurrency($item->quantity->original_price) }}</span>
                            <span
                                style="font-weight: bold; display: block;">${{ formatCurrency($item->quantity->price) }}</span>
                        </div>

                        <!-- Delete Button -->
                        <form action="{{ route('user.cart.destroy', $item->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; cursor: pointer; color: #e74c3c;">
                                <i class="fas fa-trash-alt" style="font-size: 1.2rem;"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            <!-- Right Panel: Total Amount -->
            @if ($cartItems->isNotEmpty())
                <div class="right-panel col-12 col-lg-4">
                    <!-- Free Shipping Notification -->
                    <div class="d-flex align-items-center justify-content-between p-2">
                        <span>
                            <i class="fas fa-gift"></i> Shop for more for
                            <span class="text-primary font-weight-bold">FREE SHIPPING!</span>
                        </span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox">
                        </div>
                    </div>
                    <!-- <div class="text-muted small">No Customs Duties</div> -->
                    <div class="card cart mt-3 p-3" style="border-radius: inherit;">
                        <h4 class="font-weight-bold">Order Summary</h4>

                        <!-- Subtotal -->
                        <div class="d-flex justify-content-between mt-2">
                            <span>Total:</span>
                            <span>Rs. {{ number_format($cartTotal, 2) }}</span>
                        </div>

                        <!-- Discount -->
                        @if ($discountTotal > 0)
                            <div class="d-flex justify-content-between mt-2 text-danger">
                                <span>Savings:</span>
                                <span>- Rs. {{ number_format($discountTotal, 2) }}</span>
                            </div>
                        @endif

                        <!-- Grand Total -->
                        <div class="d-flex justify-content-between mt-3 border-top pt-2">
                            <span class="font-weight-bold">Grand Total:</span>
                            <span class="font-weight-bold">Rs. {{ number_format($finalTotal, 2) }}</span>
                        </div>

                        <!-- Checkout Button -->
                        <a href="{{ url('/checkout') }}" class="btn btn-primary btn-block mt-3">
                            CHECKOUT
                        </a>


                        <!-- Continue Shopping Button -->
                        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-block mt-2">
                            CONTINUE SHOPPING
                        </a>
                    </div>
                </div>


            @endif

        </div>
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function openEditModal(address) {
            // Fill modal inputs with existing address data
            document.getElementById('edit_address_id').value = address.id;
            document.getElementById('edit_address_line_1').value = address.address_line_1;
            document.getElementById('edit_address_line_2').value = address.address_line_2;
            document.getElementById('edit_city').value = address.city;
            document.getElementById('edit_pincode').value = address.pincode;

            // Highlight the correct label
            const labels = ['home', 'work', 'office', 'other'];
            labels.forEach(label => {
                const element = document.getElementById(`edit_label_${label}`);
                if (element) element.classList.remove('active-label'); // Remove highlight
            });

            const selectedLabel = address.label.toLowerCase();
            const activeElement = document.getElementById(`edit_label_${selectedLabel}`);
            if (activeElement) activeElement.classList.add('active-label'); // Add highlight

            // Check the correct radio button
            document.querySelector(`input[name="label"][value="${address.label}"]`).checked = true;

            // Show the modal
            $('#editAddressModal').modal('show');
        }


        function applyCoupon(code) {
            fetch('/apply-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ promo_code: code }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close the modal and remove the backdrop immediately
                        const modalElement = document.getElementById('couponModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();
                        document.querySelector('.modal-backdrop')?.remove();

                        // Show success notification
                        var content = {
                            message: `Coupon applied! Discount: ₹${data.discount}`,
                            title: "Success",
                            icon: "fa fa-bell",
                        };

                        $.notify(content, {
                            type: 'success',
                            placement: {
                                from: 'top',
                                align: 'right',
                            },
                            time: 1000,
                            delay: 2000, // Notification delay
                            onClosed: function () {
                                // Reload the page after the notification is closed
                                location.reload();
                            },
                        });
                    } else {
                        // Show warning notification
                        var content = {
                            message: `<strong>${data.message}</strong>`,
                            title: "Warning",
                            icon: "fa fa-exclamation-circle",
                        };

                        $.notify(content, {
                            type: "danger", // Error style
                            allow_dismiss: true,
                            delay: 5000,
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            offset: { x: 20, y: 70 },
                            animate: {
                                enter: "animated fadeInDown",
                                exit: "animated fadeOutUp",
                            },
                            onClosed: function () {
                                // Reload the page after the notification is closed
                                location.reload();
                            },
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Handle fetch error
                    var content = {
                        message: "<strong>Something went wrong. Please try again.</strong>",
                        title: "Error",
                        icon: "fa fa-exclamation-circle",
                    };

                    $.notify(content, {
                        type: "danger",
                        allow_dismiss: true,
                        delay: 5000,
                        placement: {
                            from: "top",
                            align: "right",
                        },
                        offset: { x: 20, y: 70 },
                        animate: {
                            enter: "animated fadeInDown",
                            exit: "animated fadeOutUp",
                        },
                        onClosed: function () {
                            // Reload the page after the notification is closed
                            location.reload();
                        },
                    });
                });
        }



        // Additional modal logic
        $(document).ready(function () {
            $("#addRowButton").click(function () {
                $("#addRowModal").modal("hide");
            });
        });


    </script>



@endsection