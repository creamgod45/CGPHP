<?php

namespace chatroom;

use Nette\Utils\DateTime;
use Type\Array\CGArray;

class ChatMessages
{
    private int $ID;
    private string $CID;
    private string $UID;
    private string $fileID;
    private string $text;
    private string $enable;
    private int $creatAt;
    private DateTime $updateAt;
    private bool $loaded = false;

    public function __construct($ID, $CID, $UID, $fileID, $text, $enable, $creatAt, $updateAt, $load = false)
    {
        $this->ID = $ID;
        $this->CID = $CID;
        $this->UID = $UID;
        $this->fileID = $fileID;
        $this->text = $text;
        $this->enable = $enable;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
        $this->setLoaded($load);
    }

    /**
     * @param bool $loaded
     */
    public function setLoaded(bool $loaded): void
    {
        $this->loaded = $loaded;
    }

    /**
     * @return string
     */
    public function getUID(): string
    {
        return $this->UID;
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
     * @return string
     */
    public function getFileID(): string
    {
        return $this->fileID;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function isEnable(): string
    {
        return $this->enable;
    }

    /**
     * @return int
     */
    public function getCreatAt(): int
    {
        return $this->creatAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): DateTime
    {
        return $this->updateAt;
    }

    public function edit($array)
    {
        ChatroomManager::editChatMessages($this->CID, $this->ID, $array);
    }

    public function update()
    {
        if ($this->isLoad()) {
            $chatMessages = ChatroomManager::getChatMessage($this->CID, $this->ID);
            if ($chatMessages !== null) {
                $this->setChatMessages($chatMessages);
            }
        }
    }

    public function isLoad(): bool
    {
        return $this->loaded;
    }

    public function setChatMessages(ChatMessages $c): void
    {
        $this->ID = $c->ID;
        $this->CID = $c->CID;
        $this->UID = $c->UID;
        $this->fileID = $c->fileID;
        $this->text = $c->text;
        $this->enable = $c->enable;
        $this->creatAt = $c->creatAt;
        $this->updateAt = $c->updateAt;
    }

    public function remove()
    {
        if ($this->isLoad()) {
            ChatroomManager::removeChatMessages($this->CID, $this->ID);
        }
    }

    public function toArray()
    {
        $CGArray = new CGArray();
        $CGArray->Set(ChatMessagesNameField::ID->value,$this->ID);
        $CGArray->Set(ChatMessagesNameField::CID->value,$this->CID);
        $CGArray->Set(ChatMessagesNameField::UID->value,$this->UID);
        $CGArray->Set(ChatMessagesNameField::fileID->value,$this->fileID);
        $CGArray->Set(ChatMessagesNameField::text->value,$this->text);
        $CGArray->Set(ChatMessagesNameField::enable->value,$this->enable);
        $CGArray->Set(ChatMessagesNameField::creatAt->value,$this->creatAt);
        $CGArray->Set(ChatMessagesNameField::updateAt->value,$this->updateAt);
        return $CGArray->toArray();
    }
}
