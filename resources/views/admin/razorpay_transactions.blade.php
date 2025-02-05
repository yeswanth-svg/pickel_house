@extends('layouts.admin')
@section('title', 'Razorpay Transactions')
@section('content')





<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Razorpay Transactions</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Transactions</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Transactions</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Razorpay Transactions</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Customer Email</th>
                                        <th>Customer Phone</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                                                        <tr>
                                                                            <td>{{ $transaction->id }}</td>
                                                                            <td>{{ $transaction->customer_email }}</td>
                                                                            <td>{{ $transaction->customer_phone }}</td>
                                                                            <td>{{ number_format($transaction->amount / 100, 2) }} INR</td>
                                                                            <td>
                                                                                @php
                                                                                    // Define status background colors
                                                                                    $statusClass = match ($transaction->simplified_status) {
                                                                                        'Paid' => 'bg-success text-white',
                                                                                        'Unpaid' => 'bg-warning text-dark',
                                                                                        'Failure' => 'bg-danger text-white',
                                                                                        default => 'bg-secondary text-white',
                                                                                    };
                                                                                @endphp
                                                                                <span class="badge {{ $statusClass }}">
                                                                                    {{ $transaction->simplified_status }}
                                                                                </span>
                                                                            </td>
                                                                            <td>{{ ucfirst($transaction->method) ?? 'Unknown' }}</td>
                                                                            <td>{{ $transaction->formatted_created_at }}</td>
                                                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No transactions found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="{{asset('js/core/jquery-3.7.1.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('js/plugin/datatables/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $("#add-row").DataTable({
            pageLength: 10,
            order: [], // Disable initial sorting
            columnDefs: [
                { orderable: false, targets: [0, 1, 2, 3, 4, 5, 6] } // Disable ordering on all columns
            ]
        });
    });
</script>



@endsection