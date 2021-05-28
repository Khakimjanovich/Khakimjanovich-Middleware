<?php

namespace INBRAIN\OMP\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Http;

class User extends Authenticatable
{
    protected $guarded = [];

    protected $appends = [
        'credentials'
    ];

    public function getCredentialsAttribute(): array
    {
        return Http::withHeaders(['Authorization' => 'Bearer ' . request()->bearerToken()])->get(config('inbrain.auth_server') . '/v1/me')->json();
    }
}
