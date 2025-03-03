<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;

class Productos extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Nombre, $Desc, $Precio, $imageForAdd, $imageForEdit;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.producto.view', [
            'productos' => Producto::latest()
                        ->orWhere('Nombre', 'LIKE', $keyWord)
                        ->orWhere('Desc', 'LIKE', $keyWord)
                        ->orWhere('Precio', 'LIKE', $keyWord)
                        ->orWhere('image', 'LIKE', $keyWord)
                        ->paginate(10),
        ]);
    }
    
    public function cancel()
    {
        $this->resetInput();
    }
    
    private function resetInput()
    {       
        $this->Nombre = null;
        $this->Desc = null;
        $this->Precio = null;
        $this->imageForAdd = null;
        $this->imageForEdit = null;
    }

    public function store()
    {
        $this->validate([
            'Nombre' => 'required',
            'Desc' => 'required',
            'Precio' => 'required',
            'imageForAdd' => 'required|image|max:1024',
        ]);

        $customName = 'productos/'.uniqid().'.'.$this->imageForAdd->extension();
        $this->imageForAdd->storeAs('public', $customName);

        Producto::create([ 
            'Nombre' => $this->Nombre,
            'Desc' => $this->Desc,
            'Precio' => $this->Precio,
            'image' => $customName
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Producto creado con éxito.');
    }

    public function edit($id)
    {
        $record = Producto::findOrFail($id);
        $this->selected_id = $id; 
        $this->Nombre = $record->Nombre;
        $this->Desc = $record->Desc;
        $this->Precio = $record->Precio;
        $this->imageForEdit = $record->image;
    }

    public function update()
    {
        $this->validate([
            'Nombre' => 'required',
            'Desc' => 'required',
            'Precio' => 'required',
            'imageForEdit' => 'nullable|image|max:1024',
        ]);

        if ($this->selected_id) {
            $record = Producto::find($this->selected_id);
            $customName = $this->imageForEdit ? 'productos/'.uniqid().'.'.$this->imageForEdit->extension() : $record->image;

            if ($this->imageForEdit) {
                $this->imageForEdit->storeAs('public', $customName);
            }

            $record->update([
                'Nombre' => $this->Nombre,
                'Desc' => $this->Desc,
                'Precio' => $this->Precio,
                'image' => $customName
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Producto actualizado con éxito.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Producto::where('id', $id)->delete();
        }
    }

    public function report()
    {
        $productos = Producto::all();
        $pdf = Pdf::loadView('livewire.producto.report', compact('productos'));
        return $pdf->stream('productos_report.pdf');
    }
}
