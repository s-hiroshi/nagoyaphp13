<?php

namespace Ttskch\Nagoyaphp13;

class Nagoyaphp13
{
    public function run(string $input): string
    {
        $map = new Map();
        $commands = str_split($input);
        foreach ($commands as $command) {
            $map->rotate($command);
        }
        return $map->format();

    }
}
