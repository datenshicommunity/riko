<div class="list-group mb-3">
    <div class="text-center user">
        @auth
            <div style="width: {{ strlen(Auth::user()->name) }}em" class="cadre-nom">
                <h5>{{ Auth::user()->name }}</h5>
            </div>
            <img src="{{ auth::user()->getAvatar() }}" class="img-fluid" alt="User" width="60">
        @else
            <div style="width: 6em" class="cadre-nom">
                <h5>Player</h5>
            </div>
        @endauth
    </div>
    @foreach($categories as $subCategory)
        <a href="{{ route('shop.categories.show', $subCategory) }}" style="text-decoration: none;" class="list-group-item @if($category->is($subCategory)) active @endif">
            {{ $subCategory->name }}
        </a>

        @foreach($subCategory->categories ?? [] as $cat)
            <a href="{{ route('shop.categories.show', $cat) }}" style="text-decoration: none;" class="list-group-item pl-5 @if($category->is($cat)) active @endif">
                {{ $cat->name }}
            </a>
        @endforeach
    @endforeach
    @auth
        <div class="argent">
            <p class="text-center"><i class="fas fa-coins"></i>&nbsp;&nbsp;{{ format_money(auth()->user()->money) }}</p>
        </div>
    @endauth
</div>

@auth
    <div class="mb-4">
        @if(use_site_money())
            <a href="{{ route('shop.offers.select') }}" class="btn btn-primary btn-block"><i class="fas fa-plus"></i>&nbsp;{{ trans('shop::messages.cart.credit') }}</a>
        @endif
        <a href="{{ route('shop.cart.index') }}" class="btn btn-primary btn-block"><i class="fas fa-shopping-basket"></i>&nbsp;{{ trans('shop::messages.cart.title') }}</a>
    </div>
@endauth

@if($goal !== false)
    <div class="mb-4">
        <h4>{{ trans('shop::messages.month-goal') }}</h4>

        <div class="progress mb-1">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $goal }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $goal }}%"></div>
        </div>

        <p class="text-center">{{ trans_choice('shop::messages.month-goal-current', $goal) }}</p>
    </div>
@endif
