<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['number','grade_id','weight_at_off_loading','farmer_id','balereception_id','lorry_id','state','tdrf_number','creation_date','destination_store_id'];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        
        'weight_at_off_loading' => 'float',
        
    ];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function farmer()
    {
        return $this->belongsTo('App\Models\Farmer','farmer_id','id');
    }

    public function balereception()
    {
        return $this->belongsTo('App\Models\Balereception');
    }

    public function lorry()
    {
        return $this->belongsTo('App\Models\Lorry');
    }

    public function destinationStore()
    {
        return $this->belongsTo('App\Models\Store','destination_store_id');
    }
}


