<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\ArticleMicroservice\Sync;

class UpdatedRentsoft
{

    private string $localeClass;

    private string $localeId;

    private string $remoteAction;

    private string $remoteId;

    /**
     * @return string
     */
    public function getLocaleClass(): string
    {
        return $this->localeClass;
    }

    /**
     * @param string $localeClass
     */
    public function setLocaleClass(string $localeClass): void
    {
        $this->localeClass = $localeClass;
    }

    /**
     * @return string
     */
    public function getLocaleId(): string
    {
        return $this->localeId;
    }

    /**
     * @param string $localeId
     */
    public function setLocaleId(string $localeId): void
    {
        $this->localeId = $localeId;
    }

    /**
     * @return string
     */
    public function getRemoteAction(): string
    {
        return $this->remoteAction;
    }

    /**
     * @param string $remoteAction
     */
    public function setRemoteAction(string $remoteAction): void
    {
        $this->remoteAction = $remoteAction;
    }

    /**
     * @return string
     */
    public function getRemoteId(): string
    {
        return $this->remoteId;
    }

    /**
     * @param string $remoteId
     */
    public function setRemoteId(string $remoteId): void
    {
        $this->remoteId = $remoteId;
    }
}
