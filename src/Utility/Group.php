<?php

namespace Ardzz\Wavel\Utility;

use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;
use Ardzz\Wavel\Sender\Text;
use Ardzz\Wavel\Wavel;
use Ardzz\Wavel\Webhooks\Webhook;

/**
 * Class Group
 * @package Ardzz\Wavel\Utility
 */
class Group
{
    use RequestTrait;

    /**
     * @param string $endpoint
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    private function requestWithGroupId(string $endpoint, string $groupId): Output
    {
        return $this->process($endpoint, [
            'groupId' => $groupId
        ]);
    }

    /**
     * @param string $endpoint
     * @param string $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    private function requestWithChatId(string $endpoint, string $chatId): Output
    {
        return $this->process($endpoint, [
            'chatId' => $chatId
        ]);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function isGroupIdUnsafe(string $groupId): Output
    {
        return $this->process('isGroupIdUnsafe', [
            'groupChatId' => $groupId
        ]);
    }

    /**
     * @param bool $withNewMessagesOnly
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllGroups(bool $withNewMessagesOnly = false): Output
    {
        return $this->process('getAllGroups', [
            'withNewMessagesOnly' => $withNewMessagesOnly
        ]);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getGroupMembersId(string $groupId): Output
    {
        return $this->requestWithGroupId('getGroupMembersId', $groupId);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getGroupInfo(string $groupId): Output
    {
        return $this->requestWithGroupId('getGroupInfo', $groupId);
    }

    /**
     * @param string $link
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function joinGroupViaLink(string $link): Output
    {
        return $this->process('joinGroupViaLink', [
            'link' => $link,
            'returnChatObj' => 'true'
        ]);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function leaveGroup(string $groupId): Output
    {
        return $this->requestWithGroupId('leaveGroup', $groupId);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getGroupMembers(string $groupId): Output
    {
        return $this->requestWithGroupId('getGroupMembers', $groupId);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getGroupInviteLink(string $groupId): Output
    {
        return $this->requestWithChatId('getGroupInviteLink', $groupId);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function revokeGroupInviteLink(string $groupId): Output
    {
        return $this->requestWithChatId('revokeGroupInviteLink', $groupId);
    }

    /**
     * @param string $groupName
     * @param string|array $participants
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function createGroup(string $groupName, string|array $participants): Output
    {
        return $this->process('createGroup', [
            'groupName' => $groupName,
            'contacts' => Format::number($participants)
        ]);
    }

    /**
     * @param string $groupId
     * @param string $filename
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setGroupIcon(string $groupId, string $filename): Output
    {
        return $this->process('setGroupIcon', [
            'groupId' => $groupId,
            'image' => Format::image($filename)
        ]);
    }

    /**
     * @param string $groupId
     * @param string $url
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setGroupIconByUrl(string $groupId, string $url): Output
    {
        return $this->process('setGroupIconByUrl', [
            'groupId' => $groupId,
            'url' => $url
        ]);
    }

    /**
     * @param string $groupId
     * @param bool $onlyAdmins
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setGroupToAdminsOnly(string $groupId, bool $onlyAdmins = true): Output
    {
        return $this->process('setGroupToAdminsOnly', [
            'groupId' => $groupId,
            'onlyAdmins' => $onlyAdmins
        ]);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function unsetGroupToAdminsOnly(string $groupId): Output
    {
        return $this->setGroupToAdminsOnly($groupId, false);
    }

    /**
     * @param string $groupId
     * @param bool $onlyAdmins
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setGroupEditToAdminsOnly(string $groupId, bool $onlyAdmins = true): Output
    {
        return $this->process('setGroupEditToAdminsOnly', [
            'groupId' => $groupId,
            'onlyAdmins' => $onlyAdmins
        ]);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function unsetGroupEditToAdminsOnly(string $groupId): Output
    {
        return $this->setGroupEditToAdminsOnly($groupId, false);
    }

    /**
     * @param string $groupId
     * @param string $description
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setGroupDescription(string $groupId, string $description): Output
    {
        return $this->process('setGroupDescription', [
            'groupId' => $groupId,
            'description' => $description
        ]);
    }

    /**
     * @param string $groupId
     * @param string $title
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setGroupTitle(string $groupId, string $title): Output
    {
        return $this->process('setGroupTitle', [
            'groupId' => $groupId,
            'title' => $title
        ]);
    }

    /**
     * @param string $groupId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getGroupAdmins(string $groupId): Output
    {
        return $this->requestWithGroupId('getGroupAdmins', $groupId);
    }

    /**
     * @throws WavelHostIsEmpty
     * @throws WavelError
     */
    function tagEveryoneByWebhook(Webhook $webhook): array
    {
        /** @var $output Output[] */
        $output = [];
        if ($webhook->isGroupMessage()) {
            $group = $webhook->group();
            $participants = [];
            foreach ($group->getParticipants() as $participant) {
                $participants[] = '@' . (int) $participant['id'];
            }
            $participants = array_chunk($participants, 6);
            foreach ($participants as $participant) {
                $participant = implode(' ', $participant);
                $output[] = (new Text())->messageWithMention($participant, $webhook->getChatId(), true);
            }
        }
        return $output;
    }

    /**
     * @throws WavelHostIsEmpty
     * @throws WavelError
     */
    function tagEveryone(string $groupId): ?array
    {
        /** @var $output Output[] */
        $output = [];
        $participants = [];
        $members = $this->getGroupMembersId($groupId);
        if ($members->isSuccess()){
            foreach ($members->getResponseBody() as $participant) {
                $participants[] = '@' . (int) $participant;
            }
            $participants = array_chunk($participants, 6);
            foreach ($participants as $participant) {
                $participant = implode(' ', $participant);
                $output[] = (new Text())->messageWithMention($participant, $groupId, true);
            }
            return $output;
        }
        return null;
    }
}
