
@extends('layouts.admin_template')

@section('main_content')
    <div class="content">
        <div class="py-4 px-3 px-md-4">

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">
                    {{ $pageTitle }}
                </div>
                <div class="mb-0 pull-right">
                    <a class="form-control btn btn-primary" href="{{ route('admin.settings') }}">
                        Back to Settings Page
                    </a>
                </div>
            </div>

            <!----------------- Main page content ---------------->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3 mb-md-4">

                        <!-- Info and Error messages -->
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
                            <!-- end Errors message -->
                            @endif
                        </div>
                        <!-- end Info and Error messages -->

                        <div class="card mb-3 mb-md-4">
                            <form class="form ml-5" method="post" action="{{ route('admin.store_site_favicon_image_form') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="previous_page_url" value="{{ url()->previous() }}" />
                                <input type="hidden" name="postID" value="{{ $image_contents->id }}" />

                                <div class="form-group">
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6">
                                            <label for="favicon" class="h4">
                                                Favicon image
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <input type="file" class="form-control border border-dark" id="image_file" name="image_file" value="{{ old('image_file') }}"><?php /*
                                            <input type="file" class="form-control border border-dark" id="favicon" name="favicon" value="{{ old('favicon') }}">*/ ?>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-sm-12 col-md-6 offset-md-3">
                                            <button type="submit" class="form-control btn btn-primary">
                                                <i class="gd-save mr-3"></i> 
                                                Update Favicon Image
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!----------------- End of Main page content --------->
        </div>
@endsection
