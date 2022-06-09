
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

.modal-dialog {
    max-width: 700px;
}


</style>

        @if($modalActionMethod == 'view')        
       <form method="POST" action="{{route('expense.store')}}" id="form-expense">
            <!-- <fieldset disabled="disabled"> -->
            @error('trip_id')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('company_id')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('truck_id')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('driver_id')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('ref_no')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('stock_source')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('destination')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('item')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('quantity')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('accumulated_total')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('entry_by')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            @error('date')
                <span class="bg-danger txt-md text-white">{{$message}}</span>
            @enderror
            <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">TRIP ID:</label>
                            <input type="text" class="form-control form-control-lg disabledComponent" name="trip_id" value="{{$tripRecord->id}}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">COMPANY:</label>
                            <select class="form-control form-control-lg disabledComponent" name="company_id" id="company_id" disabled>
                                <option value=""></option>
                            
                            @foreach($companyList  as $c)
                            <option value="{{$c->id}}" 
                                    @if($c->id==$modelTruck->company_id)
                                        selected
                                    @endif
                                >{{$c->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                        <?php echo $record->id ?>
                            <label for="formGroupExampleInput" class="control-label font-weight-bold ">Truck:</label>
                            <select name="truck_id" id="truck_id" class="form-control form-control-lg disabledComponent" disabled>
                                @foreach($truckList  as $t)
                                <option value="{{$t->id}}" 
                                        @if($t->id==$modelTruck->id)
                                            selected
                                        @endif
                                    >{{$t->name . ' | ' . $t->plate_no}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold" >Driver:</label>
                            
                            <select name="driver_id" id="driver_id" class="form-control form-control-lg disabledComponent"
                            @isset($tripRecord)
                                disabled
                            @endisset
                            >
                                <option value=""></option>
                                @foreach($driverList  as $d)
                                <option value="{{$d->id}}" 
                                        @if($d->id==$record->driver_id)
                                            selected
                                        @endif
                                    >{{$d->firstname . ' ' . $d->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Ref. # / PPIS #:</label>
                            <input type="text" class="form-control form-control-lg"  id="refID" name="ref_no" value="{{$expenseRecord->ref_no}}">
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Source:</label>
                            <input type="text" class="form-control form-control-lg"  id="source" name="stock_source" value="{{$tripRecord->source}}"

                            @isset($tripRecord)
                                readonly
                            @endisset
                            >
                        </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">Destination:</label>
                            <input type="text" class="form-control form-control-lg"  id="destination" name="destination" value="{{$tripRecord->destination}}" 
                            @isset($tripRecord)
                                readonly
                            @endisset
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">ITEM:</label>
                            <input type="text" class="form-control form-control-lg"  id="item" name="item" value="{{$expenseRecord->item}}" required>
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">QUANTITY:</label>
                            <input type="text" class="form-control form-control-lg" id="quantity" name="quantity" value="{{$expenseRecord->quantity}}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">ACCUMULATED TOTAL:</label>
                            <input type="number" class="form-control form-control-lg" id="accumulated_total" name="accumulated_total" value="{{$expenseRecord->accumulated_total}}" required>
                        </div>   
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">ENTRY BY:</label>
                            <input type="text" class="form-control form-control-lg" id="entry_by" name="entry_by" value="{{$expenseRecord->entry_by}}" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">DATE:</label>
                            <input type="text" class="form-control form-control-sm" id="dateinput" name="date" value="{{$tripRecord->date}}" required readonly="readonly">
                        </div>   
                    </div>
                </div>
                
            <!-- </fieldset> -->
            </form>

        @elseif($modalActionMethod == 'edit') 


        @elseif($modalActionMethod == 'create')   
        @else
            <h5>undefined</h5>
        @endif

       
            
          