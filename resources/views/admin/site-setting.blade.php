
@section('extra_script')
@endsection

@extends('layouts.admin_template')

@section('main_content')
    <div class="content">
        <div class="py-4 px-3 px-md-4">

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">{{ $pageTitle }}</div>
            </div>

            <!----------------- Main page content ---------------->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3 mb-md-4">

                        <div class="card mb-3 mb-md-4">
                            @if( session('info') )
                            <!-- Message -->
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">Alert!</span> {{ session('info') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            @endif

                            @if( count($errors) > 0 )
                            <!-- Errors message -->
                            <div class="col-sm-12">
                                <ul class="alert alert-danger alert-dismissible fade show list-unstyled text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                @foreach( $errors->all() as $error )                                
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                                <hr>
                            </div>
                            @endif
                        </div>

                        <div class="card mb-3 mb-md-4">
                            <form class="form ml-5" method="post" action="{{ route('admin.settings_post') }}">
                                @csrf
                                <input type="hidden" name="postID" value="{{ $site_setting_contents->id }}" />
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="logo" class="h4">
                                                Site Logo
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <img src="{{ asset('storage/public_template/images/' . $site_setting_contents->header_logo_filename) }}" alt="{{ $site_setting_contents->header_logo_alt_text }}" />
                                        </div>
                                    </div>
                                    <div class="row mt-5 mb-3">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="logo" class="h4">
                                                Logo Alternative Text
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <p>{{ $site_setting_contents->header_logo_alt_text }}</p>
                                        </div>
                                    </div><?php /*
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <a href="{{ route('admin.site_logo_image_form', [$site_setting_contents->id]) }}"  class="form-control btn btn-primary mt-3 col-sm-12 col-md-6 offset-md-3">
                                                <span class="fold-item-icon mr-3">
                                                    <i class="gd-gallery"></i>
                                                </span> Change Logo Image</a>
                                        </div>
                                    </div>
*/ ?>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label for="favicon" class="h4">
                                                Favicon image
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <img src="{{ asset('storage/public_template/images/' . $site_setting_contents->favicon_logo) }}" alt="Favicon image" />
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <a href="{{ route('admin.site_favicon_image_form', [$site_setting_contents->id]) }}"  class="form-control btn btn-primary mt-3 col-sm-12 col-md-6 offset-md-3">
                                                <span class="fold-item-icon mr-3">
                                                    <i class="gd-gallery"></i>
                                                </span> Change Favicon Image
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 pull-left">
                                            <label for="socials" class="h2">
                                                Socials
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="url_facebook" class="h4">Facebook URL</label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="url_facebook" name="url_facebook" value="@if(count($errors) > 0){{ old('url_facebook') }}@else{{ htmlspecialchars_decode($site_setting_contents->url_facebook) }}@endif">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="url_twitter" class="h4">Twitter URL</label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="url_twitter" name="url_twitter" value="@if(count($errors) > 0){{ old('url_twitter') }}@else{{ htmlspecialchars_decode($site_setting_contents->url_twitter) }}@endif">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="url_linkedin" class="h4">LinkedIn URL</label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="url_linkedin" name="url_linkedin" value="@if(count($errors) > 0){{ old('url_linkedin') }}@else{{ htmlspecialchars_decode($site_setting_contents->url_linkedin) }}@endif">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="url_dribble" class="h4">Dribble URL</label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="url_dribble" name="url_dribble" value="@if(count($errors) > 0){{ old('url_dribble') }}@else{{ htmlspecialchars_decode($site_setting_contents->url_picassa) }}@endif">
                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="contact_title" class="h4">Contact Us Title</label>
                                        </div>

                                        <div class="col-sm-12 col-md-8">
                                            <input class="form-control border border-dark" id="contact_title" name="contact_title" value="@if(count($errors) > 0){{ old('contact_title') }}@else{{ htmlspecialchars_decode($contactusPage_contents->title) }}@endif" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="contact_details" class="h4">Contact Us Details</label>
                                        </div>

                                        <div class="col-sm-12 col-md-8">
                                            <textarea class="form-control border border-dark" id="contact_details" name="contact_details" rows="3">@if(count($errors) > 0){{ old('contact_details') }}@else{{ htmlspecialchars_decode($contactusPage_contents->details) }}@endif</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 pull-left">
                                            <label for="contact_address" class="h2">Contact Address</label>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="contact_address" class="h4">Contact Address</label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="contact_address" name="contact_address" value="@if(count($errors) > 0){{ old('contact_address') }}@else{{ htmlspecialchars_decode($contactusPage_contents->contact_address) }}@endif">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="contact_phone" class="h4">Contact Phone</label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="contact_phone" name="contact_phone" value="@if(count($errors) > 0){{ old('contact_phone') }}@else{{ htmlspecialchars_decode($contactusPage_contents->contact_phone) }}@endif">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="contact_email" class="h4">Contact Email</label> Note: Contact us messages will be sent to this email address
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="contact_email" name="contact_email" value="@if(count($errors) > 0){{ old('contact_email') }}@else{{ htmlspecialchars_decode($contactusPage_contents->contact_email) }}@endif">
                                        </div>
                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="contact_website" class="h4">Contact Website</label>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <input type="text" class="form-control border border-dark" id="contact_website" name="contact_website" value="@if(count($errors) > 0){{ old('contact_website') }}@else{{ htmlspecialchars_decode($contactusPage_contents->contact_website) }}@endif">
                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control col-sm-12 col-md-6 offset-md-3">
                                        <i class="gd-save mr-3"></i> 
                                        Update Site Settings
                                    </button>
                                </div>
                            </form>
                        </div>
 
                    </div>
                </div>
            </div>
            <!----------------- End of Main page content --------->
        </div>

@endsection