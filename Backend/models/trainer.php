<?php
$servername = "db";
$username = "root";
$password = "root";
$dbname = "pokedex";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM trainer";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="trainer-card">';
        echo '<div class="trainer-name">' . $row["name"] . '</div>';
        echo '<div class="trainer-age">Edad: ' . $row["age"] . '</div>';
        echo '<div class="trainer-region">Región: ' . $row["region"] . '</div>';
        echo '<div class="trainer-pokemon">';

        $trainer_id = $row["id"];
        $pokemon_query = "SELECT p.name
                          FROM pokemon p
                          INNER JOIN trainer_pokemon tp ON p.id = tp.pokemon_id
                          WHERE tp.trainer_id = $trainer_id
                          LIMIT 6";
        $pokemon_result = $conn->query($pokemon_query);
        if ($pokemon_result->num_rows > 0) {
            echo '<div class="pokemon-list">';
            while ($pokemon_row = $pokemon_result->fetch_assoc()) {
                echo '<div class="pokemon">' . $pokemon_row["name"] . '</div>';
            }
            echo '</div>';
        } else {
            echo 'No tiene Pokémon asignados.';
        }
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No se encontraron entrenadores.";
}

$conn->close();
?>