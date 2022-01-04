let kbTitle = document.querySelectorAll('.kb-section__subtitle');

[...kbTitle].forEach(btn => btn.onclick = function () {
  btn.nextElementSibling.classList.toggle('kb-section__description_active');
})