<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meals;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sum_count = Meals::sum('count');
        $sum_budget = Meals::sum('budget');
        $mealData = Meals::simplepaginate(5);

        return view('index', [
            'mealData' => $mealData,
            'sum_count'=>$sum_count,
            'sum_budget'=>$sum_budget
    ]);
    }

    public function create()
    {
        return view('add_meal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $rules=[
            'count'=>'required',
            'budget'=>'required',
            'type'=>'required',
        ];
        $cm=[
            'count.required'=>"Person Count Is Missing!",
            'budget.required'=>"Please Add Budget!",
            'type.required'=>"What is the type of meal?"
        ];
        $this->validate($request, $rules, $cm);
        $meal = new Meals();
        $meal->count=$request->count;
        $meal->budget=$request->budget;
        $meal->type=$request->type;
        $meal->save();
        Session()->flash('msg', "Meal Successfully Added");
        return redirect('/');
    }

    public function show()
    {
        $showMeal = Meals::simplepaginate(5);

        $monthly = Meals::whereMonth('created_at', '=' ,11);
        dd($monthly);
        return view('show_meal', ['showMeal' => $showMeal, 'monthly'=>$monthly]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $editMeal = Meals::find($id);
        // echo $editMeal->created_at->month;
        return view('edit_meal', ["editMeal"=>$editMeal]);
    }

    public function update(Request $request, $id)
    {
        $rules=[
            'count'=>'required',
            'budget'=>'required',
            'type'=>'required',
        ];
        $cm=[
            'count.required'=>"Person Count Is Missing!",
            'budget.required'=>"Please Add Budget!",
            'type.required'=>"What is the type of meal?"
        ];
        $this->validate($request, $rules, $cm);
        $meal = Meals::find($id);
        $meal->count=$request->count;
        $meal->budget=$request->budget;
        $meal->type=$request->type;
        $meal->save();
        Session()->flash('msg', "Meal Successfully Updated");
        return redirect('/');
    }

    public function destroy($id)
    {
        $deleteMeal=Meals::find($id);
        $deleteMeal->delete();
        Session()->flash('msg', "Meal Successfully deleted");
        return redirect('/');
    }
}
