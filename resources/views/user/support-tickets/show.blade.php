@extends('layouts.app') 
@section('title', 'Add Ticket')

@section('content')


    <!-- Hero Section -->
    <div class="container-fluid py-6 my-6 mt-0"
        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                background: url({{  asset('img/bg-cover.jpg')}}) no-repeat center center/cover;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                color: white;height: 379px;">
        <div class="container text-center animated bounceInDown">
            <h1 class="display-1 mb-4" style="color: white">Add Ticket</h1>
            <ol class="breadcrumb justify-content-center mb-0 animated bounceInDown">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}" style="color: white">Dashboard</a>
                </li>
                <li class="breadcrumb-item text-light" aria-current="page">Add Ticket</li>
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
            <div class="col-md-9">
                <a class="btn btn-info m-2 text-end" href="{{ route('support-tickets.index') }}"><i
                        class="fas fa-arrow-left"></i> Go Back</a>
                <div class="card">
                    <div class="card-header">Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</div>
                    <div class="card-body chat-box p-3" style="height: 400px; overflow-y: auto; background: #f8f9fa;">
                        @foreach ($ticket->messages as $message)
                                            @php
                                                $isAdmin = $message->sender->role === 'admin';
                                            @endphp
                                            <div class="d-flex mb-3 {{ $isAdmin ? 'justify-content-start' : 'justify-content-end' }}">
                                                <div class="p-2 rounded shadow-sm"
                                                    style="max-width: 75%;
                                                                                                                                                                                background: {{ $isAdmin ? '#e9ecef' : '#35bf54' }};
                                                                                                                                                                                color: {{ $isAdmin ? '#000' : '#fff' }};
                                                                                                                                                                                border-radius: 20px;
                                                                                                                                                                                padding: 10px 15px;">
                                                    @if($isAdmin)
                                                        <strong>{{ $message->sender->name }}</strong>
                                                    @endif
                                                    <p class="mb-1">{{ $message->message }}</p>
                                                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}<i
                                                            class="fas fa-clock"></i></small>
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
@endsection