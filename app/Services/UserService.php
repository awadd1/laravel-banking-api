<?php 

namespace App\Services;

use App\Dtos\UserDto;
use App\Exceptions\InvalidPinLengthException;
use App\Exceptions\PinHasAlreadyBeenSetException;
use App\Exceptions\PinNotSetException;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{

  public function createUser(UserDto $userDto): Builder|Model
  {
    $user = new User();
    $user->name         = $userDto->getName();
    $user->email        = $userDto->getEmail();
    $user->password     = bcrypt($userDto->getPassword());
    $user->phone_number = $userDto->getPhoneNumber();
    $user->save();

    return $user;
  }
  
  public function setupPin(User $user, string $pin): void
  {
      if($this->hasSetPin($user)){
        throw new PinHasAlreadyBeenSetException("Please set your pin");
      }

      if (strlen($pin) != 4) {
        throw new InvalidPinLengthException();
      }

      $user->pin = Hash::make($pin);
      $user->save();
  }

  

  
  public function validatePin(int $userId, string $pin): bool
  {
    $user = $this->getUserById($userId);
    if(!$this->hasSetPin($user)){
      throw new PinNotSetException("Please set your pin");
    }
    return Hash::check($pin, $user->pin);
  }
  
  public function hasSetPin(User $user): bool
  {
    return $user->pin != null;
  }

  public function getUserById(int $userId): Builder|Model
  {
    $user = User::query()->where('id', $userId)->first();
    if(!$user) { 
      throw new ModelNotFoundException("user not found");
    } 
    return $user;
  }
}