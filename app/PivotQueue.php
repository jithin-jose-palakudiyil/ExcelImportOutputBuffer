<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotQueue extends Model
{
    use SoftDeletes;
    protected $table = "pivot_queue"; 
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    protected $guarded = [ ]; 
}
