<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsCategory>
 */
class NewsCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->fake->name(),
            'description' => $this->fake->sentence(),
            'parent_id' => $this->fake()->uuid(),
            'slug' => $this->fake->slug(2),
            'created_at' => $this->fake->date(),
            'created_by' => $this->fake->uuid(),
        ];
    }
}
