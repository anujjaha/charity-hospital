<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <h2 style="color:#fff;" class="m-0">P T Mirani Hospital</h2>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item">
                        @if(session()->get('locale'))
                            @if(session()->get('locale') == 'fr')
                                <a class="white-font" href="{!! route('set-lang', ['lang' => 'en']) !!}">
                                    English
                                </a>
                            @else
                                <a  class="white-font" href="{!! route('set-lang', ['lang' => 'fr']) !!}">
                                    Gujarati
                                </a>
                            @endif

                        @else
                            <a  class="white-font" href="{!! route('set-lang', ['lang' => 'fr']) !!}">
                                Gujarati
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        Department : {{  access()->getUserDepartment() }}
                    </li>
                    <li class="nav-item dropdown mr-4">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-bell mx-0"></i> </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info"><i class="mdi mdi-account-box mx-0"></i></div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">2 Min ago</p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info"><i class="mdi mdi-account-box mx-0"></i></div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">2 Min ago</p>
                                </div>
                            </a>                                </div>
                  </li>
              <li class="nav-item nav-profile dropdown mr-0 mr-sm-2">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="images/dummy-profile-pic.jpg" alt="profile" />
                            <span class="nav-profile-name">
                                {!! access()->user() ? access()->user()->name : ''!!}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <i class="mdi mdi-settings text-primary"></i>Settings</a>
                            <a href="{!! route('frontend.auth.logout') !!}" class="dropdown-item">
                                <i class="mdi mdi-logout text-primary"></i>Logout
                            </a>
                        </div>
                  </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
      <span class="mdi mdi-menu"></span>
    </button>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('/') !!}">
                        <i class="mdi mdi-home-outline menu-icon"></i>
                        <span class="menu-title">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('frontend.user.patients.create') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">Add Patient</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('frontend.user.patients.list') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">List All Patients</span>
                        </a>
                    </li>
                <li class="nav-item">
                    <a href="{!! route('frontend.user.doctors.create') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">Add Doctor</span></a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('frontend.user.doctors.list') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">List All Doctors</span></a>                        </li>
                        <li class="nav-item">
                    <a href="{!! route('frontend.user.history.list') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">History</span></a>                         </li>
                <li class="nav-item">
                    <a href="{!! route('frontend.user.surgery.list') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">Surgeries
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! route('frontend.user.x-ray.list') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">X-Ray
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! route('frontend.auth.logout') !!}" class="nav-link">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">Logout</span></a>                        </li>
            </ul>
      </div>
    </nav>
</div>