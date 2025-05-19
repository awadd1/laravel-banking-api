<?php 

namespace App\Dtos;
use App\Enum\TransactionCategoryEnum;


class WithdrawDto 
{

    private string $account_number;
    private int|float $amount;
    private string|null $description;
    private string $pin;
    private string $category;


    public function getAccountNumber(): string
    {
        return $this->account_number;
    }
    public function setAccountNumber(string $account_number): void
    {
        $this->account_number = $account_number;
    }


    public function getAmount(): float|int
    {
        return $this->amount;
    }
    public function setAmount(float|int $amount): void
    {
        $this->amount = $amount;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


    public function getPin(): string
    {
        return $this->pin;
    }
    public function setPin(string $pin): void
    {
        $this->pin = $pin;
    }

    public function getCategory(): string
    {
        $this->setCategory(TransactionCategoryEnum::WITHDRAWAL->value);
        return $this->category;
    }
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

}