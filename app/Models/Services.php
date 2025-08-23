<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //
    public function subServices()
    {
        return $this->hasMany(SubService::class, 'parent_service', 'id');
    }
    use HasFactory;
    protected $fillable = [
        'Service',
        'isVisible'
    ];
}
