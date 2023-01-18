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
                <a href="{{ route ('admin.module.location.index') }}"><i class="fa-solid fa-compass"></i>
                    <span class="menu-title" data-i18n="Location">Location</span>
                </a>
            </li>
            
            <li @if ($url == 'admin.module.hotel.room.index' || $url == 'admin.module.hotel.room.edit') class="nav-item open active" @else class="nav-item" @endif>
                <a href="#"><i class="fa-solid fa-building"></i>
                    <span class="menu-title" data-i18n="Hotel">Hotel</span>
                </a>
                <ul class="menu-content">
                    <li @if ($url == 'admin.module.hotel.index' || $url == 'admin.module.hotel.edit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.hotel.index')}}" data-i18n="All Hotels">All Hotels</a>
                    </li>
                    <li @if ($url == 'admin.module.hotel.create') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.hotel.create')}}" data-i18n="Add New Hotel">Add New Hotel</a>
                    </li>
                    <li @if ($url == 'admin.module.hotel.attribute.index' || $url == 'admin.module.hotel.attribute.edit' || 
                    $url == 'admin.module.hotel.attribute.termList' || $url == 'admin.module.hotel.attribute.termEdit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.hotel.attribute.index')}}" data-i18n="Attributes">Attributes</a>
                    </li>
                    <li @if ($url == 'admin.module.hotel.roomAttribute.index' || $url == 'admin.module.hotel.roomAttribute.edit' || 
                    $url == 'admin.module.hotel.roomAttribute.termList' || $url == 'admin.module.hotel.roomAttribute.termEdit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.hotel.roomAttribute.index')}}" data-i18n="Room Attributes">Room Attributes</a>
                    </li>
                    <li @if ($url == 'admin.module.hotel.recovery') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.hotel.recovery')}}" data-i18n="Recovery">Recovery</a>
                    </li>
                </ul>
            </li>
            
            <li class=" nav-item">
                <a href="#"><i class="fa-solid fa-gear"></i>
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