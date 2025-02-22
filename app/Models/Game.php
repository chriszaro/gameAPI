<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;


/**
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Game extends Model
{
    protected $fillable = [
        'title',
        'description',
        'genre',
        'release_date',
        'user_id'
    ];

    protected $casts = [
        'release_date' => 'date'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
