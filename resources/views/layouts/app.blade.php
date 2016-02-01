<!DOCTYPE html>
<html>
    <head>
        <title>SMDB</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>

        <div>

            <!-- Find Movie Form -->
            <form action="/query" method="GET">

                <!-- Movie Name -->
                <div>
                    <label for="query">Query</label>

                    <div>
                        <input type="text" name="q" id="query-string">
                    </div>
                </div>

                <!-- Add Button -->
                <div>
                    <div>
                        <button type="submit">
                            +
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @yield('content')
    </body>
</html>
