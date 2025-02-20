<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Invitations extends Model
{
    use HasUuids;

    protected $table = 'invitations';
    protected $fillable = [
        'inviter_id',
        'invitee_id',
        'status',
        'created_at',
        'invitee_email',
        'invitee_phone',
        'updated_at',
    ];
}