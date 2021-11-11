@extends('layout')
@section('title', "Update Data")
@section('content')
<a href="/" class="btn btn-primary my-3">Show Data</a>
<form action="{{url('/update-meal', $editMeal->id)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="count">Person Count</label>
        <input class="form-control" value={{$editMeal->count}} type="number" name="count" id="count">
        @error('count')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="budget">Meal Type</label>
    <select class="form-select" name="type" value={{$editMeal->type}} aria-label="Default select example">
        <option selected value={{$editMeal->type}}>Select Meal Type</option>
        <option value="lunch">Lunch</option>
        <option value="snacks">Snacks</option>
        <option value="party">Party</option>
      </select>
      @error('type')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="budget">Budget For The Meal</label>
        <input class="form-control" value={{$editMeal->budget}} type="number" name="budget" id="budget">
        @error('budget')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <br>
    <input type="submit" value="Update Meal" class="btn btn-primary w-100">
</form>

@endsection
