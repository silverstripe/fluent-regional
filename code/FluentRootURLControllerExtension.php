<?php

class FluentRootURLControllerExtension extends DataExtension
{
    public function updateRedirectLocale(&$locale)
    {
        if (!$locale) {
            $locale = Fluent::config()->default_locale;
        }
    }
}
