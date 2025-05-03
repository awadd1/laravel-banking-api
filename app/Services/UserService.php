<?php 

namespace App\Services;

use App\Dtos\UserDto;
use App\Models\User;

class UserService  
{

  public function createUser(UserDto $userDto)
  {
    $user = new User();
    $user->name         = $userDto->getName();
    $user->email        = $userDto->getEmail();
    $user->password     = bcrypt($userDto->getPassword());
    $user->phone_number = $userDto->getPhoneNumber();
    $user->save();

    return $user;
  }
}