<?php

namespace App\Services;

class SeatGeneratorService
{
    public function generate(string $aircraft): array
    {
        $seats = [];

        switch ($aircraft) {
            case 'ATR':
                $rows = range(1, 18);
                $columns = ['A', 'C', 'D', 'F'];
                break;

            case 'Airbus 320':
            case 'Boeing 737 Max':
                $rows = range(1, 32);
                $columns = ['A', 'B', 'C', 'D', 'E', 'F'];
                break;

            default:
                throw new \InvalidArgumentException('Invalid aircraft type.');
        }

        foreach ($rows as $row) {
            foreach ($columns as $column) {
                $seats[] = $row . $column;
            }
        }

        shuffle($seats);

        return array_slice($seats, 0, 3);
    }
}
