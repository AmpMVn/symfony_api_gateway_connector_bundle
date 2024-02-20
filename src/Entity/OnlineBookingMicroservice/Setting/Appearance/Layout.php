<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\Appearance;

class Layout
{

    protected int $id;

    protected ?string $welcomeText = null;

    protected ?string $footerHtml = null;

    protected ?string $headerHtml = null;

    protected ?string $footerCredits = null;

    protected ?string $headerCredits = null;

    protected ?string $logo = null;

    protected ?string $contactText = null;

    protected ?string $htmlTitle = null;

    protected ?string $htmlDescription = null;

    protected ?string $favicon = null;

    protected ?string $css = null;

    protected ?string $javascript = null;

    protected ?string $gtmMeasurementId = null;

    protected ?string $gtmContainerId = null;

    protected int $tileView = 0;

    protected int $daysTillRentalStart = 0;

    protected ?string $dateOrDateTime = null;

    protected ?string $attributesHome = null;

    protected ?string $attributesDetail = null;

    protected ?string $linkAgb = null;

    protected ?string $linkPrivacy = null;

    protected bool $enableQuantitySelection = false;

    protected bool $enableSearch = false;

    protected bool $enableLocationModus = false;

    protected bool $enablePricecalculation = true;

    protected bool $enableShowNonAvailable = false;

    protected int $breadcrumpType = 0;

    protected bool $enableFilterCategory = false;

    protected bool $enableFilterTags = true;

    protected bool $enableSingleCheckout = false;

    protected bool $enableArticleSingleSelect = true;

    protected ?string $descriptionView = null;

    protected ?string $requestType = null;

    protected int $minRentalHours = 0;

    /**
     * @return bool
     */
    public function isEnableArticleSingleSelect(): bool
    {
        return $this->enableArticleSingleSelect;
    }

    /**
     * @param bool $enableArticleSingleSelect
     */
    public function setEnableArticleSingleSelect(bool $enableArticleSingleSelect): void
    {
        $this->enableArticleSingleSelect = $enableArticleSingleSelect;
    }

    /**
     * @return bool
     */
    public function isEnableSingleCheckout(): bool
    {
        return $this->enableSingleCheckout;
    }

