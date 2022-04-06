@extends('dashboardlayout')

@section('title')
Driver -> {{$actionDescription}}
@endsection

@section('driver', 'active')

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


          <h4 class="card-title">DRIVER - {{$actionDescription}} <a href="{{  route('dashboard.driver') }}" class="float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h4>
        
        @if($actionMethod == 'view')  
            <p class="category text-md">You can view your record here. <br>Note: If yo wish to edit the record, please <a href="{{route('driver.edit', $record->id) }}"><strong class="md">Edit Here!</strong></a></p>
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
                            <label for="formGroupExampleInput" class="control-label">Firstname:</label>
                            <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" value="{{ $record->firstname }}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" >Middlename:</label>
                            <input type="text" class="form-control form-control-lg" id="middlename" name="middlename" value="{{ $record->middlename }}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Lastname:</label>
                            <input type="text" class="form-control form-control-lg" id="lastname" name="lastname" value="{{ $record->lastname }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Contact No.:</label>
                            <input type="text" class="form-control form-control-lg" id="contact_no" name="contact_no" value="{{ $record->contact_no }}"  readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Address.:</label>
                            <input type="text" class="form-control form-control-lg" id="address" name="address" value="{{ $record->address }}"  readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Position:</label>
                            <select class="form-control form-control-lg" id="position" name="position" readonly>
                                <option></option>
                                @foreach($position as $data)
                                    <option 
                                    
                                    @if($data->APP_VALUE_1==$record->position)
                                        selected
                                    @endif
                                    
                                    value="{{$data->APP_VALUE_1}}">{{$data->APP_VALUE_1}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $record->status }}"  readonly> -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Status:</label>
                            <select class="form-control form-control-lg" id="trip_status" name="trip_status" readonly>
                                <option></option>
                                @foreach($status as $data)
                                    <option value="{{$data->APP_VALUE_1}}"
                                    
                                    @if($data->APP_VALUE_1==$record->trip_status)
                                        selected
                                    @endif

                                    >{{$data->APP_VALUE_1}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $record->status }}"  readonly> -->
                        </div>
                    </div>
                </div>
                </fieldset>
            </form>

        @elseif($actionMethod == 'edit') 
        <form method="POST" action="{{route('driver.update', $record->id)}}">
            @csrf
            @method('PUT')
            <input type="hidden" value="{{$record->id}}"/>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label">Firstname:</label>
                            <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" value="{{ $record->firstname }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" >Middlename:</label>
                            <input type="text" class="form-control form-control-lg" id="middlename" name="middlename" value="{{ $record->middlename }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Lastname:</label>
                            <input type="text" class="form-control form-control-lg" id="lastname" name="lastname" value="{{ $record->lastname }}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Contact No.:</label>
                            <input type="text" class="form-control form-control-lg" id="contact_no" name="contact_no" value="{{ $record->contact_no }}"  >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Address.:</label>
                            <input type="text" class="form-control form-control-lg" id="address" name="address" value="{{ $record->address }}"  >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Position:</label>
                            <select class="form-control form-control-lg" id="position" name="position" >
                                <option></option>
                                @foreach($position as $data)
                                    <option 
                                    
                                    @if($data->APP_VALUE_1==$record->position)
                                        selected
                                    @endif
                                    
                                    value="{{$data->APP_VALUE_1}}">{{$data->APP_VALUE_1}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Status:</label>
                            <select class="form-control form-control-lg" id="trip_status" name="trip_status">
                                <option></option>
                                @foreach($status as $data)
                                    <option value="{{$data->APP_VALUE_1}}"
                                    
                                    @if($data->APP_VALUE_1==$record->trip_status)
                                        selected
                                    @endif

                                    >{{$data->APP_VALUE_1}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $record->status }}"  readonly> -->
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
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

@endsection