<?php

namespace Azuriom\Plugin\Changelog\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
 public function save(Request $request)
 {
  $validated = $this->validate($request, [
   'perpage' => ['required', 'integer', 'between:1,100'],
  ]);

  Setting::updateSettings([
   'changelog.perpage' => $validated['perpage'],
  ]);

  return redirect()->route('changelog.admin.updates.index')->with('success', trans('admin.settings.status.updated'));
 }
}
