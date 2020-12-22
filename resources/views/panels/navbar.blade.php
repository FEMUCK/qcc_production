<div class="navbar @if(($configData['isNavbarFixed'])=== true){{'navbar-fixed'}} @endif">
    <nav
        class="{{$configData['navbarMainClass']}} @if($configData['isNavbarDark']=== true) {{'navbar-dark'}} @elseif($configData['isNavbarDark']=== false) {{'navbar-light'}} @elseif(!empty($configData['navbarBgColor'])) {{$configData['navbarBgColor']}} @else {{$configData['navbarMainColor']}} @endif">
        <div class="nav-wrapper">

            {{--  <div class="header-search-wrapper hide-on-med-and-down">
                <i class="material-icons">search</i>
                <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize" data-search="template-list">
                <ul class="search-list collection display-none"></ul>
            </div>  --}}

            <ul class="navbar-list right">
                {{--  <li class="hide-on-med-and-down">
                <a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);">
                    <i class="material-icons">settings_overscan</i>
                </a>
                </li>  --}}

                <li>
                <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                    data-target="profile-dropdown">
                    <span class="avatar-status avatar-online">
                    {{-- <img src="{{asset('images/avatar/avatar-7.png')}}" alt="avatar"><i></i> --}}
                    <img src="{{ session()->get('user_pic') }}" alt="avatar"><i></i>
                    </span>
                </a>
                </li>
            </ul>

            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
                @if(session()->get('usertype_S012') == 'A' || session()->get('adminflag_S012') == 'Y' || session()->get('superadmin_S012') == 'Y')
                    <li>
                        <a class="grey-text text-darken-1" href="{{ route('page-qcc-system-setting') }}"><i class="material-icons">build</i> Setting</a>
                    </li>
                    <li>
                        <a class="grey-text text-darken-1" href="{{ route('page-qcc-users-list') }}"><i class="material-icons">people</i> Users</a>
                    </li>
                @endif
                <li class="divider"></li>
                <li>
                    <a class="grey-text text-darken-1" href="{{ route('logout') }}"">
                        <i class="material-icons">keyboard_tab</i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <nav class="display-none search-sm">
        <div class="nav-wrapper">
            <form id="navbarForm">
                <div class="input-field search-input-sm">
                    <input class="search-box-sm mb-0" type="search" required="" placeholder='Explore Materialize' id="search" data-search="template-list">
                    <label class="label-icon" for="search">
                        <i class="material-icons search-sm-icon">search</i>
                    </label>
                    <i class="material-icons search-sm-close">close</i>
                    <ul class="search-list collection search-list-sm display-none"></ul>
                </div>
            </form>
        </div>
        </nav>
    </nav>
</div>

    <!-- search ul  -->
    <ul class="display-none" id="page-search-title">
    <li class="auto-suggestion-title">
        <a class="collection-item" href="#">
        <h6 class="search-title">PAGES</h6>
        </a>
    </li>
    </ul>
    <ul class="display-none" id="search-not-found">
    <li class="auto-suggestion">
        <a class="collection-item display-flex align-items-center" href="#">
        <span class="material-icons">error_outline</span>
        <span class="member-info">No results found.</span>
        </a>
    </li>
    </ul>
