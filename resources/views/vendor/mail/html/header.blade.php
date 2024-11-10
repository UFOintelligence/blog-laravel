@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Brito Academy')
<img src="https://cdn.pixabay.com/photo/2017/08/10/08/47/laptop-2620118_1280.jpg" class="logo" alt="Brito Academy">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

