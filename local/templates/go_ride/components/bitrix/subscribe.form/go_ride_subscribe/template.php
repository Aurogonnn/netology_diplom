<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CMain $APPLICATION */
/** @var CUser $USER */
/** @var CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="footer__form" id="subscribe-form">
    <h2>подписаться на новости магазина go&ride</h2>
    <?php
    $frame = $this->createFrame('subscribe-form', false)->begin();
    ?>
    <form action="<?=$arResult['FORM_ACTION']?>">
        <div class="footer__form-wrp">
            <label>
                <input type="email" name="sf_EMAIL" placeholder="Enter your Email adress" required
                       value="<?=$arResult['EMAIL']?>" title="<?=GetMessage('subscr_form_email_title')?>">
                <span class="visually-hidden">email</span>
            </label>
            <button type="submit" name="OK">подписаться</button>
        </div>

        <?php if (!empty($arResult['RUBRICS'])): ?>
            <div style="display: none;"> <!-- Скрываем рубрики, если они не нужны в дизайне -->
                <?php foreach ($arResult['RUBRICS'] as $itemValue): ?>
                    <label for="sf_RUB_ID_<?=$itemValue['ID']?>">
                        <input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue['ID']?>"
                               value="<?=$itemValue['ID']?>" <?=($itemValue['CHECKED']) ? 'checked' : ''?> />
                        <?=$itemValue['NAME']?>
                    </label><br />
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <span>Продолжая, вы соглашаетесь с нашей политикой конфиденциальности.</span>
    </form>
    <?php
    $frame->beginStub();
    ?>
    <form action="<?=$arResult['FORM_ACTION']?>">
        <div class="footer__form-wrp">
            <label>
                <input type="email" name="sf_EMAIL" placeholder="Enter your Email adress" required
                       value="" title="<?=GetMessage('subscr_form_email_title')?>">
                <span class="visually-hidden">email</span>
            </label>
            <button type="submit" name="OK">подписаться</button>
        </div>

        <?php if (!empty($arResult['RUBRICS'])): ?>
            <div style="display: none;">
                <?php foreach ($arResult['RUBRICS'] as $itemValue): ?>
                    <label for="sf_RUB_ID_<?=$itemValue['ID']?>">
                        <input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue['ID']?>"
                               value="<?=$itemValue['ID']?>" />
                        <?=$itemValue['NAME']?>
                    </label><br />
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <span>Продолжая, вы соглашаетесь с нашей политикой конфиденциальности.</span>
    </form>
    <?php
    $frame->end();
    ?>
</div>