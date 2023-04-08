<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['job_id', 'name', 'email', 'phone', 'year'];

    public function job()
    {
        return $this->hasOne(Job::class, 'job_id');
    }
}
