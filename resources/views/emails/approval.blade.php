<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <title>Mail</title>
    <style>
        p {
            font-size: 18px;
        }

        .mail-body {
            font-family: 'PT Serif', serif;
        }

        .post-title {
            font-size: 25px;
        }

        .mail-content {
            width: 50%;
            border: 1px solid #00000030;
        }

        .p-5 {
            padding: 3rem !important;
        }

        .container {
            min-width: 992px !important;
        }

        .pb-5 {
            padding-bottom: 3rem !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }


        .align-items-center {
            align-items: center !important;
        }

        .pl-2 {
            padding-left: 0.5rem !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-12 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .btn {
            text-decoration:none;
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-lg,
        .btn-group-lg>.btn {
            padding: 0.5rem 1rem;
            font-size: 1.125rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }

        .btn-outline-primary {
            color: #3490dc;
            border-color: #3490dc;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #3490dc;
            border-color: #3490dc;
        }

        .btn-outline-primary:focus,
        .btn-outline-primary.focus {
            box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.5);
        }
    </style>
</head>

<body class="mail-body p-5" style="background-color:#f9f9f9">
    <div class="container h-100 pb-5 justify-content-center align-items-center" style="background-color: white">
        <div class="row pl-2">
            <div class="mail-logo">
                <h2 style="font-weight: 900;">
                    {{ config('app.name', 'Laravel') }}
                </h2>
            </div>
        </div>
        <hr>
        <div class="row pl-2">
            <div class="mail-title">
                <p>Hi, {{$data['author']}}</p>
                <p>Your post has been
                    {{$data['status'] == config('constants.is_approved.yes') ? "Approved" : "Rejected" }}
                </p>
            </div>
        </div>
        <div class="row pl-2 justify-content-center align-items-center">
            <div class="mail-content">
                {{-- <div class="col-md-12 pt-2" style="background-color: #a4fca4; height:60px; text-align: center">
                    <span class="fa fa-check-circle-o " style="font-size: 50px; color:white"></span>
                </div> --}}
                <div class="col-md-12 p-3">
                    <p class="post-title"><b>{{$data['title']}}</b></p>
                    @if ($data['status'] == config('constants.is_approved.rejected'))
                    <p><b>Comment by Admin:</b> <span>{{$data['remark']}}</span></p>
                    @endif
                    <a href="{{$data['pid']}}" class="btn btn-lg btn-outline-primary">Check your post</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>