@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@push('footer-scripts')
    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="form-row"><div class="form-group col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="form-group col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="fas fa-times"></i></button></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;

            document.getElementById('links').querySelectorAll('.form-row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                <h3>Maintenance</h3>

                <div class="form-group">
                    <label for="MaintenanceDate">{{ trans('theme::oasis.config.maintenance_date') }}</label>
                    <input type="text" class="form-control @error('maintenance') is-invalid @enderror" id="MaintenanceDate" name="maintenance" value="{{ old('maintenance', theme_config('maintenance')) }}">

                    @error('maintenance')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <hr>

                @csrf
                <div class="row">
                    <div class="col-sm">
                        @php $usePlayButton = old('use_play_button', theme_config('use_play_button')) === 'on' @endphp

                        <div class="form-group custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="playButtonSwitch" name="use_play_button" data-toggle="collapse" data-target="#playButtonGroup" @if($usePlayButton) checked @endif>
                            <label class="custom-control-label" for="playButtonSwitch">{{ trans('theme::oasis.config.use_play_button') }}</label>
                        </div>

                        <div id="playButtonGroup" class="{{ $usePlayButton ? 'show' : 'collapse' }}">
                            <div class="card card-body mb-2">
                                <div class="form-group">
                                    <label for="playButtonLink">{{ trans('theme::oasis.config.windows_link') }}</label>
                                    <input type="text" class="form-control @error('windows_link') is-invalid @enderror" id="windowslink" name="windows_link" value="{{ old('windows_link', theme_config('windows_link')) }}">

                                    <hr>

                                    <label for="playButtonLink">{{ trans('theme::oasis.config.apple_link') }}</label>
                                    <input type="text" class="form-control @error('apple_link') is-invalid @enderror" id="applelink" name="apple_link" value="{{ old('apple_link', theme_config('apple_link')) }}">

                                    <hr>

                                    <label for="playButtonLink">{{ trans('theme::oasis.config.linux_link') }}</label>
                                    <input type="text" class="form-control @error('linux_link') is-invalid @enderror" id="linuxlink" name="linux_link" value="{{ old('linux_link', theme_config('linux_link')) }}">
                                    
                                    @error('play_button_link')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <h3 class="text-center">{{ trans('theme::oasis.header.shop') }}</h3>
                <div class="row">
                    <div class="col-sm">
                        <h5 class="text-center">1</h5>
                        <div class="form-group">
                            <label for="imageShop1">{{ trans('theme::oasis.config.image-shop-1') }}</label>
                            <input type="text" class="form-control @error('image-shop-1') is-invalid @enderror" id="imageShop1" name="image-shop-1" value="{{ old('image-shop-1', theme_config('image-shop-1')) }}">

                            @error('image-shop-1')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm">
                        <h5 class="text-center">2</h5>
                        <div class="form-group">
                            <label for="imageShop2">{{ trans('theme::oasis.config.image-shop-2') }}</label>
                            <input type="text" class="form-control @error('image-shop-2') is-invalid @enderror" id="imageShop2" name="image-shop-2" value="{{ old('image-shop-2', theme_config('image-shop-2')) }}">

                            @error('image-shop-2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm">
                        <h5 class="text-center">3</h5>
                        <div class="form-group">
                            <label for="imageShop3">{{ trans('theme::oasis.config.image-shop-3') }}</label>
                            <input type="text" class="form-control @error('image-shop-3') is-invalid @enderror" id="imageShop3" name="image-shop-3" value="{{ old('image-shop-3', theme_config('image-shop-3')) }}">

                            @error('image-shop-3')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm">
                        <h3>Youtube</h3>
                        <div class="form-group">
                            <label for="youtubelink">{{ trans('theme::oasis.config.youtube_link') }}</label>
                            <input type="text" class="form-control @error('youtube_link') is-invalid @enderror" id="youtubelink" name="youtube_link" value="{{ old('youtube_link', theme_config('youtube_link')) }}">

                            @error('youtube_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm">
                        <h3>Discord</h3>
                        <div class="form-group">
                            <label for="discordId">{{ trans('theme::oasis.config.discord_id') }}</label>
                            <input type="text" class="form-control @error('discord_id') is-invalid @enderror" id="discordId" name="discord_id" value="{{ old('discord_id', theme_config('discord_id')) }}">

                            @error('discord_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm">
                        <h3>Twitter</h3>
                        <div class="form-group">
                            <label for="twitterName">{{ trans('theme::oasis.config.twitter_name') }}</label>
                            <input type="text" class="form-control @error('twitter_name') is-invalid @enderror" id="twitterName" name="twitter_name" value="{{ old('twitter_name', theme_config('twitter_name')) }}">

                            @error('twitter_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <h3>Footer</h3>

                <div class="form-group">
                    <label for="footerDescriptionInput">{{ trans('theme::oasis.config.footer_description') }}</label>
                    <textarea class="form-control @error('footer_description') is-invalid @enderror" id="footerDescriptionInput" name="footer_description" rows="3">{{ old('footer_description', theme_config('footer_description')) }}</textarea>

                    @error('footer_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <hr>

                <div class="form-group">
                    <label for="footerArticleInput">{{ trans('theme::oasis.config.footer_article') }}</label>
                    <textarea class="form-control @error('footer_article') is-invalid @enderror" id="footerArticleInput" name="footer_article" rows="2">{{ old('footer_article', theme_config('footer_article')) }}</textarea>

                    @error('footer_article')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <label>{{ trans('theme::oasis.config.footer_links') }}</label>

                <div id="links">

                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger link-remove" type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm">
                        @foreach(['twitter', 'youtube', 'discord','steam'] as $social)
                            <div class="form-group">
                                <label for="{{ $social }}Input">{{ trans('theme::oasis.links.'.$social) }}</label>
                                <input type="text" class="form-control @error('footer_social_'.$social) is-invalid @enderror" id="{{ $social }}Input" name="footer_social_{{ $social }}" value="{{ old('footer_social_'.$social, theme_config('footer_social_'.$social)) }}">

                                @error('footer_social_'.$social)
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    <div class="col-sm">
                        @foreach(['teamspeak', 'instagram','twitch','facebook'] as $social)
                            <div class="form-group">
                                <label for="{{ $social }}Input">{{ trans('theme::oasis.links.'.$social) }}</label>
                                <input type="text" class="form-control @error('footer_social_'.$social) is-invalid @enderror" id="{{ $social }}Input" name="footer_social_{{ $social }}" value="{{ old('footer_social_'.$social, theme_config('footer_social_'.$social)) }}">

                                @error('footer_social_'.$social)
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
