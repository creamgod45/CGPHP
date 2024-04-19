<?php

namespace chatroom;

enum ChatroomNameField :string
{
    case ID = "ID";
    case CID = "CID";
    case members = "members";
    case status = "status";
    case createAt = "createAt";
    case updateAt = "updateAt";
}
