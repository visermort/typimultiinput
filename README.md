## Typi MultiInput


Extension for [TypiCMS](https://github.com/TypiCMS/Base).

For making multi-value fields.

[TypiCMS](https://github.com/TypiCMS/Base) is a modular multilingual content management system built with [Laravel 6](https://laravel.com). Out of the box you can manage pages, events, news, places, menus, translations, etc.

### Installation

1. Install TypiCMS 

2. Install TypiMultiInput

   ````
   composer require visermort/typimultiinput
   ````
    
3. Publish MultiInput files to project directory (config, views, scss, js)

    ````
    php artisan vendor:publish --provider="Visermort\TypiMultiInput\MultiInputProvider"
    
    ```` 
4. Write links to scss, js

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
   /resources/js/admin.js - import vue.js component

   ````
   ...
   import MultiInputFileField from './components/MultiInputFileField.vue';
   ...
   ...
   new Vue({
       i18n,
       components: {
            ...
            ...
            MultiInputFileField,
            ...
   
   ...    
        
   ```` 
5. Build assets

   ````
   npm run dev (prod, watch..)
   
   ```` 
    
### Usage

1. There is sample configuration named "advantages" in /config/multiinput.php.

   Make your configurations here.

2. Create field in table by migration.

   ````
   Schema::table('products', function (Blueprint $table) {
       $table->json('advantages')->nullable(true);
   });
   ```` 
3. Update Model class.
  
   ```
   class Product extends Base
   {
       ... 
       protected $casts = [
           'advantages' => 'array',
       ];
       ...
   ```
  
4. Write in admin form template
 
    ````
    ...
    <div class="form-group">
        {!! MultiInput::render('advantages', 'advantages', $model) !!}
    </div>
    ...

    ```` 
    argument1 "advantages" - Model attribute name<br>
    argument2 "advantages" - configuration name<br>
    argument3 $model - Model
    
    blade templates for admin in directory /resources/views/vendor/multiinput/admin/
    
5. Write in public template     

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
### Config    
(All configurations in  /config/multiinput.php.)
 
##### Properties

<b>columns</b> <i>array, for root and columns with type Multiinput, required:</i> The row columns configuration where you can set the properties.<br>
<b>name</b> <i>string, for column, required:</i> Column name.<br>
<b>title</b> <i>string, for root and columns, required:</i> Configuration title, column title. Performs on front as Lang::get('db.'`title`).<br>
<b>type</b> <i>string, for columns, required:</i> Column type.<br>
   
<b>Available field types</b>
 
     Varchar
     Text
     Date
     DateTime
     Number
     Dropdown
     Boolean
     Image
     File
     Multiinput - embedder multiinput field
<b>translatable</b> <i>boolean, for column:</i> Data of all column types will be stored as multilingual if true.<br>
<b>order</b> <i>array, for root and column with type Multiinput:</i> Sort order (on front).<br>
<b>items</b> <i>array, for column with type Dropdown, required:</i> Select options.<br>
<b>rules</b> <i>string, for column:</i> Validation rules. Validation occurs on front by Js. <b>Available rules</b> `requried, min:value, max:value`. Enabled more than one rule `required|max:100`.<br>
<b>clone-enable</b> <i>booldean, for root and column with type Multiinput:</i> Makes "Clone Item" button.<br>
<b>single-row</b> <i>boolean, for root and column with type Multiinput:</i> Makes "Add Item" button if <i>false</i> or empty.<br>
<b>sort-enable</b> <i>boolean, for root and column with type Multiinput:</i> Enable rows sorting by drag&drop on an admin form.<br>
 
