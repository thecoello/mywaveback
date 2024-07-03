<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model  {

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

    protected $table = 'users';

     /**
     * The model's default values for attributes.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'companyname',
        'name',
        'country',
        'region',
        'email',
        'password',
        'usertype'
    ];


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
