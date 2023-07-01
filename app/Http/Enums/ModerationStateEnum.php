<?php

namespace App\Http\Enums;

enum ModerationStateEnum: int
{
    case PENDING = 2;

    case APPROVED = 1;

    case BLOCKED = 3;
}
