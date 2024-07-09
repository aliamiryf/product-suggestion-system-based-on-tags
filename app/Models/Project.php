<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function thumbnail()
    {
        return $this->belongsTo(File::class, 'thumbnail_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getAgentsAttribute($value)
    {
        return json_decode($value);
    }
}
