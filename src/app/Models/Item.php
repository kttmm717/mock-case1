<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'img_url',
        'user_id',
        'condition_id',
    ];

    public function categoryItem() {
        return $this->hasMany(CategoryItem::class);
    }
    public function categories() {
        $categories = $this->categoryItem->map(function($categoryItem) {
            return $categoryItem->category;
        });
        return $categories;
    }
    public function condition() {
        return $this->belongsTo(Condition::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function likes() {
        return $this->hasMany(Like::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
