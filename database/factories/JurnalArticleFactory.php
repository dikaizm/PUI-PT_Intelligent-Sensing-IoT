<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JurnalArticle>
 */
class JurnalArticleFactory extends Factory
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
            'pendanaan' => fake()->numerify('##000000'),
            'jangka_waktu' => fake()->numerify('## Bulan'),
            'poster' => fake()->image(
                'C:\xamppp\htdocs\laravel\PUI-PT_Intelligent-Sensing-IoT\storage\app\public\temp',
                100,
                100
            ),
            'feedback' => fake()->text(),
            'status_laporan_id' => fake()->randomDigitNotNull(),
            'jenis_penelitian_id' => fake()->randomDigitNotNull(),
            'mitra_id' => fake()->randomDigitNotNull(),
            'jenis_output_id' => fake()->randomDigitNotNull(),
            'arsip' => fake()->boolean(),
        ];
    }
}
