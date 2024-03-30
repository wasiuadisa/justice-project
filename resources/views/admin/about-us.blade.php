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
                            <form class="form ml-5" method="post" action="{{ route('admin.about_post') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="image" class="h4">
                                        About image
                                    </label>
                                </div>
                                <div class="form-group">
                                    <img style="margin-top: -15px;" src="{{ asset('storage/public_template/images') . '/' . $contents->image }}" alt="About image" class="img-thumbnail" />
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('admin.image_form', ['aboutPage', 'image']) }}" class="btn btn-primary">
                                        <span class="fold-item-icon mr-3">
                                            <i class="gd-gallery"></i>
                                        </span> Change Image
                                    </a>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <input type="hidden" name="postID" value="{{ $contents->id }}" />

                                <input type="hidden" name="postID" value="{{ $contents->id }}" />
                                <div class="form-group ">
                                    <label for="subtitle" class="h4">
                                        Sub-Title
                                    </label>
                                    <input type="text" class="form-control border border-dark" id="subtitle" name="subtitle" aria-describedby="subtitle" value="@if(count($errors) > 0){{ old('subtitle') }}@else{{ htmlspecialchars_decode($contents->subtitle) }}@endif">
                                </div>

                                <div class="form-group">
                                    <label for="details" class="h4">
                                        Details
                                    </label>
                                    <textarea class="form-control border border-dark" id="details" name="details" rows="3">@if(count($errors) > 0){{ old('details') }}@else{{ htmlspecialchars_decode($contents->details) }}@endif</textarea>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control">
                                        <i class="gd-save mr-3"></i> 
                                        Update
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