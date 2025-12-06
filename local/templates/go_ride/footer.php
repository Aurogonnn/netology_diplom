<footer class="footer">
    <div class="container">
        <div class="footer__wrp">
            <nav>
                <ul class="footer__nav-list">
                    <li><a href="<?=SITE_DIR?>catalog/">каталог</a></li>
                    <li><a href="#">о магазине</a></li>
                    <li><a href="#">контакты</a></li>
                    <li><a href="#">доставка и оплата</a></li>
                </ul>
            </nav>
            <nav>
                <ul class="footer__nav-list">
                    <li><a href="#">карьера в нашем магазине</a></li>
                    <li><a href="#">как оформить возврат</a></li>
                    <li><a href="#">правила магазина</a></li>
                    <li><a href="#">соглашение о конфиденциальности</a></li>
                </ul>
            </nav>
            <div class="footer__form">
                <h2>подписаться на новости магазина go&ride</h2>
                <form action="#">
                    <div class="footer__form-wrp">
                        <label>
                            <input type="email" placeholder="Enter your Email adress" required>
                            <span class="visually-hidden">email</span>
                        </label>
                        <button>подписаться</button>
                    </div>
                    <span>Продолжая, вы соглашаетесь с нашей политикой конфиденциальности.</span>
                </form>
            </div>
        </div>
        <div class="footer__social-wrp">


            <?
            // Социальные сети
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/socnet_footer.php"
                )
            );?>

            <?
            //Копирайт
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/copyright.php"
                )
            );?>

        </div>
    </div>
</footer>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/slick.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/scripts.js"></script>
</body>

</html>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>