@extends('layouts.app')
@section('title', 'Cart')
@section('content')

<!-- Include FontAwesome for the icons -->


<style>
    /* Styles for the Cart Page */
    /* From Uiverse.io by mi-series */
    /* Body */

    hr {
        height: 1px;
        background-color: #E5C7C5;
        border: none;
    }

    .card {
        width: 100%;
        background: #FF7D29;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;
        border-radius: 19px 19px 0px 0px;
    }

    .title {
        width: 100%;
        height: 40px;
        position: relative;
        display: flex;
        align-items: center;
        padding-left: 20px;
        border-bottom: 1px solid #E5C7C5;
        font-weight: 700;
        font-size: 20px;
        color: white;
        font-family: "Montserrat", san-serif;
    }

    /* Cart */


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
        font-family: "Montserrat", san-serif;
    }

    .cart .steps .step p {
        font-size: 15px;
        font-weight: 600;
        color: white;
        font-family: "Montserrat", san-serif;
        margin-top: 0px;
    }




    .shipping .form button {
        padding: 10px 18px;
        gap: 10px;
        width: 75%;
        height: 41px;
        left: -24px;
    }

    /* Promo */
    .promo .available-coupons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .input_field {
        width: 73%;
        height: 36px;
        padding: 0 0 0 12px;
        border-radius: 5px;
        outline: none;
        border: 1px solid #E5C7C5;
        transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
    }

    .input_field:focus {
        border: 1px solid transparent;
        box-shadow: 0px 0px 0px 2px #F3D2C9;

    }

    .promo .available-coupons button {
        height: 36px;
        border-radius: 5px;
        border: 0;
        font-style: normal;
        font-weight: 600;
        font-size: 12px;
        line-height: 15px;
        padding: 10px 18px;
    }

    /* Checkout */
    .payments .details {
        display: grid;
        grid-template-columns: 8fr 1fr;
        gap: 5px;
        word-wrap: break-word;
    }

    .payments .details span {
        font-size: 13px;
        font-weight: 600;
        color: white;
    }

    .checkout .footer {

        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        padding: 10px 10px 10px 20px;
        background-color: #FF7D29;
        border-radius: 19px 19px 0px 0px;
    }

    .price {
        font-size: 18px;
        color: white;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .checkout .footer .checkout-btn {
        flex-direction: row;
        justify-content: center;
        align-items: center;
        color: #000000;
        font-size: 16px;
        font-weight: 600;

    }
</style>
<style>
    /* css for the button */
    .button-30 {
        align-items: center;
        appearance: none;
        background-color: #FCFCFD;
        border-radius: 4px;
        border-width: 0;
        box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        box-sizing: border-box;
        color: #36395A;
        cursor: pointer;
        display: inline-flex;
        font-family: "Montserrat", san-serif;
        height: 48px;
        justify-content: center;
        line-height: 1;
        list-style: none;
        overflow: hidden;
        padding-left: 16px;
        padding-right: 16px;
        position: relative;
        text-align: left;
        text-decoration: none;
        transition: box-shadow .15s, transform .15s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        white-space: nowrap;
        will-change: box-shadow, transform;
        font-size: 18px;
    }

    .button-30:focus {
        box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
    }

    .button-30:hover {
        box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        transform: translateY(-2px);
    }

    .button-30:active {
        box-shadow: #D6D6E7 0 3px 7px inset;
        transform: translateY(2px);
    }
</style>

<style>
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
</style>

<style>
    .address-container {
        padding: 1.5rem;
        width: 100%;
        background: #FF7D29;
        box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;
        border-radius: 19px 19px 0px 0px;

    }

    .title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
        font-weight: bold;
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
</style>







<div class="container-fluid">

    <!-- Left Panel: Dishes and Total -->
    <div class="row">
        <div class="left-panel col-12 col-lg-8">
            <h2 style="margin-bottom: 1rem; font-size: 1.5rem; font-weight: bold;">Your Dishes</h2>
            @foreach ($cartItems as $item)
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding: 1rem; background: #fff; border: 1px solid #ddd; border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <!-- Dish Image -->
                        <img src="{{ asset('dish_images/' . $item->dish->image) }}" alt="{{ $item->dish->name }}"
                            style="width: 80px; height: 80px; border-radius: 8px; object-fit: cover;">
                        <!-- Dish Name -->
                        <h3 style="margin: 0; font-size: 1.2rem; font-weight: bold; color: #333;">{{ $item->dish->name }}
                        </h3>
                    </div>

                    <div style="display: flex; align-items: center; gap: 1rem; font-size: 1rem; color: #555;">
                        <!-- Quantity -->
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-balance-scale" style="color: #3498db;"></i> <!-- Quantity Icon -->
                            <span>{{ $item->quantity->quantity }} <strong>Qty</strong></span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.5rem;">

                            <span>{{ $item->cart_quantity }} <strong>no.</strong></span>
                        </div>

                        <!-- Price -->
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-tag" style="color: #e74c3c;"></i> <!-- Price Icon -->
                            <span>${{ number_format($item->quantity->price, 2) }}</span>
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

                                                            <!-- <div class="form-check form-check-inline address-label">
                                                                                                                                                <input type="radio" id="other" name="label" value="Other"
                                                                                                                                                    class="form-check-input">
                                                                                                                                                <label class="form-check-label" for="other">
                                                                                                                                                    <i class="fas fa-ellipsis-h me-2"></i> Other
                                                                                                                                                </label>
                                                                                                                                            </div> -->
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

                        @if (!in_array('Home', $addressLabels) || !in_array('Other', $addressLabels))
                            <!-- Show Add Address button if both "Home" and "Other" labels are not present -->
                            <button class="button-30 mt-2 text-right" data-bs-toggle="modal" data-bs-target="#addAddressModal">Add
                                New Address</button>
                        @endif
                    </div>



                    <div class="card cart">

                        <label class="title">CHECKOUT</label>
                        <div class="steps">
                            <div class="step">
                                <div class="promo">
                                    <div class="available-coupons">
                                        <h4 style="color:white;">Available Coupons:</h4>
                                        <!-- Modal Trigger -->
                                        <button type="button" class="button-30" data-bs-toggle="modal"
                                            data-bs-target="#couponModal">
                                            View Available Coupons
                                        </button>
                                    </div>

                                </div>
                                <hr>
                                <div class="payments">
                                    <span>PAYMENT</span>
                                    <div class="details">
                                        <span>Subtotal:</span>
                                        <span style="font-weight: bold;">₹{{ number_format($cartTotal, 2) }}</span>

                                        @if ($discountTotal > 0)
                                            <span>Applied Discount:</span>
                                            <span style="font-weight: bold; color: #a7ff00;">-
                                                ₹{{ number_format($discountTotal, 2) }}</span>

                                            <span>New Total:</span>
                                            <span
                                                style="font-weight: bold; color: #a7ff00;">₹{{ number_format($finalTotal, 2) }}</span>

                                        @endif

                                        <span>Shipping:</span>
                                        <span style="font-weight: bold;">₹50.00</span>
                                        <span>Tax:</span>
                                        <span style="font-weight: bold;">₹30.40</span>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="card checkout mt-2">
                        <div class="footer">
                            <form action="{{ route('user.checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_ids" value="{{ $cartItems->pluck('id')->join(',') }}">
                                <input type="hidden" name="total_amount"
                                    value="{{  number_format($finalTotal + 50 + 30.40, 2) }}">
                                <input type="hidden" name="payment_method" value="COD">

                                <!-- <div style="margin-bottom: 1rem;">
                                                                                                    <h4>Select Payment Method</h4>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD"
                                                                                                            required>
                                                                                                        <label class="form-check-label" for="cod">
                                                                                                            <i class="fas fa-money-bill-wave me-2"></i> <span class="text-light">Cash on
                                                                                                                Delivery</span>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div class="form-check form-check-inline">
                                                                                                        <input class="form-check-input" type="radio" name="payment_method" id="razorpay"
                                                                                                            value="Online" required>
                                                                                                        <label class="form-check-label" for="razorpay">
                                                                                                            <i class="fas fa-credit-card me-2"></i><span class="text-light">Pay Online
                                                                                                                (Razorpay)</span>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div> -->

                                <label class="price" style="margin-right: 12pc;">
                                    Total: <span id="total-amount3">₹{{ number_format($finalTotal + 50 + 30.40, 2) }}</span>
                                </label>

                                <button type="submit" class="button-30 checkout-btn" role="button">Checkout</button>

                            </form>

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