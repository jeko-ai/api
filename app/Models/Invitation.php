<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invitation extends Model
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

    public function profile(): HasOne
    {
        return $this->hasOne(Profiles::class, 'id', 'invitee_id');
    }
}
