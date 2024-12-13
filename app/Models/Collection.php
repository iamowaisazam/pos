<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Collection extends Model
{
    protected $table = 'collections';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        'title',
        "slug",
        "details",
        "image_id",
        "sort",
        "is_enable",
        "is_featured",
        "meta_title",
        "meta_description",
        "meta_keywords",
        "created_at",
        "updated_at"
    ];

    public function image()
    {
        return $this->belongsTo(Filemanager::class, 'image_id');
    }
        
}