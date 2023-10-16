function pageLoaded() {
    let loaderSection = document.querySelector('#loader');
    loaderSection.classList.add('loaded');
  }
  
  document.onload = pageLoaded();