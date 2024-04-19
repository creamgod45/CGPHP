<?php

namespace I18N;

interface II18N
{
    public function getLanguageTextList();
    public function setLanguageTextList(array $languageTextList);
    public function setLanguage(ELanguageText $elanguageText, string $value);
    public function getLanguage(ELanguageText $elanguageText);

}
