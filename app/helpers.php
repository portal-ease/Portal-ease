<?php

use App\Context\CurrentPortal;
use App\Models\Portal;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @throws ContainerExceptionInterface
 * @throws NotFoundExceptionInterface
 */
function currentPortal(): Portal
{
    return app(CurrentPortal::class)->get();
}
