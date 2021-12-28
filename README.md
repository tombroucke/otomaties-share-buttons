# Otomaties Share Buttons

## Requirements
[Font Awesome](https://fontawesome.com/)

## Installation
`composer require tombroucke/otomaties-share-buttons` & activate plugin

## Configuration
https://example.com/wp-admin/options-general.php?page=otomaties-share-buttons

## Customization
### Filters
```php
otomaties_share_buttons_string_copied_link // String to display in alert
otomaties_share_buttons_string_copy_link_error // String to display in alert
otomaties_share_buttons_container_class // Buttons container class
otomaties_share_buttons_button_class // Button class
otomaties_share_buttons_button_icon // Button icon, 2nd parameter is type (e.g. facebook)
otomaties_share_buttons_button // Button output, 2nd parameter is type (e.g. facebook)
otomaties_share_buttons_output // HTML output
```

### Copy link button
You could uncheck 'Display alert after copying link' in the Share buttons settings, and display a custom notification. (Example: Bootstrap 4 Toast)

```php
add_filter('otomaties_share_buttons_output', function ($output) {
    ob_start();
    ?>
    <div class="toast bg-success toast--copied hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success">
            <strong class="toast-title text-white mr-auto"></strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body text-white">
        </div>
    </div>
    <?php
    return $output . ob_get_clean();
});
```

```javascript
window.addEventListener('otomaties_share_button_copied', function(e){
      if(e.detail.copied) {
        $('.toast-title','.toast--copied').html('<i class="fa fa-check"></i> ' + sage_vars.strings.copied.title)
        $('.toast-body','.toast--copied').html(sage_vars.strings.copied.body)
      } else {
        $('.toast-title','.toast--copied').html('<i class="fa fa-times"></i> ' + sage_vars.strings.not_copied.title)
        $('.toast-body','.toast--copied').html(sage_vars.strings.not_copied.body)
      }
      $('.toast--copied').toast('show')
});

$('.toast--copied').toast({
  delay: 8000,
});
```