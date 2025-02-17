<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'item_id'];

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'item_id'
    ];
    public function items() {
        return $this->belongsTo(Item::class);
    }
    public function users() {
        return $this->belongsTo(User::class);
    }
}
