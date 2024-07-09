<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function getPathAttribute($value)
    {
        return asset($this->attributes['path'] . '/' . $this->attributes['name']); // Example: Convert the name to uppercase when retrieved.
    }
}

