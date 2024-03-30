<?php

namespace App\Logic;

use App\Models\AboutPage;
use Illuminate\Support\Facades\DB;

class AboutUsLogic
{
   /**
     * Get about us page contents
     */
    public function aboutUsPageContent()
    {
        // Get about us page contents
         $contents = AboutPage::first();

        return $contents;
    }

   /**
     * Get about us page contents
     */
    public function aboutUsPageContentById($id)
    {
        // Get about us page contents
         $contents = AboutPage::where('id', $id)->count();

        return $contents;
    }
}