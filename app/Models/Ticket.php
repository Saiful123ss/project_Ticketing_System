<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'ticket_id';
    public $timestamps = true;

    protected $fillable = ['client_id','title','description','category','status','track_key','created_at','updated_at'];

    public function client()
{
    // adjust the 3rd parameter (the 'id') to match your client's primary key
    return $this->belongsTo(Client::class, 'client_id', 'client_id');
}


public function replies()
{
    return $this->hasMany(TicketReply::class, 'ticket_id', 'ticket_id');
}

}
