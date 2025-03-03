<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition()
    {
        return [
			'Fecha' => $this->faker->name,
			'orden_id' => $this->faker->name,
			'usuario_id' => $this->faker->name,
			'estado' => $this->faker->name,
			'total' => $this->faker->name,
        ];
    }
}
