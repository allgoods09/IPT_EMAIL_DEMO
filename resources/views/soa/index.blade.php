<x-app-layout>
    @if(session('status'))
        <div id="status-message" style="padding: 15px; margin-bottom: 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; transition: opacity 0.5s;">
            {{ session('status') }}
        </div>

        <script>
            setTimeout(function() {
                var msg = document.getElementById('status-message');
                msg.style.opacity = '0';
                setTimeout(function() {
                    msg.style.display = 'none';
                }, 500);
            }, 5000);
        </script>
    @endif
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statement of Accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Account List for Statement Generation</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Select accounts to generate statements of account</p>
                    </div>

                    <!-- Search and Filter Section -->
                    <form method="GET" action="{{ route('soa.index') }}" class="mb-6">
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by customer name or account number..." 
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                            <select name="status" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                Search
                            </button>
                            @if(request('search') || request('status'))
                                <a href="{{ route('soa.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>

                    <!-- Form for selected accounts -->
                    <form id="soa-form" method="POST" action="{{ route('soa.generateSelected') }}">
                        @csrf
                        
                        <!-- Accounts Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            <input type="checkbox" id="select-all" class="rounded">
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Account #
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Customer Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Principal Amount
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Balance
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Last Payment
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($accounts as $account)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="checkbox" name="account_ids[]" value="{{ $account->id }}" class="rounded account-checkbox">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{ $account->account_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $account->customer->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                ₱{{ number_format($account->principal_amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                ₱{{ number_format($account->balance, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($account->status === 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($account->status === 'overdue') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                    @elseif($account->status === 'paid') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                                    @endif">
                                                    {{ ucfirst($account->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $account->lastPaymentDate() ? \Carbon\Carbon::parse($account->lastPaymentDate())->format('M d, Y') : 'N/A' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                No accounts found matching your criteria.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="mt-6 flex justify-between items-center">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <span id="selected-count">0</span> account(s) selected | Showing {{ $accounts->count() }} account(s)
                            </div>
                            <div class="flex gap-3">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                    Generate Selected SOAs
                                </button>
                                <a href="{{ route('soa.generateAll') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                    Generate All SOAs
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Select/Deselect All functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.account-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });

        // Update selected count
        function updateSelectedCount() {
            const checkedBoxes = document.querySelectorAll('.account-checkbox:checked');
            document.getElementById('selected-count').textContent = checkedBoxes.length;
        }

        // Add event listeners to all checkboxes
        document.querySelectorAll('.account-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Prevent form submission if no accounts selected
        document.getElementById('soa-form').addEventListener('submit', function(e) {
            const checkedBoxes = document.querySelectorAll('.account-checkbox:checked');
            if (checkedBoxes.length === 0) {
                e.preventDefault();
                alert('Please select at least one account to generate SOAs.');
            }
        });
    </script>
</x-app-layout>