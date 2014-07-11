<?php

class Message extends Eloquent {
    protected $table = 'messages';

    public function sender() {
        return $this->belongsTo('User', 'sender');
    }

    public function reciever() {
        return $this->belongsTo('User', 'reciever');
    }

}