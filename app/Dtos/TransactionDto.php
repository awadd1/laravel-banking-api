<?php 

namespace App\Dtos;

use App\Enum\TransactionCategoryEnum;
use Carbon\Carbon;
class TransactionDto
{
  private int|null $id;
  private string $reference;
  private int $user_id;
  private int $account_id;
  private int|null $transfer_id;
  private float $amount;
  private float $balance;
  private string $category;
  private string|null $description;
  private string|null $meta;
  private Carbon $date;
  private bool $confirmed;
  private Carbon $created_at;
  private Carbon $updated_at;


  public function getId(): int
  {
      return $this->id;
  }
  public function setId(int $id): TransactionDto
  {
      $this->id = $id;
      return $this;
  }


  public function getReference(): string
  {
      return $this->reference;
  }
  public function setReference(string $reference): TransactionDto
  {
      $this->reference = $reference;
      return $this;
  }


  public function getUserId(): int
  {
      return $this->user_id;
  }
  public function setUserId(int $user_id): TransactionDto
  {
      $this->user_id = $user_id;
      return $this;
  }


  public function getAccountId(): int
  {
      return $this->account_id;
  }
  public function setAccountId(int $account_id): TransactionDto
  {
      $this->account_id = $account_id;
      return $this;
  }


  public function getTransferId(): ?int
  {
      return $this->transfer_id;
  }
  public function setTransferId(?int $transfer_id): TransactionDto
  {
      $this->transfer_id = $transfer_id;
      return $this;
  }


  public function getAmount(): float
  {
      return $this->amount;
  }
  public function setAmount(float $amount): TransactionDto
  {
      $this->amount = $amount;
      return $this;
  }


  public function getBalance(): float
  {
      return $this->balance;
  }
  public function setBalance(float $balance): TransactionDto
  {
      $this->balance = $balance;
      return $this;
  }


  public function getCategory(): string
  {
      return $this->category;
  }
  public function setCategory(string $category): TransactionDto
  {
      $this->category = $category;
      return $this;
  }


  public function getDescription(): ?string
  {
      return $this->description;
  }
  public function setDescription(?string $description): TransactionDto
  {
      $this->description = $description;
      return $this;
  }


  public function getMeta(): ?string
  {
      return $this->meta;
  }
  public function setMeta(?string $meta): TransactionDto
  {
      $this->meta = $meta;
      return $this;
  }


  public function getDate(): Carbon
  {
      return $this->date;
  }
  public function setDate(Carbon $date): TransactionDto
  {
      $this->date = $date;
      return $this;
  }


  public function isConfirmed(): bool
  {
      return $this->confirmed;
  }
  public function setConfirmed(bool $confirmed): TransactionDto
  {
      $this->confirmed = $confirmed;
      return $this;
  }

 
  public function getCreatedAt(): Carbon
  {
      return $this->created_at;
  }
  public function setCreatedAt(Carbon $created_at): TransactionDto
  {
      $this->created_at = $created_at;
      return $this;
  }


  public function getUpdatedAt(): Carbon
  {
      return $this->updated_at;
  }
  public function setUpdatedAt(Carbon $updated_at): TransactionDto
  {
      $this->updated_at = $updated_at;
      return $this;
  }

  public function forDeposit(AccountDto $accountDto,string $reference ,float|int $amount, string|null $description): self
  {
     $dto = new TransactionDto();
     $dto->setUserId($accountDto->getUserId())
         ->setReference($reference)
         ->setAccountId($accountDto->getId())
         ->setAmount($amount)
         ->setTransferId(null)
         ->setCategory(TransactionCategoryEnum::DEPOSIT->value)
         ->setDate(Carbon::now())
         ->setDescription($description);
     return $dto;
  }

  public function forDepositToArray(TransactionDto $transactionDto): array
  {
    return [
        'amount'      => $transactionDto->getAmount(),
        'user_id'     => $transactionDto->getUserId(),
        'reference'   => $transactionDto->getReference(),
        'account_id'  => $transactionDto->getAccountId(),
        'category'    => $transactionDto->getCategory(),
        'date'        => $transactionDto->getDate(),
        'description' => $transactionDto->getDescription(),
    ];
  }


}