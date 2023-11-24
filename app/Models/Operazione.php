<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operazione extends Model
{
    use HasFactory;

    protected $table = 'operazioni';      

    protected $fillable = [
        'data_operazione',
        'importo',
        'descrizione',
        'conto_id',
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class, 'rel_operazioni_tags');
    }

    public function conto() {
        return $this->belongsTo(Conto::class, 'conto_id');
    }
}
