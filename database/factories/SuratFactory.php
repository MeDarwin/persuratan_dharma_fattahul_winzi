<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surat>
 */
class SuratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_surat' => fake()->dateTime('now', 'Asia/Jakarta'),
            'ringkasan'=>fake('id_ID')->sentence(),
            'file'=>fake()->filePath()
        ];
    }
}