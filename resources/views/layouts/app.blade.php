<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>SMDB</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css" media="screen">
</head>
<body style="background: black !important;">

<div class="col-sm-offset-4 col-sm-4">

    <br>

    <div class="panel panel-default">
        <div class="panel-heading">
            Search
        </div>
        <div class="panel-body">
            <!-- Search Form -->
            <form class="form-search" action="/query" method="GET">

                <div class="input-group">
                    <input class="form-control" type="text" name="q" id="query-string" placeholder="search"
                           @if(isset($results)) value="{{$results['q']}}" @endif
                    >
                    <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    GO
                </button>
                </span>
                </div>
            </form>
        </div>
    </div>

    @yield('content')
</div>
</body>
</html>
