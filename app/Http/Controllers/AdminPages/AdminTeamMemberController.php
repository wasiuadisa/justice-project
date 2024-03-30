<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported classes
use App\Models\Team;
use App\Logic\TeamLogic;
use App\Logic\ImageLogic;

// Import Request class
use App\Http\Requests\TeamMemberFormRequest;
use App\Http\Requests\ImageFormRequest;

class AdminTeamMemberController extends Controller
{
    /**
     * Show the form for creating new team member.
     */
    public function newTeamMember()
    {
        $pageTitle = "New team member";
        $pageTag = ", new-team-member";

        return view('admin.new-team-member', [
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Store or post new team member form resource to database.
     */
    public function newTeamMemberFormProcessing(TeamMemberFormRequest $request)
    {
        // Sanitize the request title first
        $clean_fullname = htmlspecialchars($request->input('fullname'), ENT_QUOTES);
        
        //Instanstiate post input class model
        $newTeamMember                = new Team;
 
        // Sanitize inputs
        $newTeamMember->job_title       = htmlspecialchars($request->input('title'), ENT_SUBSTITUTE);
        $newTeamMember->fullname        = $clean_fullname;
        $newTeamMember->details         = htmlspecialchars($request->input('details'), ENT_SUBSTITUTE);
        $newTeamMember->image_filename  = 'zero-image.png';
        $newTeamMember->created_at      = now();
        $newTeamMember->updated_at      = now();
        $newTeamMember->save();

        session()->flash('info', 'Good Job! Your new team member has been created, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.new-team-member-photo', [ $newTeamMember->id, ]);
    }

    /**
     * Show the form for creating a new post image.
     *
     * @return \Illuminate\Http\Response
     */
    public function newTeamMemberImage($memberID)
    {
        // Fetch form for new team member image
        $teamClass = new TeamLogic();
        $team_contents = $teamClass->teamMemberContentById($memberID);
        $pageTitle = 'New photo for ' . htmlspecialchars_decode($team_contents->fullname);

        return view('admin.image-new-for-multiple-image', [
            'team_member_contents' => $team_contents,
            'pageTitle' => $pageTitle,
            'imageResource' => 'teamMember',
        ]);
    }

    /**
     * Store a newly created post photo in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newTeamMemberImageFormProcessing(ImageFormRequest $request)
    {
        // Set form inputs as variable.
        $teamMemberID    = intval($request->input('postID'));
        $teamMemberPhoto = $request->file('image_file');

        // Check that such post exists
        if($teamMemberID == '' || $teamMemberPhoto == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The team member\'s ID and its photo don\'t exist. Stop trying to hack this website.');

            //Redirect to previous URL
            return redirect()->route('admin.teams');
        }

         /* Get team member's full details */
        // Instantiate classes
        $teamClass = new TeamLogic();
        $team_member_contents = $teamClass->teamMemberContentById($teamMemberID);

        // Check that such team member exists
        if($team_member_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The ebook you want to upload a photo for, doesn\'t exist. Stop trying to hack this website.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        // Assign a new variable name to the photo
        $image = $teamMemberPhoto; //This will have filename and its extension

        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();

        // Set the destination path
        $destinationPath = public_path('storage/public_template/images/');

        // Move the uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        // Set variables for updating image
        $dataForTeamMemberTable = array(
            'image_filename' => $hashedName,
            'created_at' => now(),
            'updated_at' => now()
        );

        // Save new team member photo file name in database
        Team::where('id', intval($teamMemberID))
            ->update($dataForTeamMemberTable);

        // Create flash message
        session()->flash('info', 'Your new photo has been saved, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.team_edit', [ $teamMemberID ]);
    }

    /**
     * Show the list of team members.
     */
    public function listTeams()
    {
        $teamClass = new TeamLogic();
        $team_contents = $teamClass->teamContents();
        $pageTitle = ' Team Members ';

        return view('admin.team-members', [
            'contents' => $team_contents,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Show the form for creating or editing Team member resource.
     */
    public function editTeamForm($id)
    {
        $teamClass = new TeamLogic();
        $team_member_contents = $teamClass->teamMemberContentById($id);
        $pageTitle = htmlspecialchars_decode($team_member_contents->fullname) . ' info for editing ';

        return view('admin.team-member', [
            'contents' => $team_member_contents,
            'pageTitle' => $pageTitle,
            'id' => $team_member_contents->id
        ]);
    }

    /**
     * Store or update team member form resource in storage.
     */
    public function storeTeamMember(TeamMemberFormRequest $request, $teamMemberID)
    {
        // Instantiate team logic class
        $teamClass = new TeamLogic();

        // Check that all checks out
        if($teamMemberID != $request->input('postID'))
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site!');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // First of all, confirm the row intended for editing exists in team member table.
        $rowExists = $teamClass->teamMemberContentById(intval($request->input('postID')));

        // In case the row doesn't exist delete all session data for this user and send him to the login page to log in, again.
        if($rowExists = 0)
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site!');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // Process variables for updating
        $dataForTeamMemberTable = array(
            //Sanitize inputs where necessary before saving to database 
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
            'fullname' => filter_var($request->input('fullname'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
            'job_title' => filter_var($request->input('title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
            'details' => filter_var($request->input('details'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        Team::where('id', intval($request->input('postID')))
            ->update($dataForTeamMemberTable);

        /*******************************************************/
        session()->flash('info', 'Good job! '. htmlspecialchars_decode($request->input('fullname')) . '\'s info has been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.team_edit', intval($request->input('postID')));
    }

    /**
     * Form for edit team member profile photo
     * $imageResource = e.g. 'Team'
     * $imageID = e.g. 3
     */
    public function imagesFormForMultipleTeams($imageResource, $imageResourceID)
    {
        // Instantiate classes
        $teamClass = new TeamLogic();
        $team_member_contents = $teamClass->teamMemberContentById($imageResourceID);

        // Decode HTML special characters in the title and make it user-friendly 
        $pageTitle = htmlspecialchars_decode($team_member_contents->fullname) . ' info ';

        return view('admin.image-edit-team-member', [
            'contents' => $team_member_contents,
            'pageTitle' => $pageTitle,
            'imageResource' => $imageResource,
            'imageID' => $imageResourceID
        ]);
    }

    /**
     * Store form data for edit team member profile photo
     * $imageResource = e.g. 'Team'
     * $imageID = e.g. 3
     */
    public function storeImagesFormForMultipleTeams(ImageFormRequest $request, $imageResource, $imageResourceID)
    {
        // Set form inputs as variable.
        $photo = $request->file('image_file');

        // Check that the URL variables exist
        if($imageResource == '' 
            || $imageResourceID == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The link you clicked is not valid. Stop trying to hack this website. STRIKE #1');

            //Redirect to previous URL
            return redirect()->route('admin.team_edit', intval($request->input('postID')));
        }

        // Check that the form variables, visible and non-visible are not null. This check is not really necesary, but for extra security, of sorts, it's being implemented. 
        if($request->input('resource') == ''
         || $request->input('specific') == '' 
         || $request->input('postID') == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The link you clicked is not valid. Stop trying to hack this website. STRIKE #2');

            //Redirect to previous URL
            return redirect()->route('admin.team_edit', intval($request->input('postID')));
        }

        // But if some variables are set at all, they must match. 
        if($request->input('resource') != $imageResource 
            || $request->input('specific') != $imageResourceID 
            || $request->input('postID') != $imageResourceID)
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The link you clicked is not valid. Stop trying to hack this website. STRIKE #3');

            //Redirect to previous URL
            return redirect()->route('admin.team_edit', intval($request->input('postID')));
        }        

        /* If the photo editing form is called, the photo should exist. Just to be sure, check that the photo exists. Get photo's filename from the database */
        $imageClass = new ImageLogic();
        $images_db_contents = $imageClass->getImageFromTableBySpecificParameter($imageResource,  $imageResourceID);

        // Check that such post exists
        if($images_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'Nice try! The team member\'s profile doesn\'t exist. Stop trying to hack this website. FINAL WARNING #1');

            //Redirect to previous URL
            return redirect()->route('admin.team_edit', intval($imageResourceID));
        }

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($images_db_contents->image_filename == '')
        {
            // Set a message to flash at the User
            session()->flash('info', 'Stop trying to hack this site! Follow the links as provided by the application. FINAL WARNING #2');

            // Redirect the User to the Login page
            return redirect()->route('admin.team_edit', intval($request->input('postID')));
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
        $pathToImageFile = $destinationPath . $images_db_contents->image_filename;

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToImageFile);

        /***********************************************************/
        // Move the NEWLY uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        /***********************************************************/
        // Set variables for updating image
        $dataForDatabaseTable = array(
            'image_filename' => $hashedName,
            'updated_at' => now()
        );

        // Save new team member's photo file name in database
        Team::where('id', $request->input('postID'))
                    ->update($dataForDatabaseTable);

        // Create flash message
        session()->flash('info', 'Great!. The team member\'s photo has been changed, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.team_edit', $request->input('postID'));
    }

    /**
     * Delete Team member resource.
     */
    public function deleteTeamMember(Request $request, $id)
    {
        // Change the required parameter variable name.
        $postID = $id;

        // Check that required parameter, team member id, is provided.
        if($postID == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'No such team member exists.');

            //Redirect to list of team members URL
            return redirect()->route('admin.teams');
        }

        // Check that the team member exists in the database by fetching the team member data using the given parameter, postID or ID.
        $imageClass = new ImageLogic();
        $images_db_contents = $imageClass->getImageFromTableBySpecificParameter('teamMember',  $postID);

        // Check that the team member data exists.
        if($images_db_contents == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('info', 'No such post exists.');

            //Redirect to previous URL
            return redirect()->route('admin.teams');
        }

        /* Set the path to the images directory and include the image file name */
        $pathToFile = public_path('storage/public_template/images/' . $images_db_contents->image_filename);

        /* Delete the image using PHP's file deleting method for deleting files */
        unlink($pathToFile);

        // Delete the team member from the database. First instantiate the logic class
        $teamClass = new TeamLogic();
        // Call the delete method of the class providing the given ID
        $teams_db_contents = $teamClass->deleteTeamMemberDataById($postID);

        // Create flash message
        session()->flash('info', 'The team member has been removed, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.teams');
    }
}
