<?php

namespace Azuriom\Plugin\Ban\Controllers;

use Azuriom\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BanHomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		if (config()->get('database.connections.ban') === null) {
			abort_if(setting('ban.host') === null, 404);

	        config()->set('database.connections.ban', [
	            'driver'    => 'mysql',
	            'host'      => setting('ban.host', '127.0.0.1'),
	            'port'      => setting('ban.port', '3306'),
	            'database'  => setting('ban.database', 'ban'),
	            'username'  => setting('ban.username', 'ban'),
	            'password'  => setting('ban.password'),
	            'charset'   => 'utf8',
	            'collation' => 'utf8_unicode_ci',
	            'prefix'    => '',
	            'strict'    => false
	        ]);
	    }

	    $query = strtolower($request->input('q'));

	    $punishmentHistory = DB::connection('ban')->select('SELECT * FROM ' . setting('ban.historyTable', 'PunishmentHistory') . ' ORDER BY start DESC');
	    $punishments = DB::connection('ban')->select('SELECT * FROM ' . setting('ban.punishmentTable', 'Punishments') . ' ORDER BY start DESC');
	    
	    $allPunishments = collect(array_merge($punishmentHistory, $punishments))->unique();

	    if ($query) {
	    	$allPunishments = $allPunishments->filter(function ($item) use ($query) {
		    	return Str::contains(strtolower($item->name), $query) || 
		    		Str::contains(strtolower($item->reason), $query) ||
		    		Str::contains(strtolower($item->operator), $query) ||
		    		Str::contains(strtolower($item->punishmentType), $query);
	    	});
	    }

	    $currentPage = LengthAwarePaginator::resolveCurrentPage();
	    $perPage = setting('ban.perPage', 10);

	    $currentItems = $allPunishments->slice($perPage * ($currentPage - 1), $perPage);
	    $paginator = new LengthAwarePaginator($currentItems, count($allPunishments), $perPage, $currentPage, ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        return view('ban::index', ['punishments' => $punishments, 'punishmentHistory' => $punishmentHistory, 'allPunishments' => $paginator]);
    }
}
