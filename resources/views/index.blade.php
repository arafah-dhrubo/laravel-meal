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

  <h3>Monthly Statistics</h3>
  Total Persons: {{$sum_count}}
  Total Meal Cost: {{$sum_budget}}
  {{-- <div class="m-4 container mx-auto">
    <ul class="nav nav-pills d-flex justify-content-center" id="myTab">
        <li class="nav-item">
            <a href="#snacks" class="nav-link active d-flex flex-column text-center" data-bs-toggle="tab"><h5>Snacks</h5>
        </li>
        <li class="nav-item">
            <a href="#lunch" class="nav-link d-flex flex-column text-center" data-bs-toggle="tab"><h5>Lunch</h5></a>
        </li>
        <li class="nav-item">
            <a href="#party" class="nav-link d-flex flex-column text-center" data-bs-toggle="tab"><h5>Party</h5></a>
        </li>
    </ul> --}}
    {{-- <div class="tab-content">
        <div class="tab-pane fade show active" id="snacks">
            <table class="table table-hover">
                <thead>
                <tr class="bg-light">
                    <th scope="col">Person Count</th>
                    <th scope="col">Spend</th>
                    <th scope="col">Average</th>
                </tr>
                </thead>
                <tbody>
                @foreach($monthly as $key=>$data)
                    @if ($data->type=="snacks")
                        <p>Snacks</p>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="lunch">
            <table class="table table-hover">
                <tr class="bg-light">
                    <th scope="col">Person Count</th>
                    <th scope="col">Spend</th>
                    <th scope="col">Average</th>
                </tr>
                </thead>
                <tbody>
                @foreach($monthly as $key=>$data)
                    @if ($data->type=="lunch")
                        <p>Lunch</p>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="party">
            <table class="table table-hover">
                <tr class="bg-light">
                    <th scope="col">Person Count</th>
                    <th scope="col">Spend</th>
                    <th scope="col">Average</th>
                </tr>
                </thead>
                <tbody>
                @foreach($monthly as $key=>$data)
                    @if ($data->type=="party")
                        <p>Party</p>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
</div>

@endsection
