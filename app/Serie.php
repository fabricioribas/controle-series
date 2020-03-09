<?php

namespace App;
// -----------------------------------------------------------------------------
use Illuminate\Database\Eloquent\Model;
// -----------------------------------------------------------------------------

class Serie extends Model
{
    public $timestamps = false;
    // Toda propriedade que quisermos passar pelo CREATE (Controller) é necessário informar dentro do Atributo fillable(preenchivél).
    // Assim informamos quais Atributos permitimos serem enviados dessa forma.
    protected $fillable = ['nome'];

    public function temporadas()
    {
        // Existe uma relação em que uma Série($this), tem muitas (hasMany), Temporadas(Temporadas::class)
        return $this->hasMany(Temporada::class);
    }
}