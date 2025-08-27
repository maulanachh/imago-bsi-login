<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class feature extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'features';
    protected $primaryKey = 'feature_id';
    protected $connecntion = 'mysql';
    protected $fillable = [
        'feature_code',
        'feature_name',
        'is_parent',
        'feature_route_link',
        'feature_icon',
        'feature_parent_id',
        'feature_feature_location_id',
        'level',
        'is_active',
        'feature_side_bar_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
