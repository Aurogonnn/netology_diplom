<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("GO&RIDE");
?>

<main>
    <section class="products">

        <div class="container">
            <h2>Популярные товары</h2>
            <div class="slider slick-good-slider">
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="product.html">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="#">Cycling Gloves, Adult</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="ride-us">
        <img src="<?=SITE_TEMPLATE_PATH?>/img/ride-with-us-bycicle.jpg" alt="ride-us-pic">
        <a href="#">по городу</a>
    </section>
    <section class="city-bike">
        <div class="container">
            <h2>Городские велосипеды</h2>
            <div class="slider slick-city-slider">
                <div class="slider__item">
                    <div class="city-bike__slide-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/city-bike.png" alt="city-bike">
                        <div class="city-bike__content">
                            <p>Предназначены для езды по дорогам с твердым покрытиям на не большие расстояния. Имеют гладкие покрышки, жесткую вилки, комфортную посадку. Как правило, сразу же оборудованы крыльями и багажником.</p>
                            <a href="#">в раздел</a>
                        </div>
                    </div>
                </div>
                <div class="slider__item">
                    <div class="city-bike__slide-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/city-bike.png" alt="city-bike">
                        <div class="city-bike__content">
                            <p>Это особенная модель городского велосипеда, на которую сейчас действуют скидки и акции</p>
                            <a href="#">подробнее</a>
                        </div>
                    </div>
                </div>

                <div class="slider__item">
                    <div class="city-bike__slide-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/city-bike.png" alt="city-bike">
                        <div class="city-bike__content">
                            <p>Дополнительные аксессуары для городских велосипедов. Все самое нужное и полезное. Без этих штучек ваша дорога будет скучна и безрадостно. Просто необходимо их приобрести</p>
                            <a href="#">срочно купить</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="sale">
        <div class="container sale__wrp">
            <h2>Скидка 5%</h2>
            <div class="sale__img-wrp">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/helmet.png" alt="helmet">
            </div>
        </div>
    </section>
    <section class="reviewed">
        <div class="container">
            <h2>Уже просмотрели</h2>
            <div class="slider slick-good-slider">
                <div class="slider__item">
                    <div class="slider__item-wrp">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/good-1.jpg" alt="good-1">
                        <div class="slider__item-content-wrp">
                            <h3><a href="product.html">Bottle cage</a></h3>
                            <p>95.00 р</p>
                            <p>Артикул</p>
                        </div>
                    </div>
                    <button>купить срочно</button>
                </div>
            </div>
        </div>
    </section>
</main>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>