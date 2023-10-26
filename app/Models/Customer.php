<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Customer extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        /** @var Model $model */
        static::updating(function ($model) {
            if ($model->isDirty('customer_image') && ($model->getOriginal('customer_image') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('customer_image'));
            }
        });
    }
}
