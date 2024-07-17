<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'is_approved',
        'link',
        'approval_token',
    ];

    /**
     * @param $token
     * @return Builder|Model
     */
    public static function findStoryByToken($token)
    {
        return self::query()->where('approval_token', $token)->firstOrFail();
    }
}
