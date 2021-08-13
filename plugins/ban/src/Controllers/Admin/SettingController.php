<?php

namespace Azuriom\Plugin\Ban\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the Ban settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('ban::admin.settings', [
            'host' => setting('ban.host', '127.0.0.1'),
            'port' => setting('ban.port', '3306'),
            'database' => setting('ban.database', 'ban'),
            'username' => setting('ban.username', 'ban'),
            'password' => setting('ban.password'),
            'perPage' => setting('ban.perPage', 10),
            'historyTable' => setting('ban.historyTable', 'PunishmentHistory'),
            'punishmentTable' => setting('ban.punishmentTable', 'Punishments'),
        ]);
    }

    public function save(Request $request)
    {
        $data = $this->validate($request, [
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'database' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'perPage' => ['required', 'integer', 'between:1,100'],
            'historyTable' => ['required', 'string', 'between:1,100'],
            'punishmentTable' => ['required', 'string', 'between:1,100'],
        ]);

        Setting::updateSettings([
            'ban.host' => $request->input('host'),
            'ban.port' => $request->input('port'),
            'ban.database' => $request->input('database'),
            'ban.username' => $request->input('username'),
            'ban.password' => $request->input('password'),
            'ban.perPage' => $request->input('perPage'),
            'ban.historyTable' => $request->input('historyTable'),
            'ban.punishmentTable' => $request->input('punishmentTable'),
        ]);

        return redirect()->route('ban.admin.settings')->with('success', trans('admin.settings.status.updated'));
    }
}
