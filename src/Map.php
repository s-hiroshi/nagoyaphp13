<?php


namespace Ttskch\Nagoyaphp13;


class Map
{
    private $matrix = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];

    private $instruction = [
        'a' => [0, 'normalRotate', false],
        'b' => [1, 'normalRotate', false],
        'c' => [2, 'normalRotate', false],
        'd' => [0, 'reverseRotate', true],
        'e' => [1, 'reverseRotate', true],
        'f' => [2, 'reverseRotate', true],
        'g' => [2, 'reverseRotate', false],
        'h' => [1, 'reverseRotate', false],
        'i' => [0, 'reverseRotate', false],
        'j' => [2, 'normalRotate', true],
        'k' => [1, 'normalRotate', true],
        'l' => [0, 'normalRotate', true],
    ];

    /**
     * @param string $command
     */
    public function rotate(string $command)
    {
        list($index, $callable, $isTranspose) = $this->instruction[$command];

        if ($isTranspose) {
            $this->transpose();
            call_user_func([$this, $callable], $index);
            $this->transpose();
            return;
        }
        call_user_func([$this, $callable], $index);
    }

    /**
     * @param int $index
     */
    public function normalRotate(int $index)
    {
        $element = array_shift($this->matrix[$index]);
        $this->matrix[$index][] = $element;
    }

    /**
     * @param int $index
     */
    public function reverseRotate(int $index)
    {
        $element = array_pop($this->matrix[$index]);
        array_unshift($this->matrix[$index], $element);
    }

    public function transpose()
    {
        for ($i = 0; $i < count($this->matrix); $i++) {
            for ($j = 0; $j < count($this->matrix); $j++) {
                if ($i == 0) {
                    $transposeMatrix[$j] = [];
                }
                $transposeMatrix[$j][$i] = $this->matrix[$i][$j];
            }
        }

        $this->matrix = $transposeMatrix;
    }

    /**
     * @return string
     */
    public function format(): string
    {
        $output = '';
        foreach($this->matrix as $index => $row) {
            $output .= implode('', $row);
            if ($index < count($this->matrix) - 1) {
                $output .= '/';
            }
        }
        return $output;
    }
}