<?php


namespace Laurel\CMS\Contracts;


/**
 * Module contract for load routes.
 *
 * Interface MustHaveRoutes
 * @package Laurel\CMS\Contracts
 */
interface MustHaveRoutes
{
    /**
     * Registers module routes.
     *
     * @param string $group
     * @return void
     */
    public function routes(string $group) : void;

    /**
     * Registers additional routes.
     *
     * @param string $group
     * @return void
     */
    public function additionalRoutes(string $group) : void;
}
