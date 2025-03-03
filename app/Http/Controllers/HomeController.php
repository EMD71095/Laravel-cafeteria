<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productos = Producto::all();
        return view('home', compact('productos'));
    }

    public function misPedidos()
    {
        $userId = auth()->id();
        $pedidos = Pedido::where('usuario_id', $userId)->get();
        return view('mis_pedidos', compact('pedidos'));
    }

    public function detallePedido($ordenId)
    {
        $ordenes = Orden::where('no_pedido', $ordenId)->get();
        return view('detalle_pedidos', compact('ordenes'));
    }
}