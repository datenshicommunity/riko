<div class="pos-f-t menu-portable">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            @foreach($navbar as $element)
                @if($loop->index < ($loop->count))
                    @if(!$element->isDropdown())
                        <li class="nav-item @if($element->isCurrent()) active @endif">
                            <a class="nav-link" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $element->name }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $element->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($element->elements as $childElement)
                                    <a class="dropdown-item @if($childElement->isCurrent()) text-primary @endif" href="{{ $childElement->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $childElement->name }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</div>

<div class="sub-navbar bg-primary py-2">
    <div class="container">
        <div class="row section-row">
            <div class="d-flex align-items-center section-1">
                <div class="media align-items-center">
                    <i class="fas fa-globe-europe fa-2x mr-2"></i>
                    <div class="media-body">
                        @if($server && $server->isOnline())
                            {{ trans_choice('theme::oasis.header.online', $server->getOnlinePlayers()) }}
                        @else
                            <h6 class="mb-0">{{ trans('theme::oasis.header.offline') }}</h6>
                        @endif
                    </div>
                </div>
            </div>

            <div class="section-1">
                @auth
                    @include('elements.notifications')

                    <span class="dropdown">
                        <a id="userDropdown" class="btn btn-outline-light btn-menu dropdown-toggle my-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            {{ trans('messages.nav.profile') }}
                        </a>

                        @if(Auth::user()->hasAdminAccess())
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                {{ trans('messages.nav.admin') }}
                            </a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ trans('auth.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    </span>
                @else
                    <div class="my-1 btn-group">
                        @if(Route::has('register'))
                            <a class="btn btn-outline-light btn-menu" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                        @endif
                        <a class="btn btn-outline-light btn-menu" href="{{ route('login') }}">{{ trans('auth.login') }}</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<div class="home-background background-overlay" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') no-repeat center / cover">
    <nav class="navbar navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar">
            <!-- Navbar -->
            <ul class="navbar-nav">
                @foreach($navbar as $element)
                    @if($loop->index < ($loop->count))
                        @if(!$element->isDropdown())
                            <li class="nav-item @if($element->isCurrent()) active @endif">
                                <a class="nav-link" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $element->name }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $element->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($element->elements as $childElement)
                                        <a class="dropdown-item @if($childElement->isCurrent()) text-primary @endif" href="{{ $childElement->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $childElement->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>


    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="logo">
                <a class="col-md-6 text-center"  href="{{ route('home') }}">
                    <img src="{{ site_logo() }}" alt="{{ site_name() }}" data-tilt data-tilt-scale="1.2" width="250">
                </a>
            </div>
        </div>
    </div>

    <div class="media-menu">
        @foreach(['twitter', 'youtube', 'discord', 'steam', 'teamspeak', 'instagram','twitch','facebook'] as $social)
            @if($socialLink = theme_config("footer_social_{$social}"))
                <li class="social-media">
                    <a href="{{ $socialLink }}" target="_blank" rel="noreferrer noopener" title="{{ trans('theme::oasis.links.'.$social) }}"><i class="fab fa-{{ $social }} fa-2x"></i></a>
                </li>
            @endif
        @endforeach
    </div>
</div>

<div class="d-flex align-items-center section-1">
    <div class="media align-items-center">
        <div class="media-body">
            @if(theme_config('use_play_button') === 'on')
                <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-menu btn-jouer">{{ trans('theme::oasis.play') }}</button>
            @else
                @if($server && $server->isOnline())
                    <div data-toggle="tooltip" title="{{ trans('messages.actions.copy') }}" data-copy-target="address" data-copied-messages="{{ implode('|', trans('theme::oasis.clipboard')) }}">
                        <input type="text" class="copy-address h5 text-center ip-bar" id="address" style="width: {{ strlen($server->fullAddress()) / 1.5 }}em" value="{{ $server->fullAddress() }}" readonly aria-label="Address">
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header launcher-bg">
            <h5 class="text-center" id="exampleModalLabel">{{ trans('theme::oasis.launcher') }}</h5>
            <a href="" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></a>
        </div>
        <div class="modal-body launcher-bg">
            <div class="row">
                <a href="{{ theme_config('windows_link') }}">
                    <i class="fab fa-windows"></i>
                    <p>Windows</p>
                </a>
                <a href="{{ theme_config('apple_link') }}">
                    <i class="fab fa-apple"></i>
                    <p>Apple</p>
                </a>
                <a href="{{ theme_config('linux_link') }}">
                    <i class="fab fa-linux"></i>
                    <p>Linux</p>
                </a>
            </div>
        </div>
        <div class="modal-footer launcher-bg">
            <button type="button" data-dismiss="modal" class="btn btn-primary">{{ trans('theme::oasis.close') }}</button>
        </div>
    </div>
  </div>
</div>

