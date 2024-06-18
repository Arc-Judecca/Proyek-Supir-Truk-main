<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class nota extends Model
{
    use HasFactory;
    protected $fillable = ['supir_id', 'tanggal', 'nota', 'nota_path'];

    public function supir()
    {
        return $this->belongsTo(Supir::class);
    }

}
