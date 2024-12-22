<div id="sidebarMain" class="d-none">
    <?php $lang = session()->get('locale') ?>
    <aside style="text-align: {{ $lang == 'ar' ? 'right' : 'left' }};"
        class="bg-white js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    {{-- @php(=\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value) --}}
                    <a class="navbar-brand" href="{{ route('dashboard') }}" aria-label="Front">
                        <img onerror="this.src='{{ asset('public/assets/back-end/img/900x400/img1.jpg') }}'"
                            class="navbar-brand-logo-mini for-web-logo max-h-30"
                            src="{{ asset('public/assets/finexerp_logo.png') }}" alt="Logo">
                    </a>
                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                        class="d-none js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->

                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                        <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                            data-placement="right" title="" data-original-title="Collapse"></i>
                        <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                            data-template="<div class=&quot;tooltip d-none d-sm-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>"
                            data-toggle="tooltip" data-placement="right" title=""
                            data-original-title="Expand"></i>
                    </button>
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <!-- Search Form -->
                    <div class="sidebar--search-form pb-3 pt-4">
                        <div class="search--form-group">
                            <button type="button" class="btn"><i class="tio-search"></i></button>
                            <input type="text" class="js-form-search form-control form--control"
                                id="search-bar-input" placeholder="{{ __('general.search_menu') }}...">
                        </div>
                    </div>
                    <!-- End Search Form -->
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('dashboard') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" title="{{ __('dashboard.dashboard') }}"
                                href="{{ route('dashboard') }}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('dashboard.dashboard') }}
                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->
                        <li class="nav-item">
                            <small class="nav-subtitle" title="">{{__('general.hierarchy')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('companies*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('companies.companies') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('companies.companies') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('companies*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('companies') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('companies') }}"
                                        title="{{ __('companies.all_companies') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('companies.all_companies') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\User::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('companies/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('companies.create') }}"
                                        title="{{ __('companies.create_company') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('companies.create_company') }}
                                        </span>
                                    </a>
                                </li>
                             
                            </ul>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('region*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('region.regions') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('region.regions') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('region*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('region') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('region') }}"
                                        title="{{ __('region.regions') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('region.regions') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Region::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                 
                             
                            </ul>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('countries*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('country.countries') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('country.countries') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('countries*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('countries') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('country') }}"
                                        title="{{ __('country.all_countries') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('country.all_countries') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\User::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item {{ Request::is('countries/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('country.create') }}"
                                        title="{{ __('country.create_country') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('country.create_country') }}
                                        </span>
                                    </a>
                                </li> --}}
                             
                            </ul>
                        </li>
                        <!-- Start Property Master -->
                        <li class="nav-item  ">
                            <small class="nav-subtitle" title="">{{__('property_master.property_master')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('ownership*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('ownership.index') }}" title="{{ __('property_master.ownership') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.ownership') }}
                                </span>
                            </a>
                            {{-- <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('ownership*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('ownership') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('ownership.index') }}"
                                        title="{{ __('property_master.ownership') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('property_master.ownership') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Ownership::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                 
                            </ul> --}}
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('property_type*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('property_type.index') }}" title="{{ __('property_master.property_type') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.property_type') }}
                                </span>
                            </a>
                            {{-- <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('property_type*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('property_type') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('property_type.index') }}"
                                        title="{{ __('property_master.property_type') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('property_master.property_type') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\PropertyType::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                 
                            </ul> --}}
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('block*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('block.index') }}" title="{{ __('property_master.blocks') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.blocks') }}
                                </span>
                            </a>
                            {{-- <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('block*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('block') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('block.index') }}"
                                        title="{{ __('property_master.blocks') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('property_master.blocks') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Block::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                 
                            </ul> --}}
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('floors*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('property_master.floors') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.floors') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('floors*') ? 'floor' : 'none' }}">
                                <li class="nav-item {{ Request::is('floors') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('floor.index') }}"
                                        title="{{ __('property_master.floor') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('property_master.floors') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Floor::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('floors/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('floor.create') }}"
                                        title="{{ __('property_master.floor') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('property_master.add_new_floor') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Floor::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('units*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('property_master.units') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.units') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('units*') ? 'unit' : 'none' }}">
                                <li class="nav-item {{ Request::is('units') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('unit.index') }}"
                                        title="{{ __('property_master.unit') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('property_master.units') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Unit::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('units/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('unit.create') }}"
                                        title="{{ __('property_master.unit') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('property_master.add_new_unit') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Unit::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                 
                            </ul>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('unit_description*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('unit_description.index') }}" title="{{ __('property_master.unit_descriptions') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.unit_descriptions') }}
                                </span>
                            </a>
                           
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('unit_type*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('unit_type.index') }}" title="{{ __('property_master.unit_types') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.unit_types') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('unit_condition*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('unit_condition.index') }}" title="{{ __('property_master.unit_conditions') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.unit_conditions') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('unit_parking*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('unit_parking.index') }}" title="{{ __('property_master.unit_parkings') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.unit_parkings') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('view*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('view.index') }}" title="{{ __('property_master.views') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.views') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('business_activity*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('business_activity.index') }}" title="{{ __('property_master.business_activitys') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.business_activitys') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('live_with*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('live_with.index') }}" title="{{ __('property_master.live_withs') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.live_withs') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('enquiry_status*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('enquiry_status.index') }}" title="{{ __('property_master.enquiry_statuss') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.enquiry_statuss') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('enquiry_request_status*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('enquiry_request_status.index') }}" title="{{ __('property_master.enquiry_request_statuss') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_master.enquiry_request_statuss') }}
                                </span>
                            </a>
                        </li>
                        <!-- End Property Master -->



                        <!-- Start Property Management -->
                        <li class="nav-item  ">
                            <small class="nav-subtitle" title="">{{__('property_management.property_management')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('property_management*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('property_management.index') }}" title="{{ __('property_management.property') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_management.property') }}
                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('block_management*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link "
                                href="{{ route('block_management.index') }}" title="{{ __('property_management.block') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('property_management.block') }}
                                </span>
                            </a>
                        </li>
                        <!-- End Property Management -->
                        <li class="nav-item  ">
                            <small class="nav-subtitle" title="">{{__('general.general_management')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('roles*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('roles.roles') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('roles.roles') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('roles*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('roles') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('roles') }}"
                                        title="{{ __('roles.all_roles') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('roles.all_roles') }}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                                {{\App\Models\Role::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('roles/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('roles.create') }}"
                                        title="{{ __('roles.create_role') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('roles.create_role') }}
                                        </span>
                                    </a>
                                </li>
                             
                            </ul>
                        </li>

                        <li class="nav-item  ">
                            <small class="nav-subtitle { Request::is('settings*') ? 'active' : '' }}" title="">{{__('general.settings')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('settings*') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                href="javascript:void(0)" title="{{ __('general.settings') }}">
                                <i class="tio-shopping-cart-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ __('general.settings') }}
                                </span>
                            </a>
                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                style="display: {{ Request::is('settings/company*') ? 'block' : 'none' }}">
                                <li class="nav-item {{ Request::is('settings/company') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('company_settings') }}"
                                        title="{{ __('companies.settings') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('companies.settings') }}
                                             
                                        </span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item {{ Request::is('roles/create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('roles.create') }}"
                                        title="{{ __('roles.create_role') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ __('roles.create_role') }}
                                        </span>
                                    </a>
                                </li> --}}
                             
                            </ul>
                        </li>

                        <li class="nav-item pt-5">
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

@push('script_2')
    <script>
        $(window).on('load', function() {
            if ($(".navbar-vertical-content li.active").length) {
                $('.navbar-vertical-content').animate({
                    scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
                }, 10);
            }
        });

        //Sidebar Menu Search
        var $rows = $('.navbar-vertical-content .navbar-nav > li');
        $('#search-bar-input').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
@endpush
