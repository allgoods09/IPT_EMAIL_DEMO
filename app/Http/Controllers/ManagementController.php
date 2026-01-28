<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Jobs\SendStatementOfAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ManagementController extends Controller
{
    public function soaGeneration(Request $request)
    {
        $query = $this->getAccountsForSOA();
        
        // Apply status filter
        if ($request->filled('status')) {
            $query = $query->where('status', $request->status);
        }
        
        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query = $query->where(function($q) use ($search) {
                $q->where('account_number', 'like', "%{$search}%")
                ->orWhereHas('customer', function($customerQuery) use ($search) {
                    $customerQuery->where('name', 'like', "%{$search}%");
                });
            });
        }
        
        $accounts = $query->get();

        return view('soa.index', [
            'accounts' => $accounts
        ]);
    }

    public function generateAllSOAs()
    {
        $accounts = $this->getAccountsForSOA()->get(); // Add ->get() here!

        $successCount = 0;
        $failureCount = 0;
        $delayInSeconds = 0;

        foreach ($accounts as $account) {
            try {
                Log::info("Generating SOA for Account ID: {$account->id}, Account Number: {$account->account_number}");

                \App\Jobs\SendStatementOfAccount::dispatch($account)
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

    public function generateSelectedSOAs(Request $request)
    {
        $accountIds = $request->input('account_ids', []);
        
        if (empty($accountIds)) {
            return redirect()->route('soa.index')->with('status', 'No accounts selected.');
        }

        $accounts = Account::whereIn('id', $accountIds)->get();
        
        $successCount = 0;
        $failureCount = 0;
        $delayInSeconds = 0;

        foreach ($accounts as $account) {
            try {
                Log::info("Generating SOA for Account ID: {$account->id}, Account Number: {$account->account_number}");

                \App\Jobs\SendStatementOfAccount::dispatch($account)
                    ->delay(now()->addSeconds($delayInSeconds));
                
                $successCount++;
                $delayInSeconds += 5;

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
        // Return query builder instead of collection
        return Account::whereDay('start_date', \Carbon\Carbon::now()->addDays(10)->day);
    }
}