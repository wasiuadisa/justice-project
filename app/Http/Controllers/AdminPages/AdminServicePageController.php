<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported model class
use App\Models\ServicePage;

// Import logic class
use App\Logic\ServiceLogic;

// Import request class
use App\Http\Requests\ServicePageFormRequest;

class AdminServicePageController extends Controller
{
    /**
     * Show the form for creating or editing Service page resource.
     */
    public function servicePageEditForm()
    {
        // Instantiate service logic class
        $servicePageClass = new ServiceLogic();
        
        // Call the method from service logic class
        $servicePage_contents = $servicePageClass->servicePageContent();

        // Set page title
        $pageTitle = ' Service section ';

        // Pass data to view file
        return view('admin.service-page', [
            'contents' => $servicePage_contents,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Store or update service page form resource in storage.
     */
    public function storeServicePageFormEdits(ServicePageFormRequest $request)
    {
        // Instantiate service logic class
        $serviceClass = new ServiceLogic();

        // First of all, confirm the row intended for editing exists in service page table.
        $rowExists = $serviceClass->servicePageContentById(intval($request->input('postID')));

        // In case the row doesn't exist delete all session data for this user and send him to the login page to log in, again.
        if($rowExists == 0)
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site!');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // Process variables for updating
        $dataForDatabaseTable = array(
            //Sanitize inputs where necessary before saving to database 
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
            'title' => filter_var($request->input('title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
            'description' => filter_var($request->input('description'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        ServicePage::where('id', $request->input('postID'))
            ->update($dataForDatabaseTable);

        /*******************************************************/
        session()->flash('info', 'Good job! The Service section info has been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.service-page');
    }
}
