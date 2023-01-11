<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li @if($url=='admin.dashboard' ) class="active" @else class=" nav-item" @endif>
                <a href="{{ route ('admin.dashboard') }}"><i class="fa-solid fa-gauge"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            
            <li @if($url=='admin.module.location.index' || $url=='admin.module.location.edit' ) class="active" @else class=" nav-item" @endif>
                <a href="{{ route ('admin.module.location.index') }}"><i class="fa-solid fa-gauge"></i>
                    <span class="menu-title" data-i18n="Location">Location</span>
                </a>
            </li>
            
            <li class=" nav-item">
                <a href="#"><i class="fa-solid fa-gear"></i></i>
                    <span class="menu-title" data-i18n="Setup">Setup</span>
                </a>
                <ul class="menu-content">
                    <li @if ($url == 'admin.setup.appSetting') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.setup.appSetting')}}" data-i18n="General Setting">General Setting</a>
                    </li>
                    <li @if ($url == 'admin.setup.emailSetup') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.setup.emailSetup')}}" data-i18n="Email Setup">Email Setup</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->