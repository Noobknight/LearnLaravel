<?php
/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 15/11/2016
 * Time: 11:42 SA
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    protected $hidden = ['password', 'reset_password_at', 'remember_created_at', 'reset_password_sent_at',
        'reset_password_token', 'facebook_hn', 'confirmed_at', 'confirmation_token'];

    protected $visible = ['id', 'email', 'last_sign_in_at', 'last_sign_in_ip', 'created_at', 'update_at', 'first_name', 'last_name'];


    public function profile(){
        return $this->hasOne('App\Model\UserProfile', 'user_id', 'id');
    }

}