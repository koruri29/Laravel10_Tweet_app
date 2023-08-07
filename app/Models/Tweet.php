<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'tweet' => 'required|max:140',
    );

    public static $errorMsg = array(
        'tweet.required' => 'つぶやきを入力してください。',
        'tweet.max' => 'つぶやきは140字以内で入力してください。'
    );

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function getUserName()
    {
        return $this->user->name;
    }
}
