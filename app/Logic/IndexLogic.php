<?php

namespace App\Logic;

use App\Models\IndexPage;
use Illuminate\Support\Facades\DB;

class IndexLogic
{
   /**
     * Get index page contents
     */
    public function indexPageContent()
    {
        // Get index page contents
         $contents = IndexPage::first();

        return $contents;
    }

   /**
     * Get index page contents
     */
    public function indexPageContentById($id)
    {
        // Get index page contents
         $contents = IndexPage::where('id', $id)->count();

        return $contents;
    }
}