<div class="@if (!empty($className)){{ $className }}@endif" data-attribute="{{ $attribute }}">
    <div class="multiinput-header">
        <div class="multiinput-title @if ($root) h5 @endif">{{ $title }}</div>
        @if (empty($config['single-row']))
            <span class="multiinput-elem-add" title="{{ __('multiinput::admin.add-item') }}"><i class="fa fa-lg fa-plus-circle"></i></span>
        @endif
    </div>
    <table class="multiinput-body table table-striped @if (!empty($config['sort-enable'])) sortable @endif">
        <tbody>
            {!! $body !!}
        </tbody>
    </table>
</div>
