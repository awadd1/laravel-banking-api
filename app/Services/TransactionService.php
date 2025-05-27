<?php

namespace App\Services;
use App\Dtos\AccountDto;
use App\Dtos\TransactionDto;
use App\Enum\TransactionCategoryEnum;
use App\Exceptions\ANotFoundException;
use App\Interfaces\TransactionServiceInterface;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use LogicException;
use Illuminate\Support\Str;


class TransactionService implements TransactionServiceInterface
{

  public function modelQuery(): Builder
  {
    return Transaction::query();
  }

  public function generateReference(): string
  {
    return Str::upper('TF' . '/' . Carbon::now()->getTimestampMs() . '/' . Str::random(4));
  }

  public function createTransaction(TransactionDto $transactionDto): Transaction
  {
    $data = [];
    if ($transactionDto->getCategory() == TransactionCategoryEnum::DEPOSIT->value) {
        $data = $transactionDto->forDepositToArray($transactionDto);
    }
    if ($transactionDto->getCategory() == TransactionCategoryEnum::WITHDRAWAL->value) {
        $data =$transactionDto->forWithdrawalToArray($transactionDto);
    }
    $transaction = $this->modelQuery()->create($data);
    return $transaction;
  }

  public function downloadTransactionHistory(AccountDto $accountDto, Carbon $fromDate, Carbon $endDate): Collection
  {
     throw new LogicException('Method not implemented yet.');
  }

  public function updateTransactionBalance(string $reference, float|int $balance)
  {
    $this->modelQuery()->where('reference', $reference)->update([
        'balance'   => $balance,
        'confirmed' => true
    ]);
  }

  public function updateTransferID(string $reference, int $transferID)
  {
    $this->modelQuery()->where('reference', $reference)->update([
      'transfer_id' => $transferID
    ]);
  }

  public function getTransactionByReference(string $reference): Transaction
  {
    throw new LogicException('Method not implemented yet.');
  }

  public function getTransactionById(int $transactionID): Transaction
  {
    throw new LogicException('Method not implemented yet.');
  }

  public function getTransactionsByAccountNumber(int $accountNumber, Builder $builder): Builder
  {
    throw new LogicException('Method not implemented yet.');
  }

  public function getTransactionsByUserId(int $userID, Builder $builder): Builder
  {
    throw new LogicException('Method not implemented yet.');
  }
}