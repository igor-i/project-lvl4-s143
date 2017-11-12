<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Status;

class StatusController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $statuses = Status::filter($request->all())->orderBy('id', 'desc')->paginateFilter(10);
        return view('statuses', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_status');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);
        $status = new Status;
        $status->fill($request->all());
        $status->save();
        flash("Successfully added new '{$request->name}' task status")->success();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Status $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Status $status)
    {
        return view('edit_status', ['status' => Status::findOrFail($status->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Status $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Status $status)
    {
        $this->validator($request, $status);
        $status->fill($request->all());
        $status->save();
        flash("Successfully updated '{$status->name}' task status")->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Status $status)
    {
        $status->delete();
        flash("Task status '{$status->name}' removed")->warning();

        return redirect()->route('statuses.index');
    }

    /**
     * @param Request $data
     * @param Status $status
     * @return array
     */
    protected function validator(Request $data, Status $status = null)
    {
        return $data->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                $status ? Rule::unique('statuses')->ignore($status->id) : 'unique:statuses'
            ],
        ]);
    }
}
