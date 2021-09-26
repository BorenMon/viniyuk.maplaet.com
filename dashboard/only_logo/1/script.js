const uploadInput = document.getElementById('upload')

const prePosters = document.querySelector('.prePoster')

const downloads = document.querySelector('.downloads')

let files, i, url, downloadID = 0;

function upload() {
  uploadInput.click()
}

uploadInput.addEventListener('change', function() {

  files = this.files
  
  for(i = 0; i < files.length; i++) {
    url = URL.createObjectURL(files[i])

    const poster = document.createElement('div')
    poster.className = 'poster-container'
    poster.innerHTML = `
      <div class="poster">
        <img src="logo.svg">
        <img src="${url}">
      </div>
      <div class="button">
        <button>ទាញយករូបភាព</button>
      </div>
    `

    const download = document.createElement('div')
    download.className = `download d${downloadID++}`
    download.innerHTML = `
      <img src="logo.svg">
      <img src="${url}">
    `

    prePosters.appendChild(poster)
    downloads.appendChild(download)
  }

  updateDownloading()
})

function clearPoster() {
  prePosters.innerHTML = ''
  downloads.innerHTML = ''
  downloadID = 0
}

function updateDownloading() {
  const buttons = document.querySelectorAll('.button button')
  
  buttons.forEach((btn, idx) => {
    btn.addEventListener('click', () => {

      domtoimage.toJpeg(document.querySelector(`.download.d${idx}`), { quality: 1 })
      .then(function (dataUrl) {
          var link = document.createElement('a');
          link.download = 'poster.jpeg';
          link.href = dataUrl;
          link.click();
      });

    })
  })
}