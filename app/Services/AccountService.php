<?php 

namespace App\Services;

use App\Dtos\AccountDto;
use App\Dtos\DepositDto;
use App\Dtos\TransactionDto;
use App\Models\Account;
use App\Dtos\UserDto;
use App\Events\DepositEvent;
use App\Exceptions\AccountNumberExistsException;
use App\Exceptions\DepositAmountToLowException;
use App\Exceptions\InvalidAccountNumberException;
use  \Illuminate\Database\Eloquent\Builder;
use App\Interfaces\AccountServiceInterface;
use Illuminate\Support\Facades\DB;
use LogicException;
class AccountService implements AccountServiceInterface
{

  public function __construct(
    private readonly UserService $userService,
    private readonly TransactionService $transactionService
    ) {
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

  public function deposit(DepositDto $depositDto): TransactionDto
  {
    $min_deposit = 500;
    if($depositDto->getAmount() < $min_deposit){
      throw new DepositAmountToLowException($min_deposit);
    }

    try {
        DB::beginTransaction();
        $transactionDto = new TransactionDto();
        $accountQuery = $this->modelQuery()->where('account_number', $depositDto->getAccountNumber());
        $this->accountExist($accountQuery);
        $lockedAccount = $accountQuery->lockForUpdate()->first();
        $accountDto = AccountDto::fromModel($lockedAccount);
        $transactionDto = $transactionDto->forDeposit(
          $accountDto,
          $this->transactionService->generateReference(),
          $depositDto->getAmount(),
          $depositDto->getDescription(),
      );
        event(new DepositEvent($transactionDto, $accountDto, $lockedAccount));
        DB::commit();
        return $transactionDto;
    } catch (\Exception $exception) {
        DB::rollback();
        throw $exception;
    }
    
  }

  public function accountExist(Builder $accountQuery): void
  {
    if(!$accountQuery->exists()){
      throw new InvalidAccountNumberException();
    }
  }
}