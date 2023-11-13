const track = document.querySelector(".carousel__track");
const slides = Array.from(track.children);
const nextButton = document.querySelector(".carousel__button--right");
const prevButton = document.querySelector(".carousel__button--left");

const slideWidth = slides[0].getBoundingClientRect().width;
const autoSlideInterval = 5000;
let currentIndex = 0;
let timer;

const setSlidePosition = (slide, index) => {
  slide.style.left = slideWidth * 3 * index + "px";
};

slides.forEach(setSlidePosition);

const moveToSlide = (targetIndex) => {
  track.style.transform = "translateX(-" + slides[targetIndex].style.left + ")";
  slides[currentIndex].classList.remove("current-slide");
  slides[targetIndex].classList.add("current-slide");
  currentIndex = targetIndex;
  startAutoSlide(); // Restart auto-sliding after manual navigation
  hideShowArrows();
};

const hideShowArrows = () => {
  prevButton.classList.toggle("is-hidden", currentIndex === 0);
  nextButton.classList.toggle("is-hidden", currentIndex === slides.length - 1);
};

const nextSlide = () => {
  const nextIndex = (currentIndex + 1) % slides.length;
  moveToSlide(nextIndex);
};

const previousSlide = () => {
  const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
  moveToSlide(prevIndex);
};

nextButton.addEventListener("click", nextSlide);
prevButton.addEventListener("click", previousSlide);

// Auto-slide functionality
const startAutoSlide = () => {
  clearInterval(timer); // Clear any existing timer
  timer = setInterval(nextSlide, autoSlideInterval);
};

startAutoSlide(); // Start auto-sliding when the page loads
