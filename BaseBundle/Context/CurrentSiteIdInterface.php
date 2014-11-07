<?php

namespace PHPOrchestra\BaseBundle\Context;


/**
 * Interface CurrentSiteIdInterface
 */
interface CurrentSiteIdInterface
{
    /**
     * Get the current site id
     *
     * @return string
     */
    public function getCurrentSiteId();

    /**
     * Get the current default language of the current site
     *
     * @return string
     */
    public function getCurrentSiteDefaultLanguage();
}
