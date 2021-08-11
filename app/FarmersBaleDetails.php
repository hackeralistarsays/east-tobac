<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmersBaleDetails extends Model
{
    protected $fillable = ['bale_number','bale_name','first_name','last_name','id_number','serial','weight_at_reception','state','creation_date',];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        
        'weight_at_reception' => 'float',
        
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
