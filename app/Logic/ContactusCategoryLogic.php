<?php

namespace App\Logic;

use App\Models\Contactuscategorys;
use Illuminate\Support\Facades\DB;

class ContactusCategoryLogic
{
   /**
     * Get list of category names
     */
    public function listAllContactUsCategoryNames()
    {
        //Fetch names of categories
         $categories = DB::table('contactuscategorys')->where([
            ['blocked', 0], ['deleted', 0]
        ])->pluck('name');

        return $categories;
    }

   /**
     * Get list of categories
     */
    public function listAllContactUsCategories()
    {
        //Fetch names of categories
         $categories = Contactuscategorys::where([
            ['blocked', 0], ['deleted', 0]
        ])->get();

        return $categories;
    }

   /**
     * Get category ID
     */
    public function getIdOfContactUsCategoryName($givenCategory)
    {
        //Fetch names of categories
         $category_id = Contactuscategorys::where([
            ['name', $givenCategory],
        ])->value('id');

        return $category_id;
    }
}
