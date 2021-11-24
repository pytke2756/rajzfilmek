<?php

namespace Petrik\Rajzfilmek;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Rajzfilm extends Model{
    protected $table = "rajzfilmek"; //ha angol lenne a db akkor nem lenne erre szükség
    public $timestamps = false;
    //protected $fillable = ['cim', 'hossz', 'kiadasi_ev'];
    protected $guarded = ['id'];
}