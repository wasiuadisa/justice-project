<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported model class
use App\Models\SiteSettingPage;
use App\Models\ContactusPage;

// Import logic class
use App\Logic\SiteSettingLogic;
use App\Logic\ContactusLogic;
use App\Logic\ImageLogic;

// Import request class
use App\Http\Requests\SiteSettingPageFormRequest;
use App\Http\Requests\SiteSettingLogoFormRequest;
use App\Http\Requests\ImageFormRequest;

class AdminSiteSettingsController extends Controller
{
    /**
     * Show the form for editing Site Setting texts page.
     */
    public function siteSettingsEditForm()
    {
        // Initiate Site Settings logic class
        $siteSettingClass = new SiteSettingLogic();
        // Call method to fetch site settings page contents
        $siteSetting_contents = $siteSettingClass->siteSettingPageContent();

        // Initiate Contact Us logic class
        $contactusPageClass = new ContactusLogic();
        // Call method to fetch contact us page contents
        $contactusPage_contents = $contactusPageClass->contactUsPageContent();

        // Set the page title
        $pageTitle = ' Site Settings page editing';

        return view('admin.site-setting', [
            'pageTitle' => $pageTitle,
            'site_setting_contents' => $siteSetting_contents,
            'contactusPage_contents' => $contactusPage_contents,
        ]);
    }

