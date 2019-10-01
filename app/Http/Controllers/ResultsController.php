<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Survey;

class ResultsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all categories. Questions are also eager loaded 
        $categories = Category::with('questions')->where('user_id', auth()->user()->id)->get();

        return view('results.index', compact('categories'));
    }

    public function show(Category $category){

        $surveys = Survey::where('user_id', auth()->user()->id)->get();

        return view('results.show', compact('category', 'surveys'));
    }

}
