
@section('extra_script')
@endsection

@extends('layouts.admin_template')

@section('main_content')

@if(count($contents) > 0)
@php
    $marketingPitchDateClass = (new \App\Logic\CustomTime);
@endphp
    @foreach($contents as $content)
    <!-- modal -->
    <div class="modal fade" id="detailModal{{ $content->id }}" tabindex="-1" aria-labelledby="detailModal{{ $content->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border border-1 border-dark rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModal{{ $content->id }}Label">{{ ucwords(htmlspecialchars_decode($content->title)) }}'s full details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Icon</b>: {{ htmlspecialchars_decode($content->icon) }}</p>
                    <p><b>Title</b>: {{ ucwords(htmlspecialchars_decode($content->title)) }}</p>
                    <p><b>Text</b>: {{ ucfirst(htmlspecialchars_decode($content->text)) }}</p>
                    <p><b>Created on</b>: <?php 
$modified_date = date_create_from_format('Y-m-d H:i:s', "$content->created_at"); 
echo date_format($modified_date, 'M d, Y. g:i A'); ?></p>
                    <p><b>Last edit on</b>: <?php 
$modified_date = date_create_from_format('Y-m-d H:i:s', "$content->updated_at"); 
echo date_format($modified_date, 'M d, Y. g:i A'); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    @endforeach
@endif

    <div class="content">
        <div class="py-4 px-3 px-md-4">

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">
                    {{ $pageTitle }}
                </div>
            </div>

            <!----------------- Main page content ---------------->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3 mb-md-4">
                        
                        <div class="card-header">
                            <a href="{{ route('admin.new-marketing-pitch') }}" class="btn btn-primary">
                                Create New Marketing Pitch
                            </a>
                        </div>

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

                        <div class="card mb-3 mb-md-4 pl-3 pr-3">
                          <table class="table table-striped table-dark">
                            <thead>
                              <tr>
                                <th class="border-top-0 py-2 h4">#</th>
                                <th class="border-top-0 py-2 h4">Icon</th>
                                <th class="border-top-0 py-2 h4">Title</th>
                                <th class="border-top-0 py-2 h4">Short Text</th>
                                <th class="border-top-0 py-2 h4">Edit</th>
                                <th class="border-top-0 py-2 h4">Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                      @if (count($contents) > 0)
                      <?php $rowNumber = 1; ?>
                        @foreach($contents as $content)
                              <tr>
                                <td class="py-3">{{ $rowNumber++ }}</td>
                                <td class="py-3">{{ htmlspecialchars_decode($content->icon) }}</td>
                                <td class="py-3">{{ ucwords(htmlspecialchars_decode($content->title)) }}</td>
                                <td class="py-3">{{ ucfirst(htmlspecialchars_decode($content->text)) }}</td>
                                <td class="py-3">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal{{ $content->id }}">
                                        <i class="gd-view-list"></i> 
                                      View Details
                                    </button>
                                </td>
                                <td class="py-3">
                                    <a class="btn btn-light text-dark" href="{{ route('admin.marketing-pitch_edit', $content->id) }}">
                                        <i class="gd-view-list"></i> Edit
                                    </a>
                                </td>
                                <td class="py-3">
                                    <form action="{{ route('admin.marketing-pitch_delete', $content->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" data-dismiss="modal">
                                        <i class="gd-trash"></i> 
                                            Delete
                                        </button>
                                    </form>
                                </td>
                              </tr>
                        @endforeach
                    @endif
                            </tbody>
                          </table>
                        </div>

                    </div>
                </div>
            </div>
            <!----------------- End of Main page content --------->
        </div>
@endsection
