<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppCore\Zed\DataImport\Business\Model\Locale\Repository;

interface LocaleRepositoryInterface
{
    public function getIdLocaleByLocale(string $locale): int;
}
