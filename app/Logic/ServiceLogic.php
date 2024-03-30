<?php

namespace App\Logic;

use Illuminate\Support\Facades\DB;

// Import model classes
use App\Models\Service;
use App\Models\ServicePage;

class ServiceLogic
{
   /**
     * Get service page contents
     */
    public function servicePageContent()
    {
        // Get service page contents
         $contents = ServicePage::first();

        return $contents;
    }

   /**
     * Get services contents
     */
    public function serviceContentFew($number_of__required_rows)
    {
        // Get few service contents
        $contents = Service::orderBy('id', 'asc')->take($number_of__required_rows)->get();

        return $contents;
    }

   /**
     * Get services contents
     */
    public function serviceContents()
    {
        // Get all service contents
         $contents = Service::all();

        return $contents;
    }

   /**
     * Get service page contents by id
     */
    public function servicePageContentById($id)
    {
        // Get service page contents
         $contents = Service::where('id', $id)->count();

        return $contents;
    }

   /**
     * Get a services contents by id
     */
    public function serviceContentById($id)
    {
        // Get service contents 
        $contents = Service::findOrFail($id);

        return $contents;
    }

   /**
     * Get a services column data by id
     */
    public function getSpecificServiceDataById($id, $column)
    {
        // Get service contents 
         $contents = Service::where('id', $id)->pluck($column);

        return $contents;
    }

   /**
     * Delete a service data using given id
     */
    public function deleteServiceDataById($id)
    {
        // Get service contents
//        return Service::where('id', '=', $id)->delete();
        Service::where('id', '=', $id)->delete();
    }
}