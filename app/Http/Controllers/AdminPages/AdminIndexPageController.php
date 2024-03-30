<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported model class
use App\Models\IndexPage;

// Import logic class
use App\Logic\IndexLogic;
use App\Logic\ImageLogic;

// Import request class
use App\Http\Requests\HomePageFormRequest;
use App\Http\Requests\IndexPageImageFormRequest;

class AdminIndexPageController extends Controller
{
    /**
     * Show the form for editing Index page.
     */
    public function indexEditForm()
    {
        $indexClass = new IndexLogic();
        $index_contents = $indexClass->indexPageContent();

        // Set the page title
        $pageTitle = ' Home section editing';

        return view('admin.index', [
            'pageTitle' => $pageTitle,
            'index_contents' => $index_contents,
        ]);
    }

    /**
     * Store or update Index form.
     */
    public function storeIndexPage(HomePageFormRequest $request)
    {
        // Instantiate index logic class
        $indexClass = new IndexLogic();

        // First of all, confirm the row intended for editing exists in index page table.
        $rowExists = $indexClass->indexPageContentById(intval($request->input('postID')));

        // In case the row doesn't exist delete all session data for this user and send him to the login page to log in, again.
        if($rowExists == 0)
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site! The Home section data does not exist.');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // Process variables for updating
        $dataForIndexPageTable = array(
            //Sanitize inputs where necessary before saving to database 
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
            'banner_title' => filter_var($request->input('bannerTitle'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'home_title' => filter_var($request->input('homeTitle'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'home_description' => filter_var($request->input('homeDescription'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        IndexPage::where('id', $request->input('postID'))
            ->update($dataForIndexPageTable);

        /*******************************************************/
        session()->flash('info', 'Good job! The Home section info has been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.index');
    }

    /**
     * Show the form for editing banner image
     */
    public function imageFormForHomeBannerImage($postID)
    {
        $imageClass = new ImageLogic();
        $image_contents = $imageClass->getImageFromTable('homePage');

        // Check that the given postID matches the database ID of resource to change
        if($image_contents->id != $postID)
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site! The image or photo doesn\'t exist');

            // Redirect the User to the Login page
            return redirect()->route('login');            
        }

        // Set the page title
        $pageTitle = 'Banner Image editing';

        return view('admin.edit-banner-image-form', [
            'pageTitle' => $pageTitle,
            'image_contents' => $image_contents,
            'postID' => $postID,
        ]);
    }

    /**
     * Store or update form resource in storage.
     */
    public function storeImageFormForHomeBannerImage(IndexPageImageFormRequest $request)
    {
        // Set form inputs as variable.
        $photo = $request->file('image_file');
        $postID = $request->input('postID');

        // Check that the form variables, visible and non-visible are not null. This check is not really necesary, but for extra security, of sorts, it's being implemented. 
        if($postID == '' || $photo == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The link you clicked is not valid. Stop trying to hack this website. STRIKE #1');

            //Redirect to previous URL
            return redirect()->route('admin.banner_home_image_form', intval($postID));
        }

        /* If the photo editing form is called, the photo should exist. Just to be sure, check that the photo exists. Get photo's filename from the database */
        $imageClass = new ImageLogic();
        $image_db_contents = $imageClass->getImageFromTableBySpecificParameter('homePage', $postID);

        // Check that such post exists
        if($image_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The team member\'s profile doesn\'t exist. Stop trying to hack this website. FINAL WARNING #1');

            //Redirect to previous URL
            return redirect()->route('admin.banner_home_image_form', intval($postID));
        }

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($image_db_contents->banner_image == '')
        {
            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site! Follow the links as provided by the application. FINAL WARNING #2');

            // Redirect the User to the Login page
            return redirect()->route('admin.banner_home_image_form', intval($postID));
        }

        /*************************************************************/
        /* First create a NEW filename for this uploaded photo */
        // Assign a new variable name to the photo
        $image = $photo; //This will have filename and its extension

        // Hash the file name for the uploaded photo.
        //$hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();
        $hashedName = 'img_bg_4'.'.'.$image->getClientOriginalExtension();

        // Set the destination path based on the given parameter
        $destinationPath = public_path('storage/public_template/images/');

        /***********************************************************/
        /* Delete the existing photo file from the directory */
        /* Set the path to the files directory and include the file name */
        $pathToImageFile = $destinationPath . $image_db_contents->banner_image;

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToImageFile);

        /***********************************************************/
        // Move the NEWLY uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        /***********************************************************/
        // Set variables for updating image
        $dataForDatabaseTable = array(
            'banner_image' => $hashedName,
            'updated_at' => now()
        );

        // Save new photo file name in database
        IndexPage::where('id', $postID)
                    ->update($dataForDatabaseTable);

        // Create flash message
        session()->flash('info', 'Great!. The photo has been changed, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.banner_home_image_form', intval($postID));
    }
}
