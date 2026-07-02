<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
    protected $fillable = [
    'name',
    'description',
    'email',
    'website',
    'location',
];
    public function jobs()
    {
        
        return $this->hasMany(Job::class);
    }
}
