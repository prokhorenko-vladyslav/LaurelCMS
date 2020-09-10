<?php


namespace Laurel\CMS\Contracts;


use PHPUnit\Framework\Constraint\Callback;

interface BladeExtensionContract
{
    public function getDirectiveName() : string;
    public function getDirectiveExpression() : string;
    public function isCondition() : bool;
}
