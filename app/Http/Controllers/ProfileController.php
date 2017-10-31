<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ]
        ]);

        DB::table('users')
            ->where('id', Auth::id())
            ->update(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'updated_at' => Carbon::now()
                ]
            );

        return redirect()->route('profile.edit');
    }

    /**
     * Delete the user's profile.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        \Log::debug('Here is some debug information');
        DB::table('users')->where('id', Auth::id())->delete();
        return redirect()->route('welcome.index');
    }
}
