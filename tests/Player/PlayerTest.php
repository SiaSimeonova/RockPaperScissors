<?php

namespace project\tests\Player;

use PHPUnit\Framework\TestCase;
use project\Player\Player;

/**
 * Description of PlayerTest
 *
 * @author sia
 */
class PlayerTest extends TestCase {

    /**
     * Test method increase victories property with one.
     * 
     * @test
     */
    public function testAddVictoruies() {
        $player = new Player();
        $victoriesBeforeAdd = $player->getVictories();

        $player->addVictory();
        $this->assertTrue(($victoriesBeforeAdd + 1) === $player->getVictories());
    }

    /**
     * Test method return false if an empty array is given.
     * 
     * @test
     */
    public function testchoseHandShapeError() {
        $player = new Player();
        $handShapes = array();

        $settingHandShapeResult = $player->choseHandShape($handShapes);
        $this->assertFalse($settingHandShapeResult);
        $this->assertTrue(empty($player->getHandShape()));
    }

    /**
     * Test method set correct value to the handShape property.
     * 
     * @test
     */
    public function testChoseHandShapeSuccess() {
        $player = new Player();
        $handShapes = array('value1', 'value2', 'value3');
        $settingHandShapeResult = $player->choseHandShape($handShapes);
        $this->assertTrue($settingHandShapeResult);
        $this->assertTrue(in_array($player->getHandShape(), $handShapes));
    }

}
