<?php


namespace Ardzz\Wavel\Webhooks;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Sender\Text;
use Ardzz\Wavel\Webhooks\Collections\Chat;
use Ardzz\Wavel\Webhooks\Collections\Group;
use Ardzz\Wavel\Webhooks\Collections\Sender;

class Webhook
{
    function __construct(protected array $data){
        //$this->data = json_decode($data, 1);
    }

    protected function getData()
    {
        return $this->data['data'];
    }

    function getMessageId(){
        return $this->getData()['id'];
    }

    /**
     * @return string|null
     */
    function getBodyMessage(): ?string
    {
        return $this->getTypeMessage() == 'chat' ? (string) $this->getData()['body'] : null;
    }

    function getTypeMessage()
    {
        return array_key_exists('type', $this->getData()) ? $this->getData()['type'] : 'n/a';
    }

    function getChatId(){
        return $this->getData()['chatId'];
    }

    function isMedia(){
        return $this->getData()['isMedia'];
    }

    function isGroupMessage(){
        return $this->getData()['isGroupMsg'];
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

    function getEvents(){
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

    function group(): ?Group
    {
        if ($this->isGroupMessage()){
            return new Group($this->getData()['chat']['groupMetadata']);
        }
        return null;
    }

    /**
     * @throws WavelHostIsEmpty
     * @throws WavelError
     */
    function reply(String $message)
    {
        $onMessage = $this->getEvents() == 'onMessage' && !$this->AmISender() && !$this->isGroupMessage();
        $onAnyMessage = $this->getEvents() == 'onAnyMessage' && !$this->AmISender() && $this->isGroupMessage();
        $text = new Text();

        if ($this->isGroupMessage()){
            $reply = $text->reply(
                $message,
                $this->getChatId(),
                $this->getMessageId(),
                true
            );
        }else{
            $reply = $text->reply(
                $message,
                $this->senderNumber(),
                $this->getMessageId()
            );
        }
    }

    function getType(): string
    {
        return $this->AmISender() ? 'outcome' : 'income';
    }
}
