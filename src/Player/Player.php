<?php

namespace project\Player;

/**
 * Represent game player.
 *
 * @author Sia Simeonova
 */
class Player {

    /**
     * @var int The count of the victories of the player
     */
    private $victories = 0;

    /**
     * @var string The chosen value for hand shape. 
     */
    private $handShape;

    /**
     * Setter for $handShape property.
     * 
     * @return int The value of $handShape property of the object.
     */
    public function choseHandShape(array $variants) {
        $randomIndex = rand(0, count($variants) - 1);
        $this->handShape = $variants[$randomIndex];
    }

    /**
     * Getter for $handShape property.
     * 
     * @return int The value of $handShape property of the object.
     */
    public function getHandShape() {
        return $this->handShape;
    }

    /**
     * Increase the value of the  $victories property with one.
     */
    public function addVictory() {
        $this->victories = $this->victories + 1;
    }

    /**
     * Getter for $victories property.
     * 
     * @return int The value of $victories property of the object.
     */
    public function getVictories() {
        return $this->victories;
    }

}
