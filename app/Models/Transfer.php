<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function senderAccount()
    {
        return $this->belongsTo(Account::class, 'sender_account_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function recipientAccount()
    {
        return $this->belongsTo(Account::class, 'recipient_account_id');
    }

  
}
