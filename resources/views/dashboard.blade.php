<?php $pageTitle = "Dashboard "; ?>

@section('extra_script')
@endsection

@extends('layouts.admin_template_dashboard')

@section('main_content')
<?php /*
<!-- Team modal -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teamModalLabel">Team & Team page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><a class="btn btn-primary text-white" href="{{ route('admin.team-page') }}">View Team Page Editing</a></p>
                <p><a class="btn btn-primary text-white" href="{{ route('admin.teams') }}">View Team Members page</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Team modal -->

<!-- Service modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Service & Service page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><a class="btn btn-primary text-white" href="{{ route('admin.service-page') }}">Open Service Page Editing</a></p>
                <p><a class="btn btn-primary text-white" href="{{ route('admin.services') }}">Open Services page</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Service modal -->

<!-- Contact Us modal -->
<div class="modal fade" id="contactusModal" tabindex="-1" aria-labelledby="contactusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactusModalLabel">Contact Us page or Messages</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><a class="btn btn-primary text-white" href="{{-- route('admin.contactus-page') --}}">View Contact Us Page Editing</a></p>
                <p><a class="btn btn-primary text-white" href="{{-- route('admin.contactus-messages') --}}">View Contact Us Messages</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Contact Us modal -->
*/ ?>
    <div class="content">
        <div class="py-4 px-3 px-md-4">

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Available Administrative resources</div>
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
                        </div>

                        <div class="card mb-3 mb-md-4 pl-3 pr-3">
                          <table class="table table-striped table-dark">
                            <thead>
                              <tr>
                                <th class="border-top-0 py-2 h4">#</th>
                                <th class="border-top-0 py-2 h4">Resource</th>
                                <th class="border-top-0 py-2 h4">Main pages</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="py-2">1</td>
                                <td class="py-2">Home Page</td>
                                <td class="py-2">
                                    <a class="btn btn-primary btn-block text-white" href="{{ route('admin.index') }}">Open Home Page</a>
                                </td>
                              </tr>
                              <tr>
                                <td class="py-2">2</td>
                                <td class="py-2">About Us</td>
                                <td class="py-2">
                                    <a class="btn btn-primary btn-block text-white" href="{{ route('admin.about') }}">Open About Us</a>
                                </td>
                              </tr>
                              <tr>
                                <td class="py-2">4</td>
                                <td class="py-2">Services Page & Services</td>
                                <td class="py-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#serviceModal">
                                        Open Services or Services page
                                    </button>
                                </td>
                              </tr>
                              <tr>
                                <td class="py-2">7</td>
                                <td class="py-2">Team page & Team</td>
                                <td class="py-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#teamModal">
                                        Open Team or Team page
                                    </button>
                                </td>
                              </tr>
                              <tr>
                                <td class="py-2">8</td>
                                <td class="py-2">Contact Us</td>
                                <td class="py-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#contactusModal">
                                        Open Contact Us page or Messages
                                    </button>
                                </td>
                              </tr>
                              <tr>
                                <td class="py-2">9</td>
                                <td class="py-2">Settings</td>
                                <td class="py-2">
                                    <a class="btn btn-primary btn-block text-white" href="{{ route('admin.settings') }}">Open Settings</a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                    </div>
                </div>
            </div>
            <!----------------- End of Main page content --------->
        </div>
@endsection
