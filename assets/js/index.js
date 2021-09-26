const checkIcon = document.querySelector('.fa-check-square')

const checkBox = document.getElementById('remember')

const eye = document.querySelector('.fa-eye')

const password = document.getElementById('password')

let eyeState = false

checkBox.addEventListener('change', function() {
  if(this.checked) checkIcon.style.color = '#7C141F'
  else checkIcon.style.color = 'rgb(180, 180, 180)'
})

eye.addEventListener('click', () => {
  if(!eyeState) {
    eye.style.color = '#7c141f'
    password.type = 'text'
    eyeState = true
  } else {
    eye.style.color = 'rgb(180, 180, 180)'
    password.type = 'password'
    eyeState = false
  }
})

$(document)
.on('submit', '.login', function(event) {
  event.preventDefault()

  const error = document.querySelector('.error')

  let errorMessage = ''

  const require = [
    'អ៊ីម៉ែល',
    'លេខកូដសម្ងាត់'
  ]

  var data = {
    email: $('#email').val(),
    password: $('#password').val(),
    remember: $('#remember').prop('checked') ? '1' : '0'
  }

  let currentRequire = 0

  let hasError = false

  for(const key in data) {
    if(key !== 'remember') {
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
    $.ajax({
      type: 'POST',
      url: 'ajax/login.php',
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

  document.getElementById('remember').checked = false;
})