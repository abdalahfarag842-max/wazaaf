<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_lists';

    protected $fillable = [
        'company_id',
        'category_id',
        'title',
        'description',
        'salary',
        'location',
        'job_type',
        'status',
        'deadline',
        'created_by',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_list_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}