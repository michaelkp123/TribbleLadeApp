document.getElementById("Imagefile").addEventListener("change", () => {
  var image = document.getElementById("Imagefile").files;
  document.getElementById("Error").innerHTML = "";

  //checks if an image is chosen
  if (typeof image[0] === "undefined") {
    document.getElementById("Error").innerHTML = "";
    document.getElementById("ButtonSubmit").disabled = false;
    document.getElementById("ButtonSubmit").style.backgroundColor = "";
  } else {
    document.getElementById("Error").style.color = "red";

    //find image type
    var imagetype = image[0].name
      .substr(image[0].name.length - 4)
      .toLowerCase();

    //Checks file type:
    if (imagetype != ".png" && imagetype != ".jpg") {
      document.getElementById("Error").innerHTML =
        "This file type is not accepted";
      document.getElementById("ButtonSubmit").disabled = true;
      document.getElementById("ButtonSubmit").style.backgroundColor =
        "lightgray";
    }

    //Checks file size:
    else if (image[0].size > 8500000) {
      document.getElementById("Error").innerHTML = "File is too large";
      document.getElementById("ButtonSubmit").disabled = true;
      document.getElementById("ButtonSubmit").style.backgroundColor =
        "lightgray";
    }

    //file is valid -> create preview:
    else {
      const imageSrc = URL.createObjectURL(image[0]);
      const imagePreview = document.querySelector("#Imagesource");
      imagePreview.src = imageSrc;
      document.getElementById("ButtonSubmit").disabled = false;

      if (document.getElementById("ButtonSubmit").innerHTML == "Save changes") {
        document.getElementById("ButtonSubmit").style.backgroundColor =
          "#00a651";
      } else {
        document.getElementById("ButtonSubmit").style.backgroundColor = "";
      }
    }
  }
});
