@include('shop::admin.elements.select')

@csrf

<div class="form-group">
 <label for="nameInput">{{ trans('messages.fields.name') }}</label>
 <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name"
  value="{{ old('name', $update->name ?? '') }}" required>

 @error('name')
 <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
 @enderror
</div>

<div class="form-group">
 <label for="categorySelect">{{ trans('changelog::messages.fields.category') }}</label>
 <select class="custom-select @error('category_id') is-invalid @enderror" id="categorySelect" name="category_id"
  required>
  @foreach($categories as $category)
  <option value="{{ $category->id }}" @if(($update->category_id ?? 0) === $category->id) selected
   @endif>{{ $category->name }}</option>
  @endforeach
 </select>

 @error('category_id')
 <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
 @enderror
</div>

<div class="form-group">
 <label for="descriptionArea">{{ trans('messages.fields.description') }}</label>
 <textarea class="form-control html-editor @error('description') is-invalid @enderror" id="descriptionArea"
  name="description" rows="1">{{ old('content', $update->description ?? '') }}</textarea>

 @error('description')
 <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
 @enderror
</div>
<style>
 .tox .tox-toolbar__group:nth-child(1),
 .tox .tox-toolbar__group:nth-child(3),
 .tox .tox-toolbar__group:nth-child(4),
 .tox .tox-toolbar__group:nth-child(5) {
  display: none;
 }

 .tox-tinymce {
  height: 200px !important;
 }
</style>