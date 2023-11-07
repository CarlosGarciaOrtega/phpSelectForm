
@extends('app.base')
@section('title', 'Setting')

@section('content')
<form action="{{url('setting')}}" method="post">
  
  @method('put')
  @csrf
  
  <div>
    Behaviour after inserting new movie
  </div>
  
  <input  class="form-check-input" type="radio" id="showMovie" name="afterInsert" value="show movies" {{ $checkedList }}/>
  <label class="form-check-label" for="showMovie" >
    Show all movies list
  </label>
  <br>
  <input  class="form-check-input" type="radio" id="createMovie" name="afterInsert" value="show create form" {{ $checkedCreate }}/>
  <label class"form-check-label" for="createMovie">
    Show create new movie form
  </label>
  <br>
  <br>
  
  
  <label for="editMovie">Behaviour after editing new movie</label>
  
  <select  name="afterEdit" id="editMovie" class="form-select" aria-label="Default select example">
    <option  hidden > {{ $defaultSelectect['message']}}</option>
    @foreach ($options as $option)
  
      <option value="{{$option['value']}}" {{$option['select']}} >{{$option['message']}}</option>
    @endforeach
  </select>
  <br>
  <button type="submit" class="btn btn-primary">Save setting</button>
  
</form>

@endsection