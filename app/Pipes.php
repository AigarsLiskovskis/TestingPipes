<?php


namespace App;


class Pipes
{
    //[Top,Right,Bottom,Left]
    private array $grid = [
        [[0, 1, 0, 0], [0, 1, 0, 0], [0, 1, 1, 0], [1, 1, 0, 0]],
        [[0, 0, 1, 1], [1, 1, 0, 1], [0, 1, 0, 0], [0, 0, 0, 1]],
        [[0, 1, 1, 0], [1, 0, 1, 1], [1, 0, 1, 1], [1, 1, 0, 0]],
        [[0, 1, 1, 1], [1, 0, 0, 0], [0, 0, 1, 0], [1, 0, 0, 1]]
    ];

    //0=dry; 1=water
    private array $field = [
        [0, 0, 0, 0],
        [0, 0, 0, 0],
        [0, 0, 1, 0],
        [0, 0, 0, 0]
    ];


    public function rotate(array $array): array
    {
        array_unshift($array, end($array));
        array_pop($array);
        return $array;
    }


    public function selectGridElement(int $x, int $y): array
    {
        return $this->grid[$x][$y];
    }


    public function topConnection(int $x, int $y): bool
    {
        if ($y - 1 > -1) {
            if ($this->grid[$x][$y][0] == 1) {
                if ($this->water($x, $y - 1)) {
                    return true;
                }
            }
        }
        return false;
    }


    public function rightConnection(int $x, int $y): bool
    {
        if ($x + 1 < count($this->grid)) {
            if ($this->grid[$x][$y][1] == 1) {
                if ($this->water($x + 1, $y)) {
                    return true;
                }
            }
        }
        return false;
    }


    public function bottomConnection(int $x, int $y): bool
    {
        if ($y + 1 < count($this->grid)) {
            if ($this->grid[$x][$y][2] == 1) {
                if ($this->water($x, $y + 1)) {
                    return true;
                }
            }
        }
        return false;
    }


    public function leftConnection(int $x, int $y): bool
    {
        if ($x - 1 > -1) {
            if ($this->grid[$x][$y][3] == 1) {
                if ($this->water($x - 1, $y)) {
                    return true;
                }
            }
        }
        return false;
    }


    public function water(int $x, int $y): bool
    {
        if ($this->field[$x][$y] == 1) {
            return true;
        }
        return false;
    }


    public function waterSupply():void
    {
        for ($i = 0; $i < count($this->grid); $i++) {
            for ($j = 0; $j < count($this->grid); $j++) {
                if ($this->topConnection($i, $j)) {
                    $this->field[$i][$j] = 1;
                }
                if ($this->rightConnection($i, $j)) {
                    $this->field[$i][$j] = 1;
                }
                if ($this->bottomConnection($i, $j)) {
                    $this->field[$i][$j] = 1;
                }
                if ($this->leftConnection($i, $j)) {
                    $this->field[$i][$j] = 1;
                }
            }
        };
    }


    public function win(): bool
    {
        for ($i = 0; $i < count($this->grid); $i++){
            $this->waterSupply();
        }

        foreach ($this->field as $line) {
            if (!in_array(0, $line)) {
                return true;
            }
        }
        return false;
    }


    /**
     * @return array|int[][][]
     */
    public function getGrid(): array
    {
        return $this->grid;
    }

    /**
     * @return array|int[][]
     */
    public function getField(): array
    {
        return $this->field;
    }
}

