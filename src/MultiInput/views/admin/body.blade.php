@foreach ($rows as $row)
    <tr class="multiinput-row">
        {!! $row !!}
        @if (empty($config['single-row']))
            <td class="multiinput-elem-remove" title="Remove Item"><i class="fa fa-lg fa-minus-circle"></i></td>
        @endif
    </tr>
@endforeach
