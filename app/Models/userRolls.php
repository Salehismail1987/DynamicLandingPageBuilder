<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRolls extends Model
{
    use HasFactory;
    protected $connection = 'mysqlDashboard';
    protected $guarded = [
    ];

    public function role_permissions(){
        return  $this->hasMany(rolePermissions::class,'role_id')->with('permission');
    }
}
