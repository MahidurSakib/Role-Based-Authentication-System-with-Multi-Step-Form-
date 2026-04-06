<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // Step 1 – Personal Info
        'first_name',
        'last_name',
        'phone',
        'date_of_birth',
        'gender',
        // Step 2 – Address & Professional Info
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'occupation',
        'company',
        'experience',
        'skills',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
