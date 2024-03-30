<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Import the view facade class
use Illuminate\Support\Facades\View;

// Imported SiteSettingLogic class
//use App\Logic\ServiceLogic;

// Imported ContactusLogic class
use App\Logic\ContactusLogic;

class PublicTemplateServicesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** Define the data to pass to all views **/
        // Instantiate service logic class
//        $serviceClass = new ServiceLogic();

        // Call method for all services data from services logic
//        $service_contents = $serviceClass->serviceContents();

        // Instantiate contact logic class
        $contactusClass = new ContactusLogic();

        // Call method for all contactus page data from contactus logic
        $contactus_page_contents = $contactusClass->contactusPageContent();

//        View::share('servicesMiddlewareData', $service_contents);
        View::share([
//            'servicesMiddlewareData' => $service_contents,
            'contactusPageMiddlewareData' => $contactus_page_contents,
        ]);

        return $next($request);
    }
}
