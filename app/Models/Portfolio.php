<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    use HasUuids;

    protected $table = 'portfolios';
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'is_default',
        'currency',
        'total_value',
    ];

    public function assets(): HasMany
    {
        return $this->hasMany(PortfolioAssets::class, 'portfolio_id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(PortfolioHistory::class, 'portfolio_id');
    }
}
