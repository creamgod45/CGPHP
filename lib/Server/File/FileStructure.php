<?php

namespace Server\File;

class FileStructure
{
    public string $name;
    public string $full_path;
    public string $type;
    public string $tmp_name;
    public int $error;
    public int $size;

    /**
     * @param string $name
     * @param string $full_path
     * @param string $type
     * @param string $tmp_name
     * @param int $error
     * @param int $size
     */
    public function __construct(string $name, string $full_path, string $type, string $tmp_name, int $error, int $size)
    {
        $this->name = $name;
        $this->full_path = $full_path;
        $this->type = $type;
        $this->tmp_name = $tmp_name;
        $this->error = $error;
        $this->size = $size;
    }

}
