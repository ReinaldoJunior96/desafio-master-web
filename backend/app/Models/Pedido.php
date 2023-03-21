<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','produto','quantidade'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
