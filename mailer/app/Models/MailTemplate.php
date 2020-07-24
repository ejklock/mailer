<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailTemplate extends Model
{
    use SoftDeletes;
    protected $table = 'mail_templates';
    public $timestamps = true;
    protected $fillable = [
        'name', 'description', 'content'
    ];
}
