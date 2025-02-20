<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    // リレーション
    public function categoryItem() {
        return $this->hasMany(CategoryItem::class);
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

    // メソッド
    public function categories() {
        $categories = $this->categoryItem->map(function ($item) {
            return $item->category;
        });
        return $categories;
    }
    public function likeCount() {
        return Like::where('item_id', $this->id)->count();
    }
    public function commentCount() {
        return Comment::where('item_id', $this->id)->count();
    }
    public function liked() {
        return Like::where([
            'user_id' => auth()->id(),
            'item_id' => $this->id
        ])->exists();
    }
    public function getComments() {
        return Comment::where('item_id', $this->id)->get();
    }
    public function mine() {
        return $this->user_id === Auth::id();
    }
    public function sold() {
        return SoldItem::where('item_id', $this->id)->exists();
    }
}
