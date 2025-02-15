@extends('layouts.admin')
@section('title', 'Rewards List')
@section('content')



<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Rewards</h3>
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
                    <a href="#">Rewards</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">All Rewards</a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">All Rewards</h4>

                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Reward
                            </button>


                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">Add New</span>
                                            <span class="fw-light"> Reward </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.rewards.store')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Min Cart Value</label>
                                                        <input id="addKey" name="min_cart_value" type="text"
                                                            class="form-control" placeholder="Enter Min Cart Value" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Reward Name</label>
                                                        <input id="addKey" name="reward_name" type="text"
                                                            class="form-control" placeholder="Enter Value" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Reward Message</label>
                                                        <input id="addKey" name="reward_message" type="text"
                                                            class="form-control" placeholder="Enter Message" />
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0">
                                                    <button type="submit" class="btn btn-primary">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">Edit</span>
                                            <span class="fw-light">Rewards</span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('PUT') <!-- Use PUT or PATCH if you're updating -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Min Cart Value</label>
                                                        <input id="min_cart_value" name="min_cart_value" type="text"
                                                            class="form-control" placeholder="Enter min cart value Name"
                                                            required />
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Reward Name</label>
                                                        <input id="reward_name" name="reward_name" type="text"
                                                            class="form-control" placeholder="Enter reward name"
                                                            required />
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Reward Message</label>
                                                        <input id="reward_message" name="reward_message" type="text"
                                                            class="form-control" placeholder="Enter reward message"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Min Cart Value</th>
                                        <th>Reward Name</th>
                                        <th>Reward Message</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rewards as $reward)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$reward->min_cart_value}}</td>
                                        <td>{{$reward->reward_name}}</td>
                                        <td>{{$reward->reward_message ?: '' }}</td>
                                        <td>
                                            <div class="form-button-action">

                                                <button class="btn btn-link btn-lg ms-auto edit-button"
                                                    data-bs-toggle="modal" data-bs-target="#editRowModal"
                                                    data-id="{{ $reward->id }}"
                                                    data-min-cart-value="{{ $reward->min_cart_value }}"
                                                    data-reward-name="{{ $reward->reward_name }}"
                                                    data-reward-message="{{ $reward->reward_message }}" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>




                                                <form action="{{ route('admin.rewards.destroy', $reward->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-link btn-danger btn-lg delete-btn"
                                                        data-url="{{ route('admin.rewards.destroy', $reward->id) }}"
                                                        data-bs-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>


                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('admin/js/plugin/datatables/datatables.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Add Row
        $("#add-row").DataTable({
            pageLength: 10,
        });


        $("#addRowButton").click(function () {

            $("#addRowModal").modal("hide");
        });



    });


    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const min_cart_value = this.getAttribute('data-min-cart-value');
                const reward_name = this.getAttribute('data-reward-name');
                const reward_message = this.getAttribute('data-reward-message'); // Get the content field

                // Populate the modal fields
                const modal = document.getElementById('editRowModal');
                modal.querySelector('#min_cart_value').value = min_cart_value;
                modal.querySelector('#reward_name').value = reward_name;
                modal.querySelector('#reward_message').value = reward_message; // Populate content

                // Update the form action with the correct ID
                const form = modal.querySelector('form');
                form.action = `/admin/rewards/${id}`;
            });
        });

        // Reset the modal form when closed
        const modalElement = document.getElementById('editRowModal');
        modalElement.addEventListener('hidden.bs.modal', function () {
            const form = modalElement.querySelector('form');
            form.reset();
            form.action = "#";
        });
    });



    document.addEventListener('DOMContentLoaded', function () {
        // Add click event listener to all delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('form'); // Get the associated form
                const deleteUrl = this.dataset.url; // Fetch the delete URL

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            "Deleted!",
                            "Your Reward has been deleted.",
                            "success"
                        );
                        form.submit(); // Submit the form if confirmed
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            "Cancelled",
                            "Your Reward is safe!",
                            "error"
                        );
                    }
                });
            });
        });
    });


</script>

@endsection