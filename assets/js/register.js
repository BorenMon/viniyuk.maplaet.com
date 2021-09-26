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
.on('submit', '.register', function(event) {
  event.preventDefault()

  const _form = $(this)

  const error = document.querySelector('.error')

  const _body = document.querySelector('body')
  const container = document.querySelector('.register-container')

  let errorMessage = ''

  const require = [
    'ឈ្មោះអ្នកប្រើប្រាស់',
    'អ៊ីម៉ែល',
    'នាម',
    'គោត្តនាម',
    'First Name',
    'Last Name',
    'លេខទូរស័ព្ទទី១',
    'លេខកូដសម្ងាត់',
    'ផ្ទៀងផ្ទាត់លេខកូដសម្ងាត់'
  ]

  var data = {
    username: $('#username', _form).val(),
    email: $('#email', _form).val(),
    fname_kh: $('#fname-kh', _form).val(),
    lname_kh: $('#lname-kh', _form).val(),
    fname_en: $('#fname-en', _form).val(),
    lname_en: $('#lname-en', _form).val(),
    phone1: $('#phone1', _form).val(),
    phone2: $('#phone2', _form).val(),
    password1: $('#password1', _form).val(),
    password2: $('#password2', _form).val(),
    telegram_link: $('#telegram-link', _form).val(),
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

  if(data['password1'] !== data['password2']) {
    errorMessage += 
    `
      <li><span>លេខកូដតម្រូវឲ្យដូចគ្នា!</span></li>
    `
    hasError = true
  }

  if(hasError) {
    error.style.display = 'block'
    error.innerHTML = errorMessage
    container.style.display = 'block'
    _body.style.height = '115vh'
  } else {
    error.style.display = 'none'
    container.style.display = 'flex'
    _body.style.height = '100vh'
  }
  
  if(!hasError) {
    $.ajax({
      type: 'POST',
      url: 'ajax/register.php',
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
    .always(function(data) {
      console.log('Always')
    })
  }
})