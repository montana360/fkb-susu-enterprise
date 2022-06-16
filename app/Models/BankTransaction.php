<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bank_transactions';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public function currency() {
        return $this->belongsTo('App\Models\Currency', 'currency_id')->withDefault();
    }

    public function branch() {
        return $this->belongsTo('App\Models\Branch', 'branch_id')->withDefault(['name' => _lang('Default')]);
    }

    public function created_by() {
        return $this->belongsTo('App\Models\User', 'created_user_id')->withDefault();
    }

    public function updated_by() {
        return $this->belongsTo('App\Models\User', 'updated_user_id')->withDefault();
    }


    public function getCreatedAtAttribute($value) {
        $date_format = get_date_format();
        $time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

    public function getTransactionDetailsAttribute($value) {
        return json_decode($value);
    }

}
