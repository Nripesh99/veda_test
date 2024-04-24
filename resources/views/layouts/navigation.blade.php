<style>
   .navbar {
    margin-bottom: 45px; /* Adjust the value as needed */
}
.navbar-brand {
    font-size: 1.5rem;
}
.navbar-nav .nav-link {
    font-size: 1.2rem;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease-in-out;
}
.navbar-nav .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
}
.dropdown-menu {
    background-color: blueviolet;
}
.dropdown-item {
    color: #fff;
}
.dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
}

</style>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: blueviolet;">
    <div class="container-fluid">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="{{ url('/home') }}">Your Brand</a>

        <!-- Toggle button for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.index') }}">My Sales</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Commission
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">View Sales</a></li>
                        <li><a class="dropdown-item" href="{{route('users.index')}}">View Users</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="nav-link">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
