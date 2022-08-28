<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'grade',
        'group',
        'index',
        'name',
        'teacher',
        'hours_first_half',
        'hours_second_half',
        'class',
    ];

    protected $attributes = [
        'hours_first_half' => 0,
        'hours_second_half' => 0,
    ];

    public function templateLesson(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TemplateLesson::class);
    }

    public function lesson(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function scopeLike($query, $field, $value)
    {
        return $query->where($field, 'LIKE', "%{$value}%");
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('grade')->orderBy('group')->orderBy('index')->orderBy('name');
    }
}
