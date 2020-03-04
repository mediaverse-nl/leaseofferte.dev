<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OperationalLeasePrice extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';

    protected $table = 'operational_lease_prices';

    protected $fillable = [];

    public function leaseOffer()
    {
        return $this->belongsTo('App\LeaseOffer','lease_offers_id', 'id');
    }
}
