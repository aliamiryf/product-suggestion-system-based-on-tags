<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function thumbnail()
    {
        return $this->belongsTo(File::class, 'thumbnail_id');
    }
}
