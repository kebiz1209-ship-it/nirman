<style>
.navbar {
    min-height: 50px !important;
    height: 50px;
}

.navbar .badge {
    font-size: 11px;
    padding: 4px 6px;
}

.navbar .dropdown-toggle {
    padding: 4px 8px;
    font-size: 12px;
}

.navbar .btn {
    padding: 4px 8px;
    line-height: 1.2;
}

.navbar .d-flex {
    align-items: center;
}

.black_test {
    color: #000;
}
.dropdown-menu {
    min-width: 140px !important;
    padding: 4px 0 !important;
    font-size: 13px !important;
}

.dropdown-item {
    padding: 5px 10px !important;
    font-size: 13px !important;
}

.dropdown-toggle {
    padding: 3px 8px !important;
    font-size: 12px !important;
}
</style>



<nav class="navbar navbar-static-top">
    <div class="wrapper_up_wrapper">
        <div class="hh_wrapper">
            <div class="navbar-custom-menu navbar-menu-left">
                <div class="menu-trigger-box ">
                    <div class="d-flex">
                        <button data-toggle="push-menu" type="button" class="st new-btn mobile_sideber_hide_show">
                            <iconify-icon icon="ri:menu-fold-fill" width="22"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
            <div class="navbar-custom-menu navbar-menu-right">
                <div class="d-inline-flex align-items-center gap-2">



                    @php
                    $currentOutlet = \App\Outlet::find(session('outlet_id'));

                    $outlets = \App\Outlet::where('company_id', Auth::user()->company_id)
                    ->where('del_status', 'Live')
                    ->get();
                    @endphp

                    <div class="d-flex align-items-center me-2" style="height: 40px;">

                        {{-- Current Outlet --}}
                        @if($currentOutlet)
                        <span class="badge bg-success me-1">
                            {{ $currentOutlet->outlet_name }}
                        </span>
                        @else
                        <span class="badge bg-danger me-1">
                            No Outlet
                        </span>
                        @endif

                        {{-- Change Outlet Dropdown --}}
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle black_test"
                                data-bs-toggle="dropdown">
                                Change
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                @foreach($outlets as $outlet)
                                <li>
                                    <a class="dropdown-item {{ session('outlet_id') == $outlet->id ? 'active' : '' }}"
                                        href="{{ route('outlets.select', encrypt_decrypt($outlet->id,'encrypt')) }}">
                                        {{ $outlet->outlet_name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <a class="new-btn" href="{{ route('check-in-out') }}">
                        <iconify-icon icon="solar:clock-circle-broken" width="20"></iconify-icon>
                        <span class="mobile-d-ln-none">@lang('index.check_in_out')</span>
                    </a>
                    <!-- Language And Dropdown -->
                    <div class="dropdown language-dropdown me-2">
                        @php
                        $language = auth()->check() && Auth::user()->language != null;
                        @endphp
                        <button class="dropdown-toggle new-btn" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (auth()->check() && Auth::user()->language != null)
                            <iconify-icon icon="ion:language" width="20"></iconify-icon>
                            <span
                                class="mobile-d-ln-none">{{ lanFullName(auth()->check() ? Auth::user()->language : '') }}</span>
                            @else
                            <iconify-icon icon="ion:language" width="20"></iconify-icon>
                            <span class="mobile-d-ln-none">English</span>
                            @endif
                        </button>
                        <ul dir="ltr" class="dropdown-menu dropdown-menu-light dropdown-menu-lang language_dropdown">
                            @foreach (languageFolders() as $dir)
                            <li class="lang_list">
                                <a class="dropdown-item" href="{{ url('set-locale/' . $dir) }}">
                                    {{ lanFullName($dir) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- User Image And Dropdown -->
                    <ul class="menu-list">
                        <!-- User Profile And Dropdown -->
                        <li class="user-info-box">
                            <div class="user-profile">

                                @if (Auth::user()->photo != null && file_exists('uploads/user_photos/' .
                                Auth::user()->photo))
                                <img class="user-avatar"
                                    src="{{ $baseURL }}uploads/user_photos/{{ auth()->user()->photo }}"
                                    alt="user-image">
                                @else
                                <img class="user-avatar" src="{{ $baseURL }}assets/images/avatar.png" alt="user-image">
                                @endif

                            </div>
                            <div class="c-dropdown-menu user_profile_active">
                                <ul>
                                    <li class="common-margin">
                                        <div>
                                            <div class="user-info d-flex align-items-center">
                                                @if (Auth::user()->photo != null and file_exists('uploads/user_photos/'
                                                . Auth::user()->photo))
                                                <img class="user-avatar-inner"
                                                    src="{{ $baseURL }}uploads/user_photos/{{ auth()->user()->photo }}"
                                                    alt="user-image">
                                                @else
                                                <img class="user-avatar-inner"
                                                    src="{{ $baseURL }}assets/images/avatar.png" alt="user-image">
                                                @endif
                                                <div class="ps-2">
                                                    <p class="user-name mb-0 font-weight-700">{{ Auth::user()->name }}
                                                    </p>
                                                    <span
                                                        class="user-role user-role-second">{{ Auth::user()->designation }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li class="common-margin d-flex align-items-center">
                                        <a href="{{ url('change-profile') }}">
                                            <iconify-icon icon="solar:user-circle-broken" width="22" class="me-2">
                                            </iconify-icon>
                                            @lang('index.change_profile')
                                        </a>
                                    </li>

                                    <li class="common-margin">
                                        <a href="{{ url('change-password') }}">
                                            <iconify-icon icon="solar:key-minimalistic-2-broken" width="22"
                                                class="me-2"></iconify-icon>
                                            @lang('index.change_password')
                                        </a>
                                    </li>

                                    <li class="common-margin">
                                        <a href="{{ url('security-question') }}">
                                            <iconify-icon icon="solar:question-circle-broken" width="22" class="me-2">
                                            </iconify-icon>
                                            @lang('index.security_question')
                                        </a>
                                    </li>

                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>

                                    <li class="common-margin">
                                        <a href="javascript:void(0)" class="logOutTrigger">
                                            <iconify-icon icon="solar:logout-broken" width="22" class="me-2">
                                            </iconify-icon>
                                            @lang('index.logout')
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>