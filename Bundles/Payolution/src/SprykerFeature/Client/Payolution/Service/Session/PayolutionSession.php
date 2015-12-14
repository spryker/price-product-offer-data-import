<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Client\Payolution\Service\Session;

use Generated\Shared\Transfer\PayolutionCalculationResponseTransfer;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PayolutionSession implements PayolutionSessionInterface
{

    const PAYOLUTION_SESSION_IDENTIFIER = 'payolution session identifier';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param PayolutionCalculationResponseTransfer $payolutionCalculationResponseTransfer
     *
     * @return self
     */
    public function setInstallmentPayments(PayolutionCalculationResponseTransfer $payolutionCalculationResponseTransfer)
    {
        $this->session->set(self::PAYOLUTION_SESSION_IDENTIFIER, $payolutionCalculationResponseTransfer);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasInstallmentPayments()
    {
        return $this->session->has(self::PAYOLUTION_SESSION_IDENTIFIER);
    }

    /**
     * @return PayolutionCalculationResponseTransfer
     */
    public function getInstallmentPayments()
    {
        $payolutionCalculationResponseTransfer = new PayolutionCalculationResponseTransfer();

        if ($this->hasInstallmentPayments()) {
            return $this->session->get(self::PAYOLUTION_SESSION_IDENTIFIER, $payolutionCalculationResponseTransfer);
        }

        return $payolutionCalculationResponseTransfer;
    }

    /**
     * @return mixed
     */
    public function removeInstallmentPayments()
    {
        if ($this->session->has(self::PAYOLUTION_SESSION_IDENTIFIER)) {
            return $this->session->remove(self::PAYOLUTION_SESSION_IDENTIFIER);
        }
    }

}
