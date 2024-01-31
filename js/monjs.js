$(function(){

	//Afficher(demasquer) l'ancien mot de passe

	var txtOldPass=$('.oldpwd');

	$('.show-old-pwd').hover(
		function () {
			txtOldPass.attr('type','text');
		},
		function () {
			txtOldPass.attr('type','password');
		}


	)


	//Afficher(demasquer) le nouveau mot de passe

	var txtNewPass=$('.newpwd');

	$('.show-new-pwd').hover(
		function () {
			txtNewPass.attr('type','text');
		},
		function () {
			txtNewPass.attr('type','password');
		}


	)


});
