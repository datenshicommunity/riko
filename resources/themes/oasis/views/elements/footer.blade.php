<div class="liens">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>{{ trans('theme::oasis.footer.about') }}</h3>

                <p>{!! theme_config('footer_description') !!}</p>
            </div>
            <div class="col-md-3 links">
                <h3>{{ trans('theme::oasis.footer.links') }}</h3>

                <p>{!! theme_config('footer_article') !!}</p>

                <ul class="list-unstyled">
                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <li>
                            <a href="{{ $link['value'] }}"><i class="fas fa-long-arrow-alt-right"></i> {{ $link['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 social">
                <h3>{{ trans('theme::oasis.footer.social') }}</h3>

                <ul class="list-inline">
                    @foreach(['twitter', 'youtube', 'discord', 'steam', 'teamspeak', 'instagram','twitch','facebook'] as $social)
                        @if($socialLink = theme_config("footer_social_{$social}"))
                            <li class="list-inline-item">
                                <a href="{{ $socialLink }}" target="_blank" rel="noreferrer noopener" title="{{ trans('theme::oasis.links.'.$social) }}"><i class="fab fa-{{ $social }} fa-2x"></i></a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="copyright">
    <div class="container">
        <div class="row footer-bottom">
            <div class="col-md-6">
                <h4>{{ setting('copyright') }}</h4>
            </div>
            <div class="col-md-6 text-right">
                <h4>{{ trans('theme::oasis.footer.azuriom_copyright') }} <a href="https://azuriom.com/" target="_blank">Azuriom</a> - {{ trans('theme::oasis.footer.rqmain_copyright') }} <a href="https://discord.com/invite/zgJcm3U" target="_blank">Rqmain</a>.</h4>
            </div>
        </div>
    </div>
</div>