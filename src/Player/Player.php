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
     * Set get random value from the given array and set it to handShape property.
     * 
     * @param array $variants Collection with available values for chose.
     * @return boolean The result of the method execution. False if no values are given.
     */
    public function choseHandShape(array $variants) {
        if (empty($variants)) {
            echo 'No values for chosing available.' . PHP_EOL;
            return false;
        }

        $randomIndex = rand(0, count($variants) - 1);
        $this->handShape = $variants[$randomIndex];

        return true;
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
