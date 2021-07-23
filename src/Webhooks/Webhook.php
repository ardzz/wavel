<?php


namespace Ardzz\Wavel\Webhooks;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Sender\Text;
use Ardzz\Wavel\Wavel;
use Ardzz\Wavel\Webhooks\Collections\Chat;
use Ardzz\Wavel\Webhooks\Collections\Group;
use Ardzz\Wavel\Webhooks\Collections\Sender;

/**
 * Class Webhook
 * @package Ardzz\Wavel\Webhooks
 */
class Webhook
{
    /**
     * Webhook constructor.
     * @param array $data
     */
    function __construct(protected array $data){
        //$this->data = json_decode($data, 1);
    }

    /**
     * @return mixed
     */
    protected function getData(): mixed
    {
        return $this->data['data'];
    }

    /**
     * @return mixed
     */
    function getMessageId(): mixed
    {
        return $this->getData()['id'];
    }

    /**
     * @return string|null
     */
    function getBodyMessage(): ?string
    {
        return $this->getTypeMessage() == 'chat' ? (string) $this->getData()['body'] : null;
    }

    /**
     * @return null|string
     */
    function getTypeMessage(): null|string
    {
        return array_key_exists('type', $this->getData()) ? $this->getData()['type'] : 'n/a';
    }

    /**
     * @return mixed
     */
    function getChatId(): mixed
    {
        return $this->getData()['chatId'];
    }

    /**
     * @return mixed
     */
    function isMedia(): mixed
    {
        return $this->getData()['isMedia'];
    }

    /**
     * @return bool
     */
    function isGroupMessage(): bool
    {
        return (boolean) $this->getData()['isGroupMsg'];
    }

    /**
     * @return bool
     */
    function isNewMessage(): bool
    {
        return (bool) $this->getData()['isNewMsg'];
    }

    /**
     * @return bool
     */
    function AmISender(): bool
    {
        return (bool) $this->getData()['fromMe'];
    }

    /**
     * @return mixed
     */
    function getEvents(): mixed
    {
        return $this->data['event'];
    }

    /**
     * @return Sender
     */
    function sender(): Sender
    {
        return new Sender($this->getData()['sender']);
    }

    /**
     * @return Chat
     */
    function chat(): Chat
    {
        return new Chat($this->getData()['chat']);
    }

    /**
     * @return Group|null
     */
    function group(): ?Group
    {
        if ($this->isGroupMessage()){
            return new Group($this->getData()['chat']['groupMetadata']);
        }
        return null;
    }

    /**
     * @param String $message
     * @return Output|null
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function reply(String $message): ?Output
    {
        if (Wavel::eventValid($this)){
             return (new Text())->reply(
                $message,
                $this->getChatId(),
                $this->getMessageId(),
                $this->isGroupMessage()
            );
        }
        return null;
    }

    /**
     * @return string
     */
    function getType(): string
    {
        return $this->AmISender() ? 'outcome' : 'income';
    }
}
