@extends('layouts.app')
@section('title', 'Edit Visit')
@section('content')

    <div class="container mt-3">
        <div class="card">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
        @endif

        <div class="card" style="width:100%;">
            <div class="card-header">Day Care:<b> {{$daycare->name}} </b>
            <span class="float-right">
                              <a class="btn btn-primary" href="{{ url('/bookvisit/' . $daycare->id) }}">Back</a>
                          </span>
            </div>
        </div>

        <h5 class="card-header">Edit Booking</h5>
            <div class="card-body">
                <form action="{{route('updatebook', $id, $daycare_id)}}" method="POST" class="ms-auto me-auto" style="width: 500px">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="Book_Date" class="form-label">Date</label>
                        <select class="form-select" name="date" id="date" aria-label="Default select example">
                            <option selected="true" value="{{$books->date}}">{{$books->date}}</option>
                            @foreach($availDate as $row1)
                            <option value="{{$row1['date']}}">{{$row1['date']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Book_Time" class="form-label">Time</label>
                        <select class="form-select" name="time" id="time" aria-label="Default select example">
                            <option selected="true" value="{{$books->time}}">{{$books->time}}</option>
                            <option value="time"><div id="times"></div></option>     
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>                    
                </form>
                <script>
                    document.getElementById('date').addEventListener('change', function() {
                        var date = this.value;
                        fetch('/availTime', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: JSON.stringify({ date: date })
                        })
                        .then(response => response.json())
                        .then(data => {
                            var timeSelect = document.getElementById('time');
                            timeSelect.innerHTML = '';
                            data.times.forEach(function(time) {
                                var option = document.createElement('option');
                                option.value = time;
                                option.textContent = time;
                                timeSelect.appendChild(option);
                            });
                        });
                    });
                    </script>
            </div>
        </div>
    </div>
@endsection