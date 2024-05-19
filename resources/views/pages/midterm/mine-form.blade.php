@extends('layout.master')

@section('title')
Create Wallet
@endsection

@section('body')
<h2 class="text-2xl font-bold">Mine Address</h2>
<form action="/mine/{{$wallet->id}}" method="POST" class="flex flex-col gap-4">
    @csrf
    @method('POST')
    @if(Session::has('errorMessage'))
    <p style="color: red !important;">
        {{ Session::get('errorMessage') }}
    </p>
    @endif

    <div class="grid gap-1">
        <label for="address">Miner's Address</label>
        <input type="text" class="px-2 py-1 rounded-md text-black" id="address" name="address" placeholder="Enter Wallet's Address">
    </div>

    <div class="flex gap-2 justify-end">
        <a href="/wallet" class="bg-red-500 hover:bg-red-600 py-1 px-2 rounded-md transition-all delay-75">Cancel</a>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 py-1 px-2 rounded-md transition-all delay-75">Submit</button>
    </div>

</form>
@endsection