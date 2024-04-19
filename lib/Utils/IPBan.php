<?php

namespace Utils;
use Nette\Database\Connection;

class IPBan
{
    protected $Utils;
    private $db;

    public function __construct()
    {
        $this->Utils = new utils();
        $this->db = new Connection('mysql:host=127.0.0.1;dbname=vvrzmwkq_home', 'vvrzmwkq_home', 'KFw2)rA_p*6g');
    }

    /* visitorID
     *
     * public function isInVisitorID($visitorId): bool
    {
        $connection = $this->db;
        $r = $connection->fetch('SELECT * FROM `cgphp_ipban` WHERE `visitorId` = ?', $visitorId);
        return isset($r) && @$r !== null;
    }

    public function isExpiredVisitor($visitorId): bool
    {
        $connection = $this->db;
        $r = $connection->fetch('SELECT * FROM `cgphp_ipban` WHERE `visitorId` = ?', $visitorId);
        if (isset($r) && @$r !== null) {
            if ($r->expired > time()) {
                return true;
            }
        }
        return false;
    }

    public function canVisitPage2($visitorId): bool
    {
        if (@$_SESSION['LOCK']===true) {
            return false;
        }
        if ($this->isInVisitorID($visitorId) && $this->isExpiredVisitor($visitorId)) {
            return true;
        }
        if (!$this->isInVisitorID($visitorId)) {
            return true;
        }
        return false;
    }*/

    public function canVisitPage($IP): bool
    {
        if (@$_SESSION['LOCK'] === true) {
            return false;
        }
        if ($this->isExistIP($IP) && $this->isExpiredIP($IP)) {
            return true;
        }
        if (!$this->isExistIP($IP)) {
            return true;
        }
        return false;
    }

    public function isExistIP($IP): bool
    {
        $connection = $this->db;
        $r = $connection->fetch("SELECT `IP` FROM `cgphp_ipban` WHERE `IP` = ?", $IP);
        return isset($r) && @!empty($r->IP);
    }

    public function isExpiredIP($IP): bool
    {
        $IPd = $this->GetIP($IP);
        if (isset($IPd, $IPd->expired)) {
            return $IPd->expired < time();
        }
    }

    public function GetIP($IP)
    {
        $connection = $this->db;
        $r = $connection->fetch('SELECT * FROM `cgphp_ipban` WHERE `IP` = ?', $IP);
        if (isset($r) && @$r !== null) {
            return $r;
        }
    }

    public function GetIPs()
    {
        $connection = $this->db;
        return $connection->fetchAll('SELECT * FROM `cgphp_ipban`');
    }

    public function resettimes($IP)
    {
        $connection = $this->db;
        $connection->query('UPDATE `cgphp_ipban` SET', [
            'times' => 0,
            'expired' => time(),
            'ban' => false,
        ], 'WHERE IP = ?', $IP);
    }

    public function setlock($bool = null)
    {
        $_SESSION['LOCK'] = $bool;
    }

    public function AddIP($IP, $visitorId, $expire = null, $ban = null)
    {
        $connection = $this->db;
        if ($this->isExistIP($IP)) {
            $IPd = $this->GetIP($IP);
            if (isset($IPd) && @$IPd === null) {
                return false;
            }
            $connection->query('UPDATE `cgphp_ipban` SET', [
                'times' => $IPd->times + 1,
                'expired' => $this->Utils->default($expire, time() + 3600),
                'ban' => $this->Utils->default($ban, $IPd->ban),
                'visitorId' => $visitorId,
            ], 'WHERE IP = ?', $IP);
        } else {
            $connection->query('INSERT INTO `cgphp_ipban`', [
                'IP' => $IP,
                'times' => '1',
                'expired' => $this->Utils->default($expire, time() + 3600),
                'ban' => false,
                'visitorId' => $visitorId,
                'register_time' => time()
            ]);
        }
    }

    public function RemoveIP($IP): void
    {
        $connection = $this->db;
        $connection->query('DELETE FROM `cgphp_ipban` WHERE `IP` = ?', $IP);
    }
}