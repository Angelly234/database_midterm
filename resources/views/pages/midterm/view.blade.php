<!-- resources/views/wallet.blade.php -->

@extends('layout.master')

@section('title')
Wallet Details
@endsection

@section('body')
</div>  
    <div class="bg-slate-800 text-white flex flex-col gap-2 p-4 rounded-md">
        <h2 class="text-white font-bold text-2xl text-center">Wallet Details</h2>
        <h2></h2>
        <h5 class="card-title">Wallet ID: {{ $wallet->id }}</h5>
        <p class="card-text">Name: {{ $wallet->name }}</p>
        <p class="card-text">Address: {{ $wallet->address }}</p>
        <p class="card-text">Balance: {{ $wallet->balance }}</p>
        <p class="card-text">Created At: {{ $wallet->created_at }}</p>
        <div class="flex justify-end gap-2">
            <a href="{{ route('wallets.index') }}" class="bg-blue-500 hover:bg-blue-600 py-1 px-2 rounded-md transition-all delay-75">Back to Wallets</a>
            <a href="{{ route('wallet.send-form', ['id' => $wallet->id]) }}" class="bg-green-500 hover:bg-green-600 py-1 px-2 rounded-md transition-all delay-75">Send Currency To Other Wallet</a>
            <a href="{{ route('wallet.show', ['id' => $wallet->id]) }}" class="bg-yellow-500 hover:bg-yellow-600 py-1 px-2 rounded-md transition-all delay-75">View Transactions</a>
        </div>
    </div>
@endsection