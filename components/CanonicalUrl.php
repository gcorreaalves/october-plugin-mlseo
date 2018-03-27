<?php namespace Fw\Seo\Components;

use Cms\Classes\ComponentBase;
use \RainLab\Translate\Classes\Translator;

class CanonicalUrl extends ComponentBase
{
    public $user;

    public function componentDetails()
    {
        return [
            'name' => 'fw.seo::lang.component_canonical_url.name',
            'description' => 'fw.seo::lang.component_canonical_url.description'
        ];
    }

    public function onRun()
    {
        $translator = Translator::instance();
        $baseUrl = url('/');
        $baseUrlLocale = $baseUrl . '/' . $translator->getLocale(true);
        $currentUrl = $this->currentPageUrl();

        if (preg_match("/([a-z]{2}_[A-Z]{2})/", $currentUrl)) {
            $this->page['canonicalUrl'] = $currentUrl;
        } else {
            $this->page['canonicalUrl'] = str_replace($baseUrl, $baseUrlLocale, $currentUrl);
        }
    }
}
