{{-- resources/views/pages/midterm/transactions.blade.php --}}
@extends('layout.master')

@section('body')

    <h1 class="text-center font-bold text-3xl">Transactions for Wallet: {{ $wallet->name }}</h1>

    <div class="my-4">
        <a href="{{ route('transaction.mine', ['id' => $wallet->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Mine Transactions
        </a>
    </div>
    
    <h2 class="font-bold text-xl">Completed Transactions</h2>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-white-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Timestamp</th>
                    <th scope="col" class="px-6 py-3">From</th>
                    <th scope="col" class="px-6 py-3">To</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                @forelse($completedTransactions as $transaction)
                    <tr>
                        <td class="text-white px-6 py-4">{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                        <td class="text-white px-6 py-4">{{ $transaction->from_address }}</td>
                        <td class="text-white px-6 py-4">{{ $transaction->to_address }}</td>
                        <td class="text-white px-6 py-4">${{ number_format($transaction->amount, 2) }}</td>
                        <td class="text-white px-6 py-4">{{ $transaction->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center px-6 py-2">No completed transactions available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="font-bold text-xl">Pending Transactions</h2>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-white-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Timestamp</th>    
                    <th scope="col" class="px-6 py-3">From</th>
                    <th scope="col" class="px-6 py-3">To</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                @forelse($pendingTransactions as $transaction)
                    <tr>
                        <td class="text-white px-6 py-4">{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                        <td class="text-white px-6 py-4">{{ $transaction->from_address }}</td>
                        <td class="text-white px-6 py-4">{{ $transaction->to_address }}</td>
                        <td class="text-white px-6 py-4">${{ number_format($transaction->amount, 2) }}</td>
                        <td class="text-white px-6 py-4">{{ $transaction->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-white px-6 py-2">No pending transactions available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
