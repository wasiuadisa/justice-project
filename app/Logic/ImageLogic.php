<?php

namespace App\Logic;

use Illuminate\Support\Facades\DB;

// Imported model classes
use App\Models\AboutPage;
use App\Models\IndexPage;
use App\Models\SiteSettingPage;
use App\Models\Team;
use App\Models\TeamPage;
use App\Models\Testimonial;
use App\Models\BlogImage;

class ImageLogic
{
   /**
     * Get image data
     */
    public function getImageFromTable($tableName)
    {
        // $resourceName may either be a table or a page name
        switch ($tableName) {
            case 'aboutPage':
                // Get image data
                $contents = AboutPage::first();
                break;
            case 'homePage':
                // Get image data
                $contents = IndexPage::first();
            case 'teamPage':
                // Get image data
                $contents = TeamPage::first();
                break;
            case 'settingPage':
                // Get image data
                $contents = SiteSettingPage::first();
                break;
            default:
                $contents = SiteSettingPage::first();
        }

        return $contents;
    }

   /**
     * Get photo info using imageResource and profile ID
     */
    public function getImageFromTableBySpecificParameter($imageResource, $profileID)
    {
        // $resourceName may either be a table or a page name
        switch ($imageResource) {
            case 'homePage':
                // Get image data
                $contents = IndexPage::where('id', $profileID)->first();
                break;
            case 'settingPage':
                // Get image data
                $contents = SiteSettingPage::where('id', $profileID)->first();
                break;
            case 'teamMember':
                // Get image data
                $contents = Team::where('id', $profileID)->first();
                break;
            case 'testimonial':
                // Get image data
                $contents = Testimonial::where('id', $profileID)->first();
                break;
            default:
                $contents = Testimonial::where('id', $profileID)->first();
        }

        return $contents;
    }

   /**
     * Update photo name using imageResource and photo filename
     */
    public function updateOnlyPostPhotoFileName($imageResource, $imageSpecific, $filename)
    {
        // $resourceName may either be a table or a page name
        switch ($imageResource)
        {
            case 'aboutPage':
                // Get image data
                $contents = AboutPage::update([
                        $imageSpecific => $fileName
                    ]);
                break;
            case 'homePage':
                // Get image data
                $contents = IndexPage::update([
                        $imageSpecific => $fileName
                    ]);
                break;
            case 'settingPage':
                // Get image data
                $contents = SiteSettingPage::update([
                        $imageSpecific => $fileName
                    ]);
                break;
            case 'teamPage':
                // Get image data
                $contents = TeamPage::update([
                        $imageSpecific => $fileName
                    ]);
                break;
            case 'setting':
                // Get image data
                $contents = SiteSetting::update([
                        $imageSpecific => $fileName
                    ]);
                break;
            case 'testimonial':
                // Get image data
                $contents = Testimonial::update([
                        $imageSpecific => $fileName
                    ]);
                break;
            default:
                $contents = BlogImage::update([
                        $imageSpecific => $fileName
                    ]);
        }

        return $contents;
    }
}