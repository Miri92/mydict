@extends('layout')

@section('content')
<div class="container">
    @if(isset($azerDictUrl))
    <div>
        <a href="{{$azerDictUrl}}" target="_blank">{{$azerDictUrl}}</a>
    </div>
    @endif
    <form method="get" action="{{route('search')}}" class="form-inline mb-3">
        <div class="form-group">
            <input type="text" name="search" class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
{{--{{$findWord->count()}}--}}
@php
//dd($findWord);
@endphp
@if(isset($findWord) && $findWord->count() > 0)
    <div class="container">
        <table class="table">
            <tbody>
                @foreach($findWord as $word)
                    @if($word->Translations()->count() > 0)
                            @foreach($word->Translations as $translation)
                                <tr>
                                    <td>{{$word->word}}</td>
                                    <td>{{$translation->translation}}</td>
                                </tr>
                            @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(isset($searches) && $searches->count() > 0)
                <div class="well">
                    <h2>Top searches</h2>
                    <ul class="list-inline">
                        @foreach($searches as $search)
                            <li class="list-inline-item">{{$search[0]->key}} {{$search->count()}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection