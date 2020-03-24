<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $table = 'feedbacks';
    public $fillable = [
        'name', 'email', 'subject', 'message'
    ];
}
