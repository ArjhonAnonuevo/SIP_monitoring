<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Tailwind Image Carousel</title>
</head>
<body class="bg-white shadow-lg">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<div class="sliderAx h-auto">
  <div id="slider-1" class="container mx-auto">
    <div class="bg-cover bg-center h-auto text-white py-24 px-10 object-fill" style="background-image: url(sana.jpg)">
      <div class="md:w-1/2">
        <p class="font-bold text-sm uppercase">Services</p>
        <p class="text-3xl font-bold">Hello world</p>
        <p class="text-2xl mb-10 leading-none">Carousel with TailwindCSS and jQuery</p>
        <a href="#" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>
      </div>
    </div>
  </div>

  <div id="slider-2" class="container mx-auto">
    <div class="bg-cover bg-top h-auto text-white py-24 px-10 object-fill" style="background-image: url(sana_t.jpg)">
      <p class="font-bold text-sm uppercase">Services</p>
      <p class="text-3xl font-bold">Hello world</p>
      <p class="text-2xl mb-10 leading-none">Carousel with TailwindCSS and jQuery</p>
      <a href="#" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>
    </div>
  </div>

  <div id="slider-3" class="container mx-auto">
    <div class="bg-cover bg-top h-auto text-white py-24 px-10 object-fill" style="background-image: url(sana_h.jpg)">
      <p class="font-bold text-sm uppercase">Services</p>
      <p class="text-3xl font-bold">Hello world</p>
      <p class="text-2xl mb-10 leading-none">Carousel with TailwindCSS and jQuery</p>
      <a href="" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contact us</a>
    </div>
  </div>
  <br>
</div>

<div class="flex justify-between w-16 mx-auto pb-2">
  <button id="sButton1" onclick="sliderButton1()" class="bg-purple-400 rounded-full w-4 pb-2"></button>
  <button id="sButton2" onclick="sliderButton2()" class="bg-purple-400 rounded-full w-4 p-2"></button>
  <button id="sButton3" onclick="sliderButton3()" class="bg-purple-400 rounded-full w-4 p-2"></button>

</div>

<script>
var cont = 0;
var xx;

function loopSlider() {
  xx = setInterval(function () {
    $("#slider-" + (cont + 1)).fadeOut(400); // Fade out the current slider
    $("#sButton" + (cont + 1)).removeClass("bg-purple-800"); // Remove active class from current button

    cont = (cont + 1) % 3; // Move to the next slider

    $("#slider-" + (cont + 1)).delay(400).fadeIn(400); // Fade in the next slider with a delay
    $("#sButton" + (cont + 1)).addClass("bg-purple-800"); // Add active class to the corresponding button
  }, 8000);
}

function reinitLoop(time) {
  clearInterval(xx);
  setTimeout(loopSlider, time);
}

function sliderButton1() {
  $("#slider-2").fadeOut(400);
  $("#slider-3").fadeOut(400);
  $("#slider-1").delay(400).fadeIn(400);
  $("#sButton2").removeClass("bg-purple-800");
  $("#sButton1").addClass("bg-purple-800");
  reinitLoop(4000);
  cont = 0;
}

function sliderButton2() {
  $("#slider-1").fadeOut(400);
  $("#slider-3").fadeOut(400);
  $("#slider-2").delay(400).fadeIn(400);
  $("#sButton1").removeClass("bg-purple-800");
  $("#sButton2").addClass("bg-purple-800");
  reinitLoop(4000);
  cont = 1;
}

function sliderButton3() {
  $("#slider-1").fadeOut(400);
  $("#slider-2").fadeOut(400);
  $("#slider-3").delay(400).fadeIn(400, function() {
    $("#sButton1").removeClass("bg-purple-800");
    $("#sButton2").removeClass("bg-purple-800");
    $("#sButton3").addClass("bg-purple-800");
  });
  reinitLoop(4000);
  cont = 2;
}


$(window).ready(function () {
  $("#slider-2, #slider-3").hide();
  $("#sButton1").addClass("bg-purple-800");

  loopSlider();
});


</script>
</body>
</html>
