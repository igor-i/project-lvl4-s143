<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\User;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::filter($request->all())->orderBy('id', 'desc')->paginateFilter(10);
        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('profile', ['user' => User::findOrFail($user->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if ($this->validator($request, $user)) {
            $user->fill($request->all());
            $user->save();
            flash('Successfully updated user profile')->success();
        } else {
            flash('Failed to update user profile')->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash('The user account is removed')->warning();

        return redirect()->route('welcome.index');
    }

    /**
     * @param Request $data
     * @param User $user
     * @return array
     */
    protected function validator(Request $data, User $user = null)
    {
        return $data->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                $user ? Rule::unique('users')->ignore($user->id) : 'unique:users'
            ]
        ]);
    }
}
