
@section('extra_script')
@endsection

@extends('layouts.admin_template')

@section('main_content')
    <div class="content">
        <div class="py-4 px-3 px-md-4">

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h2 mb-0">{{ $pageTitle }}</div>
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
                            <form class="form ml-5" method="post" action="{{ route('admin.index_post') }}">
                                @csrf

                                <input type="hidden" name="postID" value="{{ $index_contents->id }}" />


                                <div class="form-group">
                                    <label for="banner_image" class="h4">
                                        Banner image
                                    </label>
                                </div>
                                <div class="form-group">
                                    <img class="img-fluid img-thumbnail" style="margin-top: -15px;" src="{{ asset('storage/public_template/images') . '/' . $index_contents->banner_image }}" alt="{{ ucwords(htmlspecialchars_decode($index_contents->banner_title)) }}" />
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('admin.banner_home_image_form', [$index_contents->id]) }}" class="btn btn-primary">
                                        <span class="fold-item-icon mr-3">
                                            <i class="gd-gallery"></i>
                                        </span> Change Banner Image
                                    </a>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group ">
                                    <label for="bannerTitle" class="h4">
                                        Banner Title
                                    </label>
                                    <input type="text" class="form-control border border-dark" id="bannerTitle" name="bannerTitle" aria-describedby="bannerTitle" value="@if(count($errors) > 0){{ old('bannerTitle') }}@else{{ htmlspecialchars_decode($index_contents->banner_title) }}@endif">
                                </div>
                                <div class="form-group ">
                                    <label for="homeTitle" class="h4">
                                        Home Title
                                    </label>
                                    <input type="text" class="form-control border border-dark" id="homeTitle" name="homeTitle" aria-describedby="homeTitle" value="@if(count($errors) > 0){{ old('homeTitle') }}@else{{ htmlspecialchars_decode($index_contents->home_title) }}@endif">
                                </div>

                                <div class="form-group">
                                    <label for="homeDescription" class="h4">
                                        Home Description
                                    </label>
                                    <textarea class="form-control border border-dark" id="homeDescription" name="homeDescription">@if(count($errors) > 0){{ old('homeDescription') }}@else{{ htmlspecialchars_decode($index_contents->home_description) }}@endif</textarea>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control">
                                        <i class="gd-save mr-3"></i> 
                                        Update Home section
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