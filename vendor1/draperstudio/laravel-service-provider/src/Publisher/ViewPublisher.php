<?php

/*
 * This file is part of Laravel Service Provider.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\ServiceProvider\Publisher;

use InvalidArgumentException;

class ViewPublisher extends Publisher
{
    /**
     * Get the source views directory to publish.
     *
     * @param string $packagePath
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function getSource($packagePath)
    {
        $sources = [
            "{$packagePath}/resources/views",
            "{$packagePath}/views",
        ];

        foreach ($sources as $source) {
            if ($this->files->isDirectory($source)) {
                return [$source => $this->publishPath.'/'.$this->packageName];
            }
        }

        throw new InvalidArgumentException('Views not found.');
    }
}
