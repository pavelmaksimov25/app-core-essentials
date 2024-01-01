<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerProject\Zed\DataImport\Business\Model\Store;

use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class StoreWriterStep implements DataImportStepInterface
{
    public function execute(DataSetInterface $dataSet): void
    {
        /** @phpstan-var string $storeName */
        foreach ($dataSet as $storeName) {
            $storeEntity = SpyStoreQuery::create()
                ->filterByName($storeName)
                ->findOneOrCreate();

            $storeEntity->save();
        }
    }
}
