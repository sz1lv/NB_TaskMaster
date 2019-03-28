//Adott menüpont ki- és becsukása
$(document).ready(function () {
    $('#btn').click(function () {
        $('#login').slideToggle();
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(this).find('span').html('&#x25b2;');
        } else {
            $(this).find('span').html('▼');
        }
    });
});


//Kép, illetve div elemek mozgatása, mikor az ablak betöltése után elsőre aktív látómezőbe kerülnek görgetéskor
(function($) {
  $.fn.visible = function(partial) {

      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };

})(jQuery);

//Görgetésre megjelenő nagy logó az index kép alatt
$(window).scroll(function(event) {
  $(".big-logo").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-in");
    }
  });
  //Görgetésre a 'Tudj meg többet' szekció első sorának feltűnése
  $(".firstRow").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-up1");
    }
  });
  //Görgetésre a 'Tudj meg többet' szekció második sorának feltűnése késleltetve az elsőhöz képest (custom.css)
  $(".secondRow").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-up2");
    }
  });
});