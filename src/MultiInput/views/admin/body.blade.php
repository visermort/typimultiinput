@foreach ($rows as $row)
    <tr class="multiinput-row">
        {!! $row !!}
        @if (empty($config['single-row']))
            <td class="multiinput-elem-remove-cell">
                <i title="{{ __('multiinput::admin.remove-item') }} " class="fa fa-lg fa-minus-circle multiinput-elem-remove"></i>
            </td>
        @endif
    </tr>
@endforeach
