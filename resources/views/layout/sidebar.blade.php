
<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="nav-link active" href="">Home</a>
    <a class="nav-link" href="">Meu Perfil</a>
    <button class="dropdown-btn">Coletas<i class="bi bi-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="">Solicitar Coleta</a>
        <a href="">Minhas Solicitações</a>
    </div>
    <a class="nav-link" href="">Ranking</a>
</div>

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
