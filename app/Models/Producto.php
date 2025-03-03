<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'producto';

    protected $fillable = ['Nombre','Desc','Precio','image'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordens()
    {
        return $this->hasMany('App\Models\Orden', 'producto_id', 'id');
    }
    
}
