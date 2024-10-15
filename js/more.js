$(function(){
    var show = 3; //最初に表示する件数
    var num = 3;  //もっと見るで表示する件数
    var contents = '.reco_rent_container_sp li'; // 対象のlist
     $(contents + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
     $('.more').on('click', function () {
     $(contents + '.is-hidden').slice(0, num).removeClass('is-hidden');
     if ($(contents + '.is-hidden').length == 0) {
     $('.more').fadeOut();
     }
    });
  });

$(function(){
    var show = 3; //最初に表示する件数
    var num = 3;  //もっと見るで表示する件数
    var contents = '.reco_rent_container_setagaya_sp li'; // 対象のlist
     $(contents + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
     $('.more-setagaya').on('click', function () {
     $(contents + '.is-hidden').slice(0, num).removeClass('is-hidden');
     if ($(contents + '.is-hidden').length == 0) {
     $('.more-setagaya').fadeOut();
     }
    });
  });

$(function(){
    $('.more').on('click',function(){
      $('.reco-aria-setagaya').css('margin-top','50px');
    });
  });