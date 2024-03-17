<?php

namespace chatroom;

enum ChatroomStatus: string
{
    case lock = "lock";
    case unlock = "unlock";
    case transcript = "transcript";
}
