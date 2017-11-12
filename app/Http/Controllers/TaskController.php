<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Tag;
use App\User;
use App\Status;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tasks = Task::filter($request->all())->orderByDesc('id')->paginateFilter(10);
        $statuses = Status::orderBy('id')->get();
        $users = User::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        $statusesArray = [];
        foreach ($statuses as $status) {
            $statusesArray[$status->id] = $status->name;
        }

        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[$user->id] = "{$user->name} ({$user->email})";
        }

        $tagsArray = [];
        foreach ($tags as $tag) {
            $tagsArray[$tag->id] = $tag->name;
        }

        return view('tasks')
            ->with(compact('tasks'))
            ->with(compact('statuses'))
            ->with(compact('users'))
            ->with(compact('statusesArray'))
            ->with(compact('usersArray'))
            ->with(compact('tagsArray'))
            ->with(compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::orderBy('id')->get();
        $users = User::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        $statusesArray = [];
        foreach ($statuses as $status) {
            $statusesArray[$status->id] = $status->name;
        }

        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[$user->id] = "{$user->name} ({$user->email})";
        }

        return view('create_task')
            ->with(compact('statuses'))
            ->with(compact('users'))
            ->with(compact('statusesArray'))
            ->with(compact('usersArray'))
            ->with(compact('tags'));
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
        $task = new Task;
        $task->fill($request->all());
        $task->save();
        flash("Successfully added new '{$request->name}' task")->success();

        if (is_array($request->tags_ids)) {
            foreach ($request->tags_ids as $tag_id) {
                $task->tags()->attach($tag_id);
                $tag = Tag::findOrFail($tag_id);
                flash("Successfully added '{$tag->name}' tag for '{$request->name}' task")->success();
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
//        return view('show_task', ['task' => Task::findOrFail($task->id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $statuses = Status::orderBy('id')->get();
        $users = User::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        $statusesArray = [];
        foreach ($statuses as $status) {
            $statusesArray[$status->id] = $status->name;
        }

        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[$user->id] = "{$user->name} ({$user->email})";
        }

        return view('edit_task')
            ->with('task', Task::findOrFail($task->id))
            ->with(compact('statuses'))
            ->with(compact('users'))
            ->with(compact('statusesArray'))
            ->with(compact('usersArray'))
            ->with(compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $this->validator($request);
        $task->fill($request->all());
        $task->save();
        flash("Successfully updated '{$task->name}' task")->success();

        $task->tags()->detach();
        if (is_array($request->tags_ids)) {
            foreach ($request->tags_ids as $tag_id) {
                $task->tags()->attach($tag_id);
                $tag = Tag::findOrFail($tag_id);
                flash("Successfully added '{$tag->name}' tag for '{$request->name}' task")->success();
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash('Task removed')->warning();

        return redirect()->route('tasks.index');
    }

    /**
     * @param Request $data
     * @return array
     */
    protected function validator(Request $data)
    {
        return $data->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'nullable',
                'string',
                'max:255'
            ],
            'status_id' => [
                'required',
                'integer',
                'exists:statuses,id'
            ],
            'creator_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'assignedto_id' => [
                'nullable',
                'integer',
                'exists:users,id'
            ],
            'tags_ids.*' => [
                'nullable',
                'integer',
                'exists:tags,id'
            ],
        ]);
    }
}
