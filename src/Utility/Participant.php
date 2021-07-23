<?php


namespace Ardzz\Wavel\Utility;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

/**
 * Class Participant
 * @package Ardzz\Wavel\Utility
 */
class Participant
{
    use RequestTrait;

    /**
     * Request with same parameter to implement DRY (dont repeat yourself)
     * @param string $endpoint Endpoint RESt API
     * @param string $groupId Group id (e.g, 00000-111111@g.us)
     * @param string $participantId Participant id (e.g, [code country][number] 6283838204803)
     * @return Output Ardzz\Wavel\Cores\Handler\Output instance
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    private function request(string $endpoint, string $groupId, string $participantId): Output
    {
        return $this->process($endpoint, [
            'groupId' => $groupId,
            'participantId' => Format::number($participantId)
        ]);
    }

    /**
     * Remove/kick participant from group
     * @param string $groupId Group id (e.g, 00000-111111@g.us)
     * @param string $participantId Participant id (e.g, [code country][number] 6283838204803)
     * @return Output Ardzz\Wavel\Cores\Handler\Output instance
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function remove(string $groupId, string $participantId): Output
    {
        return $this->request('removeParticipant', $groupId, $participantId);
    }

    /**
     * Invite/add participant into the group
     * @param string $groupId Group id (e.g, 00000-111111@g.us)
     * @param string $participantId Participant id (e.g, [code country][number] 6283838204803)
     * @return Output Ardzz\Wavel\Cores\Handler\Output instance
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function add(string $groupId, string $participantId): Output
    {
        return $this->request('addParticipant', $groupId, $participantId);
    }

    /**
     * Promote participant as admin
     * @param string $groupId Group id (e.g, 00000-111111@g.us)
     * @param string $participantId Participant id (e.g, [code country][number] 6283838204803)
     * @return Output Ardzz\Wavel\Cores\Handler\Output instance
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function promote(string $groupId, string $participantId): Output
    {
        return $this->request('promoteParticipant', $groupId, $participantId);
    }

    /**
     * Demote participant, so they no longer admin
     * @param string $groupId Group id (e.g, 00000-111111@g.us)
     * @param string $participantId Participant id (e.g, [code country][number] 6283838204803)
     * @return Output Ardzz\Wavel\Cores\Handler\Output instance
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function demote(string $groupId, string $participantId): Output
    {
        return $this->request('demoteParticipant', $groupId, $participantId);
    }
}
