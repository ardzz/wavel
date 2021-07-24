<?php

namespace Ardzz\Wavel;

use Ardzz\Wavel\Cores\Http\Request;
use Ardzz\Wavel\Sender\Contact;
use Ardzz\Wavel\Sender\Location;
use Ardzz\Wavel\Sender\Media;
use Ardzz\Wavel\Sender\OTP;
use Ardzz\Wavel\Sender\Text;
use Ardzz\Wavel\Utility\Chat;
use Ardzz\Wavel\Utility\Group;
use Ardzz\Wavel\Utility\Participant;
use Ardzz\Wavel\Utility\Server;
use Ardzz\Wavel\Utility\User;

/**
 * Class WavelFactory
 * @package Ardzz\Wavel
 */
class WavelFactory
{
    /**
     * WavelFactory constructor.
     */
    public function __construct(string $wavelHost, string $wavelApiKey = null, string $wavelProxy = null)
    {
        Request::init($wavelHost, $wavelApiKey, $wavelProxy);
    }

    /**
     * @return OTP
     */
    function OTP(): OTP
    {
        return new OTP();
    }

    /**
     * @return Text
     */
    function text(): Text
    {
        return new Text();
    }

    /**
     * @return User
     */
    function user(): User
    {
        return new User();
    }

    /**
     * @return Chat
     */
    function chat(): Chat
    {
        return new Chat();
    }

    /**
     * @return Media
     */
    function media(): Media
    {
        return new Media();
    }

    /**
     * @return Group
     */
    function group(): Group
    {
        return new Group();
    }

    /**
     * @return Server
     */
    function server(): Server
    {
        return new Server();
    }

    /**
     * @return Contact
     */
    function contact(): Contact
    {
        return new Contact();
    }

    /**
     * @return Location
     */
    function location(): Location
    {
        return new Location();
    }

    /**
     * @return Participant
     */
    function participant(): Participant
    {
        return new Participant();
    }
}
