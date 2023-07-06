<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,HasApiTokens, Notifiable;
    protected $guarded = [];
    const IS_ADMIN = 1;
    const IS_USER = 0;

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
        'role_id',
        'bank',
        'account_name',
        'number_bank',
        'signature',
        'status_cmnd',
        'status_infor',
        'status_bank',
        'status_signature',
        'status_additional',
        'relationship_other',
        'full_name_other',
        'phone_other',
        'permanent_address',
        'day_of_birthday'
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

    public function DayOfBirthday(): Attribute {
        return new Attribute(
            set: fn ($value) =>  Carbon::parse($value)->format('Y-m-d'),
        );
    }

    const RELATIONSHIP = [
        1 => 'Bố Mẹ',
        2 => 'Vợ Chồng',
        3 => 'Đồng nghiệp',
        4 => 'Anh chị',
        5 => 'Bạn'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'from_user', 'id');
    }
    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'from_user', 'id')->latest();
    }

    public function loans()
    {
        return $this->hasMany(LoanPackage::class, 'user_id', 'id');
    }


    public static function  getInput($model)
    {
        return $model->fillable;
    }
}
