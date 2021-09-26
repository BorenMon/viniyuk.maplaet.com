const uplaod = document.getElementById('upload')
const fileName = document.querySelector('.file-name')
const modal = document.getElementById('cropperModal')
const closeBtn = document.querySelector('.closeBtn')
const cropBtn = document.querySelector('.cropBtn')
const preImg = document.getElementById('preImg')
const profileImg = document.querySelector('.profile-img')
const resetProfileImg = profileImg.style.backgroundImage

let canvas

function chooseImg() {
  upload.click()
}

function done(url) {
  preImg.src = url
  openModal()
}

upload.addEventListener('change', function() {
  if(this.value) fileName.innerText = this.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1]
  else fileName.innerText = ''

  if(this.files[0]) done(URL.createObjectURL(this.files[0])) 
  else profileImg.style.backgroundImage = resetProfileImg
})

closeBtn.addEventListener('click', closeModal)

function openModal() {
  modal.style.display = 'block'
  cropper = new Cropper(preImg, {
    aspectRatio: 1/1
  })
}

function closeModal() {
  modal.style.display = 'none'
  cropper.destroy()
  cropper = null
}

function cropImg() {
  canvas = cropper.getCroppedCanvas({
    width: 500,
    height: 500,
  })

  profileImg.style.backgroundImage = `url(${canvas.toDataURL()})`

  closeModal()
}

cropBtn.addEventListener('click', cropImg)

$(document)
.on('submit', '.change', function(event) {
  event.preventDefault()

  const error = document.querySelector('.error')

  let errorMessage = ''

  const require = [
    'ឈ្មោះអ្នកប្រើប្រាស់',
    'នាម',
    'គោត្តនាម',
    'First Name',
    'Last Name',
    'លេខទូរស័ព្ទទី១',
  ]

  var data = {
    username: $('#username').val(),
    fname_kh: $('#fname-kh').val(),
    lname_kh: $('#lname-kh').val(),
    fname_en: $('#fname-en').val(),
    lname_en: $('#lname-en').val(),
    phone1: $('#phone1').val(),
    phone2: $('#phone2').val(),
    telegram_link: $('#telegram-link').val()
  }

  let currentRequire = 0

  let hasError = false

  for(const key in data) {
    if(key !== 'phone2' && key !== 'telegram_link') {
      if(data[key].trim() === '') {
        errorMessage += `
          <li><span>${require[currentRequire]} តម្រូវឲ្យបំពេញ!</span></li>
        `
        hasError = true
      }
      currentRequire++
    }
  }

  if(hasError) {
    error.style.display = 'block'
    error.innerHTML = errorMessage
  } else {
    error.style.display = 'none'
  }
  
  if(!hasError) {
    if(profileImg.style.backgroundImage != resetProfileImg) {
      data['profile_url'] = canvas.toDataURL()
    }

    // Call AJAX here
    $.post('../ajax/change_info.php', data, function(result) {
      window.location = result
    })
    

    // $.ajax({
    //   type: 'POST',
    //   url: '../ajax/change_info.php',
    //   data: data,
    //   dataType: 'json',
    //   async: true
    // })
    // .done(function(result) {
    //   window.location = result
    // })
    // .fail(function(e) {
    //   console.log(e.responseText)
    // })
  }
})