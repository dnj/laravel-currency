<?php

namespace dnj\Currency\Contracts;

enum RoundingBehaviour: int
{
    case CEIL = 1;
    case ROUND = 2;
    case FLOOR = 3;
}
