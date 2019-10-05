<a class="multiimput-item-image-link"
   href="{!! $image->present()->image(1200, 1200, ['resize']) !!}"
   data-caption="{{ $image->alt_attribute }}"
   data-fancybox="{{ $group ? : 'group' }}"
   data-options='{ "buttons": ["close"], "infobar": false }'
>
    <img class="multiimput-item-image-link-image" src="{!! $image->present()->image(100, 100) !!}" alt="{{ $image->alt_attribute }}">
</a>
