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
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label">Truck name:</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ $record->name }}" placeholder="Truck name" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" >Truck brand:</label>
                            <input type="text" class="form-control form-control-lg" id="brand" name="brand" value="{{ $record->brand }}" placeholder="Truck brand" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck model:</label>
                            <input type="text" class="form-control form-control-lg" id="model" name="model" value="{{ $record->model }}" placeholder="Truck model" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck plate no.:</label>
                            <input type="text" class="form-control form-control-lg" id="plate_no" name="plate_no" value="{{ $record->plate_no }}" placeholder="truck Plate number" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck owner:</label>
                            <input type="text" class="form-control form-control-lg" id="owner" name="owner" value="{{ $record->owner }}" placeholder="Truck owner" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck status:</label>
                            <!-- <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $record->status }}" placeholder="Truck status" readonly> -->
                            <select class="form-control form-control-lg" aria-label="Default select example" id="status" name="status" readonly disabled="disabled">
                                <option value="{{$record->status}}">{{$record->status}}</option>
                            </select>
                        </div>    
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck description:</label>
                            <input type="text" class="form-control form-control-lg" id="description" name="description" value="{{ $record->description }}" placeholder="Truck description" readonly>
                        </div>    
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck Company:</label>
                            <!-- <input type="text" class="form-control form-control-lg" id="company_id" name="company_id" value="{{ $record->company_id }}" placeholder="Truck description" readonly> -->
                            <select class="form-control form-control-lg" aria-label="Default select example" id="company_id" name="company_id" readonly disabled="disabled">
                                @foreach($companyList as $company)
                                    <option  
                                        @if($company->id == $record->company_id)
                                        selected
                                        @endif

                                        value="{{ $company->id }}">{{ $company->name }}</option>

                                @endforeach
                            </select>
                        </div>     
                    </div>
                </div>
                
            </form>

        @elseif($actionMethod == 'edit') 
        <form method="POST" action="{{route('truck.update', $record->id)}}">
            @csrf
            @method('PUT')
                <input type="hidden" name="id" value="{{$record->id}}"/>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label">Truck name:</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ $record->name }}" placeholder="Truck name" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" >Truck brand:</label>
                            <input type="text" class="form-control form-control-lg" id="brand" name="brand" value="{{ $record->brand }}" placeholder="Truck brand" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck model:</label>
                            <input type="text" class="form-control form-control-lg" id="model" name="model" value="{{ $record->model }}" placeholder="Truck model" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck plate no.:</label>
                            <input type="text" class="form-control form-control-lg" id="plate_no" name="plate_no" value="{{ $record->plate_no }}" placeholder="truck Plate number" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck owner:</label>
                            <input type="text" class="form-control form-control-lg" id="owner" name="owner" value="{{ $record->owner }}" placeholder="Truck owner" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck status:</label>
                            <select class="form-control form-control-lg" aria-label="Default select example" id="status" name="status">
                            <option value=""></option>
                                @foreach($status as $stat)
                                    <option  
                                        @if($stat->APP_VALUE_1 == $record->status)
                                        selected
                                        @endif
                                        value="{{ $stat->APP_VALUE_1 }}">{{ $stat->APP_VALUE_1 }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck description:</label>
                            <input type="text" class="form-control form-control-lg" id="description" name="description" value="{{ $record->description }}" placeholder="Truck description" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Company:</label>
                            <select class="form-control form-control-lg" aria-label="Default select example" id="company_id" name="company_id" required>
                                <option selected></option>
                                @foreach($companyList as $company)
                                    <option  
                                        @if($company->id == $record->company_id)
                                        selected
                                        @endif

                                        value="{{ $company->id }}">{{ $company->name }}</option>

                                @endforeach
                    
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        @elseif($actionMethod == 'create')   
        <form method="POST" action="{{route('truck.store')}}">
            @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label">Truck name:</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{old('name')}}" placeholder="Truck name" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" >Truck brand:</label>
                            <input type="text" class="form-control form-control-lg" id="brand" name="brand" value="{{old('brand')}}" placeholder="Truck brand" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck model:</label>
                            <input type="text" class="form-control form-control-lg" id="model" name="model" value="{{old('model')}}" placeholder="Truck model" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck plate no.:</label>
                            @error('app_name')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="plate_no" name="plate_no" value="{{old('plate_no')}}" placeholder="truck Plate number" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck owner:</label>
                            <input type="text" class="form-control form-control-lg" id="owner" name="owner" value="{{old('owner')}}" placeholder="Truck owner" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck status:</label>
                            <select class="form-control form-control-lg" aria-label="Default select example" id="status" name="status">
                            <option value=""></option>
                                @foreach($status as $stat)
                                    <option value="{{ $stat->APP_VALUE_1 }}">{{ $stat->APP_VALUE_1 }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Truck description:</label>
                            <input type="text" class="form-control form-control-lg" id="description" name="description" value="{{old('description')}}" placeholder="Truck description" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Company:</label>
                            @error('app_name')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <select class="form-control form-control-lg" aria-label="Default select example" id="company_id" name="company_id" required>
                            @foreach($companyList as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>

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

<!--  -->
@endsection

@section("scripts")


<script src="{{asset('/js/globalFunctions.js')}}"></script>

@endsection