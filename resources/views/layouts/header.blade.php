<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky top-0">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-globe"></i> @lang('Go to website')</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown nav-margin">
            <a class="nav-link dropdown-toggle flex items-center gap-1 bg-slate-200 p-1 rounded-xl" data-toggle="dropdown" href="#">
                <img src="{{ asset($companySettings->company_logo) }}" alt="user-img" width="36" class="img-circle">
                <b id="ambitious-user-name-id" class="hidden-xs">{{ \Illuminate\Support\Str::limit($company_full_name, 20, '...') }}</b>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded-xl shadow-sm overflow-hidden">
                <div class="dropdown-divider"></div>
                @foreach ($companySwitchingInfo as $key => $value)
                    <a href="{{ route('company.companyAccountSwitch', ['company_switch' => $key]  ) }}" class="dropdown-item" @if ($key == Session::get('companyInfo')) @endif>
                        <i class="fas fa-building mr-2"></i> {{ \Illuminate\Support\Str::limit($value, 20, '...') }}
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{ route('company.index') }}" class="dropdown-item"><i class="fa fa-sliders-h mr-2"></i> {{ __('Manage Company') }}</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            @php
                $locale = App::getLocale();
            @endphp
            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @foreach ($getLang as $key => $value)
                    @if($locale == $key)
                        <span  class="flag-icon {{ $flag[$key] }}"> </span> <span id="ambitious-flag-name-id">{{ $value }}</span> </a>
                    @endif
            @endforeach
            <div class="dropdown-menu" aria-labelledby="dropdown09">
                @foreach ($getLang as $key => $value)
                       <a class="dropdown-item" href="{{ route('lang.index', ['language' => $key]) }}" @if ($key == $locale) @endif><span class="flag-icon {{ $flag[$key] }}"> </span>  {{ $value }}</a>
                @endforeach
            </div>
        </li>
        <li class="nav-item dropdown">
            <?php
                if(Auth::user()->photo == NULL)
                {
                    $photo = "assets/images/profile/male.png";
                } else {
                    $photo = Auth::user()->photo;
                }
            ?>
            <a class="nav-link dropdown-toggle p-1 bg-blue-200 flex items-center gap-2 px-2 rounded-full" data-toggle="dropdown" href="#">
                <img src="{{ asset($photo) }}" alt="user-img" width="36" class="img-circle">
                <b id="ambitious-user-name-id" class="hidden-xs">{{  strtok(Auth::user()->name, " ") }}</b>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded-xl shadow-sm overflow-hidden">
                <div class="dw-user-box flex item-center gap-2">
                    <div class="u-img rounded-xl overflow-hidden"><img src="{{ asset($photo) }}" alt="user" /></div>
                    <div class="u-text">
                        <h2 class="text-lg">{{ Auth::user()->name }}</h2>
                        <p class="text-muted" class="custom-padding-bottom-5">{{ \Illuminate\Support\Str::limit(Auth::user()->email, 17) }}</p>
                        <a href="{{ route('profile.view') }}" class="btn bg-blue-500 text-white rounded-full">{{ __('View Profile') }}</a>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile.view') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> {{ __('My Profile') }}
                </a>
                <a href="{{ route('profile.setting') }}" class="dropdown-item">
                    <i class="fas fa-cogs mr-2"></i> {{ __('Account Setting') }}
                </a>
                <a href="{{ route('profile.password') }}" class="dropdown-item">
                    <i class="fa fa-key mr-2"></i></i> {{ __('Change Password') }}
                </a>
                <div class="dropdown-divider"></div>
                <a id="header-logout" href="{{ route('logout') }}" class="dropdown-item text-red-500"><i class="fa fa-power-off mr-2"></i> {{ __('Logout') }}</a>
                <form id="logout-form" class="ambitious-display-none" action="{{ route('logout') }}" method="POST">@csrf</form>
            </div>
        </li>
    </ul>
</nav>
<script src="{{ asset('assets/js/custom/layouts/header.js') }}"></script>
