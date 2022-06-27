# Project Title

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<br />
<div align="center">
  <a href="https://github.com/erdilsytrk/watermark-php">
    <img src="https://raw.githubusercontent.com/erdilsytrk/watermark-php/main/gallery/watermarklogo.png" alt="Logo" width="100" height="100">
  </a>

  <h3 align="center">PHP Watermark Function</h3>

  <p align="center">
    Scroll and explore
    <br />
  </p>
</div>

## About The Project

<br />
<div align="center">
    <img src="https://raw.githubusercontent.com/erdilsytrk/watermark-php/main/gallery/form.png" alt="Screenshot"><br />
    <img src="https://raw.githubusercontent.com/erdilsytrk/watermark-php/main/gallery/positions.png" alt="Screenshot" width="800"><br />
    <img src="https://raw.githubusercontent.com/erdilsytrk/watermark-php/main/gallery/example.jpg" alt="Screenshot" width="800">
</div><br />

Protect your images in your projects such as real estate, blog, e-commerce. Use it as automation in your works that require putting a logo.

Why PHP Watermark Function?
* No framework no build needed. Just PHP.
* You can protect your images
* Multiple Image Processing
* Flexible, Configurable
* SQL connectable
* Upload location selectable
* Watermark Position selectable
* Define Max Size

## Build With

* PHP - No framework needed

## Getting Started

### Prerequisites

* go php.ini, find extension=gd and remove ";" in front

### Installing

* Download function.php and include in your project
* Create a folder for images. Default name: gallery

<br />
<img src="https://raw.githubusercontent.com/erdilsytrk/watermark-php/main/gallery/folder.png" alt="Screenshot">
<br />

### Usage

* Call function and set your datas
* Position can be used as center, top-left, top-right, bottom-left, bottom-right, bottom or top
* You can define a variable you need. i.e user id for mysql. change $yourvariable or set ''
```
$array = watermark($image,$logo,$location,$position,$yourvariable);
print_r($array);
```

* Usage example in the project

<br />
<img src="https://raw.githubusercontent.com/erdilsytrk/watermark-php/main/gallery/example.png" alt="Screenshot" width="600">
<br />

```
<?php

include("function.php");

if(isset($_POST["Upload"])){

    //       function (Posted images    ,posted logo    ,folder loc  ,posted pos   , variable)
    $array = watermark($_FILES["images"],$_FILES["logo"],'./gallery/',$_POST["pos"],'example');
    // get uploaded images array, you can use for showing images
    print_r($array);
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple>
    <input type="file" name="logo"> <br>
    <select name="pos">
        <option value="center" selected>Center</option>
        <option value="top-left">Top Left</option>
        <option value="top-right">Top Right</option>
        <option value="bottom-left">Bottom Left</option>
        <option value="bottom-right">Bottom Right</option>
        <option value="bottom">Bottom</option>
        <option value="top">Top</option>
    </select>
    <input type="submit" name="Upload" value="Upload">
</form>
```

### Configurations

* Configure your function

<br />
<img src="https://raw.githubusercontent.com/erdilsytrk/watermark-php/main/gallery/config.png" alt="Screenshot" width="600">
<br />

```

// folder location
$loc = $location;

// define maxsize for files i.e 10MB
$maxsize = 10 * 1024 * 1024;

// allowed types
$allowed_types = array('jpg', 'png', 'jpeg');

// center, top-left, top-right, bottom-left, bottom-right, bottom, top
$pos = $position;

// custom variable, you can use it according to your specific needs. i.e id for SQL
$id = $customvariable;

// mysql connection. Activate here and go LINE 145-153 notice: include sql config file
$sql = "INSERT INTO images(names,id)";
```

## Roadmap

- [x] Multiple Image Processing
- [x] SQL connect
- [x] Upload location
- [x] Watermark Position
- [x] Max Size
- [x] Files Exists name change
- [ ] +Config
    - [ ] Logo transparency
    - [ ] Logo Margin
    - [ ] Logo Size
    - [ ] Image Size
- [ ] +Code
    - [ ] Detailed Bug test
    - [ ] Code Optimization
    - [ ] PHP Upload fix (POST Content-Length etc)
    - [ ] and features that I can't think of right now :(
    

## Authors

Erdil Soyturk

## License

This project is licensed under the MIT License




[contributors-shield]: https://img.shields.io/github/contributors/erdilsytrk/watermark-php.svg?style=for-the-badge
[contributors-url]: https://github.com/erdilsytrk/watermark-php/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/erdilsytrk/watermark-php.svg?style=for-the-badge
[forks-url]: https://github.com/erdilsytrk/watermark-php/network/members
[stars-shield]: https://img.shields.io/github/stars/erdilsytrk/watermark-php.svg?style=for-the-badge
[stars-url]: https://github.com/erdilsytrk/watermark-php/stargazers
[issues-shield]: https://img.shields.io/github/issues/erdilsytrk/watermark-php.svg?style=for-the-badge
[issues-url]: https://github.com/erdilsytrk/watermark-php/issues
[license-shield]: https://img.shields.io/github/license/erdilsytrk/watermark-php.svg?style=for-the-badge
[license-url]: https://github.com/erdilsytrk/watermark-php/blob/main/LICENSE
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/erdilsytrk