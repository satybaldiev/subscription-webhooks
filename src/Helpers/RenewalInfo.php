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
    private $priceIncreaseStatus;
    private $gracePeriodExpiresDate;
    private $offerIdentifier;
    private $offerType;
    private $recentSubscriptionStartDate;

    public static function parse($signedRenewalInfo): self
    {
        $data                                  = decodePayload($signedRenewalInfo);
        $instance                              = new self();
        $instance->autoRenewProductId          = $data->autoRenewProductId ?? null;
        $instance->autoRenewStatus             = $data->autoRenewStatus ?? null;
        $instance->environment                 = $data->environment ?? null;
        $instance->expirationIntent            = $data->expirationIntent ?? null;
        $instance->gracePeriodExpiresDate      = $data->gracePeriodExpiresDate ?? null;
        $instance->isInBillingRetryPeriod      = $data->isInBillingRetryPeriod ?? null;
        $instance->offerIdentifier             = $data->offerIdentifier ?? null;
        $instance->offerType                   = $data->offerType ?? null;
        $instance->originalTransactionId       = $data->originalTransactionId ?? null;
        $instance->priceIncreaseStatus         = $data->priceIncreaseStatus ?? null;
        $instance->productId                   = $data->productId ?? null;
        $instance->recentSubscriptionStartDate = $data->recentSubscriptionStartDate ?? null;
        $instance->signedDate                  = $data->signedDate ?? null;
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

    /**
     * @return mixed
     */
    public function getPriceIncreaseStatus()
    {
        return $this->priceIncreaseStatus;
    }

    /**
     * @return mixed
     */
    public function getGracePeriodExpiresDate()
    {
        return $this->gracePeriodExpiresDate;
    }

    /**
     * @return mixed
     */
    public function getOfferIdentifier()
    {
        return $this->offerIdentifier;
    }

    /**
     * @return mixed
     */
    public function getOfferType()
    {
        return $this->offerType;
    }

    /**
     * @return mixed
     */
    public function getRecentSubscriptionStartDate()
    {
        return $this->recentSubscriptionStartDate;
    }



}