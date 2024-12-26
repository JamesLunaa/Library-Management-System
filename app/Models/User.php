<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'libraryId',
        'pass',
        'accLevel',
        'accStatus',
    ];

    // Tell Laravel to use 'pass' as the password field
    public function getAuthPassword()
    {
        return $this->pass;
    }
}