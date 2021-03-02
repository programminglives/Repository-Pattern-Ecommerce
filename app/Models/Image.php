<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = ['name','path','extension','size','order','featured'];

    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getSizeInKbAttribute()
    {
        return $this->size ? round($this->size / 1024, 2) : Null;
    }
}
