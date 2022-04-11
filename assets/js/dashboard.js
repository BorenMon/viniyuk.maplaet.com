const artworks = document.querySelector('.artworks')

const artworksRatio = ['1 : 1', '3 : 2', '2 : 3', '1 : 1', '3 : 2', '3 : 2']
const artworksNum = artworksRatio.length

for(let i = 0; i < artworksNum; i++) {
  if(i != 3) {
    const artwork1 = document.createElement('div')
    artwork1.className = 'artwork'

    artwork1.innerHTML = `
      <img src="only_logo/${i + 1}/poster.jpeg?${new Date().getTime()}">
      <div class="info">
        <div class="ratio">ទំហំ​ ${artworksRatio[i]}</div>
        <div class="options">
          <a href="only_logo/${i + 1}">បញ្ចូលព័ត៌មាន</a>
        </div>
      </div>
    `
    artworks.appendChild(artwork1)
  }

  if(i != 4 && i != 5) { 
    const artwork2 = document.createElement('div')
    artwork2.className = 'artwork'

    artwork2.innerHTML = `
      <img src="artworks/${i + 1}/img/poster.jpeg">
      <div class="info">
        <div class="ratio">ទំហំ​ ${artworksRatio[i]}</div>
        <div class="options">
          <i class="fas fa-random"></i>
          <a href="artworks/${i + 1}/all.php">បញ្ចូលគ្រប់ព័ត៌មាន</a>
        </div>
      </div>
    `
    artworks.appendChild(artwork2)
  }
}

const artwork = document.querySelectorAll('.artwork')

const changes = document.querySelectorAll('.options i')

const input = document.querySelectorAll('.options a')

changes.forEach((change, idx) => {
  change.addEventListener('click', function() {
    const artworkIdx = (idx != 3) ? ((idx * 2) + 1) : (idx * 2)
    const img = artwork[artworkIdx].querySelector('img')
    const input = this.nextElementSibling
    if(input.innerText === 'បញ្ចូលតែលេខទូរស័ព្ទ') {
      input.innerText = 'បញ្ចូលគ្រប់ព័ត៌មាន'
      input.href = `artworks/${idx + 1}/all.php`
      img.src = `artworks/${idx + 1}/img/poster.jpeg`
    } else {
      input.innerText = 'បញ្ចូលតែលេខទូរស័ព្ទ'
      input.href = `artworks/${idx + 1}/phone.php`
      img.src = `artworks/${idx + 1}/img/poster1.jpeg`
    }
  })
})

// ?${new Date().getTime()} , for production
