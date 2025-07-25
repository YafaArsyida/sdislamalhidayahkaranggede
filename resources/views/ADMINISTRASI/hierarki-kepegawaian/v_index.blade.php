@extends('template_machine.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Hierarki Kepegawaian</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administrasi</a></li>
                            <li class="breadcrumb-item active">Hierarki Kepegawaian</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Hierarki Kepegawaian</h4>
                    </div>
                    <div class="card-body">
                        <div class="sitemap-content">
                            <figure class="sitemap-horizontal">
                                <ul class="administration">
                                    <li>
                                        <ul class="director">
                                            <li>
                                                <a href="javascript:void(0);" class="fw-semibold">
                                                    <span>Ketua Komite</span>
                                                </a>
                                                <ul class="subdirector">
                                                    <li><a href="javascript:void(0);" class="fw-semibold"><span>Wakil Komite</span></a></li>
                                                </ul>
                                                <ul class="departments">
                                                    <li><a href="javascript:void(0);" class="fw-semibold"><span>Main Pages</span></a></li>
                                                    <li class="department">
                                                        <a href="javascript:void(0);" class="fw-semibold"><span>Account Management</span></a>
                                                        <ul>
                                                            <li><a href="javascript:void(0);"><span>Sign Up</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Login</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Profile Settings</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Modify Reservation</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Cancel Reservation</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Write Reviews</span></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="department">
                                                        <a href="javascript:void(0);" class="fw-semibold"><span>About Us</span></a>
                                                        <ul>
                                                            <li><a href="javascript:void(0);"><span>Overview</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Connect
                                                                        Via Social Media</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Careers</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Team
                                                                        Members</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Policies</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="department">
                                                        <a href="javascript:void(0);" class="fw-semibold"><span>Book a Trip</span></a>
                                                        <ul>
                                                            <li><a href="javascript:void(0);"><span>Travel
                                                                        Details</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Reservation
                                                                        Process</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Payment
                                                                        Option</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Comfirmation</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="department">
                                                        <a href="javascript:void(0);" class="fw-semibold"><span>Destination</span></a>
                                                        <ul>
                                                            <li><a href="javascript:void(0);"><span>Architecture</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Art</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Entertainment</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>History</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Science</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Sports</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Music</span></a>
                                                            </li>
                                                            <li><a href="javascript:void(0);"><span>Tracking
                                                                        Camp</span></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="department">
                                                        <a href="javascript:void(0);" class="fw-semibold"><span>Travel Tips</span></a>
                                                        <ul>
                                                            <li><a href="javascript:void(0);"><span>General
                                                                        Travel</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Helpth
                                                                        Concerns</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>Safety
                                                                        Measures</span></a></li>
                                                            <li><a href="javascript:void(0);"><span>FAQ's</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </figure>
                        </div>
                        <!--end sitemap-content-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>        
    </div>
</div>
@endsection

