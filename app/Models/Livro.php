<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    /**
     * Define a tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'livro';

    /**
     * Define a chave primária do modelo.
     *
     * @var string
     */
    protected $primaryKey = 'LIV_ID';

    /*
    * Indica se os timestamps devem ser gerenciados automaticamente.
    *
    * @var bool
    */
    public $timestamps = true;

    /**
     * Define os atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'LIV_TITULO',
        'LIV_AUTOR',
        'LIV_ANO_PUBLICACAO',
        'LIV_GENERO'
    ];
}
