<?php

namespace Axel\SubscriptionWebhooks\Helpers\Apple;


use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;

class NotificationData extends BaseJsonClass
{
    private $bundleId;
    private $bundleVersion;
    private $environment;

    private TransactionInfo  $transactionInfo;
    private RenewalInfo|null $renewalInfo;


    public static function parse($data): self
    {
        $instance                  = new self();
        $instance->bundleId        = $data->bundleId;
        $instance->bundleVersion   = $data->bundleVersion;
        $instance->environment     = $data->environment;
        $instance->transactionInfo = TransactionInfo::parse($data->signedTransactionInfo);
        $instance->renewalInfo     = isset($data->signedRenewalInfo) ? RenewalInfo::parse($data->signedRenewalInfo) : null;

        return $instance;
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
    public function getBundleVersion()
    {
        return $this->bundleVersion;
    }

    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return TransactionInfo
     */
    public function getTransactionInfo(): TransactionInfo
    {
        return $this->transactionInfo;
    }

    /**
     * @return RenewalInfo
     */
    public function getRenewalInfo(): RenewalInfo|null
    {
        return $this->renewalInfo;
    }

}
