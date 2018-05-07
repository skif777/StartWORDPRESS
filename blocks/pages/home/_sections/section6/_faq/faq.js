 // FAQ list
$(document).ready(function() {
   $(".questions__list-left").on('click', 'li:not(.js-answer-open)', function() {
     $(this)
     .closest('.faq__content').find('.questions__list-right_answer').removeClass('js-answer-open') // Удалить если используется 1 tab
     .closest('.faq__content').find('.questions__list-left_answer').removeClass('js-answer-open').eq($(this).index(0)).addClass('js-answer-open');
     });
   	// List - 2 
   	$(".questions__list-right").on('click', 'li:not(.active)', function() {
     $(this)
     .closest('.faq__content').find('.questions__list-left_answer').removeClass('js-answer-open') // Удалить если используется 1 tab
     .closest('.faq__content').find('.questions__list-right_answer').removeClass('js-answer-open').eq($(this).index(0)).addClass('js-answer-open');
   });
 });
