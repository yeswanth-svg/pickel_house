<style>
    .sidebar-container {

        min-height: fit-content;
        /* Ensure full height */
    }

    .sidebar-container .nav-link {
        font-size: 18px;
        /* Increase font size */
        padding: 12px 16px;
        /* Add padding for better spacing */
    }

    .sidebar-container .nav-item {
        margin-bottom: 8px;
        /* Add spacing between items */
    }
</style>

<div class="card border-0 shadow-sm sidebar-container">
    <div class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}"
            class="nav-link list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>&nbsp; Dashboard
        </a>
        <a href="{{ route('order.history') }}"
            class="list-group-item list-group-item-action {{ request()->is('order*') ? 'active' : '' }}">
            <i class="fas fa-box"></i> &nbsp; Orders History
        </a>

        <a href="{{route('referrals')}}"
            class="nav-link list-group-item list-group-item-action {{ request()->is('referrals') ? 'active' : '' }}">
            <i class="fas fa-share"></i>&nbsp; Referrals
        </a>

        <a href="{{route('support-tickets.index')}}"
            class="nav-link list-group-item list-group-item-action {{ request()->is('support-tickets*') ? 'active' : '' }}">
            <i class="fas fa-ticket-alt"></i>&nbsp; Support Tickets
        </a>
        <a href="{{ route('profile.edit') }}"
            class="nav-link list-group-item list-group-item-action {{ request()->is('profile') ? 'active' : '' }}">
            <i class="fas fa-user"></i>&nbsp;Edit Profile
        </a>
        <a href="{{ route('logout') }}" class="nav-link list-group-item list-group-item-action text-danger">
            <i class="fas fa-sign-out-alt"></i>&nbsp; Logout
        </a>
    </div>
</div>