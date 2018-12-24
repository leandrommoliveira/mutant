<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dna extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'dna';


     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
     public $timestamps = false;

     public $incrementing = false;

     public $keyType = 'string';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'mutant'];
}
