<?php

namespace App\Http\Controllers;
use Excel;
use App\Imports\ImportActivities;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Http\Requests\ActivityRequest;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('id', 'desc')->get();
        return view('activities.index', ['activities' => $activities]);
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Activity $activity, ActivityRequest $request) 
    {
        $input = $request->all();      
        $activity = Activity::create($input); 
        $request->session()->flash('success', 'Activity saved successfully!');
        return redirect()->route('activities.index'); 
    }
  
    public function show(Activity $activity)
    {
        //
    }

    public function edit(Activity $activity)
    {
        return view('activities.edit', ['activity' => $activity]);
    }

    public function update(Activity $activity, ActivityRequest $request) 
    {
        $activity->update($request->all());
        $request->session()->flash('success', 'Activity updated successfully!');
        return redirect()->route('activities.index');
    }
  
    public function destroy(Request $request, Activity $activity)
    {
        $activity->delete();
        $request->session()->flash('success', 'Activity deleted successfully!');
        return redirect()->route('activities.index');
    }

    public function import()
    {
        return view('activities.import');
    }

    public function importExcel(Request $request)
    {      
        try {
            $import = Excel::import(new ImportActivities, $request->file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->route('activities.index')->with('data', $failures);
        }
        return redirect()->route('activities.index');
    } 
}