    /**
     * @param bool $enableSingleCheckout
     */
    public function setEnableSingleCheckout(bool $enableSingleCheckout): void
    {
        $this->enableSingleCheckout = $enableSingleCheckout;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getWelcomeText(): ?string
    {
        return $this->welcomeText;
    }

    /**
     * @param string|null $welcomeText
     */
    public function setWelcomeText(?string $welcomeText): void
    {
        $this->welcomeText = $welcomeText;
    }

    /**
     * @return string|null
     */
    public function getFooterHtml(): ?string
    {
        return $this->footerHtml;
    }

    /**
     * @param string|null $footerHtml
     */
    public function setFooterHtml(?string $footerHtml): void
    {
        $this->footerHtml = $footerHtml;
    }

    /**
     * @return string|null
     */
    public function getHeaderHtml(): ?string
    {
        return $this->headerHtml;
    }

    /**
     * @param string|null $headerHtml
     */
    public function setHeaderHtml(?string $headerHtml): void
    {
        $this->headerHtml = $headerHtml;
    }

    /**
     * @return string|null
     */
    public function getFooterCredits(): ?string
    {
        return $this->footerCredits;
    }

    /**
     * @param string|null $footerCredits
     */
    public function setFooterCredits(?string $footerCredits): void
    {
        $this->footerCredits = $footerCredits;
    }

    /**
     * @return string|null
     */
    public function getHeaderCredits(): ?string
    {
        return $this->headerCredits;
    }

    /**
     * @param string|null $headerCredits
     */
    public function setHeaderCredits(?string $headerCredits): void
    {
        $this->headerCredits = $headerCredits;
    }

    /**
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string|null $logo
     */
    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return string|null
     */
    public function getContactText(): ?string
    {
        return $this->contactText;
    }

    /**
     * @param string|null $contactText
     */
    public function setContactText(?string $contactText): void
    {
        $this->contactText = $contactText;
    }

    /**
     * @return string|null
     */
    public function getHtmlTitle(): ?string
    {
        return $this->htmlTitle;
    }

    /**
     * @param string|null $htmlTitle
     */
    public function setHtmlTitle(?string $htmlTitle): void
    {
        $this->htmlTitle = $htmlTitle;
    }

    /**
     * @return string|null
     */
    public function getHtmlDescription(): ?string
    {
        return $this->htmlDescription;
    }

    /**
     * @param string|null $htmlDescription
     */
    public function setHtmlDescription(?string $htmlDescription): void
    {
        $this->htmlDescription = $htmlDescription;
    }

    /**
     * @return string|null
     */
    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    /**
     * @param string|null $favicon
     */
    public function setFavicon(?string $favicon): void
    {
        $this->favicon = $favicon;
    }

    /**
     * @return string|null
     */
    public function getCss(): ?string
    {
        return $this->css;
    }

    /**
     * @param string|null $css
     */
    public function setCss(?string $css): void
    {
        $this->css = $css;
    }

    /**
     * @return string|null
     */
    public function getGtmMeasurementId(): ?string
    {
        return $this->gtmMeasurementId;
    }

    /**
     * @param string|null $gtmMeasurementId
     */
    public function setGtmMeasurementId(?string $gtmMeasurementId): void
    {
        $this->gtmMeasurementId = $gtmMeasurementId;
    }

    /**
     * @return string|null
     */
    public function getGtmContainerId(): ?string
    {
        return $this->gtmContainerId;
    }

    /**
     * @param string|null $gtmContainerId
     */
    public function setGtmContainerId(?string $gtmContainerId): void
    {
        $this->gtmContainerId = $gtmContainerId;
    }

    /**
     * @return int
     */
    public function getTileView(): int
    {
        return $this->tileView;
    }

    /**
     * @param int $tileView
     */
    public function setTileView(int $tileView): void
    {
        $this->tileView = $tileView;
    }

    /**
     * @return int
     */
    public function getDaysTillRentalStart(): int
    {
        return $this->daysTillRentalStart;
    }

    /**
     * @param int $daysTillRentalStart
     */
    public function setDaysTillRentalStart(int $daysTillRentalStart): void
    {
        $this->daysTillRentalStart = $daysTillRentalStart;
    }

    /**
     * @return string|null
     */
    public function getDateOrDateTime(): ?string
    {
        return $this->dateOrDateTime;
    }

    /**
     * @param string|null $dateOrDateTime
     */
    public function setDateOrDateTime(?string $dateOrDateTime): void
    {
        $this->dateOrDateTime = $dateOrDateTime;
    }

    /**
     * @return string|null
     */
    public function getAttributesHome(): ?string
    {
        return $this->attributesHome;
    }

    /**
     * @param string|null $attributesHome
     */
    public function setAttributesHome(?string $attributesHome): void
    {
        $this->attributesHome = $attributesHome;
    }

    /**
     * @return string|null
     */
    public function getAttributesDetail(): ?string
    {
        return $this->attributesDetail;
    }

    /**
     * @param string|null $attributesDetail
     */
    public function setAttributesDetail(?string $attributesDetail): void
    {
        $this->attributesDetail = $attributesDetail;
    }

    /**
     * @return string|null
     */
    public function getLinkAgb(): ?string
    {
        return $this->linkAgb;
    }

    /**
     * @param string|null $linkAgb
     */
    public function setLinkAgb(?string $linkAgb): void
    {
        $this->linkAgb = $linkAgb;
    }

    /**
     * @return string|null
     */
    public function getLinkPrivacy(): ?string
    {
        return $this->linkPrivacy;
    }

    /**
     * @param string|null $linkPrivacy
     */
    public function setLinkPrivacy(?string $linkPrivacy): void
    {
        $this->linkPrivacy = $linkPrivacy;
    }

    /**
     * @return bool
     */
    public function isEnableQuantitySelection(): bool
    {
        return $this->enableQuantitySelection;
    }

    /**
     * @param bool $enableQuantitySelection
     */
    public function setEnableQuantitySelection(bool $enableQuantitySelection): void
    {
        $this->enableQuantitySelection = $enableQuantitySelection;
    }

    /**
     * @return bool
     */
    public function isEnableSearch(): bool
    {
        return $this->enableSearch;
    }

    /**
     * @param bool $enableSearch
     */
    public function setEnableSearch(bool $enableSearch): void
    {
        $this->enableSearch = $enableSearch;
    }

    /**
     * @return bool
     */
    public function isEnableLocationModus(): bool
    {
        return $this->enableLocationModus;
    }

    /**
     * @param bool $enableLocationModus
     */
    public function setEnableLocationModus(bool $enableLocationModus): void
    {
        $this->enableLocationModus = $enableLocationModus;
    }

    /**
     * @return bool
     */
    public function isEnablePricecalculation(): bool
    {
        return $this->enablePricecalculation;
    }

    /**
     * @param bool $enablePricecalculation
     */
    public function setEnablePricecalculation(bool $enablePricecalculation): void
    {
        $this->enablePricecalculation = $enablePricecalculation;
    }

    /**
     * @return int
     */
    public function getBreadcrumpType(): int
    {
        return $this->breadcrumpType;
    }

    /**
     * @param int $breadcrumpType
     */
    public function setBreadcrumpType(int $breadcrumpType): void
    {
        $this->breadcrumpType = $breadcrumpType;
    }

    /**
     * @return bool
     */
    public function isEnableFilterCategory(): bool
    {
        return $this->enableFilterCategory;
    }

    /**
     * @param bool $enableFilterCategory
     */
    public function setEnableFilterCategory(bool $enableFilterCategory): void
    {
        $this->enableFilterCategory = $enableFilterCategory;
    }

    /**
     * @return bool
     */
    public function isEnableFilterTags(): bool
    {
        return $this->enableFilterTags;
    }

    /**
     * @param bool $enableFilterTags
     */
    public function setEnableFilterTags(bool $enableFilterTags): void
    {
        $this->enableFilterTags = $enableFilterTags;
    }

    /**
     * @return string|null
     */
    public function getDescriptionView(): ?string
    {
        return $this->descriptionView;
    }

    /**
     * @param string|null $descriptionView
     */
    public function setDescriptionView(?string $descriptionView): void
    {
        $this->descriptionView = $descriptionView;
    }

    /**
     * @return string|null
     */
    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    /**
     * @param string|null $requestType
     */
    public function setRequestType(?string $requestType): void
    {
        $this->requestType = $requestType;
    }

    /**
     * @return int
     */
    public function getMinRentalHours(): int
    {
        return $this->minRentalHours;
    }

    /**
     * @param int $minRentalHours
     */
    public function setMinRentalHours(int $minRentalHours): void
    {
        $this->minRentalHours = $minRentalHours;
    }

    /**
     * @return bool
     */
    public function isEnableShowNonAvailable(): bool
    {
        return $this->enableShowNonAvailable;
    }

    /**
     * @param bool $enableShowNonAvailable
     */
    public function setEnableShowNonAvailable(bool $enableShowNonAvailable): void
    {
        $this->enableShowNonAvailable = $enableShowNonAvailable;
    }

    /**
     * @return string|null
     */
    public function getJavascript() : ?string
    {
        return $this->javascript;
    }

    /**
     * @param string|null $javascript
     */
    public function setJavascript(?string $javascript) : void
    {
        $this->javascript = $javascript;
    }


}
