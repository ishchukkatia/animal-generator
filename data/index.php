<?php

require 'vendor/autoload.php';

$controller = new \App\Controllers\AnimalGeneratorController();
$validator = new \App\Services\AnimalValidator();
$animalModel = new \App\Models\AnimalModel();

try {
    $animals = $animalModel->getAnimals();

    if (isset($_GET['generate']) && $_GET['generate'] === 'true') {
        $validator->validate($_GET['first_parent']);
        $validator->validate($_GET['second_parent']);
        $baby = $controller->generate($_GET['first_parent'], $_GET['second_parent']);
        $animalModel->saveAnimal($baby);
    }
} catch (\Exception $e) {
    $error = $e->getMessage();
}

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>Animal Generator</title>
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta charset="utf-8">
    <link rel="icon" href="Src/Images/Partials/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
          href="//fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:300,300italic,400,600,700,900">
    <link rel="stylesheet" href="Src/css/style.css">
    <script src="Src/js/html5shiv.min.js"></script>
    <style>
        .bg-color {
            background: #ededed;
        }

        h6 {
            color: #983a42;
        }


    </style>
</head>
<body>
<div class="page text-center">
    <header class="page-head" >
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                 data-sm-device-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
                 data-md-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-static"
                 data-lg-device-layout="rd-navbar-static" data-sm-stick-up-offset="50px" data-lg-stick-up-offset="90px">
                <div class="rd-navbar-inner">
                    <a class="brand-name">
                        <h1 class="range text-sm-left text-gray">
                            Animal Generator
                        </h1>
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <main class="page-content">
        <section>
            <div class="shell shell-wide">
                <div class="range text-sm-left">
                    <div class="cell-xl-10 cell-md-9">
                        <div class="jumbotron"
                             style="background: url('Src/Images/Partials/index-01.jpg') center; background-size: cover;">
                            <h1>Welcome! <span class="text-gray"> Here you can generate</span><span
                                        class="reveal-xs-block"> <span class="text-middle"> the animal </span><span
                                            class="text-middle text-gray"> of your dreams)</span></span></h1><a
                                    class="link link-white" href="#"></a>
                        </div>
                    </div>
                    <div class="cell-md-3 cell-xl-2 cell-xs-middle offset-top-40 offset-md-top-0">
                        <div class="range">
                            <div class="cell-md-12 cell-sm-4">
                                <div class="inset-xl-left-40">
                                    <h4>contacts</h4>
                                    <div class="offset-top-20 offset-md-top-40"><span
                                                class="text-middle icon icon-xs text-primary inset-right-10 material-icons-phonelink_ring"></span><a
                                                class="extra-big" href="tel:#">+380963923145</a></div>
                                    <div class="offset-top-10"><span
                                                class="text-middle icon icon-xs text-primary inset-right-10 material-icons-email"></span><a
                                                class="big" href="mailto:#">ishchuk.katia2000@gmail.com</a></div>
                                </div>
                            </div>
                            <div class="cell-md-12 cell-sm-4 offset-top-40 offset-sm-top-0 offset-md-top-80">
                                <div class="inset-xl-left-40">
                                    <h4>location</h4>
                                    <div class="offset-top-20 offset-md-top-40">
                                        <h5 class="text-sbold text-graydark">
                                            Ukraine, Vinnytsia
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr class="veil-md offset-top-40">
        <section>
            <div class="shell shell-wide">
                <br>
                <br>
                <hr class="divider">
                <form method="GET">
                    <div class="range">
                        <div class="cell-xl-6 cell-sm-6">
                            <fieldset>
                                <legend><h4>First Parent</h4></legend>
                                <div class="mb-3">

                                    <select class="custom-select " id="first-parent-animal" name="first_parent[animal]">
                                        <option value="" <?php if (empty($_GET['first_parent']['animal'])) {
                                            echo ' selected ';
                                        } ?>>Choose animal
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::ANIMALS as $animal) {
                                            echo "<option value='{$animal}' " . (!empty($_GET['first_parent']['animal']) && $_GET['first_parent']['animal'] === $animal ? ' selected ' : null) . ">{$animal}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['first_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?>id="first-parent-sex" name="first_parent[sex]" class="custom-select">
                                        <option value=""<?php if (empty($_GET['first_parent']['sex'])) {
                                            echo 'selected';
                                        } ?>>Choose sex
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['first_parent']['animal']]['sex'] as $sex) {
                                            echo "<option value='{$sex}' " . (!empty($_GET['first_parent']['sex']) && $_GET['first_parent']['sex'] === $sex ? ' selected ' : null) . ">{$sex}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['first_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="first-parent-size" name="first_parent[size]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['first_parent']['size'])) {
                                            echo 'selected';
                                        } ?>>Choose size
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['first_parent']['animal']]['size'] as $size) {
                                            echo "<option value='{$size}' " . (!empty($_GET['first_parent']['size']) && $_GET['first_parent']['size'] === $size ? ' selected ' : null) . ">{$size}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['first_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="first-parent-color" name="first_parent[color]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['first_parent']['color'])) {
                                            echo 'selected';
                                        } ?>>Choose color
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['first_parent']['animal']]['color'] as $color) {
                                            echo "<option value='{$color}' " . (!empty($_GET['first_parent']['color']) && $_GET['first_parent']['color'] === $color ? ' selected ' : null) . ">{$color}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['first_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="first-parent-type" name="first_parent[type]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['first_parent']['type'])) {
                                            echo 'selected';
                                        } ?>>Choose type
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['first_parent']['animal']]['type'] as $type) {
                                            echo "<option value='{$type}' " . (!empty($_GET['first_parent']['type']) && $_GET['first_parent']['type'] === $type ? ' selected ' : null) . ">{$type}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['first_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="first-parent-place" name="first_parent[place]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['first_parent']['place'])) {
                                            echo 'selected';
                                        } ?>>Choose place
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['first_parent']['animal']]['place'] as $place) {
                                            echo "<option value='{$place}' " . (!empty($_GET['first_parent']['place']) && $_GET['first_parent']['place'] === $place ? ' selected ' : null) . ">{$place}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="cell-xl-6 cell-sm-6">
                            <fieldset>
                                <legend><h4>Second Parent</h4></legend>

                                <div class="mb-3">

                                    <select id="second-parent-animal" name="second_parent[animal]"
                                            class="custom-select">
                                        <option value="" <?php if (empty($_GET['second_parent']['animal'])) {
                                            echo ' selected ';
                                        } ?>> Choose animal
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::ANIMALS as $animal) {
                                            echo "<option value='{$animal}' " . (!empty($_GET['second_parent']['animal']) && $_GET['second_parent']['animal'] === $animal ? ' selected ' : null) . ">{$animal}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['second_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="second-parent-sex" name="second_parent[sex]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['second_parent']['sex'])) {
                                            echo 'selected';
                                        } ?>>Choose size
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['second_parent']['animal']]['sex'] as $sex) {
                                            echo "<option value='{$sex}' " . (!empty($_GET['second_parent']['sex']) && $_GET['second_parent']['sex'] === $sex ? ' selected ' : null) . ">{$sex}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['second_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="second-parent-size" name="second_parent[size]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['second_parent']['size'])) {
                                            echo 'selected';
                                        } ?>>Choose size
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['second_parent']['animal']]['size'] as $size) {
                                            echo "<option value='{$size}' " . (!empty($_GET['second_parent']['size']) && $_GET['second_parent']['size'] === $size ? ' selected ' : null) . ">{$size}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['second_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="second-parent-color" name="second_parent[color]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['second_parent']['color'])) {
                                            echo 'selected';
                                        } ?>>Choose color
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['second_parent']['animal']]['color'] as $color) {
                                            echo "<option value='{$color}' " . (!empty($_GET['second_parent']['color']) && $_GET['second_parent']['color'] === $color ? ' selected ' : null) . ">{$color}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['second_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="second-parent-type" name="second_parent[type]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['second_parent']['type'])) {
                                            echo 'selected';
                                        } ?>>Choose type
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['second_parent']['animal']]['type'] as $type) {
                                            echo "<option value='{$type}' " . (!empty($_GET['second_parent']['type']) && $_GET['second_parent']['type'] === $type ? ' selected ' : null) . ">{$type}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">

                                    <select <?php if (empty($_GET['second_parent']['animal'])) {
                                        echo ' disabled ';
                                    } ?> id="second-parent-place" name="second_parent[place]" class="custom-select">
                                        <option value="" <?php if (empty($_GET['second_parent']['place'])) {
                                            echo 'selected';
                                        } ?>>Choose place
                                        </option>
                                        <?php
                                        foreach (\App\Configs\AnimalConfig::CHARACTERISTICS[$_GET['second_parent']['animal']]['place'] as $place) {
                                            echo "<option value='{$place}' " . (!empty($_GET['second_parent']['place']) && $_GET['second_parent']['place'] === $place ? ' selected ' : null) . ">{$place}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <?php
                    if (empty($_GET['first_parent']['animal']) || empty($_GET['second_parent']['animal'])) {
                        echo '<button type="submit" class="offset-top-20 offset-lg-top-70 btn btn-default shell-wide " name="continue" value="true" >Continue</button>';
                    } else {
                        echo '<button type="submit" class="offset-top-20 offset-lg-top-70 btn btn-default shell-wide " name="generate" value="true" >Generate</button>';
                    } ?>

                    <br><br>
                </form>
                <?php if (isset($error)) {
                    echo "<div class='container '><span class='badge fs-4 error' style='width:700px; height: 60px' >{$error}</span> </div> ";
                }

                ?>
            </div>
        </section>
        <section>

            <div class="range">
                <div class="cell-xl-12 cell-sm-12">

                    <?php if (isset($baby)) {
                        echo '
                    <fieldset>
                        <div class="shell shell-wide section-lg-bottom-148 bg-color "><br>
                    <hr class="divider offset-lg-top-80">
                    <h4>New animal</h4>
                            <div class="range range-sm-center text-left offset-top-60 offset-lg-top-80 ">
                            
                                <div class="cell-sm-6 cell-md-8 ">
                                
                                <div class="text-center section-bottom-34">
                                   
                                </div>
                                    <dl>
                                        <div class="range">
                                            <dt class="cell-xl-6 cell-sm-6 inset-left-40"><h6>Name</h6></dt>
                                            <dd class="cell-xl-6 cell-sm-6 ">' . ucfirst($baby->getName()) . '</dd>
                                        </div>
                                    </dl>
                                    <dl>
                                        <div class="range">
                                            <dt class="cell-xl-6 cell-sm-6 inset-left-40 "><h6>Sex </h6></dt>
                                            <dd class="cell-xl-6 cell-sm-4 ">' . $baby->getSex() . '</dd>
                                        </div>
                                    </dl>
                                    <dl>
                                        <div class="range">
                                            <dt class="cell-xl-6 cell-sm-6 inset-left-40 "><h6>Type</h6></dt>
                                            <dd class="cell-xl-6 cell-sm-6 ">' . $baby->getType() . '</dd>
                                      
                                        </div>
                                    </dl>
                                    <dl>
                                        <div class="range">
                                            <dt class="cell-xl-6 cell-sm-6 inset-left-40 "><h6>Size</h6></dt>
                                            <dd class="cell-xl-6 cell-sm-6 ">' . $baby->getSize() . ' </dd>
                                        </div>
                                    </dl>
                                    <dl>
                                        <div class="range">
                                            <dt class="cell-xl-6 cell-sm-6 inset-left-40 "><h6>Color</h6></dt>
                                            <dd class="cell-xl-6 cell-sm-6 ">' . $baby->getColor() . '</dd>
                                        </div>
                                    </dl>
                                    <dl>
                                        <div class="range">
                                            <dt class="cell-xl-6 cell-sm-6 inset-left-40"><h6>Place</h6></dt>
                                            <dd class="cell-xl-6 cell-sm-6 ">' . $baby->getPlace() . '</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div class="cell-xl-4 cell-sm-4 inset-left-0 ">
                                    <img src="' . $baby->getBabyImage() . '" class="img-responsive" width="400">
                                </div>
                            </div>
                        </div>
                    </fieldset> ';
                    }
                    ?>

                </div>
            </div>
</div>
</section>
<hr class="veil-md offset-top-40">
<section class="section-80 section-md-250" data-title="dogs for sale">
    <div class="shell shell-wide">

        <hr class="divider">
        <h4 class="section-bottom-34 text-center">Last animals</h4>
        <br>
        <div class="owl-carousel owl-dots" data-dots="true" data-items="1"
             data-sm-items="2" data-md-items="3" data-margin="30" data-lg-margin="84" data-mouse-drag="true">
            <?php
            foreach ($animals as $animal) {
                echo "
                <div class='thumbnail'>
                    <img class='img-responsive' src='{$animal['image_path']}' width='480' height='321'>
                        <div class='caption'>
                            <h4> {$animal['name']}</h4>
                            <p class='text-graylight small text-bold text-uppercase' > {$animal['sex']},<br>{$animal['size']}, <br>{$animal['type']},<br> {$animal['color']},<br> {$animal['place']} </p >
                        </div >
                </div>";
            }
            ?>
        </div>
    </div>
</section>
</main>
<!-- Page Footer-->
<footer class="page-footer">
    <div class="container"><span>&#169;</span> <span id="copyright-year"></span>
        <hr class="divider divider-default divider-vertical">
        <a href="privacy.html">Privacy policy</a>
    </div>
</footer>
</div>
<script src="Src/js/core.min.js"></script>
<script src="Src/js/script.js"></script>
</body>
</html>