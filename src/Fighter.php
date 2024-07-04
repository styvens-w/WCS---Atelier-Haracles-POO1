<?php

use Random\RandomException;

class Fighter
{
    const int MAX_LIFE = 100;

    public string $name;
    public int $strength;
    public int $dexterity;
    public int $life;

    public function __construct($name, $strength, $dexterity)
    {
        $this->name = $name;
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->life = self::MAX_LIFE;
    }

    /**
     * @throws RandomException
     */
    public function fight(Fighter $opponent): string
    {
        // Tentative d'esquive
        if ($opponent->dodge()) {
            return "{$opponent->name} esquive l'attaque de {$this->name}!<br>";
        }

        // Calcul des dommages
        $damage = random_int(1, $this->strength);

        // Calcul de la défense de l'opposant
        $defense = $opponent->dexterity;

        // Calcul des dégâts réels
        $actualDamage = max(0, $damage - $defense);

        // Réduction des points de vie de l'opposant
        $opponent->life = max(0, $opponent->life - $actualDamage);

        // Affichage du résultat de l'attaque
        return "{$this->name} 🗡️ {$opponent->name} 💙 {$opponent->name}: {$opponent->life}.<br>";
    }

    public function isAlive(): bool
    {
        return $this->life > 0;
    }

    /**
     * @throws RandomException
     */
    public function heal(): string
    {
        $healPoints = random_int(5, 15);

        if ($this->life + $healPoints <= self::MAX_LIFE) {
            $this->life = min(self::MAX_LIFE, $this->life + $healPoints);
            return "{$this->name} se soigne et récupère {$healPoints} points de vie. Il a maintenant 💙 {$this->life} points de vie.<br>";
        }

        return "";
    }

    /**
     * @throws RandomException
     */
    public function dodge(): bool
    {
        // Probabilité d'esquive basée sur la dextérité
        $dodgeChance = $this->dexterity / 100;
        return random_int(0, 100) / 100 < $dodgeChance;
    }
}