<?php

namespace App\Logic;

use App\Models\SiteSettingPage;
use Illuminate\Support\Facades\DB;

class SiteSettingLogic
{
   /**
     * Get site setting page contents
     */
    public function siteSettingPageContent()
    {
        // Get site setting page contents
         $contents = SiteSettingPage::first();

        return $contents;
    }

   /**
     * Get site setting page contents
     */
    public function siteSettingPageContentById($id)
    {
        // Get site setting page contents
         $contents = SiteSettingPage::where('id', $id)->count();

        return $contents;
    }
}