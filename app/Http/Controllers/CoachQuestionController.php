<?php

namespace App\Http\Controllers;

use App\Models\CoachSubject;
use App\Models\CoachType;
use Illuminate\Http\Request;

class CoachQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coach_types = CoachType::all();
        $coach_subjects = CoachSubject::all();

        return view('admin.class.coaching.coach_question.create', 
        [
            'coach_types' => $coach_types,
            'coach_subjects' => $coach_subjects
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
