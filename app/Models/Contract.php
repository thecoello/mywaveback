<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model  {

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

     /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'contracts';

     /**
     * The model's default values for attributes.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'customername',
        'country',
        'saletype',
        'file',
        'points',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

}
