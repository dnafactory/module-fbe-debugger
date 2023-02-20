<?php

namespace DNAFactory\FacebookBusinessExtensionDebugger\Management;

use Magento\Framework\App\Helper\AbstractHelper;

class DebuggerConfigManagement extends AbstractHelper implements \DNAFactory\FacebookBusinessExtensionDebugger\Api\DebuggerConfigInterface
{
    public const XML_CONFIG_FACEBOOK_PIXEL_DEBUGGER_ENABLED = 'facebook/debugger/active';
    public const XML_CONFIG_FACEBOOK_PIXEL_DEBUGGER_ENABLED_FOR = 'facebook/debugger/active_for_';
    public const XML_CONFIG_FACEBOOK_PIXEL_DEBUGGER_CODE = 'facebook/debugger/debug_code';

    /**
     * @inheritDoc
     */
    public function isEnabled($scopeConfig = \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $scopeCode = null): bool
    {
        return boolval($this->getConfig(self::XML_CONFIG_FACEBOOK_PIXEL_DEBUGGER_ENABLED, $scopeConfig, $scopeCode)?? 'false');
    }

    public function getDebugCode($scopeConfig = \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $scopeCode = null): string
    {
        return $this->getConfig(self::XML_CONFIG_FACEBOOK_PIXEL_DEBUGGER_CODE, $scopeConfig, $scopeCode)?? '';
    }

    public function activeForEvent(string $event, $scopeConfig = \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $scopeCode = null): bool
    {
        return boolval($this->getConfig(self::XML_CONFIG_FACEBOOK_PIXEL_DEBUGGER_ENABLED_FOR.$event, $scopeConfig, $scopeCode)?? 'false');
    }

    protected function getConfig(
        $field,
        $scopeConfig = \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        $scopeCode = null
    ) {
        return $this->scopeConfig->getValue(
            $field,
            $scopeConfig,
            $scopeCode
        );
    }
}
