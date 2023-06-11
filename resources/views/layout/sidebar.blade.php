@if(auth()->check() && auth()->user()->role === 'admin')
<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="nav-link active" href="{{ route('home') }}">Home</a>
    <a class="nav-link" href="{{ route('user.edit') }}">Meu Perfil</a>
    <a class="nav-link" href="{{ route('users') }}">Usuários</a>
</div>
@endif
@if(auth()->check() && auth()->user()->role === 'user')
<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="nav-link active" href="{{ route('home') }}">Home</a>
    <a class="nav-link" href="{{ route('user.edit') }}">Meu Perfil</a>
    <button class="dropdown-btn">Notícias<i class="bi bi-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{ route('news.create') }}">Publicar Nova Notícia</a>
        <a href="{{ route('user.news') }}">Minhas Notícias</a>
    </div>
</div>
@endif

<script>

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }


    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
