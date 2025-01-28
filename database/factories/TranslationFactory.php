<?php

namespace Database\Factories;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $model = Translation::class;
        static $counter = 1;

        return [
            'key' => $this->faker->unique()->word . $counter++, // Ensures unique keys
            'content' => $this->faker->sentence,
            'locale' => $this->faker->randomElement(['en', 'fr', 'es']),
            'tags' => json_encode($this->faker->words(3)), // Store as JSON string
        ];
    }
}
