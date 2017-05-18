<?php

namespace OpenOrchestra\BaseBundle\Context;

/**
 * Interface CurrentSiteIdInterface
 *
 * @deprecated use OpenOrchestra\DisplayBundle\Manager\ContextInterface or OpenOrchestra\BackOffice\Manager\ContextInterface
 */
interface CurrentSiteIdInterface
{
    /**
     * Get the current site id
     * @deprecated
     * @return string
     */
    public function getCurrentSiteId();

    /**
     * Get the current default language of the current site
     * @deprecated
     * @return string
     */
    public function getCurrentSiteDefaultLanguage();
}
