<?php

namespace Rentsoft\ApiGatewayConnectorBundle\Entity\OnlineBookingMicroservice\Setting\BlockedDay;

use DateTime;

class BlockedDay
{

    protected DateTime $blockedDay;

    /**
     * @return DateTime
     */
    public function getBlockedDay(): DateTime
    {
        return $this->blockedDay;
    }

    /**
     * @param string $blockedDay
     */
    public function setBlockedDay(string $blockedDay): void
    {
        $this->blockedDay = new DateTime($blockedDay);
    }

}
