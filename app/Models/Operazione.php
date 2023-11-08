<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operazione extends Model
{
    use HasFactory;

    protected $table = 'operazioni';      

    protected $fillable = [
        'data_operazione',
        'importo',
        'descrizione',
        'conto_id',
    ];
}
