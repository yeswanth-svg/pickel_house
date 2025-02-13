@extends('layouts.app') 
@section('title', 'Your Referrals')

@section('content')

<!-- Hero Section -->
<div class="container-fluid py-6 my-6 mt-0" style="
        background: url('img/bg-cover.jpg') no-repeat center center/cover;
        color: white;height: 379px;">
    <div class="container text-center animated bounceInDown">
        <h1 class="display-1 mb-4" style="color: white">Referrals</h1>
        <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}" style="color: white">Dashboard</a>
            </li>
            <li class="breadcrumb-item text-light" aria-current="page">Referrals</li>
        </ol>
    </div>
</div>
<!-- Hero End -->

<!-- Main Content -->
<div class="container py-4">


    <div class="row mt-4">
        <!-- Sidebar -->
        <div class="col-md-3">
            @include('partials.dashboard_sidebar')
        </div>

        <!-- Main Dashboard Content -->
        <div class="col-md-9">
            <div class="text-center">
                <h2 class="fw-bold">Referrals List</h2>
            </div>
            <div class="bg-white shadow-sm p-4 rounded">
                <!-- Share Referral Code -->
                <div class="text-center mb-4">
                    <h4>Your Referral Code:
                        <span class="text-primary fw-bold">{{ auth()->user()->referral_code }}</span>
                    </h4>
                    <p class="text-muted">Share this code and earn rewards when your friends sign up!</p>

                    <!-- Referral Link with Copy Button -->
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="text" id="referralLink" class="form-control w-50 text-center me-2"
                            value="{{ url('/register?ref=') . auth()->user()->referral_code }}" readonly>
                        <button class="btn btn-outline-primary" onclick="copyReferralLink()">
                            <i class="far fa-copy"></i> Copy Link
                        </button>
                    </div>

                    <!-- Social Share Buttons -->
                    <div class="d-flex justify-content-center mt-3">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode('🔥 Use my referral code ' . auth()->user()->referral_code . ' to sign up: ' . url('/register?ref=') . auth()->user()->referral_code) }}"
                            class="btn btn-success me-2" target="_blank">
                            <i class="fab fa-whatsapp"></i> Share on WhatsApp
                        </a>

                        <!-- Instagram (Copy to Clipboard Trick) -->
                        <button class="btn btn-danger" onclick="copyReferralMessage()">
                            <i class="fab fa-instagram"></i> Share on Instagram
                        </button>
                    </div>
                </div>

                <!-- Table: Previous Referrals -->
                <div class="table-responsive">
                    <h4 class="fw-bold text-center">Your Referred Users</h4>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($referrals as $key => $referral)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $referral->referredUser->name }}</td>
                                    <td>{{ $referral->referredUser->email }}</td>
                                    <td>{{ $referral->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No referrals yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyReferralLink() {
        var linkInput = document.getElementById("referralLink");
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(linkInput.value).then(() => {
            var content = {
                message: "Link Copied Successfully",
                title: "Success",
                icon: "fa fa-bell"
            };

            $.notify(content, {
                type: 'success', // You can change this to match your notification type
                placement: {
                    from: 'top', // Correct capitalization
                    align: 'right' // Correct capitalization
                },
                time: 1000,
                delay: 5000, // Adjust delay if needed
            });
        });
    }

    function copyReferralMessage() {
        var message = "🔥 Use my referral code {{ auth()->user()->referral_code }} to sign up and enjoy exclusive rewards! 🎉 Register here: {{ url('/register?ref=') . auth()->user()->referral_code }}";
        navigator.clipboard.writeText(message).then(() => {
            alert("Referral message copied! Paste it on Instagram.");
        });
    }
</script>

@endsection