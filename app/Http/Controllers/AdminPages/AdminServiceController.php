<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import models
use App\Models\Service;

// Import logic classes
use App\Logic\ServiceLogic;

// Import request classes
use App\Http\Requests\ServiceFormRequest;
use App\Http\Requests\ServiceIconFormRequest;

class AdminServiceController extends Controller
{
    /**
     * Show the form for creating new service.
     */
    public function newServiceForm()
    {
        $pageTitle = "New Service";
        $pageTag = ", new-service";

        return view('admin.new-service', [
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Store or post new service form resource to database.
     */
    public function newServiceFormProcessing(ServiceFormRequest $request)
    {
        // Assign a new variable name to the photo
        $image = $request->file('icon'); //This will have filename and its extension

        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();

        // Set the destination path
        $destinationPath = public_path('storage/public_template/images/');

        // Move the uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        // Instantiate and sanitize input class model
        $newService                = new Service;
 
        // Sanitize inputs
        $newService->icon  = $hashedName;
        $newService->title = htmlspecialchars($request->input('title'), ENT_SUBSTITUTE);
        $newService->text  = htmlspecialchars($request->input('caption'), ENT_SUBSTITUTE);
        $newService->created_at      = now();
        $newService->updated_at      = now();
        $newService->save();

        session()->flash('info', 'Good Job! The new service has been created, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.services');
    }

    /**
     * Show the list of services.
     */
    public function listServices()
    {
        $serviceClass = new ServiceLogic();
        $service_contents = $serviceClass->serviceContents();
        $pageTitle = ' Services ';

        return view('admin.services', [
            'contents' => $service_contents,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Show the form for creating or editing service resource.
     */
    public function editServiceForm($id)
    {
        $serviceClass = new ServiceLogic();
        $service_contents = $serviceClass->serviceContentById($id);
        $pageTitle = 'Editing ' . ucwords(htmlspecialchars_decode($service_contents->title)) . '\'s service info';

        return view('admin.edit-service', [
            'contents' => $service_contents,
            'pageTitle' => $pageTitle,
            'id' => $service_contents->id
        ]);
    }

    /**
     * Store or update service form resource in storage.
     */
    public function storeServiceForm(ServiceFormRequest $request, $serviceID)
    {
        // Check that all checks out
        if($serviceID == '')
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site!');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // Instantiate service logic class
        $serviceClass = new ServiceLogic();

        // First of all, confirm the row intended for editing exists in marketing pitch table.
        $rowExists = $serviceClass->serviceContentById(intval($serviceID));

        // In case the row doesn't exist delete all session data for this user and send him to the login page to log in, again.
        if($rowExists = 0)
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site!');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // Process variables for updating
        $dataForServiceTable = array(
            //Sanitize inputs where necessary before saving to database
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
            'title' => filter_var($request->input('title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
            'text' => filter_var($request->input('caption'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        Service::where('id', $serviceID)
            ->update($dataForServiceTable);

        /*******************************************************/
        session()->flash('info', 'Good job! '. htmlspecialchars_decode($request->input('title')) . '\'s service info has been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.service_edit', $serviceID);
    }

    /**
     * Edit form for service icon change
     * $imageResource = e.g. 'Team'
     * $imageID = e.g. 3
     */
    public function editServiceIconForm($id)
    {
        // Instantiate classes
        $serviceClass = new ServiceLogic();
        $service_contents = $serviceClass->serviceContentById($id);

        // Decode HTML special characters in the title and make it user-friendly 
        $pageTitle = 'Changing ' . htmlspecialchars_decode($service_contents->title) . '\'s icon ';

        return view('admin.edit-service-icon', [
            'contents' => $service_contents,
            'postID' => $service_contents->id,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * $imageResource = e.g. 'Testimonial'
     * $imageID = e.g. 3
     */
    public function storeServiceIconForm(ServiceIconFormRequest $request, $imageResourceID)
    {
        // Set form inputs as variable.
        $photo = $request->file('icon');

        // Check that the URL variables exist
        if($imageResourceID == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The link you clicked is not valid. Stop trying to hack this website. STRIKE #1');

            //Redirect
            return redirect()->route('admin.services');
        }

        /* If the photo editing form is called, the photo should exist. Just to be sure, check that the photo exists. Get photo's filename from the database */
        $imageClass = new ServiceLogic();
        $images_db_contents = $imageClass->serviceContentById($imageResourceID);

        // Check that such post exists
        if($images_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The testimonial\'s profile doesn\'t exist. Stop trying to hack this website. FINAL WARNING #1');

            //Redirect to previous URL
            return redirect()->route('admin.services');
        }

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($images_db_contents->icon == '')
        {
            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site! Follow the links as provided by the application. FINAL WARNING #2');

            // Redirect the User to the Login page
            return redirect()->route('admin.services', intval($request->input('postID')));
        }

        /*************************************************************/
        /* First create a NEW filename for this uploaded photo */
        // Assign a new variable name to the photo
        $image = $photo; //This will have filename and its extension

        // Hash the file name for the uploaded photo.
        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();

        // Set the destination path based on the given parameter
        $destinationPath = public_path('storage/public_template/images/');

        /***********************************************************/
        /* Delete the existing photo file from the directory */
        /* Set the path to the files directory and include the file name */
        $pathToImageFile = $destinationPath . $images_db_contents->icon;

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToImageFile);

        /***********************************************************/
        // Move the NEWLY uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        /***********************************************************/
        // Set variables for updating image
        $dataForDatabaseTable = array(
            'icon' => $hashedName,
            'updated_at' => now()
        );

        // Save new team member's photo file name in database
        Service::where('id', $imageResourceID)
                    ->update($dataForDatabaseTable);

        // Create flash message
        session()->flash('info', 'Great!. The service icon\'s photo has been changed, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.service-icon_edit', $imageResourceID);
    }

    /**
     * Delete service icon resource.
     */
    public function deleteService(Request $request, $id)
    {
        // Change the required parameter variable name.
        $postID = $id;

        // Check that required parameter, service id, is provided.
        if($postID == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'No such service exists.');

            //Redirect to list of service URL
            return redirect()->route('admin.services');
        }

        // Check that the service exists in the database by fetching the service data using the given parameter, postID or ID.
        $serviceClass = new ServiceLogic();

        // Get the 
        $images_db_contents = $serviceClass->serviceContentById(intval($id));

        // Check that the service icon data exists.
        if($images_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'No such service exists.');

            //Redirect to previous URL
            return redirect()->route('admin.services');
        }

        /* Set the path to the images directory and include the image file name */
        $pathToFile = public_path('storage/public_template/images/' . $images_db_contents->icon);

        /* Delete the image using PHP's file deleting method for deleting files */
        unlink($pathToFile);

        // Delete the service from the database. First instantiate the logic class
        $serviceClass = new ServiceLogic();
        // Call the delete method of the class providing the given ID
        $serviceClass->deleteServiceDataById($postID);

        // Create flash message
        session()->flash('info', 'The service has been removed, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.services');
    }
}
