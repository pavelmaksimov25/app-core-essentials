<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppCore\Zed\DataImport\Business\Model\Locale;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use AppCore\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class LocaleNameToIdLocaleStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const KEY_SOURCE = 'localeName';

    /**
     * @var string
     */
    public const KEY_TARGET = 'idLocale';

    /**
     * @var array<string, int>
     */
    protected array $resolved = [];

    public function __construct(protected string $source = self::KEY_SOURCE, protected string $target = self::KEY_TARGET)
    {
    }

    /**
     * @throws \Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException
     */
    public function execute(DataSetInterface $dataSet): void
    {
        if (!isset($dataSet[$this->source])) {
            throw new DataKeyNotFoundInDataSetException(sprintf(
                'Expected a key "%s" in current data set. Available keys: "%s"',
                $this->source,
                implode(', ', array_keys($dataSet->getArrayCopy())),
            ));
        }

        /** @var string $localeName */
        $localeName = $dataSet[$this->source];
        if (!isset($this->resolved[$localeName])) {
            $this->resolved[$localeName] = $this->resolveIdLocale($localeName);
        }

        $dataSet[$this->target] = $this->resolved[$localeName];
    }

    /**
     * @throws \AppCore\Zed\DataImport\Business\Exception\EntityNotFoundException
     */
    protected function resolveIdLocale(string $localeName): int
    {
        $spyLocaleQuery = SpyLocaleQuery::create();
        $spyLocale = $spyLocaleQuery->filterByLocaleName($localeName)->findOne();

        if ($spyLocale === null) {
            throw new EntityNotFoundException(sprintf('Locale by name "%s" not found.', $localeName));
        }

        $spyLocale->save();

        return $spyLocale->getIdLocale();
    }
}
