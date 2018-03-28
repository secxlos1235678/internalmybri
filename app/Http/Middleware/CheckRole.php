<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role = null, $role2 = null, $role3 = null, $role4 = null, $role5 = null, $role6 = null) {
		$data = $this->getUser();
		$roles = [$role, $role2, $role3, $role4, $role5, $role6];
		if (!in_array($data['role'], $roles)) {
			return redirect()->route('dashboard');
		}
		return $next($request);
	}

	public function getUser() {

		/* GET UserLogin Data */
		$users = session()->get('user');
		foreach ($users as $user) {
			$data = $user;
		}
		return $data;
	}
}
