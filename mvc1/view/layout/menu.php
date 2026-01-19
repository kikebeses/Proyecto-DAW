<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URLSITE; ?>">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <!-- Dropdown Clientes -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ClientesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Clientes</a>
                        <ul class="dropdown-menu" aria-labelledby="ClientesDropdown">
                            <li><a class="dropdown-item" href="<?php echo URLSITE . '?c=clientes'; ?>">Clientes...</a>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo URLSITE . '?c=facturas'; ?>">Facturas...</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Dropdown Artículos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="articulosDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Articulos</a>
                        <ul class="dropdown-menu" aria-labelledby="articulosDropdown">
                            <li><a class="dropdown-item" href="<?php echo URLSITE . '?c=articulos'; ?>">Articulos...</a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </ul>
            <span class="navbar-text">
                <a class="nav-item nav-link active" href="<?php echo URLSITE . '?c=ayuda'; ?>"> Ayuda</a>
            </span>
        </div>
    </div>
</nav>

</div>
</body>

</html>