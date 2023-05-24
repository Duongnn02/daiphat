<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'cccd_cmnd',
        'before_cccd_cmnd',
        'after_cccd_cmnd',
        'face_cccd_cmnd',
        'academic_level',
        'loan_purpose',
        'house',
        'vehicle',
        'salary',
        'address',
        'relationship_family',
        'full_name_family',
        'phone_family',
        'additional_information',
        'account_name',
        'bank',
        'account_name',
        'number_bank',
        'signature',
        'status_cmnd',
        'status_infor',
        'status_bank',
        'status_signature',
        'status_additional',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    const IS_ADMIN = 1;

    public function messages()
    {
        return $this->HasMany(Message::class, 'from_user', 'id');
    }

    public function loans()
    {
        return $this->HasMany(LoanPackage::class, 'user_id', 'id');
    }
}
