@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://media.istockphoto.com/id/2167836752/vector/cute-panda-waving-paw-cartoon-vector-illustration.jpg?s=1024x1024&w=is&k=20&c=9Q-Hi8n1Ulp5eqsNaL0BFQGEWncWp6owdVcj0Z8Wxaw=" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
