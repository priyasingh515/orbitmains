<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supports extends Model
{
    use HasFactory;
    protected $table = 'support_teams';
    protected $fillable = [
        'name','post','photos','rank'
    ];
}
