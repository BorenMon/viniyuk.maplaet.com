const eyes = document.querySelectorAll('.fa-eye')

eyes.forEach(eye => {
  eye.addEventListener('click', () => {
    if(eye.style.color == 'rgb(180, 180, 180)') {
      eye.style.color = '#7C141F'
      eye.previousElementSibling.type = 'text'
    } else {
      eye.style.color = 'rgb(180, 180, 180)'
      eye.previousElementSibling.type = 'password'
    }
  })
})

$(document)
.on('submit', '.change', function(event) {
  event.preventDefault()

  const error = document.querySelector('.error')

  let errorMessage = ''

  const require = [
    'លេខកូដសម្ងាត់ចាស់',
    'លេខកូដសម្ងាត់ថ្មី',
    'ផ្ទៀងផ្ទាត់លេខកូដសម្ងាត់ថ្មី',
  ]

  var data = {
    old_pwd: $('#old-pwd').val(),
    new_pwd: $('#new-pwd').val(),
    verify_pwd: $('#verify-pwd').val(),
  }

  let currentRequire = 0

  let hasError = false

  for(const key in data) {

    if(data[key].trim() === '') {
      errorMessage += `
        <li><span>${require[currentRequire]} តម្រូវឲ្យបំពេញ!</span></li>
      `
      hasError = true
    }
    currentRequire++

  }

  if(data['new_pwd'] != data['verify_pwd']) {
    errorMessage += `
        <li><span>ផ្ទៀងផ្ទាត់លេខកូដសម្ងាត់ថ្មីមិនដូចគ្នា!</span></li>
      `
    hasError = true
  }

  if(hasError) {
    error.style.display = 'block'
    error.innerHTML = errorMessage
  } else {
    error.style.display = 'none'
  }
  
  if(!hasError) {

    $.ajax({
      type: 'POST',
      url: '../ajax/change_password.php',
      data: data,
      dataType: 'json',
      async: true
    })
    .done(function(result) {
      if(result.error) {
        error.style.display = 'block'
        error.innerHTML = `
          <li><span>${result.error}</span></li>
        `
      } else window.location = result.redirect
    })
    .fail(function(e) {
      console.log(e)
    })
  }
})