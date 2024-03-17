<?php

namespace Shop;

enum ShopNameField: string
{
    case ID = "ID";
    case ShopID = "ShopID";
    case name = "name";
    case enable = "enable";
    case opening = "opening";
    case address = "address";
    case phone = "phone";
    case turnover = "turnover";
    case creatAt = "creatAt";
    case updateAt = "updateAt";
}
