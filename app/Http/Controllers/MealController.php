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
        $monthly = Meals::whereMonth('created_at', '=' ,11);
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        $weekly=Meals::whereBetween('created_at', [$start_week, $end_week])->get(['type', 'count', 'budget','created_at']);
        $weekly_count=$weekly->sum('count');
        $weekly_budget=$weekly->sum('budget');
        return view('index', [
            'mealData' => $mealData,
            'sum_count'=>$sum_count,
            'sum_budget'=>$sum_budget,
            'monthly'=>$monthly,
            'weekly'=>$weekly,
            'weekly_count'=>$weekly_count,
            'weekly_budget'=>$weekly_budget
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
