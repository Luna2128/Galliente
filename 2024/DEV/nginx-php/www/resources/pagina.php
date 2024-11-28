<?php

class Page {
    var $header;
	var $navbar;
	var $footer;

    var $title               = 'Galliente';
    var $css_bootstrap       = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
    var $js_bootstrap        = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>';
    var $js_popper           = '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>';
    var $css_bootstrap_icons = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">';
    var $css_vjs             = '<link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet">';
    var $js_vjs              = '<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>';

    public function header(){	
        $this->header.= '
        <!DOCTYPE html>
        <html lang="es" data-bs-theme="dark">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="/resources/images/favicon.ico">
            <title>'.$this->title.'</title>
            '.$this->css_bootstrap.'
            '.$this->js_bootstrap.'
            '.$this->css_bootstrap_icons.'
            '.$this->js_popper.'
            '.$this->css_vjs.'
            '.$this->js_vjs.'
        </head>
        ';
        echo $this->header; 
    }

    public function navbar(){
        $this->navbar.='
        <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Brand (izquierda) -->
            <a class="navbar-brand" href="#">'.$this->title.'</a>
            
            <!-- Botón de toggle para móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <!-- Menú con todas las opciones -->
                <li class="nav-item">
                <a class="nav-link" href="../panel/">Panel Principal</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../streams/">Streams</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/usuarios/">Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$_SESSION['username']. '<!-- Nombre del usuario -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="/resources/logout.php">Cerrar sesión</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        ';
        echo $this->navbar;
    }

        public function footer(){
            $this->footer = $this->footer.='
            <footer class="d-flex flex-column justify-content-center align-items-center py-3 my-4 border-top">
                <a href="/" class="text-body-secondary text-decoration-none lh-1 mb-2">
                    <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                </a>
                <span class="text-body-secondary">© 2024 Galliente</span>
            </footer>
            ';
            echo $this->footer;
        }

}// CLASS PAGE
?>