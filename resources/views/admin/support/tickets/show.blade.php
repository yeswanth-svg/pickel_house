@extends('layouts.admin')
@section('title', 'Ticket Messages')
@section('content')



    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Ticket Messages</h3>
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
                        <a href="#">Ticket Messages</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">All Ticket Messages</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</h4>
                                <button class="btn btn-primary btn-round ms-auto" id="openCreate">
                                    <i class="fa fa-arrow-left"></i>
                                    Go Back
                                </button>
                            </div>
                        </div>


                        <div class="card-body chat-box p-3" style="height: 400px; overflow-y: auto; background: #f8f9fa;">
                            @foreach ($ticket->messages as $message)
                                                    @php
                                                        $isUser = $message->sender->role === 'user';
                                                    @endphp
                                                    <div class="d-flex mb-3 {{ $isUser ? 'justify-content-start' : 'justify-content-end' }}">
                                                        <div class="p-2 rounded shadow-sm"
                                                            style="max-width: 75%;background: {{ $isUser ? '#e9ecef' : '#35bf54' }}; color: {{ $isUser ? '#000' : '#fff' }}; border-radius: 20px;  padding: 10px 15px;">
                                                            <strong>{{ $message->sender->name }}</strong>
                                                            <p class="mb-1">{{ $message->message }}</p>
                                                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}<i class="fas fa-clock"></i></small>
                                                        </div>
                                                    </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('support.tickets.message', $ticket->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <textarea name="message" class="form-control" required
                                        placeholder="Type a message..."></textarea>
                                    <button class="btn btn-primary">Send</button>
                                </div>
                            </form>
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


            $('#openCreate').click(function () {
                window.location.href = '{{ route('admin.tickets.index') }}';
            })


        });


    </script>


@endsection