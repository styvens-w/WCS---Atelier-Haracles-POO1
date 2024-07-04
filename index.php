<?php

require 'src/Fighter.php';

// Création des combattants
$heracles = new Fighter("🧔 Héraclès", 20, 6);
$lion = new Fighter("🦁 Lion de Némée", 11, 13);

// Affichage du nom et des points de vie des combattants avant le combat
echo "{$heracles->name} a 💙 {$heracles->life} points de vie.<br>";
echo "{$lion->name} a 💙 {$lion->life} points de vie.<br>";

$round = 1;

// Boucle de combat
while ($heracles->isAlive() && $lion->isAlive()) {
    echo "<br>🕛 Round #{$round}<br>";


    // Héraclès attaque le Lion de Némée
    echo $heracles->fight($lion);

    if (!$lion->isAlive()) {
        echo "<br>💀 {$lion->name} is dead<br>";
        echo "🏆 {$heracles->name} wins (💙 {$heracles->life})<br>";
        break;
    }

    // Héraclès se soigne de temps en temps
    if ($round % 10 === 0) {
        echo $heracles->heal();
    }


    // Le Lion de Némée attaque Héraclès
    echo $lion->fight($heracles);
    if (!$heracles->isAlive()) {
        echo "<br>💀 {$heracles->name} is dead<br>";
        echo "🏆 {$lion->name} wins (💙 {$lion->life})<br>";
        break;
    }

    // Le Lion de Némée se soigne de temps en temps
    if ($round % 10 === 1) {
        echo $lion->heal();
    }

    $round++;
}