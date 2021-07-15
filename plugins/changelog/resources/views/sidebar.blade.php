<div class="list-group mb-3">
 @if (!$categories == null)
 <a href="/changelog"
  class="list-group-item d-flex justify-content-between align-items-center @if(request()->route('category') === null) active @endif">
  {{ trans('changelog::messages.home')}}<span
   class="badge ml-1 @if(request()->route('category') === null) badge-secondary @else badge-primary @endif">{{ count($updates) }}</span>
 </a>
 @endif
 @foreach($categories as $categoryList)
 <a href="{{ route('changelog.categories.show', $categoryList) }}"
  class="list-group-item d-flex justify-content-between align-items-center @if($category->is($categoryList) && request()->route('category') !== null) active @endif">
  {{ $categoryList->name }}<span
   class="badge ml-1 @if($category->is($categoryList) && request()->route('category') !== null) badge-secondary @else badge-primary @endif">{{ count($categoryList->updates) }}</span>
 </a>
 @endforeach
</div>