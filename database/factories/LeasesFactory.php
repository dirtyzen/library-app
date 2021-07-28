<?php

namespace Database\Factories;

use App\Models\Leases;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class LeasesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Leases::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $randomStatus = Arr::random(Config::get('constants.statuses'));
        $randomCustomer = User::where('role', '=', Config::get('constants.roles.1'))->inRandomOrder()->first();
        $randomProduct = Products::where('amount', '>', 0)->inRandomOrder()->first();

        if ($randomStatus === Config::get('constants.statuses.1')) {
            return [
                'customer_id' => $randomCustomer->id,
                'product_id'  => $randomProduct->id,
                'status'      => $randomStatus
            ];
        }

        $randomEmployee = User::where('role', '=', Config::get('constants.roles.2'))->inRandomOrder()->first();
        $randomDate = Carbon::now()->subDays($this->faker->numberBetween(1, 20));
        $deliveryDate = Carbon::parse($randomDate)->addHour();
        $returnDate = $randomStatus == Config::get('constants.statuses.3') ? Carbon::parse($deliveryDate)->addDays(Config::get('constants.max_lease_day')) : null;

        return [
            'customer_id'   => $randomCustomer->id,
            'product_id'    => $randomProduct->id,
            'employee_id'   => $randomEmployee->id,
            'status'        => $randomStatus,
            'delivery_date' => $deliveryDate,
            'return_date'   => $returnDate,
            'created_at'    => $randomDate,
            'updated_at'    => $randomDate,
        ];

    }
}
