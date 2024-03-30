
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
                            <form class="form ml-5" method="post" action="{{ route('admin.service_edit_post', $contents->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group ">
                                    <label for="title" class="h4">
                                        Title
                                    </label>
                                    <input type="text" class="form-control border border-dark" id="title" name="title" aria-describedby="title" value="@if(count($errors) > 0){{ old('title') }}@else{{ htmlspecialchars_decode($contents->title) }}@endif">
                                </div>
                                <div class="form-group ">
                                    <label for="caption" class="h4">
                                        Service caption text
                                    </label>
                                    <textarea class="form-control border border-dark" id="caption" name="caption">@if(count($errors) > 0){{ old('caption') }}@else{{ htmlspecialchars_decode($contents->text) }}@endif</textarea>
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset('storage/public_template/images/' . $contents->icon) }}" alt="{{ ucwords($contents->title) }}" class="">
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('admin.service-icon_edit', $contents->id) }}" class="btn btn-primary">
                                        <i class="gd-gallery"></i> 
                                        Change Service icon
                                    </a>
                                </div>

                                <div class="clearfix border-bottom border-success mb-5 mt-5"></div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control">
                                        <i class="gd-save mr-3"></i> 
                                        Update Service
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