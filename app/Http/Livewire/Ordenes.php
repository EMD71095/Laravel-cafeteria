<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Orden;
use App\Models\Pedido;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Producto;

class Ordenes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $producto_id, $cantidad, $precio, $no_pedido;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.orden.view', [
            'ordens' => Orden::latest()
                ->orWhere('producto_id', 'LIKE', $keyWord)
                ->orWhere('cantidad', 'LIKE', $keyWord)
                ->orWhere('precio', 'LIKE', $keyWord)
                ->orWhere('no_pedido', 'LIKE', $keyWord)
                ->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->producto_id = null;
        $this->cantidad = null;
        $this->precio = null;
        $this->no_pedido = null;
    }

    public function store()
    {
        $this->validate([
            'producto_id' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'no_pedido' => 'required',
        ]);

        Orden::create([
            'producto_id' => $this->producto_id,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'no_pedido' => $this->no_pedido
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Orden Successfully created.');
    }

    public function edit($id)
    {
        $record = Orden::findOrFail($id);
        $this->selected_id = $id;
        $this->producto_id = $record->producto_id;
        $this->cantidad = $record->cantidad;
        $this->precio = $record->precio;
        $this->no_pedido = $record->no_pedido;
    }

    public function update()
    {
        $this->validate([
            'producto_id' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'no_pedido' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Orden::find($this->selected_id);
            $record->update([
                'producto_id' => $this->producto_id,
                'cantidad' => $this->cantidad,
                'precio' => $this->precio,
                'no_pedido' => $this->no_pedido
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Orden Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Orden::where('id', $id)->delete();
        }
    }









    public function add(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        if (empty($producto))
            return redirect('/');

        Cart::add(
            $producto->id,
            $producto->Nombre,
            1,
            $producto->Precio,
            ['image' => $producto->image]
        );

        return redirect()->back()->with("success", "Producto agredado: " . $producto->Nombre);
    }


    public function checkout()
    {
        return view('cart.checkout');
    }

    public function removeItem(Request $request)
    {
        Cart::remove($request->rowId);
        return redirect()->back()->with("success", "Producto eliminado");
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->back()->with("success", "Carrito vacio");
    }


    public function pedir()
    {
        $usuario_id = auth()->id();
        $cartItems = Cart::content();

        // Verifica si hay productos en el carrito
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with("error", "El carrito está vacío.");
        }

        $no_pedido = Pedido::count() + 1;

        $t = 0;
        foreach ($cartItems as $item) {
            $orden = Orden::create([
                'producto_id' => $item->id,
                'cantidad' => $item->qty,
                'precio' => $item->price,
                'no_pedido' => $no_pedido
            ]);
            $t = $t + ($item->qty * $item->price);
        }

        // Crea el nuevo registro en la tabla Pedido usando el ID de la primera orden
        $pedido = Pedido::create([
            'Fecha' => now(),
            'no_pedido' => $no_pedido,
            'usuario_id' => $usuario_id,
            'estado' => 'Pendiente',
            'orden_id' => $no_pedido,
            'total' => $t + 15
        ]);

        // Limpia el carrito después de guardar las órdenes
        Cart::destroy();

        // Redirige con un mensaje de éxito
        return redirect('/')->with("success", "Pedido realizado con éxito.");
    }
}
