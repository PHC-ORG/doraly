<html>
<body>
<table >
  <tr>
<td>From</td>
<td>To</td>
<td>In</td>
<td>Out</td>

</tr>

@foreach($data[10] as $export)
<tr>
<td>{{ $export->From }}</td>
<td>{{ $export->To }}</td>
<td>{{ $export->Incoming_cars }}</td>
<td>{{ $export->Outgoing_cars }}</td>
</tr>
@endforeach
</table>
</body>
</html>
