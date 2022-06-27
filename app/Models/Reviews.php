<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $guarded = [];

    protected $primaryKey = 'id';

    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }
}
