<?php

namespace Utils;

date_default_timezone_set("Asia/Taipei");

if (f1(true, true)[0] === "https://") {
    include_once "/home/vulsdril/chat.zeitfrei.tw/PATH.php";
} else {
    include_once "C:/xampp/htdocs/PATH.php";
}

require_once "utils.php";

class sqllite
{
    public SQLite3 $SQLLite;
    private $SQL;

    public function __construct($filename)
    {
        if (!file_exists(PATH . '/database') && !mkdir(PATH . '/database') && !is_dir(PATH . '/database')) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', 'database'));
        }
        $this->SQLLite = new SQLite3($filename);
    }

    public function execommand(): void
    {
        $this->SQLLite->exec($this->getsql());
    }

    public function getsql()
    {
        return $this->SQL;
    }

    public function setsql($sql): bool
    {
        $this->SQL = $sql . ";";
        return true;
    }

    public function fetchArray($object_bool = true): array
    {
        $result = $this->SQLLite->query($this->getsql());
        $k = 0;
        $object = [];
        if ($object_bool) {
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $object[$k++] = $row;
            }
        }
        return $object;
    }

    public function __destruct()
    {
        $this->SQLLite->close();
    }
}
