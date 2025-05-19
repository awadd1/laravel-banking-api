<?php

namespace App\Http\Controllers;

use App\Dtos\WithdrawDto;
use App\Services\AccountService;
use Illuminate\Http\Request;
use App\Http\Requests\WithdrawRequest;

class AccountWithdrawalController extends Controller
{
    public function __construct(private readonly AccountService $accountService) {
    }

    public function store(WithdrawRequest $request)
    {
        $account = $this->accountService->getAccountByUserID($request->user()->id);
        $withdrawDto = new WithdrawDto();
        $withdrawDto->setAccountNumber($account->account_number);
        $withdrawDto->setAmount($request->input('amount'));
        $withdrawDto->setDescription($request->input('description'));
        $withdrawDto->setPin($request->input('pin'));
        $this->accountService->withdraw($withdrawDto);
        return $this->sendSuccess([], 'Withdrawal successful');
    }
}
