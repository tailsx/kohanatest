<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Lang {

	/**
	 * @var  string  hard-coded default language, must match a language key from lang config file
	 */
	public static $default = 'en';

	/**
	 * @var  string  name of the cookie that contains language
	 */
	public static $cookie = 'lang';

	/**
	 * @var  boolean  this will force the default language to be prepended
	 */
	public static $default_prepended = TRUE;

	/**
	 * @var  boolean  enable or disable i18n routes
	 */
	public static $i18n_routes = FALSE;

	/**
	 * Looks for the best default language available and returns it.
	 * A language cookie and HTTP Accept-Language headers are taken into account.
	 *
	 *     $lang = Lang::default();
	 *
	 * @return  string  language key, e.g. "en", "fr", "nl", etc.
	 */
	public static function find_default()
	{
		// All supported languages
		$langs = (array) Kohana::$config->load('lang');

		// Look for language cookie first
		if ($lang = Cookie::get(Lang::$cookie))
		{
			if (isset($langs[$lang]))
			{
				// Valid language found in cookie
				return $lang;
			}

			// Delete cookie with invalid language
			Cookie::delete(Lang::$cookie);
		}

		// Parse HTTP Accept-Language headers
		foreach (Request::accept_lang() as $lang => $quality)
		{
			if (isset($langs[$lang]))
			{
				// Return the first language found (the language with the highest quality)
				return $lang;
			}
		}

		// Return the hard-coded default language as final fallback
		return Lang::$default;
	}

    /**
     * Return the short code for the current language.
     *
     * @param   string  $language
     * @return  string
     */
    public static function shortcode($language = NULL)
    {
        if ($language === NULL)
        {
            // Set language to current language
            $language = i18n::$lang;
        }

        return substr($language, 0, strpos($language, '-'));
    }

} // End Kohana_Lang
