<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported classes
use App\Models\AboutPage;
use App\Logic\AboutUsLogic;
use App\Http\Requests\AboutUsPageFormRequest;

class AdminAboutPageController extends Controller
{
    /**
     * Show the form for creating or editing About Us page resource.
     */
    public function editForm()
    {
        $aboutUsClass = new AboutUsLogic();
        $about_us_contents = $aboutUsClass->aboutUsPageContent();

        // Page title
        $pageTitle = "About page ";

        return view('admin.about-us', [
            'contents' => $about_us_contents,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Store or update form resource in storage.
     */
    public function store(AboutUsPageFormRequest $request)
    {
        // Instantiate AboutUs logic class
        $aboutUsClass = new AboutUsLogic();

        // First of all, confirm the row intended for editing exists in aboutus page table.
        $rowExists = $aboutUsClass->aboutUsPageContentById(intval($request->input('postID')));

        // In case the row doesn't exist delete all session data for this user and send him to the login page to log in, again.
        if($rowExists == 0)
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site!');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // Process variables for updating
        $dataForAboutUsPageTable = array(
            //Sanitize inputs where necessary before saving to database 
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
//            'title' => filter_var($request->input('title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
//            'description' => filter_var($request->input('description'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'subtitle' => filter_var($request->input('subtitle'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'details' => filter_var($request->input('details'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        AboutPage::where('id', $request->input('postID'))
            ->update($dataForAboutUsPageTable);

        /*******************************************************/
        session()->flash('info', 'Good job! The About page text has been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.about');
    }
}
