@extends('dashboardlayout')

@section('title')
Trip -> {{$actionDescription}}
@endsection

@section('trip', 'active')

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


          <h4 class="card-title">TRIP - {{$actionDescription}} <a href="{{  route('dashboard.trip') }}" class="float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h4>
        
        @if($actionMethod == 'view')  
            <p class="category text-md font-weight-bold text-primary">You can view your record here. <br class="bg-red text-white">All values here was used by the system pls. be careful!</p> <br>Note: If yo wish to edit the record, please <a href="{{route('trip.edit', $record->id) }}"><strong class="md">Edit Here!</strong></a></p>
        @elseif($actionMethod == 'edit') 
            <p class="category font-weight-bold text-primary">You can edit your record here. <br class="bg-red text-white">All values here was used by the system pls. be careful!</p>
        @elseif($actionMethod == 'create')   
            <p class="category font-weight-bold text-primary">You can create your record here. <br class="bg-primary font-weight-bold"> All values here was used by the system pls. be careful!</p>
        @else
            <h5>undefined</h5>
        @endif
         
         
          
        </div>
        <div class="card-body">
          <div class="table-responsive">


        @if($actionMethod == 'view')         
        <form>
            <fieldset disabled="disabled">
            <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">TRIP ID:</label>
                            <input type="text" class="form-control form-control-lg" value="{{$record->id}}" disabled readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">TRIP TICKET ID:</label>
                            <input type="text" class="form-control form-control-lg" value="{{$record->trip_ticket_id}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">Truck:</label>
                            <select name="truck_id" id="truck_id" class="form-control form-control-lg">
                                @foreach($truckList as $truck)
                                    <option 
                                    
                                        @if($truck->id == $record->truck_id)
                                            selected
                                        @endif
                                    
                                    value="{{ $truck->id }}">{{ $truck->name . " - " . $truck->plate_no }}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" class="form-control form-control-lg" id="truck_id" name="truck_id" value="{{ $record->truck_id }}" required> -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold" >Driver:</label>
                            <!-- <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="driver_id" name="driver_id" value="{{ $record->driver_id }}" required> -->
                            <select name="truck_id" id="truck_id" class="form-control form-control-lg">
                                @foreach($driverList as $driver)
                                    <option 
                                    
                                        @if($driver->id == $record->driver_id)
                                            selected
                                        @endif

                                    value="{{ $driver->id }}">{{ $driver->firstname . "  " . $driver->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Source:</label>
                            <input type="text" class="form-control form-control-lg"  id="source" name="source" value="{{ $record->source }}" required>
                        </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Destination:</label>
                            <input type="text" class="form-control form-control-lg"  id="destination" name="destination" value="{{ $record->destination }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Distance:</label>
                            <input type="text" class="form-control form-control-lg"  id="distance" name="distance" value="{{ $record->distance }}" >
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Weight Metric Ton:</label>
                            <input type="text" class="form-control form-control-lg"  id="weigth" name="weigth" value="{{ $record->weigth }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Rate:</label>
                            <input type="text" class="form-control form-control-lg" id="rate" name="rate" value="{{ $record->rate }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Bill:</label>
                            <input type="text" class="form-control form-control-lg" id="bill" name="bill" value="{{ $record->bill }}" >
                        </div>   
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Material:</label>
                            <input type="text" class="form-control form-control-lg" id="material" name="material" value="{{ $record->material }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Contractor:</label>
                            <input type="text" class="form-control form-control-lg" id="contractor" name="contractor" value="{{ $record->contractor }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Loaded by:</label>
                            <input type="text" class="form-control form-control-lg" id="loaded_by" name="loaded_by" value="{{ $record->loaded_by }}" >
                        </div>   
                    </div>
                </div>
                <div class="row"> 
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Loaded Time:</label>
                            <input type="text" class="form-control form-control-lg" id="loaded_time" name="loaded_time" value="{{ $record->loaded_time }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">TX No.:</label>
                            <input type="text" class="form-control form-control-lg" id="tx_no" name="tx_no" value="{{ $record->tx_no }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Date:</label>
                            <input type="text" class="form-control form-control-lg" id="date" name="date" value="{{ $record->date }}" >
                        </div>   
                    </div>
                </div>
            </fieldset>
            </form>

        @elseif($actionMethod == 'edit') 

        <form method="POST" action="{{route('trip.update', $record->id)}}" >
            @csrf
            @method('PUT')
            
            <input type="hidden" name="id" value="{{$record->id}}"/>
            <input type="hidden" class="form-control form-control-lg" id="bill" name="bill" value="{{ $record->bill }}" >
            <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">TRIP ID:</label>
                            <input type="text" class="form-control form-control-lg" value="{{$record->id}}" disabled readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">TRIP TICKET ID:</label>
                            <input type="text" class="form-control form-control-lg" name="trip_ticket_id" id="trip_ticket_id" value="{{$record->trip_ticket_id}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">Truck:</label>
                            @error('truck_id')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <select name="truck_id" id="truck_id" class="form-control form-control-lg" required>
                                @foreach($truckList as $truck)
                                    <option 
                                    
                                        @if($truck->id == $record->truck_id)
                                            selected
                                        @endif
                                    
                                    value="{{ $truck->id }}">{{ $truck->name . " - " . $truck->plate_no }}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" class="form-control form-control-lg" id="truck_id" name="truck_id" value="{{ $record->truck_id }}" required> -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold" >Driver:</label>
                            <!-- <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="driver_id" name="driver_id" value="{{ $record->driver_id }}" required> -->
                            @error('driver_id')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <select name="driver_id" id="driver_id" class="form-control form-control-lg" required>
                                @foreach($driverList as $driver)
                                    <option 
                                    
                                        @if($driver->id == $record->driver_id)
                                            selected
                                        @endif

                                    value="{{ $driver->id }}">{{ $driver->firstname . "  " . $driver->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Source:</label>
                            @error('source')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg"  id="source" name="source" value="{{ $record->source }}" required>
                        </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Destination:</label>
                            @error('destination')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg"  id="destination" name="destination" value="{{ $record->destination }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Distance:</label>
                            @error('distance')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg"  id="distance" name="distance" value="{{ $record->distance }}" required>
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Weight:</label>
                            @error('weigth')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg"  id="weigth" name="weigth" value="{{ $record->weigth }}" required>
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Rate:</label>
                            @error('rate')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="rate" name="rate" value="{{ $record->rate }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Material:</label>
                            <input type="text" class="form-control form-control-lg" id="material" name="material" value="{{ $record->material }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Contractor:</label>
                            <input type="text" class="form-control form-control-lg" id="contractor" name="contractor" value="{{ $record->contractor }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Loaded by:</label>
                            <input type="text" class="form-control form-control-lg" id="loaded_by" name="loaded_by" value="{{ $record->loaded_by }}" >
                        </div>   
                    </div>
                </div>
                <div class="row"> 
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Loaded Time:</label>
                            <input type="text" class="form-control form-control-lg" id="loaded_time" name="loaded_time" value="{{ $record->loaded_time }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">TX No.:</label>
                            <input type="text" class="form-control form-control-lg" id="tx_no" name="tx_no" value="{{ $record->tx_no }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Entry by:</label>
                            @error('entry_by')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="hidden" id="entry_by" name="entry_by_name" value="{{ $record->entry_by }}">
                            <input type="text" class="form-control form-control-lg" value="{{ $record->entry_by }}"  >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Date:</label>
                            @error('date')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="date" name="date" value="{{ $record->date }}"  readonly>
                        </div>   
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>


        @elseif($actionMethod == 'create')   
        <form action="{{route('trip.store')}}" method="POST">
        @csrf
        <input type="hidden" class="form-control form-control-lg" id="bill" name="bill" value="{{ old('bill') }}" >
            <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">TRIP TICKET ID:</label>
                            @error('trip_ticket_id')
                            <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="trip_ticket_id" name="trip_ticket_id" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">Truck:</label>
                            @error('truck_id')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <select name="truck_id" id="truck_id" class="form-control form-control-lg" required>
                                @foreach($truckList as $truck)
                                    <option 
                                    
                                        @if($truck->id == old('truck_id'))
                                            selected
                                        @endif
                                    
                                    value="{{ $truck->id }}">{{ $truck->name . " - " . $truck->plate_no }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold" >Driver:</label>
                            @error('driver_id')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <select name="driver_id" id="driver_id" class="form-control form-control-lg" required>
                                @foreach($driverList as $driver)
                                    <option 
                                    
                                        @if($truck->id == old('driver_id'))
                                            selected
                                        @endif

                                        value="{{ $driver->id }}">{{ $driver->firstname . "  " . $driver->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Source:</label>
                            @error('source')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg"  id="source" name="source" value="{{old('source')}}" required>
                        </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Destination:</label>
                            @error('destination')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg"  id="destination" name="destination" value="{{ old('destination') }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Distance:</label>
                            @error('distance')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="number" class="form-control form-control-lg"  id="distance" name="distance" value="{{ old('distance') }}" >
                        </div>   
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Weight:</label>
                            @error('weigth')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="number" class="form-control form-control-lg"  id="weigth" name="weigth" value="{{ old('weigth') }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Rate:</label>
                            @error('rate')
                                    <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="number" class="form-control form-control-lg" id="rate" name="rate" value="{{ old('rate') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Material:</label>
                            <input type="text" class="form-control form-control-lg" id="material" name="material" value="{{ old('material') }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Contractor:</label>
                            <input type="text" class="form-control form-control-lg" id="contractor" name="contractor" value="{{ old('contractor') }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Loaded by:</label>
                            <input type="text" class="form-control form-control-lg" id="loaded_by" name="loaded_by" value="{{ old('loaded_by') }}" >
                        </div>   
                    </div>
                </div>
                <div class="row"> 
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Loaded Time:</label>
                            <input type="text" class="form-control form-control-lg" id="loaded_time" name="loaded_time" value="{{ old('loaded_time') }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">TX No.:</label>
                            <input type="text" class="form-control form-control-lg" id="tx_no" name="tx_no" value="{{old('tx_no')}}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group date">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Date:</label>
                            @error('date')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="date" class="form-control form-control-sm" id="date" name="date" value="{{ old('date') }}" required>
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

@include('expense.index') 
@endsection

@section("scripts")


<script src="{{asset('/js/globalFunctions.js')}}"></script>

@endsection