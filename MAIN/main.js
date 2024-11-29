const searchicon1 = document.querySelector('#searchicon1');
const srchicon1 = document.querySelector('#srchicon1');
const search1 = document.querySelector('#searchinput1');

searchicon1.addEventListener('click', function(){
    search1.style.display = 'flex';
    searchicon1.style.display = 'none';
})

const searchicon2 = document.querySelector('#searchicon2');
const srchicon2 = document.querySelector('#srchicon');
const search2 = document.querySelector('#searchinput2');

searchicon2.addEventListener('click', function(){
    search2.style.display = 'flex';
    searchicon2.style.display = 'none';
})

const bar = document.querySelector('.fa-bars');
const cross = document.querySelector('#hdcross');
const headerbar = document.querySelector('.headerbar');

bar.addEventListener('click', function(){
    setTimeout(()=>{
        cross.style.display = 'block';
    },200);
    headerbar.style.right = '0%';
})

cross.addEventListener('click', function(){
    cross.style.display = 'none';
    headerbar.style.right = '-100%';
})
<<<<<<< HEAD:main.js
let currentIndex = 0;

        function moveSlide(step) {
            const slides = document.querySelectorAll('.carousel-images img');
            const totalSlides = slides.length;
            currentIndex = (currentIndex + step + totalSlides) % totalSlides;
            const newTransformValue = -100 * currentIndex + '%';
            document.querySelector('.carousel-images').style.transform = 'translateX(' + newTransformValue + ')';
        }

        setInterval(() => {
            moveSlide(1);
        }, 3000); 
        window.addEventListener('load', function() {
            const backgroundSection = document.querySelector('.background-section');
            backgroundSection.classList.add('loaded');
        });
=======
>>>>>>> origin/main:MAIN/main.js
