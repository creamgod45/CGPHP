<?php

namespace Server\CSRF;

enum CSRFNameField : string
{
    case ChatroomCSRF = "ChatroomCSRF";
    case ChatroomHCSRF = "ChatroomHCSRF";
    case LoginCSRF = "LoginCSRF";
}
