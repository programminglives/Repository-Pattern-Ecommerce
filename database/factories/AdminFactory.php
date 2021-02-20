<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => 'test@admin.com',//$faker->unique()->safeEmail
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'), // password
        ];
    }
}
