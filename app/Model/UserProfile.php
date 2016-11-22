<?php
/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 15/11/2016
 * Time: 11:55 SA
 */
namespace App\Model;

use Eloquent;

class UserProfile extends Eloquent{

    protected $table = 'user_profiles';

    protected $hidden = ['user_id', 'created_at', 'linkedin', 'name', 'email'];

    protected $visible = ['age', 'avatar', 'birthday', 'city', 'country', 'education',
        'first_name', 'last_name', 'gender', 'phone_number', 'street_address'];

    public function user(){
        return $this->belongsTo('App\Mode\User', 'id', 'user_id');
    }
}