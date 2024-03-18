<h1>welcome to the dashboard</h1>

<h1> click here to go out</h1>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="#" class="dropdown-item"
       onclick="event.preventDefault();
        this.closest('form').submit();">
        <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
        <span>Logout</span>
    </a>
</form>