<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickethasuser extends Model
{
    protected $fillable = [
        'ticket_id','user_id','comments'
    ];
    public function tickets()
    {
        return $this->belongsTo('App\Ticket');
    }
    public function usrs()
    {
        return $this->belongsTo('App\Users');
    }
}
