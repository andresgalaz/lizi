<nav class="navbar navbar-expand-lg">
<div class="container">
    <a href="index.php" class="navbar-brand home">
        <img src="img/logo.png" alt="Compustrom logo" class="d-none d-md-inline-block">
        <img src="img/logo-small.png" alt="Compustrom logo" class="d-inline-block d-md-none">
        <span class="sr-only">Volver a Home</span>
    </a>
    <div class="navbar-buttons">
        <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler">
            <span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i>
        </button>
        <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler">
            <span class="sr-only">Toggle search</span><i class="fa fa-search"></i>
        </button>
        <a href="#basket.html" class="btn btn-outline-secondary navbar-toggler en-construccion"><i class="fa fa-shopping-cart"></i></a>
    </div>
    <div id="navigation" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a href="#" class="nav-link active">Home</a></li>
            <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Bebidas<b class="caret"></b></a>
            <ul class="dropdown-menu megamenu">
                <li>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                    <h5>Vinos</h5>
                    <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="#" class="nav-link">Blanco</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Dulce</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Espumante</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Naranja</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Rosado</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Tinto</a></li>
                    </ul>
                    </div>
                    <div class="col-md-6 col-lg-3">
                    <h5>Otros</h5>
                    <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="#" class="nav-link">Cajas de 6</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Degustaciones</a></li>
                    </ul>
                    </div>

                
                </div>
                </li>
            </ul>
            </li>
            <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link en-construccion">Preguntas Frecuentes<b class="caret"></b></a>
            </li>
            <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link en-construccion">Contacto<b class="caret"></b></a>
            </li>
        </ul>
        <div class="navbar-buttons d-flex justify-content-end">
            <!-- /.nav-collapse-->
            <div id="search-not-mobile" class="navbar-collapse collapse"></div>
            <a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block">
                <span class="sr-only">Toggle search</span><i class="fa fa-search"></i>
            </a>
            <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                <a href="#basket.html" class="btn btn-primary navbar-btn en-construccion">
                    <i class="fa fa-shopping-cart"></i><span>0 items in cart</span>
                </a>
            </div>
        </div>
    </div>
</div>
</nav>

<!-- Barra de Búsqueda -->
<div id="search" class="collapse">
<div class="container">
    <form role="search" class="ml-auto">
    <div class="input-group">
        <input type="text" placeholder="Búsqueda" class="form-control">
        <div class="input-group-append">
        <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
    </div>
    </form>
</div>
</div>
