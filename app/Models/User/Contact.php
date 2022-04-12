<?php

namespace App\Models\User;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
