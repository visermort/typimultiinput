## Typi MultiInput


Extension for TypiCMS.

For making multi-value fields with recursion.

TypiCMS is a modular multilingual content management system built with [Laravel 6](https://laravel.com). Out of the box you can manage pages, events, news, places, menus, translations, etc.

#### Installation

1. Install TypiCMS 

2. Install TypiMultiInput

   ````
   composer .....
   ````
    
3. Write configuration in /config/app.php

   ```
    'providers' => [

        ...
        
        visermort\typimultiinput\MultiInputProvider::class,


    ],

    'aliases' => [
        ...

        'MultiInput' => visermort\typimultiinput\MultiInput::class,


    ],
   ```
4. Publish MultiInput parts to project directory (config, views, scss, js)

    ````
    php artisan vendor:publish --provider="visermort\typimultiinput\MultiInputProvider"
    
    ```` 
5. Write links to scss

   /resources/scss/admin.scss

   ````
   ...
   @import 'admin/multiinput';
   ...    
        
   ```` 
   /resources/scss/public.scss

   ````
   ...
   @import 'public/multiinput';
   ...    
        
   ```` 
6. Build assets

   ````
   npm run dev (prod, watch..)
   
   ```` 
    
#### Usage

1. There is sample config "advantages" in /config/multiinput.php.

   Make your configurations here.

2. Make field in table by migration.

   ````
   Schema::table('products', function (Blueprint $table) {
       $table->string('advantages')->nullable(true);
   });
   ```` 
  
3. Write in admin form template
 
    ````
    ...
    <div class="form-group">
        {!! MultiInput::render('advantages', 'advantages', $model) !!}
    </div>
    ...

    ```` 
    argument1 "advantages" - Model attribute name<br>
    argument2 "advantages" - configuration name<br>
    argument2 $model - Model
    
    blade templates for admin - /resources/views/vendor/multiinput/admin/
    
4. Write in public template     

     ````
     ...
     <div class="advantages">
        <h5>Advantages</h5>
        {!! MultiInput::publish('advantages', 'advantages', $model->present()) !!}
     </div>
     ...
     or
     ...
     <div class="advantages">
        <h5>Advantages</h5>
        {!! MultiInput::publish('advantages', 'advantages', $model->present(), ['templates' => ['file'=>'other_file', 'main'=>'other_main']]) !!}
     </div>
     ...
 
     ```` 
    argument4 - params. Not required 

    Default templates in /resources/views/vendor/multiinput/public/<attribute name>. Can be override in params
    ```` 
    [
        'templates' => [
            'directory' => path do templates from /resources/views/, defalult 'vendor.multiinput.public.<arrtibute name>.',
            'main' => main template, default 'main',
            'item' => template for item, default 'item',
            'image' => template for image, default 'image',
            'file' => template for document, default 'file',
        ]
    ]  
    ```` 
    
 #### Available field types
 
    Varchar
    Text
    Date
    Dropdown
    Image
    File
    Multiinput - embedder multiinput field
