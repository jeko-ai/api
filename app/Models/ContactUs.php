<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasUuids;

    protected $table = 'contact_us';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'message',
        'created_at',
    ];
}
