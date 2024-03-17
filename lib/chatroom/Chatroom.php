<?php

namespace chatroom;

use JetBrains\PhpStorm\ArrayShape;
use Nette\Utils\DateTime;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Type\Array\CGArray;

class Chatroom
{
    private int $ID;
    private string $CID;
    /**
     * @var ChatroomMember[]
     */
    private array $members;
    private ChatroomStatus $status;
    private int $createAt;
    private DateTime $updateAt;
    private bool $loaded = false;

    public function isLoad(): bool
    {
        return $this->loaded;
    }

    /**
     * @param bool $loaded
     */
    public function setLoaded(bool $loaded): void
    {
        $this->loaded = $loaded;
    }

    /**
     * @param int $ID
     * @param string $CID
     * @param ChatroomMember[] $members
     * @param ChatroomStatus $status
     * @param int $createAt
     * @param DateTime $updateAt
     * @param bool $load
     */
    public function __construct(int $ID, string $CID, array $members, ChatroomStatus $status, int $createAt, $updateAt, $load=false)
    {
        $this->ID = $ID;
        $this->CID = $CID;
        $this->members = $members;
        $this->status = $status;
        $this->createAt = $createAt;
        if($updateAt!==null)
            $this->updateAt = $updateAt;
        self::setLoaded($load);
    }

    /**
     * @return int
     */
    public function getID(): int
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getCID(): string
    {
        return $this->CID;
    }

    /**
     * @return array
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @return false|string
     */
    public function getMemberstoJson(){
        if(empty($this->members)) return "";
        try {
            Json::encode($this->members, Json::ESCAPE_UNICODE);
        } catch (JsonException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * @return ChatroomStatus
     */
    public function getStatus(): ChatroomStatus
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getCreateAt(): int
    {
        return $this->createAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): DateTime
    {
        return $this->updateAt;
    }

    public function toArray(): array
    {
        $CGArray = new CGArray();
        $CGArray->Set(ChatroomNameField::ID->value, $this->ID);
        $CGArray->Set(ChatroomNameField::CID->value, $this->CID);
        $CGArray->Set(ChatroomNameField::members->value, $this->members);
        $CGArray->Set(ChatroomNameField::status->value, $this->status);
        $CGArray->Set(ChatroomNameField::createAt->value, $this->createAt);
        $CGArray->Set(ChatroomNameField::updateAt->value, $this->updateAt);
        return $CGArray->toArray();
    }

    public function setChatroom(Chatroom $c): void
    {
        $this->ID=$c->ID;
        $this->CID=$c->CID;
        $this->members=$c->members;
        $this->status=$c->status;
        $this->createAt=$c->createAt;
        $this->updateAt=$c->updateAt;
    }

    public function update(): void
    {
        if ($this->isLoad()) {
            $chatroom = ChatroomManager::getChatroom(ChatroomNameField::CID, $this->CID);
            $this->setChatroom($chatroom);
        }
    }

    /**
     * @param $array array
     * @return void
     */
    public function edit($array): void
    {
        if ($this->isLoad()) {
            ChatroomManager::editChatroom(ChatroomNameField::CID, $this->CID, $array);
        }
    }

    public function remove(): void
    {
        if ($this->isLoad()) {
            ChatroomManager::removeChatroom(ChatroomNameField::CID, $this->CID);
        }
    }

    public function addChatMessageClass(ChatMessages $c): bool
    {
        return ChatroomManager::addChatMessage($c);
    }
    public function getChatMessage($ChatMessages_ID): ?ChatMessages
    {
        return ChatroomManager::getChatMessage($this->CID, $ChatMessages_ID);
    }
    public function getChatMessages($enable = true,$limit=50): ?array
    {
        return ChatroomManager::getChatMessages($this->CID, $enable, $limit);
    }
    public function editChatMessages($ChatMessages_ID, $array): void
    {
        ChatroomManager::editChatMessages($this->CID, $ChatMessages_ID, $array);
    }
    public function removeChatMessages($ChatMessages_ID): void
    {
        ChatroomManager::removeChatMessages($this->CID, $ChatMessages_ID);
    }
    public function toggleChatMessages($ChatMessages_ID): void
    {
        ChatroomManager::toggleChatMessages($this->CID, $ChatMessages_ID);
    }
}
