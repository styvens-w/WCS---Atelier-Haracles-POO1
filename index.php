<?php

require 'src/Fighter.php';

// Création des combattants
$heracles = new Fighter("🧔 Héraclès", 20, 6);
$lion = new Fighter("🦁 Lion de Némée", 11, 13);

// Affichage du nom et des points de vie des combattants avant le combat
echo "{$heracles->name} a 💙 {$heracles->life} points de vie.<br>";
echo "{$lion->name} a 💙 {$lion->life} points de vie.<br>";

$round = 1;

function attack($round, $attacker, $defender):bool
{
    echo $attacker->fight($defender);

    if (!$defender->isAlive()) {
        echo "<br>💀 {$defender->name} is dead<br>";
        echo "🏆 {$attacker->name} wins (💙 {$attacker->life})<br>";
        return false;
    }

    if ($round % 10 === 0) {
        echo $attacker->heal();
    }

    return true;
}

// Boucle de combat
while ($heracles->isAlive() && $lion->isAlive()) {
    echo "<br>🕛 Round #{$round}<br>";

    if (!attack($round, $heracles, $lion) || !attack($round, $lion, $heracles)) {
        break;
    }

    $round++;
}