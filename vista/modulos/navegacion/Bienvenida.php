<?php

if (!isset($_SESSION["Cliente"])) {
    header("location:Ingresar");
} else {
    $user = unserialize($_SESSION['Cliente']);
    if ($user instanceof AdministradorDTO) {
        header("location:Administrador");
    }
}

?>

<div class="position-relative">

    <section class="section section-lg section-shaped p-0 m-0">
        <div class="shape shape-style-1" style="background: black;">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="container">
        <div class="row" id="bienvenida">
            <div class="col-lg-12" id="movie-card-list">
                <div>
                    <div class="movie-card" data-movie="Mujeres">
                        <div class="movie-card__overlay"></div>
                        <div class="movie-card__content">
                            <div class="movie-card__header">
                                <h1 class="movie-card__title">Mujeres</h1>
                                <h4 class="movie-card__info">BoutiqueSW <a href="Perfil" class=""><i class="fas fa-user ml-2"></i>Ir aL Perfil</a></h4>
                            </div>
                            <p class="movie-card__desc">Ropa de mujer con diseños originales hechos por artistas. En muchos estilos y colores. Producción ética. Envío rápido. Diseños con personalidad.</p>
                            <a href="Mujeres" class="boton lineaboton movie-card__button"><i class="fas fa-female mr-2"></i>Ver Catálogo</a>
                        </div>
                    </div>
                    <div class="movie-card" data-movie="Hombres">
                        <div class="movie-card__overlay"></div>
                        <div class="movie-card__content">
                            <div class="movie-card__header">
                                <h1 class="movie-card__title">Hombres</h1>
                                <h4 class="movie-card__info">BoutiqueSW</h4>
                            </div>
                            <p class="movie-card__desc">Ropa de hombre con diseños originales creados por artistas. En muchos estilos y colores. Producción ética. Envío rápido. Diseños con personalidad.</p>
                            <a href="Hombres" class="boton lineaboton movie-card__button"><i class="fas fa-male mr-2"></i>Ver Catálogo</a>
                        </div>
                    </div>
                    <div class="movie-card" data-movie="Niños">
                        <div class="movie-card__overlay"></div>
                        <div class="movie-card__content">
                            <div class="movie-card__header">
                                <h1 class="movie-card__title">Niños</h1>
                                <h4 class="movie-card__info">BoutiqueSW</h4>
                            </div>
                            <p class="movie-card__desc">Ropa para bebés y niños con diseños ideales para los más pequeños. Producción ética. Mezcla de algodón. Tallas: de bebé a 12 años. Envío rápido. Diseños con personalidad.</p>
                            <a href="Chicos" class="boton lineaboton movie-card__button"><i class="fas fa-child mr-2"></i>Ver Catálogo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>

    </section>
</div>