//- Шаблон
extends ../../layout

//- Переменные 
block variables
	- var title = 'Price'
	- var site = 'site.ru'
	- var description = 'Описание страницы'
	- var siteName = 'site name'
	- var keywords = 'Кючевые слова'
	- var body = 'is-price'

//- Контент
block content-page
	// Price-content
	main(class="price-content", role="main")
		//- Section 1
		include ../../_sections/s-section1/section1
		//- Section 2
		include ../../_sections/s-section2/section2
		//- Section 3
		include ../../_sections/s-section3/section3
		//- Section 4
		include ../../_sections/s-section4/section4
		//- Section 5
		include ../../_sections/s-section5/section5
		//- Section 6
		include ../../_sections/s-section6/section6
		//- Section 7
		include ../../_sections/s-section7/section7
		//- Section 8
		include ../../_sections/s-section8/section8
	// End price-content

