<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Wallets;
use App\Helpers\Helpers;
use App\Helpers\PageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class WalletsController extends Controller
{
    protected $pageDetails;

    public function index()
    {
        $wallets = Wallets::all();
        return Helpers::walletView('pages.midterm.index', ['wallets' => $wallets]);
    }

    public function formIndex()
    {
        $wallets = Wallets::all();
        
        return Helpers::walletView('pages.midterm.form');
    }

    public function store(Request $request)
    {
        $wallet = new Wallets();
        $wallet->name = $request->name;
        $wallet->address = Uuid::uuid4()->toString();
        $wallet->balance = 100;
        $wallet->save();
        return redirect()->route('wallets.index');
    }

    public function view($id)
    {
        $wallet = Wallets::where('id', $id)->first();
        return Helpers::walletView('pages.midterm.view', ['wallet' => $wallet]);
    }

    public function sendForm($id)
    {
        $wallet = Wallets::where('id', $id)->first();
        return Helpers::walletView('pages.midterm.send-form', ['senderAddress' => $wallet->address]);
    }

    public function storeTransaction($id, Request $request)
    {
        //initialize error message
        $errorMessage = Session::get('errorMessage', null);

        $senderAddress = $id;
        $receiverAddress = $request->address;

        $sender = Wallets::where('address', $senderAddress)->first();
        $receiver = Wallets::where('address', $receiverAddress)->first();

        if (!$receiver) {
            Session::flash('errorMessage', 'No Matching Wallet Address');
            return redirect()->back()->with($errorMessage);
        }
        if (floatval($sender->balance) < floatval($request->amount)) {
            Session::flash('errorMessage', 'Not Enough Currency in your balance');
            return redirect()->back()->withErrors($errorMessage);
        }

        // Don't deduct the transaction amount from the sender's balance here

        $wallet_id = DB::table('wallets')->select('id')->where('address', $senderAddress)->first();

        $transaction = new Transaction();
        $transaction->from_address = $senderAddress;
        $transaction->to_address = $receiverAddress;
        $transaction->amount = $request->amount;
        $transaction->wallet_id = $wallet_id->id;
        $transaction->status = 'pending'; // Set the transaction status to "pending"
        $transaction->save();

        return Helpers::walletView('pages.midterm.view', ['wallet' => $sender]);
    }

    public function show($id)
    {
        // Fetch the wallet and its transactions eagerly loading the transactions
        $wallet = Wallets::with(['transactions' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        // Separate the transactions into completed and pending
        $completedTransactions = $wallet->transactions->where('status', 'completed');
        $pendingTransactions = $wallet->transactions->where('status', 'pending');
        
        return view('pages.midterm.transactions', [
            'wallet' => $wallet,
            'completedTransactions' => $completedTransactions,
            'pendingTransactions' => $pendingTransactions,
        ]);
    }

}

