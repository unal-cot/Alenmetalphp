<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'category',
        'completed_at',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'completed_at' => 'datetime',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }
}
