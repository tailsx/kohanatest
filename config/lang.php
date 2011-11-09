<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * List of all supported languages. Array keys match language segment from the URI.
 * A default fallback language can be set by Lang::$default.
 *
 * Options for each language:
 *  i18n_code    - The target language for the I18n class
 *  locale       - Locale name(s) for setting all locale information (http://php.net/setlocale)
 * 	controller   - An array of controller names in this sequence:
 *                 'controller_in_target_language' => 'controller_in_default_language'
 * 	action       - An array of action names in this sequence:
 *                 'action_in_target_language' => 'action_in_default_language'
 * 	custom param - Any other route param, defined in the same way like the controller or the action, for example
 *                 if you have a 'page' param that you want to translate:
 *
 *                     'page' => array(
 *                          'about_us' => 'uber_uns'
 *                      ),
 */
return array(

	'en' => array(
		'i18n_code'  => 'en-us',
		'locale'     => array('en_US.utf-8'),
	),
	'de' => array(
		'i18n_code'  => 'de-de',
		'locale'     => array('de_DE.utf-8'),
		'controller' => array(
			// Example: 'wilkommen' => 'welcome'
		),
		'action'     => array(
			// Example: 'contact' => 'kontakt'
		),
	),

);