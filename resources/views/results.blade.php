@extends('layouts.app')

@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                Movies
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <th>Movie</th>
                    <th>Casts</th>
                    </thead>

                    <tbody>
                    @foreach($results['movies'] as $movie)
                        <tr>
                            <td>
                                <div>
                                    {{$movie->title}}
                                </div>
                            </td>
                            <td>
                                @foreach($movie->casts as $cast)
                                    <div>
                                        {{$cast->name}}
                                    </div>
                                @endforeach()
                            </td>
                        </tr>
                    @endforeach()
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Casts
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <th>Cast</th>
                    <th>Movies</th>
                    </thead>

                    <tbody>
                    @foreach($results['casts'] as $cast)
                        <tr>
                            <td>
                                <div>
                                    {{$cast->name}}
                                </div>
                            </td>
                            <td>
                                @foreach($cast->movies as $movie)
                                    <div>
                                        {{$movie->title}}
                                    </div>
                                @endforeach()
                            </td>
                        </tr>
                    @endforeach()
                    </tbody>
                </table>
            </div>
        </div>

@endsection