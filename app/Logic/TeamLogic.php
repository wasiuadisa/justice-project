<?php

namespace App\Logic;

use Illuminate\Support\Facades\DB;

// Import model classes
use App\Models\Team;
use App\Models\TeamPage;

class TeamLogic
{
   /**
     * Get team page contents
     */
    public function teamPageContent()
    {
        // Get team page contents
         $contents = TeamPage::first();

        return $contents;
    }

   /**
     * Get team member contents
     */
    public function teamContentFew($number_of__required_rows)
    {
        // Get few team contents
        $contents = Team::orderBy('id', 'asc')->take($number_of__required_rows)->get();

        return $contents;
    }

   /**
     * Get team member contents
     */
    public function teamContents()
    {
        // Get all team contents
         $contents = Team::all();

        return $contents;
    }

   /**
     * Get team page contents by id
     */
    public function teamPageContentById($id)
    {
        // Get team member contents
         $contents = Team::where('id', $id)->count();

        return $contents;
    }

   /**
     * Get a team member contents by id
     */
    public function teamMemberContentById($id)
    {
        // Get team member contents
         $contents = Team::findOrFail($id);

        return $contents;
    }

   /**
     * Delete a team member data using given id
     */
    public function deleteTeamMemberDataById($id)
    {
        // Get team member contents
//        return Team::where('id', '=', $id)->delete();
        Team::where('id', '=', $id)->delete();
    }
}