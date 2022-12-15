function signupManager($direction) {
  if (
    document.getElementById("1").classList.contains("active") ||
    document.getElementById("1").classList.contains("test active")
  ) {
    if ($direction == "Next") {
      document.getElementById("Next").disabled = false;
      document.getElementById("Next").visibility = false;
      document.getElementById("Prev").hidden = false;
    }
    if ($direction == "Prev") {
      document.getElementById("Prev").disabled = true;
    }
  }

  if (
    document.getElementById("2").classList.contains("active") ||
    document.getElementById("2").classList.contains("test active")
  ) {
    document.getElementById("Next").disabled = false;
    document.getElementById("Prev").disabled = false;

    if ($direction == "Next") {
      document.getElementById("Next").hidden = true;
      document.getElementById("Prev").hidden = false;
    } else {
      document.getElementById("Next").hidden = false;
      document.getElementById("Prev").hidden = true;
    }
  }

  if (
    document.getElementById("3").classList.contains("active") ||
    document.getElementById("3").classList.contains("test active")
  ) {
    if ($direction == "Next") {
      document.getElementById("Next").disabled = true;
    } else {
      document.getElementById("Next").disabled = false;
      document.getElementById("Next").hidden = false;
    }
  }
}

//extra for booking
function next() {
  document.getElementById("prev").hidden = false;
  document.getElementById("next").hidden = true;
}
function prev() {
  document.getElementById("prev").hidden = true;
  document.getElementById("next").hidden = false;
}
function typechosen(value) {
  document.getElementById("next").disabled = false;
}