    /**
     * Store or update site settings texts form.
     */
    public function storeSiteSettingsEditForm(SiteSettingPageFormRequest $request)
    {
        // Instantiate site setting logic class
        $siteSettingClass = new SiteSettingLogic();

        // First of all, confirm the row intended for editing exists in site setting page table.
        $rowExists = $siteSettingClass->siteSettingPageContentById(intval($request->input('postID')));

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
        $dataForSiteSettingPageTable = array(
            //Sanitize inputs where necessary before saving to database 
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
            'url_facebook' => filter_var($request->input('url_facebook'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'url_twitter' => filter_var($request->input('url_twitter'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'url_linkedin' => filter_var($request->input('url_linkedin'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'url_picassa' => filter_var($request->input('url_dribble'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        // Process variables for updating
        $dataForContactUsPageTable = array(
            //Sanitize inputs where necessary before saving to database 
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
            'title' => filter_var($request->input('contact_title'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'details' => filter_var($request->input('contact_details'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'contact_address' => filter_var($request->input('contact_address'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'contact_phone' => filter_var($request->input('contact_phone'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'contact_email' => filter_var($request->input('contact_email'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'contact_website' => filter_var($request->input('contact_website'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        // Commit the fields to the database
        SiteSettingPage::where('id', $request->input('postID'))
            ->update($dataForSiteSettingPageTable);


        // It's assumed the $postID is the same as the one for the siteSettings $postID. Commit the fields to the database
        ContactusPage::where('id', $request->input('postID'))
            ->update($dataForContactUsPageTable);

        // Save the Recaptcha keys in the environment file
        // Do it here
        /*******************************************************/
        session()->flash('info', 'Good job! The Site Setting and Contact Us sections info have been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.settings');
    }

    /**
     * Show the form for editing site setting logo image
     */
    public function imageFormForSiteLogoImage($postID)
    {
        $imageClass = new ImageLogic();
        $image_contents = $imageClass->getImageFromTable('settingPage');

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
        $pageTitle = 'Site Logo editing';

        return view('admin.edit-logo-image-form', [
            'pageTitle' => $pageTitle,
            'image_contents' => $image_contents,
            'postID' => $postID,
        ]);
    }

    /**
     * Store or update form  logo in storage.
     */
    public function storeImageFormForSiteLogo(SiteSettingLogoFormRequest $request)
    {
        // Set form inputs as variable.
        $photo = $request->file('logo');
        $alt_text = $request->input('logo_alt_text');
        $postID = $request->input('postID');

        // Check that the form variables, visible and non-visible are not null. This check is not really necesary, but for extra security, of sorts, it's being implemented. 
        if($postID == '' || $photo == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The link you clicked is not valid. Stop trying to hack this website. STRIKE #1');

            //Redirect to previous URL
            return redirect()->route('admin.site_logo_image_form', intval($postID));
        }

        /* If the photo editing form is called, the photo should exist. Just to be sure, check that the photo exists. Get photo's filename from the database */
        $imageClass = new ImageLogic();
        $image_db_contents = $imageClass->getImageFromTableBySpecificParameter('settingPage', $postID);

        // Check that such post exists
        if($image_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The data or info doesn\'t exist. Stop trying to hack this website. FINAL WARNING #1');

            //Redirect to previous URL
            return redirect()->route('admin.site_logo_image_form', intval($postID));
        }

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($image_db_contents->header_logo_filename == '')
        {
            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site! Follow the links as provided by the application. FINAL WARNING #2');

            // Redirect the User to the Login page
            return redirect()->route('admin.site_logo_image_form', intval($postID));
        }

        /*************************************************************
                    "ALL IZ WELL"
        /* First create a NEW filename for this uploaded photo */
        // Assign a new variable name to the photo
        $image = $photo; //This will have filename and its extension

        // Hash the file name for the uploaded photo.
        //$hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();
        $hashedName = 'logo'.'.'.$image->getClientOriginalExtension();

        // Set the destination path based on the given parameter
        $destinationPath = public_path('storage/public_template/images/');

        /***********************************************************/
        /* Delete the existing photo file from the directory */
        /* Set the path to the files directory and include the file name */
        $pathToImageFile = $destinationPath . $image_db_contents->header_logo_filename;

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToImageFile);

        /***********************************************************/
        // Move the NEWLY uploaded & named photo to destination folder
        $image->move($destinationPath, $hashedName);

        /***********************************************************/
        // Set variables for updating image
        $dataForDatabaseTable = array(
            'header_logo_filename' => $hashedName,
            'header_logo_alt_text' => filter_var($alt_text, FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        // Save new photo file name in database
        SiteSettingPage::where('id', $postID)
                    ->update($dataForDatabaseTable);

        // Create flash message
        session()->flash('info', 'Great!. The Logo has been changed, successfully.');

        //Redirect to a route's name
//        return redirect()->route('admin.site_logo_image_form', intval($postID));
        return redirect()->route('admin.settings');
    }

    /**
     * Show the form for editing site setting favicon image
     */
    public function imageFormForSiteFavicon($postID)
    {
        $imageClass = new ImageLogic();
        $image_contents = $imageClass->getImageFromTable('settingPage');

        // Check that the given postID matches the database ID of resource to change
        if($image_contents->id != $postID)
        {
            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site! Follow the links as provided by the application. FINAL WARNING #1');

            // Redirect the User to the Login page
            return redirect()->route('admin.settings');
        }

        // Set the page title
        $pageTitle = 'Site Favicon editing';

        return view('admin.edit-favicon-image-form', [
            'pageTitle' => $pageTitle,
            'image_contents' => $image_contents,
            'postID' => $postID,
        ]);
    }

    /**
     * Store or update form for site favicon in storage.
     */
    public function storeImageFormForSiteFavicon(ImageFormRequest $request)
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
            return redirect()->route('admin.site_favicon_image_form', intval($postID));
        }

        /* If the photo editing form is called, the photo should exist. Just to be sure, check that the photo exists. Get photo's filename from the database */
        $imageClass = new ImageLogic();
        $image_db_contents = $imageClass->getImageFromTableBySpecificParameter('settingPage', $postID);

        // Check that such post exists
        if($image_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The data or info doesn\'t exist. Stop trying to hack this website. FINAL WARNING #1');

            //Redirect to previous URL
            return redirect()->route('admin.site_favicon_image_form', intval($postID));
        }

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($image_db_contents->favicon_logo == '')
        {
            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site! Follow the links as provided by the application. FINAL WARNING #2');

            // Redirect the User to the Login page
            return redirect()->route('admin.site_favicon_image_form', intval($postID));
        }

        /*************************************************************/
        /* First create a NEW filename for this uploaded photo */
        // Assign a new variable name to the photo
        $image = $photo; //This will have filename and its extension

        // Hash the file name for the uploaded photo.
        //$hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();
        $hashedName = 'favicon'.'.'.$image->getClientOriginalExtension();

        // Set the destination path based on the given parameter
        $destinationPath = public_path('storage/public_template/images/');

        /***********************************************************/
        /* Delete the existing photo file from the directory */
        /* Set the path to the files directory and include the file name */
        $pathToImageFile = $destinationPath . $image_db_contents->favicon_logo;

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToImageFile);

        /***********************************************************/
        // Move the NEWLY uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);
//        $image->move($destinationPath, 'banner_bg.PNG');

        /***********************************************************/
        // Set variables for updating image
        $dataForDatabaseTable = array(
            'favicon_logo' => $hashedName,
            'updated_at' => now()
        );

        // Save new photo file name in database
        SiteSettingPage::where('id', $postID)
                    ->update($dataForDatabaseTable);

        // Create flash message
        session()->flash('info', 'Great!. The Favicon image has been changed, successfully.');

        //Redirect to a route's name
//        return redirect()->route('admin.site_favicon_image_form', intval($postID));
        return redirect()->route('admin.settings');
    }
}
