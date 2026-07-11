<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id',
        'title',
        'description',
        'price',
        'currency',
        'stock',
        'production_method',
        'svlk_certificate_number',
        'svlk_issue_date',
        'model_3d_path',
        'images'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'svlk_issue_date' => 'date',
        'images' => 'array',
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
