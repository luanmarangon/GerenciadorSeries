<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'anexo'];

    public function getAnexoUrlAttribute()
    {
        if ( $this->anexo ) {
//            return 'http://localhost:8000/storage/'.$this->anexo ;
            return Storage::url($this->anexo);
        }
        return Storage::url('serie/sem-img.jpg');

//        return 'http://localhost:8000/storage/serie/sem-img.jpg' ;

    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
