<form action="send.php" method="post" id="js-form-request" role="form" class="modal-request__form form">
    <div class="form-success"><span class="f1-R">Спасибо!</span></div>
    <input type="text" name="name" placeholder="Введите имя" required="required" class="modal-request__form_input f1_R"/>
    <input type="tel" name="phone" placeholder="Введите телефон" required="required" class="modal-request__form_input f1_R"/>
    <input type="email" name="email" placeholder="Введите e-mail" required="required" class="modal-request__form_input f1_R"/>
    <input type="submit" name="send" value="Оставить заявку" class="form-button button-big"/>
    <div class="modal-request__pivacy-policy">
    	<div class="pivacy-policy-text">
    	<input type="checkbox" checked="checked" class="pivacy-policy-text__input"/>
    		<span class="pivacy-policy-text__text">Согласен с обработкой моих персональных данных в соответствии с 
    			<a href="#" class="pivacy-policy-text__link">политикой конфиденциальности.</a>
    		</span>
      </div>
    </div>
</form>