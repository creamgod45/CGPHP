<?php


namespace Utils;

use JetBrains\PhpStorm\Deprecated;

#[Deprecated(
    reason: '架構過於舊 API 存在安全漏洞',
    replacement: \Utils\APITOKENv2::class
)]
class APIToken
{

    public function EXPIRED(): void
    {
        $row = $this->utils->squery([
            'list',
            "SELECT * FROM `zfcr_api`",
            true,
        ]);

        foreach ($row as $i => $iValue) {
            if (time() < $iValue[5]) {
                $id = $iValue[0];
                $this->utils->squery([
                    'run',
                    "DELETE FROM `zfcr_api` WHERE `ID` = '$id'",
                    true,
                ]);
            }
        }
    }

    public function generateToken($UUID)
    {
        return password_hash($UUID, PASSWORD_DEFAULT);
    }

    public function verifyToken($UUID)
    {
        $result = $this->getTokenRequest($UUID);
        if (!$result) {
            $result = $this->addTokenRequest($UUID, $this->APIName, $this->APIINFO, $this->APIDATA);
            if ($result) {
                return $this->getTokenRequest($UUID);
            }
        }
        return password_verify($UUID);
    }

    public function getTokenRequest($UUID, $backend)
    {
        $t = time();
        $token = $this->utils->squery([
            'get',
            "SELECT `API_DATA` FROM `zfcr_api` WHERE `UUID` = '$UUID' AND `expired_time` >= '$t'",
        ])[0];

        if (!empty($token)) {
            return $token;
        }

        if (empty($backend)) {
            return ["CODE" => "204", "MESSAGES" => "NO TOKEN REQUEST"];
        }
        return false;
    }

    public function addTokenRequest($UUID, $APIName, $APIINFO, $APIDATA)
    {
        $t = time();
        $EXPIRED = time() + 60 * 60;
        return $this->utils->squery([
            'run',
            "INSERT INTO `zfcr_api`(`UUID`, `API_Name`, `API_INFO`, `API_DATA`, `expired_time`, `create_time`)
            VALUES ('$UUID','$APIName','$APIINFO','$APIDATA','$EXPIRED','$t')",
        ]);
    }

}
