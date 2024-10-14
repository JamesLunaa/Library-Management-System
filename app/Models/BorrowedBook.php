<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    use HasFactory;

    protected $table = 'borrowedbooks';
    protected $fillable = ['name', 'libraryId', 'title', 'accNo', 'date', 'status', 
    'remarks', 'form', 'borrowedDate', 'delay', 'duration'];
}