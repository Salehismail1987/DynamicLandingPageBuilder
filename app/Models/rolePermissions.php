<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rolePermissions extends Model
{
    use HasFactory;
    protected $connection = 'mysqlDashboard';
    protected $guarded = [
    ];

    public function permission(){
        return  $this->belongsTo(permissions::class,'permission_id');
    }
    public function role(){
        return  $this->belongsTo(userRolls::class,'role_id');
    }
}
