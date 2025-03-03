<?php

namespace Database\Factories;

use App\Models\Orden;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrdenFactory extends Factory
{
    protected $model = Orden::class;

    public function definition()
    {
        return [
			'producto_id' => $this->faker->name,
			'cantidad' => $this->faker->name,
			'precio' => $this->faker->name,
			'no_pedido' => $this->faker->name,
        ];
    }
}
