<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alumni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'department',
        'contact_number',
        'whatsapp_number',
        'email',
        'year_passed',
        'current_job',
        'company_name',
        'job_time_duration',
        'profile_picture',
        'review',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year_passed' => 'integer',
    ];

    /**
     * Get the profile picture URL.
     *
     * @return string
     */
    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture) {
            return asset('storage/alumni_photos/' . $this->profile_picture);
        }
        return asset('images/default-avatar.png');
    }
}
