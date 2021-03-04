<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

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
     * Save array of Images
     * @param array $images
     * @param null $path
     * @return mixed
     */
    public function saveImages(array $images, $path = null){
        foreach($images as $image) {
            $this->saveImage($image, $path);
        }
    }

    public function saveImage($image, $path){
        $path = $image->store('images/'.$path,'public');
        return $this->image()->create([
            'path' => $path,
            'name' => $image->getClientOriginalName(),
            'extension' => $image->getClientOriginalExtension(),
            'size' => $image->getSize(),
        ]);
    }

    /**
     * Delete Image
     * @param Image $image
     * @param $path
     */
    public function deleteImage(Image $image, $path){

    }

    /**
     * @param $images
     * @return array
     */
    public function getPreviewData($images){
        $preview = [];
        $previewConfig = [];
        foreach ($images as $image){
            array_push($preview,Storage::disk('public')->url($image->path));
            array_push($previewConfig,[
                'caption' => $image->name,
                'key' => $image->id
            ]);
        }
        return [
            'preview' => $preview,
            'previewConfig' => $previewConfig
        ];
    }
}
