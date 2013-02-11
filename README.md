Flexilang is a drop-in module to support the creation of multilingual websites by language prefixed URLs, e.g.:

- `http://example.com/en`
- `http://example.com/fr/page`
- `http://example.com/nl/other/page`

It also supports i18n routes, making it possible to translate route parameters, e.g.:

- `http://example.com/en/welcome`
- `http://example.com/de/wilkommen`

Or

- `http://example.com/en/welcome/about`
- `http://example.com/de/wilkommen/uber`

The module was originally created by [Geert De Deckere](http://www.geertdedeckere.be/) and special thanks to [Wouter Broekhof](http://wakoopa.com/) for his ideas.

How it works
------------

You can think of this module as a lightweight outer layer around your Kohana app. Any incoming URL is immediately inspected for a language part. This check happens during `Request::factory`. Two things can happen.

By default all or your URLs will have a language prepended to them, but it's possible to disable prepending the default language by setting `Lang::$default_prepended` to *FALSE*.

### A. The URI does *not* contain a language

If somebody visits `http://example.com/page`, without a language, the best default language will be found and the user will be redirected to the same URL *with* or *without* (depends on the `Lang::$default_prepended` setting) that language prepended. To find the best language, the following elements are taken into account (in this order):

1. A language cookie (set during a previous visit);
2. The HTTP Accept-Language header;
3. A hard-coded default language.

### B. The URI does contain a language

1. The language key is chopped off and stored in `Request::$lang`.
2. `I18n::$lang` is set to the correct target language (from config).
3. The correct locale is set (from config).
4. A cookie with the language key is set.
5. Normal request processing continues.

It is important to be aware that the *language part is completely chopped off* of the URI. When normal request processing continues it, it does so with a URI without language. This means that **your routes must not contain a `<lang>` key**. Also, you can create HMVC subrequests without having to worry about adding the current language to the URI.

The one thing we still need to take care of then, is that any generated URLs should contain the language. An extension of `URL::site` and `Route::url` is created for this. A third argument for `URL::site` and a fourth for `Route::url` is added (`$lang`). By default, the current language is used (`Request::$lang`). You can also provide another language key as a string, or set the argument to *FALSE* to generate a URL without language.

Configuration
-------------

In the `config/lang.php` file you can set all available languages for your site. The keys of the array are the language strings used in the URL, e.g. `en`, `fr`, `nl`, etc. For each language you can set the target language for the `I18n` class, as well as the locale to use for that language.

To change the hard-coded default language (`'en'`), set `Lang::$default` in your `bootstrap.php` file. You can also change the name of the language cookie (`'lang'`) by setting `Lang::$cookie`.

To set if the default language is prepended or omitted from the URL use the `Lang::$default_prepended` setting.

You can enable i18n routes by setting the `Lang::$i18n_routes` setting to *TRUE* (by default i18n routes are disabled).

i18n routes
-----------

The module makes it possible to have i18n routes (after setting `Lang::$i18n_routes` to *TRUE*) without having to define additional controllers or actions. To set up i18n routes you have to define which route parameters should be translated for a certain route.

### Default route example

In the following example the module will look for translations of the `controller` and `action` parameters, while the `id` parameter is not translated.

    Route::set('default', '(<controller>(/<action>(/<id>)))')
        ->defaults(array(
            'controller' => 'welcome',
            'action'     => 'index',
        ))
        ->translate(array(
            '<controller>' => TRUE,
            '<action>'     => TRUE,
        ));

### Special route example

In the next example the module translates the `action` parameter, the static `custom` and `page` values, and the values in the regex (`hello` and `goodbye`).

    Route::set('special', 'special/<action>(/page/<id>)', array('action' => 'hello|goodbye'))
        ->defaults(array(
            'controller' => 'special',
        ))
        ->translate(array(
            'special'  => TRUE,
            '<action>' => TRUE,
            'page'     => TRUE,
            'hello'    => TRUE,
            'goodbye'  => TRUE,
        ));

### Super special route example

The following example will first translate the complete route and later the action parameter:

    Route::set('superspecial', 'special-<action>-now', array('action' => '[a-zA-Z]++'))
        ->defaults(array(
            'controller' => 'superspecial',
        ))
        ->translate(array(
            'special-<action>-now' => TRUE,
            '<action>'             => TRUE,
        ));

### Setting the translations for route parameters

After setting up the routes the translation for the parameters should be set up in the `config/lang.php` file. Only the non-default languages need the translations.
A German site's example:

    'de' => array(
        'i18n_code'    => 'de-de',
        'locale'       => array('de_DE.utf-8'),
        'translations' => array(
            // Translations for the 'default' route example
            'welcome' => 'willkommen', // controller
            'contact' => 'kontakt',    // example action

            // Translations for the 'special' route example
            'special' => 'besondere',   // static value
            'page'    => 'seite',       // static value
            'hello'   => 'hallo',       // regex value (and action)
            'goodbye' => 'wiedersehen', // regex value (and action)

            // Translations for the 'super special' route example
            'special-<action>-now' => 'besondere-<action>-jetzt', // complete route
            'sale'                 => 'verkauf',                  // example action
        ),
    ),


i18n URIs, URLs
---------------

By default the module will display any URI in the current language. However it's possible to force the translation of the URI in a specified language.
The language can be forced as an extra parameter in the `Route::get()->uri()` and `Route::url()` methods. For example:

    Route::get('default')->uri(array('controller' => 'welcome', 'action' => 'contact'), 'de');

will result in this URI: de/willkommen/kontakt

    Route::url('default', array('controller' => 'welcome', 'action' => 'contact'), NULL, 'de');

will result in this URL: /de/willkommen/kontakt

### i18n links

These methods can be used in combination with `HTML::anchor` method to generate i18n links:

    HTML::anchor(Route::get('default')->uri(array('controller' => 'welcome', 'action' => 'contact')), __('Contact'));

Or

    HTML::anchor(Route::url('default', array('controller' => 'welcome', 'action' => 'contact')), __('Contact'));

The above would always display the link to the contact page in the current language.