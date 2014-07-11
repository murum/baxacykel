<?php

class Club extends Eloquent {

    public static $rules = array(
        'name' => 'required|min:4',
    );

    public function users() {
        return $this->belongsToMany('User')->withPivot('approved', 'chat_read' ,'id');
    }

     public function messages() {
        return $this->hasMany('ClubMessage');
    }

    public function user() {
        return $this->belongsTo('User', 'owner', 'id');
    }



    public function get_users_count() {
        $counter = 0;
        foreach ( $this->users()->get() as $user ) {
            if($user->pivot->approved == 1) {
                $counter++;
            }
        }
        return $counter;
    }

    public function is_member() {
        $is_member = false;

        foreach ($this->users as $user) {
            if( $user->id == Auth::user()->id ) {

                if($user->pivot->approved == 1) {
                    $is_member = true;
                    continue;
                }
            }
        }

        return $is_member;
    }

    public function is_appling() {
        $is_appling = false;

        foreach ($this->users as $user) {
            if( $user->id == Auth::user()->id ) {
                if($user->pivot->approved == 0) {
                    $is_appling = true;
                    continue;
                }
            }
        }

        return $is_appling;
    }
}