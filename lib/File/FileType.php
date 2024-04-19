<?php

namespace File;

enum FileType: string
{
    case Image = "Image";
    case File = "File";
    case Sound = "Sound";
    case Video = "Video";
    case Other = "Other";
}
