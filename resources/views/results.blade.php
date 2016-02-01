@extends('layouts.app')

@section('content')

    <table>
        <!-- Table Headings -->
        <thead>
        <th>Movies</th>
        <th>&nbsp;</th>
        </thead>

        <!-- Table Body -->
        <tbody>
            @foreach($results['movies'] as $movie)
                <tr>
                    <td>
                        <div>
                            {{$movie->title}}
                        </div>
                    </td>
                    @foreach($movie->casts as $cast)
                        <td>
                            <div>
                                {{$cast->name}}
                            </div>
                        </td>
                    @endforeach()
                </tr>
        @endforeach()
        </tbody>
    </table>

    <table>
        <!-- Table Headings -->
        <thead>
        <th>Casts</th>
        <th>&nbsp;</th>
        </thead>

        <!-- Table Body -->
        <tbody>
        @foreach($results['casts'] as $cast)
            <tr>
                <td>
                    <div>
                        {{$cast->name}}
                    </div>
                </td>
                @foreach($cast->movies as $movie)
                    <td>
                        <div>
                            {{$movie->title}}
                        </div>
                    </td>
                @endforeach()
            </tr>
        @endforeach()
        </tbody>
    </table>

@endsection