@extends('dashboardlayout')

@section('title')
User -> {{$actionDescription}}
@endsection

@section('account', 'active')

@section('content')

<style>
.form-group.required .control-label:after { 
    color: #d00;
    content: "*";
    position: absolute;
    margin-left: 8px;
    top:7px;
    font-family: 'FontAwesome';
    font-weight: normal;
    font-size: 14px;
    content: "\f069";
}


</style>



<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">

         @include('include.ConfirmationMessages')


          <h4 class="card-title">User - {{$actionDescription}} <a href="{{  route('dashboard.user') }}" class="float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h4>
        
        @if($actionMethod == 'view')  
            <p class="category text-md">You can view your record here. <br>Note: If yo wish to edit the record, please <a href="{{route('user.edit', $record->id) }}"><strong class="md">Edit Here!</strong></a></p>
        @elseif($actionMethod == 'edit') 
            <p class="category">You can edit your record here. <br>Note: Required fields should be supplied with values.</p>
        @elseif($actionMethod == 'create')   
        <p class="category">You can create your record here. <br>Note: Required fields should be supplied with values.</p>
        @else
            <h5>undefined</h5>
        @endif
         
         
          
        </div>
        <div class="card-body">
          <div class="table-responsive">


        @if($actionMethod == 'view')         
            <form>
                <fieldset disabled="disabled">
                <input type="hidden" value="{{$record->id}}"/>
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="formGroupExampleInput" class="control-label">User Type:</label>
                                <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" value="{{ $record->type }}">
                            </div>
                        </div>
                        <div class="col">
                        <div class="form-group ">
                                <label for="formGroupExampleInput" class="control-label">User Status:</label>
                                <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" value="{{ $record->status }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="formGroupExampleInput" class="control-label">User Name:</label>
                                <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" value="{{ $record->name }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput2" >Email:</label>
                                <input type="text" class="form-control form-control-lg" id="middlename" name="middlename" value="{{ $record->email }}">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>

        @elseif($actionMethod == 'edit') 
        <form method="POST" action="{{route('user.update', $record->id)}}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$record->id}}"/>
            <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="formGroupExampleInput" class="control-label">User Type:</label>
                                @error('middlename')
                                    <span class="bg-danger txt-md text-white">{{$message}}</span>
                                @enderror
                                <input type="text" class="form-control form-control-lg" id="type" name="type" value="{{ $record->type }}" required="required" readonly>
                            </div>
                        </div>
                        <div class="col">
                        <div class="form-group ">
                                <label for="formGroupExampleInput" class="control-label">User Status:</label>
                                @error('status')
                                    <span class="bg-danger txt-md text-white">{{$message}}</span>
                                @enderror
                                <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $record->status }}" required="required" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="formGroupExampleInput" class="control-label">User Name:</label>
                                @error('name')
                                    <span class="bg-danger txt-md text-white">{{$message}}</span>
                                @enderror
                                <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ $record->name }}" required="required">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput2" >Email:</label>
                                @error('email')
                                    <span class="bg-danger txt-md text-white">{{$message}}</span>
                                @enderror
                                <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ $record->email }}" required="required" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Current Password:</label>
                                @error('password')
                                    <span class="bg-danger txt-md text-white">{{$message}}</span>
                                @enderror
                                <input type="password" class="form-control form-control-lg" id="password" name="password" value="" required="required" minlength="8">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">New Password:</label>
                                @error('new_password')
                                    <span class="bg-danger txt-md text-white">{{$message}}</span>
                                @enderror
                                <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" value="" required="required" minlength="8">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Confirm Password:</label>
                                <input type="password" class="form-control form-control-lg" id="confirm_pasword" name="confirm_pasword" value="" minlength="8">
                                <span id='message'></span>
                            </div>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary" id="btn-update">Update</button>
            </form>
        @elseif($actionMethod == 'create')   
        <form method="POST" action="{{route('driver.store')}}">
            @csrf
            @error('id')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label">Firstname:</label>
                            @error('firstname')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" value="{{ old('firstname')}}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" >Middlename:</label>
                            @error('middlename')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="middlename" name="middlename" value="{{  old('middlename') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Lastname:</label>
                            @error('lastname')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="lastname" name="lastname" value="{{  old('lastname') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Contact No.:</label>
                            @error('contact_no')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="contact_no" name="contact_no" value="{{  old('contact_no') }}"  >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Address.:</label>
                            @error('address')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="address" name="address" value="{{  old('address') }}"  >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Position:</label>
                            @error('position')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <select class="form-control form-control-lg" id="position" name="position" required>
                                @foreach($position as $data)
                                    <option value="{{$data->APP_VALUE_1}}">{{$data->APP_VALUE_1}}</option>
                                @endforeach
                            </select>
                            </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Status:</label>
                            @error('trip_status')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <select class="form-control form-control-lg" id="trip_status" name="trip_status">
                                <option></option>
                                @foreach($status as $data)
                                    <option value="{{$data->APP_VALUE_1}}">{{$data->APP_VALUE_1}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        @else
            <h5>undefined</h5>
        @endif
            
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section("scripts")


<script src="{{asset('/js/globalFunctions.js')}}"></script>
 
<script>
    $(document).ready(function(){
        $("#btn-update").prop( "disabled", true );
        $('#new_password, #confirm_pasword').on('keyup', function () {
        if ($('#new_password').val() == $('#confirm_pasword').val()) {
            $('#message').html(' ').css('color', 'green');
            $("#btn-update").prop( "disabled", false );
        } else{
            $('#message').html("New password and confirm password didn't match.").css('color', 'red');
            $("#btn-update").prop( "disabled", true );
        } 
            
            
        });
    })

</script>

@endsection