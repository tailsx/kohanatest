This Kohana module helps you to setup a multilingual site with URLs that contain a language at the beginning, e.g.:

- `http://example.com/en`
- `http://example.com/fr/page`
- `http://example.com/nl/other/page`

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

The one thing we still need to take care of then, is that any generated URLs should contain the language. An extension of `URL::site` and `Route::url` is created for this. A third argument for `URL::site` and a fourth for `Route::url` is added (`$lang`). By default, the current language is used (`Request::$lang`). You can also provide another language key as a string, or set the argument to `FALSE` to generate a URL without language.

Configuration
-------------

In the `config/lang.php` file you can set all available languages for your site. The keys of the array are the language strings used in the URL, e.g. `en`, `fr`, `nl`, etc. For each language you can set the target language for the `I18n` class, as well as the locale to use for that language.

To change the hard-coded default language (`'en'`), set `Lang::$default` in your `bootstrap.php` file. You can also change the name of the language cookie (`'lang'`) by setting `Lang::$cookie`.

i18n routes
-----------

The module makes it possible to have i18n routes without having to define additional controllers or actions. To achieve this in the following example we will set up a URL that will be translated when needed.

	Route::url('default', array('controller' => __('welcome'), 'action' => __('contact'));

When using the default language (in our example 'en') this will generate an URL like this: *http://domain.com/welcome/contact*. If you define the translations of *welcome* and *contact* in your i18n files (the default, Kohana way) you'll get an URL like this when using 'de' as an example language: *http://domain.com/de/wilkommen/kontakt*

To have this URL load the appropriate controller and action you have to edit the `config/lang.php` and define which translated controller and action points to which default controller and action. To do this find the 'de' language in the config file and add the following arrays:

	'controller' => array(
		'wilkommen' => 'welcome',
	),
	'action' => array(
		'contact'   => 'kontakt',
	),

For routes that have custom params in them do the same as you would do with the controller or action.