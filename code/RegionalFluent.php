<?php

/**
 * A wrapper for the main Fluent class that handles resolving all the regions
 *
 * @package  silverstripe-regional
 * @author  Aaron Carlino <aaron@silverstripe.com>
 */
class RegionalFluent extends DataExtension
{
    /**
     * Given a URL, get the current region, e.g. /nz/community/forum returns 'nz'
     * 
     * @param  string $url Defaults to current REQUEST_URI
     * @return string
     */
    public static function get_region_from_url($url = null)
    {
        if (!$url) {
            $url = $_SERVER['REQUEST_URI'];
        }
        $parts = explode('?', $url);
        $url = $parts[0];

        foreach (Fluent::locales() as $locale) {
            $alias = Fluent::alias($locale);
            if (preg_match('/^\/'.$alias.'(\/|$)/', $url)) {
                return $alias;
            }
        }

        return self::default_region();
    }

    /**
     * Gets the default region, e.g. 'nz'
     * @return string 
     */
    public static function default_region()
    {
        return Fluent::alias(Fluent::default_locale());
    }

    /**
     * Gets the URL associated with the page as it is stored in the database, as if
     * Fluent were not in use.
     * 
     * @param  string $url Defaults to current REQUEST_URI
     * @return string
     */
    public static function get_canonical_url($url = null)
    {
        if (!$url) {
            $url = $_SERVER['REQUEST_URI'];
        }
        $parts = explode('?', $url);
        $url = $parts[0];
        $region = self::get_region_from_url($url);

        return preg_replace('/^\/'.$region.'(\/|$)/', '/', $url);
    }

    /**
     * Gets a list of all the regions with nice names, e.g. "Australia, New Zealand"
     * @return array
     */
    public function getRegionNames()
    {
        $regions = array();
        $region_labels = Fluent::config()->region_labels;

        foreach (Fluent::locale_names() as $locale => $name) {
            $regions[$locale] = isset($region_labels[$locale]) ? $region_labels[$locale] : $name;
        }

        return $regions;
    }
}
