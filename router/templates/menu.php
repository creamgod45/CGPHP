<?php
/**
 * @var CGArray $Config
 * @var Utils $Utils
 * @var Request $Request
 * @var ApplicationLayer $ApplicationLayer
 * @var FileStorage $storage
 * @var Cache $globalcache
 * @var UniqueVisiterID $uniqueVisiterID
 * @var \I18N\I18N $i18N
 * @var \modules\defaultModule $module
 * @var bool $routers
 */

use Auth\Member;
use Auth\UniqueVisiterID;
use Auth\UserStorage;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use Nette\Utils\Json;
use Server\ApplicationLayer;
use Server\Request;
use Type\Array\CGArray;
use Utils\Utils;

if (@!$routers) exit();

$us = new UserStorage($storage, $uniqueVisiterID->getKey());
?>

<script>
    function changeLanguage(el){
        let value = el.value;
        console.log(location);
        location.assign("<?= Utils::getInstanceAddress(true) ?>/<?= router(1) ?>/"+value);
    }
</script>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                CGPHP
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="javascript:void(0);" class="nav-link px-2 text-secondary">首頁</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <select class="form-select" aria-label="Default select example" onchange="changeLanguage(this);">
                    <option selected value="<?= $i18N->getLanguageCode()->name ?>"><?= $i18N->getLanguage(\I18N\ELanguageText::valueof($i18N->getLanguageCode()->name))?></option>
                    <?= $module::buildSelectLanguageBar($i18N)?>
                </select>
            </form>
        </div>
    </div>
</header>
