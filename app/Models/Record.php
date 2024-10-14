<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = 'records';
    protected $fillable = [
        'name', 
        'libraryId', 
        'title', 
        'date', 
        'accNo', 
        'borrowedDate',  
        'return_date', 
        'remarks', 
        'status'
    ];
}