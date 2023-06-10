<nav class="navbar navbar-light">
    <div class="container-fluid">
       
        <button class="openbtn" onclick="openNav()">&#9776;</button>
     
        <div class="mx-auto">
            <img src="{{ url('assets/img/logo-news.png') }}" width="80px" height="80px">
        </div>
    
        <form id="logout" action="" method="GET">
            @csrf
            <a>
                <i style="color: #164259" class="bi bi-box-arrow-right"></i>
            </a>
        </form>
     
    </div>
</nav>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginRight = "250px";
    }
</script>
