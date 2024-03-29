<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace AppCore\Glue\Log;

use Spryker\Glue\Kernel\Container;
use Spryker\Glue\Log\LogDependencyProvider as SprykerLogDependencyProvider;
use Spryker\Glue\Log\Plugin\Handler\ExceptionStreamHandlerPlugin;
use Spryker\Glue\Log\Plugin\Handler\StreamHandlerPlugin;
use Spryker\Glue\Log\Plugin\Processor\EnvironmentProcessorPlugin;
use Spryker\Glue\Log\Plugin\Processor\GuzzleBodyProcessorPlugin;
use Spryker\Glue\Log\Plugin\Processor\PsrLogMessageProcessorPlugin;
use Spryker\Glue\Log\Plugin\Processor\RequestProcessorPlugin;
use Spryker\Glue\Log\Plugin\Processor\ResponseProcessorPlugin;
use Spryker\Glue\Log\Plugin\Processor\ServerProcessorPlugin;

class LogDependencyProvider extends SprykerLogDependencyProvider
{
    protected function addLogHandlers(Container $container): Container
    {
        $container->set(static::LOG_HANDLERS, static function (): array {
            return [
                new StreamHandlerPlugin(),
                new ExceptionStreamHandlerPlugin(),
            ];
        });

        return $container;
    }

    protected function addProcessors(Container $container): Container
    {
        $container->set(static::LOG_PROCESSORS, static function (): array {
            return [
                new PsrLogMessageProcessorPlugin(),
                new EnvironmentProcessorPlugin(),
                new ServerProcessorPlugin(),
                new RequestProcessorPlugin(),
                new ResponseProcessorPlugin(),
                new GuzzleBodyProcessorPlugin(),
            ];
        });

        return $container;
    }
}
