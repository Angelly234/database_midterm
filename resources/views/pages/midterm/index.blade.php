@extends('layout.master')

@section('title')
Wallets
@endsection

@section('body')
    <div class="flex justify-center">
        <a href="/create-wallet" class="bg-blue-500 hover:bg-blue-600 transition-all delay-75 rounded-md px-2 py-1">Create New Wallet</a>
    </div>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">  
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-white-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Address</th>
                    <th scope="col" class="px-6 py-3">Balance</th>
                    <th scope="col" class="px-6 py-3">Created At</th>
                </tr>
            </thead>
            <tbody class="odd:bg-white odd:dark:bg-black-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                @foreach($wallets as $wallet)
                <tr onclick="window.location='{{ route('wallet.view', ['id' => $wallet->id]) }}';" style="cursor:pointer;">
                    <td class="text-white px-6 py-4">{{ $wallet->name }}</td>
                    <td class="text-white px-6 py-4">{{ $wallet->id }}</td>
                    <td class="text-white px-6 py-4">{{ $wallet->address }}</td>
                    <td class="text-white px-6 py-4">{{ $wallet->balance }}</td>
                    <td class="text-white px-6 py-4">{{ $wallet->created_at }}</td>
                </tr>
                @endforeach
                <!-- End of Example Data -->
            </tbody>
        </table>
    </div>
@endsection