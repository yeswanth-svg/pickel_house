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
    background: #f93827;
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

.address-label .form-check-input:checked + .form-check-label {
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
            <h2 style="margin-bottom: 1rem; font-size: 1.5rem; font-weight: bold;">Your Dishes</h2>
            @foreach ($cartItems as $item)
                <div
                    style="display: flex; justify-content:space-evenly; align-items: center; margin-bottom: 1rem; padding: 1rem; background: #fff; border: 1px solid #ddd; border-radius: 8px; flex-wrap: wrap">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <!-- Dish Image -->
                        <img src="{{ asset('dish_images/' . $item->dish->image) }}" alt="{{ $item->dish->name }}"
                            style="width: 80px; height: 80px; border-radius: 8px; object-fit: cover;">
                        <!-- Dish Name -->
                        <h3 style="margin: 0; font-size: 1.7rem; font-weight: bold; color: #333;">{{ $item->dish->name }}
                        </h3>
                    </div>

                    <div style="display: flex; align-items: center; gap: 1rem; font-size: 1rem; color: #555;">
                        <!-- Quantity -->
                        <div style="display: flex; align-items: center; gap: 0.5rem;font-size: 1.2rem;">
                            <i class="fas fa-balance-scale" style="color: #3498db;"></i> <!-- Quantity Icon -->  
                            <span>{{ $item->quantity->quantity }}</span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 1.2rem;">

                            <span>{{ $item->cart_quantity }} <strong>no.</strong></span>
                        </div>

                        <!-- Price -->
                        <div style="display: flex; align-items: center; gap: 0.5rem;font-size: 1.2rem;">
                            <span>${{ formatCurrency($item->quantity->price) }}</span>
                            <i class="fas fa-tag" style="color: #e74c3c;"></i> <!-- Price Icon -->
                        </div>
                    </div>

                    <!-- Delete Button -->
                    <form action="{{ route('user.cart.destroy', $item->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="background: #e74c3c; color: white; border: none; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer; font-size: 1rem;">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                </div>
            @endforeach

        </div>



        <!-- Right Panel: Total Amount -->
        @if ($cartItems->isNotEmpty())
                <div class="right-panel col-12 col-lg-4">

                    <div class="card-body">
                        <!-- Add Address Modal -->
                        <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-bold">Add Address</span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('user.address.add')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group mb-3">
                                                        <label class="mb-2">Address Label</label>
                                                        <div class="d-flex gap-2 flex-wrap">
                                                            <!-- Modern Styled Radio Buttons -->
                                                            <div class="form-check form-check-inline address-label">
                                                                <input type="radio" id="home" name="label" value="Home"
                                                                    class="form-check-input">
                                                                <label class="form-check-label" for="home">
                                                                    <i class="fas fa-home me-2"></i> Home
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label>Address Line 1</label>
                                                        <input name="address_line_1" type="text" class="form-control"
                                                            placeholder="Enter Address Line 1">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Address Line 2</label>
                                                        <input name="address_line_2" type="text" class="form-control"
                                                            placeholder="Enter Address Line 2">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>City</label>
                                                        <input name="city" type="text" class="form-control"
                                                            placeholder="Enter City">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Pincode</label>
                                                        <input name="pincode" type="number" class="form-control"
                                                            placeholder="Enter Pincode">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="submit" class="btn btn-primary w-100 py-2">
                                                    Add Address
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Address Modal -->
                        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="editAddressForm" method="POST" action="{{ route('user.address.edit') }}">
                                        @csrf
                                        <input type="hidden" name="address_id" id="edit_address_id">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <!-- Label Section -->
                                            <div class="form-group mb-3">
                                                <label class="mb-2">Address Label</label>
                                                <div class="d-flex gap-2 flex-wrap">
                                                    @php
                                                        $labels = ['Home', 'Other'];
                                                    @endphp

                                                    @foreach ($labels as $label)
                                                        <div class="form-check form-check-inline address-label"
                                                            id="edit_label_{{ strtolower($label) }}">
                                                            <input type="radio" id="edit_{{ strtolower($label) }}" name="label"
                                                                value="{{ $label }}" class="form-check-input" disabled>
                                                            <label class="form-check-label" for="edit_{{ strtolower($label) }}">
                                                                <i
                                                                    class="fas fa-{{ strtolower($label) === 'home' ? 'home' : (strtolower($label) === 'work' ? 'briefcase' : (strtolower($label) === 'office' ? 'building' : 'ellipsis-h')) }} me-2"></i>
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted">The label cannot be changed. If you want to add a
                                                        new address, use the "Add Address" option.</small>
                                                </div>
                                            </div>

                                            <!-- Address Line 1 -->
                                            <div class="form-group mb-3">
                                                <label for="edit_address_line_1">Address Line 1</label>
                                                <input type="text" class="form-control" id="edit_address_line_1"
                                                    name="address_line_1" required>
                                            </div>

                                            <!-- Address Line 2 -->
                                            <div class="form-group mb-3">
                                                <label for="edit_address_line_2">Address Line 2</label>
                                                <input type="text" class="form-control" id="edit_address_line_2"
                                                    name="address_line_2">
                                            </div>

                                            <!-- City -->
                                            <div class="form-group mb-3">
                                                <label for="edit_city">City</label>
                                                <input type="text" class="form-control" id="edit_city" name="city" required>
                                            </div>

                                            <!-- Pincode -->
                                            <div class="form-group mb-3">
                                                <label for="edit_pincode">Pincode</label>
                                                <input type="number" class="form-control" id="edit_pincode" name="pincode"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- available coupons modal -->
                        <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="couponModalLabel">Available Coupons</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Unused Coupons -->
                                        <h6>Unused Coupons:</h6>
                                        <ul>
                                            @if($unusedCoupons->isNotEmpty())
                                                @foreach($unusedCoupons as $coupon)
                                                    <li class="py-2">
                                                        <strong>{{ $coupon->code }}</strong>:
                                                        {{ $coupon->type === 'percentage' ? $coupon->value . '%' : '₹' . $coupon->value }}
                                                        off
                                                        (Min Order: ₹{{ $coupon->minimum_order_value ?? 0 }})
                                                        <button class="btn btn-success btn-sm"
                                                            onclick="applyCoupon('{{ $coupon->code }}')">Apply</button>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li>No unused coupons available.</li>
                                            @endif
                                        </ul>

                                        <!-- Used Coupons -->
                                        <h6 class="mt-4">Used Coupons:</h6>
                                        <ul>
                                            @if($usedCoupons->isNotEmpty())
                                                @foreach($usedCoupons as $coupon)
                                                    <li class="py-2">
                                                        <strong>{{ $coupon->code }}</strong>:
                                                        {{ $coupon->type === 'percentage' ? $coupon->value . '%' : '₹' . $coupon->value }}
                                                        off
                                                        (Min Order: ₹{{ $coupon->minimum_order_value ?? 0 }})
                                                        <span class="badge bg-secondary">Used</span>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li>No used coupons.</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="address-container mb-3">
                        <h2 class="title">Manage Delivery Addresses</h2>

                        <div class="address-list">
                            @if ($addresses->isNotEmpty())
                                @foreach ($addresses as $address)
                                    <div class="address-card">
                                        <div class="address-details">
                                            <strong>{{ $address->label }}</strong>
                                            <p>{{ $address->address_line_1 }}, {{ $address->address_line_2 }},
                                                {{ $address->city }}, {{ $address->pincode }}
                                            </p>
                                        </div>
                                        <div class="address-actions d-flex align-items-center gap-3">
                                            <!-- Edit button with icon -->
                                            <button class="btn btn-sm btn-light" title="Edit Address"
                                                onclick="openEditModal({{ json_encode($address) }})">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">You haven't added any addresses yet.</p>
                            @endif
                        </div>

                        @php
                            $addressLabels = $addresses->pluck('label')->toArray(); // Extract all address labels into an array
                        @endphp

                        @if (!in_array('Home', $addressLabels))
                            <!-- Show Add Address button if both "Home" and "Other" labels are not present -->
                            <button class="button-30 mt-2 text-right" data-bs-toggle="modal" data-bs-target="#addAddressModal">Add
                                New Address</button>
                        @endif
                    </div>
                    <div class="card cart">
                        <label class="title" style="font-size: 20px; font-weight: bold; color: #fff; padding: 10px;">
                            CHECKOUT
                        </label>

                        <!-- Coupons Section -->
                        <div class="coupons-section">
                            <h4 style="color: #fff; font-size: 18px; margin-bottom: 10px;">Available Coupons:</h4>
                            <button type="button" class="button-30" data-bs-toggle="modal" data-bs-target="#couponModal">
                                View Available Coupons
                            </button>
                        </div>

                        <hr style="border-top: 1px solid #fff;">

                        <div class="steps" style="padding: 15px;">
                            <div class="step">

                                <!-- Payment Section -->
                                <div class="payments">
                                    <span style="font-size: 18px; font-weight: bold; color: #fff;">PAYMENT</span>
                                    <div class="details" style="padding: 10px; background: #f93827; border-radius: 10px;">

                                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                            <span>Subtotal:</span>
                                            <span style="font-weight: bold;">{{ formatCurrency($cartTotal) }}</span>
                                        </div>

                                        @if ($discountTotal > 0)
                                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                <span>Applied Discount:</span>
                                                <span style="font-weight: bold; color: #a7ff00;">-
                                                    {{formatCurrency($discountTotal) }}</span>
                                            </div>

                                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                <span>New Total:</span>
                                                <span
                                                    style="font-weight: bold; color: #a7ff00;">{{ formatCurrency($finalTotal) }}</span>
                                            </div>
                                        @endif

                                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                            <span>Shipping:</span>
                                            <span style="font-weight: bold;">₹ 50.00</span>
                                        </div>

                                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                            <span>Tax:</span>
                                            <span style="font-weight: bold;">₹ 30.40</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Section -->
                                <div class="footer" style="text-align: center; padding-top: 15px;">
                                    <form action="{{ route('user.checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_ids" value="{{ $cartItems->pluck('id')->join(',') }}">
                                        <input type="hidden" name="total_amount"
                                            value="{{ formatCurrency($finalTotal + 50 + 30.40) }}">
                                        <input type="hidden" name="payment_method" value="COD">

                                        <label class="price">
                                            Total: <span style="margin:6px;"></span> <span id="total-amount3"
                                                style="color: #fff;">
                                                {{ formatCurrency($finalTotal + 50 + 30.40) }}</span>
                                        </label>

                                        <button type="submit" class="button-30 checkout-btn" role="button" style="width: 100%;">
                                            Checkout
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
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