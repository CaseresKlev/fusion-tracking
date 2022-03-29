
@isset($confirmationMessage)
<div class="alert alert-{{$alertType}} alert-dismissible fade show text-dark" role="alert">
    <strong class="text-dark">{{$confirmationMessage}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>   
@endif 

@if(session()->get('confirmationMessage')!==NULL)   
<div class="alert alert-{{session()->get('alertType')}} alert-dismissible fade show text-dark" role="alert">
    <strong class="text-dark">{{session()->get('confirmationMessage')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>   
@endif




