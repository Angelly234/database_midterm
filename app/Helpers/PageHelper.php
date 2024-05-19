<?php

namespace App\Helpers;

class PageHelper
{
    public static function pageSetter($pageTitle, $pageHeading)
    {
        $pageDetails = new \stdClass();
        $pageDetails->pageTitle = $pageTitle;
        $pageDetails->pageHeading = $pageHeading;
        return $pageDetails;
    }
}

?>
