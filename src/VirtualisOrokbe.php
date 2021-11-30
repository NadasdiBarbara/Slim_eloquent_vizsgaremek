<?php

namespace Petrik\Vizsgaremek;

use Exception;
use Illuminate\Database\Eloquent\Model;

class VirtualisOrokbe extends Model{
    protected $table = "virtualis_orokbefogadas";
    public $timestamps = false;
    protected $guarded = ['id'];
}