<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\actionButton;

class customForms extends Model
{
    use HasFactory;
    protected $guarded = [
    ];
    public function actionButtons()
    {
        return $this->hasMany(actionButtons::class, 'custom_form_id', 'id')->where('slug', 'like', 'form_action_btn_%');

    }
}
