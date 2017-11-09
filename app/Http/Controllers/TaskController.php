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

        return view('tasks')
            ->with(compact('tasks'))
            ->with(compact('statuses'))
            ->with(compact('users'))
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

        return view('create_task')
            ->with(compact('statuses'))
            ->with(compact('users'))
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
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status_id = $request->status;
        $task->creator_id = $request->creator;
        $task->assignedto_id = $request->assignedto;
        $task->save();
        flash("Successfully added new '{$request->name}' task")->success();

        if (is_array($request->tag)) {
            foreach ($request->tag as $item) {
                $task->tags()->attach($item);
                $tag = Tag::findOrFail($item);
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

        return view('edit_task')
            ->with('task', Task::findOrFail($task->id))
            ->with(compact('statuses'))
            ->with(compact('users'))
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
        $task->fill([
            'name' => $request->name,
            'description' => $request->description,
            'status_id' => $request->status,
            'creator_id' => $request->creator,
            'assignedto_id' => $request->assignedto
        ]);
        $task->save();
        flash("Successfully updated '{$task->name}' task")->success();

        $task->tags()->detach();
        if (is_array($request->tag)) {
            foreach ($request->tag as $item) {
                $task->tags()->attach($item);
                $tag = Tag::findOrFail($item);
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
            'status' => [
                'required',
                'integer',
                'exists:statuses,id'
            ],
            'creator' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'assignedto' => [
                'nullable',
                'integer',
                'exists:users,id'
            ],
            'tag.*' => [
                'nullable',
                'integer',
                'exists:tags,id'
            ],
        ]);
    }
}
