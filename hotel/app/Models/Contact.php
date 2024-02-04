<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];

    const SORT = [
        'default' => 'Default',
        'created_at_asc' => 'Date old - new',
        'created_at_desc' => 'Date new - old',
    ];
}
