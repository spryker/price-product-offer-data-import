<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Messenger;

/**
 * @method \Spryker\Client\Messenger\MessengerFactory getFactory()
 */
interface MessengerClientInterface
{
    /**
     * Specification:
     *  - Writes success message to flash bag.
     *
     * @api
     *
     * @param string $message
     *
     * @return void
     */
    public function addSuccessMessage($message);

    /**
     * Specification:
     *  - Writes informational message to flash bag.
     *
     * @api
     *
     * @param string $message
     *
     * @return void
     */
    public function addInfoMessage($message);

    /**
     * Specification:
     *  - Writes error message to flash bag.
     *
     * @api
     *
     * @param string $message
     *
     * @return void
     */
    public function addErrorMessage($message);

    /**
     * Specification:
     *  - Get messages from zed request and put them to session in next order:
     *  - Writes error message to flash bag.
     *  - Writes success message to flash bag.
     *  - Writes informational message to flash bag.
     *
     * @api
     *
     * @return void
     */
    public function processFlashMessagesFromLastZedRequest(): void;
}
