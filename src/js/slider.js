// Import Swiper core
import Swiper from "swiper";
// Import Swiper modules separately
import { Navigation, Pagination } from "swiper/modules";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

// Initialize Swiper
const swiper = new Swiper(".swiper-container", {
  modules: [Navigation, Pagination], // Use the imported modules
  slidesPerView: 1,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
