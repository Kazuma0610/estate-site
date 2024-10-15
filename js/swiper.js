const swiper_thumbs = new Swiper('.swiper-thumbs', {
    pagination: {
      el: '.swiper-thumbs-pagination'
    },
    slidesPerView: 4,
    spaceBetween: 8,
    scrollbar: {
      el: '.p-myswiper-thumbs .swiper-scrollbar',
      draggable: true,
    },
    watchSlidesProgress: true,

  });
  
  
const swiper = new Swiper('.swiper', {
  
    // Slides per View
    slidesPerView: 1,
  
    thumbs: {
      swiper: swiper_thumbs,
    },
  
    effect: 'fade',
    fadeEffect: {
      // crossFade: true
    },
    speed: 1000,
    rewind: true,
  
  
    navigation: {
      nextEl: '.swiper-thumbs-button-next',
      prevEl: '.swiper-thumbs-button-prev',
    },
  
  
  
});


