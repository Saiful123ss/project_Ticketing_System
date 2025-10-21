<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'client_id';
    public $timestamps = false;

    protected $fillable = [
        'name','phone','domain','email','category','created_at'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'client_id', 'client_id');
    }
}
