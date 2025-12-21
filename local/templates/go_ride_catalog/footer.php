<footer class="footer">
    <div class="container">
        <div class="footer__wrp">
            <nav>
                <ul class="footer__nav-list">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "menu_bottom_left", array(
                        "ROOT_MENU_TYPE" => "go_ride_bottom_left",
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "N"
                    ));?>
                </ul>
            </nav>
            <nav>
                <ul class="footer__nav-list">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "menu_bottom_right", array(
                        "ROOT_MENU_TYPE" => "go_ride_bottom_right",
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "N"
                    ));?>
                </ul>
            </nav>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:subscribe.form",
                "go_ride_subscribe",
                Array(
                )
            );?>
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

</body>

</html>

