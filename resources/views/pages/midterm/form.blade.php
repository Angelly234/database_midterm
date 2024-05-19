@extends('layout.master')

@section('title')
Create Wallet
@endsection

@section('body')
    <div class="flex justify-center items-center">
        <div class="w-[500px] h-[250px] bg-gray-300 p-10 rounded-lg">
            <form action="/create-wallet" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('POST')
                <h2 class="text-black font-bold text-center">Create Wallet</h2>
                <label for="address" class="my-auto text-black">Name</label>
                <input type="text" class="px-2 py-1 rounded-md text-black" id="name" name="name" placeholder="Enter Wallet Name">
                <div class="flex justify-end gap-2">
                    <a href="/wallet" class="bg-red-500 hover:bg-red-600 py-1 px-2 rounded-md transition-all delay-75">Cancel</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 py-1 px-2 rounded-md transition-all delay-75">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection