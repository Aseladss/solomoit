<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'referance', 'customer_name', 'email', 'phone_number', 'status', 'problem_description'
    ];
    
    public function tickethasusers()
    {
        return $this->hasMany('App\Tickethasuser');
    }
}
