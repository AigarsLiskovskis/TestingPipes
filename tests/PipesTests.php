<?php


namespace Tests;

use App\Pipes;
use PHPUnit\Framework\TestCase;

class PipesTests extends TestCase
{
    public function testRotate()
    {
        $pipe = new Pipes();

        $this->assertSame(
            [0, 0, 1, 0],
            $pipe->rotate([0, 1, 0, 0])
        );
    }


    public function testSelectField()
    {
        $pipe = new Pipes();

        $this->assertSame(
            [1, 0, 0, 1],
            $pipe->selectGridElement(3, 3)
        );
    }


    public function testRotateSelected()
    {
        $pipe = new Pipes();

        $this->assertSame(
            [1, 1, 0, 0],
            $pipe->rotate($pipe->selectGridElement(3, 3))
        );
    }


    public function testConnectedAtTop()
    {
        $pipe = new Pipes();

        $this->assertTrue($pipe->topConnection(2, 3));
    }


    public function testConnectedAtRight()
    {
        $pipe = new Pipes();

        $this->assertTrue($pipe->rightConnection(1, 2));
    }


    public function testConnectedAtBottom()
    {
        $pipe = new Pipes();

        $this->assertTrue($pipe->bottomConnection(2, 1));
    }


    public function testConnectedAtLeft()
    {
        $pipe = new Pipes();

        $this->assertFalse($pipe->leftConnection(3, 2));
    }


    public function testConnectedToWater()
    {
        $pipe = new Pipes();

        $this->assertTrue($pipe->water(2, 2));
    }


    public function testWin()
    {
        $pipe = new Pipes();

        $this->assertSame(
            true,
            $pipe->win()
        );
    }


    public function testIsWaterAround()
    {
        $pipe = new Pipes();

        $pipe->flowOrNot();
        $pipe->flowOrNot();
        $pipe->flowOrNot();
        $pipe->flowOrNot();

        var_dump($pipe->getField());

        $this->assertSame(
            true,
            $pipe->win()
        );
    }

}
