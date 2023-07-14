<?php

namespace App\Http\Enums;

enum TopicTypeEnum: int
{
    case NORMAL = 1;

    case BRICKFILM = 2;

    case QUESTION = 3;

    case ANNOUNCEMENT = 4;
}
