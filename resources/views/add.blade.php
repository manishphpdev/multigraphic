<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MG</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add New User</h4>
                    </div>
                    <div id="addUserError">
                        @if (Session::has('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('error') }}</strong>
                                </div>
                            @endif
                    </div>
                    <div class="card-body">
                        <form id="addUser" action="{{ route('add') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input name="name"  type="text" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="school_name">School Name</label>
                                    <!-- <input name="school_name" type="text" class="form-control" id="school_name" placeholder="Enter School Name" value="{{ old('school_name') }}"> -->
                                    <select class="form-control" name ="school_name" id="school_name">
                                            @foreach($schools as $key=>$school)
                                                <option value="{{$school['id']}}" @if(old('school_name') == $school['id']) selected @endif>{{ $school['school_name'] }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="marks">Marks</label>
                                    <input name="marks" type="text" class="form-control" id="marks" placeholder="Enter Marks" value="{{ old('marks') }}">
                                </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a type="button" href="{{ route('index') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
