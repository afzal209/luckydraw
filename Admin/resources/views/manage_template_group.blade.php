@extends('layout')
@section('title','Manage Template Group')
@section('content')

    <ul class="breadcrumb">
        <li><p>Dashboard</p></li>
        <li><a href="#" class="active">Luckydraw Templates</a></li> 
        <li><a href="#" class="active">Template Group Manager</a> </li>
    </ul>
    <div class="row form-row">
    	@if (session('error_count7'))
    		<div class="alert alert-danger" role="alert">
    			<form method="POST" action="{{ route('price_manager.clear') }}">
    				@csrf
    				<button type="submit" class='close'></button>
    			</form>
    			{{ session('error_count7') }}
    		</div>
    	@endif    
        <form class="validate" enctype="multipart/form-data" novalidate method="POST" action="{{ isset($template_group_edit) ? route('template_manager_group.update_group', $template_group_edit->id) : route('template_manager_group.create_group') }}">
		    @csrf
			<div class="col-md-12">
			   <div class="grid simple">
					<div class="grid-title">
					   <h3><i class="fa fa-flag"></i><span class="semi-bold">@if(isset($template_group_edit)) Update @else Add @endif Template Group</span></h3>
					</div>
				    <div class="grid-body">
    					<div class="row form-row">
    						<div class="col-md-6">
    						    <p>Name of the Group</p>
    						    <input name="group_name" id="group_name" value="{{$template_group_edit->group_name ?? ''}}" type="text" class="form-control" placeholder="Enter Template Group Name. Ex: Indian Festivals" required>
    						    <label style="color:red;display:none;" class="error_log_name"></label>
    						</div>
                            <div class="col-md-6">
    						   <p>Choose Templates (1 Or Many)</p>
    						  @php
    $selectedTemplates = !empty($template_group_edit->template_ids) 
        ? explode(',', $template_group_edit->template_ids) 
        : [];
@endphp

<select name="template_ids[]" id="template_ids" style="width:100%" class="select2" multiple required onchange="get_template_id($(this))">
    <option value="all">All</option>
    @foreach($templateIds as $template)
        <option value="{{ $template->id }}" 
            {{ in_array($template->id, $selectedTemplates) ? 'selected' : '' }}>
            {{ $template->template_name }}
        </option>
    @endforeach
</select>
    					    </div>						
    					</div>
    					<input type="hidden" value="{{ isset($template_group_edit) ? json_encode(explode(',', $template_group_edit->template_ids)) : '' }}" id="template_hidden_id" name="template_hidden_id[]" />
    					
    					@if(isset($template_group_edit))
                            <input name="action_status" id="action_status" type="hidden" value="update" >
                            <input name="b_area_id" id="b_area_id" type="hidden" value="{{$template_group_edit->id ?? ''}}" >
                        @else
                            <input name="action_status" id="action_status" type="hidden" value="add" >
                            <input name="b_area_id" id="b_area_id" type="hidden" value="" >
                        @endif
					    <div class="form-actions">
    						<div class="pull-right">
    							 <button class="btn btn-primary" style="border-radius:0px;" type="submit"><i class="fa fa-folder-open"></i>@if(isset($template_group_edit)) Update a Template Group @else Create a Template Group @endif</button>
    						</div>
					    </div>
				    </div>
			   </div>
			</div>
		</form>
	</div>
    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h3><i class="fa fa-file-text"></i><span class="semi-bold"> View & Manage Template Groups</span></h3>
                </div>
				<div class="grid-body ">
				   <table class="table table-striped" id="example">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Template Group Name</th>
								<th>Templates</th>
								<th>Templates Code</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php 
								$sn = 1;
							@endphp
							@foreach($template_group as $template_groups)
								@php 
								  $ids = explode(',', $template_groups->template_ids);
								  $templates = \App\Models\Template_Manager::whereIn('id', $ids)
								  ->get(['template_name','template_code']);
								@endphp
								<tr>
									<td>{{$sn++}}</td>
									<td>{{$template_groups->group_name}}</td>
									<td>{{ $templates->map(fn($tpl) => $tpl->template_name )->implode(', ') }} <br></td>
									<td>{{ $templates->map(fn($tpl1) => $tpl1->template_code )->implode(', ') }}</td>
									<td>
										@if($template_groups->status == 1)
											{{'Active'}}
										@else
											{{'Inactive'}}
										@endif
									</td>
									<td class="center">
										<a href="{{ route('template_manager_group.edit_group', $template_groups->id) }}" class="btn btn-info" style="background:#885df1; border-radius:50px;"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
										@if($template_groups->status)
											<a href="{{ route('template_manager_group.status_group', ['id' => $template_groups->id, 'actions' => 1]) }}"  class="btn btn-warning" style="border-radius:50px;"><i class="fa fa-pause"></i>&nbsp;Suspend</a>
										@else
											<a href="{{ route('template_manager_group.status_group', ['id' => $template_groups->id, 'actions' => 0]) }}" class="btn btn-success" style="border-radius:50px;"><i class="fa fa-play"></i>&nbsp;Unsuspend</a>
										@endif
										<a href="{{ route('template_manager_group.delete_group', $template_groups->id) }}" type="button" class="btn btn-danger" style="border-radius:50px;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
        $('.select2').select2();
        let selectedTemplate = [];
       if ($('#template_hidden_id').val() != '') {
        try {
            selectedTemplate = JSON.parse($('#template_hidden_id').val());
        } catch (e) {
            selectedTemplate = $('#template_hidden_id').val().split(',');
        }
    }
    
     handleAllOption('#template_ids',selectedTemplate);
     
      function handleAllOption(selector, selectedValues) {
        console.log(selector)
        $(selector + ' option').prop('disabled', false);
        if (selectedValues.includes("all")) {
            $(selector + ' option').each(function () {
                if ($(this).val() !== "all") {
                    $(this).prop('disabled', true).prop('selected', false);
                }
            });
        } else if (selectedValues.length > 0) {
            $(selector + ' option[value="all"]').prop('disabled', true).prop('selected', false);
        }
    }
     
       
   });
   
   
   
   function get_template_id(val){
     var template_id = $(val).val() || [];
        console.log(template_id);
            $('#template_ids option').prop('disabled', false);
    
    // If "All" is selected, disable all other options
    if (template_id.includes("all")) {
        $('#template_ids option').each(function () {
            if ($(this).val() !== "all") {
                $(this).prop('disabled', true).prop('selected', false); // Disable and deselect others
            }
        });
    } else if (template_id.length > 0) {
        // If any other option is selected, disable the "All" option
        $('#template_ids option[value="all"]').prop('disabled', true).prop('selected', false);
    }  
   }
     
   
</script>