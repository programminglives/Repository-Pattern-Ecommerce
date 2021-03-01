<?php

namespace App\Traits;

trait Imageable{


    /**
     * Check if model has an images.
     *
     * @return bool
     */
    public function hasImages()
    {
        return (bool) $this->images()->count();
    }

    /**
     * Return collection of images related to the imageable
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function images()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable')->orderBy('order', 'asc');
    }

    /**
     * Return the image related to the imageable
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->orderBy('order', 'asc');
    }

    /**
     * Save Image
     */
    public function saveImage($image){


    }

    /**
     * Delete Image
     */
    public function deleteImage($image = Null){

    }
}
