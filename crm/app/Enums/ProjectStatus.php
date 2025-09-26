<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case OPEN = "open";
    case IN_PROGRESS = "inprogress";
    case BLOCKED = "blocked";

}
