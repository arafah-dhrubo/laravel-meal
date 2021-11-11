@extends('layout')
@section('title', "Add Meal")
@section('content')
<a href="/" class="btn btn-primary my-3">Show Data</a>
@if(Session::has('msg'))
<p class="alert alert-success">{{Session::get('msg')}}</p>
@endif
<form action="{{url('/save-meal')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="count">Person Count</label>
            <input class="form-control" type="number" name="count" id="count">
            @error('count')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="budget">Meal Type</label>
        <select class="form-select" name="type" aria-label="Default select example">
            <option selected>Select Meal Type</option>
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
            <input class="form-control" type="number" name="budget" id="budget">
            @error('budget')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <br>
        <input type="submit" value="Add Meal" class="btn btn-primary w-100">
    </form>

@endsection
