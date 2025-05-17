<?php

namespace App\Dtos;

use App\Enum\TransactionCategoryEnum;

class DepositDto {

  private string $account_number;
  private int|float $amount;
  private string|null $description;
  private string $category;
  
  public function getAccountNumber(): string {
    return $this->account_number;
  }

  public function setAccountNumber(string $account_number): void {
    $this->account_number = $account_number;
  }

  public function getAmount(): int|float {
    return $this->amount;
  }

  public function setAmount(int|float $amount): void {
    $this->amount = $amount;
  }

  public function getDescription(): ?string {
    return $this->description;
  }

  public function setDescription(?string $description): void {
    $this->description = $description;
  }

  public function getCategory(): string {
    return $this->category;
  }

  public function setCategory(string $category): void {
    $this->category = $category;
  }
}

