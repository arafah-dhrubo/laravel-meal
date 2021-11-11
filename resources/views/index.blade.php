@extends('layout')
@section('title', "Show Data")
@section('content')
@if(Session::has('msg'))

<p class="alert alert-success">{{Session::get('msg')}}</p>
@endif
<a href="/add-meal" class="btn btn-primary">Add Meal</a>
<table class="table table-hover container">
    <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Meal Type</th>
          <th scope="col">Person Count</th>
          <th scope="col">Budget</th>
          <th scope="col">Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($mealData as $key=>$data )
          <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$data->type}}</td>
            <td>{{$data->count}}</td>
            <td>{{$data->budget}}BDT</td>
            <td>{{ date('F d, Y', strtotime($data->created_at)) }}</td>
            <td>
                <a href="{{url('/edit-meal/'.$data->id)}}" class="btn btn-warning">Update</a>
                <a href="{{url('/delete-meal/'.$data->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
          @endforeach
      </tbody>
  </table>
  {{$mealData->links()}}

  <h3>Monthly Report</h3>
  Total Persons: {{$sum_count}}
  Total Meal Cost: {{$sum_budget}}

  <h3>Weekly Report</h3>
  Total Persons: {{$weekly_count}}
  Total Meal Cost: {{$weekly_budget}}
</div>

@endsection
