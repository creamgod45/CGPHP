<?php

namespace Auth;

enum MemberNameField :string
{
    case ID  = "id";
    case UID = "uid";
    case type = "type";
    case phone = "phone";
    case password = "password";
    case email = "email";
    case administrator = "administrator";
    case enable = "enable";
    case createAt = "createAt";
    case updateAt = "updateAt";
    case Permissions = "Permissions";
}
