<?php 

namespace App\Services;

use App\Dtos\AccountDto;
use App\Dtos\TransferDto;
use App\Exceptions\ANotFoundException;
use App\Interfaces\TransferServiceInterface;
use App\Models\Account;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LogicException;

class TransferService implements TransferServiceInterface
{
  public function modelQuery(): Builder
  {
    return Transfer::query();
  }

  public function createTransfer(TransferDto $transferDto): Transfer
  {

    $transfer = $this->modelQuery()->create([
      'sender_id'            => $transferDto->getSenderId(),
      'recipient_id'         => $transferDto->getRecepientId(),
      'sender_account_id'    => $transferDto->getSenderAccountId(),
      'recipient_account_id' => $transferDto->getRecepientAccountId(),
      'reference'            => $transferDto->getReference(),
      'status'               => $transferDto->getStatus(),
      'amount'               => $transferDto->getAmount(),
    ]);
    return $transfer;
  }

  public function getTransfersBetweenAccount(AccountDto $firstAccountDto, AccountDto $secondAccountDto): array
  {
    throw new LogicException('Method not implemented yet.');
  }

  public function generateReference(): string
  {
    return Str::upper('TRF' . '/' . Carbon::now()->getTimestampMs() . '/' . Str::random(4));
  }


  public function getTransferById(int $transferId): Transfer
  {

    $transfer = $this->modelQuery()->where('id', $transferId)->first();
    if (!$transfer) {
      throw new ANotFoundException("Transfer not found");
    }
    return $transfer;
  }

  public function getTransferByReference(string $reference): Transfer
  {

    $transfer = $this->modelQuery()->where('reference', $reference)->first();
    if (!$transfer) {
      throw new ANotFoundException("Transfer  with supplier reference not found");
    }
    return $transfer;
  }
}