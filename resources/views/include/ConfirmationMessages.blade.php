
@if(session()->get('confirmationMessage')!==NULL)   
<div class="alert alert-{{session()->get('alertType')}} alert-dismissible fade show" role="alert">
    <strong>{{session()->get('confirmationMessage')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>   
@endif 




