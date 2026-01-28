<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement of Account</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f4f4f4;">
        <tr>
            <td style="padding: 20px 0;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: bold;">Statement of Account</h1>
                            <p style="margin: 10px 0 0 0; color: #ffffff; font-size: 14px; opacity: 0.9;">{{ now()->format('F d, Y') }}</p>
                        </td>
                    </tr>

                    <!-- Customer Information -->
                    <tr>
                        <td style="padding: 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <h2 style="margin: 0 0 15px 0; color: #333333; font-size: 18px; font-weight: bold; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Customer Details</h2>
                                        <p style="margin: 5px 0; color: #555555; font-size: 14px; line-height: 1.6;">
                                            <strong style="color: #333333;">Name:</strong> {{ $account->customer->name }}
                                        </p>
                                        <p style="margin: 5px 0; color: #555555; font-size: 14px; line-height: 1.6;">
                                            <strong style="color: #333333;">Email:</strong> {{ $account->customer->email }}
                                        </p>
                                        <p style="margin: 5px 0; color: #555555; font-size: 14px; line-height: 1.6;">
                                            <strong style="color: #333333;">Phone:</strong> {{ $account->customer->phone }}
                                        </p>
                                        @if($account->customer->address)
                                        <p style="margin: 5px 0; color: #555555; font-size: 14px; line-height: 1.6;">
                                            <strong style="color: #333333;">Address:</strong> {{ $account->customer->address }}
                                        </p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Account Summary -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <h2 style="margin: 0 0 15px 0; color: #333333; font-size: 18px; font-weight: bold; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Account Summary</h2>
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f9f9f9; border-radius: 6px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Account Number:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $account->account_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Principal Amount:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        ₱{{ number_format($account->principal_amount, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Interest Rate:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ number_format($account->interest_rate, 2) }}%
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Term:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $account->term_months }} months
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Monthly Payment:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        ₱{{ number_format($account->monthly_payment, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Total Amount:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        ₱{{ number_format($account->total_amount, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Current Balance:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; font-weight: bold; color: #667eea; font-size: 16px;">
                                        ₱{{ number_format($account->balance, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Start Date:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $account->start_date->format('F d, Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Maturity Date:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $account->maturity_date->format('F d, Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px;">
                                        <strong style="color: #333333; font-size: 14px;">Status:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; text-align: right;">
                                        <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: bold; text-transform: uppercase; 
                                            @if($account->status === 'active') background-color: #d4edda; color: #155724;
                                            @elseif($account->status === 'completed') background-color: #cce5ff; color: #004085;
                                            @elseif($account->status === 'defaulted') background-color: #f8d7da; color: #721c24;
                                            @else background-color: #e2e3e5; color: #383d41;
                                            @endif">
                                            {{ ucfirst($account->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Transaction History -->
                    @if($account->transactions->count() > 0)
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <h2 style="margin: 0 0 15px 0; color: #333333; font-size: 18px; font-weight: bold; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Transaction History</h2>
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden;">
                                <thead>
                                    <tr style="background-color: #667eea;">
                                        <th style="padding: 12px 10px; text-align: left; color: #ffffff; font-size: 13px; font-weight: bold;">Date</th>
                                        <th style="padding: 12px 10px; text-align: left; color: #ffffff; font-size: 13px; font-weight: bold;">Type</th>
                                        <th style="padding: 12px 10px; text-align: right; color: #ffffff; font-size: 13px; font-weight: bold;">Amount</th>
                                        <th style="padding: 12px 10px; text-align: right; color: #ffffff; font-size: 13px; font-weight: bold;">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($account->transactions->sortByDesc('transaction_date') as $transaction)
                                    <tr style="border-bottom: 1px solid #e0e0e0;">
                                        <td style="padding: 10px; color: #555555; font-size: 13px;">
                                            {{ $transaction->transaction_date->format('M d, Y') }}
                                        </td>
                                        <td style="padding: 10px; font-size: 13px;">
                                            <span style="display: inline-block; padding: 3px 8px; border-radius: 10px; font-size: 11px; font-weight: bold; text-transform: uppercase;
                                                @if($transaction->type === 'payment') background-color: #d4edda; color: #155724;
                                                @elseif($transaction->type === 'disbursement') background-color: #cce5ff; color: #004085;
                                                @elseif($transaction->type === 'charge') background-color: #fff3cd; color: #856404;
                                                @else background-color: #e2e3e5; color: #383d41;
                                                @endif">
                                                {{ ucfirst($transaction->type) }}
                                            </span>
                                        </td>
                                        <td style="padding: 10px; text-align: right; font-size: 13px;
                                            @if($transaction->type === 'payment') color: #28a745;
                                            @elseif($transaction->type === 'charge') color: #dc3545;
                                            @else color: #555555;
                                            @endif">
                                            @if($transaction->type === 'payment')
                                            - ₱{{ number_format($transaction->amount, 2) }}
                                            @else
                                            + ₱{{ number_format($transaction->amount, 2) }}
                                            @endif
                                        </td>
                                        <td style="padding: 10px; text-align: right; color: #555555; font-size: 13px;">
                                            ₱{{ number_format($transaction->balance_after, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endif

                    <!-- Payment Information -->
                    @if($account->balance > 0)
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; border-radius: 6px; text-align: center;">
                                <p style="margin: 0 0 10px 0; color: #ffffff; font-size: 14px;">Next Payment Due</p>
                                <p style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold;">₱{{ number_format($account->monthly_payment, 2) }}</p>
                            </div>
                        </td>
                    </tr>
                    @endif

                    <!-- Notes -->
                    @if($account->notes)
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 4px;">
                                <p style="margin: 0; color: #856404; font-size: 13px; line-height: 1.6;">
                                    <strong>Note:</strong> {{ $account->notes }}
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endif

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 30px; border-radius: 0 0 8px 8px; border-top: 1px solid #e0e0e0;">
                            <p style="margin: 0 0 10px 0; color: #666666; font-size: 12px; line-height: 1.6; text-align: center;">
                                This is an automated statement of account. Please retain this for your records.
                            </p>
                            <p style="margin: 0; color: #999999; font-size: 11px; text-align: center;">
                                If you have any questions, please contact our customer service department.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>