<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    use HasUuids;

    protected $table = 'sectors';
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
    ];

    public function symbols(): HasMany
    {
        return $this->hasMany(Symbol::class, 'sector_id');
    }
}
