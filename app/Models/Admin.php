<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name', 'email','photo', 'password', 'created_at', 'updated_at',
    ];
}
