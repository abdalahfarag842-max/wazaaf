<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    protected $table = 'applications';

    protected $fillable = [
        'job_list_id',
        'candidate_id',
        'cover_letter',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_list_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}