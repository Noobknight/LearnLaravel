<?php

/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 17/11/2016
 * Time: 9:29 SA
 */
class UserTransformer extends DataTransformer
{

    public function transform($user)
    {
        return [
            'id'=> $user['id'],
            'first_name'=> $user['first_name'],
            'last_name'=> $user['last_name'],
            'age'=> $user['age'],
            'avatar'=> $user['avatar'],
            'birthday'=> $user['birthday'],
            'country'=> $user['country'],
            'city'=> $user['city'],
            'phone_number'=> $user['phone_number'],
            'email'=> $user['email'],
            'created_at'=> $user['created_at'],
            'last_sign_in_at'=> $user['last_sign_in_at'],
            'last_sign_in_ip'=> $user['last_sign_in_ip']
        ];
    }
}