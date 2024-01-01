<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerProject\Zed\Payment\Business\MessageBroker;

use Generated\Shared\Transfer\PaymentCancelReservationRequestedTransfer;

interface PaymentCancelReservationRequestedMessageHandlerInterface
{
    public function handlePaymentCancelReservationRequested(PaymentCancelReservationRequestedTransfer $paymentCancelReservationRequestedTransfer): void;
}