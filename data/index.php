<?php

require 'vendor/autoload.php';

$controller = new \App\Controllers\AnimalGeneratorController();
$validator = new \App\Services\AnimalValidator();
$animalModel = new \App\Models\AnimalModel();

try {
    $animalModel->getAnimals();
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


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style type="text/css">
        img {
            width: 450px;
            height: auto;

        }

        body {

            color: steelblue;
        }

        .dop-fon {
            background-color: lightblue;

        }

        .button {
            float: left;
            margin: 30px;
            margin-left: 205px;
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #106ee8;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .button:hover {
            background-color: #4CAF50
        }

        .button:active {
            background-color: #106ee8;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

        .error {
            width: 100px;
            height: 100px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            background-color: red;
            position: relative;
            animation-name: example;
            animation-duration: 8s;
        }


        }

        .h1 {
            color: white;
            text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
        }

        .h2 {
            color: steelblue;
            font-size: 25px;
            text-shadow: 1px 1px, 0 0 1px blue, 0 0;
        }

        .h3 {
            color: #106ee8;
            font-size: 40px;
            margin-left: auto;
            text-shadow: 1px 1px 2px black, 0 0 100px blue, 0 0 10px whitesmoke;
        }

        select {
            text-align: center;
            color: blue;
            font-size: 16px;
            cursor: pointer;
        }

        .baby-text {
            color: steelblue;
            font-size: 25px;
            text-shadow: 1px 1px, 0 0 1px blue, 0 0;

        .baby-name {
            color: steelblue;
            font-size: 40px;
            font-weight: bolder;
            text-decoration-style: solid;
            text-shadow: 1px 1px, 0 0 1px blue, 0 0;

    </style>

</head>
<header>
    <div class="card text-white bg-primary mb-12 text-center" style="max-width: none;">

        <div class="card-body">
            <h1 class="card-title h1">Animal Generator</h1>
            <p class="card-text">Welcome to this generator. Create a dream animal! </p>
        </div>
    </div>
</header>
<body>
<div class="row">
    <div class="col-12 text-center">
        <form method="get">
            <div class="row">
                <div class="col-6 px-5 dop-fon h2">
                    <fieldset>
                        <legend class="h2"><h1>First Parent</h1></legend>
                        <div class="mb-3">
                            <label for="first-parent-animal" class="form-label">Animal</label>
                            <select id="first-parent-animal" class="form-select" name="first_parent[animal]">
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
                            <label for="first-parent-sex" class="form-label">Sex</label>
                            <select <?php if (empty($_GET['first_parent']['animal'])) {
                                echo ' disabled ';
                            } ?>id="first-parent-sex" name="first_parent[sex]" class="form-select">
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
                            <label for="first-parent-type" class="form-label">Type</label>
                            <select <?php if (empty($_GET['first_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="first-parent-type" name="first_parent[type]" class="form-select">
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
                            <label for="first-parent-size" class="form-label">Size</label>
                            <select <?php if (empty($_GET['first_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="first-parent-size" name="first_parent[size]" class="form-select">
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
                            <label for="first-parent-color" class="form-label">Color</label>
                            <select <?php if (empty($_GET['first_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="first-parent-color" name="first_parent[color]" class="form-select">
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
                            <label for="first-parent-place" class="form-label">Place</label>
                            <select <?php if (empty($_GET['first_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="first-parent-place" name="first_parent[place]" class="form-select">
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
                <div class="col-6 px-5  dop-fon h2">
                    <fieldset>
                        <legend class="h2"><h1>Second Parent</h1></legend>
                        <div class="mb-3">
                            <label for="second-parent-animal" class="form-label">Animal</label>
                            <select id="second-parent-animal" class="form-select" name="second_parent[animal]">
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
                            <label for="second-parent-sex" class="form-label">Sex</label>
                            <select <?php if (empty($_GET['second_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="second-parent-sex" name="second_parent[sex]" class="form-select">
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
                            <label for="second-parent-type" class="form-label">Type</label>
                            <select <?php if (empty($_GET['second_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="second-parent-type" name="second_parent[type]" class="form-select">
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
                            <label for="second-parent-size" class="form-label">Size</label>
                            <select <?php if (empty($_GET['second_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="second-parent-size" name="second_parent[size]" class="form-select">
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
                            <label for="second-parent-color" class="form-label">Color</label>
                            <select <?php if (empty($_GET['second_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="second-parent-color" name="second_parent[color]" class="form-select">
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
                            <label for="second-parent-place" class="form-label">Place</label>
                            <select <?php if (empty($_GET['second_parent']['animal'])) {
                                echo ' disabled ';
                            } ?> id="second-parent-place" name="second_parent[place]" class="form-select">
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
            <div class=" col-6 px-5">
                <?php
                if (empty($_GET['first_parent']['animal']) || empty($_GET['second_parent']['animal'])) {
                    echo '<button type="submit" class="btn btn-primary btn-lg button" style="width:700px;" name="continue" value="true">Continue</button>';
                } else {
                    echo '<button type="submit" class="btn btn-primary btn-lg button" style="width:700px;" name="generate" value="true">Generate</button>';
                } ?>
            </div>
        </form>
        <?php if (isset($error)) {
            echo "<div class='container '  ><span class='badge  fs-4 error' style='width:700px; height: 60px' >{$error}</span> </div> ";
        }

        ?>
    </div>
    <div class="col-4  text-center mt-2 dop-block">

        <?php if (isset($baby)) {
            echo '<div class="row g-0  flex-md-row">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success"><h1 class="h3">Baby</h1></strong>
                
                <h1 class="baby-name" >' . ucfirst($baby->getName()) . '</h1>

               <br> <p class="mb-auto baby-text">' . $baby->getSex() . ' <br> ' . $baby->getType() . '<br> ' . $baby->getColor() . ' <br> ' . $baby->getSize() . ' <br> ' . $baby->getPlace() . '</p>
                
            </div>
            <div class="col-auto d-none d-lg-block">
                <img src=" ' . $baby->getBabyImage() . ' " class=" " >

            </div>
        </div>';
        }
        ?>

    </div>
    <div class="col-6  text-center mt-2 ">

        <h1 class="baby-name">Last 10 animals</h1>
        <?php
        foreach ($animals as $animal) {
            echo "<div class='row g-0  flex-md-row '>
                <div class='col-12 p-4 d-flex flex-column position-static'>
                    <strong class='d-inline-block mb-2 text-success'>{$animal['name']}, {$animal['sex']},{$animal['size']},{$animal['type']}, {$animal['color']}, {$animal['place']}, </strong>
                    <img src='{$animal['image_path']}'>
                </div>";
        }
        ?>

    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
