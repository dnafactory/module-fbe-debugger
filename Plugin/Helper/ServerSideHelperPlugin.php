<?php
namespace DNAFactory\FacebookBusinessExtensionDebugger\Plugin\Helper;

use DNAFactory\FacebookBusinessExtensionDebugger\Api\DebuggerConfigInterface;
use Facebook\BusinessExtension\Helper\ServerSideHelper\Interceptor;
use FacebookAds\Object\ServerSide\Event;

/**
 * Factory class for generating new ServerSideAPI events with default parameters.
 */
class ServerSideHelperPlugin
{
    /**
     * @var DebuggerConfigInterface
     */
    protected $configManager;
    public function __construct(
        DebuggerConfigInterface $configManager
    )
    {
        $this->configManager = $configManager;
    }

    /**
     * @param Interceptor $subject
     * @param Event $event
     * @param string[] $user_data
     * @return array
     */
    public function beforeSendEvent($subject, $event, $user_data = null)
    {
        if($this->configManager->isEnabled() && $this->configManager->activeForEvent($event->getEventName())) {
            $debug_code = $this->configManager->getDebugCode();
            if(!empty($debug_code)) {
                $data = $event->getCustomData();
                $data->setTestEventCode($debug_code);
            }
        }

        return [$event, $user_data];
    }
}
