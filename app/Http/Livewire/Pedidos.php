<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pedido;
use App\Models\User;

class Pedidos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Fecha, $orden_id, $usuario_id, $estado, $total;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.pedido.view', [
            'pedidos' => Pedido::latest()
						->orWhere('Fecha', 'LIKE', $keyWord)
						->orWhere('orden_id', 'LIKE', $keyWord)
						->orWhere('usuario_id', 'LIKE', $keyWord)
						->orWhere('estado', 'LIKE', $keyWord)
						->orWhere('total', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->Fecha = null;
		$this->orden_id = null;
		$this->usuario_id = null;
		$this->estado = null;
		$this->total = null;
    }

    public function store()
    {
        $this->validate([
		'Fecha' => 'required',
		'orden_id' => 'required',
		'usuario_id' => 'required',
		'estado' => 'required',
		'total' => 'required',
        ]);

        Pedido::create([ 
			'Fecha' => $this-> Fecha,
			'orden_id' => $this-> orden_id,
			'usuario_id' => $this-> usuario_id,
			'estado' => $this-> estado,
			'total' => $this-> total
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Pedido Successfully created.');
    }

    public function edit($id)
    {
        $record = Pedido::findOrFail($id);
        $this->selected_id = $id; 
		$this->Fecha = $record-> Fecha;
		$this->orden_id = $record-> orden_id;
		$this->usuario_id = $record-> usuario_id;
		$this->estado = $record-> estado;
		$this->total = $record-> total;
    }

    public function update()
    {
        $this->validate([
		'Fecha' => 'required',
		'orden_id' => 'required',
		'usuario_id' => 'required',
		'estado' => 'required',
		'total' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Pedido::find($this->selected_id);
            $record->update([ 
			'Fecha' => $this-> Fecha,
			'orden_id' => $this-> orden_id,
			'usuario_id' => $this-> usuario_id,
			'estado' => $this-> estado,
			'total' => $this-> total
            ]);

            if ($this->estado === 'Completado') {
                $user = User::find($this->usuario_id);
                $user->notify(new \App\Notifications\PedidoCompletado($record));
            }

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Pedido Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Pedido::where('id', $id)->delete();
        }
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }


}