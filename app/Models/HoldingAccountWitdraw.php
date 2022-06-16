<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoldingAccountWitdraw extends Model
{
    use HasFactory;

   
    protected $table = 'holding_account_witdraws';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public function currency() {
        return $this->belongsTo('App\Models\Currency', 'currency_id')->withDefault();
    }

    // public function method() {
    //     return $this->belongsTo('App\Models\DepositMethod', 'method')->withDefault();
    // }

    public function getRequirementsAttribute($value) {
        return json_decode($value);
    }

}
