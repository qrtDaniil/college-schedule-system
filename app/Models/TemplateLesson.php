<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateLesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'day',
        'position',
        'week_number',
        'subject_id',
    ];

    protected $attributes = [
        'week_number' => '0',
    ];

    public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subject::class, "subject_id", "id");
    }

    public function lesson(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('day')->orderBy('position')->orderBy('week_number');
    }
}
