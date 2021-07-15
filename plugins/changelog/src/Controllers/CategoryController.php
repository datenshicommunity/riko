<?php

namespace Azuriom\Plugin\Changelog\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Changelog\Models\Category;
use Azuriom\Plugin\Changelog\Models\Update;

class CategoryController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  $category = Category::scopes(['enabled'])->first();

  if ($category === null) {
   return view('changelog::index');
  }

  return $this->show($category);
 }

 /**
  * Display the specified resource.
  *
  * @param  \Azuriom\Plugin\Changelog\Models\Category  $category
  * @return \Illuminate\Http\Response
  */
 public function show(Category $category)
 {
  $categories = Category::scopes(['enabled'])
   ->withCount('updates')
   ->get()
   ->filter(function (Category $cat) use ($category) {
    return $cat->is($category) || $cat->updates_count >= 0;
   });

  $updates = Update::all();

  foreach ($category->updates as $update) {
   $update->setRelation('category', $category);
  }

  return view('changelog::show', [
   'category' => $category,
   'categories' => $categories,
   'updates' => $updates,
  ]);
 }
}
