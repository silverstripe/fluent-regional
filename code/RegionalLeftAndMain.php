<?php

/**
 * Blocks the default Fluent scripts from loading and injects a new "regions" 
 * selector instead of a locale selector.
 *
 * @package  silverstripe-regional
 * @author  Aaron Carlino <aaron@silverstripe.com>
 */
class RegionalLeftAndMain extends LeftAndMainExtension {

	/**
	 * Very similar to Fluent's init function, but uses regions JSON instead of locales
	 */
	public function init() {
		Requirements::block('FluentHeadScript');
 		$dirName = basename(dirname(dirname(dirname(__FILE__))));
 		$regions = json_encode(Injector::inst()->get('Fluent')->getRegionNames());
 		$locale = json_encode(Fluent::current_locale());
 		$param = json_encode(Fluent::config()->query_param);
 		$buttonTitle = json_encode(_t('Fluent.ChangeLocale', 'Change Locale'));

 		// Force the variables to be written to the head, to ensure these are available for other scripts to pick up.
 		Requirements::insertHeadTags(<<<EOT
 <script type="text/javascript">
//<![CDATA[
 	var fluentLocales = $regions;
 	var fluentLocale = $locale;
 	var fluentParam = $param;
 	var fluentButtonTitle = $buttonTitle;
// ]]>
 </script>
EOT
 			,'RegionalHeadScript'
 		);

 		Requirements::javascript("$dirName/javascript/fluent.js");
 		Requirements::css("$dirName/css/fluent.css");
	}
}
