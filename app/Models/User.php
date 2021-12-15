<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function twodnumbers()
    {
        return $this->belongsToMany(Twodnumber::class)
            ->withPivot(
                "id",
                "amount",
                "draw",
                "odds",
                "bet_date",
                "voucher_id",
                "created_at",
                "isBingo"
            )
            ->orderBy("pivot_created_at", "desc")
            ->withTimestamps();
    }

    public function threednumbers()
    {
        return $this->belongsToMany(Threednumber::class)
            ->withPivot(
                "id",
                "amount",
                "odds",
                "bet_date",
                "draw_date",
                "voucher_id",
                "created_at",
                "isBingo"
            )
            ->orderBy("pivot_created_at", "desc")
            ->withTimestamps();
    }

    public function unitinouts()
    {
        return $this->hasMany(Unitinout::class)->orderBy("created_at", "desc");
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
