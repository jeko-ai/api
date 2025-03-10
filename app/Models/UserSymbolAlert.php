<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserSymbolAlert extends Model
{
    use HasUuids;

    protected $table = 'user_symbol_alerts';
}
