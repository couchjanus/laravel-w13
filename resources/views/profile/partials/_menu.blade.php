<div class="list-group">
    <a href="{{ route('home') }}"
        class="list-group-item {{ Request::is('home') ? 'bg-primary text-white' : '' }}">Dashboard
    </a>
    <a href="{{ route('profile') }}"
        class="list-group-item {{ Request::is('profile') ? 'bg-primary text-white' : '' }}">Contact Info
    </a>
    <a href="{{ route('profile.security') }}"
        class="list-group-item {{ Request::is('profile/security') ? 'bg-primary text-white' : '' }}">Security
    </a>
    <a href="{{ route('profile.delete.show') }}"
        class="list-group-item {{ Request::is('profile/delete-account') ? 'bg-danger text-white' : '' }}">Delete
        Account</a>
</div>