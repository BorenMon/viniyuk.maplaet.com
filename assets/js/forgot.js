$(document)
.on('submit', '.forgot', function(event) {
  event.preventDefault()

  const error = document.querySelector('.error')

  let errorMessage = ''

  const data = {
    email: $('#email').val()
  }

  if(data['email'].trim() === '') {
    errorMessage += 'អុីមែលតម្រូវឲ្យបំពេញ!'
    error.style.display = 'block'
    error.innerHTML = errorMessage
  } else {
    error.style.display = 'none'
    $.ajax({
      type: 'POST',
      url: 'ajax/forgot.php',
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
        error.innerText = errorMessage
      } else {
        error.style.display = 'none'
      }
    })
    .fail(function(e) {
      console.log(e)
    })
  }

})