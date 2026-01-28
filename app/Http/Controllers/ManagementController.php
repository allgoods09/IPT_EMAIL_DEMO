<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Jobs\SendStatementOfAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ManagementController extends Controller
{
    public function soaGeneration()
    {
        $accounts = $this->getAccountsForSOA();

        return view('soa.index',[
            'accounts' => $accounts
        ]);
    }

    public function generateAllSOAs()
    {
        $accounts = $this->getAccountsForSOA();

        $successCount = 0;
        $failureCount = 0;
        $delayInSeconds = 0;

        foreach ($accounts as $account) {
            try {
                Log::info("Generating SOA for Account ID: {$account->id}, Account Number: {$account->account_number}");

                SendStatementOfAccount::dispatch($account)
                    ->delay(now()->addSeconds($delayInSeconds));
                
                $successCount++;
                $delayInSeconds += 15; //Changed to 15 from 5 kay naay limit ang mailtrap

            } catch (\Exception $e) {
                $failureCount++;
                Log::error("Failed to queue SOA for Account ID: {$account->id}, Error: {$e->getMessage()}", [
                    'exception' => $e,
                    'account_id' => $account->id,
                    'account_number' => $account->account_number,
                ]);
            }
        }

        return redirect()->route('soa.index')->with('status', "SOAs queued successfully: {$successCount} account(s). Failed: {$failureCount} account(s).");
    }

    private function getAccountsForSOA()
    {
        // return Account::whereDay('start_date', 23)->get();
        return Account::whereDay('start_date', \Carbon\Carbon::now()->addDays(10)->day)->get();
    }
}