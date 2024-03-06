$(document).ready(function() {
	let year = new Date().getFullYear()
	var copyright = document.createElement('div')
	copyright.className = 'footer'
	copyright.innerHTML = '<div class="container-fluid"><div class="row"><div class="col-sm-6"><b>' + year + ' \xA9 WA Gateway </b></div> <div class="col-sm-6"><div class="text-sm-end d-none d-sm-block"><b>Crafted with</b><i class="mdi mdi-heart text-danger"></i><a href="#"> ❤️</a></div></div></div></div>'
	document.querySelector('.wrapper').appendChild(copyright)
})