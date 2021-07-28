<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $category_id = $this->faker->numberBetween(1, 3);
        $imageTypeList = [
            1 => 'bookcover',
            2 => 'musiccover',
            3 => 'videogamecover'
        ];

        $data = [
            'category_id' => $category_id,
            'owner'       => (($category_id === 3) ? $this->faker->catchPhrase() : $this->faker->name),
            'title'       => $title = $this->faker->realText(50, 1),
            'slug'        => Str::slug($title),
            'image'       => 'https://loremflickr.com/400/400/' . $imageTypeList[$category_id] . '?rand=' . uniqid(),
            'publisher'   => $this->faker->company,
            'amount'      => $this->faker->numberBetween(10, 500)
        ];

        if (in_array($category_id, [1, 3])) {
            $data['backside_text'] = $this->faker->realText(500, 2);
        } elseif ($category_id === 2) {
            $tracks = $this->faker->sentences(rand(3, 10), false);
            $data['track_list'] = implode(PHP_EOL, $tracks);
        }

        return $data;
    }
}
