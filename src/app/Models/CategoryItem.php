<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $primaryKey = ['item_id', 'user_id'];

    public $incrementing = false;

    protected $fillable = [
        'item_id',
        'caategory_id'
    ];

    public function categories() {
        return $this->belongsTo(Category::class);
    }
    public function items() {
        return $this->belongsTo(Item::class);
    }
}
