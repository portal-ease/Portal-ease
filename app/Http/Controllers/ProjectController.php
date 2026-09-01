<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Portal $portal)
    {
        return view('project.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Portal $portal)
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Portal $portal)
    {
        $request->validate([
            'name' => 'required',
            'customer_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        Project::create([
            'name' => $request->get('name'),
            'user_id' => $request->get('customer_id'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'portal_id' => currentPortal()->id,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, Project $project)
    {
        $statusCollection = ['all', 'to do', 'in progress', 'completed'];
        $status = request()->query('status', 'default');

        return view('project.show', compact('project', 'status', 'statusCollection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portal $portal, Project $project)
    {
        $project->delete();

        return view('project.index');
    }
}
