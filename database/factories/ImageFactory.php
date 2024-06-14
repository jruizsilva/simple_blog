<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        return [
            // 'url' => 'posts/' . $faker->image('public/storage/posts', 640, 480)
            'url' => $faker->imageUrl(640, 480)
        ];
    }
}
