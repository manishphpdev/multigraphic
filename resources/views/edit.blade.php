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
                        <h4 class="card-title mb-0">Edit User</h4>
                    </div>
                    <div id="editUserError">
                        @if (Session::has('error'))
                            @php
                            $errors = Session::get('error');
                            @endphp
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="header">there are following errors:</div>
                                <ul>
                                    @foreach($errors as $error1)

                                    <li>{{ $error1 }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form id="editUser" action="{{ route("user::edit",$user->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" class="form-control" id="name"
                                               placeholder="Enter name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email address</label>
                                        <input name="email" type="email" class="form-control" id="email"
                                               placeholder="Enter email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input name="password" type="password" class="form-control" id="password"
                                               placeholder="Password">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input name="password_confirmation" type="password" class="form-control"
                                               id="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="access_level">Roles</label>
                                    <select class="form-control" name ="access_level" id="access_level">
                                        <option value="Super Visor" @if($user->access_level == 'Super Visor') selected @endif >Supervisor</option>
                                        <option value="Engineer" @if($user->Engineer == 'Engineer') selected @endif >Engineer</option>
                                        <option value="System Operator" @if($user->access_level == 'System Operator') selected @endif>System Operator</option>
                                        <option value="Fsp" @if($user->access_level == 'Fsp') selected @endif>FSP</option>
                                        <option value="Solar Generator" @if($user->access_level == 'Solar Generator') selected @endif>Solar Generator</option>
                                        <option value="Diesel Generator" @if($user->access_level == 'Diesel Generator') selected @endif>Diesel Generator</option>
                                        @if(!in_array($_SERVER['REMOTE_ADDR'], $fsp_server))
                                            <option value="SCADA" @if($user->access_level == 'SCADA') selected @endif>SCADA</option>
                                        @endif
                                        <option value="External" @if($user->access_level == 'External') selected @endif>External</option>
                                    </select>
                                </div>
                                    <div class="form-group col-md-3" id="pagesLabel">
                                        <label for="pages">Pages</label>
                                        <select class="form-control input-sm" name ="pages[]" id="pages" multiple="multiple">
                                            {{--                                            <option value="home">Home</option>--}}
                                            <option value="user" @if(in_array('user',json_decode($user->pages))) selected @endif>User</option>
                                            <option value="plants" @if(in_array('plants',json_decode($user->pages))) selected @endif>Plants</option>
                                            <option value="upload_schedule" @if(in_array('upload_schedule',json_decode($user->pages))) selected @endif>Upload Schedule</option>
                                            <option value="upload_actual" @if(in_array('upload_actual',json_decode($user->pages))) selected @endif>Upload Actual</option>
                                            <option value="upload_forecast" @if(in_array('upload_forecast',json_decode($user->pages))) selected @endif>Upload Forecast</option>
                                            <option value="final_schedule" @if(in_array('final_schedule',json_decode($user->pages))) selected @endif>Schedule Finalization</option>
                                            <option value="solarForecast" @if(in_array('solarForecast',json_decode($user->pages))) selected @endif>Solar Forecast</option>
                                            <option value="solarGenerators" @if(in_array('solarGenerators',json_decode($user->pages))) selected @endif>Forecasts and Schedules</option>
                                            <option value="solarPlants" @if(in_array('solarPlants',json_decode($user->pages))) selected @endif>Solar Plants</option>
                                            <option value="curtailment" @if(in_array('curtailment',json_decode($user->pages))) selected @endif>Curtailment</option>
                                            <option value="accuracy_analysis" @if(in_array('accuracy_analysis',json_decode($user->pages))) selected @endif>Accuracy Analysis</option>
                                            <option value="long-term-load-forecast" @if(in_array('long-term-load-forecast',json_decode($user->pages))) selected @endif>Long Term Load Forecast</option>
                                            <option value="short-term-load-forecast" @if(in_array('short-term-load-forecast',json_decode($user->pages))) selected @endif>Short Term Load Forecast</option>
                                            <option value="similar-day-simulation" @if(in_array('similar-day-simulation',json_decode($user->pages))) selected @endif>Similar Day Simulation</option>
                                            <option value="generator-schedule" @if(in_array('generator-schedule',json_decode($user->pages))) selected @endif>Generator Schedule</option>
                                            <option value="weather" @if(in_array('weather',json_decode($user->pages))) selected @endif>Weather</option>
                                            <option value="emc" @if(in_array('emc',json_decode($user->pages))) selected @endif>Energy Payment</option>
                                            <option value="alarms" @if(in_array('alarms',json_decode($user->pages))) selected @endif>Alarms</option>
                                            <option value="mail_sms" @if(in_array('mail_sms',json_decode($user->pages))) selected @endif>Email/SMS Logs</option>
                                            <option value="alarmConfig" @if(in_array('alarmConfig',json_decode($user->pages))) selected @endif>Configuration</option>
                                            <option value="settings" @if(in_array('settings',json_decode($user->pages))) selected @endif>System Settings</option>
                                            <option value="forecasting_report" @if(in_array('forecasting_report',json_decode($user->pages))) selected @endif>Forecasting Report</option>
                                            <option value="scheduling_report" @if(in_array('scheduling_report',json_decode($user->pages))) selected @endif>Scheduling Report</option>
                                            <option value="none" @if(in_array('none',json_decode($user->pages))) selected @endif>None</option>
                                            @if(!in_array($_SERVER['REMOTE_ADDR'], $fsp_server))
                                                <option value="scada_report" @if(in_array('scada_report',json_decode($user->pages))) selected @endif>Scada Report</option>
                                                <option value="scada" @if(in_array('scada',json_decode($user->pages))) selected @endif>Scada Alarms</option>
                                                <option value="analog_data" @if(in_array('analog_data',json_decode($user->pages))) selected @endif>Analog Data</option>
                                                <option value="digital_data" @if(in_array('digital_data',json_decode($user->pages))) selected @endif>Digital Data</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="substationsLabel">
                                        <label for="substations">SubStations</label>
                                        <select class="form-control input-sm" name ="substations[]" id="substations" multiple="multiple">
                                            @if($substations)
                                                @foreach($substations as $key => $value)
                                                <option value="{{$value}}" selected>{{$value}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" id="phone" class="form-control" name="phone"  placeholder="Enter Phone Number" value="{{ $user->phone }}">
                                    </div>
                                    <div class="col-md-6" style="padding-top: 25px;">
                                        <input class="icheckbox_square-blue" style="margin-top: 4px;" id="blocked"
                                               type="checkbox" name="blocked" value="1"
                                               @if($user->blocked == 1) checked @endif>
                                        <label for="user_mail" class="control-label" style="padding-left: 10px;">
                                            Blocked</label>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a type="button" href="{{ route("user::index") }}"
                                   class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
    <script>
        $(document).ready(function () {
            let userRole = $('#access_level option:selected').val();
            $('#substations').select2({
                        placeholder: "Select Substations",
                    });
            if(userRole != 'External')
            {
                if(userRole != 'SCADA'){
                    $( "#substationsLabel" ).hide();
                    $('#pagesLabel').removeClass('col-md-3');
                    $('#pagesLabel').addClass('col-md-6');
                    $('#pages').select2({
                        placeholder: "Select Pages",
                    });
                }
                else{
                    // console.log("scoda")
                    $( "#substationsLabel" ).show();
                    $('#pagesLabel').removeClass('col-md-6');
                    $('#pagesLabel').addClass('col-md-3');
                    let content = '<label for="pages">Pages</label>' +
                    '<select class="form-control input-sm" name ="pages[]" id="pages" multiple="multiple">' +
                    '<option value="scada" @if(in_array('scada',json_decode($user->pages))) selected @endif>Scada Alarms</option>' +
                    '<option value="analog_data" @if(in_array('analog_data',json_decode($user->pages))) selected @endif>Analog Data</option>' +
                    '<option value="digital_data" @if(in_array('digital_data',json_decode($user->pages))) selected @endif>Digital Data</option>';
                    $('#pagesLabel').html(content);
                    $('#pages').select2({
                        placeholder: "Select Pages",
                        matcher: hideSelectedAndMatched,
                    });
                    $('#substations').select2({
                        placeholder: "Select Substations",
                    });

                    getSubstations();

                }
            }
            else
            {
                $("#substationsLabel").hide();
                $('#pagesLabel').removeClass('col-md-3');
                $('#pagesLabel').addClass('col-md-6');

                $('#pagesLabel').html('');
                $('#pages').select2({
                    placeholder: "Select Pages",
                    matcher: hideSelectedAndMatched,
                });
            }
        });

        $("#access_level").change(function () {
            var userRole = $(this).val();
            if(userRole != 'External')
            {
                if(userRole != 'SCADA'){
                    $( "#substationsLabel" ).hide();
                    $('#pagesLabel').removeClass('col-md-3');
                    $('#pagesLabel').addClass('col-md-6');
                    let content = ' <label for="pages">Pages</label> ' +
                        '<select class="form-control input-sm" name ="pages[]" id="pages" multiple="multiple"> ' +
                        '<option value="server" @if(in_array('server',json_decode($user->pages))) selected @endif>Server</option>' +
                        '<option value="user" @if(in_array('user',json_decode($user->pages))) selected @endif>User</option>' +
                        '<option value="plants" @if(in_array('plants',json_decode($user->pages))) selected @endif>Plants</option>'+
                        '<option value="upload_schedule" @if(in_array('upload_schedule',json_decode($user->pages))) selected @endif>Upload Schedule</option>'+
                        '<option value="upload_actual" @if(in_array('upload_actual',json_decode($user->pages))) selected @endif>Upload Actual</option>'+
                        '<option value="upload_forecast" @if(in_array('upload_forecast',json_decode($user->pages))) selected @endif>Upload Forecast</option>'+
                        '<option value="final_schedule" @if(in_array('final_schedule',json_decode($user->pages))) selected @endif>Schedule Finalization</option>'+
                        '<option value="curtailment" @if(in_array('curtailment',json_decode($user->pages))) selected @endif>Curtailment</option>'+
                        '<option value="generator-schedule" @if(in_array('generator-schedule',json_decode($user->pages))) selected @endif>Generator Schedule</option>'+
                        '<option value="solarGenerators" @if(in_array('solarGenerators',json_decode($user->pages))) selected @endif>Forecasts and Schedules</option>'+

                        '<option value="solarForecast" @if(in_array('solarForecast',json_decode($user->pages))) selected @endif>Solar Forecast</option>'+
                        '<option value="accuracy_analysis" @if(in_array('accuracy_analysis',json_decode($user->pages))) selected @endif>Accuracy Analysis</option>'+

                        '<option value="solarPlants" @if(in_array('solarPlants',json_decode($user->pages))) selected @endif>Solar Plants</option>'+

                        '<option value="long-term-load-forecast" @if(in_array('long-term-load-forecast',json_decode($user->pages))) selected @endif>Long Term Load Forecast</option>'+
                        '<option value="short-term-load-forecast" @if(in_array('short-term-load-forecast',json_decode($user->pages))) selected @endif>Short Term Load Forecast</option>'+
                        '<option value="similar-day-simulation" @if(in_array('similar-day-simulation',json_decode($user->pages))) selected @endif>Similar Day Simulation</option>'+
                        '<option value="weather" @if(in_array('weather',json_decode($user->pages))) selected @endif>Weather</option>'+

                        '<option value="emc" @if(in_array('emc',json_decode($user->pages))) selected @endif>Energy Payment</option>'+
                        '<option value="calculation" @if(in_array('calculation',json_decode($user->pages))) selected @endif>Calculation Rule</option>'+

                        '<option value="alarms" @if(in_array('alarms',json_decode($user->pages))) selected @endif>Alarms</option>'+
                        '<option value="mail_sms" @if(in_array('mail_sms',json_decode($user->pages))) selected @endif>Email/SMS Logs</option>'+
                        '<option value="alarmConfig" @if(in_array('alarmConfig',json_decode($user->pages))) selected @endif>Configuration</option>'+
                        '<option value="settings" @if(in_array('settings',json_decode($user->pages))) selected @endif>System Settings</option>'+
                         @if(!in_array($_SERVER['REMOTE_ADDR'], $fsp_server))
                             '<option value="scada" @if(in_array('scada',json_decode($user->pages))) selected @endif>Scada Alarms</option>'+
                        '<option value="analog_data" @if(in_array('analog_data',json_decode($user->pages))) selected @endif>Analog Data</option>'+
                        '<option value="digital_data" @if(in_array('digital_data',json_decode($user->pages))) selected @endif>Digital Data</option>'+
                             '<option value="scada_report" @if(in_array('scada_report',json_decode($user->pages))) selected @endif>Scada Report</option>'+
                             @endif
                                 '<option value="forecasting_report" @if(in_array('forecasting_report',json_decode($user->pages))) selected @endif>Forecasting Report</option>'+
                                 '<option value="scheduling_report" @if(in_array('scheduling_report',json_decode($user->pages))) selected @endif>Scheduling Report</option>';
                    '</select>';
                    $('#pagesLabel').html(content);
                    $('#pages').select2({
                        placeholder: "Select Pages",
                    });
                    $('#pages').val(null).trigger("change")
                }
                else
                {
                    $( "#substationsLabel" ).show();
                    $('#pagesLabel').removeClass('col-md-6');
                    $('#pagesLabel').addClass('col-md-3');
                    let content = '<label for="pages">Pages</label>' +
                    '<select class="form-control input-sm" name ="pages[]" id="pages" multiple="multiple">' +
                    '<option value="scada" @if(in_array('scada',json_decode($user->pages))) selected @endif>Scada Alarms</option>' +
                    '<option value="analog_data" @if(in_array('analog_data',json_decode($user->pages))) selected @endif>Analog Data</option>' +
                    '<option value="digital_data" @if(in_array('digital_data',json_decode($user->pages))) selected @endif>Digital Data</option>';
                    $('#pagesLabel').html(content);
                    $('#pages').select2({
                        placeholder: "Select Pages",
                        matcher: hideSelectedAndMatched,
                    });
                    $('#substations').select2({
                        placeholder: "Select Substations",
                    });
                    getSubstations();
                    $('#pages').val(null).trigger("change")
                }
            }
            else
            {
               $("#substationsLabel").hide();
               $('#pagesLabel').removeClass('col-md-3');
               $('#pagesLabel').addClass('col-md-6');

                $('#pagesLabel').html('');
                $('#pages').select2({
                    placeholder: "Select Pages",
                    matcher: hideSelectedAndMatched,
                });
                $('#pages').val(null).trigger("change")
            }
        });

        function getSubstations(){
            $('#pages').on('change.select2', function(e) {
                            var array1=[]
                            var test=$('#pages').select2('data')
                            console.log(test);
                            if (test.length) {
                                $.each(test, function(key, value) {
                                    array1.push(this.id)
                                });

                                $.ajax({
                                type: "POST",
                                url:'{{ route("user::substations") }}' ,
                                data:{
                                    "_token": "{{ csrf_token() }}",
                                    "data":array1,
                                },
                                success: function (response)
                                {
                                    $('#substations').empty('');
                                    for (var i in response) {
                                        var newOption = new Option(response[i].text, response[i].id, false, false);
                                        $('#substations').append(newOption).trigger('change');
                                    }

                                },
                                error: function(err) {
                                    $('#substations').empty('');
                                }
                            })
                            }
                            else
                            {
                                $('#substations').empty('');
                            }
                        })
        }

        function hideSelectedAndMatched(params, item)
        {
            const currentSelections = $('#pages').select2('data');
            if (currentSelections.find(selection => selection.id === 'none'))
            {
                return null;
            }
            if (!params.term || params.term.trim() === ''
                || item.text.indexOf(params.term) > -1)
            {
                return item;
            }
            return null;
        }
    </script>
</html>
