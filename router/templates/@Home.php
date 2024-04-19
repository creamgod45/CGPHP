<?php
/**
 * @var CGArray $Config
 * @var Utils $Utils
 * @var Request $Request
 * @var ApplicationLayer $ApplicationLayer
 * @var FileStorage $storage
 * @var Cache $globalcache
 * @var UniqueVisiterID $uniqueVisiterID
 * @var I18N $i18N
 * @var HomeModule $module
 * @var bool $routers
 */

use Auth\UniqueVisiterID;
use I18N\ELanguageText;
use I18N\I18N;
use modules\HomeModule;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use Server\ApplicationLayer;
use Server\Request;
use Type\Array\CGArray;
use Utils\Utils;

if (@!$routers) exit(); ?>
<div id="view-image-bg" style="display: none;"></div>
<div id="view-image" style="display: none;">
    <div class="card-img shadow-lg">
        <div class="btn-close" onclick="closeViewImages()"></div>
        <div class="card-body">
            <p class="card-text"></p>
        </div>
    </div>
</div>
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_1_Title) ?></h1>
                <p class="lead text-muted"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_2_Description) ?></p>
                <p>
                    <a href="https://github.com/creamgod45/CGPHP" target="_blank"
                       class="btn btn-primary my-2">Github</a>
                    <a href="javascript:void(0);" class="btn btn-secondary my-2"
                       onclick="alert('好的!!')"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_3_IWantToContinueToSee) ?></a>
                </p>
            </div>
        </div>
    </section>
    <?= rand_commit($Config); ?>
    <div class="album py-5 bg-light">
        <div class="container">
            <?= rand_commit($Config); ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-2">
                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top"  onclick="viewImages(this, '<?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_4) ?>')" src="<?= Utils::resources("images/img1.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_4) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" onclick="viewImages(this, '<?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_6) ?>')" src="<?= Utils::resources("images/img2.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_6) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <div class="btn-group">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" onclick="viewImages(this, '<?= $module::viewImagesInclude($i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_7HelloWorld), $i18N) ?>')" src="<?= Utils::resources("images/img3.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_7HelloWorld) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" onclick="viewImages(this, '<?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_8) ?>')" src="<?= Utils::resources("images/img4.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_8) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" onclick="viewImages(this, '<?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_9) ?>')" src="<?= Utils::resources("images/img5.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_9) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" onclick="viewImages(this, '<?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_10) ?>')" src="<?= Utils::resources("images/img6.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text">
                                <?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_10) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?= rand_commit($Config); ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" onclick="viewImages(this, '<?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_11) ?>')" src="<?= Utils::resources("images/img7.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text">
                                <?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_11) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img class="bd-placeholder-img card-img-top" onclick="viewImages(this, '<?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_12) ?>')" src="<?= Utils::resources("images/img8.png")?>" />
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text">
                                <?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_12) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_5_View) ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= rand_commit($Config); ?>
</main>

<?= rand_commit($Config); ?>
<footer class="text-muted py-5">
    <div class="container">
        <p class="float-end mb-1">
            <a href="#">Back to top</a>
        </p>
        <?= rand_commit($Config); ?>
        <p class="mb-1">&copy; Bootstrap</p>
        <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
                    href="/docs/5.1/getting-started/introduction/">getting started guide</a>.</p>
    </div>
</footer>
<?= rand_commit($Config); ?>
