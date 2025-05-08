<?php 

namespace App\Services;
use App\Models\Account;
use App\Dtos\UserDto;
use App\Exceptions\AccountNumberExistsException;
use  \Illuminate\Database\Eloquent\Builder;
use App\Interfaces\AccountServiceInterface;
use LogicException;
class AccountService implements AccountServiceInterface
{

  public function __construct(private readonly UserService $userService) {
    
  }

  public function modelQuery(): Builder
  {
      return Account::query();
  }

  public function hasAccountNumber(UserDto $userDto): bool
  {
    return $this->modelQuery()->where('user_id', $userDto->getId())->exists();
  }


  public function createAccountNumber(UserDto $userDto): Account
  {

    if($this->hasAccountNumber($userDto)){
      throw new AccountNumberExistsException();
    }
     
      return $this->modelQuery()->create([
        'account_number' => substr($userDto->getPhoneNumber(), -10),
        'user_id'        => $userDto->getId(),

      ]);
  }

  public function getAccountByAccountNumber(string $accountNumber): Account
  {
    throw new LogicException('Method not implemented yet.');

  }

  public function getAccountByUserId(int $userId): Account
  {
    throw new LogicException('Method not implemented yet.');

  }

  public function getAccount(int|string $accountNumberOrUserId): Account
  {
    throw new LogicException('Method not implemented yet.');

  }
}