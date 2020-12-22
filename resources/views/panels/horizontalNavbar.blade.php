<div class="navbar @if(($configData['isNavbarFixed'])=== true){{'navbar-fixed'}} @endif">
    <nav
        class="{{$configData['navbarMainClass']}} @if(($configData['isNavbarDark'])=== true) {{'navbar-dark'}} @elseif(($configData['isNavbarDark'])=== false) {{'navbar-light'}} @elseif(!empty($configData['navbarBgColor'])) {{$configData['navbarBgColor']}} @else {{$configData['navbarMainColor']}} @endif">
        <div class="nav-wrapper">
        <ul class="left">
            <li>
            <h1 class="logo-wrapper">
                <a class="brand-logo darken-1" href="{{asset('/')}}">
                <img src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo">
                <span class="logo-text hide-on-med-and-down">
                    @if(!empty ($configData['templateTitle']))
                    {{$configData['templateTitle']}}
                    @else
                    Materialize
                    @endif
                </span>
                </a>
            </h1>
            </li>
        </ul>
        <div class="header-search-wrapper hide-on-med-and-down">
            <i class="material-icons">search</i>
            <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize"
            data-search="template-list">
            <ul class="search-list collection display-none"></ul>
        </div>
        <!-- profile-dropdown-->
        <ul class="dropdown-content" id="profile-dropdown">
            <li>
            <a class="grey-text text-darken-1" href="{{asset('user-login')}}">
                <i class="material-icons">keyboard_tab</i>
                Logout
            </a>
            </li>
        </ul>
        </div>
        <nav class="display-none search-sm">
        <div class="nav-wrapper">
            <form id="navbarForm">
            <div class="input-field search-input-sm">
                <input class="search-box-sm" type="search" required="" placeholder='Explore Materialize' id="search"
                data-search="template-list">
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
    <!-- BEGIN: Horizontal nav start-->
    <nav class="white hide-on-med-and-down" id="horizontal-nav">
        <div class="nav-wrapper">
        <ul class="left hide-on-med-and-down" id="ul-horizontal-nav" data-menu="menu-navigation">
            {{-- Foreach menu item starts --}}
            @if(!empty($menuData[1]) && isset($menuData[1]))
            @foreach ($menuData[1]->menu as $menu)
                @php
                $custom_classes="";
                if(isset($menu->class))
                {
                $custom_classes=$menu->class;
                }
                @endphp
            <li>
                <a @if(isset($menu->submenu)){{'class=dropdown-menu'}} @endif href="{{$menu->url}}" data-target="{{$menu->activate}}">
                <i class="material-icons">{{$menu->icon}}</i>
                <span>
                    <span class="dropdown-title">{{ __('locale.'.$menu->name)}}</span>
                    @isset($menu->submenu)
                    <i class="material-icons right">keyboard_arrow_down</i>
                    @endisset
                </span>
                </a>
                @if(isset($menu->submenu))
                @include('panels.horizontalSubmenu',['menu' => $menu->submenu],['activate'=>$menu->activate])
                @endif
            </li>
            @endforeach
            @endif
        </ul>
        </div>
        <!-- END: Horizontal nav start-->
    </nav>
</div>
