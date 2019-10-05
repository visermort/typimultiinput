<div class="@if (!empty($className)){{ $className }}@endif" data-attribute="{{ $attribute }}">
    <div class="multiinput-header">
        <label>{{ $title }}</label>
        @if (empty($config['single-row']))
            <span class="multiinput-elem-add" title="Add Item"><i class="fa fa-lg fa-plus-circle"></i></span>
        @endif
    </div>
    <table class="multiinput-body">
        <tbody>
            {!! $body !!}
        </tbody>
    </table>
</div>
