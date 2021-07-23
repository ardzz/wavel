<?php

namespace Ardzz\Wavel;

use Ardzz\Wavel\Webhooks\Webhook;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Ardzz\Wavel\Sender\OTP OTP()
 * @method static \Ardzz\Wavel\Sender\Text text()
 * @method static \Ardzz\Wavel\Utility\User user()
 * @method static \Ardzz\Wavel\Sender\Media media()
 * @method static \Ardzz\Wavel\Utility\Group group()
 * @method static \Ardzz\Wavel\Utility\Server server()
 * @method static \Ardzz\Wavel\Sender\Contact contact()
 * @method static \Ardzz\Wavel\Sender\Location location()
 * @method static \Ardzz\Wavel\Utility\Participant participant()
 *
 * @see Wavel
 */
class Wavel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Wavel';
    }

    static function eventValid(Webhook $webhook): bool
    {
        $onMessage = $webhook->getEvents() == 'onMessage' && !$webhook->AmISender() && !$webhook->isGroupMessage();
        $onAnyMessage = $webhook->getEvents() == 'onAnyMessage' && !$webhook->AmISender() && $webhook->isGroupMessage();
        return $onMessage || $onAnyMessage;
    }
}
