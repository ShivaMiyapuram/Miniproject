
$('.owl-carousel').owlCarousel({
loop:true,
    margin:20,
      navigation: true,
    navigationText: [
      "<i class='glyphicon glyphicon-chevron-left lt'></i>",
      "<i class='glyphicon glyphicon-chevron-right rt'></i>"
      ],
    responsiveClass:true,
    slideBy:1,
    items:3,
    
     itemsScaleUp:true,
    responsive:{
        320:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        900:{
            items:3,
            nav:true,
            loop:false
        }
    }
});
  