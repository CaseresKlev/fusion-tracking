@extends('dashboardlayout')

@section('title')
Truck -> {{$actionDescription}}
@endsection

@section('truck', 'active')

@section('content')


<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">

         @include('include.ConfirmationMessages')


          <h4 class="card-title">Truck - {{$actionDescription}} <a href="{{  route('dashboard.truck') }}" class="float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h4>
        
        @if($actionMethod == 'view')  
            <p class="category text-md">You can view your record here. <br>Note: If yo wish to edit the record, please <a href="{{route('truck.edit', $record->id) }}"><strong class="md">Edit Here!</strong></a></p>
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
                <input type="hidden" value="{{$record->id}}"/>
                <div class="form-group ">
                    <label for="formGroupExampleInput" class="control-label">Truck name:</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ $record->name }}" placeholder="Truck name" readonly>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2" >Truck brand:</label>
                    <input type="text" class="form-control form-control-lg" id="brand" name="brand" value="{{ $record->brand }}" placeholder="Truck brand" readonly>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck model:</label>
                    <input type="text" class="form-control form-control-lg" id="model" name="model" value="{{ $record->model }}" placeholder="Truck model" readonly>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">truck plate no.:</label>
                    <input type="text" class="form-control form-control-lg" id="plate_no" name="plate_no" value="{{ $record->plate_no }}" placeholder="truck Plate number" readonly>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck owner:</label>
                    <input type="text" class="form-control form-control-lg" id="owner" name="owner" value="{{ $record->owner }}" placeholder="Truck owner" readonly>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck status:</label>
                    <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $record->status }}" placeholder="Truck status" readonly>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck description:</label>
                    <input type="text" class="form-control form-control-lg" id="description" name="description" value="{{ $record->description }}" placeholder="Truck description" readonly>
                </div>
            </form>

        @elseif($actionMethod == 'edit') 
        <form method="POST" action="{{route('truck.update', $record->id)}}">
            @csrf
            @method('PUT')
                <input type="hidden" value="{{$record->id}}"/>
                <div class="form-group ">
                    <label for="formGroupExampleInput" class="control-label">Truck name:</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ $record->name }}" placeholder="Truck name" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2" >Truck brand:</label>
                    <input type="text" class="form-control form-control-lg" id="brand" name="brand" value="{{ $record->brand }}" placeholder="Truck brand" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck model:</label>
                    <input type="text" class="form-control form-control-lg" id="model" name="model" value="{{ $record->model }}" placeholder="Truck model" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">truck plate no.:</label>
                    <input type="text" class="form-control form-control-lg" id="plate_no" name="plate_no" value="{{ $record->plate_no }}" placeholder="truck Plate number" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck owner:</label>
                    <input type="text" class="form-control form-control-lg" id="owner" name="owner" value="{{ $record->owner }}" placeholder="Truck owner" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck status:</label>
                    <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Truck description:</label>
                    <input type="text" class="form-control form-control-lg" id="description" name="description" value="{{ $record->description }}" placeholder="Truck description" >
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        @elseif($actionMethod == 'create')   
        <form method="POST" action="{{route('company.store')}}">
            @csrf
                <div class="form-group ">
                    <label for="formGroupExampleInput" class="txt-md">Company name:<span class="text-danger control-label">&nbsp;*</span></label>
                    @error('name')
                        <span class="bg-danger txt-md text-white">{{$message}}</span>
                    @enderror
                    <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}" placeholder="Company name" required>
                    
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Company address:</label>
                    <input type="text" class="form-control form-control-lg" id="address" name="address" value="{{ old('address') }}" placeholder="Company address">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Company contact no.:</label>
                    @error('contact_no')
                        <span class="bg-danger txt-md text-white">{{$message}}</span>
                    @enderror
                    <input type="text" class="form-control form-control-lg" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" placeholder="Company contact number" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Company email:</label>
                    @error('email')
                        <span class="bg-danger txt-md text-white">{{$message}}</span>
                    @enderror
                    <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="user@exaple.com"  >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Company description:</label>
                    <input type="text" class="form-control form-control-lg" id="description" name="description" value="{{ old('description')}}" placeholder="Company email" >
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