<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => substr($this->faker->sentence(), 50),
            'description' => $this->faker->text(),
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attribute) {
            return ['status' => true];
        });
    }

    public function unCompleted()
    {
        return $this->state(function (array $attribute) {
            return ['status' => false];
        });
    }

    public function tomorrow()
    {
        return $this->state(function (array $attribute) {
            return ['due_date' => now()->addDay()];
        });
    }

    public function priority($level = 1)
    {
//        return $this->state(function (array $attribute) use ($level){
//            return ['priority'=>$level];
//        });

        return $this->state(
            fn(array $attribute) => [
                'priority' => $level
            ]
        );
    }
}
