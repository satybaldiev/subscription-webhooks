<?php

namespace Axel\SubscriptionWebhooks\Helpers;

class RenewalInfo
{
    private $expirationIntent;
    private $originalTransactionId;
    private $autoRenewProductId;
    private $productId;
    private $autoRenewStatus;
    private $isInBillingRetryPeriod;
    private $signedDate;
    private $environment;

    public static function parse($signedRenewalInfo): RenewalInfo
    {
        $data                             = decodePayload($signedRenewalInfo);
        $instance                         = new self();
        $instance->expirationIntent       = $data->expirationIntent ?? null;
        $instance->originalTransactionId  = $data->originalTransactionId ?? null;
        $instance->autoRenewProductId     = $data->autoRenewProductId ?? null;
        $instance->productId              = $data->productId ?? null;
        $instance->autoRenewStatus        = $data->autoRenewStatus ?? null;
        $instance->isInBillingRetryPeriod = $data->isInBillingRetryPeriod ?? null;
        $instance->signedDate             = $data->signedDate ?? null;
        $instance->environment            = $data->environment ?? null;
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getExpirationIntent()
    {
        return $this->expirationIntent;
    }

    /**
     * @return mixed
     */
    public function getOriginalTransactionId()
    {
        return $this->originalTransactionId;
    }

    /**
     * @return mixed
     */
    public function getAutoRenewProductId()
    {
        return $this->autoRenewProductId;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return mixed
     */
    public function getAutoRenewStatus()
    {
        return $this->autoRenewStatus;
    }

    /**
     * @return mixed
     */
    public function getIsInBillingRetryPeriod()
    {
        return $this->isInBillingRetryPeriod;
    }

    /**
     * @return mixed
     */
    public function getSignedDate()
    {
        return $this->signedDate;
    }

    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

}