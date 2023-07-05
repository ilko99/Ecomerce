<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function division(){
        return $this->belongsTo('App\Models\ShipDivision', 'division_id', 'id');
    }
    public function district(){
        return $this->belongsTo('App\Models\ShipDistrict', 'district_id', 'id');
    }
    public function state(){
        return $this->belongsTo('App\Models\ShipState', 'state_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function order_item(){
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }
}
