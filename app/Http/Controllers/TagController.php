<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Tag;

class TagController extends Controller
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
        $tags = Tag::filter($request->all())->orderByDesc('id')->paginateFilter(10);
        return view('tags', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_tag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->validator($request)) {
            $tag = new Tag;
            $tag->name = $request->name;
            $tag->save();
            flash("Successfully added new '{$request->name}' tag")->success();
        } else {
            flash("Failed to added new '{$request->name}' tag")->error();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tag $tag)
    {
        return view('edit_tag', ['tag' => Tag::findOrFail($tag->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Tag $tag)
    {
        if ($this->validator($request, $tag)) {
            $tag->fill($request->all());
            $tag->save();
            flash("Successfully updated '{$tag->name}' tag")->success();
        } else {
            flash("Failed to updated '{$tag->name}' tag")->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        flash('Tag removed')->warning();

        return redirect()->route('tags.index');
    }

    /**
     * @param Request $data
     * @param Tag $tag
     * @return array
     */
    protected function validator(Request $data, Tag $tag = null)
    {
        return $data->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                $tag ? Rule::unique('tags')->ignore($tag->id) : 'unique:tags'
            ],
        ]);
    }
}
