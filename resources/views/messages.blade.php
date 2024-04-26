@if(count($errors)>0)
@foreach($errors as $error)
<div class="flex errorMsg items-center p-3.5 rounded text-white bg-danger" style="max-height: fit-content;">
    <span class="ltr:pr-2 rtl:pl-2">
        <strong class="ltr:mr-1 rtl:ml-1">Error!</strong>{{$error}}
    </span>
    <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80" onclick="hideMessage('errorMsg')">
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>
@endforeach
@if(!is_array($errors))
@foreach($errors->all() as $error)
<div class="flex errorMsg items-center p-3.5 rounded text-white bg-danger" style="max-height: fit-content;">
    <span class="ltr:pr-2 rtl:pl-2">
        <strong class="ltr:mr-1 rtl:ml-1">Error!</strong>{{$error}}
    </span>
    <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80" onclick="hideMessage('errorMsg')">
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>
@endforeach
@endif
@endif
@if(session('success'))
<div class="flex successMsg items-center p-3.5 rounded text-white bg-danger" style="max-height: fit-content;">
    <span class="ltr:pr-2 rtl:pl-2">
        <strong class="ltr:mr-1 rtl:ml-1">Error!</strong>{{session('success')}}
    </span>
    <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80" onclick="hideMessage('successMsg')">
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>
@endif
@if(session('error'))

<div class="flex errorMsg items-center p-3.5 rounded text-white bg-danger" style="max-height: fit-content;">
    <span class="ltr:pr-2 rtl:pl-2">
        <strong class="ltr:mr-1 rtl:ml-1">Error!</strong>{{session('error')}}
    </span>
    <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80" onclick="hideMessage('errorMsg')">
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>
@endif
<script>
    function hideMessage(className) {
        $("." + className).hide();
    }
</script>