@extends('layout.master')

@section('body')
    <h1 class="text-white text-4xl mb-4">Blockchains</h1>

    @if($isBlockchainValid)
        <p class="text-green-500">The blockchain is valid.</p>
    @else
        <p class="text-red-500">The blockchain is not valid.</p>
    @endif
    @if($blocks->isEmpty())
        <p>No blocks found.</p>
    @else
</div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-white-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Block ID</th>
                        <th scope="col" class="px-6 py-3">Previous Hash</th>
                        <th scope="col" class="px-6 py-3">Hash</th>
                        <th scope="col" class="px-6 py-3">Block's Data Detail</th>
                        <th scope="col" class="px-6 py-3">Created At</th>
                    </tr>
                </thead>
                <tbody class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    @foreach($blocks as $block)
                        <tr>
                            <td scope="col" class="text-white px-6 py-4">{{ $block->id }}</td>
                            <td scope="col" class="text-white px-6 py-3">{{ $block->previous_hash }}</td>
                            <td scope="col" class="text-white px-6 py-3">{{ $block->hash }}</td>
                            <td scope="col" class="text-white px-6 py-3">{{ $block->data }},<br> Sender: {{$block->sender_address}},<br> Receiver: {{$block->receiver_address}}</td>
                            <td scope="col" class="text-white px-6 py-3">{{ $block->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    @endif
@endsection