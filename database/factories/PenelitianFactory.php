<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penelitian>
 */
class PenelitianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'judul' => fake()->sentence(),
            'tingkatan_tkt' => fake()->randomDigitNotNull(),
            'pendanaan' => fake()->numerify('#####000'),
            'jangka_waktu' => fake()->numerify('## Bulan'),
            'feedback' => fake()->text(),
            'mitra' => fake()->company(),
            'status_penelitian_id' => fake()->randomDigitNotNull(),
            'jenis_penelitian_id' => fake()->randomDigitNotNull(),
            'skema_id' => fake()->randomDigitNotNull(),
            'arsip' => fake()->boolean(),
        ];
    }
}
