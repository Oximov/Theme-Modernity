<nav class="navbar navbar-expand-md navbar-dark">

    <div class="container">
        <a class="navbar-brand mr-4 font-title" href="{{ route('home') }}">
            @if(setting('logo'))
                <img src="{{ image_url(setting('logo')) }}">
            @else
                {{ site_name() }}
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse font-link" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto font-link">
                @foreach($navbar as $element)
                    @if(!$element->isDropdown())
                        <li class="nav-item">
                            <a class="nav-link" style="color: #ffffff; text-transform: initial; text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 700;" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif >{{ $element->name }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown{{ $element->id }}"  class="nav-link dropdown-toggle font-link"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   style="color: #ffffff; text-transform: initial; text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 700;">
                                {{ $element->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                                @foreach($element->elements as $childElement)
                                    <a class="dropdown-item font-link"   style="color: black; text-transform: initial; text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 700;" href="{{ $childElement->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $childElement->name }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <div class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if(Route::has('register'))
                        <a class="btn btn-outline-light mx-1 my-2" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                    @endif
                    <a class="btn btn-secondary mx-1 my-2" href="{{ route('login') }}">{{ trans('auth.login') }}</a>
                @else
                
                @include('elements.notifications')
                    <li class="nav-item dropdown">
                        <a id="userDropdown"  style="color: #ffffff; text-transform: initial; text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 700;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><img src="https://minotar.net/helm/{{ Auth::user()->name }}/100.png" width="20px"> </img>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item font-dropdown" href="{{ route('profile.index') }}">
                                {{ trans('messages.nav.profile') }}
                            </a>

                            @if(Auth::user()->hasAdminAccess())
                                <a class="dropdown-item admin" href="{{ route('admin.dashboard') }}">
                                    {{ trans('messages.nav.admin') }}
                                </a>
                            @endif

                            <a class="dropdown-item font-dropdown" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> 
                                {{ trans('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </div>
        </div>
    </div>
</nav>
