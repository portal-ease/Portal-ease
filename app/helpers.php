<?php

use App\Context\CurrentPortal;
use App\Models\Portal;

function currentPortal(CurrentPortal $portal): Portal
{
    return $portal->get();
}
