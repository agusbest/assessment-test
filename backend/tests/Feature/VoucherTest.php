<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VoucherTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_check_voucher_not_exists(): void
    {
        $response = $this->postJson('/api/check', [
            'flightNumber' => 'GA101',
            'date' => '2026-07-18',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'exists' => false,
            ]);
    }

    public function test_can_generate_voucher(): void
    {
        $response = $this->postJson('/api/generate', [
            'name' => 'Agus',
            'id' => '12345',
            'flightNumber' => 'GA101',
            'date' => '2026-07-18',
            'aircraft' => 'ATR',
        ]);

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'success',
                    'crew' => [
                        'name',
                        'id',
                    ],
                    'flight' => [
                        'number',
                        'date',
                        'aircraft',
                    ],
                    'seats',
                ],
            ]);

        $this->assertDatabaseHas('vouchers', [
            'flight_number' => 'GA101',
            'flight_date'   => '2026-07-18',
        ]);
    }

    public function test_duplicate_voucher_returns_409(): void
    {
        Voucher::create([
            'crew_name'      => 'Agus',
            'crew_id'        => '12345',
            'flight_number'  => 'GA101',
            'flight_date'    => '2026-07-18',
            'aircraft_type'  => 'ATR',
            'seat1'          => '1A',
            'seat2'          => '2A',
            'seat3'          => '3A',
        ]);

        $response = $this->postJson('/api/generate', [
            'name' => 'Agus',
            'id' => '12345',
            'flightNumber' => 'GA101',
            'date' => '2026-07-18',
            'aircraft' => 'ATR',
        ]);

        $response
            ->assertConflict();
    }
}
