@extends('layout')

@section('content')

@if($words->count() > 0 )
<table>
    <tbody>
        @foreach($words as $word)
            <tr>
                <td>{{$word->id}}</td>
                <td>{{$word->word}}</td>
                {{--<td>--}}
                    {{--{{$words->Translations()->count()}}--}}
                    {{--@if($words->Translations()->get()->count() > 0)--}}
                        {{--<table>--}}
                            {{--<tbody>--}}
                            {{--@foreach($words->Translations as $translation)--}}
                                {{--<tr><td>{{$translation->translation}}</td></tr>--}}
                            {{--@endforeach--}}

                            {{--</tbody>--}}
                        {{--</table>--}}

                    {{--@endif--}}
                {{--</td>--}}
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <p>words not found</p>
@endif
@endsection