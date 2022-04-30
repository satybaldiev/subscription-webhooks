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

    public static function parse($signedTransactionInfo): TransactionInfo
    {
        $data                                  = decodePayload($signedTransactionInfo);
        $instance                              = new self();
        $instance->transactionId               = $data->transactionId ?? null;
        $instance->originalTransactionId       = $data->originalTransactionId?? null;
        $instance->webOrderLineItemId          = $data->webOrderLineItemId ?? null;
        $instance->bundleId                    = $data->bundleId ?? null;
        $instance->productId                   = $data->productId ?? null;
        $instance->subscriptionGroupIdentifier = $data->subscriptionGroupIdentifier ?? null;
        $instance->purchaseDate                = $data->purchaseDate ?? null;
        $instance->originalPurchaseDate        = $data->originalPurchaseDate ?? null;
        $instance->expiresDate                 = $data->expiresDate ?? null;
        $instance->quantity                    = $data->quantity ?? null;
        $instance->type                        = $data->type ?? null;
        $instance->inAppOwnershipType          = $data->inAppOwnershipType ?? null;
        $instance->signedDate                  = $data->signedDate ?? null;
        $instance->environment                 = $data->environment ?? null;
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
}