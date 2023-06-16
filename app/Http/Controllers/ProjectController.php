<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        return view("project.index", [
            "projects" => Project::filter($request),
            "categories" => Category::all(),
            "search" => $request->all()
        ]);
    }

    public function create()
    {
        return view("project.form",[
            "categories" => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(Project::RULE);
        Project::create($request->all());
        $request->session()->flash('status', 'Created successfully !');
        return Redirect::route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("project.show",[
            "project" => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view("project.form", [
            "project" => $project,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(Project::RULE);
        $project->update($request->all());
        return Redirect::route("projects.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return Redirect::route("projects.index");
    }
}
