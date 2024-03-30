<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported class for deleting file in stroage
use Illuminate\Support\Facades\Storage;

// Imported model classes
use App\Models\AboutPage;
use App\Models\IndexPage;
use App\Models\SiteSetting;
use App\Models\Team;
use App\Models\TeamPage;
use App\Models\Testimonial;
use App\Models\BlogImage;

// Imported logic classes
use App\Logic\ImageLogic;

// Imported request classes
use App\Http\Requests\ImageFormRequest;

class ImageController extends Controller
{
    /**
     * Show the form for creating or editing image resource.
     */
    public function imagesForm($imageResource, $imageSpecific)
    {
        $imageClass = new ImageLogic();
        $images_contents = $imageClass->getImageFromTable($imageResource);

        return view('admin.image-edit', [
            'contents' => $images_contents,
            'imageResource' => $imageResource,
            'imageSpecific' => $imageSpecific,
            'postID' => $images_contents->id,
        ]);
    }

    /**
     * Show the form for creating or editing image for multiple rows resource.
     */
    public function imagesFormForTableWithMultipleRows($imageResource, $imageSpecific)
    {
        $imageClass = new ImageLogic();
        $images_contents = $imageClass->getImageFromTableBySpecificParameter($imageResource, $imageSpecific);

        return view('admin.image-edit-for-multiple-image', [
            'contents' => $images_contents,
            'imageResource' => $imageResource,
            'imageSpecific' => $imageSpecific,
            'postID' => $images_contents->id,
        ]);
    }

    /**
     * Store or update form resource in storage.
     */
    public function imagesStore(ImageFormRequest $request, $imageResource, $imageSpecific)
    {
        // Set form inputs as variable.
        $photo     = $request->file('image_file');

        // Check that needed variables exist
        if($imageResource == '' || $imageSpecific == '' || $photo == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'Nice try! The link you clicked is not valid. Stop trying to hack this website.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        /* If the photo editing form is called, the photo should exist. Just to be sure, check that the photo exists. Get photo's filename from the database */
        $imageClass = new ImageLogic();
        $images_db_contents = $imageClass->getImageFromTable($imageResource);

        // Check that such post exists
        if($images_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'Nice try! The photo you want to replace ddoesn\'t exist. Stop trying to hack this website.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($images_db_contents->$imageSpecific == '')
        {
            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site! Follow the links as provided by the application.');

            // Redirect the User to the Login page
            return redirect()->route('dashboard');
        }

        /*************************************************************/
        /* First create a NEW filename for this uploaded photo */
        // Assign a new variable name to the photo
        $image = $photo; //This will have filename and its extension

        // Hash the file name for the uploaded photo.
        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();

        // Set the destination path based on the given parameter

        // $resourceName may either be a table or a page name
        switch ($imageResource)
        {
            case 'aboutPage':
                // Get image data
                $destinationPath = public_path('storage/public_template/images/');
                break;
            case 'homePage':
                // Get image data
                $destinationPath = public_path('storage/public_template/images/');
                break;
            case 'setting':
                // Get image data
                $destinationPath = public_path('storage/public_template/images/');
                break;
            case 'teamPage':
                // Get image data
                $destinationPath = public_path('storage/public_template/images/');
            case 'teamMember':
                // Get image data
                $destinationPath = public_path('storage/admin_template/images/team/');
                break;
            case 'testimonial':
                // Get image data
                $destinationPath = public_path('storage/public_template/images/');
                break;
            default:
                $destinationPath = public_path('storage/public_template/images/');
                break;
        }

        /***********************************************************/
        /* Delete the existing photo file from the directory */
        /* Set the path to the files directory and include the file name */
        $pathToImageFile = $destinationPath . $images_db_contents->$imageSpecific;

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToImageFile);

        /***********************************************************/
        // Move the NEWLY uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        $imageSpecificStrToLower = strtolower($imageSpecific);

        /***********************************************************/
        // Set variables for updating image
        $dataForDatabaseTable = array(
            "$imageSpecificStrToLower" => $hashedName,
            'updated_at' => now()
        );

        // $resourceName may either be a table or a page name
        switch ($imageResource)
        {
            case 'aboutPage':
                // Save new photo file name in database
                AboutPage::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);
                break;
            case 'homePage':
                // Save new photo file name in database
                IndexPage::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);
                break;
            case 'setting':
                // Save new photo file name in database
                SiteSetting::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);
                break;
            case 'team':
                // Save new photo file name in database
                TeamPage::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);
                break;
            case 'teamMember':
                // Save new photo file name in database
                Team::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);
                break;
            case 'testimonial':
                // Save new photo file name in database
                Testimonial::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);
                break;
            default:
                // Save new photo file name in database
                BlogImage::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);
                break;
        }

        // Create flash message
        session()->flash('info', 'Great!. The photo has been changed, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.about');
    }
}
