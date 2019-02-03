<?php

namespace project\Controller;

//require '../../vendor/autoload.php';

use project\Player\Player;

/**
 * "Rock, Paper, Scissors" game simulation with two players.
 *
 * @author Sia Simeonova
 */
class Game {

    const MAX_ROUNDS = 1000;

    /**
     * @var Player One of two players in the game. 
     */
    private $player1;

    /**
     * @var The second game player. 
     */
    private $player2;

    /**
     * @var int How many rounds will be played. 
     */
    private $rounds = 1;

    /**
     * @var array The available hand shapes, that could be chosen in the game.
     */
    private $handShapes = array(
        'Rock',
        'Paper',
        'Scissors'
    );

    /**
     * @var array The powers of each of the available hand shapes.
     * 'key' is the winner, 'value' is the loser.
     */
    private $handShapesPower = array(
        'Rock' => 'Scissors',
        'Paper' => 'Rock',
        'Scissors' => 'Paper'
    );

    public function __construct() {
        $this->player1 = new Player();
        $this->player2 = new Player();
    }

    public function getHandShapes() {
        return $this->handShapes;
    }

    public function getHandShapesPower() {
        return $this->handShapesPower;
    }

    /**
     * Setter for $rounds property.
     * 
     * @param int $rounds The count of the game rounds that will be played.
     * @return boolean The result of the method execution.
     */
    public function playRounds($rounds) {
        if ((!is_int($rounds)) || ($rounds < 1) || ($rounds > static::MAX_ROUNDS)) {
            echo 'Invalid round number. Please select number between 1 and ' . static::MAX_ROUNDS . '.' . PHP_EOL;
            return false;
        }

        $this->rounds = $rounds;
        return true;
    }

    /**
     * Simulate playing of game.
     */
    public function play() {
        echo 'The game stars.' . PHP_EOL;
        for ($round = 1; $round <= $this->rounds; $round ++) {
            echo 'Round: ' . $round . PHP_EOL;
            $this->playRound();
        }

        // 'sleep()' calls are used for 'real' game playing experiance when start the game in the console.
        sleep(1);
        echo $this->rounds . ' rounds has/ve been played.' . PHP_EOL;
        $this->winner();
    }

    /**
     * Simulate a game round playing.
     * In a round hand shape for both game players are chosen and is announced the round winner.
     */
    private function playRound() {
        $roundWinner = null;
        do {
            $this->player1->choseHandShape($this->handShapes);
            $this->player2->choseHandShape($this->handShapes);
            $roundWinner = $this->roundWinner();
        } while (empty($roundWinner));

        $roundWinner->addVictory();

        echo PHP_EOL;
    }

    /**
     * Compare round wins of each of the players and announce who is the winner of the game.
     */
    private function winner() {
        $player1Victories = $this->player1->getVictories();
        $player2Victories = $this->player2->getVictories();
        echo 'Player1 wins ' . $player1Victories . ' rounds.' . PHP_EOL;
        echo 'Player2 wins ' . $player2Victories . ' rounds.' . PHP_EOL;

        if ($player1Victories === $player2Victories) {
            echo 'The game ends with a tie.' . PHP_EOL;
        } else {
            $gameWinner = ($player1Victories > $player2Victories) ? 'Player1' : 'Player2';
            echo 'Game winner is ' . $gameWinner . '!' . PHP_EOL;
        }
    }

    /**
     * Check which of the players shape has power over the other and set player victories.
     * 
     * @return Player The winner of the round or null or there is no winner.
     */
    private function roundWinner() {
        $roundShapesMessage = '(' . $this->player1->getHandShape() . ' vs ' . $this->player2->getHandShape() . ') ';

        $roundWinner = null;
        if ($this->handShapesPower[$this->player1->getHandShape()] === $this->player2->getHandShape()) {
            echo 'Round winner is Player1. ' . $roundShapesMessage . PHP_EOL;
            return $this->player1;
        } else if ($this->handShapesPower[$this->player2->getHandShape()] === $this->player1->getHandShape()) {
            echo 'Round winner is Player2. ' . $roundShapesMessage . PHP_EOL;
            return $this->player2;
        } else {
            return null;
        }
    }

    /**
     * Add hand shape value and update handShapePower array with values for all hand shapes.
     * 
     * @param string $shapeValue The new hand shape value for adding.
     * @param array $handShapePowers Array with tho hand shapes key is the winner, value is the loser.
     */
    public function addNewHandShape($shapeValue, array $handShapePowers) {
        if (empty($shapeValue)) {
            echo 'Invalid value';
            return false;
        } else if (in_array($shapeValue, $this->handShapes)) {
            echo 'Value is already set in the collection.';
            return false;
        }

        $newHandShapeSet = $this->handShapes;
        $newHandShapeSet[] = $shapeValue;
        foreach ($newHandShapeSet as $value) {
            if (!isset($handShapePowers[$value]) || !in_array($value, $handShapePowers)) {
                echo 'Each hand shape power should be included twice - once as a key, and once as a value.' . PHP_EOL;
                return false;
            }
        }

        $this->handShapes = $newHandShapeSet;
        $this->handShapesPower = $handShapePowers;
        return true;
    }

}
