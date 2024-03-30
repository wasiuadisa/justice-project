<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import model classes
use App\Models\IndexPage;

// Imported classes
use App\Logic\IndexLogic;
use App\Logic\AboutUsLogic;
use App\Logic\ServiceLogic;
use App\Logic\TeamLogic;
use App\Logic\ContactusCategoryLogic;
use App\Logic\ContactusLogic;
use App\Logic\SiteSettingLogic;

class IndexPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Instantiate Index logic class
        $indexClass = new IndexLogic();
        // Call method for Index page data from About Us logic
        $index_contents = $indexClass->indexPageContent();

        // Instantiate About Us logic class
        $aboutUsClass = new AboutUsLogic();
        // Call method for About Us page data from About Us logic
        $about_us_contents = $aboutUsClass->aboutUsPageContent();

        // Instantiate services logic class
        $serviceClass = new ServiceLogic();
        // Call method for all services page data from services logic
        $service_page_contents = $serviceClass->servicePageContent();
        // Call method for all services data from services logic
        $service_contents = $serviceClass->serviceContents();

        // Instantiate Team logic class
        $teamClass = new TeamLogic();
        // Call method for all team page data from Team logic
        $team_page_contents = $teamClass->teamPageContent();
        // Call method for all Team data from Team logic
        $team_contents = $teamClass->teamContentFew(3);

        // Instantiate Contactus logic class
        $contactusClass = new ContactusLogic();
        // Call method for all Contactus page data from Contactus logic
        $contactus_page_contents = $contactusClass->contactUsPageContent();

        // Initiate the Contactus Category Logic class
        $categoriesClass = new ContactusCategoryLogic();
        // Get the list of all contact us categories
        $list_of_categories = $categoriesClass->listAllContactUsCategories();

        // Initiate the site settings logic class
        $siteSettingClass = new SiteSettingLogic();
        // Get the full data of site setting table
        $site_setting_contents = $siteSettingClass->siteSettingPageContent();

        // Set page title
        $pageTitle = ' Home ';

        // Set page title
        return view('public.index', [
            'pageTitle' => $pageTitle,
            'index_contents' => $index_contents,
            'about_us_contents' => $about_us_contents,
            'team_page_contents' => $team_page_contents,
            'teams' => $team_contents,
            'service_page_contents' => $service_page_contents,
            'service_contents' => $service_contents,
            'contactus_page_contents' => $contactus_page_contents,
            'site_setting_contents' => $site_setting_contents,
            'categories' => $list_of_categories,
        ]);
    }
}
