@extends('layout')
@section('title', 'Business Area')
@section('content')
<ul class="breadcrumb">
    <li><p>Dashboard</p></li>
    <li><a href="#" class="active">Information Manager</a></li>
    <li><a href="#" class="active">Manage Business Area</a></li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3>
                    <i class="fa fa-map-signs"></i>
                    <span class="semi-bold">
                        @if(isset($business_area_edit)) Update @else Add @endif Business Area
                    </span>
                </h3>
            </div>
            <div class="grid-body">
                @if (session('error_count1'))
                    <div class="alert alert-danger" role="alert">
                        <form method="POST" action="{{ route('business_area.clear') }}">
                            @csrf
                            <button type="submit" class='close'></button>
                        </form>
                        {{ session('error_count1') }}
                    </div>
                @endif
                <form class="form-no-horizontal-spacing" id="form-condensed" 
                      action="{{ isset($business_area_edit) 
                                  ? route('business_area.update', $business_area_edit->id) 
                                  : route('business_area.create') }}" 
                      method="POST">
                    @csrf
                    <div class="row column-seperation">
                        <div class="col-md-6">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <input name="area_name" id="area_name" type="text"
                                           value="{{ $business_area_edit->area_name ?? '' }}"
                                           class="form-control"
                                           placeholder="Enter Business Area Name" required>
                                    <label style="color:red;display:none;" class="error_log_name"></label>
                                </div>
                                <div class="col-md-6">
                                    <input name="area_code" id="area_code" type="text"
                                           value="{{ $business_area_edit->area_code ?? '' }}"
                                           class="form-control"
                                           placeholder="Enter Business Area Code" required>
                                    <label style="color:red;display:none;" class="error_log_code"></label>
                                </div>
                            </div>
                            @if(isset($business_area_edit))
                                <input type="hidden" name="action_status" id="action_status" value="update">
                                <input type="hidden" name="b_area_id" id="b_area_id" value="{{ $business_area_edit->id }}">
                            @else
                                <input type="hidden" name="action_status" id="action_status" value="add">
                                <input type="hidden" name="b_area_id" id="b_area_id" value="">
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if(isset($business_area_edit))
                                <button class="btn btn-danger btn-cons" type="submit" name="action" value="update">
                                    <i class="icon-ok"></i> Update
                                </button>
                            @else
                                <button class="btn btn-info btn-cons" type="submit" name="action" value="save">
                                    <i class="fa fa-sitemap"></i> Create Business Area
                                </button>
                            @endif
                            <button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="grid simple">
            <div class="grid-title">
                <h3>
                    <i class="fa fa-map-signs"></i>
                    <span class="semi-bold">View & Manage Business Area</span>
                </h3>
            </div>
            <div class="grid-body">
                <table class="table table-striped" id="example">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Area Name</th>
                            <th>Area Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sn = 1; @endphp
                        @foreach($business_area as $business)
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td>{{ $business->area_name }}</td>
                                <td>{{ $business->area_code }}</td>
                                <td>{{ $business->status == 1 ? 'Active' : 'In-Active' }}</td>
                                <td class="center">
                                    <a href="{{ route('business_area.edit', $business->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;" onclick="return confirm('Do you want to Edit Business Area?')">
                                        <i class="fa fa-pencil"></i>&nbsp;Edit
                                    </a>
                                    @if($business->status)
                                        <a href="{{ route('business_area.status', ['id' => $business->id, 'actions' => 1]) }}" class="btn btn-warning" style="border-radius:50px;"> <i class="fa fa-pause"></i>&nbsp;Suspend</a>
                                    @else
                                        <a href="{{ route('business_area.status', ['id' => $business->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"> <i class="fa fa-play"></i>&nbsp;Unsuspend </a>
                                    @endif
                                    <a href="{{ route('business_area.delete', $business->id) }}" class="btn btn-danger" style="border-radius:50px;" onclick="return confirm('Do you want to Delete Business area?')"> <i class="fa fa-trash"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap4.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.3.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap4.js"></script>

<script>
$(document).ready(function() {
    function check_val() {
        $('.error_log_name').text('');
        var area_name = $('#area_name').val();
        var area_code = $('#area_code').val();
        var action_status = $('#action_status').val();
        var b_area_id = $('#b_area_id').val();
        if(area_name.length > 2) {
            $.ajax({
                url: "{{ url('business_area/validation') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "area_name": area_name,
                    "area_code": area_code,
                    "action_status": action_status,
                    "b_area_id": b_area_id
                },
                success: function(data) {
                    let isNameValid = true;
                    let isCodeValid = true;
                    if(data.action['field'] === 'name') {
                        if(data.action['status'] === 1) {
                            $('.error_log_name').show().text('This name is already exists');
                            isNameValid = false;
                        } else {
                            $('.error_log_name').hide().text('');
                        }
                    }
                    if(data.action1['field'] === 'code') {
                        if(data.action1['status'] === 1) {
                            $('.error_log_code').show().text('This code is already exists');
                            isCodeValid = false;
                        } else {
                            $('.error_log_code').hide().text('');
                        }
                    }
                    $('.btn-cons').prop('disabled', !(isNameValid && isCodeValid));
                }
            });
        }
    }
    $('#area_name, #area_code').on('keyup', check_val);
    $('.cancel-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Do you want to Cancel this Edit?")) {
            $('#form-condensed')[0].reset();
            $('.error_log_name, .error_log_code').hide().text('');
        }
    });
});
</script>