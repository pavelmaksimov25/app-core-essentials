<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppCore\Zed\Scheduler;

use AppCore\Shared\Scheduler\SchedulerConfig;
use Spryker\Zed\Scheduler\Communication\Plugin\Scheduler\PhpScheduleReaderPlugin;
use Spryker\Zed\Scheduler\SchedulerDependencyProvider as SprykerSchedulerDependencyProvider;
use Spryker\Zed\SchedulerJenkins\Communication\Plugin\Adapter\SchedulerJenkinsAdapterPlugin;

class SchedulerDependencyProvider extends SprykerSchedulerDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\SchedulerExtension\Dependency\Plugin\SchedulerAdapterPluginInterface>
     */
    protected function getSchedulerAdapterPlugins(): array
    {
        return [
            SchedulerConfig::SCHEDULER_JENKINS => new SchedulerJenkinsAdapterPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SchedulerExtension\Dependency\Plugin\ScheduleReaderPluginInterface>
     */
    protected function getScheduleReaderPlugins(): array
    {
        return [
            new PhpScheduleReaderPlugin(),
        ];
    }
}
