<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use SoftDeletes;
    protected $table = "queue"; 
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    protected $guarded = [ ]; 
    
     public function PivotQueue()
    {
        return $this->hasMany("App\PivotQueue","queue_id","id");
        //return $this->belongsToMany("Modules\Web\Entities\PlanTemplate","plan_template","plan_id","t_category_id") ;
    }
}
