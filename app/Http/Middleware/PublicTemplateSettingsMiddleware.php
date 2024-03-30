<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Import the view facade class
use Illuminate\Support\Facades\View;

// Imported SiteSettingLogic class
use App\Logic\SiteSettingLogic;
use App\Logic\ServiceLogic;

class PublicTemplateSettingsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** Define the data to pass to all views **/
        // Instantiate SiteSettingLogic class
        $siteSettingClass = new SiteSettingLogic();

        // Fetch the site settings page data using siteSettingPageContent class
        $siteSetting_contents = $siteSettingClass->siteSettingPageContent();

        View::share('siteSettingsMiddlewareData', $siteSetting_contents);

        return $next($request);
    }
}
