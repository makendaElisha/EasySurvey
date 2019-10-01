<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Question;
use App\Answer;
Use App\User;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
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
        //Getting all categories (also eager loading questions)
        $categories = Category::with('questions')->where('user_id', auth()->user()->id)->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',  
            ]);

        //Save category 
        $category = new Category();
        $category->user_id = auth()->user()->id;
        $category->name = request('name');
        $category->description = request('description');
        $category->save();
        
        return redirect('categories')->with('success', 'Category Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriesController  $categoriesController
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //Deny show to unauthorized users
        if ($category->user->id != auth()->user()->id) {
            return redirect('categories')->with('error', 'Unauthorized Page');
        }

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoriesController  $categoriesController
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //Deny edit to unauthorized users
        if ($category->user->id != auth()->user()->id) {
            return redirect('categories')->with('error', 'Unauthorized Page');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriesController  $categoriesController
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
        //Validation
        $data = request()->validate([
            'name'=>'required',
            'description' => 'required',
            ]);

        //Update category
        $category->update($data);
        return redirect('categories/' .$category->id)->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriesController  $categoriesController
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {       
        //Remove answers related to this category
        foreach ($category->questions as $question) {
            $question->answers()->delete();
        }
        
        //Remove questions related to this category
        $category->questions()->delete();

        //Remove category itself
        $category->delete();
        
        return redirect('categories');

    }
}
