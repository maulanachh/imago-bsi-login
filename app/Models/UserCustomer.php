<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class UserCustomer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user_customers';
    protected $primaryKey = 'ucustomer_id';
    protected $connection = 'mysql';
    protected $fillable = [
        'customer_id',
        'email',
        'google_id',
        'user_name',
        'password',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
