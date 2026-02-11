<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Confirmation</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f4f4f4;">
        <tr>
            <td style="padding: 20px 0;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: bold;">Transaction Confirmation</h1>
                            <p style="margin: 10px 0 0 0; color: #ffffff; font-size: 14px; opacity: 0.9;">{{ now()->format('F d, Y') }}</p>
                        </td>
                    </tr>

                    <!-- Transaction Information -->
                    <tr>
                        <td style="padding: 30px;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <h2 style="margin: 0 0 15px 0; color: #333333; font-size: 18px; font-weight: bold; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Transaction Details</h2>
                                        <table role="presentation" style="width: 100%; border-collapse: collapse;">
                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                                    <strong style="color: #333333; font-size: 14px;">Transaction Number:</strong>
                                                </td>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                                    {{ $transaction->transaction_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                                    <strong style="color: #333333; font-size: 14px;">Transaction Date:</strong>
                                                </td>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                                    {{ $transaction->transaction_date->format('F d, Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                                    <strong style="color: #333333; font-size: 14px;">Transaction Type:</strong>
                                                </td>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0; text-align: right;">
                                                    <span style="display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: bold; text-transform: uppercase; 
                                                        @if($transaction->type === 'payment') background-color: #d4edda; color: #155724;
                                                        @else background-color: #cce5ff; color: #004085;
                                                        @endif">
                                                        {{ ucfirst($transaction->type) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                                    <strong style="color: #333333; font-size: 14px;">Amount:</strong>
                                                </td>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0; text-align: right; font-weight: bold; font-size: 18px;
                                                    @if($transaction->type === 'disbursement') color: #dc3545;
                                                    @else color: #28a745;
                                                    @endif">
                                                    @if($transaction->type === 'disbursement')
                                                    + ₱{{ number_format($transaction->amount, 2) }}
                                                    @else
                                                    - ₱{{ number_format($transaction->amount, 2) }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                                    <strong style="color: #333333; font-size: 14px;">Balance After Transaction:</strong>
                                                </td>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0; text-align: right; color: #667eea; font-weight: bold; font-size: 16px;">
                                                    ₱{{ number_format($transaction->balance_after, 2) }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Customer Information -->
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <h2 style="margin: 0 0 15px 0; color: #333333; font-size: 18px; font-weight: bold; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Customer Details</h2>
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f9f9f9; border-radius: 6px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Name:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $transaction->account->customer->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Email:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $transaction->account->customer->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Phone:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $transaction->account->customer->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px;">
                                        <strong style="color: #333333; font-size: 14px;">Account Number:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $transaction->account->account_number }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Details (if payment) -->
                    @if($transaction->type === 'payment')
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <h2 style="margin: 0 0 15px 0; color: #333333; font-size: 18px; font-weight: bold; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Payment Details</h2>
                            <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f9f9f9; border-radius: 6px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0;">
                                        <strong style="color: #333333; font-size: 14px;">Payment Method:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #e0e0e0; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $transaction->payment_method ? ucfirst($transaction->payment_method) : 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 15px;">
                                        <strong style="color: #333333; font-size: 14px;">Reference Number:</strong>
                                    </td>
                                    <td style="padding: 12px 15px; text-align: right; color: #555555; font-size: 14px;">
                                        {{ $transaction->reference_number ?? 'N/A' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    <!-- Notes -->
                    @if($transaction->notes)
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 4px;">
                                <p style="margin: 0; color: #856404; font-size: 13px; line-height: 1.6;">
                                    <strong>Note:</strong> {{ $transaction->notes }}
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endif

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 30px; border-radius: 0 0 8px 8px; border-top: 1px solid #e0e0e0;">
                            <p style="margin: 0 0 10px 0; color: #666666; font-size: 12px; line-height: 1.6; text-align: center;">
                                This is an automated transaction confirmation. Please retain this for your records.
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

