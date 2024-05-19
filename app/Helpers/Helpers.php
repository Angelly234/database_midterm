<?php

namespace App\Helpers;

class Helpers
{
    public static function walletView($view, $data = [])
    {
        $pageDetails = PageHelper::pageSetter('Wallets', 'Here are all our Wallets');
        return view($view, array_merge(['page' => $pageDetails], $data));
    }

    public static function homeView($view, $data = [])
    {
        $pageDetails = PageHelper::pageSetter('Home','Welcome! Check Out Our Blockchain');
        return view($view, array_merge(['page' => $pageDetails], $data));
    }
}

?>
