<?php

namespace App\Models;

use App\Filters\V1\Filter;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IpAddress extends Model
{
    use HasFactory;

    /**
     * Fillable attributes
     * @var array
     */
    protected $fillable = [
        'address',
        'label',
        'user_id',
        'comment',
    ];

    /**
     * Casted attributes
     * @var array
     */
    protected $casts = [
        'id'      => 'string',
        'address' => 'string',
        'label'   => 'string',
        'user_id' => 'integer',
        'comment' => 'string',
    ];

    /**
     * Scope to apply filters to the Eloquent query builder
     *
     * @param Builder $builder Eloquent query builder instance
     * @param Filter $filters Filters instance containing the filters to apply
     */
    public function scopeFilter(Builder $builder, Filter $filters): Builder
    {
        return $filters->apply($builder);
    }
}
