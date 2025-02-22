@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Messages</h3>
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
                        <a href="#">Messages</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">All Messages</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-light">
                        <h4 class="mb-0">All Messages</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @if($messages->isNotEmpty())
                                @foreach($messages as $message)
                                    <div class="d-flex align-items-start mb-3 border-bottom pb-2">
                                        <!-- <div class="notif-img me-3">
                                                                                        <img src="{{ asset('admin/img/default-profile.png') }}" alt="Profile" class="rounded-circle"
                                                                                            width="40">
                                                                                    </div> -->
                                        <div>
                                            <strong>{{ $message->data['username'] }}</strong>
                                            <p class="mb-1">{{ $message->data['message'] }}</p>
                                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                            <br>
                                            <a href="{{ url('admin/tickets/' . ($message->data['ticket_id'] ?? '')) }}"
                                                class="btn btn-sm btn-primary mt-1">
                                                View Conversation
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">No new messages</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection