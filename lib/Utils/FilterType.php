<?php

namespace Utils;

enum FilterType :int
{
    case Integer = 0;
    case Token = 1;
    case UUID = 2;
    case Email = 3;
    case EnglishNumberSpecialChat1to20 = 4;
    case Username = 5;
    case Nickname = 6;
    case Password = 7;
    case DiscordID = 8;
    case URL = 9;
    case Avatar = 10;
    case IP = 11;
    case BooleanString = 12;
}
