@extends('layout')

@section('content')

<form action="{{ route('words.store') }}" method="post">
    @csrf
    <label for="">Word</label>
    <input type="text" name="word" >
    <br>

    <label for="">Grammar type</label>
    <select name="grammar_type" id="">
        <option value="noun">noun</option>
    </select>

    <div>
        <button type="submit">Create</button>
    </div>
</form>
@endsection