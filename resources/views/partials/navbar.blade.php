<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">TBN</a>

    <ul class="navbar-nav mr-auto">
        @auth <!-- Hanya tampilkan link jika pengguna sudah login -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('blog') ? 'active' : '' }}" href="/blog">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('event') ? 'active' : '' }}" href="/event">Event</a>
            </li>
        @endauth
    </ul>

    @auth
    <ul class="navbar-nav ml-auto align-items-center"> 
        <li class="nav-item">
            <span class="navbar-text">Hi, {{ auth()->user()->name }}</span>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="nav-link">
                @csrf
                <button type="submit" class="btn btn-dark">Logout</button>
            </form>
        </li>
    </ul>
@endauth

    @guest <!-- Jika pengguna belum login, tampilkan tombol untuk login -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="/register">Register</a>
            </li>
        </ul>
    @endguest
</nav>
