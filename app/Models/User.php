<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravelcm\Subscriptions\Traits\HasPlanSubscriptions;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasPlanSubscriptions, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'language',
        'risk_level',
        'trading_style',
        'country_id',
        'is_notification_enabled',
        'is_price_alerts_enabled',
        'is_new_recommendations_alerts_enabled',
        'is_portfolio_update_alerts_enabled',
        'is_market_sentiment_alerts_enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'is_notification_enabled' => 'boolean',
            'is_price_alerts_enabled' => 'boolean',
            'is_new_recommendations_alerts_enabled' => 'boolean',
            'is_portfolio_update_alerts_enabled' => 'boolean',
            'is_market_sentiment_alerts_enabled' => 'boolean',
        ];
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function portfolio(): HasOne
    {
        return $this->hasOne(Portfolio::class)->where('is_default', true);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function symbolAlerts(): HasMany
    {
        return $this->hasMany(UserSymbolAlert::class);
    }

    public function devices(): HasMany
    {
        return $this->hasMany(UserDevice::class, 'user_id', 'id');
    }

    /**
     * The sectors that belong to the user.
     */
    public function sectors(): BelongsToMany
    {
        return $this->belongsToMany(Sector::class, 'user_sectors');
    }
}
