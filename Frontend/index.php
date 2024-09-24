<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poetsen+One&display=swap" rel="stylesheet">
</head>

<body>
    <h1>Pokédex</h1>
    <div class="navigation">

        <form id="searchForm" action="" method="GET">
            <div>
                <a class="tex" href="?content=pokemon">Pokémon</a>
                <a class="tex" href="?content=trainers">Entrenadores</a>
            </div>
            <input  type="hidden" name="content" value="pokemon">
            <input class="tex2" type="text" name="search" placeholder="Buscar por nombre...">
            <select id="orderBySelect" class="tex2" name="order_by">
                <option class="tex2" value="id_asc">Número inferior</option>
                <option class="tex2" value="id_desc">Número superior</option>
                <option class="tex2" value="name_asc">Nombre A-Z</option>
                <option class="tex2" value="name_desc">Nombre Z-A</option>
            </select>

            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="pokedex">
        <?php
        if (isset($_GET['content'])) {
            $content = $_GET['content'];
            if ($content === 'pokemon') {
                include 'models/pokemon.php';
            } elseif ($content === 'trainers') {
                include 'models/trainer.php';
            } else {
                echo 'Contenido no válido';
            }
        } else {
            include 'models/pokemon.php';
        }
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll(".pokemon-image img");

            const options = {
                root: null,
                rootMargin: "0px",
                threshold: 0.1
            };

            const observer = new IntersectionObserver(function (entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.dataset.src;
                        img.src = src;
                        observer.unobserve(img);
                    }
                });
            }, options);

            images.forEach(image => {
                observer.observe(image);
            });

            const orderBySelect = document.getElementById('orderBySelect');
            const searchForm = document.getElementById('searchForm');

            orderBySelect.addEventListener('change', function() {

                searchForm.submit();
            });
        });
    </script>
</body>

</html>