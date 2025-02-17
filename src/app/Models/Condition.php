<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    protected $fillable = [
        'condition'
    ];
    public static $UNUSED = 1;         //未使用
    public static $HARMLESS = 2;       //無害
    public static $HARMED = 3;         //傷つけられた
    public static $BAD_CONDITION = 4;  //悪い状態
}
