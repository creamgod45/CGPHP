<?php

namespace chatroom;

enum ChatMessagesNameField :string
{
    case ID = "ID";
    case CID = "CID";
    case UID="UID";
    case fileID = "fileID";
    case text = "text";
    case enable = "enable";
    case creatAt = "creatAt";
    case updateAt = "updateAt";
}
