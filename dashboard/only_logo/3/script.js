const uploadInput = document.getElementById('upload')

const prePosters = document.querySelector('.prePoster')

const downloads = document.querySelector('.downloads')

let files, i, url

function upload() {
  uploadInput.click()
}

uploadInput.addEventListener('change', function() {

  files = this.files
  
  for(i = 0; i < files.length; i++) {
    new Compressor(files[i], {
        quality : 0.8,
        maxHeight: 2000,
        maxWidth: 2000,
        success(result) {
          url = URL.createObjectURL(result)
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
          download.className = `download d${downloads.childElementCount}`
          download.innerHTML = `
            <img src="logo.svg">
            <img src="${url}">
          `

          prePosters.appendChild(poster)
          downloads.appendChild(download)

          poster.querySelector('.button button').addEventListener('click', () => {
            domtoimage.toJpeg(download, {
              quality: 0.8
            }).then(dataUrl => {
            domtoimage
              .toJpeg(download, {
                quality: 0.8
              })
              .then(dataUrl => {
                new Compressor(dataURLtoFile(dataUrl), {
                    quality : 0.8,
                    maxHeight: 2000,
                    maxWidth: 2000,
                    success(result) {
                      const link = document.createElement('a')
                      link.download = 'poster.jpeg'
                      link.href = URL.createObjectURL(result)
                      link.click()
                    }
                  }
                )
              })
            })
      
          })
        }
      }
    )
  }
})

function clearPoster() {
  prePosters.innerHTML = ''
  downloads.innerHTML = ''
}