<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="COVID-19 Dashboard; monitor local and global coronavirus cases with confirmed, recovered and deaths rate.">
    <meta name="author" content="Riza Ergun">
    <meta name="theme-color" content="#fff">
    <title>Covid-19 Dashboard - {{ $displayName }}</title>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <style>
        /*	Reset & General
    ---------------------------------------------------------------------- */
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font: 14px "Open Sans", sans-serif;
            text-align: center;
        }

        .tile {
            width: 100%;
            border-radius: 5px;
            float: left;
            transform-style: preserve-3d;
            margin: 10px 0;
            border: 1px solid #ebeff2;
        }

        .header {
            font-weight: 600;
            padding: 20px 0;
            text-align: center;
            color: #59687f;
            position: relative;
        }

        .banner-img img {
            width: 100%;
            border-radius: 5px;
        }

        .dates {
            border: 1px solid #ebeff2;
            border-radius: 5px;
            padding: 20px 0px;
            margin: 10px 20px;
            font-size: 16px;
            color: #5aadef;
            font-weight: 600;
            overflow: auto;
        }

        .dates div {
            float: left;
            width: 50%;
            text-align: center;
            position: relative;
        }

        .dates strong,
        .stats strong {
            display: block;
            color: #adb8c2;
            font-size: 11px;
            font-weight: 700;
        }

        .dates span {
            width: 1px;
            height: 40px;
            position: absolute;
            right: 0;
            top: 0;
            background: #ebeff2;
        }

        .stats {
            border-top: 1px solid #ebeff2;
            background: #f7f8fa;
            overflow: auto;
            padding: 15px 0;
            font-size: 16px;
            color: #59687f;
            font-weight: 600;
            border-radius: 0 0 5px 5px;
        }

        .stats div {
            border-right: 1px solid #ebeff2;
            width: 33.33333%;
            float: left;
            text-align: center
        }

        .stats div:nth-of-type(3) {
            border: none;
        }

        div.footer {
            margin: 20px 5px;
        }

        div.footer a.Cbtn {
            padding: 10px 25px;
            background-color: #DADADA;
            color: #666;
            margin: 10px 2px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            border-radius: 3px;
        }

        div.footer a.Cbtn-primary {
            background-color: #5AADF2;
            color: #FFF;
        }

        div.footer a.Cbtn-primary:hover {
            background-color: #7dbef5;
        }

        .my-card {
            font-size: 36px;
        }

        .card {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{ $displayName }} Total Stats</h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="border-warning text-warning p-3 my-card">
                    <span class="fa fa-heartbeat" aria-hidden="true"></span>
                </div>
                <div class="text-warning text-center mt-3"><h4>CONFIRMED</h4></div>
                <div class="text-warning text-center mt-2"><h1>{{ $totalConfirmed ? $totalConfirmed : 0 }}</h1></div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card border-success mx-sm-1 p-3">
                <div class="border-success text-success p-3 my-card">
                    <span class="fa fa-heart" aria-hidden="true"></span>
                </div>
                <div class="text-success text-center mt-3"><h4>RECOVERED</h4></div>
                <div class="text-success text-center mt-2"><h1>{{ $totalRecovered ? $totalRecovered : 0 }}</h1></div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="border-danger text-danger p-3 my-card">
                    <span class="fa fa-eye-slash" aria-hidden="true"></span>
                </div>
                <div class="text-danger text-center mt-3"><h4>DEATHS</h4></div>
                <div class="text-danger text-center mt-2"><h1>{{ $totalDeaths ? $totalDeaths : 0 }}</h1></div>
            </div>
        </div>
    </div>
</div>

@if($areas)
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ $displayName }} Stats</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach($areas as $area)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile">
                        <div class="wrapper">
                            <div class="header">
                                @if($id)
                                    {{ $area['displayName'] }}
                                @else
                                    <a href="{{ route('detail', ['id' => $area['id']]) }}">
                                        {{ $area['displayName'] }}
                                    </a>
                                @endif
                            </div>

                            <div class="stats">

                                <div>
                                    <strong>CONFIRMED</strong> {{ $area['totalConfirmed'] ? $area['totalConfirmed'] : 0 }}
                                </div>

                                <div>
                                    <strong>RECOVERED</strong> {{ $area['totalRecovered'] ? $area['totalRecovered'] : 0 }}
                                </div>

                                <div>
                                    <strong>DEATHS</strong> {{ $area['totalDeaths'] ? $area['totalDeaths'] : 0 }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

</body>
</html>
