<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $table = 'ticket_reply';
    protected $primaryKey = 'reply_id';
    public $timestamps = false; // keep this since you're managing created_at manually

    protected $fillable = [
        'ticket_id',
        'user_type',
        'user_id',
        'message',
        'attachments',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'ticket_id');
    }
}
