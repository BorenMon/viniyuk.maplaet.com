const inputs = document.querySelectorAll('input[type="text"]')
const qrInput = document.getElementById('qrInput')
const qrs = document.querySelectorAll('.qr')
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

const done = function(url) {
  preImg.src = url
  openModal()
}

fileInput.addEventListener('change', function() {
  if(fileInput.value) fileName.innerText = fileInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1]
  else fileName.innerText = ''

  const file = this.files[0]

  if(file) done(URL.createObjectURL(file)) 
  else background.forEach(bg => bg.src = '')
})

closeBtn.addEventListener('click', closeModal)

cropBtn.addEventListener('click', cropImg)

function openModal() {
  modal.style.display = 'block'
  cropper = new Cropper(preImg, {
    aspectRatio: 517.075/449.862
  })
}

function closeModal() {
  modal.style.display = 'none'
  cropper.destroy()
  cropper = null
}

function cropImg() {
  canvas = cropper.getCroppedCanvas()

  background.forEach(bg => bg.src = canvas.toDataURL())

  closeModal()
}

function updateQR() {
  if(qrInput.value !== '') {
    const data = qrInput.value
    const size = '1000x1000'
    const baseURL = 'https://api.qrserver.com/v1/create-qr-code/'

    const url = `${baseURL}?data=${data}&size=${size}`

    qrs.forEach(qr => {
      qr.style.display = 'block'
      qr.style.backgroundImage = `url(${url})`
    })
  } else {
    qrs.forEach(qr => {
      qr.style.display = 'none'
      qr.style.backgroundImage = ''
    })
  }
}

updateQR()

qrInput.addEventListener('input', () => {
  updateQR()
})

const changes = [
  '.type',
  '.price',
  '.location',
  '.phone1',
  '.phone2'
]

const defaults = [
  'ប្រភេទអចលនវត្ថុ',
  '$XX,XXX',
  'ទីតាំងអចលនវត្ថុ',
  document.querySelector('.phone1').innerText,
  document.querySelector('.phone2').innerText
]

inputs.forEach((input, idx) => {
  if(idx < 5) {
    input.addEventListener('input', function() {
      const els = document.querySelectorAll(`${changes[idx]}`)
      els.forEach(el => {
        if(this.value !== '') el.innerText = this.value
        else el.innerText = defaults[idx]
      })
    })
  }
})

function download() {
  domtoimage
  .toJpeg(document.getElementById("download"), { quality: 1 })
  .then(function (dataUrl) {
    var link = document.createElement("a");
    link.download = "poster.jpeg";
    link.href = dataUrl;
    link.click();
  });
}