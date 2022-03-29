@extends('dashboardlayout')

@section('title')
Settings -> {{$actionDescription}}
@endsection

@section('settings', 'active')

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


          <h4 class="card-title">SETTINGS - {{$actionDescription}} <a href="{{  route('dashboard.settings') }}" class="float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h4>
        
        @if($actionMethod == 'view')  
            <p class="category text-md font-weight-bold text-primary">You can view your record here. <br class="bg-red text-white">All values here was used by the system pls. be careful!</p> <br>Note: If yo wish to edit the record, please <a href="{{route('settings.edit', $record->id) }}"><strong class="md">Edit Here!</strong></a></p>
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
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">App Name:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_name" name="app_name" value="{{ $record->app_name }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold" >App Section:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_section" name="app_section" value="{{ $record->app_section }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Field:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_field" name="app_field" value="{{ $record->app_field }}" required>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 1:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_value_1" name="app_value_1" value="{{ $record->app_value_1 }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 2:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_vaue_2" name="app_value_2" value="{{ $record->app_value_2 }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 3:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_vaue_3" name="app_value_3" value="{{ $record->app_value_3 }}" >
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Setting description:</label>
                            <input type="text" class="form-control form-control-lg" id="app_setting_description" name="app_setting_description" value="{{ $record->app_setting_description }}" required>
                        </div>
                    </div>
                </div>
            </fieldset>
            </form>

        @elseif($actionMethod == 'edit') 
        <form method="POST" action="{{route('settings.update', $record->id)}}">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">App Name:</label>
                            @error('app_name')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_name" name="app_name" value="{{ $record->app_name }}" required readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold" >App Section:</label>
                            @error('app_section')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_section" name="app_section" value="{{ $record->app_section }}" required readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Field:</label>
                            @error('app_field')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_field" name="app_field" value="{{ $record->app_field }}" required readonly>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 1:</label>
                            @error('app_value_1')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_value_1" name="app_value_1" value="{{ $record->app_value_1 }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 2:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_value_2" name="app_value_2" value="{{ $record->app_value_2}}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 3:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_value_3" name="app_value_3" value="{{ $record->app_value_3 }}" >
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Setting description:</label>
                            @error('app_setting_description')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="app_setting_description" name="app_setting_description" value="{{ $record->app_setting_description }}" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        @elseif($actionMethod == 'create')   
        <form method="POST" action="{{route('settings.store')}}">
            @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">App Name:</label>
                            @error('app_name')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_name" name="app_name" value="{{ old('app_name') }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold" >App Section:</label>
                            @error('app_section')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_section" name="app_section" value="{{ old('app_section') }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Field:</label>
                            @error('app_field')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_field" name="app_field" value="{{ old('app_field') }}" required>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 1:</label>
                            @error('app_value_1')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_value_1" name="app_value_1" value="{{ old('app_value_1') }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 2:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_value_2" name="app_value_2" value="{{ old('record->app_vaue_2') }}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">App Value 3:</label>
                            <input type="text" class="form-control form-control-lg" oninput="this.value = this.value.toUpperCase()" id="app_value_3" name="app_value_3" value="{{ old('app_vaue_3') }}" >
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Setting description:</label>
                            @error('app_setting_description')
                                <span class="bg-danger txt-md text-white">{{$message}}</span>
                            @enderror
                            <input type="text" class="form-control form-control-lg" id="app_setting_description" name="app_setting_description" value="{{ old('app_setting_description') }}" required>
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