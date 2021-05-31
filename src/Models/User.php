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
        return Http::withHeaders(['Key' => config('inbrain.auth_key')])->get(config('inbrain.auth_server') . '/v1/users/' . $this->id)->json();
    }
}
