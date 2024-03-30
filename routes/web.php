<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

#########################################
#### Public area routes' controllers ####
#########################################
use App\Http\Controllers\PublicPages\IndexPageController;
use App\Http\Controllers\PublicPages\ContactUsPageController;
use App\Http\Controllers\PublicPages\ContactPageController;

#########################################
##### Admin area routes' controllers ####
#########################################
use App\Http\Controllers\AdminPages\AdminIndexPageController;
use App\Http\Controllers\AdminPages\AdminAboutPageController;

use App\Http\Controllers\AdminPages\ImageController;
use App\Http\Controllers\AdminPages\AdminServiceController;
use App\Http\Controllers\AdminPages\AdminServicePageController;
use App\Http\Controllers\AdminPages\AdminTeamPageController;
use App\Http\Controllers\AdminPages\AdminTeamMemberController;

use App\Http\Controllers\AdminPages\AdminSiteSettingsController;
/*
use App\Http\Controllers\AdminPages\AdminVariousImageController;
*/

#########################################
##### Import Midlleware  for routes #####
#########################################
use App\Http\Middleware\PublicTemplateSettingsMiddleware;
use App\Http\Middleware\PublicTemplateServicesMiddleware;

/*
|------------------------------------------------------------------------
| Web Routes
|------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

// All public routes
Route::middleware([PublicTemplateSettingsMiddleware::class, PublicTemplateServicesMiddleware::class])->group(function () {
    //Test page
    Route::get('/test', function () {
        return view('errors.429');
    })->name('test');

    // Index or Landing page
    Route::get('/', IndexPageController::class)->name('index');

    // Contact Us page
    Route::post('/contact-us', [ContactPageController::class, 'store'])->name('public_contactus_post');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->prefix('admin')->group(function () {
Route::middleware([PublicTemplateSettingsMiddleware::class, PublicTemplateServicesMiddleware::class])->middleware('auth')->prefix('admin')->group(function () {

//Route::middleware('auth')->prefix('admin')->group(function () {
    #########################################
    ##### Default user profile editing ######
    ######### updating & deleting ###########
    #########################################
    // User profile edit form
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // User profile edit form processing
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // User profile deletion
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    #######################################
    ## Home section routes & controllers ##
    #######################################
    // Home page text edit form
    Route::get('/home-page', [AdminIndexPageController::class, 'indexEditForm'])->name('admin.index');
    // Home page text edit form processing
    Route::post('/home-page', [AdminIndexPageController::class, 'storeIndexPage'])->name('admin.index_post');

    // Home page banner image edit form
    Route::get('/home-page-banner-image/{postID}', [AdminIndexPageController::class, 'imageFormForHomeBannerImage'])->name('admin.banner_home_image_form');
    // Home page banner image edit form processing
    Route::post('/home-page-banner-image', [AdminIndexPageController::class, 'storeImageFormForHomeBannerImage'])->name('admin.store_banner_home_image_form');

    #########################################
    ###### Image(s) processing routes #######
    ############## & controllers ############
    #########################################
    // Images edit form
    Route::get('/images/{imageResource?}/{imageSpecific?}', [ImageController::class, 'imagesForm'])->name('admin.image_form');
    // Images edit form processing
    Route::post('/images/{imageResource?}/{imageSpecific?}', [ImageController::class, 'imagesStore'])->name('admin.image_store');

    #########################################
    #### About Page routes & controllers ####
    #########################################
    // About page edit form
    Route::get('/about-page', [AdminAboutPageController::class, 'editForm'])->name('admin.about');
    // About page edit form processing
    Route::post('/about-page', [AdminAboutPageController::class, 'store'])->name('admin.about_post');

    #########################################
    ## Services Page routes & controllers ###
    #########################################
    // Service page edit form
    Route::get('/service-page', [AdminServicePageController::class, 'servicePageEditForm'])->name('admin.service-page');
    // Service page edit form processing
    Route::post('/service-page', [AdminServicePageController::class, 'storeServicePageFormEdits'])->name('admin.service-page_post');

    #########################################
    ##### Services routes & controllers #####
    #########################################
    // Create New Service data form
    Route::get('/new-service', [AdminServiceController::class, 'newServiceForm'])->name('admin.new-service');
    // Process New Service data form
    Route::post('/new-service', [AdminServiceController::class, 'newServiceFormProcessing'])->name('admin.new-service-processing');
    
    // Services list
    Route::get('/services', [AdminServiceController::class, 'listServices'])->name('admin.services');
    
    // Service edit form
    Route::get('/service/{id}', [AdminServiceController::class, 'editServiceForm'])->name('admin.service_edit');
    // Service edit form processing
    Route::post('/service/{id}', [AdminServiceController::class, 'storeServiceForm'])->name('admin.service_edit_post');
    
    // Service icon edit form
    Route::get('/service-icon/{id}', [AdminServiceController::class, 'editServiceIconForm'])->name('admin.service-icon_edit');
    // Service edit form processing
    Route::post('/service-icon/{id}', [AdminServiceController::class, 'storeServiceIconForm'])->name('admin.service-icon_edit_post');
    
    // Service deleting
    Route::delete('/service/{id}', [AdminServiceController::class, 'deleteService'])->name('admin.service_delete');

    #########################################
    #### Team Page routes & controllers #####
    #########################################
    // Team page edit form
    Route::get('/team-page', [AdminTeamPageController::class, 'editTeamPageForm'])->name('admin.team-page');
    // Team page edit form processing
    Route::post('/team-page', [AdminTeamPageController::class, 'storeTeamPageForm'])->name('admin.team_page_post');

    #########################################
    ### Team Members routes & controllers ###
    #########################################
    // Create New Team member data form
    Route::get('/new-team-member', [AdminTeamMemberController::class, 'newTeamMember'])->name('admin.new-team-member');
    // Process New Team member data form
    Route::post('/new-team-member', [AdminTeamMemberController::class, 'newTeamMemberFormProcessing'])->name('admin.new-team-member-processing');
    
    // Create New Team member photo data form
    Route::get('/new-team-member-photo/{memberID}', [AdminTeamMemberController::class, 'newTeamMemberImage'])->name('admin.new-team-member-photo');
    // Process New Team member photo data form
    Route::post('/new-team-member-photo', [AdminTeamMemberController::class, 'newTeamMemberImageFormProcessing'])->name('admin.new-team-member-photo-processing');
    
    // Team members list
    Route::get('/team-members', [AdminTeamMemberController::class, 'listTeams'])->name('admin.teams');
    
    // Team member edit form
    Route::get('/team-members/{id}', [AdminTeamMemberController::class, 'editTeamForm'])->name('admin.team_edit');
    // Team member edit form processing
    Route::post('/team-members/{id}', [AdminTeamMemberController::class, 'storeTeamMember'])->name('admin.team_post');
    
    // Team Member Image edit form (for multiple images)
    Route::get('/image-team/{imageResource?}/{imageResourceID?}', [AdminTeamMemberController::class, 'imagesFormForMultipleTeams'])->name('admin.image_form_for_team');
    // Team Member Image edit form (for multiple images)
    Route::post('/image-team/{imageResource?}/{imageResourceID?}', [AdminTeamMemberController::class, 'storeImagesFormForMultipleTeams'])->name('admin.store_image_form_for_team');
    
    // Team member deleting
    Route::delete('/team-members/{id}', [AdminTeamMemberController::class, 'deleteTeamMember'])->name('admin.team_delete');

    #########################################
    ## Settings Page routes & controllers ###
    #########################################
    // Site settings edit page
    Route::get('/site-settings', [AdminSiteSettingsController::class, 'siteSettingsEditForm'])->name('admin.settings');
    // Site settings edit page edit form processing
    Route::post('/site-settings', [AdminSiteSettingsController::class, 'storeSiteSettingsEditForm'])->name('admin.settings_post');

    // Site settings logo image edit form
//    Route::get('/site-logo-image/{postID}', [AdminSiteSettingsController::class, 'imageFormForSiteLogoImage'])->name('admin.site_logo_image_form');
    // Site settings logo image edit form processing
//    Route::post('/site-logo-image', [AdminSiteSettingsController::class, 'storeImageFormForSiteLogo'])->name('admin.store_site_logo_image_form');

    // Site settings favicon image edit form
    Route::get('/site-favicon-image/{postID}', [AdminSiteSettingsController::class, 'imageFormForSiteFavicon'])->name('admin.site_favicon_image_form');
    // Site settings favicon image edit form processing
    Route::post('/site-favicon-image', [AdminSiteSettingsController::class, 'storeImageFormForSiteFavicon'])->name('admin.store_site_favicon_image_form');
});

require __DIR__.'/auth.php';
