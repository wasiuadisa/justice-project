<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import model class
use App\Models\Contactus;

// Import class for list of categories
use App\Logic\ContactusCategoryLogic;
use App\Logic\SiteSettingLogic;
use App\Logic\ContactusLogic;

// Import validation for Contact Us form
use App\Http\Requests\ContactUsFormRequest;

class ContactPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Initiate the site settings logic class
        $siteSettingClass = new SiteSettingLogic();
        // Get the full data of site setting table
        $site_setting_contents = $siteSettingClass->siteSettingPageContent();

        // Initiate the Contactus Category Logic class
        $categoriesClass = new ContactusCategoryLogic();
        // Get the list of all contact us categories
        $list_of_categories = $categoriesClass->listAllContactUsCategories();

        // Set the page title
        $pageTitle = ' Contact Us ';

        return view('public.contactus', [
            'site_setting_contents' => $site_setting_contents,
//            'contact_us_contents' => $contact_us_contents,
            'categories' => $list_of_categories,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactUsFormRequest $request)
    {
        // If configuration setting for reCaptcha, captcha_setting, is set to true, implement reCaptcha.
        if(config('app.captcha_setting') == true)
        {
            if(config('app.captcha_setting_test') == false)
            {
                // Set the given reCaptcha response to a variable
                $captcha = $request->input('g-recaptcha-response');

                if( config('app.captcha_setting_test') == false )
                {
                    $secretKey = config('app.recaptchaGenuineSecret');
                }
                else {
                        $secretKey = config('app.recaptchaSampleSecret');
                }

                // Send parameters to verify reCaptcha API key authenticity        
                $response = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $captcha . '&remoteip=' . $_SERVER['REMOTE_ADDR']), true);

                if($response['success'] == false)
                {
                    // Put CAPTCHA error in a variable.
                    $validation = 'Your response to the CAPTCHA is incorrect.';

                    //The reCaptcha response is incorrect
                    return redirect('public_contactus')->withInput()->withErrors($validation);
                }
            }// End of config('captcha_setting_test')
        }// End of config('captcha_setting')

        // Fetch the ID for the given category
        $contactUsCategoriesClass = new ContactusCategoryLogic();
        $category_id = $contactUsCategoriesClass->getIdOfContactUsCategoryName(
                filter_var($request->input('category'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW)
            );

        //Considering 'All iz well', proceed with saving the form entry.
        $contactus                   = new Contactus;

        //Sanitize inputs
        $contactus->blocked          = 0;
        $contactus->contactuscategorys_id = $category_id;// Default, 1 = No chosen category
        $contactus->read             = 0;
        $contactus->firstname        = filter_var($request->input('firstname'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $contactus->surname          = filter_var($request->input('surname'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $contactus->phone            = filter_var($request->input('phone'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $contactus->email            = filter_var($request->input('email'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $contactus->title            = filter_var($request->input('title'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $contactus->message          = filter_var($request->input('message'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $contactus->created_at       = now();
        $contactus->updated_at       = now();
        $contactus->save();

        $request->session()->flash('contactUsInfo', 'Your message has been mailed successfully!');

        //Processing finished, return to ReCaptcha Contact Us form
/*        return view('public.contactus', [
            'categories' => $list_of_categories,
          ]);
*/
        return redirect()->route('public_contactus', [ 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
