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
 * @var bool $routers
 */

use Auth\UniqueVisiterID;
use I18N\ELanguageText;
use I18N\I18N;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use Server\ApplicationLayer;
use Server\Request;
use Type\Array\CGArray;
use Utils\Utils;

if (@!$routers) exit(); ?>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
                        <?= rand_commit($Config); ?>
                        <div class="card-body">
                            <p class="card-text"><?= $i18N->getLanguage(ELanguageText::RouterTemplatesHomePage_7) ?></p>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
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
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
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
        <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
                    href="/docs/5.1/getting-started/introduction/">getting started guide</a>.</p>
    </div>
</footer>
<?= rand_commit($Config); ?>
