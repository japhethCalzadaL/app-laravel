<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cfdi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'japheth_calzada_cfdi';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'rfc_transmitter',
        'rfc_receiver',
        'error',
        'status',
        'created_at'

    ];

}
