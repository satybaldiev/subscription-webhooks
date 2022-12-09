<?php

namespace Axel\SubscriptionWebhooks\Helpers;

class TransactionInfo extends BaseJsonClass
{
    private $transactionId;
    private $originalTransactionId;
    private $webOrderLineItemId;
    private $bundleId;
    private $productId;
    private $subscriptionGroupIdentifier;
    private $purchaseDate;
    private $originalPurchaseDate;
    private $expiresDate;
    private $quantity;
    private $type;
    private $inAppOwnershipType;
    private $signedDate;
    private $environment;
    private $appAccountToken;
    private $isUpgraded;
    private $offerIdentifier;
    private $offerType;
    private $revocationDate;
    private $revocationReason;

    public static function parse($signedTransactionInfo): self
    {
        $data                                  = decodePayload($signedTransactionInfo);
        $instance                              = new self();
        $instance->appAccountToken             = $data->appAccountToken ?? null;
        $instance->bundleId                    = $data->bundleId ?? null;
        $instance->environment                 = $data->environment ?? null;
        $instance->expiresDate                 = $data->expiresDate ?? null;
        $instance->inAppOwnershipType          = $data->inAppOwnershipType ?? null;
        $instance->isUpgraded                  = $data->isUpgraded ?? null;
        $instance->offerIdentifier             = $data->offerIdentifier ?? null;
        $instance->offerType                   = $data->offerType ?? null;
        $instance->originalPurchaseDate        = $data->originalPurchaseDate ?? null;
        $instance->originalTransactionId       = $data->originalTransactionId ?? null;
        $instance->productId                   = $data->productId ?? null;
        $instance->purchaseDate                = $data->purchaseDate ?? null;
        $instance->quantity                    = $data->quantity ?? null;
        $instance->revocationDate              = $data->revocationDate ?? null;
        $instance->revocationReason            = $data->revocationReason ?? null;
        $instance->signedDate                  = $data->signedDate ?? null;
        $instance->subscriptionGroupIdentifier = $data->subscriptionGroupIdentifier ?? null;
        $instance->transactionId               = $data->transactionId ?? null;
        $instance->type                        = $data->type ?? null;
        $instance->webOrderLineItemId          = $data->webOrderLineItemId ?? null;
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transactionId;
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
    public function getWebOrderLineItemId()
    {
        return $this->webOrderLineItemId;
    }

    /**
     * @return mixed
     */
    public function getBundleId()
    {
        return $this->bundleId;
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
    public function getSubscriptionGroupIdentifier()
    {
        return $this->subscriptionGroupIdentifier;
    }

    /**
     * @return mixed
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * @return mixed
     */
    public function getOriginalPurchaseDate()
    {
        return $this->originalPurchaseDate;
    }

    /**
     * @return mixed
     */
    public function getExpiresDate()
    {
        return $this->expiresDate;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getInAppOwnershipType()
    {
        return $this->inAppOwnershipType;
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
    public function getAppAccountToken()
    {
        return $this->appAccountToken;
    }

    /**
     * @return mixed
     */
    public function getIsUpgraded()
    {
        return $this->isUpgraded;
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
    public function getRevocationDate()
    {
        return $this->revocationDate;
    }

    /**
     * @return mixed
     */
    public function getRevocationReason()
    {
        return $this->revocationReason;
    }
}