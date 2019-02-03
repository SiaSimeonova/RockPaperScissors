<?php

namespace project\tests\Controller;

use PHPUnit\Framework\TestCase;
use project\Controller\Game;

class GameTest extends TestCase {

    /**
     * Test successful adding of new hand shape value.
     * 
     * @test
     */
    public function testAddNewHandShapeSuccess() {
        $game = new Game();
        $newValue = 'Potato';
        
        $this->assertTrue(!in_array($newValue, $game->getHandShapes()));
        
        $handShapePowers = array(
            'Rock' => 'Scissors',
            'Paper' => 'Rock',
            'Scissors' => 'Potato',
            'Potato' => 'Paper'
        );

        $this->assertTrue($game->addNewHandShape($newValue, $handShapePowers));
        $this->assertTrue(in_array($newValue, $game->getHandShapes()));
        $this->assertEquals($game->getHandShapesPower(), $handShapePowers);
    }

    /**
     * Test successful adding of new hand shape value.
     * 
     * @test
     */
    public function testAddNewHandShapeEmptyValue() {
        $game = new Game();
        $previousHandShapes = $game->getHandShapes();
        $previousHandShapePowers = $game->getHandShapesPower();

        $newValue = '';
        $handShapePowers = array(
            'Rock' => 'Scissors',
            'Paper' => 'Rock',
            'Scissors' => '',
            '' => 'Paper'
        );

        $this->assertFalse($game->addNewHandShape($newValue, $handShapePowers));
        $this->assertEquals($game->getHandShapes(), $previousHandShapes);
        $this->assertEquals($game->getHandShapesPower(), $previousHandShapePowers);
    }

    /**
     * Test successful adding of new hand shape value.
     * 
     * @test
     */
    public function testAddNewHandShapeValueExists() {
        $game = new Game();
        $previousHandShapes = $game->getHandShapes();
        $previousHandShapePowers = $game->getHandShapesPower();

        $newValue = 'Scissors';
        $handShapePowers = array(
            'Rock' => 'Scissors',
            'Paper' => 'Rock',
            'Scissors' => 'Paper'
        );

        $this->assertFalse($game->addNewHandShape($newValue, $handShapePowers));
        $this->assertEquals($game->getHandShapes(), $previousHandShapes);
        $this->assertEquals($game->getHandShapesPower(), $previousHandShapePowers);
    }

    /**
     * Test successful adding of new hand shape value.
     * 
     * @test
     * @dataProvider powerArrayProvider
     */
    public function testAddNewHandShapeErrorPowers(array $handShapePowers) {
        $game = new Game();
        $previousHandShapes = $game->getHandShapes();
        $previousHandShapePowers = $game->getHandShapesPower();

        $newValue = 'Potato';
        $this->assertFalse($game->addNewHandShape($newValue, $handShapePowers));
        $this->assertEquals($game->getHandShapes(), $previousHandShapes);
        $this->assertEquals($game->getHandShapesPower(), $previousHandShapePowers);
    }

    /**
     * Provide data for testing of 'addNewHandShape' method.
     * 
     * @return array Values needed for testAddNewHandShapeErrorPowers method
     */
    public function powerArrayProvider() {
        return array(
            'missing key' =>
            array(array(
                    'Rock' => 'Scissors',
                    'Paper' => 'Rock',
                    'Scissors' => 'Potato')),
            'missing value' =>
            array(array(
                    'Rock' => 'Scissors',
                    'Paper' => 'Rock',
                    'Scissors' => 'Paper',
                    'Potato' => 'Rock'))
        );
    }

    /**
     * Test executing 'playRounds' method with correct and incorrect values.
     * 
     * @test
     * @dataProvider roundsProvider
     * @param mixed $rounds The rounds for the game.
     * @param type $result Expected result from executing  'playRounds' with the given 'rounds' value.
     */
    public function testPlayRounds($rounds, $result) {
        $game = new Game();
        $this->assertEquals($game->playRounds($rounds), $result);
    }

    /**
     * Provide correct and error values for testing of 'playRounds' function.
     * 
     * @return array Values needed for testAddNewHandShapeErrorPowers method
     * 
     */
    public function roundsProvider() {
        return array(
            'correct value' =>
            array(33, true),
            'max value' =>
            array(Game::MAX_ROUNDS, true),
            'string value' =>
            array('r', false),
            'zero value' =>
            array(0, false),
            'above max value' =>
            array((Game::MAX_ROUNDS + 1), false)
        );
    }

}

?>