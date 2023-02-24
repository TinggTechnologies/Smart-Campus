// Profile
let badgesBtn = document.querySelector('.badges-btn');
let studyBtn = document.querySelector('.study-btn');
let coursesBtn = document.querySelector('.courses-btn');

let badges = document.querySelector('.badges-wrapper');
let study = document.querySelector('.study-wrapper');
let courses = document.querySelector('.courses-wrapper');

const switchItems = document.querySelectorAll('.switch-item');

// Remove active class from all menu items
const changeActiveItem = () => {
    switchItems.forEach(item => {
    item.classList.remove('active');
  })
}

switchItems.forEach(item => {
  item.addEventListener('click', () => {
    changeActiveItem();
    item.classList.add('active');
  })
})

function defaultDisplay (){
    badges.style.display = 'none';
    study.style.display = 'none';
    courses.style.display = 'none';
}
badgesBtn.onclick = () => {
    defaultDisplay();
    badges.style.display = 'block';
}
studyBtn.onclick = () => {
    defaultDisplay();
    study.style.display = 'block';
}
coursesBtn.onclick = () => {
    defaultDisplay();
    courses.style.display = 'block';
}