<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imported classes
use App\Logic\IndexLogic;
use App\Logic\ContactusLogic;
use App\Logic\SiteSettingLogic;

class ContactUsPageController extends Controller
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

        // Instantiate Contactus logic class
        $contactusClass = new ContactusLogic();
        // Call method for all Contactus page data from Contactus logic
        $contactus_page_contents = $contactusClass->contactUsPageContent();

        // Initiate the site settings logic class
        $siteSettingClass = new SiteSettingLogic();
        // Get the full data of site setting table
        $site_setting_contents = $siteSettingClass->siteSettingPageContent();

        // Set page title
        $pageTitle = ' Contact us ';

        // Set page title
        return view('public.contactus', [
            'pageTitle' => $pageTitle,
            'index_contents' => $index_contents,
            'contactus_page_contents' => $contactus_page_contents,
//            'site_setting_contents' => $site_setting_contents,
        ]);
    }
}
