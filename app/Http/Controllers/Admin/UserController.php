<?php

namespace App\Http\Controllers\Admin;

use App\ChargeBack;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user )
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user
            ->withTrashed()
            ->get();

        return view('admin.user.index')
            ->with('users', $users);
    }

    public function edit($id)
    {
        $user = $this->user
            ->withTrashed()
            ->findOrFail($id);

        return view('admin.user.edit')
            ->with('user', $user);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->user
            ->withTrashed()
            ->find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->street_name = $request->street_name;
        $user->street_nr = $request->street_nr;

        $user->save();

        return redirect()
            ->route('admin.user.index');
    }

    public function destroy($id)
    {
        $this->user
            ->findOrFail($id)
            ->delete();

        return redirect()
            ->route('admin.user.index');
    }
}
