<nav class="navbar navbar-light">
    <div class="container-fluid">
        @if (auth()->check())
            <button class="openbtn" onclick="openNav()">&#9776;</button>
        @endif
        <div class="mx-auto">
            <a href="{{ route('home') }}">
            <img src="{{ url('assets/img/logo.png') }}" width="auto" height="80px">
            </a>
        </div>
        @if (auth()->check())
            <form id="logout" action="{{ route('logout') }}" method="GET">
                @csrf
                <a href="{{ route('logout') }}">
                    <i style="color: #164259" class="bi bi-box-arrow-right fs-3"></i>
                </a>
            </form>
        @endif
        @guest
            <a class="btn btn-primary" href="{{ route('login') }}" role="button">Login</a>
        @endguest
    </div>
</nav>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }
</script>
