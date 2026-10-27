<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'learning_focus',
        'technologies',
        'icon',
        'image',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    /**
     * Relationship to fields of expertise (Bidang Keahlian)
     */
    public function fields(): HasMany
    {
        return $this->hasMany(DepartmentField::class)->orderBy('order', 'asc');
    }

    /**
     * Relationship to active fields of expertise only
     */
    public function activeFields(): HasMany
    {
        return $this->hasMany(DepartmentField::class)->where('is_active', true)->orderBy('order', 'asc');
    }

    /**
     * Query scope for active departments
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order', 'asc');
    }

    /**
     * Helper to get learning focus as array (split by newline)
     */
    public function getLearningFocusListAttribute(): array
    {
        if (empty($this->learning_focus)) {
            return [];
        }

        return array_values(array_filter(
            array_map('trim', explode("\n", str_replace("\r", "", $this->learning_focus)))
        ));
    }

    /**
     * Helper to get technologies as array (split by comma or newline)
     */
    public function getTechnologyListAttribute(): array
    {
        if (empty($this->technologies)) {
            return [];
        }

        return array_values(array_filter(
            array_map('trim', preg_split('/[\n,]+/', $this->technologies))
        ));
    }

    /**
     * Generate unique slug
     */
    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }
}
