<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoldingAccount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'holding_accounts';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public function currency() {
        return $this->belongsTo('App\Models\Currency', 'currency_id')->withDefault();
    }

    public function method() {
        return $this->belongsTo('App\Models\DepositMethod', 'method')->withDefault();
    }

    public function getRequirementsAttribute($value) {
        return json_decode($value);
    }
}