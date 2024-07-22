<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SubscriptionModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'subscriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'eventos_id',
        'checkin',
        'active',
    ];

    public function events()
    {
        return $this->belongsTo(EventsModel::class, 'eventos_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
