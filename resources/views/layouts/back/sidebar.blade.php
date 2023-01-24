<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li @if($url=='admin.dashboard' ) class="active" @else class=" nav-item" @endif>
                <a href="{{ route ('admin.dashboard') }}">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            
            <li @if($url=='admin.module.location.index' || $url=='admin.module.location.edit' ) class="active" @else class=" nav-item" @endif>
                <a href="{{ route ('admin.module.location.index') }}">
                    <i class="fa-solid fa-compass"></i>
                    <span class="menu-title" data-i18n="Location">Location</span>
                </a>
            </li>
            
            <li @if ($url == 'admin.module.hotel.room.index' || $url == 'admin.module.hotel.room.edit') class="nav-item open active" @else class="nav-item" @endif>
                <a href="#">
                    <i class="fa-solid fa-hotel"></i>
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
            
            <li class="nav-item">
                <a href="#">
                    <i class="fa-solid fa-ship"></i>
                    <span class="menu-title" data-i18n="Boat">Boat</span>
                </a>
                <ul class="menu-content">
                    <li @if ($url == 'admin.module.boat.index' || $url == 'admin.module.boat.edit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.boat.index')}}" data-i18n="All Boats">All Boats</a>
                    </li>
                    <li @if ($url == 'admin.module.boat.create') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.boat.create')}}" data-i18n="Add New Boat">Add New Boat</a>
                    </li>
                    <li @if ($url == 'admin.module.boat.attribute.index' || $url == 'admin.module.boat.attribute.edit' || 
                    $url == 'admin.module.boat.attribute.termList' || $url == 'admin.module.boat.attribute.termEdit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.boat.attribute.index')}}" data-i18n="Attributes">Attributes</a>
                    </li>
                    <li @if ($url == 'admin.module.boat.recovery') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.boat.recovery')}}" data-i18n="Recovery">Recovery</a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a href="#">
                    <i class="fa-solid fa-car"></i>
                    <span class="menu-title" data-i18n="Car">Car</span>
                </a>
                <ul class="menu-content">
                    <li @if ($url == 'admin.module.car.index' || $url == 'admin.module.car.edit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.car.index')}}" data-i18n="All Cars">All Cars</a>
                    </li>
                    <li @if ($url == 'admin.module.car.create') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.car.create')}}" data-i18n="Add New Car">Add New Car</a>
                    </li>
                    <li @if ($url == 'admin.module.car.attribute.index' || $url == 'admin.module.car.attribute.edit' || 
                    $url == 'admin.module.car.attribute.termList' || $url == 'admin.module.car.attribute.termEdit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.car.attribute.index')}}" data-i18n="Attributes">Attributes</a>
                    </li>
                    <li @if ($url == 'admin.module.car.recovery') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.car.recovery')}}" data-i18n="Recovery">Recovery</a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a href="#">
                    <i class="fa-solid fa-house-chimney"></i>
                    <span class="menu-title" data-i18n="Space">Space</span>
                </a>
                <ul class="menu-content">
                    <li @if ($url == 'admin.module.space.index' || $url == 'admin.module.space.edit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.space.index')}}" data-i18n="All Spaces">All Spaces</a>
                    </li>
                    <li @if ($url == 'admin.module.space.create') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.space.create')}}" data-i18n="Add New Space">Add New Space</a>
                    </li>
                    <li @if ($url == 'admin.module.space.attribute.index' || $url == 'admin.module.space.attribute.edit' || 
                    $url == 'admin.module.space.attribute.termList' || $url == 'admin.module.space.attribute.termEdit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.space.attribute.index')}}" data-i18n="Attributes">Attributes</a>
                    </li>
                    <li @if ($url == 'admin.module.space.recovery') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.space.recovery')}}" data-i18n="Recovery">Recovery</a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a href="#">
                    <i class="fa-solid fa-plane-up"></i>
                    <span class="menu-title" data-i18n="Flight">Flight</span>
                </a>
                <ul class="menu-content">
                    <li @if ($url == 'admin.module.flight.index' || $url == 'admin.module.flight.edit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.flight.index')}}" data-i18n="All Flights">All Flights</a>
                    </li>
                    <li @if ($url == 'admin.module.flight.create') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.flight.create')}}" data-i18n="Add New Flight">Add New Flight</a>
                    </li>
                    <li @if ($url == 'admin.module.flight.attribute.index' || $url == 'admin.module.flight.attribute.edit' || 
                    $url == 'admin.module.flight.attribute.termList' || $url == 'admin.module.flight.attribute.termEdit') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.flight.attribute.index')}}" data-i18n="Attributes">Attributes</a>
                    </li>
                    <li @if ($url == 'admin.module.flight.recovery') class="active" @endif>
                        <a class="menu-item" href="{{ route ('admin.module.flight.recovery')}}" data-i18n="Recovery">Recovery</a>
                    </li>
                </ul>
            </li>
            
            <li class=" nav-item">
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
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