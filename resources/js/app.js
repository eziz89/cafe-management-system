import './bootstrap';
import './menu';
import './cart';
import './favoriteButton';
import './categorySwiper';
import './checkout';
import './orders';
import './my-orders';

import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

window.Swiper = Swiper;
window.Navigation = Navigation;
window.Pagination = Pagination;
window.Autoplay = Autoplay;