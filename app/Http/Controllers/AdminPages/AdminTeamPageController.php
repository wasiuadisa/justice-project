<?php

namespace App\Http\Controllers\AdminPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported model class
use App\Models\TeamPage;

// Import logic class
use App\Logic\TeamLogic;

// Import request class
use App\Http\Requests\TeamPageFormRequest;

class AdminTeamPageController extends Controller
{
    /**
     * Show the form for creating or editing Team page resource.
     */
    public function editTeamPageForm()
    {
        $teamClass = new TeamLogic();
        $team_contents = $teamClass->teamPageContent();
        $pageTitle = ' Team section ';

        return view('admin.team-page', [
            'contents' => $team_contents,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Store or update team page form resource in storage.
     */
    public function storeTeamPageForm(TeamPageFormRequest $request)
    {
        // Instantiate team logic class
        $teamClass = new TeamLogic();

        // First of all, confirm the row intended for editing exists in team page table.
        $rowExists = $teamClass->teamPageContentById(intval($request->input('postID')));

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
        $dataForDatabaseTable = array(
            //Sanitize inputs where necessary before saving to database 
            //////////////////////////////////////
            /// Clean up variables for database //
            //////////////////////////////////////
            'title' => filter_var($request->input('title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
            'text' => filter_var($request->input('text'), FILTER_SANITIZE_SPECIAL_CHARS,           FILTER_FLAG_ENCODE_LOW),
            'updated_at' => now()
        );

        TeamPage::where('id', $request->input('postID'))
            ->update($dataForDatabaseTable);

        /*******************************************************/
        session()->flash('info', 'Good job! The Team page text has been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('admin.team-page');
    }
}
