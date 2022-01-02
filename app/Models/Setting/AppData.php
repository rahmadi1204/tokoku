<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppData extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
    ];
}
