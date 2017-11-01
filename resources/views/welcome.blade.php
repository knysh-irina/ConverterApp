<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
        </style>
    </head>
    <body>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1> <a href="{{url('/')}}">Converter</a></h1>
                        <h4>json, xml, csv, yml</h4>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <form id="upload_form" enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ url('/convert') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="file" class="col-md-4 control-label">Choose File</label>

                                    <div class="col-md-6">
                                        <input id="file" type="file" class="form-control" name="file"
                                               required>
                                         <p id="error_message" style="color: red"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="convert_to" class="col-md-4 control-label">Convert to</label>

                                    <div class="col-md-6">
                                        <select id="convert_to"  class="form-control" name="convert_to"
                                                required>
                                                    <option value="">Select</option>
                                                    <option>json</option>
                                                    <option>xml</option>
                                                    <option>csv</option>
                                                    <option>yaml</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary btn-large btn-block">
                                           Convert file
                                        </button>
                                    </div>
                                </div>
                                @if(isset($file_name))

                                <div class="col-md-6 col-md-offset-4">
                                <a href="{{url("/download/{$file_name}")}}" class="btn btn-large"> Download File {{$file_name}}</a>
                                </div>
                               @endif
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
