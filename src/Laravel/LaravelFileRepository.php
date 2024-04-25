<?php

namespace  Packages\MakePackager\Laravel;

use  Packages\MakePackager\FileRepository;

class LaravelFileRepository extends FileRepository
{
    /**
     * {@inheritdoc}
     */
    protected function createModule(...$args)
    {
        return new Module(...$args);
    }
}
