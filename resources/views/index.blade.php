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
    <div class="container-fluid spark-screen">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                        @endif
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 class="card-title mb-0">Users</h4>
                            </div><!--col-->

                            <div class="col-sm-3">
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <a type="button"  href='{{ route("add") }}' class="btn btn-success ml-1" >Add User <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div><!--btn-toolbar-->
                            </div><!--col-->
                            <div class="col-sm-4">
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <a type="button"  href='{{ route("add_school") }}' class="btn btn-success ml-1" >Add School <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div><!--btn-toolbar-->
                            </div><!--col-->
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="box-body table-responsive">
                        <table id="userTable" class="table table-striped table-bordered dataTable no-footer" style="width:100%">
                            <thead class="custom_thead">
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th class="text-center">User Name</th>
                                <th class="text-center">School Name</th>
                                <th class="text-center">Marks</th>
                                <!-- <th class="text-center">Edit/Delete</th> -->
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @if(count($users))
                                <?php $sno = 1;?>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->school_name }}</td>
                                        <td>{{ $user->marks }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No User Register</td>
                                <tr>
                             @endif
                            </tbody>
                        </table>
                        </div>

                        <div class="box-body table-responsive">
                        <table id="userAggData" class="table table-striped table-bordered dataTable no-footer" style="width:100%">
                            <thead class="custom_thead">
                            <tr>
                                <th class="text-center">Highest Marks</th>
                                <th class="text-center">Lowest Marks</th>
                                <th class="text-center">Medium Marks</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @if(count($marks))
                                <tr>
                                    <td>{{ $marks['max'] }}</td>
                                    <td>{{ $marks['min'] }}</td>
                                    <td>{{ $marks['avg'] }}</td>
                                  </tr>
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No User Register</td>
                                <tr>
                             @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

    <script>
        $(document).ready(function () {
            $("#userTable").DataTable({
                dom: 'lBfrtip',
                scrollX: true,
                buttons: [
                    {``
                        extend:'excel',
                        text: '',
                        className: 'fa fa-2x fa-file-excel-o',
                        title:'Users',
                        exportOptions: {
                            columns: [ 0,1,2,3,4,5 ]
                        }
                    }
                ]
            });
        });

        function Confirm(title, msg, yes, cancel, link, role_type)
        {
            var content = '<div class="modal" role="dialog" id="deleteUser">'+
            '<div class="modal-dialog" role="document">'+
            '<div class="modal-content">'+
            '<div class="modal-header">'+
            '<h5 class="modal-title">'+title+'</h5>'+
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                '<span aria-hidden="true">&times;</span>'+
            '</button>'+
            '</div>'+
            '<div class="modal-body">'+
                '<p id="msg">'+msg+'</p>'+
            '</div>'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-danger doAction">'+yes+'</button>'+
                '<button type="button" class="btn btn-success cancelAction" data-dismiss="modal">'+cancel+'</button>'+
            '</div>'+
            '</div></div></div>';
            $('body').prepend(content);
            $('#deleteUser').modal('show');
            $('.doAction').click(function () {
                if(role_type === 'other')
                {
                    window.open(link, "_self");
                }else{
                    $("#msg").html("Sorry! You can't delete this user for now.");
                    $("#msg").css({color:'red'});
                }
            });
            $('.cancelAction, .fa-close').click(function () {
                $('#deleteUser').modal('hide');
            });
        }
    </script>
</html>
