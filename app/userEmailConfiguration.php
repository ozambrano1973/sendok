<?php
namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
class userEmailConfiguration extends Model
{
    protected $hidden = [
        'driver',
        'host',
        'port',
        'address',
        'encryption',
        'username',
        'password'
    ];
    public function scopeConfiguredEmail($query) {
        $user = Auth::user();
        Log::debug($user->id);
        return $query->where('user_id', $user->id);
    }
}