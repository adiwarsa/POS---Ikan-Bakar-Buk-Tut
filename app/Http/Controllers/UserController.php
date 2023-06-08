<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::latest()->paginate();
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$user = new User;
		return view('users.create', compact('user'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->validate([
			'name' => 'required|string',
			'phone' => 'required|string',
			'email' => 'required|string|email|unique:users',
			'password' => 'required|confirmed',
		]);

		$data['role'] = $request->role;
		$data['phone'] = $request->phone;
		$data['password'] = Hash::make($data['password']);
		$data['status'] = 'active';
		$data['email_verified_at'] = now();

		User::create($data);

		return to_route('users.index')->withSuccess('Data succcessfully created.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		$request->validate([
			'name' => 'required|string',
			'phone' => 'required|string',
			'email' => 'required|string|email|unique:users,email,' . $user->id,
		]);

		$data['phone'] = $request->phone;
		$data['name'] = $request->name;
		$data['role'] = $request->role;
		
		if ($request->password) {
			$data['password'] = Hash::make($request->password);
		}
		$data['email'] = $request->email;

		$user->update($data);

		return to_route('users.index')->withSuccess('Data succcessfully updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete(User $user)
	{
		$user->delete();
		return to_route('users.index')->withSuccess('Data successfully deleted.');
	}

	public function updateStatus(Request $request, $id)
    {

        $user = User::where('id', $id)->first();

        $currenttime = Carbon::Now();
        $user->update([
            'status' => $request->status,
            'updated_at' => $currenttime,
        ]);
        return to_route('users.index')->withSuccess('User successfully updated.');
    }
}
