function updateQtt(id, change) {
  let input = document.getElementById("qtt-" + id);

  let valeuractuelle = parseInt(input.value);

  let newVal = valeuractuelle + change;

  if (newVal >= 0) {
    input.value = newVal;
  }
}
