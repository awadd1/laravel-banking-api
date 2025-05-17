<?php 

namespace App\Dtos;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AccountDto
{
  private int $id;
  private int $user_id;
  private string $account_number;
  private float $balance;
  private Carbon $created_at;
  private Carbon $updated_at;


  public function getId(): int
  {
      return $this->id;
  }
  public function setId(int $id): AccountDto
  {
      $this->id = $id;
      return $this;
  }


  public function getUserId(): int
  {
      return $this->user_id;
  }
  public function setUserId(int $user_id): AccountDto
  {
      $this->user_id = $user_id;
      return $this;
  }


  public function getAccountNumber(): string
  {
      return $this->account_number;
  }
  public function setAccountNumber(string $account_number): AccountDto
  {
      $this->account_number = $account_number;
      return $this;    
  }

 
  public function getBalance(): float
  {
      return $this->balance;
  }
  public function setBalance(float $balance): AccountDto
  {
      $this->balance = $balance;
      return $this;     
  }


  public function getCreatedAt(): Carbon
  {
       return $this->created_at;
  }
  public function setCreatedAt(Carbon $created_at): AccountDto
  {
      $this->created_at = $created_at;
      return $this;
  }


  public function getUpdatedAt(): Carbon
  {
      return $this->updated_at; 
  }
  public function setUpdatedAt(Carbon $updated_at): AccountDto
  {
      $this->updated_at = $updated_at;
      return $this;
  }

  public static function fromModel(Account $account): self
  {
    $dto = new self();
    $dto->setId($account->id)
        ->setUserId($account->user_id)
        ->setAccountNumber($account->account_number)
        ->setBalance($account->balance);
    return $dto;
  }

}