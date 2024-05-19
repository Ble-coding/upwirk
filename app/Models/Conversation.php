<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emploi;
use App\Models\Message;

class Conversation extends Model
{
    use HasFactory;
    protected $table = 'conversations';
    protected $fillable = ['from', 'to', 'emploi_id'];


    public function messages()
{
    return $this->hasMany(Message::class);
}


    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }

    
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
