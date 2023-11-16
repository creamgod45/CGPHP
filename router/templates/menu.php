<?php
/**
* @var \Type\Array\CGArray $Config
* @var \Utils\Utils $Utils
* @var \Server\Request $Request
* @var \Server\ApplicationLayer $ApplicationLayer
* @var \Nette\Caching\Storages\FileStorage $storage
* @var \Nette\Caching\Cache $globalcache
* @var \Auth\UniqueVisiterID $uniqueVisiterID
 * @var bool $routers
 */
if (@!$routers) exit();
?>
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">關於</h4>
                    <p class="text-muted">這個框架請至Github觀看說明</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">聯絡</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://github.com/creamgod45/CGPHP" target="_blank" class="text-white">Follow on Github</a></li>
                        <li><a href="https://github.com/creamgod45/CGPHP" target="_blank" class="text-white">Fork on Github</a></li>
                        <li><a href="https://github.com/creamgod45/CGPHP" target="_blank" class="text-white">Star on Github</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <i class="fa-solid fa-fire"></i>&nbsp;
                <strong>CGPHP</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>