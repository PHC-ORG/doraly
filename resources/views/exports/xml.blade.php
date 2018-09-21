<table>
    <thead>
    <tr>
      @if (is_array($data[0]) || is_object($data[0]))

        @foreach($data[0] as $key => $value)
            <th>{{ ucfirst($key) }}</th>
        @endforeach

      @endif
    </tr>
    </thead>
    <tbody>
    @if (is_array($data) || is_object($data))
    @foreach($data as $row)
        <tr>
        @foreach ($row as $value)
            <td>{{ $value }}</td>
        @endforeach
        </tr>
    @endforeach

    @endif
    </tbody>
</table>
