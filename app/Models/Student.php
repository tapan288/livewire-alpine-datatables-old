<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function scopeSearch(Builder $query, $term)
    {
        $term = "%$term%";

        return $query->where('name', 'like', $term)
            ->orWhere('phone_number', 'like', $term)
            ->orWhere('email', 'like', $term)
            ->orWhere('address', 'like', $term)
            ->orWhereHas('class', function ($query) use ($term) {
                $query->where('name', 'like', $term);
            })
            ->orWhereHas('section', function ($query) use ($term) {
                $query->where('name', 'like', $term);
            });
    }
}
