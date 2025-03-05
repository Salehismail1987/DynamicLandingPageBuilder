@if(isset($body_data['message']))
    {{ $body_data['message'] }}
@else
    {{$message}}<br><br>
    {{$note}}
@endif