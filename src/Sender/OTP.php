<?php


namespace Ardzz\Wavel\Sender;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Wavel;
use Ichtrojan\Otp\Otp as LaravelOTP;

/**
 * Class OTP
 * @package Ardzz\Wavel\Sender
 */
class OTP
{
    /**
     * @var LaravelOTP
     */
    protected LaravelOTP $otp;
    /**
     * @var string
     */
    protected string $receiver_otp;
    /**
     * @var string
     */
    protected string $otp_message = 'Dear Customer, Your OTP is [otp]. Use this Passcode to complete your activity that needed the OTP code. Thank you.';

    /**
     * OTP constructor.
     */
    public function __construct()
    {
        $this->otp = new LaravelOTP();
    }

    /**
     * @return LaravelOTP
     */
    protected function getOtp(): LaravelOTP
    {
        return $this->otp;
    }

    /**
     * @param string $receiver_otp
     * @return $this
     */
    protected function setReceiverOtp(string $receiver_otp): static
    {
        $this->receiver_otp = $receiver_otp;
        return $this;
    }

    /**
     * @return string
     */
    protected function getReceiverOtp(): string
    {
        return $this->receiver_otp;
    }

    /**
     * @return mixed
     */
    protected function generateCode(): mixed
    {
        return $this->getOtp()->generate($this->getReceiverOtp(), 6, 5);
    }

    /**
     * @param callable $message
     * @param string $code
     * @return mixed
     */
    protected function parseMessage(callable $message, string $code): mixed
    {
        return $message($code, $this->getReceiverOtp());
    }

    /**
     * @param string $code
     * @return string
     */
    protected function loadDefaultMessage(string $code): string
    {
        return str_replace('[otp]', $code, $this->getOtpMessage());
    }

    /**
     * @return string
     */
    protected function getOtpMessage(): string
    {
        return $this->otp_message;
    }

    /**
     * @throws WavelHostIsEmpty
     * @throws WavelError
     */
    function send(string $receiver_otp, callable $message = NULL): ?Output
    {
        $this->setReceiverOtp($receiver_otp);
        $otp = $this->generateCode();
        if ($otp->status){
            if (is_callable($message)){
                $message = $this->parseMessage($message, $otp->token);
                return Wavel::text()->message($message, $receiver_otp);
            }
            return Wavel::text()->message($this->loadDefaultMessage($otp->token), $receiver_otp);
        }
        return null;
    }

    /**
     * @param string $receiver_otp
     * @param string|int $code
     * @return bool
     */
    function validate(string $receiver_otp, string|int $code): bool
    {
        return (boolean) $this->getOtp()->validate($receiver_otp, $code)->status;
    }
}
