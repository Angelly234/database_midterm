<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use App\Helpers\Helpers;
use Illuminate\Http\Request;

class BlocksController extends Controller
{
    public function index()
    {
        $blocks = Blocks::all();
        $isBlockchainValid = Blocks::isBlockchainValid();
        return Helpers::homeView('pages.home', compact('blocks', 'isBlockchainValid'));
    }
}
