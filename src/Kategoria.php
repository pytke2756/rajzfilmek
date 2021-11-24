<?php
namespace Petrik\Rajzfilmek;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model{
    protected $table = "kategoriak";
    public $timestamps = false;
    protected $guarded = ['id'];
}