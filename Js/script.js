$(document).ready(function () {

    $('.rating-star-1').hillRate();
    
    $('.rating-star-2').hillRate({
        stars : 3,
        valuesStar : [1,[2,3],[4,5]]
    });
    
    $('.rating-star-3').hillRate({
        stars : 4,
        valuesStar : [[10,20],[30,40],[50,60],100],
        imageStarOnIndex: [{"index":3,"default":'img/star-empty-gold.png',"full":"img/star-full-gold.png","half":"img/star-half-gold.png"}]
    });
    
    $('.rating-star-4').hillRate({
        stars : 3,
        valuesStar : [0,50,100],
        titleStar: [[":("],[':)'],[':D']] 
    });
    
    $('.rating-star-5').hillRate({
        valuesStar : [0,20,40],
        edit:false
    });
    $('.rating-star-6').hillRate({
        imageStar: {"default":'img/star-empty-gold.png',"full":"img/star-full-gold.png","half":"img/star-half-gold.png"} ,
        showSelectedValue:true,
        responsive: true
    });
    
    
    $('.rating-star-7').hillRate({  
        stars : 6, 
        imageStar: {"default":'img/star-empty-gold.png',"full":"img/star-full-gold.png","half":"img/star-half-gold.png"} ,
        imageStarOnIndex: [{"index":0,"default":'img/star-empty.png',"full":"img/star-full.png","half":"img/star-half.png","state_unselected":"default"}], 
        valuesStar : [0,[1,2],[3,4],[5,6],[7,8],[9,10]],  
        titleStar: [["Insufficient"],["almost enough","Enough"],["More than enough","Good"],["More than good","Exceptional"],["Extraordinary","excellent"],["Incredible","Wow!"]], 
        nameInput: "rating",
        responsive: true,
        showSelectedValue:false
    });
  
});