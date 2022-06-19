const inputs = document.querySelectorAll('input[type="text"]')
const fileInput = document.getElementById('background')
const fileName = document.querySelector('.file-name')
const modal = document.getElementById('cropperModal')
const closeBtn = document.querySelector('.closeBtn')
const cropBtn = document.querySelector('.cropBtn')
const preImg = document.getElementById('preImg')
const background = document.querySelectorAll('.background')
var cropper

function chooseImage() {
  fileInput.click()
}

fileInput.addEventListener('change', function() {
  if(fileInput.value) fileName.innerText = fileInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1]
  else fileName.innerText = ''

  const file = this.files[0]

  if(file) {
    preImg.src = URL.createObjectURL(file)
    openModal()
  }
  else background.forEach(bg => bg.src = '')
})

closeBtn.addEventListener('click', closeModal)

cropBtn.addEventListener('click', cropImg)

function openModal() {
  modal.style.display = 'block'
  cropper = new Cropper(preImg, {
    aspectRatio: 3/2
  })
}

function closeModal() {
  modal.style.display = 'none'
  cropper.destroy()
  cropper = null
}

function cropImg() {
  canvas = cropper.getCroppedCanvas()
  
  new Compressor(dataURLtoFile(canvas.toDataURL(), 'background.png'), {
      quality : 0.8,
      maxHeight: 2000,
      maxWidth: 2000,
      success(result) {
        background.forEach(bg => bg.style.backgroundImage = `url('${URL.createObjectURL(result)}')`)

        closeModal()
      }
    }
  )
}

const changes = [
  '.type',
  '.location',
  '.price',
  '.phone1',
  '.phone2'
]

const defaults = [
  '',
  '',
  '',
  document.querySelector('.phone1').innerText,
  document.querySelector('.phone2').innerText
]

inputs.forEach((input, idx) => {

  input.addEventListener('input', function() {
    const els = document.querySelectorAll(`${changes[idx]}`)
    els.forEach(el => {
      if(this.value !== '') el.innerText = this.value
      else el.innerText = defaults[idx]
    })
  })

})

function download() {
  domtoimage.toJpeg(document.getElementById("download"), {
    quality: 0.8
  }).then(dataUrl => {
  domtoimage
    .toJpeg(document.getElementById("download"), {
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

}



let windowWidth = $(window).width(), typeFontSizePercentage = 100, priceFontSizePercentage = 100

$('#type-font-size-percentage').on('input', function() {
  typeFontSizePercentage = this.value
  fontSizePercentageChanger()
})
$('#price-font-size-percentage').on('input', function() {
  priceFontSizePercentage = this.value
  fontSizePercentageChanger()
})

// Font Size Percentage Change Handler
const fontSizePercentageChanger = () => {
  if(windowWidth >= 800) {
    $('.type').each((i, obj) => {
      switch(i) {
        case 1 : obj.style.fontSize = `calc(2.5vw * 7 * (${typeFontSizePercentage} / 100))`; break
        case 0 : obj.style.fontSize = `calc(2.5vw * (${typeFontSizePercentage} / 100))`; break
      }
    })
    $('.price').each((i, obj) => {
      switch(i) {
        case 1 : obj.style.fontSize = `calc(2.9vw * 7 * (${priceFontSizePercentage} / 100))`; break
        case 0 : obj.style.fontSize = `calc(2.9vw * (${priceFontSizePercentage} / 100))`; break
      }
    })
  } else {
    $('.type').each((i, obj) => {
      switch(i) {
        case 1 : obj.style.fontSize = `calc(2.5vw * 7 * (${typeFontSizePercentage} / 100))`; break
        case 0 : obj.style.fontSize = `calc((2.5vw * 93 / 45) * (${typeFontSizePercentage} / 100))`; break
      }
    })
    $('.price').each((i, obj) => {
      switch(i) {
        case 1 : obj.style.fontSize = `calc(2.9vw * 7 * (${priceFontSizePercentage} / 100))`; break
        case 0 : obj.style.fontSize = `calc((2.9vw * 93 / 45) * (${priceFontSizePercentage} / 100))`; break
      }
    })
  }
}
  
// Window Width Change Handler
$(window).resize(() => {
  windowWidth = $(window).width()
  fontSizePercentageChanger()
})