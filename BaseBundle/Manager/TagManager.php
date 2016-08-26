<?php

namespace OpenOrchestra\BaseBundle\Manager;

/**
 * Class TagManager
 */
class TagManager
{
    /**
     * Format node id tag
     * 
     * @param string $nodeId
     * 
     * @return string
     */
    public function formatNodeIdTag($nodeId)
    {
        return 'node-' . $nodeId;
    }

    /**
     * Format language tag
     * 
     * @param string $language
     *
     * @deprecated deprecated since version 1.2.0 and will be removed in 2.0.0
     *
     * @return string
     */
    public function formatLanguageTag($language)
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.2.0 and will be removed in 2.0.0', E_USER_DEPRECATED);

        return 'language-' . $language;
    }

    /**
     * Format site id tag
     * 
     * @param string $siteId
     *
     * @deprecated deprecated since version 1.2.0 and will be removed in 2.0.0
     *
     * @return string
     */
    public function formatSiteIdTag($siteId)
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.2.0 and will be removed in 2.0.0', E_USER_DEPRECATED);

        return 'site-' . $siteId;
    }

    /**
     * Format block type tag
     * 
     * @param string $blockType
     * 
     * @return string
     */
    public function formatBlockTypeTag($blockType)
    {
        return 'block-' . $blockType;
    }

    /**
     * Format content type tag
     * 
     * @param string $contentType
     *
     * @return string
     */
    public function formatContentTypeTag($contentType)
    {
        return 'contentType-' . $contentType;
    }

    /**
     * Format content id tag
     * 
     * @param string $contentId
     * 
     * @return string
     */
    public function formatContentIdTag($contentId)
    {
        return 'contentId-' . $contentId;
    }

    /**
     * Format media id tag
     * 
     * @param string $mediaId
     * 
     * @return string
     */
    public function formatMediaIdTag($mediaId)
    {
        return 'mediaId-' . $mediaId;
    }

    /**
     * Format menu tag
     *
     * @param string $siteId
     *
     * @return string
     */
    public function formatMenuTag($siteId)
    {
        return 'menu-' . $siteId;
    }
}
