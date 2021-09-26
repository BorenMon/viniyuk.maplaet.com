const eyes = document.querySelectorAll('.fa-eye')

eyes.forEach(eye => {
  eye.addEventListener('click', function() {
    const input = this.previousElementSibling
    if(input.type === 'password') {
      input.type = 'text'
      this.style.color = '#7C141F'
    } else {
      input.type = 'password'
      this.style.color = '#b5b5b5'
    }
  })
})

$(document)
.on('submit', '.reset', function(event) {
  event.preventDefault()

  const error = document.querySelector('.error')
  const email = document.getElementById('email')

  let errorMessage = ''

  const require = [
    'លេខកូដសម្ងាត់',
    'ផ្ទៀងផ្ទាត់លេខកូដសម្ងាត់'
  ]

  var data = {
    email: email.innerText.trim(),
    password: $('#password').val(),
    password2: $('#password2').val()
  }

  console.log(data)

  let currentRequire = 0

  let hasError = false

  for(const key in data) {
    if(key !== 'email') {
      if(data[key].trim() === '') {
        errorMessage += `
          <li><span>${require[currentRequire]} តម្រូវឲ្យបំពេញ!</span></li>
        `
        hasError = true
      }
      currentRequire++
    }
  }

  if(!hasError && (data['password'] != data['password2'])) {
    errorMessage += `
      លេខកូដសម្ងាត់តម្រូវឲ្យដូចគ្នា!
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
      url: 'ajax/reset.php',
      data: data,
      dataType: 'json',
      async: true
    })
    .done(function(result) {
      console.log(result)
      if(result.redirect) {
        window.location = result.redirect
      }
      if(result.error) {
        error.style.display = 'block'
        errorMessage += result.error
        error.innerHTML = errorMessage
      } else {
        error.style.display = 'none'
      }
    })
    .fail(function(e) {
      console.log(e)
    })
  }
})