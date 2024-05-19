<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Models\Wallets;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class TransactionController extends Controller
{
    public function show($id)
    {
        $wallet = Wallets::findOrFail($id);
        $completedTransactions = Transaction::where('wallet_id', $id)->where('status', 'completed')->get();
        $pendingTransactions = Transaction::where('wallet_id', $id)->where('status', 'pending')->get();

        return view('pages.midterm.transactions', [
            'wallet' => $wallet,
            'completedTransactions' => $completedTransactions,
            'pendingTransactions' => $pendingTransactions,
        ]);
    }

    public function mineForm($id)
    {
        $wallet = Wallets::findOrFail($id);
        return view('pages.midterm.mine-form', [
            'wallet' => $wallet
        ]);
    }

    public function mine($id, Request $request)
    {
        $wallet = Wallets::findOrFail($id);

        $miner = Wallets::where('address', $request->address)->first();
        $errorMessage = Session::get('errorMessage', null);
        if (!$miner) {
            Session::flash('errorMessage', 'Miner wallet not found');
            return redirect()->back()->with($errorMessage);
        }

        $pendingTransactions = Transaction::where('status', 'pending')
            ->where('from_address', $wallet->address)
            ->get();

        if (count($pendingTransactions) == 0) {
            Session::flash('errorMessage', 'No pending transaction found');
            return redirect()->back()->with($errorMessage);
        }

        // Define the mining reward
        $miningReward = 1;

        foreach ($pendingTransactions as $transaction) {
            // Verify the transaction here
            // If the transaction is valid, update the sender and receiver balances and transaction status
            $sender = Wallets::where('address', $transaction->from_address)->first();
            $receiver = Wallets::where('address', $transaction->to_address)->first();

            if ($sender->balance >= $transaction->amount) {
                $sender->balance -= $transaction->amount;
                $receiver->balance += $transaction->amount;
                $transaction->status = 'completed';
                $sender->save();
                $receiver->save();
                $transaction->save();
            }
        }

        // Add a new block to the blockchain after mining
        $lastBlock = Blocks::orderBy('index', 'desc')->first();
        $newBlock = new Blocks();
        $newBlock->index = $lastBlock->index + 1;
        $newBlock->previous_hash = $lastBlock->hash;
        $newBlock->data = 'Block ' . $newBlock->index . ' mined, Amount: ' . $transaction->amount;
        $newBlock->hash = $newBlock->calculateHash();

        // Set the sender_address value
        $newBlock->sender_address = $wallet->address;

        // Set the receiver value
        $newBlock->receiver_address = $receiver->address; // Replace this with the actual receiver value

        $newBlock->save();

        // Add the mining reward to the miner's balance
        $miner->balance += $miningReward;
        $miner->save();

        return redirect()->route('wallet.show', ['id' => $id]);
    }
}
