<?php

namespace Ardzz\Wavel\Utility;

use Ardzz\Wavel\Webhooks\Webhook;

class Event
{
    protected static Webhook $webhook;

    /**
     * @return Webhook
     */
    static function getWebhook(): Webhook
    {
        return self::$webhook;
    }

    /**
     * @param Webhook $webhook
     */
    static function setWebhook(Webhook $webhook): void
    {
        self::$webhook = $webhook;
    }

    function isValid(Webhook $webhook): bool
    {
        self::setWebhook($webhook);
        $onMessage = $webhook->getEvents() == 'onMessage' && !$webhook->AmISender() && !$webhook->isGroupMessage();
        $onIncomingCall = false;
        if ($webhook->getEvents() == "onIncomingCall"){
            $onIncomingCall = true;
            $onAnyMessage = false;
        }else{
            $onAnyMessage = $webhook->getEvents() == 'onAnyMessage' && $webhook->AmISender() || $webhook->isGroupMessage();
        }
        return $onMessage || $onAnyMessage || $onIncomingCall;
    }

    function onIncomingCall(callable $callback): bool
    {
        if (self::getWebhook()->getEvents() == "onIncomingCall"){
            return $callback($this->getWebhook()->getData()['peerJid']);
        }else{
            return false;
        }
    }
}